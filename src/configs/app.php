<?php

declare(strict_types=1);

// Database configuration
define('DB_HOST', $_ENV['DB_HOST'] ?? 'localhost');
define('DB_PORT', $_ENV['DB_PORT'] ?? '3306');
define('DB_NAME', $_ENV['DB_NAME'] ?? 'blog_manager_db');
define('DB_USER', $_ENV['DB_USER'] ?? 'root');
define('DB_PASS', $_ENV['DB_PASS'] ?? '');
define('DB_DRIVER', $_ENV['DB_DRIVER'] ?? 'mysql');
define('DB_CHARSET', $_ENV['DB_CHARSET'] ?? 'utf8mb4');

// Application
define('APP_NAME', $_ENV['APP_NAME'] ?? APP_NAME);
define('APP_DEBUG', filter_var($_ENV['APP_DEBUG'] ?? false, FILTER_VALIDATE_BOOLEAN));

// URLs
define('BASE_URL', $_ENV['BASE_URL']);    // http://localhost/DevBlog-PHP-MVC
define('PUBLIC_URL', BASE_URL);

// Path configuration
define('APP_BASE_PATH', $_ENV['APP_BASE_PATH']); //  /DevBlog-PHP-MVC
define('APP_PATH', ROOT_PATH . '/src/app');
define('CORE_PATH', ROOT_PATH . '/src/Core');

// Set timezone
date_default_timezone_set($_ENV['APP_TIMEZONE'] ?? 'Asia/Ho_Chi_Minh');
