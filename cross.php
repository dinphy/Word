<?php

/**
 * 说说
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
                    <?php $this->comments()->to($comments); ?>

                    <div class="joe_cross" id="comments">
                        <h3 class="joe_cross__title">
                            <span><i class="zm zm-pinglun-1"></i> 言之有理</span>
                            <span><?php $this->commentsNum(); ?> 言，<?php _getViews($this); ?> 阅</span>
                        </h3>

                        <div id="<?php $this->respondId(); ?>" class="joe_cross__respond" style="display: <?php if (!$this->user->hasLogin()) : ?>none<?php endif; ?>">
                            <form method="post" class="joe_cross__respond-form" action="<?php $this->commentUrl() ?>" data-type="text">
                                <div class="body">
                                    <textarea class="text joe_owo__target" id="textarea" name="text" value="" autocomplete="new-password" placeholder="<?php if ($this->user->hasLogin()) : ?>说点儿什么吧<?php else : ?>我也说一句..<?php endif; ?>"></textarea>
                                </div>
                                <?php if ($this->user->hasLogin()) : ?>
                                <?php else : ?>
                                    <div class="head">
                                        <div class="list">
                                            <input id="author" type="text" value="<?php $this->user->hasLogin() ? $this->user->screenName() : $this->remember('author') ?>" autocomplete="off" name="author" maxlength="16" placeholder="昵称:" />
                                        </div>
                                        <div class="list">
                                            <input id="mail" type="text" value="<?php $this->user->hasLogin() ? $this->user->mail() : $this->remember('mail') ?>" autocomplete="off" name="mail" placeholder="邮箱:" />
                                        </div>
                                        <div class="list">
                                            <input type="text" autocomplete="off" name="url" placeholder="网址（非必填）" />
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="foot">
                                    <div class="owo joe_owo__contain"></div>
                                    <div class="tool">
                                        <span title="图片" onclick="document.getElementById('textarea').value+='![描述](地址)' ">
                                            <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" width="16" height="16">
                                                <path d="M960.2 751.5H868v-92.7h-46.4v92.7h-92.2V798h92.2v91.6H868V798h92.2z"></path>
                                                <path d="M110.5 713l153.2 32.3 315.1-225.2 242.8 73.1v34.3H868V159.7H64v700.7h627.6V814H110.5V713z m711.1-506.8v338.5l-251.3-75.6-317 226.6-142.8-30.1V206.2h711.1z"></path>
                                                <path d="M308.3 510.8c65.9 0 119.6-53.7 119.6-119.6 0-65.9-53.7-119.6-119.6-119.6-65.9 0-119.6 53.7-119.6 119.6 0 65.9 53.7 119.6 119.6 119.6z m0-192.8c40.3 0 73.1 32.8 73.1 73.1s-32.8 73.2-73.1 73.2-73.1-32.8-73.1-73.2S268 318 308.3 318z"></path>
                                            </svg>
                                        </span>
                                        <span title="链接" onclick="document.getElementById('textarea').value+='[](https://)' ">
                                            <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" width="16" height="16">
                                                <path d="M910.496 213.536C804.16 82.208 611.488 61.952 480.128 168.32l-100.768 81.6 50.336 62.176 100.768-81.6a225.984 225.984 0 1 1 284.448 351.264l-107.968 87.424 50.336 62.176 107.968-87.424a305.984 305.984 0 0 0 45.248-430.4zM516.352 823.552a225.984 225.984 0 1 1-284.448-351.264l110.976-89.856-50.336-62.176-110.976 89.856C50.24 516.448 29.984 709.152 136.32 840.48c106.336 131.328 299.04 151.584 430.368 45.248l105.12-85.12-50.336-62.176-105.12 85.12z"></path>
                                                <path d="M676.16 353.28l51.232 61.44-343.552 286.304-51.2-61.44z"></path>
                                            </svg>
                                        </span>
                                        <span title="私语" class="privacy">
                                            <svg class="unlock" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16">
                                                <path fill="none" d="M0 0h24v24H0z" />
                                                <path d="M7 10h13a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V11a1 1 0 0 1 1-1h1V9a7 7 0 0 1 13.262-3.131l-1.789.894A5 5 0 0 0 7 9v1zm-2 2v8h14v-8H5zm5 3h4v2h-4v-2z" />
                                            </svg>
                                            <svg class="lock" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16">
                                                <path fill="none" d="M0 0h24v24H0z" />
                                                <path d="M19 10h1a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V11a1 1 0 0 1 1-1h1V9a7 7 0 1 1 14 0v1zM5 12v8h14v-8H5zm6 2h2v4h-2v-4zm6-4V9A5 5 0 0 0 7 9v1h10z" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="submit">
                                        <span class="cancle joe_cross__cancle">取消</span>
                                        <button type="submit">
                                            <?php if ($this->user->hasLogin()) : ?>发表<?php else : ?>确定<?php endif; ?>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?php if ($comments->have()) : ?>
                            <?php $comments->listComments(); ?>
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
                        <?php endif; ?>
                    </div>

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
                    ?>
                        <li class="comment-list__item">
                            <div class="tail"></div>
                            <div class="headline-light"></div>
                            <div class="headline"></div>
                            <div class="comment-list__item-contain" id="<?php $comments->theId(); ?>">
                                <div class="term">
                                    <div class="content">
                                        <div class="user">
                                            <span class="author"><?php $comments->author(); ?><?php _getParentReply($comments->parent) ?><i>说：</i></span>
                                        </div>
                                        <div class="substance">
                                            <?php
                                            $db = Typecho_Db::get();
                                            $smyk = $db->fetchRow($db->select('mail')->from('table.comments')->where('coid = ?', $comments->parent)->limit(1));
                                            $smhf = $comments->mail;
                                            $user = Typecho_Widget::widget('Widget_User');
                                            if (strpos($comments->content, '私语#') == true) {
                                                $ykmail = Typecho_Cookie::get('__typecho_remember_mail');
                                                if ($smhf == $user->mail or $smhf == $ykmail or $user->group == 'administrator' or $smyk['mail'] == $ykmail and !empty($smyk['mail'])) {
                                                    _parseCommentReply(str_replace('私语#', '', $comments->content));
                                                } else {
                                                    echo '<div class="secret">此条为私语，发布者可见</div>';
                                                }
                                            } else {
                                                _parseCommentReply($comments->content);
                                            }
                                            ?>
                                            <div class="handle">
                                                <time class="date" datetime="<?php $comments->dateWord(); ?>"><?php $comments->dateWord(); ?></time>
                                                <?php $suport = _getSupport($comments->coid) ?>
                                                <a class="support <?php echo $suport['icon'] ?>" data-coid="<?php echo $comments->coid ?>" href="javascript:void (0)">
                                                    <?php echo '' . $suport['count'] . '' . $suport['text'] ?>
                                                </a>
                                                <span class="reply joe_cross__reply" data-id="<?php $comments->theId(); ?>" data-coid="<?php $comments->coid(); ?>">
                                                    <i class="zm zm-liu-yan"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if ($comments->children) : ?>
                                <div class="comment-list__item-children">
                                    <?php $comments->threadedComments($options); ?>
                                </div>
                            <?php endif; ?>
                        </li>
                    <?php } ?>
                </section>
            </div>
        </div>
        <?php $this->need('public/footer.php'); ?>
    </div>
</body>

</html>