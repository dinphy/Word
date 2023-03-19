<?php

/**
 * 友链
 * 
 * @package custom 
 * 
 **/

?>

<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <?php $this->need('public/include.php'); ?>
    <?php if ($this->options->JPrismTheme) : ?>
        <link rel="stylesheet" href="<?php $this->options->JPrismTheme() ?>">
    <?php else : ?>
        <link rel="stylesheet" href="https://lib.baomitu.com/prism/1.26.0/themes/prism.min.css">
    <?php endif; ?>
    <script src="https://lib.baomitu.com/clipboard.js/2.0.10/clipboard.min.js"></script>
    <script src="https://lib.baomitu.com/prism/1.26.0/prism.min.js"></script>
    <script src="<?php $this->options->themeUrl('assets/js/joe.post_page.min.js'); ?>"></script>
</head>

<body>
    <div id="Joe">
        <?php $this->need('public/head.php'); ?>
        <div class="joe_container">
            <?php $this->need('public/menu.php'); ?>
            <div class="joe_main">
                <?php $this->need('public/header.php'); ?>
                <?php $this->need('public/batten.php'); ?>
                <section class="joe_adaption">
                    <div class="joe_detail" data-cid="<?php echo $this->cid ?>">
                        <?php $this->need('public/article.php'); ?>
                        <?php
                        $friends_index = [];
                        $friends_index_color = [
                            '#F8D800',
                            '#0396FF',
                            '#EA5455',
                            '#7367F0',
                            '#32CCBC',
                            '#F6416C',
                            '#28C76F',
                            '#9F44D3',
                            '#F55555',
                            '#736EFE',
                            '#E96D71',
                            '#DE4313',
                            '#D939CD',
                            '#4C83FF',
                            '#F072B6',
                            '#C346C2',
                            '#5961F9',
                            '#FD6585',
                            '#465EFB',
                            '#FFC600',
                            '#FA742B',
                            '#5151E5',
                            '#BB4E75',
                            '#FF52E5',
                            '#49C628',
                            '#00EAFF',
                            '#F067B4',
                            '#F067B4',
                            '#ff9a9e',
                            '#00f2fe',
                            '#4facfe',
                            '#f093fb',
                            '#6fa3ef',
                            '#bc99c4',
                            '#46c47c',
                            '#f9bb3c',
                            '#e8583d',
                            '#f68e5f',
                        ];
                        $friends_index_text = $this->options->JFriendsIndex;
                        if ($friends_index_text) {
                            $friends_index_arr = explode("\r\n", $friends_index_text);
                            if (count($friends_index_arr) > 0) {
                                for ($i = 0; $i < count($friends_index_arr); $i++) {
                                    $name = explode("||", $friends_index_arr[$i])[0];
                                    $url = explode("||", $friends_index_arr[$i])[1];
                                    $avatar = explode("||", $friends_index_arr[$i])[2];
                                    $desc = explode("||", $friends_index_arr[$i])[3];
                                    $friends_index[] = array("name" => trim($name), "url" => trim($url), "avatar" => trim($avatar), "desc" => trim($desc));
                                };
                            }
                        }
                        ?>
                        <?php if (sizeof($friends_index) > 0) : ?>
                            <h3 class="joe_mtitle"><span class="joe_mtitle__text">首页友链</span></h3>
                            <ul class="joe_detail__friends">
                                <?php foreach ($friends_index as $iitem) : ?>
                                    <li class="joe_detail__friends-item">
                                        <a class="contain" href="<?php echo $iitem['url']; ?>" target="_blank" rel="noopener noreferrer" style="background: <?php echo $friends_index_color[mt_rand(0, count($friends_index_color) - 1)] ?>">
                                            <span class="title"><?php echo $iitem['name']; ?></span>
                                            <div class="content">
                                                <div class="desc"><?php echo $iitem['desc']; ?></div>
                                                <img width="40" height="40" class="avatar lazyload" src="<?php _getAvatarLazyload(); ?>" data-src="<?php echo $iitem['avatar']; ?>" alt="<?php echo $iitem['name']; ?>" />
                                            </div>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                        <?php
                        $friends = [];
                        $friends_color = [
                            '#F8D800',
                            '#0396FF',
                            '#EA5455',
                            '#7367F0',
                            '#32CCBC',
                            '#F6416C',
                            '#28C76F',
                            '#9F44D3',
                            '#F55555',
                            '#736EFE',
                            '#E96D71',
                            '#DE4313',
                            '#D939CD',
                            '#4C83FF',
                            '#F072B6',
                            '#C346C2',
                            '#5961F9',
                            '#FD6585',
                            '#465EFB',
                            '#FFC600',
                            '#FA742B',
                            '#5151E5',
                            '#BB4E75',
                            '#FF52E5',
                            '#49C628',
                            '#00EAFF',
                            '#F067B4',
                            '#F067B4',
                            '#ff9a9e',
                            '#00f2fe',
                            '#4facfe',
                            '#f093fb',
                            '#6fa3ef',
                            '#bc99c4',
                            '#46c47c',
                            '#f9bb3c',
                            '#e8583d',
                            '#f68e5f',
                        ];
                        $friends_text = $this->options->JFriends;
                        if ($friends_text) {
                            $friends_arr = explode("\r\n", $friends_text);
                            if (count($friends_arr) > 0) {
                                for ($i = 0; $i < count($friends_arr); $i++) {
                                    $name = explode("||", $friends_arr[$i])[0];
                                    $url = explode("||", $friends_arr[$i])[1];
                                    $avatar = explode("||", $friends_arr[$i])[2];
                                    $desc = explode("||", $friends_arr[$i])[3];
                                    $friends[] = array("name" => trim($name), "url" => trim($url), "avatar" => trim($avatar), "desc" => trim($desc));
                                };
                            }
                        }
                        ?>
                        <?php if (sizeof($friends) > 0) : ?>
                            <h3 class="joe_mtitle"><span class="joe_mtitle__text">内页友链</span></h3>
                            <ul class="joe_detail__friends">
                                <?php foreach ($friends as $item) : ?>
                                    <li class="joe_detail__friends-item">
                                        <a class="contain" href="<?php echo $item['url']; ?>" target="_blank" rel="noopener noreferrer" style="background: <?php echo $friends_color[mt_rand(0, count($friends_color) - 1)] ?>">
                                            <span class="title"><?php echo $item['name']; ?></span>
                                            <div class="content">
                                                <div class="desc"><?php echo $item['desc']; ?></div>
                                                <img width="40" height="40" class="avatar lazyload" src="<?php _getAvatarLazyload(); ?>" data-src="<?php echo $item['avatar']; ?>" alt="<?php echo $item['name']; ?>" />
                                            </div>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

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