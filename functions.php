<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/* Joe核心文件 */
require_once("core/core.php");

function themeConfig($form)
{
    $_db = Typecho_Db::get();
    $_prefix = $_db->getPrefix();
    try {
        if (!array_key_exists('views', $_db->fetchRow($_db->select()->from('table.contents')->page(1, 1)))) {
            $_db->query('ALTER TABLE `' . $_prefix . 'contents` ADD `views` INT DEFAULT 0;');
        }
        if (!array_key_exists('agree', $_db->fetchRow($_db->select()->from('table.contents')->page(1, 1)))) {
            $_db->query('ALTER TABLE `' . $_prefix . 'contents` ADD `agree` INT DEFAULT 0;');
        }
    } catch (Exception $e) {
    }
?>
    <link rel="stylesheet" href="<?php Helper::options()->themeUrl('typecho/config/css/joe.config.min.css') ?>?<?php echo _getVersion() ?>">
    <script src="<?php Helper::options()->themeUrl('typecho/config/js/joe.config.min.js') ?>?<?php echo _getVersion() ?>"></script>
    <div class="joe_config">
        <div>
            <div class="joe_config__aside">
                <div class="logo">Word</div>
                <ul class="tabs">
                    <li class="item" data-current="joe_notice">版本信息</li>
                    <li class="item" data-current="joe_global">全局设置</li>
                    <li class="item" data-current="joe_index">首页设置</li>
                    <li class="item" data-current="joe_aside">侧栏设置</li>
                    <li class="item" data-current="joe_post">文章设置</li>
                    <li class="item" data-current="joe_image">图片设置</li>
                    <li class="item" data-current="joe_other">其他设置</li>
                </ul>
                <?php require_once('core/backup.php'); ?>
            </div>
        </div>
        <div class="joe_config__notice">
            <div class="title">主题须知</div>
            <div class="content">Word，是一款专为文字创作而生，又简而不凡的全新 typecho 主题。它是基于 <a href="https://78.al" target="_blank">Joe</a> 二次开发而来的，延续了原主题的大部分功能，简化了页面布局，优化了诸多细节。</div>
            <ol>
                <li>当前版本： Word <?php echo _getVersion() ?> </li>
                <li>主题作者：<a href="https://78.al" target="_blank">Joe</a>，<a href="https://xwsir.cn" target="_blank">小王先森</a></li>
                <li>注意事项：已移除主题集成的编辑器，但短代码功能都在，使用参考 《 <a href="https://xwsir.cn/2905.html" target="_blank">Typecho 主题——Joe 使用文档</a>》</li>
            </ol>
        </div>
    <?php
    $JFavicon = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JFavicon',
        NULL,
        'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAMAAABg3Am1AAAAaVBMVEUAAAA2Jyc2Jyc2Jyc2JyfWngc2Jyc2Jyc2Jyc2Jyc2Jyc2JydGMiSSbhU2Jyc2JydvUhs3Jyc2KCg2JyeYchRWPyCmexE2Jyc2JyfurwOKZhfEkQs2Jyd4Who2KCg2KCg2Jyf9ugD3tgL5+sE2AAAAIHRSTlMA6gsW9vuGMcTQtEb9+JNp+6lQKPz7+55y/fv7OvrZXtrXQoIAAAGdSURBVEjHxdXrcoIwEAXgBSJXi4oXVLwcfP+HbAyRQzrtLE6n0+8XagjZsyHKr8VZwg/ZVjRZhKjx10kOk4qiBBD56yMs7RkFABOLU8O6yE84a+uvLwYoYlHc2+M4pmrTZFZQI5llZfBkjIlmzZ9EGLWi8Nns187SZaTJDJan3umAXFQlcOi9NbASRWMX9Oi9BaDVHd+Arh+dgfr7cXU+KIB1T6elLcO7B9GDFv3Ejt+bbRh95Bjg3NNj//rBjiiD6FPeOnnEwQ6Lh0UXQMXoGcbqWQRL4EKqyc4tGbebqWNI/skcxXtfKjYibMP2uQ6ujjbAdefsw0anvil3Vz8lBqPiyzY2ybCGm5D9TFwR1+SqOYrFqg8L58qNwaqZ6jRXpppxWzKbmjOFnTv48pgNq8nY9HOwMxqeP+V0GXnmNAboFqMPG8jF/VDZSbdBobo0iFIXvntNOmgBfNDVjku9TD0DeArop4zXqYcxc2WqGte5h8O+qf8QS8e9+JqwKbXMUW1e2kT+zKYo8remXzGgeeIIlbwlzeU9SSP/5RPis0lhQ1CXpwAAAABJRU5ErkJggg==',
        '网站 Favicon 设置',
        '介绍：用于设置网站 Favicon，一个好的 Favicon 可以给用户一种很专业的观感 <br />
         格式：图片 URL地址 或 Base64 地址 <br />
         其他：免费转换 Favicon 网站 <a target="_blank" href="//tool.lu/favicon">tool.lu/favicon</a>'
    );
    $JFavicon->setAttribute('class', 'joe_content joe_image');
    $form->addInput($JFavicon);

    $JLogo = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JLogo',
        NULL,
        'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAUgAAAC0CAMAAADB7UXXAAAAt1BMVEUAAAA1KiouISk2KSk3KCg3KCgzMDA0Li41Kio2KCg3KCg1Kio0Kys1Kys3KCgzMDA3KCg1Kio1Kys1KiozMDA0LCz5twE3KCg0LS0zMDA3KCg0LCw3KCiIYxhhRh8zMDBVPSGgdRM2KCinehE1LCy/jA1pTB3+ugHYnwg1KytEMSV3Vxs3KCiSaxYzMDDqqwQzMDA1LCzDkAveogbTmwmDYBiwgBA3KCgzMDD/ugD/wwArHyr/vwAQnkgXAAAAN3RSTlMADf5F4/WyPmVusBw1ktLMyHorJPdO+Oum4tlXtvTy7vTtnO6D8vT6/Yr29cHwv/fWXfT19P7z0V9SNQAACnJJREFUeNrtnX1/0jAQxxPa0rK2PBQqMFC04ia6TXHTsI73/7ocCktK2l6SdvLgff+ao+s++5nmfrm7pARBEARBEARBEARBEARBkNdlcmE7w+4iIhD9edd27IslJYhM0GV/cebAlT1ne2U7IMg+7pC9kJAyEn6hYxEki28zgbIx2WICwz5B5GHGiYoVd5jIiCCyPJxF8QTJMjg4JDNMWJY2KeKGZfEIIo0zjk1JPtRm+2MXEZizLENfVciQIAItYERyLlmWHkEEXJZlSoq4YFnQSWagbSmEqIUlG5eJWZbZoF0iT5eJtAiSZSSaQ5cUEziZKQDZg3IlhzEpw+KB+wIf7By8vwHZGUGLFT/5OyhtfK7zoVYvCb2IwPS9MJlbOBwRBPkfoQA4N6rRt4c52AIJQZSsOUhMEBCXwbTx6YbpsjwweaaLx/LBUo0e1GZKXBCklJAVgQldHSKHbcB4U5Up29EoAOONCjHX8fbHpy0/nnn5+raB8UanctO4Wqc71s/wf1w9YbeKTpvAQ/qYy/oB4w2IP2Rbnt6mjwWkb58w3qh2pDW+fFsXCbn+9qWB8aaUgO14+pA+FpJ+fBmSjk+Qkj6zxvs3jyW8ed/AeKPUItD4lJYJmX5qYLxRWWQ/Xa0fS1lfYbwpZgFZH076gPm0QvpOnvWBLdAQ401Rt55gfUosEMabfCxufT7yAVlmgTDe5NIusj6wBWoT5IWWZH0A0h+N/7ZFkgZWEbFkfUDWX3m8iV3XtXJxz9AdtWymgHOvKuQ9lEs/086/HlPh6TZ9VCS9fWL/YeE2YCBypIHjjQoROSemTAk40ohLblbMubaZxwxE9uKwK2fP/FeNQrTNDKZIeJ343xVuW0yVh7XygHyAwra60XQ7hRxV1PeHDACwkUAuDQBObMSrQo5qz2gi+LoNl8+0N2y+sJ8ZAgsbILs7FG96ubup4FuT8xAyEB4ymos/FQyQtvmZ+jQXYUIJSCnRYhHeDSQRx6PF4pgiFbc+Xajlhyd/4PQPrFJXywLR0SrDYEKOi1iloh9qWiAhIZko5OaYkijNlcix6UgvVXoaqS0kyLXWh0NfJVt8SQlMfyXQIUcGX2Q7kZpDekjVMhbwWjrKXAYzXnHm5LjwHcXTJ9qSBQJzaPBQC5lWL8HdET/Ziepe/1i0QOpZ3YlqI3WiOUkeWQUjUF9fiBZI2frcqLf2B3pCuuSouFFf8QaABQKsD2iBbk5ZyIlODiaUmtHAWmyis/1pebpCUlvHEvuSBYKyPo6vN0mfrJBzHjQDvSTRw7qufpU+tw3zUxWyD1gfIwt0/U6wPppGtn+iQo50jzmyRAsER5qJ7tJqdJpCuvpnE14IFijNRYg0U/2I59YlZN/yer2l6ytW9Je9nhdH1be5dvUng8a7t/vcbrhq8GlX34N16xDSXfCU26zZ6wOuLvzO03JBxW2ursHKvPGUSwOYdqFHo6qQUThb7fG9RYtFGGevvQuqWJ9EP1cEY1PjydpcyIhfITIrsA/WWLp04JkXvGy/vsItbK/hLJC5kPPB9hkN48iad8RRGRCZcCdecy7ceWHcOdp6jVaCG8O+6qm5kPRuL8MWfy8ZafxuTX8z+/NrPdMCQ1jvSQyyh4RZ1iCk/10SgvIfkPUZZctndPyiuW+8qnmNEvjcbL6emwpJdzqOsmpx4mzY3M+0T14ubJoWs6d1nsRgsusrhErcsJD8M1+Sd8tM/CQaSHlNHnl800Y+S/9Phu1PYpIU7Znan0nBcApWnGZOsn0sxp4dPdOGn7Z+eG28//nMV4GffxB6+QwM+SU1FJIPJ6/kZwJZ35FghsDCGuxkWtqh3rlPn1kLpH+4d7RnDA9MisJCeoJYxUNyJM+dwl/u8xBPNQO3dtIC7ktLPwBJCyApaigknwop2cI/kgWig7wa2oDHJeOCTai/SQQu2FxSzUP3A1MhA66V7FFzSo9xpoYmR5vE+BAfJ9KzPj/S4hKicWI3MU7szkuEdHNarsJcITv8Lr7x236mWvtjv67VNob4WutsX19IueBNJAZyewaXbCYgXkiJFi2D4hffJAK3WSQEwgIiHiAk16rYA3aESZJfDxARYwtEQeuj2AGd3hqVY9vUWMi+ZHGKVjeUX1+rkMQ6ngaB2LyubZW2svRWHH9/2mzSfCo0Rw59Rdf59AtqWfnFXfmyuvWBhYxXHDnALYVHW7p+TOo/NS5RPITq3fUjwPW7huRQocxJpCskYLpzZe7I19NXOMcw0Lc+sAVaVK4Hw0LSVdkQCyT7479GVxu1VZKxPmh9ZAsED7ULaWllGLXHZUOsL6smjeCaz3qd6Fsf2AJdqEQ6j1QSslk2xAJ5iTiWlo110AaSL4D1AS2QBf/iNqkmpFc2xCw5jzYqjU4UetzhgZHQ/IPwp0Iv/vWbLNciLx/ev+f/PVH+TaWEqLmQdFAyxLjKbp7w4/3raQcsgMHvO2t3JTabjBgX8p3ElcjmG+83CDs6h90dN3/Z3NQeAicba2V/RnJxRk7Y3okZM85I0nHVqWyBYBqKMHWcqLKQkRS35TzaIJDvJD/cm3Li2Dc+ZeqgLEhlIUkoCSNp3JNTQvIOiXjGFTeyQAfEpjUIScX8bZT31DelDRKcjrUdjpuLB24VC3QIYOsD1l84fW5pMo+mm18U82erDOPQi1t/7j9zq72A4WB0iZGQESlT8kWMYCtYqLrjdtyv2Ct5MFwzIft5LSucvx16/rYbaDwhEnFuUnJEK29cOhAhMROSEpmJuFSc3TW/b7+a56oTjOXhGJPKhM4h7I8TEjMhZySXyZ0kzp1HFbsjO0tSB/2J57W2eDs23+n1FjY35B8+bviQy0cBbsjtea+XuSf/JcuI6AkJ1/DpJOkMdmp3wgklZVi7ft3B3Twir48nJtGU+KEYlU2FDIGucDd2I0qU8N048EndwBXt60cFroFjDysLuSSnCU9sbAsNULEBSP5UFvJkT5wVN4ZoHQ1yQeqjebznB2gnNqRj8YEGICd6FSGP6twkEPh4EHh/bEiqIy+QByd8Cpi0N1Zpf6xNaxXyGI9NgoGPB4H3x9b6CPLM4smGGq3K9vW7+qyPtRj1qNTic+KnoAq9Fh9TNesTE2P4zqzZzkD1Tz5kb5nqvhhoSioR7zXQtrYLv5N/K1vAFOJNeluX9aGzlyBtidXoYzpXzpAQOIuBtwZUsz5y81OLEDo67cVhgQW6WueTfq3N+oSZTOHdbFdsPQcEC/TrM+eef/mrPuszX8kMzuC53usyaRTkfVlt1idaSXROPs5IWSAYq/r43y8EnMdjzbNA/+wF20FzwB/q5rGdz/e674WuOetDXW8ehuF8GZBzY6HahoLU0d5in3CeS49Xbm85p7DwanRV2lAQGPcC5PxCA4IgCHIwaNQXiNA8VnilkPMCs0+6uHdYEiaQEKSO9yk65/WGw3/MVEycIbVkeo/oHOZTpMt3eyNVmJzhCzcPAr3EF7vXQwszkPVAbUyJ18PiDN83fhB8hzEHV4f1rBNPuhf5aAjO7f33B+PmrF5/f0CsI3tJIYIgCIIgCIIgCIIgCIIgR8Bv+RdDljqTBi8AAAAASUVORK5CYII=',
        '网站 Logo 设置',
        '介绍：用于设置网站 Logo，一个好的 Logo 能为网站带来有效的流量 <br />
         格式：图片 URL地址 或 Base64 地址 <br />
         其他：免费制作 logo 网站 <a target="_blank" href="//www.uugai.com">www.uugai.com</a>'
    );
    $JLogo->setAttribute('class', 'joe_content joe_image');
    $form->addInput($JLogo);

    $JCommentStatus = new Typecho_Widget_Helper_Form_Element_Select(
        'JCommentStatus',
        array(
            'on' => '开启（默认）',
            'off' => '关闭'
        ),
        '3',
        '开启或关闭全站评论',
        '介绍：用于一键开启关闭所有页面的评论 <br>
         注意：此处的权重优先级最高 <br>
         若关闭此项而文章内开启评论，评论依旧为关闭状态'
    );
    $JCommentStatus->setAttribute('class', 'joe_content joe_global');
    $form->addInput($JCommentStatus->multiMode());

    $JNavStatus = new Typecho_Widget_Helper_Form_Element_Select(
        'JNavStatus',
        array(
            'on' => '开启（默认）',
            'off' => '关闭'
        ),
        '3',
        '导航分类合并',
        '介绍：用于设置导航分类合并或展开'
    );
    $JNavStatus->setAttribute('class', 'joe_content joe_global');
    $form->addInput($JNavStatus->multiMode());

    $JNavMaxNum = new Typecho_Widget_Helper_Form_Element_Select(
        'JNavMaxNum',
        array(
            '1' => '1个',
            '2' => '2个',
            '3' => '3个（默认）',
            '4' => '4个',
            '5' => '5个',
            '6' => '6个',
            '7' => '7个',
        ),
        '3',
        '选择导航栏最大显示的个数',
        '介绍：用于设置最大多少个后，以更多下拉框显示'
    );
    $JNavMaxNum->setAttribute('class', 'joe_content joe_global');
    $form->addInput($JNavMaxNum->multiMode());

    $JCursorEffects = new Typecho_Widget_Helper_Form_Element_Select(
        'JCursorEffects',
        array(
            'off' => '关闭（默认）',
            'cursor0.js' => '效果0',
            'cursor1.js' => '效果1',
            'cursor2.js' => '效果2',
            'cursor3.js' => '效果3',
            'cursor4.js' => '效果4',
            'cursor5.js' => '效果5',
            'cursor6.js' => '效果6',
            'cursor7.js' => '效果7',
            'cursor8.js' => '效果8',
            'cursor9.js' => '效果9',
            'cursor10.js' => '效果10',
            'cursor11.js' => '效果11',
        ),
        'off',
        '选择鼠标特效',
        '介绍：用于开启炫酷的鼠标特效'
    );
    $JCursorEffects->setAttribute('class', 'joe_content joe_global');
    $form->addInput($JCursorEffects->multiMode());

    $JList_Animate = new Typecho_Widget_Helper_Form_Element_Select(
        'JList_Animate',
        array(
            'off' => '关闭（默认）',
            'bounce' => 'bounce',
            'flash' => 'flash',
            'pulse' => 'pulse',
            'rubberBand' => 'rubberBand',
            'headShake' => 'headShake',
            'swing' => 'swing',
            'tada' => 'tada',
            'wobble' => 'wobble',
            'jello' => 'jello',
            'heartBeat' => 'heartBeat',
            'bounceIn' => 'bounceIn',
            'bounceInDown' => 'bounceInDown',
            'bounceInLeft' => 'bounceInLeft',
            'bounceInRight' => 'bounceInRight',
            'bounceInUp' => 'bounceInUp',
            'bounceOut' => 'bounceOut',
            'bounceOutDown' => 'bounceOutDown',
            'bounceOutLeft' => 'bounceOutLeft',
            'bounceOutRight' => 'bounceOutRight',
            'bounceOutUp' => 'bounceOutUp',
            'fadeIn' => 'fadeIn',
            'fadeInDown' => 'fadeInDown',
            'fadeInDownBig' => 'fadeInDownBig',
            'fadeInLeft' => 'fadeInLeft',
            'fadeInLeftBig' => 'fadeInLeftBig',
            'fadeInRight' => 'fadeInRight',
            'fadeInRightBig' => 'fadeInRightBig',
            'fadeInUp' => 'fadeInUp',
            'fadeInUpBig' => 'fadeInUpBig',
            'fadeOut' => 'fadeOut',
            'fadeOutDown' => 'fadeOutDown',
            'fadeOutDownBig' => 'fadeOutDownBig',
            'fadeOutLeft' => 'fadeOutLeft',
            'fadeOutLeftBig' => 'fadeOutLeftBig',
            'fadeOutRight' => 'fadeOutRight',
            'fadeOutRightBig' => 'fadeOutRightBig',
            'fadeOutUp' => 'fadeOutUp',
            'fadeOutUpBig' => 'fadeOutUpBig',
            'flip' => 'flip',
            'flipInX' => 'flipInX',
            'flipInY' => 'flipInY',
            'flipOutX' => 'flipOutX',
            'flipOutY' => 'flipOutY',
            'rotateIn' => 'rotateIn',
            'rotateInDownLeft' => 'rotateInDownLeft',
            'rotateInDownRight' => 'rotateInDownRight',
            'rotateInUpLeft' => 'rotateInUpLeft',
            'rotateInUpRight' => 'rotateInUpRight',
            'rotateOut' => 'rotateOut',
            'rotateOutDownLeft' => 'rotateOutDownLeft',
            'rotateOutDownRight' => 'rotateOutDownRight',
            'rotateOutUpLeft' => 'rotateOutUpLeft',
            'rotateOutUpRight' => 'rotateOutUpRight',
            'hinge' => 'hinge',
            'jackInTheBox' => 'jackInTheBox',
            'rollIn' => 'rollIn',
            'rollOut' => 'rollOut',
            'zoomIn' => 'zoomIn',
            'zoomInDown' => 'zoomInDown',
            'zoomInLeft' => 'zoomInLeft',
            'zoomInRight' => 'zoomInRight',
            'zoomInUp' => 'zoomInUp',
            'zoomOut' => 'zoomOut',
            'zoomOutDown' => 'zoomOutDown',
            'zoomOutLeft' => 'zoomOutLeft',
            'zoomOutRight' => 'zoomOutRight',
            'zoomOutUp' => 'zoomOutUp',
            'slideInDown' => 'slideInDown',
            'slideInLeft' => 'slideInLeft',
            'slideInRight' => 'slideInRight',
            'slideInUp' => 'slideInUp',
            'slideOutDown' => 'slideOutDown',
            'slideOutLeft' => 'slideOutLeft',
            'slideOutRight' => 'slideOutRight',
            'slideOutUp' => 'slideOutUp',
        ),
        'off',
        '选择一款炫酷的列表动画',
        '介绍：开启后，列表将会显示所选择的炫酷动画'
    );
    $JList_Animate->setAttribute('class', 'joe_content joe_global');
    $form->addInput($JList_Animate->multiMode());

    $JCustomNavs = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JCustomNavs',
        NULL,
        NULL,
        '导航栏自定义链接（非必填）',
        '介绍：用于自定义导航栏链接 <br />
         格式：跳转文字 || 跳转链接（中间使用两个竖杠分隔）<br />
         其他：一行一个，一行代表一个超链接 <br />
         例如：<br />
            百度一下 || https://baidu.com <br />
            腾讯视频 || https://v.qq.com
         '
    );
    $JCustomNavs->setAttribute('class', 'joe_content joe_global');
    $form->addInput($JCustomNavs);

    $JFooter_Tabbar = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JFooter_Tabbar',
        NULL,
        'zm-home2 || 首页 || index.html
         zm-pinglun3 || 碎语 || cross.html
         zm-guidang || 归档 || archives.html
         zm-wo || 关于 || about.html',
        '底部导航（非必填）',
        '提示：请参考示例填写，一行一个，为空则不显示<br />
            格式：图标 || 名称 || 链接 （中间使用 || 分隔）<br />
            示例：<br />
            zm-home2 || 首页 || index.html <br />
            zm-pinglun3 || 碎语 || cross.html <br />
            zm-guidang || 归档 || archives.html <br />
            zm-wo || 关于 || about.html <br />
            更多图标：<a href="https://www.iconfont.cn/" target="_blank">阿里巴巴矢量图标库</a> <br />
            '
    );
    $JFooter_Tabbar->setAttribute('class', 'joe_content joe_global');
    $form->addInput($JFooter_Tabbar);

    $Tabbar_Icon_Link = new Typecho_Widget_Helper_Form_Element_Text(
        'Tabbar_Icon_Link',
        NULL,
        NULL,
        '自定义底部导航图标（非必填）',
        '介绍：如果你需要改变图标，请将自己的图标链接填写在此处，一般为图标的 css 链接 <br />
         注意：图标的前缀是 zm，如果不是，将不能正常显示'
    );
    $Tabbar_Icon_Link->setAttribute('class', 'joe_content joe_global');
    $form->addInput($Tabbar_Icon_Link);

    $JFooter_Left = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JFooter_Left',
        NULL,
        '2019 - 2020 © Reach - <a href="https://78.al" target="_blank" rel="noopener noreferrer">Joe</a>',
        '自定义底部栏左侧内容（非必填）',
        '介绍：用于修改全站底部左侧内容（wap端上方） <br>
         例如：2019 - 2020 © Reach - Joe             '
    );
    $JFooter_Left->setAttribute('class', 'joe_content joe_global');
    $form->addInput($JFooter_Left);

    $JFooter_Right = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JFooter_Right',
        NULL,
        '<a href="https://78.al/feed/" target="_blank" rel="noopener noreferrer">RSS</a>
         <a href="https://78.al/sitemap.xml" target="_blank" rel="noopener noreferrer" style="margin-left: 15px">MAP</a>',
        '自定义底部栏右侧内容（非必填）',
        '介绍：用于修改全站底部右侧内容（wap端下方） <br>
         例如：&lt;a href="/"&gt;首页&lt;/a&gt; &lt;a href="/"&gt;关于&lt;/a&gt;'
    );
    $JFooter_Right->setAttribute('class', 'joe_content joe_global');
    $form->addInput($JFooter_Right);

    $JDocumentTitle = new Typecho_Widget_Helper_Form_Element_Text(
        'JDocumentTitle',
        NULL,
        NULL,
        '网页被隐藏时显示的标题',
        '介绍：在PC端切换网页标签时，网站标题显示的内容。如果不填写，则默认不开启 <br />
         注意：严禁加单引号或双引号！！！否则会导致网站出错！！'
    );
    $JDocumentTitle->setAttribute('class', 'joe_content joe_global');
    $form->addInput($JDocumentTitle);

    $JCustomCSS = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JCustomCSS',
        NULL,
        NULL,
        '自定义CSS（非必填）',
        '介绍：请填写自定义CSS内容，填写时无需填写style标签。<br />
         其他：如果想修改主题色、卡片透明度等，都可以通过这个实现 <br />
         例如：body { --theme: #ff6800; --background: rgba(255,255,255,0.85) }'
    );
    $JCustomCSS->setAttribute('class', 'joe_content joe_global');
    $form->addInput($JCustomCSS);

    $JCustomScript = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JCustomScript',
        NULL,
        NULL,
        '自定义JS（非必填）',
        '介绍：请填写自定义JS内容，例如网站统计等，填写时无需填写script标签。'
    );
    $JCustomScript->setAttribute('class', 'joe_content joe_global');
    $form->addInput($JCustomScript);

    $JCustomHeadEnd = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JCustomHeadEnd',
        NULL,
        NULL,
        '自定义增加&lt;head&gt;&lt;/head&gt;里内容（非必填）',
        '介绍：此处用于在&lt;head&gt;&lt;/head&gt;标签里增加自定义内容 <br />
         例如：可以填写引入第三方css、js等等'
    );
    $JCustomHeadEnd->setAttribute('class', 'joe_content joe_global');
    $form->addInput($JCustomHeadEnd);

    $JCustomBodyEnd = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JCustomBodyEnd',
        NULL,
        NULL,
        '自定义&lt;body&gt;&lt;/body&gt;末尾位置内容（非必填）',
        '介绍：此处用于填写在&lt;body&gt;&lt;/body&gt;标签末尾位置的内容 <br>
         例如：可以填写引入第三方js脚本等等'
    );
    $JCustomBodyEnd->setAttribute('class', 'joe_content joe_global');
    $form->addInput($JCustomBodyEnd);

    $JBirthDay = new Typecho_Widget_Helper_Form_Element_Text(
        'JBirthDay',
        NULL,
        NULL,
        '网站成立日期（非必填）',
        '介绍：用于显示当前站点已经运行了多少时间。<br>
         注意：填写时务必保证填写正确！例如：2021/1/1 00:00:00 <br>
         其他：不填写则不显示，若填写错误，则不会显示计时'
    );
    $JBirthDay->setAttribute('class', 'joe_content joe_global');
    $form->addInput($JBirthDay);

    $JCustomFont = new Typecho_Widget_Helper_Form_Element_Text(
        'JCustomFont',
        NULL,
        NULL,
        '自定义网站字体（非必填）',
        '介绍：用于修改全站字体，填写则使用引入的字体，不填写使用默认字体 <br>
         格式：字体URL链接（推荐使用woff格式的字体，网页专用字体格式） <br>
         注意：字体文件一般有几兆，建议使用cdn链接'
    );
    $JCustomFont->setAttribute('class', 'joe_content joe_global');
    $form->addInput($JCustomFont);

    $JCustomAvatarSource = new Typecho_Widget_Helper_Form_Element_Text(
        'JCustomAvatarSource',
        NULL,
        NULL,
        '自定义头像源（非必填）',
        '介绍：用于修改全站头像源地址 <br>
         例如：https://gravatar.ihuan.me/avatar/ <br>
         其他：非必填，默认头像源为https://gravatar.helingqi.com/wavatar/ <br>
         注意：填写时，务必保证最后有一个/字符，否则不起作用！'
    );
    $JCustomAvatarSource->setAttribute('class', 'joe_content joe_global');
    $form->addInput($JCustomAvatarSource);

    $JAside_Switch = new Typecho_Widget_Helper_Form_Element_Select(
        'JAside_Switch',
        array(
            'off' => '关闭（默认）',
            'on' => '开启'
        ),
        'off',
        '是否开启侧边栏 - PC',
        '介绍：用于控制是否显示侧边栏'
    );
    $JAside_Switch->setAttribute('class', 'joe_content joe_aside');
    $form->addInput($JAside_Switch->multiMode());

    $JAside_Author_Status = new Typecho_Widget_Helper_Form_Element_Select(
        'JAside_Author_Status',
        array(
            'off' => '关闭（默认）',
            'on' => '开启'
        ),
        'off',
        '是否博主栏 - PC',
        '介绍：用于控制是否显示博主基本信息'
    );
    $JAside_Author_Status->setAttribute('class', 'joe_content joe_aside');
    $form->addInput($JAside_Author_Status->multiMode());

    $JAside_Author_Nick = new Typecho_Widget_Helper_Form_Element_Text(
        'JAside_Author_Nick',
        NULL,
        "Typecho",
        '博主栏博主昵称 - PC/WAP',
        '介绍：用于修改博主栏的博主昵称 <br />
         注意：如果不填写时则显示 *个人设置* 里的昵称'
    );
    $JAside_Author_Nick->setAttribute('class', 'joe_content joe_aside');
    $form->addInput($JAside_Author_Nick);
    /* --------------------------------------- */
    $JAside_Author_Avatar = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JAside_Author_Avatar',
        NULL,
        NULL,
        '博主栏博主头像 - PC/WAP',
        '介绍：用于修改博主栏的博主头像 <br />
         注意：如果不填写时则显示 *个人设置* 里的头像'
    );
    $JAside_Author_Avatar->setAttribute('class', 'joe_content joe_aside');
    $form->addInput($JAside_Author_Avatar);
    /* --------------------------------------- */
    $JAside_Author_Image = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JAside_Author_Image',
        NULL,
        "https://fastly.jsdelivr.net/npm/typecho-joe-next@6.0.0/assets/img/aside_author_image.jpg",
        '博主栏背景壁纸 - PC',
        '介绍：用于修改PC端博主栏的背景壁纸 <br/>
         格式：图片地址 或 Base64地址'
    );
    $JAside_Author_Image->setAttribute('class', 'joe_content joe_aside');
    $form->addInput($JAside_Author_Image);
    /* --------------------------------------- */
    $JAside_Wap_Image = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JAside_Wap_Image',
        NULL,
        "https://fastly.jsdelivr.net/npm/typecho-joe-next@6.0.0/assets/img/wap_aside_image.jpg",
        '博主栏背景壁纸 - WAP',
        '介绍：用于修改WAP端博主栏的背景壁纸 <br/>
         格式：图片地址 或 Base64地址'
    );
    $JAside_Wap_Image->setAttribute('class', 'joe_content joe_aside');
    $form->addInput($JAside_Wap_Image);
    /* --------------------------------------- */
    $JAside_Author_Link = new Typecho_Widget_Helper_Form_Element_Text(
        'JAside_Author_Link',
        NULL,
        "https://xwsir.cn",
        '博主栏昵称跳转地址 - PC/WAP',
        '介绍：用于修改博主栏点击博主昵称后的跳转地址'
    );
    $JAside_Author_Link->setAttribute('class', 'joe_content joe_aside');
    $form->addInput($JAside_Author_Link);
    /* --------------------------------------- */
    $JAside_Author_Motto = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JAside_Author_Motto',
        NULL,
        "有钱终成眷属，没钱亲眼目睹",
        '博主栏座右铭（一言）- PC/WAP',
        '介绍：用于修改博主栏的座右铭（一言） <br />
         格式：可以填写多行也可以填写一行，填写多行时，每次随机显示其中的某一条，也可以填写API地址 <br />
         其他：API和自定义的座右铭完全可以一起写（换行填写），不会影响 <br />
         注意：API需要开启跨域权限才能调取，否则会调取失败！<br />
         推荐API：https://api.vvhan.com/api/ian'
    );
    $JAside_Author_Motto->setAttribute('class', 'joe_content joe_aside');
    $form->addInput($JAside_Author_Motto);
    /* --------------------------------------- */
    $JAside_Rand = new Typecho_Widget_Helper_Form_Element_Select(
        'JAside_Rand',
        array(
            'off' => '关闭（默认）',
            '3' => '开启，并显示3条随机文章',
            '4' => '开启，并显示4条随机文章',
            '5' => '开启，并显示5条随机文章',
            '6' => '开启，并显示6条随机文章',
            '7' => '开启，并显示7条随机文章',
            '8' => '开启，并显示8条随机文章',
            '9' => '开启，并显示9条随机文章',
            '10' => '开启，并显示10条随机文章'
        ),
        'off',
        '随机文章 - PC',
        '介绍：用于设置随机文章的显示数量'
    );
    $JAside_Rand->setAttribute('class', 'joe_content joe_aside');
    $form->addInput($JAside_Rand->multiMode());
    /* --------------------------------------- */
    $JAside_Timelife_Status = new Typecho_Widget_Helper_Form_Element_Select(
        'JAside_Timelife_Status',
        array(
            'off' => '关闭（默认）',
            'on' => '开启'
        ),
        'off',
        '是否开启人生倒计时模块 - PC',
        '介绍：用于控制是否显示人生倒计时模块'
    );
    $JAside_Timelife_Status->setAttribute('class', 'joe_content joe_aside');
    $form->addInput($JAside_Timelife_Status->multiMode());
    /* --------------------------------------- */
    $JAside_Hot_Num = new Typecho_Widget_Helper_Form_Element_Select(
        'JAside_Hot_Num',
        array(
            'off' => '关闭（默认）',
            '3' => '显示3条',
            '4' => '显示4条',
            '5' => '显示5条',
            '6' => '显示6条',
            '7' => '显示7条',
            '8' => '显示8条',
            '9' => '显示9条',
            '10' => '显示10条',
        ),
        'off',
        '是否开启热门文章栏 - PC',
        '介绍：用于控制是否开启热门文章栏'
    );
    $JAside_Hot_Num->setAttribute('class', 'joe_content joe_aside');
    $form->addInput($JAside_Hot_Num->multiMode());

    $JADContent = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JADContent',
        NULL,
        NULL,
        '侧边栏广告 - PC',
        '介绍：用于设置侧边栏广告 <br />
         格式：广告图片 || 跳转链接 （中间使用两个竖杠分隔）<br />
         注意：如果您只想显示图片不想跳转，可填写：广告图片 || javascript:void(0)'
    );
    $JADContent->setAttribute('class', 'joe_content joe_aside');
    $form->addInput($JADContent);
    /* --------------------------------------- */
    $JCustomAside = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JCustomAside',
        NULL,
        NULL,
        '自定义侧边栏模块 - PC',
        '介绍：用于自定义侧边栏模块 <br />
         格式：请填写前端代码，不会写请勿填写 <br />
         例如：您可以在此处添加一个搜索框、时间、宠物、恋爱计时等等'
    );
    $JCustomAside->setAttribute('class', 'joe_content joe_aside');
    $form->addInput($JCustomAside);
    /* --------------------------------------- */
    $JAside_3DTag = new Typecho_Widget_Helper_Form_Element_Select(
        'JAside_3DTag',
        array(
            'off' => '关闭（默认）',
            'on' => '开启'
        ),
        'off',
        '是否开启3D云标签 - PC',
        '介绍：用于设置侧边栏是否显示3D云标签'
    );
    $JAside_3DTag->setAttribute('class', 'joe_content joe_aside');
    $form->addInput($JAside_3DTag->multiMode());

    $JThumbnail = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JThumbnail',
        NULL,
        NULL,
        '自定义缩略图',
        '介绍：用于修改主题默认缩略图 <br/>
         格式：图片地址，一行一个 <br />
         注意：不填写时，则使用主题内置的默认缩略图
         '
    );
    $JThumbnail->setAttribute('class', 'joe_content joe_image');
    $form->addInput($JThumbnail);

    $JLazyload = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JLazyload',
        NULL,
        "https://fastly.jsdelivr.net/npm/typecho-joe-next@6.0.0/assets/img/lazyload.jpg",
        '自定义懒加载图',
        '介绍：用于修改主题默认懒加载图 <br/>
         格式：图片地址'
    );
    $JLazyload->setAttribute('class', 'joe_content joe_image');
    $form->addInput($JLazyload);

    $JWallpaper_Batten = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JWallpaper_Batten',
        NULL,
        NULL,
        '自定义BATTEN背景图片（非必填）',
        '介绍：自定义BATTEN背景图片，不填写时显示懒加载图片。<br />
         格式：图片URL地址 或 随机图片api 例如：https://api.btstu.cn/sjbz/?lx=fengjing <br />
         注意：如果需要显示上方动态壁纸，请不要填写此项，此项优先级最高！'
    );
    $JWallpaper_Batten->setAttribute('class', 'joe_content joe_image');
    $form->addInput($JWallpaper_Batten);

    $JDynamic_Background = new Typecho_Widget_Helper_Form_Element_Select(
        'JDynamic_Background',
        array(
            'off' => '关闭（默认）',
            'backdrop1.js' => '效果1',
            'backdrop2.js' => '效果2',
            'backdrop3.js' => '效果3',
            'backdrop4.js' => '效果4',
            'backdrop5.js' => '效果5',
            'backdrop6.js' => '效果6'
        ),
        'off',
        '是否开启动态背景图（仅限PC）',
        '介绍：用于设置PC端动态背景<br />
         注意：如果您填写了下方PC端静态壁纸，将优先展示下方静态壁纸！如需显示动态壁纸，请将PC端静态壁纸设置成空'
    );
    $JDynamic_Background->setAttribute('class', 'joe_content joe_image');
    $form->addInput($JDynamic_Background->multiMode());

    $JWallpaper_Background_PC = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JWallpaper_Background_PC',
        NULL,
        NULL,
        'PC端网站背景图片（非必填）',
        '介绍：PC端网站的背景图片，不填写时显示默认的灰色。<br />
         格式：图片URL地址 或 随机图片api 例如：https://api.btstu.cn/sjbz/?lx=dongman <br />
         注意：如果需要显示上方动态壁纸，请不要填写此项，此项优先级最高！'
    );
    $JWallpaper_Background_PC->setAttribute('class', 'joe_content joe_image');
    $form->addInput($JWallpaper_Background_PC);

    $JWallpaper_Background_WAP = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JWallpaper_Background_WAP',
        NULL,
        NULL,
        'WAP端网站背景图片（非必填）',
        '介绍：WAP端网站的背景图片，不填写时显示默认的灰色。<br />
         格式：图片URL地址 或 随机图片api 例如：https://api.btstu.cn/sjbz/?lx=m_dongman'
    );
    $JWallpaper_Background_WAP->setAttribute('class', 'joe_content joe_image');
    $form->addInput($JWallpaper_Background_WAP);

    $JIndex_Top_Image = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JIndex_Top_Image',
        NULL,
        'https://pic.imgdb.cn/item/620e24df2ab3f51d9132481f.png',
        '首页顶部壁纸(非必填)',
        '介绍：用于修改首页顶部背景壁纸 <br />
        格式：图片地址，例如：https://fastly.jsdelivr.net/npm/typecho-joe-next@6.0.0/assets/img/aside_author_image.jpg'
    );
    $JIndex_Top_Image->setAttribute('class', 'joe_content joe_index');
    $form->addInput($JIndex_Top_Image);

    $JIndex_Carousel = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JIndex_Carousel',
        NULL,
        'https://pic1.imgdb.cn/item/63355d0e16f2c2beb14b024c.jpg || about.html || 夕阳无限好',
        '首页轮播图',
        '介绍：用于显示首页轮播图，请务必填写正确的格式 <br />
         格式：图片地址 || 跳转链接 || 标题 （中间使用两个竖杠分隔）<br />
         其他：一行一个，一行代表一个轮播图 <br />
         例如：<br />
         https://img1.imgtp.com/2022/05/14/u6k61Mzu.jpeg || about.html || 寻着光的方向<br />
         https://img1.imgtp.com/2022/05/14/o7kjyw7e.jpeg || about.html || 望向遥遥前方
         '
    );
    $JIndex_Carousel->setAttribute('class', 'joe_content joe_index');
    $form->addInput($JIndex_Carousel);

    $JIndex_Recommend = new Typecho_Widget_Helper_Form_Element_Text(
        'JIndex_Recommend',
        NULL,
        NULL,
        '首页推荐文章（非必填，填写时请填写2个，否则不显示！）',
        '介绍：用于显示推荐文章，请务必填写正确的格式 <br/>
         格式：文章的id || 文章的id （中间使用两个竖杠分隔）<br />
         例如：1 || 2 <br />
         注意：如果填写的不是2个，将不会显示'
    );
    $JIndex_Recommend->setAttribute('class', 'joe_content joe_index');
    $form->addInput($JIndex_Recommend);

    $JIndexSticky = new Typecho_Widget_Helper_Form_Element_Text(
        'JIndexSticky',
        NULL,
        NULL,
        '首页置顶文章（非必填）',
        '介绍：请务必填写正确的格式 <br />
         格式：文章的ID || 文章的ID || 文章的ID （中间使用两个竖杠分隔）<br />
         例如：1 || 2 || 3'
    );
    $JIndexSticky->setAttribute('class', 'joe_content joe_index');
    $form->addInput($JIndexSticky);

    $JIndex_Hot = new Typecho_Widget_Helper_Form_Element_Radio(
        'JIndex_Hot',
        array('off' => '关闭（默认）', 'on' => '开启'),
        'off',
        '是否开启首页热门文章',
        '介绍：首页显示浏览量最多的3篇热门文章'
    );
    $JIndex_Hot->setAttribute('class', 'joe_content joe_index');
    $form->addInput($JIndex_Hot->multiMode());

    $JIndex_Notice = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JIndex_Notice',
        NULL,
        NULL,
        '首页通知文字（非必填）',
        '介绍：请务必填写正确的格式 <br />
         格式：通知文字 || 跳转链接（中间使用两个竖杠分隔，限制一个）<br />
         例如：欢迎加入Joe官方QQ群 || https://baidu.com'
    );
    $JIndex_Notice->setAttribute('class', 'joe_content joe_index');
    $form->addInput($JIndex_Notice);

    $JFriendsIndex = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JFriendsIndex',
        NULL,
        '小王先森 || https://xwsir.cn/ || https://thirdqq.qlogo.cn/g?b=qq&nk=2027821710&s=100 || 山川异域，风月同天',
        '首页链接（非必填）',
        '介绍：用于填写首页友情链接 <br />
         格式：博客名称 || 博客地址 || 博客头像 || 博客简介 <br />
         其他：一行一个，一行代表一个友链'
    );
    $JFriendsIndex->setAttribute('class', 'joe_content joe_other');
    $form->addInput($JFriendsIndex);

    $JFriends = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JFriends',
        NULL,
        'Joe的博客 || https://78.al || https://fastly.jsdelivr.net/npm/typecho-joe-next@6.0.0/assets/img/link.png || Eternity is not a distance but a decision',
        '内页链接（非必填）',
        '介绍：用于填写友情链接 <br />
         注意：您需要先增加友链链接页面（新增独立页面-右侧模板选择友链），该项才会生效 <br />
         格式：博客名称 || 博客地址 || 博客头像 || 博客简介 <br />
         其他：一行一个，一行代表一个友链'
    );
    $JFriends->setAttribute('class', 'joe_content joe_other');
    $form->addInput($JFriends);

    $JSensitiveWords = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JSensitiveWords',
        NULL,
        '你妈死了 || 傻逼 || 操你妈 || 射你妈一脸',
        '评论敏感词（非必填）',
        '介绍：用于设置评论敏感词汇，如果用户评论包含这些词汇，则将会把评论置为审核状态 <br />
         例如：你妈死了 || 你妈炸了 || 我是你爹 || 你妈坟头冒烟 （多个使用 || 分隔开）'
    );
    $JSensitiveWords->setAttribute('class', 'joe_content joe_other');
    $form->addInput($JSensitiveWords);

    $JLimitOneChinese = new Typecho_Widget_Helper_Form_Element_Select(
        'JLimitOneChinese',
        array('off' => '关闭（默认）', 'on' => '开启'),
        'off',
        '是否开启评论至少包含一个中文',
        '介绍：开启后如果评论内容未包含一个中文，则将会把评论置为审核状态 <br />
         其他：用于屏蔽国外机器人刷的全英文垃圾广告信息'
    );
    $JLimitOneChinese->setAttribute('class', 'joe_content joe_other');
    $form->addInput($JLimitOneChinese->multiMode());

    $JTextLimit = new Typecho_Widget_Helper_Form_Element_Text(
        'JTextLimit',
        NULL,
        NULL,
        '限制用户评论最大字符',
        '介绍：如果用户评论的内容超出字符限制，则将会把评论置为审核状态 <br />
         其他：请输入数字格式，不填写则不限制'
    );
    $JTextLimit->setAttribute('class', 'joe_content joe_other');
    $form->addInput($JTextLimit->multiMode());

    $JSiteMap = new Typecho_Widget_Helper_Form_Element_Select(
        'JSiteMap',
        array(
            'off' => '关闭（默认）',
            '100' => '显示最新 100 条链接',
            '200' => '显示最新 200 条链接',
            '300' => '显示最新 300 条链接',
            '400' => '显示最新 400 条链接',
            '500' => '显示最新 500 条链接',
            '600' => '显示最新 600 条链接',
            '700' => '显示最新 700 条链接',
            '800' => '显示最新 800 条链接',
            '900' => '显示最新 900 条链接',
            '1000' => '显示最新 1000 条链接',
        ),
        'off',
        '是否开启主题自带SiteMap功能',
        '介绍：开启后博客将享有SiteMap功能 <br />
         其他：链接为博客最新实时链接 <br />
         好处：无需手动生成，无需频繁提交，提交一次即可 <br />
         开启后SiteMap访问地址：<br />
         http(s)://域名/sitemap.xml （开启了伪静态）<br />  
         http(s)://域名/index.php/sitemap.xml （未开启伪静态）
         '
    );
    $JSiteMap->setAttribute('class', 'joe_content joe_other');
    $form->addInput($JSiteMap->multiMode());

    /* 评论发信 */
    $JCommentMail = new Typecho_Widget_Helper_Form_Element_Select(
        'JCommentMail',
        array('off' => '关闭（默认）', 'on' => '开启'),
        'off',
        '是否开启评论邮件通知',
        '介绍：开启后评论内容将会进行邮箱通知 <br />
         注意：此项需要您完整无错的填写下方的邮箱设置！！ <br />
         其他：下方例子以QQ邮箱为例，推荐使用QQ邮箱'
    );
    $JCommentMail->setAttribute('class', 'joe_content joe_other');
    $form->addInput($JCommentMail->multiMode());

    $JCommentMailHost = new Typecho_Widget_Helper_Form_Element_Text(
        'JCommentMailHost',
        NULL,
        NULL,
        '邮箱服务器地址',
        '例如：smtp.qq.com'
    );
    $JCommentMailHost->setAttribute('class', 'joe_content joe_other');
    $form->addInput($JCommentMailHost->multiMode());

    $JCommentSMTPSecure = new Typecho_Widget_Helper_Form_Element_Select(
        'JCommentSMTPSecure',
        array('ssl' => 'ssl（默认）', 'tsl' => 'tsl'),
        'ssl',
        '加密方式',
        '介绍：用于选择登录鉴权加密方式'
    );
    $JCommentSMTPSecure->setAttribute('class', 'joe_content joe_other');
    $form->addInput($JCommentSMTPSecure->multiMode());

    $JCommentMailPort = new Typecho_Widget_Helper_Form_Element_Text(
        'JCommentMailPort',
        NULL,
        NULL,
        '邮箱服务器端口号',
        '例如：465'
    );
    $JCommentMailPort->setAttribute('class', 'joe_content joe_other');
    $form->addInput($JCommentMailPort->multiMode());

    $JCommentMailFromName = new Typecho_Widget_Helper_Form_Element_Text(
        'JCommentMailFromName',
        NULL,
        NULL,
        '发件人昵称',
        '例如：帅气的象拔蚌'
    );
    $JCommentMailFromName->setAttribute('class', 'joe_content joe_other');
    $form->addInput($JCommentMailFromName->multiMode());

    $JCommentMailAccount = new Typecho_Widget_Helper_Form_Element_Text(
        'JCommentMailAccount',
        NULL,
        NULL,
        '发件人邮箱',
        '例如：2323333339@qq.com'
    );
    $JCommentMailAccount->setAttribute('class', 'joe_content joe_other');
    $form->addInput($JCommentMailAccount->multiMode());

    $JCommentMailPassword = new Typecho_Widget_Helper_Form_Element_Text(
        'JCommentMailPassword',
        NULL,
        NULL,
        '邮箱授权码',
        '介绍：这里填写的是邮箱生成的授权码 <br>
         获取方式（以QQ邮箱为例）：<br>
         QQ邮箱 > 设置 > 账户 > IMAP/SMTP服务 > 开启 <br>
         其他：这个可以百度一下开启教程，有图文教程'
    );
    $JCommentMailPassword->setAttribute('class', 'joe_content joe_other');
    $form->addInput($JCommentMailPassword->multiMode());

    $JReader_Ranking = new Typecho_Widget_Helper_Form_Element_Select(
        'JReader_Ranking',
        array('off' => '关闭（默认）', 'on' => '开启'),
        'off',
        '是否开启留言读者排行，开启后将在留言页面呈现',
        '介绍：显示评论相关用户'
    );
    $JReader_Ranking->setAttribute('class', 'joe_content joe_other');
    $form->addInput($JReader_Ranking);

    $JReader_Ranking_Time = new Typecho_Widget_Helper_Form_Element_Select(
        'JReader_Ranking_Time',
        array(
            '180' => '最近180天（默认）',
            '30' => '最近30天',
            '60' => '最近60天',
            '90' => '最近90天',
            '120' => '最近120天',
            '150' => '最近150天',
            '360' => '最近360天'
        ),
        '180',
        '留言读者排行时间显示范围（默认为 180 天）'
    );
    $JReader_Ranking_Time->setAttribute('class', 'joe_content joe_other');
    $form->addInput($JReader_Ranking_Time->multiMode());

    $JReader_Ranking_Mail = new Typecho_Widget_Helper_Form_Element_Text(
        'JReader_Ranking_Mail',
        NULL,
        NULL,
        '读者排行，排除不上榜的邮箱',
        '例如：2027821710@qq.com'
    );
    $JReader_Ranking_Mail->setAttribute('class', 'joe_content joe_other');
    $form->addInput($JReader_Ranking_Mail->multiMode());

    $JReader_Ranking_Limit = new Typecho_Widget_Helper_Form_Element_Select(
        'JReader_Ranking_Limit',
        array(
            '30' => '最近 30 个（默认）',
            '10' => '最近 10 个',
            '20' => '最近 20 个',
            '40' => '最近 40 个',
            '50' => '最近 50 个',
            '100' => '最近 100 个',
            '200' => '最近 200 个',
            '300' => '最近 300 个',
            '400' => '最近 400 个',
            '500' => '最近 500 个'
        ),
        '30',
        '最近读者个数显示（默认为 30 个）'
    );
    $JReader_Ranking_Limit->setAttribute('class', 'joe_content joe_other');
    $form->addInput($JReader_Ranking_Limit->multiMode());

    $JBaiduToken = new Typecho_Widget_Helper_Form_Element_Text(
        'JBaiduToken',
        NULL,
        NULL,
        '百度推送Token',
        '介绍：填写此处，前台文章页如果未收录，则会自动将当前链接推送给百度加快收录 <br />
         其他：Token在百度收录平台注册账号获取'
    );
    $JBaiduToken->setAttribute('class', 'joe_content joe_post');
    $form->addInput($JBaiduToken);

    $JPrismTheme = new Typecho_Widget_Helper_Form_Element_Select(
        'JPrismTheme',
        array(
            'https://lib.baomitu.com/prism/1.26.0/themes/prism.min.css' => 'prism（默认）',
            'https://lib.baomitu.com/prism/1.26.0/themes/prism-okaidia.min.css' => 'prism-okaidia',
            'https://lib.baomitu.com/prism/1.26.0/themes/prism-solarizedlight.min.css' => 'prism-solarizedlight',
            'https://lib.baomitu.com/prism/1.26.0/themes/prism-tomorrow.min.css' => 'prism-tomorrow',
            'https://lib.baomitu.com/prism-themes/1.9.0/prism-coldark-cold.min.css' => 'prism-coldark-cold',
            'https://lib.baomitu.com/prism-themes/1.9.0/prism-coldark-dark.min.css' => 'prism-coldark-dark',
            'https://lib.baomitu.com/prism-themes/1.9.0/prism-duotone-light.min.css' => 'prism-duotone-light',
            'https://lib.baomitu.com/prism-themes/1.9.0/prism-duotone-forest.min.css' => 'prism-duotone-forest',
            'https://lib.baomitu.com/prism-themes/1.9.0/prism-dracula.min.css' => 'prism-dracula',
            'https://lib.baomitu.com/prism-themes/1.9.0/prism-ghcolors.min.css' => 'prism-ghcolors',
        ),
        'https://lib.baomitu.com/prism/1.26.0/themes/prism.min.css',
        '选择一款您喜欢的代码高亮样式',
        '介绍：用于修改代码块的高亮风格 <br>
         其他：如果您有其他样式，可通过源代码修改此项，引入您的自定义样式链接'
    );
    $JPrismTheme->setAttribute('class', 'joe_content joe_post');
    $form->addInput($JPrismTheme->multiMode());
} ?>