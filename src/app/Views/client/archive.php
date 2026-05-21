<?php
$posts = $archivePosts ?? [];
$firstPost = $posts[0] ?? null;
$remainingPosts = array_slice($posts, 1);
$storyImages = [
    'code-banner.jpg',
    'features-technology.jpg',
    'news-1.jpg',
    'newsletter-1.jpg',
    'banner-img.jpg',
    'features-background.jpg',
];

$archivePostImage = static function (array $post, int $index = 0) use ($storyImages): string {
    if (!empty($post['thumbnail'])) {
        return PUBLIC_URL . '/uploads/' . htmlspecialchars($post['thumbnail'], ENT_QUOTES, 'UTF-8');
    }

    return PUBLIC_URL . '/assets/img/' . $storyImages[$index % count($storyImages)];
};

$archiveExcerpt = static function (?string $content, int $length = 70): string {
    $contentWithSpaces = preg_replace('/<[^>]+>/', ' ', $content ?? '');
    $text = trim(preg_replace('/\s+/', ' ', $contentWithSpaces ?? ''));

    if ($text === '') {
        $appName = $_ENV['APP_NAME'] ?? 'DevBlog';
        return "Thanks for reading {$appName}!";
    }

    return mb_strlen($text) > $length ? mb_substr($text, 0, $length) . '...' : $text;
};

$archiveDate = static function (?string $date): string {
    $timestamp = strtotime($date ?? '') ?: time();
    return strtoupper(date('M j', $timestamp));
};

$archiveMonth = static function (?string $date): string {
    $timestamp = strtotime($date ?? '') ?: time();
    return strtoupper(date('F Y', $timestamp));
};

$archiveAuthor = static function (?string $author): string {
    return mb_strtoupper($author ?: 'Huy Nguyen', 'UTF-8');
};

$groupedPosts = [];
foreach ($remainingPosts as $post) {
    $groupedPosts[$archiveMonth($post['created_at'] ?? null)][] = $post;
}
?>

<section class="journal-archive-page">
    <div class="journal-archive-tools">
        <div class="journal-archive-tabs" aria-label="Archive filters">
            <a class="active" href="<?= BASE_URL ?>/archive">Latest</a>
            <a href="#">Top</a>
            <a href="#">Discussions</a>
        </div>
        <button type="button" class="journal-archive-search" aria-label="Search archive">
            <i class="fas fa-search"></i>
        </button>
    </div>

    <?php if ($firstPost): ?>
        <article class="journal-archive-feature">
            <div>
                <a href="<?= BASE_URL ?>/post?id=<?= $firstPost['id'] ?>" class="journal-archive-title">
                    <?= htmlspecialchars($firstPost['title'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                </a>
                <p><?= htmlspecialchars($firstPost['category_name'] ?? 'Phần 3', ENT_QUOTES, 'UTF-8') ?></p>
                <span><?= $archiveDate($firstPost['created_at'] ?? null) ?> · <?= htmlspecialchars($archiveAuthor($firstPost['author_name'] ?? null), ENT_QUOTES, 'UTF-8') ?></span>
            </div>
            <a href="<?= BASE_URL ?>/post?id=<?= $firstPost['id'] ?>" class="journal-archive-thumb journal-archive-feature-thumb">
                <img src="<?= $archivePostImage($firstPost, 0) ?>"
                    alt="<?= htmlspecialchars($firstPost['title'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
            </a>
        </article>
    <?php endif; ?>

    <?php if (!empty($groupedPosts)): ?>
        <?php $postIndex = 1; ?>
        <?php foreach ($groupedPosts as $month => $monthPosts): ?>
            <h2 class="journal-archive-month"><?= htmlspecialchars($month, ENT_QUOTES, 'UTF-8') ?></h2>
            <?php foreach ($monthPosts as $post): ?>
                <article class="journal-archive-row">
                    <div>
                        <a href="<?= BASE_URL ?>/post?id=<?= $post['id'] ?>" class="journal-archive-title">
                            <?= htmlspecialchars($post['title'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                        </a>
                        <p><?= htmlspecialchars($archiveExcerpt($post['content'] ?? ''), ENT_QUOTES, 'UTF-8') ?></p>
                        <span><?= $archiveDate($post['created_at'] ?? null) ?> · <?= htmlspecialchars($archiveAuthor($post['author_name'] ?? null), ENT_QUOTES, 'UTF-8') ?></span>
                    </div>
                    <a href="<?= BASE_URL ?>/post?id=<?= $post['id'] ?>" class="journal-archive-thumb">
                        <img src="<?= $archivePostImage($post, $postIndex) ?>"
                            alt="<?= htmlspecialchars($post['title'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                    </a>
                </article>
                <?php $postIndex++; ?>
            <?php endforeach; ?>
        <?php endforeach; ?>
    <?php elseif (!$firstPost): ?>
        <div class="journal-archive-empty">
            <h2>No posts yet</h2>
            <p>Archive entries will show up here once posts are published.</p>
        </div>
    <?php endif; ?>
</section>
