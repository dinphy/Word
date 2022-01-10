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
                <span>已运行 <strong class="joe_run__day">00</strong> 天 <strong class="joe_run__hour">00</strong> 时 <strong class="joe_run__minute">00</strong> 分 <strong class="joe_run__second">00</strong> 秒</span>
            </div>
        <?php endif; ?>
        <div class="item">
            <?php $this->options->JFooter_Right() ?>
        </div>
    </div>
</footer>

<div class="joe_action">
    <?php if ($this->options->JDirectoryStatus === 'on') : ?>
        <div class="joe_action_item menu">
            <svg viewBox="0 0 1084 1024" xmlns="http://www.w3.org/2000/svg" width="25" height="25">
                <path d="M184.83361091 241.54245141h697.95496331a34.89774795 34.89774795 0 1 0 0-69.79549591H184.83361091a34.89774795 34.89774795 0 1 0-1e-8 69.79549591zM184.83361091 546.89774795h414.41075932a34.89774795 34.89774795 0 1 0 0-69.7954959H184.83361091a34.89774795 34.89774795 0 1 0-1e-8 69.7954959zM184.83361091 852.25304449h196.29983373a34.89774795 34.89774795 0 1 0 1e-8-69.7954959H184.83361091a34.89774795 34.89774795 0 1 0-1e-8 69.7954959z"></path>
            </svg>
        </div>
    <?php endif; ?>
    <div class="joe_action_item scroll">
        <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" width="25" height="25">
            <path d="M64.633 702.181L511.145 255.67l446.512 446.511z"></path>
        </svg>
    </div>
</div>

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