<?php
$postTitle = $post['title'] ?? '';
$postCategory = $post['category_name'] ?? 'Phần 3';
$authorName = $post['author_name'] ?? 'Huy Nguyen';
$authorAvatar = $post['author_avatar'] ?? 'default-avatar.jpg';
$createdAt = strtotime($post['created_at'] ?? '') ?: time();
$postUrl = BASE_URL . '/post?id=' . ($post['id'] ?? '');
$viewCount = (int)($post['views'] ?? 0);
$comments = $comments ?? [];
$commentCount = count($comments);
$commentSuccess = $_SESSION['comment_success'] ?? '';
$commentError = $_SESSION['comment_error'] ?? '';
unset($_SESSION['comment_success'], $_SESSION['comment_error']);

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
                    <?php if ($commentCount > 0): ?>
                        <span><?= number_format($commentCount) ?></span>
                    <?php endif; ?>
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

    <section class="journal-discussion-section" id="comments">
        <div class="journal-like-summary">
            <div class="journal-like-avatars" aria-hidden="true">
                <span></span>
                <span></span>
            </div>
            <p><?= max(1, min(9, $viewCount % 10)) ?> Likes</p>
        </div>

        <div class="journal-discussion-toolbar">
            <div class="journal-post-reactions" aria-label="Tương tác bài viết">
                <button type="button" aria-label="Like">
                    <i class="far fa-heart"></i>
                    <span><?= max(1, min(9, $viewCount % 10)) ?></span>
                </button>
                <button type="button" aria-label="Comment">
                    <i class="far fa-comment"></i>
                    <?php if ($commentCount > 0): ?>
                        <span><?= number_format($commentCount) ?></span>
                    <?php endif; ?>
                </button>
                <button type="button" aria-label="Repost">
                    <i class="fas fa-retweet"></i>
                </button>
            </div>

            <a class="journal-share-button" href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode($postUrl) ?>" target="_blank" rel="noopener">
                Share
            </a>
        </div>

        <h2>Discussion about this post</h2>

        <?php if ($commentSuccess !== ''): ?>
            <div class="journal-comment-alert success">
                <?= htmlspecialchars($commentSuccess, ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <?php if ($commentError !== ''): ?>
            <div class="journal-comment-alert error">
                <?= htmlspecialchars($commentError, ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <form class="journal-comment-form" action="<?= BASE_URL ?>/post/comment" method="post">
            <input type="hidden" name="post_id" value="<?= (int)($post['id'] ?? 0) ?>">
            <img src="<?= PUBLIC_URL ?>/assets/img/default-avatar.jpg" alt="Your avatar">
            <div class="journal-comment-fields">
                <textarea name="content" placeholder="Write a comment..." required></textarea>
                <div class="journal-comment-meta-fields">
                    <input type="text" name="author_name" placeholder="Your name">
                    <input type="email" name="author_email" placeholder="Email (optional)">
                    <button type="submit">Post</button>
                </div>
            </div>
        </form>

        <?php if (!empty($comments)): ?>
            <div class="journal-comment-list">
                <?php foreach ($comments as $comment): ?>
                    <?php
                    $commentAuthor = $comment['user_name'] ?: ($comment['author_name'] ?? 'Anonymous');
                    $commentAvatar = $comment['user_avatar'] ?? 'default-avatar.jpg';
                    $commentCreatedAt = strtotime($comment['created_at'] ?? '') ?: time();
                    ?>
                    <article class="journal-comment-item">
                        <img src="<?= PUBLIC_URL ?>/assets/img/<?= htmlspecialchars($commentAvatar, ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($commentAuthor, ENT_QUOTES, 'UTF-8') ?>">
                        <div>
                            <header>
                                <strong><?= htmlspecialchars($commentAuthor, ENT_QUOTES, 'UTF-8') ?></strong>
                                <time datetime="<?= htmlspecialchars(date('Y-m-d', $commentCreatedAt), ENT_QUOTES, 'UTF-8') ?>">
                                    <?= htmlspecialchars($formatDate($commentCreatedAt), ENT_QUOTES, 'UTF-8') ?>
                                </time>
                            </header>
                            <p><?= nl2br(htmlspecialchars($comment['content'] ?? '', ENT_QUOTES, 'UTF-8')) ?></p>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
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
