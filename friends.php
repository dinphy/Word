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
                        <div class="joe_detail__tabs">
                            <div class="item active">首页优选</div>
                            <div class="item">友情链接</div>
                        </div>
                        <?php
                        $friends = [];
                        $friends_index = [];
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
                        function parseFriendsData($data, &$resultArray)
                        {
                            if ($data) {
                                $lines = explode("\r\n", $data);
                                foreach ($lines as $line) {
                                    list($name, $url, $avatar, $desc) = explode("||", $line);
                                    $resultArray[] = [
                                        "name" => trim($name),
                                        "url" => trim($url),
                                        "avatar" => trim($avatar),
                                        "desc" => trim($desc)
                                    ];
                                }
                            }
                        }
                        parseFriendsData($this->options->JFriends, $friends);
                        parseFriendsData($this->options->JFriendsIndex, $friends_index);
                        ?>
                        <?php if (!empty($friends_index)) : ?>
                            <ul class="joe_detail__friends active">
                                <?php foreach ($friends_index as $iitem) : ?>
                                    <li class="joe_detail__friends-item">
                                        <a class="contain" href="<?php echo $iitem['url']; ?>" target="_blank" rel="noopener noreferrer" style="background: <?php echo $friends_color[array_rand($friends_color)]; ?>">
                                            <span class="title">
                                                <?php echo $iitem['name']; ?>
                                                <img width="40" height="40" class="avatar lazyload" src="<?php _getAvatarLazyload(); ?>" data-src="<?php echo $iitem['avatar']; ?>" alt="<?php echo $iitem['name']; ?>" />
                                            </span>
                                            <div class="content">
                                                <div class="desc"><?php echo $iitem['desc']; ?></div>
                                            </div>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                        <?php if (!empty($friends)) : ?>
                            <ul class="joe_detail__friends">
                                <?php foreach ($friends as $item) : ?>
                                    <li class="joe_detail__friends-item">
                                        <a class="contain" href="<?php echo $item['url']; ?>" target="_blank" rel="noopener noreferrer" style="background: <?php echo $friends_color[array_rand($friends_color)]; ?>">
                                            <span class="title">
                                                <?php echo $item['name']; ?>
                                                <img width="40" height="40" class="avatar lazyload" src="<?php _getAvatarLazyload(); ?>" data-src="<?php echo $item['avatar']; ?>" alt="<?php echo $item['name']; ?>" />
                                            </span>
                                            <div class="content">
                                                <div class="desc"><?php echo $item['desc']; ?></div>
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