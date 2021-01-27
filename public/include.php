<script>
    /* 用于页面一进入，直接判断是否是黑夜模式，请勿将它移走或删除，必须放这里，解决闪烁问题，下面的style也是，请勿修改 */
    if (localStorage.getItem('data-night')) document.querySelector("html").setAttribute("data-night", "night")
    window.Joe = {
        LIVE2D: '<?php $this->options->JLive2d() ?>',
        BASE_API: '/index.php/joe/api',
        DYNAMIC_BACKGROUND: '<?php $this->options->JDynamic_Background() ?>',
        WALLPAPER_BACKGROUND_PC: '<?php $this->options->JWallpaper_Background_PC() ?>',
        IS_MOBILE: /windows phone|iphone|android/gi.test(window.navigator.userAgent),
        BAIDU_PUSH: <?php echo $this->options->JBaiduToken ? 'true' : 'false' ?>,
        encryption: str => window.btoa(unescape(encodeURIComponent(str))),
        decrypt: str => decodeURIComponent(escape(window.atob(str))),
    }
</script>
<style>
    body::before {
        background: <?php
                    if (_isMobile()) {
                        echo $this->options->JWallpaper_Background_WAP ? "url(" . $this->options->JWallpaper_Background_WAP . ")" : "#f5f5f5";
                    } else {
                        echo $this->options->JWallpaper_Background_PC ? "url(" . $this->options->JWallpaper_Background_PC . ")" : "#f5f5f5";
                    } ?>;
        background-position: center 0;
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>
<!-- <<<<<<<<<<<<<<<<<<<< 主题开始 >>>>>>>>>>>>>>>>>>>> -->
<meta charset="utf-8" />
<meta name="renderer" content="webkit" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, shrink-to-fit=no, viewport-fit=cover">
<link rel="shortcut icon" href="<?php $this->options->JFavicon() ?>" />
<title><?php $this->archiveTitle(array('category' => '分类 %s 下的文章', 'search' => '包含关键字 %s 的文章', 'tag' => '标签 %s 下的文章', 'author' => '%s 发布的文章'), '', ' - '); ?><?php $this->options->title(); ?></title>
<?php $this->header(); ?>
<!-- 全局公用CSS（静态资源放在了CDN上，如果你的服务器带宽不够，请不要修改成本地，cdn采用jsdelivr放心不会失效） -->
<link rel="stylesheet" href="https://apip.weatherdt.com/standard/static/css/weather-standard.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism-tomorrow.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@5.4.5/css/swiper.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/animate.css@3.7.2/animate.min.css" />
<link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/joe.normalize.css'); ?>">
<link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/joe.owo.css'); ?>">
<link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/joe.global.css'); ?>">
<!-- 全局公用JS（静态资源放在了CDN上，如果你的服务器带宽不够，请不要修改成本地，cdn采用jsdelivr放心不会失效） -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/HaoOuBa/Joe@master/assets/js/joe.scroll.js"></script>
<script src="https://cdn.jsdelivr.net/gh/HaoOuBa/Joe@master/assets/js/joe.lazyload.js"></script>
<script src="https://cdn.jsdelivr.net/gh/HaoOuBa/Joe@master/assets/js/joe.sketchpad.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@5.4.5/js/swiper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/wowjs@1.1.3/dist/wow.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/prismjs@1.23.0/prism.min.js"></script>
<script src="<?php $this->options->themeUrl('assets/js/joe.owo.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/joe.global.js'); ?>"></script>
<!-- 下面是异步加载的JS -->
<script async src="https://apip.weatherdt.com/standard/static/js/weather-standard.js?v=2.0"></script>
<script async src="https://cdn.jsdelivr.net/gh/HaoOuBa/Joe@master/assets/js/joe.smooth.js"></script>