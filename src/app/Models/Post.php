<?php

declare(strict_types=1);

namespace App\Models;

use Core\Model;

final class Post extends Model
{
    /** Get all posts (no paging) */
    public function getAllPosts(): array
    {
        return $this->getAll('SELECT * FROM posts ORDER BY id DESC');
    }

    /** Get posts with author and category info (paging + keyword) */
    public function getPosts(int $limit, int $offset, string $keyword = ''): array
    {
        $sql = "SELECT 
                    p.*,
                    u.fullname as author_name,
                    c.name as category_name
                FROM posts p
                LEFT JOIN users u ON p.author_id = u.id
                LEFT JOIN categories c ON p.category_id = c.id";

        $params = [];

        // search filter
        if ($keyword !== '') {
            $sql .= " WHERE p.title LIKE :kw";
            $params[':kw'] = '%' . $keyword . '%';
        }

        // paging
        $limit = max(0, $limit);
        $offset = max(0, $offset);
        $sql .= " ORDER BY p.id DESC LIMIT {$offset}, {$limit}";

        return $this->getAll($sql, $params);
    }

    // Get post by id with author and category
    public function getPostById(int $postId): ?array
    {
        return $this->getOne(
            'SELECT 
                p.*,
                u.fullname as author_name,
                c.name as category_name
             FROM posts p
             LEFT JOIN users u ON p.author_id = u.id
             LEFT JOIN categories c ON p.category_id = c.id
             WHERE p.id = :id 
             LIMIT 1',
            [':id' => $postId]
        );
    }

    /** Get comments for a post */
    public function getCommentsByPostId(int $postId): array
    {
        return $this->getAll(
            'SELECT
                c.*,
                u.fullname as user_name,
                u.avatar as user_avatar
             FROM comments c
             LEFT JOIN users u ON c.user_id = u.id
             WHERE c.post_id = :post_id
             ORDER BY c.created_at ASC',
            [
                ':post_id' => $postId,
            ]
        );
    }

    /** Create a comment */
    public function createComment(array $commentData): bool
    {
        return $this->insert('comments', $commentData);
    }


    /** Count all posts */
    public function countPosts(): int
    {
        return $this->getScalar('SELECT COUNT(id) FROM posts');
    }

    /** Count posts with keyword */
    public function countPostsByKeyword(string $keyword = ''): int
    {
        $sql = "SELECT COUNT(id) FROM posts";
        $params = [];

        if ($keyword !== '') {
            $sql .= " WHERE title LIKE :kw";
            $params[':kw'] = '%' . $keyword . '%';
        }

        return $this->getScalar($sql, $params);
    }

    // Insert new post
    public function createPost(array $postData): bool
    {
        return $this->insert('posts', $postData);
    }

    // Update post by id
    public function updatePost(int $postId, array $postData): bool
    {
        return $this->update(
            'posts',
            $postData,
            'id = :id',
            [':id' => $postId]
        );
    }


    // Delete post by id
    public function deletePost(int $postId): bool
    {
        return $this->delete(
            'posts',
            'id = :id',
            [':id' => $postId]
        );
    }
}
