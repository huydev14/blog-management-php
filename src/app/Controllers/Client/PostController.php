<?php

declare(strict_types=1);

namespace App\Controllers\Client;

use Core\Controller;
use Core\Logger;
use App\Models\Post;
use App\Models\Home;

final class PostController extends Controller
{
    private Post $postModel;
    private Home $homeModel;

    public function __construct()
    {
        parent::__construct();
        $this->postModel = new Post();
        $this->homeModel = new Home();
    }

    /** Show post detail page */
    public function show(): void
    {
        // Get post ID from query string
        $postId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        if ($postId <= 0) {
            redirect('/');
        }

        // Get post detail with author and category info
        $post = $this->postModel->getPostById($postId);

        if (!$post) {
            redirect('/');
        }

        // Increment view count
        $this->incrementViews($postId);

        // Get related posts (same category)
        $relatedPosts = $this->getRelatedPosts((int)$post['category_id'], $postId);

        // Get comments
        $comments = $this->postModel->getCommentsByPostId($postId);

        // Get trending posts for sidebar
        $trendingPosts = $this->homeModel->getTrendingPosts(5);

        // Get all categories for sidebar
        $categories = $this->homeModel->getCategories();

        $data = [
            'headerData' => [
                'title' => htmlspecialchars($post['title']) . ' - DevBlog'
            ],
            'post' => $post,
            'comments' => $comments,
            'relatedPosts' => $relatedPosts,
            'trendingPosts' => $trendingPosts,
            'categories' => $categories
        ];

        $this->view->render('client/post-detail', 'client', $data);
    }

    /** Submit a public comment */
    public function submitComment(): void
    {
        $postId = isset($_POST['post_id']) ? (int)$_POST['post_id'] : 0;
        $content = trim((string)($_POST['content'] ?? ''));
        $authorName = trim((string)($_POST['author_name'] ?? ''));
        $authorEmail = trim((string)($_POST['author_email'] ?? ''));

        if ($postId <= 0) {
            redirect('/');
        }

        if ($content === '') {
            $_SESSION['comment_error'] = 'Please write a comment before submitting.';
            redirect('/post?id=' . $postId);
        }

        if ($authorEmail !== '' && !filter_var($authorEmail, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['comment_error'] = 'Please enter a valid email address.';
            redirect('/post?id=' . $postId);
        }

        $commentData = [
            'post_id' => $postId,
            'user_id' => null,
            'parent_id' => null,
            'author_name' => $authorName !== '' ? $authorName : 'Anonymous',
            'author_email' => $authorEmail !== '' ? $authorEmail : null,
            'content' => $content,
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? null,
            'user_agent' => substr((string)($_SERVER['HTTP_USER_AGENT'] ?? ''), 0, 255),
        ];

        try {
            $saved = $this->postModel->createComment($commentData);
            $_SESSION[$saved ? 'comment_success' : 'comment_error'] = $saved
                ? 'Thanks. Your comment has been posted.'
                : 'Unable to submit your comment. Please try again.';
        } catch (\Exception $e) {
            Logger::error('Error creating comment', [
                'message' => $e->getMessage(),
                'post_id' => $postId,
            ]);
            $_SESSION['comment_error'] = 'Unable to submit your comment. Please try again.';
        }

        redirect('/post?id=' . $postId);
    }

    /** Increment post view count */
    private function incrementViews(int $postId): void
    {
        // Using direct SQL to increment views
        try {
            $pdo = \Core\Database::connectPdo();
            $sql = "UPDATE posts SET views = views + 1 WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':id' => $postId]);
        } catch (\Exception $e) {
            Logger::error('Error incrementing views', ['message' => $e->getMessage(), 'post_id' => $postId]);
        }
    }

    /** Get related posts from the same category */
    private function getRelatedPosts(int $categoryId, int $currentPostId, int $limit = 3): array
    {
        if ($categoryId <= 0) {
            return [];
        }

        $sql = "SELECT
                    p.*,
                    u.fullname as author_name,
                    u.avatar as author_avatar,
                    c.name as category_name
                FROM posts p
                LEFT JOIN users u ON p.author_id = u.id
                LEFT JOIN categories c ON p.category_id = c.id
                WHERE p.category_id = :categoryId
                  AND p.id != :currentId
                ORDER BY p.created_at DESC
                LIMIT {$limit}";

        try {
            $pdo = \Core\Database::connectPdo();
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':categoryId' => $categoryId,
                ':currentId' => $currentPostId
            ]);
            return $stmt->fetchAll();
        } catch (\Exception $e) {
            Logger::error('Error fetching related posts', [
                'message' => $e->getMessage(),
                'category_id' => $categoryId,
                'current_post_id' => $currentPostId
            ]);
            return [];
        }
    }
}
