<?php
$postTitle = $post['title'] ?? '';
$postCategory = $post['category_name'] ?? 'Phần 3';
$authorName = $post['author_name'] ?? 'Huy Nguyen';
$authorAvatar = $post['author_avatar'] ?? 'default-avatar.jpg';
$createdAt = strtotime($post['created_at'] ?? '') ?: time();
$postUrl = BASE_URL . '/post?id=' . ($post['id'] ?? '');
$viewCount = (int)($post['views'] ?? 0);

$formatAuthor = static function (string $name): string {
    return mb_strtoupper($name, 'UTF-8');
};

$formatDate = static function (int $timestamp): string {
    return strtoupper(date('M j, Y', $timestamp));
};
?>

<article class="journal-post-detail">
    <header class="journal-post-header">
        <h1><?= htmlspecialchars($postTitle, ENT_QUOTES, 'UTF-8') ?></h1>
        <p class="journal-post-subtitle"><?= htmlspecialchars($postCategory, ENT_QUOTES, 'UTF-8') ?></p>

        <div class="journal-post-author">
            <img src="<?= PUBLIC_URL ?>/assets/img/<?= htmlspecialchars($authorAvatar, ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($authorName, ENT_QUOTES, 'UTF-8') ?>">
            <div>
                <span><?= htmlspecialchars($formatAuthor($authorName), ENT_QUOTES, 'UTF-8') ?></span>
                <time datetime="<?= htmlspecialchars(date('Y-m-d', $createdAt), ENT_QUOTES, 'UTF-8') ?>">
                    <?= htmlspecialchars($formatDate($createdAt), ENT_QUOTES, 'UTF-8') ?>
                </time>
            </div>
        </div>

        <div class="journal-post-toolbar">
            <div class="journal-post-reactions" aria-label="Tương tác bài viết">
                <button type="button" aria-label="Like">
                    <i class="far fa-heart"></i>
                    <span><?= max(1, min(9, $viewCount % 10)) ?></span>
                </button>
                <button type="button" aria-label="Comment">
                    <i class="far fa-comment"></i>
                </button>
                <button type="button" aria-label="Repost">
                    <i class="fas fa-retweet"></i>
                </button>
            </div>

            <a class="journal-share-button" href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode($postUrl) ?>" target="_blank" rel="noopener">
                Share
            </a>
        </div>
    </header>

    <?php if (!empty($post['thumbnail'])): ?>
        <figure class="journal-post-cover">
            <img src="<?= PUBLIC_URL ?>/uploads/<?= htmlspecialchars($post['thumbnail'], ENT_QUOTES, 'UTF-8') ?>"
                alt="<?= htmlspecialchars($postTitle, ENT_QUOTES, 'UTF-8') ?>">
        </figure>
    <?php endif; ?>

    <div class="journal-post-content">
        <?= $post['content'] ?>
    </div>

    <section class="journal-inline-newsletter" id="newsletter">
        <p>
            Thanks for reading <?= htmlspecialchars($_ENV['APP_NAME'] ?? 'DevBlog', ENT_QUOTES, 'UTF-8') ?>!<br>
            Subscribe for free to receive new posts and<br>
            support my work.
        </p>
        <form>
            <label class="visually-hidden" for="post-detail-email">Email</label>
            <input id="post-detail-email" type="email" placeholder="Type your email...">
            <button type="submit">Subscribe</button>
        </form>
    </section>

    <?php if (!empty($relatedPosts)): ?>
        <section class="journal-related-posts">
            <h2>Read next</h2>
            <?php foreach (array_slice($relatedPosts, 0, 3) as $relatedPost): ?>
                <a href="<?= BASE_URL ?>/post?id=<?= $relatedPost['id'] ?>">
                    <span><?= htmlspecialchars($relatedPost['title'] ?? '', ENT_QUOTES, 'UTF-8') ?></span>
                    <small><?= htmlspecialchars($formatDate(strtotime($relatedPost['created_at'] ?? '') ?: time()), ENT_QUOTES, 'UTF-8') ?></small>
                </a>
            <?php endforeach; ?>
        </section>
    <?php endif; ?>
</article>

