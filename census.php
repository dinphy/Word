<?php

/**
 * 统计
 * 
 * @package custom 
 * 
 **/

?>

<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <?php $this->need('public/include.php'); ?>
</head>

<body>
    <div id="Joe">
        <?php $this->need('public/head.php'); ?>
        <div class="joe_container">
            <?php $this->need('public/menu.php'); ?>
            <div class="joe_main">
                <?php $this->need('public/header.php'); ?>
                <?php $this->need('public/batten.php'); ?>
                <?php Typecho_Widget::widget('Widget_Stat')->to($item); ?>
                <div class="joe_census__filing">
                    <div class="title">
                        <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" width="16" height="16">
                            <path fill='var(--minor)' d="M512 1011.2a499.6096 499.6096 0 0 0 242.1248-62.5664 38.4 38.4 0 1 0-37.2736-67.1232 423.168 423.168 0 0 1-204.8 52.8384c-232.9088 0-422.4-189.4912-422.4-422.4 0-219.9552 169.0624-400.9472 384-420.4544V512c0 21.1968 17.2032 38.4 38.4 38.4h455.5264c0.9216 0 1.7408-0.4608 2.6624-0.512 0.9216 0.0512 1.6896 0.512 2.6624 0.512a38.4 38.4 0 0 0 38.4-38.4c0-275.2512-223.9488-499.2-499.2-499.2S12.8 236.7488 12.8 512s223.9488 499.2 499.2 499.2z m420.4544-537.6H550.4V91.5456a422.8096 422.8096 0 0 1 382.0544 382.0544z" fill="#438CFF" p-id="8806"></path>
                            <path fill='var(--main)' d="M891.392 698.0096a431.616 431.616 0 0 1-35.328 59.136 38.4 38.4 0 0 0 62.5664 44.6464c15.7184-22.1184 29.7984-45.6192 41.6768-69.8368a38.4 38.4 0 0 0-68.9152-33.9456z"></path>
                        </svg>
                        <span>共 <?php echo number_format($item->publishedPostsNum); ?> 篇文章，<?php echo number_format($item->publishedCommentsNum); ?> 条评论</span>
                    </div>
                    <div class="content">
                        <div id="filing"></div>
                        <div class="item load">
                            <div class="tail"></div>
                            <div class="head"></div>
                            <button class="button">加载更多</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->need('public/footer.php'); ?>
    </div>
</body>

</html>