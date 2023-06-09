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
            <div class="joe_action_item aside">
                <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <path d="M598.698667 196.488533a85.333333 85.333333 0 0 1 84.9408 77.0048l0.273066 3.754667 0.119467 4.437333v109.5168a41.4208 41.4208 0 0 1-82.3808 6.314667l-0.341333-2.747733-0.170667-3.584v-109.5168a3.003733 3.003733 0 0 0-0.8704-2.030934l-0.341333-0.238933-1.2288-0.136533H247.6032a3.072 3.072 0 0 0-2.065067 0.853333l-0.238933 0.341333-0.136533 1.2288v459.9808c0 0.853333 0.4608 1.655467 0.853333 2.030934l0.3584 0.238933 1.2288 0.136533h65.826133a41.4208 41.4208 0 0 1 41.386667 39.406934 41.437867 41.437867 0 0 1-35.037867 42.837333l-2.781866 0.375467-3.566934 0.170666h-65.826133a85.333333 85.333333 0 0 1-84.9408-77.021866l-0.290133-3.754667-0.1024-4.437333V281.685333a85.282133 85.282133 0 0 1 77.141333-84.804266l3.754667-0.290134 4.437333-0.1024H598.698667z m219.374933 458.752a41.4208 41.4208 0 0 1 41.693867 39.389867 41.437867 41.437867 0 0 1-35.328 42.9056l-2.798934 0.341333-3.515733 0.136534-272.776533 0.017066 12.151466 12.305067c13.9264 14.216533 15.598933 36.010667 4.778667 52.053333l-1.809067 2.474667-2.013866 2.372267a41.5232 41.5232 0 0 1-54.749867 5.632l-2.4064-1.8432-2.816-2.56-71.560533-72.3968a41.5744 41.5744 0 0 1-3.3792-3.857067l-0.341334-0.4608-0.802133-0.477867a41.335467 41.335467 0 0 1-18.773333-37.205333l0.273066-2.952533 0.512-2.9696a41.4208 41.4208 0 0 1 34.065067-32.3584l3.037867-0.392534 3.584-0.170666h372.974933z m-113.425067-204.373333a41.489067 41.489067 0 0 1 54.596267-5.802667l2.679467 2.0992 2.816 2.56L836.266667 522.0864c1.211733 1.211733 2.338133 2.5088 3.413333 3.874133l0.324267 0.4608 0.8192 0.494934a41.335467 41.335467 0 0 1 18.773333 37.205333l-0.273067 2.952533-0.512 2.9696a41.4208 41.4208 0 0 1-34.065066 32.3584l-3.037867 0.392534-3.584 0.170666H445.098667a41.4208 41.4208 0 0 1-41.3696-39.424 41.437867 41.437867 0 0 1 35.037866-42.837333l2.7648-0.3584 3.584-0.170667 272.759467-0.034133-12.117333-12.2368a41.352533 41.352533 0 0 1-4.949334-52.1728l1.826134-2.474667 2.030933-2.389333z"></path>
                    <path d="M758.3232 502.3232a42.666667 42.666667 0 0 1 58.094933-2.082133l2.235734 2.082133 30.72 30.72a42.666667 42.666667 0 0 1-58.112 62.4128l-2.218667-2.082133-30.72-30.72a42.666667 42.666667 0 0 1 0-60.330667zM413.559467 669.559467a42.666667 42.666667 0 0 1 58.112-2.082134l2.218666 2.082134 30.72 30.72a42.666667 42.666667 0 0 1-58.094933 62.4128l-2.235733-2.082134-30.72-30.72a42.666667 42.666667 0 0 1 0-60.330666z"></path>
                </svg>
            </div>
        <?php endif; ?>
        <div class="joe_action_item mode">
            <svg class="icon-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M12 21.9966C6.47715 21.9966 2 17.5194 2 11.9966C2 6.47373 6.47715 1.99658 12 1.99658C17.5228 1.99658 22 6.47373 22 11.9966C22 17.5194 17.5228 21.9966 12 21.9966ZM12 19.9966C16.4183 19.9966 20 16.4149 20 11.9966C20 7.5783 16.4183 3.99658 12 3.99658C7.58172 3.99658 4 7.5783 4 11.9966C4 16.4149 7.58172 19.9966 12 19.9966ZM12 17.9966V5.99658C15.3137 5.99658 18 8.68287 18 11.9966C18 15.3103 15.3137 17.9966 12 17.9966Z"></path>
            </svg>
            <svg class="icon-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M12 21.9966C6.47715 21.9966 2 17.5194 2 11.9966C2 6.47373 6.47715 1.99658 12 1.99658C17.5228 1.99658 22 6.47373 22 11.9966C22 17.5194 17.5228 21.9966 12 21.9966ZM12 19.9966C16.4183 19.9966 20 16.4149 20 11.9966C20 7.5783 16.4183 3.99658 12 3.99658C7.58172 3.99658 4 7.5783 4 11.9966C4 16.4149 7.58172 19.9966 12 19.9966ZM7.00035 15.3158C9.07995 15.1645 11.117 14.2938 12.7071 12.7037C14.2972 11.1136 15.1679 9.07654 15.3193 6.99694C15.6454 7.21396 15.955 7.46629 16.2426 7.75394C18.5858 10.0971 18.5858 13.8961 16.2426 16.2392C13.8995 18.5824 10.1005 18.5824 7.75736 16.2392C7.46971 15.9516 7.21738 15.642 7.00035 15.3158Z"></path>
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