<style>
    body {
        background: #fff;
        color: #363737;
    }

    .journal-post-detail {
        max-width: 728px;
        margin: 0 auto;
        padding: 32px 24px 0;
    }

    .journal-post-header h1 {
        color: #363737;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 32px;
        font-weight: 800;
        letter-spacing: 0;
        line-height: 1.2;
        margin: 0 0 6px;
    }

    .journal-post-subtitle {
        color: #777;
        font-size: 18px;
        line-height: 1.4;
        margin: 0 0 18px;
    }

    .journal-post-author {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 18px;
    }

    .journal-post-author img {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: block;
        object-fit: cover;
    }

    .journal-post-author span,
    .journal-post-author time {
        display: block;
        font-family: Arial, Helvetica, sans-serif;
        letter-spacing: .055em;
        line-height: 1.35;
    }

    .journal-post-author span {
        color: #333;
        font-size: 11px;
        font-weight: 700;
    }

    .journal-post-author time {
        color: #777;
        font-size: 11px;
        font-weight: 600;
        margin-top: 3px;
    }

    .journal-post-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin: 0 0 16px;
    }

    .journal-post-reactions {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .journal-post-reactions button,
    .journal-share-button {
        min-width: 40px;
        height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        background: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 999px;
        color: #6f6f6f;
        font-size: 14px;
        line-height: 1;
        text-decoration: none;
    }

    .journal-post-reactions button {
        padding: 0 13px;
    }

    .journal-post-reactions button:not(:first-child) {
        width: 40px;
        padding: 0;
    }

    .journal-share-button {
        padding: 0 15px;
    }

    .journal-post-cover {
        margin: 22px 0 28px;
    }

    .journal-post-cover img {
        width: 100%;
        max-height: 480px;
        display: block;
        object-fit: cover;
    }

    .journal-post-content {
        color: #3f3f3f;
        font-family: Georgia, "Times New Roman", serif;
        font-size: 20px;
        line-height: 1.55;
    }

    .journal-post-content p {
        margin: 0 0 24px;
    }

    .journal-post-content h1,
    .journal-post-content h2,
    .journal-post-content h3 {
        color: #333;
        font-family: Arial, Helvetica, sans-serif;
        font-weight: 800;
        letter-spacing: 0;
        line-height: 1.22;
    }

    .journal-post-content h1,
    .journal-post-content h2 {
        font-size: 30px;
        margin: 34px 0 18px;
    }

    .journal-post-content h3 {
        font-size: 24px;
        margin: 30px 0 14px;
    }

    .journal-post-content ul,
    .journal-post-content ol {
        margin: 0 0 24px;
        padding-left: 28px;
    }

    .journal-post-content li {
        margin-bottom: 9px;
    }

    .journal-post-content a {
        color: #333;
        text-decoration: underline;
        text-underline-offset: 3px;
    }

    .journal-post-content blockquote {
        border-left: 3px solid #d8d8d8;
        color: #666;
        font-style: italic;
        margin: 28px 0;
        padding-left: 18px;
    }

    .journal-post-content code {
        background: #f5f5f5;
        border-radius: 4px;
        color: #333;
        font-family: Menlo, Consolas, monospace;
        font-size: .86em;
        padding: 2px 5px;
    }

    .journal-post-content pre {
        background: #f7f7f7;
        border: 1px solid #e8e8e8;
        border-radius: 6px;
        color: #333;
        font-size: 14px;
        line-height: 1.55;
        margin: 26px 0;
        overflow-x: auto;
        padding: 16px;
    }

    .journal-post-content pre code {
        background: transparent;
        padding: 0;
    }

    .journal-post-content img {
        max-width: 100%;
        height: auto;
        display: block;
        margin: 28px auto;
    }

    .journal-inline-newsletter {
        max-width: 420px;
        margin: 30px auto 26px;
        text-align: center;
    }

    .journal-inline-newsletter p {
        color: #3e3e3e;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 18px;
        line-height: 1.6;
        margin: 0 0 20px;
    }

    .journal-inline-newsletter form {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 110px;
        border: 1px solid #ff6a35;
        border-radius: 8px;
        overflow: hidden;
    }

    .journal-inline-newsletter input {
        border: 0;
        color: #444;
        font-size: 14px;
        min-width: 0;
        outline: 0;
        padding: 11px 13px;
    }

    .journal-inline-newsletter input::placeholder {
        color: #c8c8c8;
    }

    .journal-inline-newsletter button {
        background: #ff815e;
        border: 0;
        color: #fff;
        font-size: 14px;
        font-weight: 700;
        padding: 0 14px;
    }

    .journal-related-posts {
        border-top: 1px solid #e4e4e4;
        margin-top: 44px;
        padding-top: 22px;
    }

    .journal-related-posts h2 {
        color: #333;
        font-size: 18px;
        font-weight: 800;
        margin: 0 0 12px;
    }

    .journal-related-posts a {
        display: flex;
        justify-content: space-between;
        gap: 18px;
        color: #3f3f3f;
        font-size: 15px;
        font-weight: 700;
        line-height: 1.35;
        padding: 13px 0;
        text-decoration: none;
        border-bottom: 1px solid #efefef;
    }

    .journal-related-posts small {
        color: #777;
        flex: 0 0 auto;
        font-size: 11px;
        font-weight: 600;
        letter-spacing: .055em;
    }

    @media (max-width: 767.98px) {
        .journal-post-detail {
            padding: 26px 18px 0;
        }

        .journal-post-header h1 {
            font-size: 30px;
        }

        .journal-post-toolbar {
            gap: 16px;
        }

        .journal-post-content {
            font-size: 18px;
        }

        .journal-inline-newsletter p {
            font-size: 17px;
        }
    }

    @media (max-width: 480px) {
        .journal-post-toolbar {
            align-items: flex-start;
            flex-direction: column;
        }

        .journal-inline-newsletter form {
            grid-template-columns: 1fr;
        }

        .journal-inline-newsletter button {
            min-height: 42px;
        }

        .journal-related-posts a {
            flex-direction: column;
            gap: 4px;
        }
    }
</style>
