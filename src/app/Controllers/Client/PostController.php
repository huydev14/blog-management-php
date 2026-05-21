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

        // Get trending posts for sidebar
        $trendingPosts = $this->homeModel->getTrendingPosts(5);

        // Get all categories for sidebar
        $categories = $this->homeModel->getCategories();

        $data = [
            'headerData' => [
                'title' => htmlspecialchars($post['title']) . ' - DevBlog'
            ],
            'post' => $post,
            'relatedPosts' => $relatedPosts,
            'trendingPosts' => $trendingPosts,
            'categories' => $categories
        ];

        $this->view->render('client/post-detail', 'client', $data);
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
