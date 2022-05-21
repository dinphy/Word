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
    <?php if ($this->options->JPrismTheme) : ?>
        <link rel="stylesheet" href="<?php $this->options->JPrismTheme() ?>">
    <?php else : ?>
        <link rel="stylesheet" href="https://lib.baomitu.com/prism/1.26.0/themes/prism.min.css">
    <?php endif; ?>
    <link rel="stylesheet" href="//at.alicdn.com/t/font_1159885_w154ju7gn8e.css">
    <script src="https://lib.baomitu.com/clipboard.js/2.0.10/clipboard.min.js"></script>
    <script src="https://lib.baomitu.com/prism/1.26.0/prism.min.js"></script>
    <script src="<?php $this->options->themeUrl('assets/js/joe.post_page.min.js'); ?>"></script>
</head>

<body>
    <div id="Joe">
        <?php $this->need('public/header.php'); ?>
        <?php $this->need('public/batten.php'); ?>
        <div class="joe_container">
            <div class="joe_main">
                <section class="joe_adaption">
                    <?php $this->comments()->to($comments); ?>
                    <div class="joe_dynamic">
                        <?php if ($this->user->hasLogin()) : ?>
                            <div class="respond" id="<?php $this->respondId(); ?>">
                                <div class="title">有什么新鲜事想告诉大家？</div>
                                <form method="post" id="joe_dynamic-form" action="<?php $this->commentUrl() ?>" data-type="text">
                                    <textarea name="text" class="OwO-textarea text joe_owo__target" id="textarea" autocomplete="off" rows="3" placeholder="随便说说吧..."></textarea>
                                    <div class="form-foot">
                                        <div class="owo joe_owo__contain"></div>
                                        <div class="tool">
                                            <span title="图片" onclick="document.getElementById('textarea').value+='![图片描述](图片地址)' ">
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
                                        </div>
                                        <button type="submit">发布
                                            <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" width="16" height="16">
                                                <path d="M832 896 192 896C156.656 896 128 867.344 128 832L128 192C128 156.656 156.656 128 192 128L416 128C433.664 128 448 142.336 448 160 448 177.68 433.664 192 416 192L192 192 192 832 832 832 832 608C832 590.336 846.336 576 864 576 881.68 576 896 590.336 896 608L896 832C896 867.344 867.344 896 832 896ZM864 448C846.32 448 832 433.68 832 416L832 234.544 435.728 630.816C423.856 642.688 404.608 642.688 392.736 630.816 380.864 618.944 380.864 599.696 392.736 587.824L788.56 192 608 192C590.32 192 576 177.68 576 160 576 142.32 590.32 128 608 128L864 128C881.68 128 896 142.32 896 160L896 416C896 433.68 881.68 448 864 448Z"></path>
                                            </svg>
                                        </button>
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
                                        <?php echo _parseReply($comments->content); ?>
                                    </div>
                                    <div class="foot">
                                        <div class="count">
                                            <div class="time"><?php $comments->dateWord(); ?></div>
                                        </div>
                                        <div class="action">
                                            <div class="item">
                                                <?php $suport = _getSupport($comments->coid) ?>
                                                <a class="support <?php echo $suport['icon'] ?>" data-coid="<?php echo $comments->coid ?>" href="javascript:void (0)">
                                                    <?php echo '' . $suport['count'] . '' . $suport['text'] ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php } ?>
                    </div>
                </section>
            </div>
        </div>
        <?php $this->need('public/footer.php'); ?>
    </div>
</body>

</html>