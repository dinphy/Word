<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <?php $this->need('public/include.php'); ?>
    <script src="https://lib.baomitu.com/wow/1.1.2/wow.min.js"></script>
</head>

<body>
    <div id="Joe">
        <?php $this->need('public/head.php'); ?>
        <div class="joe_container">
            <?php $this->need('public/menu.php'); ?>
            <div class="joe_main">
                <?php $this->need('public/header.php'); ?>
                <?php $this->need('public/batten.php'); ?>
                <section class="joe_adaption" style="background: none;">
                    <?php $this->need('public/list.php'); ?>
                </section>
            </div>
        </div>
    </div>
    <?php $this->need('public/footer.php'); ?>
    </div>
</body>

</html>