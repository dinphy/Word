<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <?php $this->need('public/include.php'); ?>
    <?php if ($this->options->JPrismTheme) : ?>
        <link rel="stylesheet" href="<?php $this->options->JPrismTheme() ?>">
    <?php else : ?>
        <link rel="stylesheet" href="<?php $this->options->themeUrl('library/css/prism.min.css'); ?>">
    <?php endif; ?>
    <script src="<?php $this->options->themeUrl('library/js/clipboard.min.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('library/js/prism.min.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('assets/js/joe.post_page.min.js'); ?>"></script>
</head>

<body>
    <div id="Joe">
        <?php $this->need('public/header.php'); ?>
        <?php $this->need('public/banner.php'); ?>
        <div class="joe_container">
            <div class="joe_main">
                <section class="joe_adaption">
                    <!-- 目录树 -->
                    <?php if ($this->options->JDirectoryStatus === 'on') : ?>
                        <div class="joe_menu">
                            <?php _GetCatalog(); ?>
                        </div>
                    <?php endif; ?>
                    <div class="joe_detail" data-cid="<?php echo $this->cid ?>">
                        <?php $this->need('public/article.php'); ?>
                        <?php $this->need('public/handle.php'); ?>
                    </div>
                    <?php $this->need('public/comment.php'); ?>
                </section>
            </div>
        </div>
        <?php $this->need('public/footer.php'); ?>
    </div>
</body>

</html>