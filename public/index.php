<?php

use Core\Router;
use Core\Logger;

// Define ROOT_PATH
define('ROOT_PATH', dirname(__DIR__)); // Project root

// Load Composer autoload
require_once ROOT_PATH . '/vendor/autoload.php';

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(ROOT_PATH);
$dotenv->load();

// Load configs
require_once ROOT_PATH . '/src/configs/app.php';

// Error reporting (based on .env)
if ($_ENV['APP_DEBUG'] === 'true') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// Start session
session_start();

// Init router  
$router = new Router();

// Load Routes
require_once ROOT_PATH . '/routes/web.php';

// Parse request
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Normalize URL
$basePath = APP_BASE_PATH ?? '';
if ($basePath && strpos($requestUri, $basePath) === 0) {
    $requestUri = substr($requestUri, strlen($basePath));
}
$requestUri = '/' . ltrim($requestUri, '/');

// Dispatch
try {
    $router->dispatch($_SERVER['REQUEST_METHOD'], $requestUri);
} catch (Exception $e) {
    Logger::error('Unhandled exception', ['message' => $e->getMessage()]);

    // Show error page
    if ($_ENV['APP_DEBUG'] === 'true') {
        echo "<pre>{$e->getMessage()}</pre>";
    } else {
        echo "Something went wrong. Please try again later.";
    }
}
