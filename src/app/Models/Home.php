<?php

declare(strict_types=1);

namespace App\Models;

use Core\Model;

final class Home extends Model
{
    /**
     * Get latest posts for homepage
     */
    public function getLatestPosts(int $limit = 6): array
    {
        $limit = max(1, (int) $limit);
        
        $sql = "SELECT
                    p.*,
                    u.fullname as author_name,
                    u.avatar as author_avatar,
                    c.name as category_name
                FROM posts p
                LEFT JOIN users u ON p.author_id = u.id
                LEFT JOIN categories c ON p.category_id = c.id
                ORDER BY p.created_at DESC
                LIMIT {$limit}";

        return $this->getAll($sql);
    }

    /**
     * Get posts for archive page
     */
    public function getArchivePosts(int $limit = 50): array
    {
        $limit = max(1, (int) $limit);

        $sql = "SELECT 
                    p.*,
                    u.fullname as author_name,
                    u.avatar as author_avatar,
                    c.name as category_name
                FROM posts p
                LEFT JOIN users u ON p.author_id = u.id
                LEFT JOIN categories c ON p.category_id = c.id
                ORDER BY p.created_at DESC
                LIMIT {$limit}";

        return $this->getAll($sql);
    }

    /**
     * Get featured posts (most viewed)
     */
    public function getFeaturedPosts(int $limit = 3): array
    {
        $limit = max(1, (int) $limit);
        
        $sql = "SELECT 
                    p.*,
                    u.fullname as author_name,
                    u.avatar as author_avatar,
                    c.name as category_name
                FROM posts p
                LEFT JOIN users u ON p.author_id = u.id
                LEFT JOIN categories c ON p.category_id = c.id
                WHERE p.views > 0
                ORDER BY p.views DESC
                LIMIT {$limit}";

        return $this->getAll($sql);
    }

    /**
     * Get trending posts (high views in recent days)
     */
    public function getTrendingPosts(int $limit = 5): array
    {
        $limit = max(1, (int) $limit);
        
        $sql = "SELECT 
                    p.*,
                    u.fullname as author_name,
                    u.avatar as author_avatar,
                    c.name as category_name
                FROM posts p
                LEFT JOIN users u ON p.author_id = u.id
                LEFT JOIN categories c ON p.category_id = c.id
                WHERE p.created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
                ORDER BY p.views DESC
                LIMIT {$limit}";

        return $this->getAll($sql);
    }

    /**
     * Get all categories with post count
     */
    public function getCategories(): array
    {
        $sql = "SELECT 
                    id,
                    name,
                    description,
                    post_count
                FROM categories
                WHERE post_count > 0
                ORDER BY post_count DESC";

        return $this->getAll($sql);
    }

    /**
     * Search posts by keyword
     */
    public function searchPosts(string $keyword, int $limit = 10): array
    {
        $limit = max(1, (int) $limit);
        
        $sql = "SELECT 
                    p.*,
                    u.fullname as author_name,
                    u.avatar as author_avatar,
                    c.name as category_name
                FROM posts p
                LEFT JOIN users u ON p.author_id = u.id
                LEFT JOIN categories c ON p.category_id = c.id
                WHERE p.title LIKE :keyword 
                   OR p.content LIKE :keyword
                ORDER BY p.created_at DESC
                LIMIT {$limit}";

        return $this->getAll($sql, [
            ':keyword' => '%' . $keyword . '%'
        ]);
    }

    /**
     * Get homepage statistics
     */
    public function getStatistics(): array
    {
        return [
            'total_posts' => $this->getScalar('SELECT COUNT(*) FROM posts'),
            'total_views' => $this->getScalar('SELECT SUM(views) FROM posts'),
            'total_categories' => $this->getScalar('SELECT COUNT(*) FROM categories WHERE post_count > 0'),
            'total_authors' => $this->getScalar('SELECT COUNT(DISTINCT author_id) FROM posts')
        ];
    }
}
