<?php

/**
 * 动态
 * 
 * @package custom 
 * 
 **/

?>

<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <?php $this->need('public/include.php'); ?>
    <!-- 动态页面需要用到的CSS及JS -->
    <link rel="stylesheet" href="<?php $this->options->themeUrl('library/css/prism-tomorrow.min.css'); ?>">
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
                <?php $this->comments()->to($comments); ?>
                <div class="joe_dynamic">
                    <?php if ($this->user->hasLogin()) : ?>
                        <div class="respond" id="<?php $this->respondId(); ?>">
                            <div class="title">有什么新鲜事想告诉大家？</div>
                            <form method="post" id="joe_dynamic-form" action="<?php $this->commentUrl() ?>" data-type="text">
                                <textarea name="text" class="OwO-textarea" autocomplete="off" rows="3" placeholder="发表您的新鲜事儿..."></textarea>
                                <div class="form-foot">
                                    <button type="submit">立即发表</button>
                                </div>
                            </form>

                        </div>
                    <?php endif; ?>

                    <?php $comments->listComments(['commentUrl' => $this->commentUrl, 'class' => $this]); ?>

                    <?php
                    $comments->pageNav(
                        '<svg class="icon icon-prev" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="12" height="12"><path d="M822.272 146.944l-396.8 396.8c-19.456 19.456-51.2 19.456-70.656 0-18.944-19.456-18.944-51.2 0-70.656l396.8-396.8c19.456-19.456 51.2-19.456 70.656 0 18.944 19.456 18.944 45.056 0 70.656z"/><path d="M745.472 940.544l-396.8-396.8c-19.456-19.456-19.456-51.2 0-70.656 19.456-19.456 51.2-19.456 70.656 0l403.456 390.144c19.456 25.6 19.456 51.2 0 76.8-26.112 19.968-51.712 19.968-77.312.512zm-564.224-63.488c0-3.584 0-7.68.512-11.264h-.512v-714.24h.512c-.512-3.584-.512-7.168-.512-11.264 0-43.008 21.504-78.336 48.128-78.336s48.128 34.816 48.128 78.336c0 3.584 0 7.68-.512 11.264h.512v714.24h-.512c.512 3.584.512 7.168.512 11.264 0 43.008-21.504 78.336-48.128 78.336s-48.128-35.328-48.128-78.336z"/></svg>',
                        '<svg class="icon icon-next" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="12" height="12"><path d="M822.272 146.944l-396.8 396.8c-19.456 19.456-51.2 19.456-70.656 0-18.944-19.456-18.944-51.2 0-70.656l396.8-396.8c19.456-19.456 51.2-19.456 70.656 0 18.944 19.456 18.944 45.056 0 70.656z"/><path d="M745.472 940.544l-396.8-396.8c-19.456-19.456-19.456-51.2 0-70.656 19.456-19.456 51.2-19.456 70.656 0l403.456 390.144c19.456 25.6 19.456 51.2 0 76.8-26.112 19.968-51.712 19.968-77.312.512zm-564.224-63.488c0-3.584 0-7.68.512-11.264h-.512v-714.24h.512c-.512-3.584-.512-7.168-.512-11.264 0-43.008 21.504-78.336 48.128-78.336s48.128 34.816 48.128 78.336c0 3.584 0 7.68-.512 11.264h.512v714.24h-.512c.512 3.584.512 7.168.512 11.264 0 43.008-21.504 78.336-48.128 78.336s-48.128-35.328-48.128-78.336z"/></svg>',
                        1,
                        '...',
                        array(
                            'wrapTag' => 'ul',
                            'wrapClass' => 'joe_pagination',
                            'itemTag' => 'li',
                            'textTag' => 'a',
                            'currentClass' => 'active',
                            'prevClass' => 'prev',
                            'nextClass' => 'next'
                        )
                    );
                    ?>

                    <?php
                    if ($this->user->hasLogin()) {
                        $GLOBALS['isLogin'] = true;
                    } else {
                        $GLOBALS['isLogin'] = false;
                    }
                    function threadedComments($comments, $options)
                    {
                        if ($comments->authorId) {
                            if ($comments->authorId == $comments->ownerId) {
                                $commentClass = 'comment-by-author';
                            }
                        }
                        $db = Typecho_Db::get();

                        $enable_comment = $options->class->fields->enable_comment ? true : false;
                        if (empty($options->class->fields->enable_comment)) $enable_comment = true;
                        if ($options->class->fields->enable_comment == '0') {
                            $enable_comment = false;
                        }
                    ?>
                        <li id="li-<?php $comments->theId(); ?>">
                            <div class="tail"></div>
                            <div class="head-light"></div>
                            <div class="head"></div>
                            <div class="comment-parent">
                                <div class="title">
                                    <div class="desc">
                                        <div class="author"><?php $comments->author(); ?><i>说：</i></div>
                                    </div>
                                </div>
                                <div class="content">
                                    <?php echo $comments->content; ?>
                                </div>
                                <div class="foot">
                                    <div class="count">
                                        <div class="time"><?php $comments->dateWord(); ?></div>
                                    </div>
                                    <div class="action">
                                        <div class="item">
                                            <?php $suport = _getSupport($comments->coid) ?>
                                            <i class="fa <?php echo $suport['icon'] ?>">
                                                <a class="support" data-coid="<?php echo $comments->coid ?>" href="javascript:void (0)">
                                                    <?php echo '(' . $suport['count'] . ')' . $suport['text'] ?>
                                                </a>
                                            </i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php $this->need('public/footer.php'); ?>
    </div>
</body>

</html>