<!-- Journal Navigation -->
<?php
$currentPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$basePath = defined('APP_BASE_PATH') ? APP_BASE_PATH : '';

if ($basePath !== '' && str_starts_with($currentPath, $basePath)) {
    $currentPath = substr($currentPath, strlen($basePath)) ?: '/';
}

$currentPath = '/' . ltrim($currentPath, '/');
$isArchive = $currentPath === '/archive';
$isHome = $currentPath === '/';
?>
<header class="journal-site-header">
    <div class="journal-topbar">
        <a class="journal-avatar-link" href="<?= BASE_URL ?>" aria-label="Trang chủ">
            <img src="<?= PUBLIC_URL ?>/assets/img/logo.png" class="journal-avatar" alt="<?= htmlspecialchars($_ENV['APP_NAME'] ?? 'DevBlog', ENT_QUOTES, 'UTF-8') ?>">
        </a>

        <a class="journal-brand" href="<?= BASE_URL ?>"><?= htmlspecialchars($_ENV['APP_NAME'] ?? 'DevBlog', ENT_QUOTES, 'UTF-8') ?></a>

        <div class="journal-actions">
            <form class="journal-search" role="search">
                <label class="visually-hidden" for="journal-search-input">Tìm kiếm</label>
                <input id="journal-search-input" type="search" placeholder="Search">
                <button type="submit" aria-label="Tìm kiếm">
                    <i class="fas fa-search"></i>
                </button>
            </form>
            <a href="#" class="journal-icon-btn" aria-label="Chia sẻ">
                <i class="fas fa-arrow-up-from-bracket"></i>
            </a>
            <a href="#newsletter" class="journal-subscribe-btn">Subscribe</a>
            <a href="<?= BASE_URL ?>/login" class="journal-signin">Sign in</a>
        </div>
    </div>

    <nav class="journal-nav" aria-label="Điều hướng chính">
        <a class="<?= $isHome ? 'active' : '' ?>" href="<?= BASE_URL ?>">Home</a>
        <a class="<?= $isArchive ? 'active' : '' ?>" href="<?= BASE_URL ?>/archive">Archive</a>
        <a href="#newsletter">About</a>
    </nav>
</header>
