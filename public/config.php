<script>
    function detectIE() {
        var n = window.navigator.userAgent,
            e = n.indexOf("MSIE ");
        if (e > 0) {
            return parseInt(n.substring(e + 5, n.indexOf(".", e)), 10)
        }
        if (n.indexOf("Trident/") > 0) {
            var r = n.indexOf("rv:");
            return parseInt(n.substring(r + 3, n.indexOf(".", r)), 10)
        }
        var i = n.indexOf("Edge/");
        return i > 0 && parseInt(n.substring(i + 5, n.indexOf(".", i)), 10)
    };
    detectIE() && (alert('当前站点不支持IE浏览器或您开启了兼容模式，请使用其他浏览器访问或关闭兼容模式。'), (location.href = 'https://www.baidu.com'))
    localStorage.getItem("data-night") && document.querySelector("html").setAttribute("data-night", "night");
    window.Joe = {
        THEME_URL: `<?php Helper::options()->themeUrl() ?>`,
        BASE_API: `<?php echo $this->options->rewrite == 0 ? Helper::options()->rootUrl . '/index.php/word/api' : Helper::options()->rootUrl . '/word/api' ?>`,
        DYNAMIC_BACKGROUND: `<?php $this->options->JDynamic_Background() ?>`,
        WALLPAPER_BACKGROUND: `<?php $this->options->JWallpaper_Background() ?>`,
        IS_MOBILE: /windows phone|iphone|android/gi.test(window.navigator.userAgent),
        BAIDU_PUSH: <?php echo $this->options->JBaiduToken ? 'true' : 'false' ?>,
        DOCUMENT_TITLE: `<?php $this->options->JDocumentTitle() ?>`,
        LAZY_LOAD: `<?php _getLazyload() ?>`,
        BIRTHDAY: `<?php $this->options->JBirthDay() ?>`,
        MOTTO: `<?php _getAsideAuthorMotto() ?>`,
        PAGE_INDEX: `<?php echo $this->_currentPage; ?>` || 1,
        PAGE_SIZE: `<?php $this->parameter->pageSize() ?>`,
        TYPE_INDEX: `<?php echo $this->options->IndexListOrder ? $this->options->IndexListOrder() : 'created' ?>`
    }
</script>
<?php
$fontUrl = $this->options->JCustomFont?:'';
if (strpos($fontUrl, 'woff2') !== false) $fontFormat = 'woff2';
elseif (strpos($fontUrl, 'woff') !== false) $fontFormat = 'woff';
elseif (strpos($fontUrl, 'ttf') !== false) $fontFormat = 'truetype';
elseif (strpos($fontUrl, 'eot') !== false) $fontFormat = 'embedded-opentype';
elseif (strpos($fontUrl, 'svg') !== false) $fontFormat = 'svg';
?>
<style>
    @font-face {
        font-family: 'Joe Font';
        font-weight: 400;
        font-style: normal;
        font-display: swap;
        src: url('<?php echo $fontUrl ?>');
        <?php if ($fontFormat) : ?>src: url('<?php echo $fontUrl ?>') format('<?php echo $fontFormat ?>');
        <?php endif; ?>
    }

    body {
        <?php if ($fontUrl) : ?>font-family: 'Joe Font';
        <?php else : ?>font-family: 'Helvetica Neue', Helvetica, 'PingFang SC', 'Hiragino Sans GB', 'Microsoft YaHei', '微软雅黑', Arial, sans-serif;
        <?php endif; ?>
    }

    body::before {
        background: <?php echo $this->options->JWallpaper_Background ? "url(" . $this->options->JWallpaper_Background . ")" : "#f7f9fc"; ?>;
        background-position: center 0;
        background-repeat: no-repeat;
        background-size: cover;
    }

    <?php $this->options->JCustomCSS() ?>
</style>
