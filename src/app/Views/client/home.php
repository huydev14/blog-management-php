<?php
$posts = !empty($latestPosts) ? $latestPosts : $featuredPosts;
$mainPost = !empty($featuredPosts) ? $featuredPosts[0] : ($posts[0] ?? null);
$mainPostId = $mainPost['id'] ?? null;

$storyImages = [
    'code-banner.jpg',
    'features-technology.jpg',
    'news-1.jpg',
    'newsletter-1.jpg',
    'banner-img.jpg',
    'features-background.jpg',
];

$journalPostImage = static function (array $post, int $index = 0) use ($storyImages): string {
    if (!empty($post['thumbnail'])) {
        return PUBLIC_URL . '/uploads/' . htmlspecialchars($post['thumbnail'], ENT_QUOTES, 'UTF-8');
    }

    $imageName = $storyImages[$index % count($storyImages)];
    return PUBLIC_URL . '/assets/img/' . $imageName;
};

$journalExcerpt = static function (?string $content, int $length = 120): string {
    $contentWithSpaces = preg_replace('/<[^>]+>/', ' ', $content ?? '');
    $text = trim(preg_replace('/\s+/', ' ', $contentWithSpaces ?? ''));

    if ($text === '') {
        $appName = $_ENV['APP_NAME'] ?? 'DevBlog';
        return "Thanks for reading {$appName}!";
    }

    return mb_strlen($text) > $length ? mb_substr($text, 0, $length) . '...' : $text;
};

$journalDate = static function (?string $date): string {
    $timestamp = strtotime($date ?? '') ?: time();
    return strtoupper(date('M j', $timestamp));
};

$journalAuthor = static function (?string $author): string {
    return mb_strtoupper($author ?: 'Huy Nguyen', 'UTF-8');
};

$displayPosts = [];
foreach ($posts as $post) {
    if (($post['id'] ?? null) === $mainPostId) {
        continue;
    }

    $displayPosts[] = $post;
}

$displayPosts = array_slice($displayPosts, 0, 5);
?>

<section class="journal-home">
    <?php if ($mainPost): ?>
        <div class="journal-feature">
            <a class="journal-feature-image" href="<?= BASE_URL ?>/post?id=<?= $mainPost['id'] ?>">
                <img src="<?= $journalPostImage($mainPost, 0) ?>"
                    alt="<?= htmlspecialchars($mainPost['title'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
            </a>
            <div class="journal-feature-copy">
                <a href="<?= BASE_URL ?>/post?id=<?= $mainPost['id'] ?>" class="journal-feature-title">
                    <?= htmlspecialchars($mainPost['title'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                </a>
                <p><?= htmlspecialchars($mainPost['category_name'] ?? 'Phần 3', ENT_QUOTES, 'UTF-8') ?></p>
                <span><?= $journalDate($mainPost['created_at'] ?? null) ?> · <?= htmlspecialchars($journalAuthor($mainPost['author_name'] ?? null), ENT_QUOTES, 'UTF-8') ?></span>
                <div class="journal-pencraft-actions" aria-label="Tương tác bài viết nổi bật">
                    <button type="button" aria-label="Like">
                        <i class="far fa-heart"></i>
                        <span><?= max(1, min(9, (int)($mainPost['views'] ?? 0) % 10)) ?></span>
                    </button>
                    <button type="button" aria-label="Comment">
                        <i class="far fa-comment"></i>
                    </button>
                    <button type="button" aria-label="Repost">
                        <i class="fas fa-retweet"></i>
                    </button>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(BASE_URL . '/post?id=' . ($mainPost['id'] ?? '')) ?>"
                        target="_blank"
                        rel="noopener"
                        aria-label="Share">
                        <i class="fas fa-arrow-up-from-bracket"></i>
                    </a>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="journal-content">
        <div class="journal-feed">
            <?php if (!empty($displayPosts)): ?>
                <?php foreach ($displayPosts as $index => $post): ?>
                    <article class="journal-post-row">
                        <div class="journal-post-body">
                            <a href="<?= BASE_URL ?>/post?id=<?= $post['id'] ?>" class="journal-post-title">
                                <?= htmlspecialchars($post['title'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                            </a>
                            <p><?= htmlspecialchars($journalExcerpt($post['content'] ?? '', 88), ENT_QUOTES, 'UTF-8') ?></p>
                            <span><?= $journalDate($post['created_at'] ?? null) ?> · <?= htmlspecialchars($journalAuthor($post['author_name'] ?? null), ENT_QUOTES, 'UTF-8') ?></span>
                        </div>
                        <a href="<?= BASE_URL ?>/post?id=<?= $post['id'] ?>" class="journal-post-thumb">
                            <img src="<?= $journalPostImage($post, $index + 1) ?>"
                                alt="<?= htmlspecialchars($post['title'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                        </a>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="journal-empty">
                    <h2>Chưa có bài viết nào</h2>
                    <p>Hãy quay lại sau để đọc các chia sẻ mới nhất.</p>
                </div>
            <?php endif; ?>
        </div>

        <aside class="journal-sidebar" id="newsletter">
            <div class="journal-author-card">
                <img src="<?= PUBLIC_URL ?>/assets/img/logo.png" alt="<?= htmlspecialchars($_ENV['APP_NAME'] ?? 'DevBlog', ENT_QUOTES, 'UTF-8') ?>">
                <h2><?= htmlspecialchars($_ENV['APP_NAME'] ?? "Engineering's Journal", ENT_QUOTES, 'UTF-8') ?></h2>
                <p>
                    This is place where I share my thoughts, experiences and knowledge
                    as a Software Developer. Thanks for your support!
                </p>
            </div>

            <form class="journal-newsletter">
                <label class="visually-hidden" for="journal-email">Email</label>
                <input id="journal-email" type="email" placeholder="Type your email...">
                <button type="submit">Subscribe</button>
            </form>

            <?php if (!empty($trendingPosts)): ?>
                <div class="journal-mini-list">
                    <h3>Popular</h3>
                    <?php foreach (array_slice($trendingPosts, 0, 5) as $post): ?>
                        <a href="<?= BASE_URL ?>/post?id=<?= $post['id'] ?>">
                            <?= htmlspecialchars($post['title'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </aside>
    </div>
</section>
