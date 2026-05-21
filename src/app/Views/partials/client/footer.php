<!-- Footer Section -->
<footer class="journal-footer">
    <div class="journal-footer-inner">
        <p class="journal-footer-legal">
            &copy; <?= date('Y') ?> <?= htmlspecialchars($_ENV['APP_AUTHOR'] ?? 'DevBlog', ENT_QUOTES, 'UTF-8') ?>
            <span>&middot;</span>
            <a href="#">Privacy</a>
            <span>&middot;</span>
            <a href="#">Terms</a>
            <span>&middot;</span>
            <a href="#">Collection notice</a>
        </p>
    </div>
</footer>

<!-- Back to Top Button -->
<a href="#" class="back-to-top" aria-label="Back to top">
    <i class="fas fa-arrow-up"></i>
</a>

<style>
    .journal-footer {
        background: #f2f2f2;
        border-top: 1px solid #e1e1e1;
        color: #7a7a7a;
        margin-top: 96px;
        padding: 32px 16px 30px;
        text-align: center;
    }

    .journal-footer-inner {
        max-width: 720px;
        margin: 0 auto;
    }

    .journal-footer-legal,
    .journal-footer-note {
        font-size: 14px;
        line-height: 1.5;
        margin: 0;
    }

    .journal-footer-legal span {
        color: #9a9a9a;
        margin: 0 4px;
    }

    .journal-footer a {
        color: #757575;
        text-decoration: underline;
        text-underline-offset: 2px;
    }

    .journal-footer-actions {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-bottom: 20px;
    }

    .journal-footer-button {
        min-height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        background: #fff;
        border: 1px solid #dadada;
        border-radius: 7px;
        color: #777 !important;
        font-size: 14px;
        font-weight: 700;
        line-height: 1;
        padding: 0 16px;
        text-decoration: none !important;
        box-shadow: 0 1px 0 rgba(0, 0, 0, .03);
    }

    .journal-footer-button i {
        color: #ff6719;
        font-size: 13px;
    }

    .journal-footer-note {
        color: #858585;
    }

    .back-to-top {
        position: fixed;
        right: 30px;
        bottom: 30px;
        z-index: 9999;
        width: 44px;
        height: 44px;
        display: none;
        align-items: center;
        justify-content: center;
        background: #ff5a1f;
        border-radius: 50%;
        color: #fff;
        text-decoration: none;
        box-shadow: 0 8px 20px rgba(0, 0, 0, .16);
    }

    .back-to-top:hover {
        background: #f04d16;
        color: #fff;
    }

    @media (max-width: 575.98px) {
        .journal-footer {
            margin-top: 64px;
            padding: 28px 14px;
        }

        .journal-footer-actions {
            flex-direction: column;
        }

        .journal-footer-button {
            width: min(100%, 240px);
        }
    }
</style>

<script>
    const backToTop = document.querySelector('.back-to-top');

    if (backToTop) {
        window.addEventListener('scroll', () => {
            backToTop.style.display = window.scrollY > 300 ? 'flex' : 'none';
        });

        backToTop.addEventListener('click', (event) => {
            event.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
</script>
