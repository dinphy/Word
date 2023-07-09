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
                <?php
                $this->comments()->to($comments);
                $is_login = $this->user->hasLogin();
                ?>
                <div class="joe_cross" id="comments">
                    <h3 class="joe_cross__title">
                        <span><i class="zm zm-pinglun-1"></i> 言之有理</span>
                        <span><?php $this->commentsNum(); ?> 言，<?php _getViews($this); ?> 阅</span>
                    </h3>
                    <div id="<?php $this->respondId(); ?>" class="joe_cross__respond <?php echo $is_login ? 'active' : ''; ?>">
                        <form method="post" class="joe_cross__respond-form" action="<?php $this->commentUrl() ?>" data-type="text">
                            <div class="body">
                                <?php if ($is_login) : ?>
                                    <img class="avatar lazyload" src="<?php _getAvatarLazyload() ?>" data-src="<?php _getAvatarByMail($this->authorId ? $this->author->mail : $this->user->mail); ?>" />
                                <?php else : ?>
                                    <?php if (!empty($this->remember('mail', true))) : ?>
                                        <img class="avatar lazyload" src="<?php _getAvatarByMail($this->remember('mail', true)); ?>">
                                    <?php else : ?>
                                        <img class="avatar lazyload" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFAAAABQCAMAAAC5zwKfAAAC/VBMVEUAAAD87++g2veg2ff++fmg2feg2fb75uag2fag2fag2fag2fag2feg2vah2fef2POg2feg2vag2fag2fag2fag2fag2vah2fag2vb7u3Gg2fag2fb0tLSg2fb3vHig2ff0s7P2wMD0s7Og2fXzs7Pzs7Of2fWh2veh2vf+/v7///+g2vf9/f2e1/ag2fSg2/mg3PT3r6+30tSh2fb+0Hj76ev4u3P6u3K11dr60H3UyKr+/v766On80Hz49vj2xcXm5u3z0IfUx6v2u7vazKTn0pfi6PKg2fbztLT///+g2faf2fag2vf///+g2feg2fe63O6l3vb///+g2fb80Kb8um+x1uD80Hv86er+0Hf73tb0s7P10YX/0Hiq2Or+/v6g2vbe0qL60YT+/v6y1NzuvoS20dSz09ru0Y6z3fTI1MDbxp+h2fag2fb////O4PDuv4XA3/LOz7bh06Du0o/1t7ex3PP+/v6h2ffSzrLdxZ3s5u3/2qag2fb7+/z40NCg2fb9/f2f2PWf2PX0tLT+/v70s7P+/v7M7Pyf1/b1s7P////zs7P0tbWZ2fL20dH+/v7+0Hep2vWl2O+x2/P+/v641tbI1b7C1cf8xpCz0tj1wMD1x8fTya392KPo0ZT56ez4vXbN1bn26Orh0p3x8/jbxZ/CzcT8xo7327DV1tHt0Y7u8/n759661tLyy6L049710IK8z870s7PX1a3xvX/y6OzA1cvBzsXI1cG30dP+38D73Mn/0oX3ysrpwYzv5+zo0pXv5+zH4PDW4e/n5O3+/v786+vN4vP9/f30s7P9/f2f2fSu0er//Pzgu8X///+4zOD////z8/OW0vCq1f+g2fb86er0s7P+z3f8um/+/v72xcX948ym2O/85+T839D8v3v86ej54eH828X+3Kz80qz8w4T8u3Oq2/Wq1ees2Ob64OCx1d/F2N785tv529v94MH82b/1vb382bj93LD91pf91ZH+04b+0X2p2er+2aH8zJ78yZX8yJU3IRXQAAAA1nRSTlMA8PbEz5vhv1X6Y0wzrX9A8/DJt6mHsnH98uzo4NzY19DJwKGAf3tpZmVVSD86LysgIP787ejn4uHf29jW1M3MysnHxcK+vbywn5ONg39wW0AlIBr8+/f29PTx7+rm5eTj4+Df29nX1tLR0dHQz8zKyMXFxcPCwL+9u7u5t7KsqaObmH1wbWBcVVJQSUAwFA34+Pbz8vHx8O7u7ero6Ofl4ODf3t7d3Nvb2djY19fU1NLS0M/NzcrJycjHx8LCwcHAwL68uraxr5SSkId4X1NTNTItFREGybAGmgAABQNJREFUWMOl13N0HEEcwPFp2lzTpElq20jTpLZt27Zt27Zt27b7m9vbpqlt+3Xvdvd2ZncWufv+e+993t7saJFJ0wL8M1UKjJ4yTpyU0QMrZfIPmIa8qLZ/edBU3r+2Z1pY5qGg09DMYVHmsicCwxJljxIXnABMSxBsmcsxAiw1IoclLtQXLOcbau75tYAo1MLPzMsEUSyTsZceolx6Iy86eFB0fS8ZeFQyPS85eFhythcfPC4+y0sIXpRQ6yUGr0qs9vzBy/xpLwC8LsDghXj/YvzApJdgHrmsB4BuzfaXKVkwT6u6+VL1KNXOEBygeNVBrwJlm3LOlj13OEtV6r6BWN10Cc/rwEl9rOMQy1fIYFGbTZk9Mzm5iEYOubYFTKdOPPa/LckpvccP3WLSUnpgPOkIAVb1CnJEGP9xKHXWE8VDpgowekt5PzD+5CDSG8gqLrALaHvdhCP7hnHkQ1Jcyga7OL3YwGgNR/UUY1yHBOvmYouxdbatBRzdRwF84CBrq7+NpQZN91vR3s9HWOifw3wYUyOUE7St4uh+Y6x5xHzALCeaCNo2q8AI7OoZJbJHcSLKDJp+cepXIhb5nATXMcHMKAg0zedUc0buATl1kjLBIOQLmlqqn08RXxAic+PxRYyL5XLS+4rJnhD/+hXzIsraGYhV8j0C00U+kx7yxd937P3BBprqu5fw10dY04Mnn748exKJMRO0oVhA16l3h40u8ef3L5HYqO2DetXTgLGQD1CVFajDOCIi4j02a6HDkb+NGvRR3ZA4Z0OwlcQtd5Hm3pRSO2GOWvKKiLNRNXlSoq7kLsi5arjVCniEuXt3pU68Thxn/T9vEMGVqpOPWinysVTUgrfDIdVetVKygFIeGTxhDm6SwYEUmIU8AZpxUgN7mnqnIL8EHqfPAPKmflDy8syGwSZe3n4wSAJTUfd36ibXWwJPAtiKGINnANo4pHKTdzrqLrxT9PqAUD9D7ywIHUgqgu2omzF5qDR0eWXB1WkDb7W4XneJw1iGPFLIu9c2J9dU+DkJOCunP4A2EGu/1wn2UN+/RoNYH2G+9PIRPBGEnnnZXom4irA+lSAeArnRiHF1SOIe5DklGNyK7kCV6+2r+8qkYX2C5iZ2yI6DG9BcgxIvLXyYBtNbpAASZDllAj3a130WGBWMpAIpkNpyEwTVrnmh3Ja1xYoVG3atFgqtVl7fC2R/9vj4EFz2kKojeaL+VW/FrhTH/NNnFBP0rZExBq/pfMabVeKyvFFIKcxGgNIYpr6asbFdAh9/XlxRBmPaG2cMDdR6tjACJDexONLjXU9ht8vgG3sK1NoN2u27p1bTgFkQVaAK9Btutysg/jA8K6+AQuP8NG+ErqaNAoOz3ZNBORpMN5YWbTWRKvfvcV0erwKbt6bBvvz4YPrLUVNCBQzKxtPg48/pkBrkswWRd2tGCWQwdY3CIki9FBoszfOFa8R1z1fEzFecNlC9Iq8C8YfHvAbkR1ZzH3U6VRaveJN5AqSiQX6yuJVWRrq5RiWgmwJG09bI7iwtL9QtQLwFG5QYIN54XgbZKSCf1QaxsiPDYkPl/tbBYVfi3UEm3Z3AWwfnTkDmjbUEFuddVUUWylrYKtg8K7LU7cszLIEXpyOr1arILzEGj/HnQswUmgyZeimNnpZmTHjIDeRB4WMYZoVx4ciLwqdMypChQroUwmOlq5Ahw6QpZuP2HxxXd11eM9wcAAAAAElFTkSuQmCC">
                                    <?php endif; ?>
                                <?php endif; ?>
                                <textarea class="text joe_owo__target" id="textarea" name="text" value="" rows="3" autocomplete="new-password" placeholder="说点什么吧.."></textarea>
                            </div>
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
                                    <button type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path d="M1.94631 9.31555C1.42377 9.14137 1.41965 8.86034 1.95706 8.6812L21.0433 2.31913C21.5717 2.14297 21.8748 2.43878 21.7268 2.95706L16.2736 22.0433C16.1226 22.5718 15.8179 22.5901 15.5946 22.0877L12.0002 14.0002L18.0002 6.00017L10.0002 12.0002L1.94631 9.31555Z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <?php if (!$is_login) : ?>
                                <div class="head">
                                    <div class="list">
                                        <input id="mail" type="text" value="<?php echo $is_login ? $this->user->mail() : $this->remember('mail') ?>" autocomplete="off" name="mail" placeholder="邮箱:" />
                                    </div>
                                    <div class="list">
                                        <input id="author" type="text" value="<?php echo $is_login ? $this->user->screenName() : $this->remember('author') ?>" autocomplete="off" name="author" maxlength="16" placeholder="昵称:" />
                                        <input type="text" autocomplete="off" name="url" placeholder="网址（非必填）" />
                                    </div>
                                </div>
                            <?php endif; ?>
                        </form>
                    </div>
                    <?php if ($comments->have()) : ?>
                        <?php $comments->listComments(); ?>
                        <?php $comments->pageNav(
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
                                    <div class="handle">
                                        <?php if ($comments->parent) {
                                            $comments->author();
                                        } ?>
                                        <time class="date" datetime="<?php $comments->dateWord(); ?>"><?php $comments->dateWord(); ?></time>
                                        <?php $suport = _getSupport($comments->coid) ?>
                                    </div>
                                    <div class="substance">
                                        <?php secretComment($comments); ?>
                                        <div class="handle" style="padding-top: 10px;">
                                            <div class="reply">
                                                <span class="joe_cross__reply" data-id="<?php $comments->theId(); ?>" data-coid="<?php $comments->coid(); ?>">回复</span>
                                            </div>
                                            <?php $suport = _getSupport($comments->coid) ?>
                                            <a class="support <?php echo $suport['icon'] ?>" data-coid="<?php echo $comments->coid ?>" href="javascript:void (0)">
                                                <?php echo '' . $suport['count'] . '' . $suport['text'] ?>
                                            </a>
                                            <?php if ($comments->children) : ?>
                                                <div class="joe_cross__panel-header"><?php echo $comments->children ? _commentNum($comments) : ''; ?><span class="open">展开 ▽</span></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if ($comments->children) : ?>
                            <div class="joe_cross__panel">
                                <div class="joe_cross__panel-body comment-list__item-children">
                                    <?php $comments->threadedComments($options); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </li>
                <?php } ?>
            </div>
        </div>
        <?php $this->need('public/footer.php'); ?>
    </div>
</body>

</html>