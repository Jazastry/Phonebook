<?php include_once DX_ROOT_DIR . '/views/logged/partials/header.php'; ?>
<section class="main-section">
    <section class="action-bar">
        <?php if (! empty( $current_actionBar )) { include_once $current_actionBar; } ?>
    </section>
    <section class="main-display">
        <?php include_once $current_template; ?>
    </section>
</section>
<?php include_once DX_ROOT_DIR . '/views/logged/partials/footer.php'; ?>