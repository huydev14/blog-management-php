<?php

declare(strict_types=1);

namespace App\Controllers\Client;

use Core\Controller;
use App\Models\Home;

final class HomeController extends Controller
{
    private Home $homeModel;

    public function __construct()
    {
        parent::__construct();
        $this->homeModel = new Home();
    }

    public function index(): void
    {
        // Get all data from Home Model
        $latestPosts = $this->homeModel->getLatestPosts(6);
        $featuredPosts = $this->homeModel->getFeaturedPosts(3);
        $categories = $this->homeModel->getCategories();
        $trendingPosts = $this->homeModel->getTrendingPosts(5);
        $statistics = $this->homeModel->getStatistics();

        $data = [
            'headerData' => ['title' => 'Trang chủ - DevBlog'],
            'latestPosts' => $latestPosts,
            'featuredPosts' => $featuredPosts,
            'categories' => $categories,
            'trendingPosts' => $trendingPosts,
            'statistics' => $statistics
        ];

        $this->view->render('client/home', 'client', $data);
    }

    public function archive(): void
    {
        $archivePosts = $this->homeModel->getArchivePosts(50);
        $categories = $this->homeModel->getCategories();

        $data = [
            'headerData' => ['title' => 'Archive - DevBlog'],
            'archivePosts' => $archivePosts,
            'categories' => $categories,
        ];

        $this->view->render('client/archive', 'client', $data);
    }

    public function about(): void
    {
        $categories = $this->homeModel->getCategories();

        $data = [
            'headerData' => ['title' => 'About - DevBlog'],
            'categories' => $categories,
        ];

        $this->view->render('client/about', 'client', $data);
    }
}
