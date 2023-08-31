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

<?php if ($this->options->JFooter_Tabbar != NULL) : ?>
    <div class="joe_tabbar">
        <ul>
            <?php
            $txt = $this->options->JFooter_Tabbar;
            $string_arr = explode("\r\n", $txt);
            $long = count($string_arr);
            for ($i = 0; $i < $long; $i++) {
                $icon = explode("||", $string_arr[$i])[0];
                $name = explode("||", $string_arr[$i])[1];
                $url = explode("||", $string_arr[$i])[2];
            ?>
                <?php if ($txt) : ?>
                    <li class="joe_tabbar__item">
                        <a href="<?php $this->options->siteUrl(); ?><?php echo trim($url); ?>">
                            <i class="<?php echo trim($icon); ?> zm"></i><?php echo trim($name); ?>
                        </a>
                    </li>
                <?php endif; ?>
            <?php } ?>
        </ul>
    </div>
<?php endif; ?>

<div class="joe_container" style="position: relative;">
    <div class="joe_action">
        <?php if ($this->options->JAside_Switch === "on") : ?>
            <?php if ($this->is('post')) :  ?>
                <div class="joe_action_item home">
                    <a href="<?php $this->options->siteUrl(); ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M14 4.5V9C19.5228 9 24 13.4772 24 19C24 19.2727 23.9891 19.5428 23.9677 19.81C22.5055 17.0364 19.6381 15.119 16.313 15.0053L16 15H13.9999L14 19.5L6 12L14 4.5ZM8 4.5V7.237L2.92 12L7.999 16.761L8 19.5L0 12L8 4.5Z"></path>
                        </svg>
                    </a>
                </div>
            <?php else : ?>
                <div class="joe_action_item aside">
                    <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <path d="M501 63c53.08-4.358 91.177 19.177 118 46l164 164c44.075 44.076 107.119 84.174 104 169-1.24 33.711-12.668 58.603-28 80-24.34 33.968-61.825 65.825-92 96-31.555 31.555-63.808 62.808-94 93-42.452 42.453-87.313 112.558-180 100-64.548-8.745-95.751-53.752-134-92L226 586c-38.731-38.731-90.166-72.327-89-151 0.917-61.873 32.212-91.212 63-122l196-196c27.548-27.548 53.301-49.756 105-54z"></path>
                        <path d="M138 613c15.659-2.828 29.994 9.338 30 24 0.005 11.978-12.542 21.815-20 29-20.582 19.825-46.953 47.877-34 92 9.415 32.07 36.476 55.41 63 73 129.458 85.85 387.171 104.773 566 48 62.508-19.845 136.859-52.899 163-109 21.158-45.408-6.507-81.371-30-104-9.449-9.102-19.215-17.045-19-29 0.255-14.21 10.14-22.992 22-24 16.875-1.434 26.542 11.972 35 20 9.697 9.204 17.962 19.416 25 30 13.462 20.244 27.644 44.593 24 86-5.473 62.185-52.9 100.703-93 127-43.943 28.817-98.722 48.442-157 63-56.729 14.17-125.655 23-196 23-143.349 0-267.104-28.367-357-83-38.855-23.613-88.055-60.588-98-122-8.811-54.41 17.557-92.431 43-120 5.712-6.189 20.922-21.819 33-24z"></path>
                    </svg>
                </div>
            <?php endif; ?>
        <?php endif; ?>
        <div class="joe_action_item mode">
            <svg class="icon-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M14.5135 5.00008L17.1201 2.39348C17.5106 2.00295 18.1438 2.00295 18.5343 2.39348L22.777 6.63612C23.1675 7.02664 23.1675 7.65981 22.777 8.05033L18.9988 11.8285V21.0001C18.9988 21.5524 18.5511 22.0001 17.9988 22.0001H5.9988C5.44652 22.0001 4.9988 21.5524 4.9988 21.0001V11.8285L1.22063 8.05033C0.830103 7.65981 0.830103 7.02664 1.22063 6.63612L5.46327 2.39348C5.85379 2.00295 6.48696 2.00295 6.87748 2.39348L9.48408 5.00008H14.5135Z"></path>
            </svg>
            <svg class="icon-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M14.5135 5.00008L17.1201 2.39348C17.5106 2.00295 18.1438 2.00295 18.5343 2.39348L22.777 6.63612C23.1675 7.02664 23.1675 7.65981 22.777 8.05033L18.9988 11.8285V21.0001C18.9988 21.5524 18.5511 22.0001 17.9988 22.0001H5.9988C5.44652 22.0001 4.9988 21.5524 4.9988 21.0001V11.8285L1.22063 8.05033C0.830103 7.65981 0.830103 7.02664 1.22063 6.63612L5.46327 2.39348C5.85379 2.00295 6.48696 2.00295 6.87748 2.39348L9.48408 5.00008H14.5135ZM15.3419 7.00008H8.65566L6.17037 4.5148L3.34195 7.34323L6.9988 11.0001V20.0001H16.9988V11.0001L20.6557 7.34323L17.8272 4.5148L15.3419 7.00008Z"></path>
            </svg>
        </div>
        <div class="joe_action_item scroll">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path fill="none" d="M0 0h24v24H0z" />
                <path d="M5 13c0-5.088 2.903-9.436 7-11.182C16.097 3.564 19 7.912 19 13c0 .823-.076 1.626-.22 2.403l1.94 1.832a.5.5 0 0 1 .095.603l-2.495 4.575a.5.5 0 0 1-.793.114l-2.234-2.234a1 1 0 0 0-.707-.293H9.414a1 1 0 0 0-.707.293l-2.234 2.234a.5.5 0 0 1-.793-.114l-2.495-4.575a.5.5 0 0 1 .095-.603l1.94-1.832C5.077 14.626 5 13.823 5 13zm1.476 6.696l.817-.817A3 3 0 0 1 9.414 18h5.172a3 3 0 0 1 2.121.879l.817.817.982-1.8-1.1-1.04a2 2 0 0 1-.593-1.82c.124-.664.187-1.345.187-2.036 0-3.87-1.995-7.3-5-8.96C8.995 5.7 7 9.13 7 13c0 .691.063 1.372.187 2.037a2 2 0 0 1-.593 1.82l-1.1 1.039.982 1.8zM12 13a2 2 0 1 1 0-4 2 2 0 0 1 0 4z" />
            </svg>
        </div>
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