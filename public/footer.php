<footer class="joe_footer">
    <div class="joe_container link">
        <?php if ($this->is('index')) : ?>
            <div class="item">
                <strong>友情链接：</strong>
                <?php
                $friends = [];
                $friends_text = $this->options->JFriendsIndex;
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
                    <?php foreach ($friends as $item) : ?>
                        <a class="contain" href="<?php echo $item['url']; ?>" target="_blank" rel="noopener noreferrer">
                            <span class="title"><?php echo $item['name']; ?></span>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
                <a class="contain" href="<?php $this->options->siteUrl(); ?>links.html" target="_blank" rel="noopener noreferrer">
                    <span class="title"> 更多&nbsp;&gt;</span>
                </a>
            </div>
        <?php endif; ?>
    </div>
    <div class="joe_container">
        <div class="item">
            <?php $this->options->JFooter_Left() ?>
        </div>
        <?php if ($this->options->JBirthDay) : ?>
            <div class="item run">
                <span>建站 <strong class="joe_run__day">00</strong> 天 <strong class="joe_run__hour">00</strong> 时 <strong class="joe_run__minute">00</strong> 分 <strong class="joe_run__second">00</strong> 秒</span>
            </div>
        <?php endif; ?>
        <div class="item">
            <?php $this->options->JFooter_Right() ?>
        </div>
    </div>
</footer>

<div class="joe_action">
    <div class="joe_action_item scroll">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path fill="none" d="M0 0h24v24H0z" />
            <path d="M5 13c0-5.088 2.903-9.436 7-11.182C16.097 3.564 19 7.912 19 13c0 .823-.076 1.626-.22 2.403l1.94 1.832a.5.5 0 0 1 .095.603l-2.495 4.575a.5.5 0 0 1-.793.114l-2.234-2.234a1 1 0 0 0-.707-.293H9.414a1 1 0 0 0-.707.293l-2.234 2.234a.5.5 0 0 1-.793-.114l-2.495-4.575a.5.5 0 0 1 .095-.603l1.94-1.832C5.077 14.626 5 13.823 5 13zm1.476 6.696l.817-.817A3 3 0 0 1 9.414 18h5.172a3 3 0 0 1 2.121.879l.817.817.982-1.8-1.1-1.04a2 2 0 0 1-.593-1.82c.124-.664.187-1.345.187-2.036 0-3.87-1.995-7.3-5-8.96C8.995 5.7 7 9.13 7 13c0 .691.063 1.372.187 2.037a2 2 0 0 1-.593 1.82l-1.1 1.039.982 1.8zM12 13a2 2 0 1 1 0-4 2 2 0 0 1 0 4z" />
        </svg>
    </div>
</div>

<style>
    .mouse-cursor {
        position: fixed;
        left: 0;
        top: 0;
        pointer-events: none;
        border-radius: 50%;
        -webkit-transform: translateZ(0);
        transform: translateZ(0);
        visibility: hidden
    }

    .cursor-inner {
        margin-left: -3px;
        margin-top: -3px;
        width: 6px;
        height: 6px;
        z-index: 10000001;
        background: #ffa9a4;
        -webkit-transition: width .3s ease-in-out, height .3s ease-in-out, margin .3s ease-in-out, opacity .3s ease-in-out;
        transition: width .3s ease-in-out, height .3s ease-in-out, margin .3s ease-in-out, opacity .3s ease-in-out
    }

    .cursor-inner.cursor-hover {
        margin-left: -18px;
        margin-top: -18px;
        width: 36px;
        height: 36px;
        background: #ffa9a4;
        opacity: .3
    }

    .cursor-outer {
        margin-left: -15px;
        margin-top: -15px;
        width: 30px;
        height: 30px;
        border: 2px solid #ffa9a4;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        z-index: 10000000;
        opacity: .5;
        -webkit-transition: all .08s ease-out;
        transition: all .08s ease-out
    }

    .cursor-outer.cursor-hover {
        opacity: 0
    }

    .main-wrapper[data-magic-cursor=hide] .mouse-cursor {
        display: none;
        opacity: 0;
        visibility: hidden;
        position: absolute;
        z-index: -1111
    }
</style>

<?php if (!_isMobile()) : ?>
    <div class="mouse-cursor cursor-outer"></div>
    <div class="mouse-cursor cursor-inner"></div>
<?php endif; ?>

<script>
    <?php
    $cookie = Typecho_Cookie::getPrefix();
    $notice = $cookie . '__typecho_notice';
    $type = $cookie . '__typecho_notice_type';
    ?>
    <?php if (isset($_COOKIE[$notice]) && isset($_COOKIE[$type]) && ($_COOKIE[$type] == 'success' || $_COOKIE[$type] == 'notice' || $_COOKIE[$type] == 'error')) : ?>
        Qmsg.info("<?php echo preg_replace('#\[\"(.*?)\"\]#', '$1', $_COOKIE[$notice]); ?>！")
    <?php endif; ?>
    <?php
    Typecho_Cookie::delete('__typecho_notice');
    Typecho_Cookie::delete('__typecho_notice_type');
    ?>
    console.log("%c页面加载耗时：<?php _endCountTime(); ?> | Theme By Joe", "color:#fff; background: linear-gradient(270deg, #986fee, #8695e6, #68b7dd, #18d7d3); padding: 8px 15px; border-radius: 0 15px 0 15px");
    <?php $this->options->JCustomScript() ?>
</script>

<?php $this->options->JCustomBodyEnd() ?>

<?php $this->footer(); ?>