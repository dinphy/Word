<?php

/**
 * 留言
 * 
 * @package custom 
 * 
 **/

?>

<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <?php $this->need('public/include.php'); ?>
    <script src="https://cdn.bootcdn.net/ajax/libs/draggabilly/3.0.0/draggabilly.pkgd.min.js"></script>
    <script src="<?php $this->options->themeUrl('assets/js/joe.leaving.min.js'); ?>"></script>
</head>

<body>
    <div id="Joe">
        <?php $this->need('public/header.php'); ?>
        <?php $this->need('public/banner.php'); ?>
        <div class="joe_container">
            <div class="joe_main">
                <div class="joe_detail" data-cid="<?php echo $this->cid ?>">
                    <div class="joe_detail__leaving">
                        <?php if ($this->options->JReader_Ranking === 'on') : ?>
                            <ul class="joe_detail__leaving-ranking">
                                <?php
                                $time = time() - 60 * 60 * 24 * Helper::options()->JReader_Ranking_Time;
                                $mail = Helper::options()->JReader_Ranking_Mail;
                                $limit = Helper::options()->JReader_Ranking_Limit;
                                $counts = Typecho_Db::get()->fetchAll(
                                    Typecho_Db::get()
                                        ->select('COUNT(author) AS cnt', 'author', 'max(url) url', 'max(authorId) authorId', 'max(mail) mail')
                                        ->from('table.comments')
                                        ->where('created > ?', $time)
                                        ->where('status = ?', 'approved')
                                        ->where('type = ?', 'comment')
                                        ->where('mail != ?', $mail)
                                        ->group('author')
                                        ->order('cnt', Typecho_Db::SORT_DESC)
                                        ->limit($limit)
                                );
                                foreach ($counts as $count) {
                                    echo '
                                        <li class="item">
                                            <div class="user">
                                                <img src="' . _getAvatarByMail($count['mail'], false) . '">
                                                <a target="_blank" href=' . $count['url'] . '>' . $count['author'] . '</a>
                                                <span> ' . $count['cnt'] . ' 评论 </span>
                                            </div>
                                        </li>
                                    ';
                                }
                                ?>
                            </ul>
                        <?php endif; ?>
                        <?php $this->comments()->to($comments); ?>
                        <?php if ($comments->have()) : ?>
                            <ul class="joe_detail__leaving-list">
                                <?php while ($comments->next()) : ?>
                                    <li class="item">
                                        <div class="user">
                                            <img class="avatar lazyload" src="<?php _getAvatarLazyload(); ?>" data-src="<?php _getAvatarByMail($comments->mail) ?>" alt="用户头像" />
                                            <div class="nickname"><?php $comments->author(); ?></div>
                                            <div class="date"><?php $comments->date('Y/m/d'); ?></div>
                                        </div>
                                        <div class="wrapper">
                                            <div class="content"><?php _parseLeavingReply($comments->content); ?></div>
                                        </div>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        <?php else : ?>
                            <div class="joe_detail__leaving-none">暂无留言，期待第一个脚印。</div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php $this->need('public/comment.php'); ?>
            </div>
        </div>
        <?php $this->need('public/footer.php'); ?>
    </div>
</body>

</html>