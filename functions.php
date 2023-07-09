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
                    <li class="item" data-current="joe_global">基本设置</li>
                    <li class="item" data-current="joe_index">首页设置</li>
                    <li class="item" data-current="joe_aside">侧栏设置</li>
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
    /* 基本设置 */
    $JNavStatus = new Typecho_Widget_Helper_Form_Element_Select(
        'JNavStatus',
        array(
            'on' => '展开（默认）',
            'off' => '合并'
        ),
        'on',
        '分类展开合并',
        '介绍：导航分类默认为展开显示，合并时显示分类下拉菜单'
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
        '页面展开合并',
        '介绍：导航页面默认显示3个，超过设置数的合并'
    );
    $JNavMaxNum->setAttribute('class', 'joe_content joe_global');
    $form->addInput($JNavMaxNum->multiMode());

    $JNavDropdown = new Typecho_Widget_Helper_Form_Element_Select(
        'JNavDropdown',
        array(
            'hover' => '鼠标经过（默认）',
            'click' => '鼠标点击'
        ),
        'hover',
        '下拉菜单显示',
        '介绍：默认为鼠标经过显示下拉菜单，可选择鼠标点击显示'
    );
    $JNavDropdown->setAttribute('class', 'joe_content joe_global');
    $form->addInput($JNavDropdown->multiMode());

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
        '选择鼠标特效'
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
        '选择列表动画'
    );
    $JList_Animate->setAttribute('class', 'joe_content joe_global');
    $form->addInput($JList_Animate->multiMode());

    $JPageStatus = new Typecho_Widget_Helper_Form_Element_Select(
        'JPageStatus',
        array(
            'default' => '普通分页（默认）',
            'ajax' => '加载更多',
        ),
        'default',
        '选择列表分页'
    );
    $JPageStatus->setAttribute('class', 'joe_content joe_global');
    $form->addInput($JPageStatus->multiMode());

    $JFavicon = new Typecho_Widget_Helper_Form_Element_Text(
        'JFavicon',
        NULL,
        NULL,
        'Favicon 图标',
        '介绍：Web 浏览器选项卡中网站标题前的小图标，请填写图片 URL地址 或 Base64 地址 <br />
         制作： <a target="_blank" href="//tool.lu/favicon">tool.lu/favicon</a>'
    );
    $JFavicon->setAttribute('class', 'joe_content joe_global');
    $form->addInput($JFavicon);

    $JLogo = new Typecho_Widget_Helper_Form_Element_Text(
        'JLogo',
        NULL,
        NULL,
        '网站 Logo',
        '介绍：网站的标志性图标，请填写图片 URL地址 或 Base64 地址 <br />
         制作： <a target="_blank" href="//www.uugai.com">www.uugai.com</a>'
    );
    $JLogo->setAttribute('class', 'joe_content joe_global');
    $form->addInput($JLogo);

    $JDocumentTitle = new Typecho_Widget_Helper_Form_Element_Text(
        'JDocumentTitle',
        NULL,
        NULL,
        '网页切换标签时显示的标题',
        '介绍：仅适用于 PC 端，网站标题显示的内容。如果不填写，则默认不开启 <br />
         注意：严禁加单引号或双引号！！！否则会导致网站出错！！'
    );
    $JDocumentTitle->setAttribute('class', 'joe_content joe_global');
    $form->addInput($JDocumentTitle);

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
        '介绍：默认为：https://cravatar.cn/avatar/ <br>
         其他：https://gravatar.helingqi.com/wavatar/ <br>
         注意：填写时，务必保证最后有一个/字符，否则不起作用！'
    );
    $JCustomAvatarSource->setAttribute('class', 'joe_content joe_global');
    $form->addInput($JCustomAvatarSource);

    $JCustomNavs = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JCustomNavs',
        NULL,
        NULL,
        '自定义链接（非必填）',
        '介绍：用于自定义导航栏链接,一行一个,中间使用两个竖杠分隔 <br />
         格式：跳转文字 || 跳转链接 <br />
         例如：小王先森 || https://xwsir.cn'
    );
    $JCustomNavs->setAttribute('class', 'joe_content joe_global');
    $form->addInput($JCustomNavs);

    $JFooter_Tabbar = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JFooter_Tabbar',
        NULL,
        NULL,
        '底部导航（非必填）',
        '介绍：请参考示例填写，一行一个，为空则不显示<br />
         格式：图标 || 名称 || 链接 （中间使用 || 分隔）<br />
         示例：<br />
            zm-home2 || 首页 || index.html <br />
            zm-pinglun3 || 碎语 || cross.html <br />
            zm-guidang || 归档 || archives.html <br />
            zm-wo || 关于 || about.html <br />
            更多图标：<a href="https://www.iconfont.cn/" target="_blank">iconfont 图标库</a> <br />
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
    /* 首页设置 */
    $JIndex_Top_Image = new Typecho_Widget_Helper_Form_Element_Text(
        'JIndex_Top_Image',
        NULL,
        'https://img.xwsir.cn/YJ35kGah13.webp',
        '首页顶部壁纸(非必填)',
        '介绍：用于修改首页顶部背景壁纸，请填写图片地址'
    );
    $JIndex_Top_Image->setAttribute('class', 'joe_content joe_index');
    $form->addInput($JIndex_Top_Image);

    $JIndex_Carousel = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JIndex_Carousel',
        NULL,
        'https://img.xwsir.cn/YJ35kGah13.webp || about.html || 夕阳无限好',
        '首页轮播图',
        '介绍：请务必填写正确的格式，一行一个 <br />
         格式：图片地址 || 跳转链接 || 标题 （中间使用两个竖杠分隔）'
    );
    $JIndex_Carousel->setAttribute('class', 'joe_content joe_index');
    $form->addInput($JIndex_Carousel);

    $JIndex_Recommend = new Typecho_Widget_Helper_Form_Element_Text(
        'JIndex_Recommend',
        NULL,
        NULL,
        '首页推荐文章（非必填）',
        '介绍：请务必填写正确的格式，填写时填 2 个，否则不显示 <br/>
         格式：文章的id || 文章的id （中间使用两个竖杠分隔）'
    );
    $JIndex_Recommend->setAttribute('class', 'joe_content joe_index');
    $form->addInput($JIndex_Recommend);

    $JIndexSticky = new Typecho_Widget_Helper_Form_Element_Text(
        'JIndexSticky',
        NULL,
        NULL,
        '首页置顶文章（非必填）',
        '介绍：请务必填写正确的格式 <br />
         格式：文章的ID || 文章的ID || 文章的ID （中间使用两个竖杠分隔）'
    );
    $JIndexSticky->setAttribute('class', 'joe_content joe_index');
    $form->addInput($JIndexSticky);

    $JIndex_Hot = new Typecho_Widget_Helper_Form_Element_Select(
        'JIndex_Hot',
        array('off' => '关闭（默认）', 'on' => '开启'),
        'off',
        '首页热门文章'
    );
    $JIndex_Hot->setAttribute('class', 'joe_content joe_index');
    $form->addInput($JIndex_Hot->multiMode());

    $JIndex_Notice = new Typecho_Widget_Helper_Form_Element_Text(
        'JIndex_Notice',
        NULL,
        NULL,
        '首页通知文字（非必填）',
        '介绍：请务必填写正确的格式 <br />
         格式：通知文字 || 跳转链接（中间使用两个竖杠分隔，限制一个）'
    );
    $JIndex_Notice->setAttribute('class', 'joe_content joe_index');
    $form->addInput($JIndex_Notice);

    $IndexListStatus = new Typecho_Widget_Helper_Form_Element_Select(
        'IndexListStatus',
        array(
            'default' => '普通模式',
            'ajax' => 'Ajax模式',
        ),
        'default',
        '首页文章列表模式',
        '介绍：选择一款您所喜欢的模式'
    );
    $IndexListStatus->setAttribute('class', 'joe_content joe_index');
    $form->addInput($IndexListStatus->multiMode());

    $IndexListOrder = new Typecho_Widget_Helper_Form_Element_Select(
        'IndexListOrder',
        array(
            'created' => '按时间排序',
            'views' => '按浏览排序',
            'commentsNum' => '按评论排序',
            'agree' => '按点赞排序',
        ),
        'created',
        '首页文章排序方式',
        '介绍：文章列表为Ajax模式时生效，默认按时间排序，请选择一种您所喜欢的呈现形式'
    );
    $IndexListOrder->setAttribute('class', 'joe_content joe_index');
    $form->addInput($IndexListOrder->multiMode());
    /* 侧栏设置 */
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
        '博主昵称 - PC/WAP',
        '介绍：不填写则显示 *个人设置* 里的昵称'
    );
    $JAside_Author_Nick->setAttribute('class', 'joe_content joe_aside');
    $form->addInput($JAside_Author_Nick);

    $JAside_Author_Link = new Typecho_Widget_Helper_Form_Element_Text(
        'JAside_Author_Link',
        NULL,
        "https://xwsir.cn",
        '昵称链接 - PC/WAP',
        '介绍：用于修改博主昵称点击后的跳转地址'
    );
    $JAside_Author_Link->setAttribute('class', 'joe_content joe_aside');
    $form->addInput($JAside_Author_Link);

    $JAside_Author_Avatar = new Typecho_Widget_Helper_Form_Element_Text(
        'JAside_Author_Avatar',
        NULL,
        NULL,
        '博主头像 - PC/WAP',
        '介绍：用于修改博主栏的博主头像 <br />
         注意：如果不填写时则显示 *个人设置* 里的头像'
    );
    $JAside_Author_Avatar->setAttribute('class', 'joe_content joe_aside');
    $form->addInput($JAside_Author_Avatar);

    $JAside_Author_Image = new Typecho_Widget_Helper_Form_Element_Text(
        'JAside_Author_Image',
        NULL,
        NULL,
        '博主背景 - PC/WAP',
        '介绍：博主栏和侧边栏壁纸，请填写图片地址 或 Base64地址'
    );
    $JAside_Author_Image->setAttribute('class', 'joe_content joe_aside');
    $form->addInput($JAside_Author_Image);

    $JAside_Author_Motto = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JAside_Author_Motto',
        NULL,
        "有钱终成眷属，没钱亲眼目睹",
        '座右铭（一言）- PC/WAP',
        '介绍：用于修改博主栏的座右铭（一言） <br />
         格式：可填写一行或多行，填写多行时，每次随机显示其中的某一条，也可以填写API地址 <br />
         其他：API和自定义的座右铭完全可以一起写（换行填写），不会影响 <br />
         注意：API需要开启跨域权限才能调取，否则会调取失败！<br />
         推荐API：https://api.vvhan.com/api/ian'
    );
    $JAside_Author_Motto->setAttribute('class', 'joe_content joe_aside');
    $form->addInput($JAside_Author_Motto);

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
        '随机文章 - PC'
    );
    $JAside_Rand->setAttribute('class', 'joe_content joe_aside');
    $form->addInput($JAside_Rand->multiMode());

    $JAside_Timelife_Status = new Typecho_Widget_Helper_Form_Element_Select(
        'JAside_Timelife_Status',
        array(
            'off' => '关闭（默认）',
            'on' => '开启'
        ),
        'off',
        '倒计时模块 - PC'
    );
    $JAside_Timelife_Status->setAttribute('class', 'joe_content joe_aside');
    $form->addInput($JAside_Timelife_Status->multiMode());

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
        '热门文章 - PC'
    );
    $JAside_Hot_Num->setAttribute('class', 'joe_content joe_aside');
    $form->addInput($JAside_Hot_Num->multiMode());

    $JAside_3DTag = new Typecho_Widget_Helper_Form_Element_Select(
        'JAside_3DTag',
        array(
            'off' => '关闭（默认）',
            'on' => '开启'
        ),
        'off',
        '3D云标签 - PC'
    );
    $JAside_3DTag->setAttribute('class', 'joe_content joe_aside');
    $form->addInput($JAside_3DTag->multiMode());

    $JADContent = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JADContent',
        NULL,
        NULL,
        '侧边栏广告 - PC',
        '格式：广告图片 || 跳转链接 （中间使用两个竖杠分隔）<br />
         注意：如果您只想显示图片不想跳转，可填写：广告图片 || javascript:void(0)'
    );
    $JADContent->setAttribute('class', 'joe_content joe_aside');
    $form->addInput($JADContent);

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
    /* 图片设置 */
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

    $JLazyload = new Typecho_Widget_Helper_Form_Element_Text(
        'JLazyload',
        NULL,
        NULL,
        '自定义懒加载图',
        '介绍：用于修改主题默认懒加载图，请填写图片地址'
    );
    $JLazyload->setAttribute('class', 'joe_content joe_image');
    $form->addInput($JLazyload);

    $JWallpaper_Batten = new Typecho_Widget_Helper_Form_Element_Text(
        'JWallpaper_Batten',
        NULL,
        'https://img.xwsir.cn/5stdVmYIws.webp',
        '自定义BATTEN背景图片（非必填）',
        '介绍：自定义BATTEN背景图片，不填写时显示懒加载图片。<br />
         格式：图片URL地址 或 随机图片API'
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
        '动态背景图 - PC',
        '介绍：仅适用于 PC 端的动态背景'
    );
    $JDynamic_Background->setAttribute('class', 'joe_content joe_image');
    $form->addInput($JDynamic_Background->multiMode());

    $JWallpaper_Background = new Typecho_Widget_Helper_Form_Element_Text(
        'JWallpaper_Background',
        NULL,
        NULL,
        '静态背景图（非必填） - PC/WAP',
        '介绍：不填写时显示默认的灰色。<br />
         格式：图片URL地址 或 随机图片api 例如：https://api.btstu.cn/sjbz/?lx=dongman <br />
         注意：此项优先级最高，若要显示上方动态背景图，请不要填写此项！'
    );
    $JWallpaper_Background->setAttribute('class', 'joe_content joe_image');
    $form->addInput($JWallpaper_Background);
    /* 其他设置 */
    $JFriendsIndex = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JFriendsIndex',
        NULL,
        NULL,
        '首页链接（非必填）',
        '介绍：首页底部友情链接，请参考格式填写，一行一个 <br />
         格式：博客名称 || 博客地址 || 博客头像 || 博客简介'
    );
    $JFriendsIndex->setAttribute('class', 'joe_content joe_other');
    $form->addInput($JFriendsIndex);

    $JFriends = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JFriends',
        NULL,
        NULL,
        '友情链接（非必填）',
        '介绍：友情页面友情链接，请参考格式填写，一行一个 <br />
         格式：博客名称 || 博客地址 || 博客头像 || 博客简介 <br />
         注意：请先创建独立页面-模板选择友链，该项才会生效'
    );
    $JFriends->setAttribute('class', 'joe_content joe_other');
    $form->addInput($JFriends);

    $JCommentStatus = new Typecho_Widget_Helper_Form_Element_Select(
        'JCommentStatus',
        array(
            'on' => '开启（默认）',
            'off' => '关闭'
        ),
        'on',
        '全站评论开关',
        '介绍：开启或关闭所有页面的评论 <br>
         注意：此处的权重优先级最高，若关闭此项，所有评论皆为关闭状态'
    );
    $JCommentStatus->setAttribute('class', 'joe_content joe_global');
    $form->addInput($JCommentStatus->multiMode());

    $commentDraw = new Typecho_Widget_Helper_Form_Element_Select(
        'commentDraw',
        array('off' => '关闭（默认）', 'on' => '开启'),
        'off',
        '文章评论画图',
        '介绍：默认关闭画图功能，开启时显示画图板'
    );
    $commentDraw->setAttribute('class', 'joe_content joe_other');
    $form->addInput($commentDraw);

    $JSensitiveWords = new Typecho_Widget_Helper_Form_Element_Textarea(
        'JSensitiveWords',
        NULL,
        '你妈死了 || 傻逼 || 操你妈 || 射你妈一脸',
        '评论敏感词（非必填）',
        '介绍：如果用户评论包含这些词汇，则将会把评论置为审核状态（多个使用 || 分隔开）'
    );
    $JSensitiveWords->setAttribute('class', 'joe_content joe_other');
    $form->addInput($JSensitiveWords);

    $JLimitOneChinese = new Typecho_Widget_Helper_Form_Element_Select(
        'JLimitOneChinese',
        array(
            'off' => '关闭（默认）',
            'on' => '开启'
        ),
        'off',
        '评论至少包含一个中文',
        '介绍：如果评论内容未包含一个中文，则将会把评论置为审核状态'
    );
    $JLimitOneChinese->setAttribute('class', 'joe_content joe_other');
    $form->addInput($JLimitOneChinese->multiMode());

    $JTextLimit = new Typecho_Widget_Helper_Form_Element_Text(
        'JTextLimit',
        NULL,
        NULL,
        '评论最大字符',
        '介绍：如果用户评论的内容超出字符限制，则将会把评论置为审核状态 <br />
         其他：请输入数字格式，不填写则不限制'
    );
    $JTextLimit->setAttribute('class', 'joe_content joe_other');
    $form->addInput($JTextLimit->multiMode());

    $JBaiduToken = new Typecho_Widget_Helper_Form_Element_Text(
        'JBaiduToken',
        NULL,
        NULL,
        '百度推送Token',
        '介绍：填写此处，前台文章页如果未收录，则会自动将当前链接推送给百度加快收录 <br />
         其他：Token在百度收录平台注册账号获取'
    );
    $JBaiduToken->setAttribute('class', 'joe_content joe_other');
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
        '代码高亮样式',
        '介绍：用于修改代码块的高亮风格 <br>
         其他：如果您有其他样式，可通过源代码修改此项，引入您的自定义样式链接'
    );
    $JPrismTheme->setAttribute('class', 'joe_content joe_other');
    $form->addInput($JPrismTheme->multiMode());

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
        'SiteMap 功能',
        '介绍：开启后博客将享有SiteMap功能，链接为博客最新实时链接 <br />
         好处：无需手动生成，无需频繁提交，提交一次即可 <br />
         访问地址：<br />
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
        '评论邮件通知',
        '介绍：请完整无错的填写下方的邮箱设置，推荐使用QQ邮箱'
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
        array(
            'ssl' => 'ssl（默认）',
            'tsl' => 'tsl'
        ),
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
        '发件人昵称'
    );
    $JCommentMailFromName->setAttribute('class', 'joe_content joe_other');
    $form->addInput($JCommentMailFromName->multiMode());

    $JCommentMailAccount = new Typecho_Widget_Helper_Form_Element_Text(
        'JCommentMailAccount',
        NULL,
        NULL,
        '发件人邮箱'
    );
    $JCommentMailAccount->setAttribute('class', 'joe_content joe_other');
    $form->addInput($JCommentMailAccount->multiMode());

    $JCommentMailPassword = new Typecho_Widget_Helper_Form_Element_Text(
        'JCommentMailPassword',
        NULL,
        NULL,
        '邮箱授权码',
        '介绍：这里填写的是邮箱生成的授权码 <br>
         获取方式：QQ邮箱 > 设置 > 账户 > IMAP/SMTP服务 > 开启'
    );
    $JCommentMailPassword->setAttribute('class', 'joe_content joe_other');
    $form->addInput($JCommentMailPassword->multiMode());

    $JReader_Ranking = new Typecho_Widget_Helper_Form_Element_Select(
        'JReader_Ranking',
        array(
            'off' => '关闭（默认）', 
            'on' => '开启'
        ),
        'off',
        '读者排行榜',
        '介绍：开启后将在留言页面呈现，按用户评论数由高到低排序'
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
        '时间显示范围（默认为 180 天）'
    );
    $JReader_Ranking_Time->setAttribute('class', 'joe_content joe_other');
    $form->addInput($JReader_Ranking_Time->multiMode());

    $JReader_Ranking_Mail = new Typecho_Widget_Helper_Form_Element_Text(
        'JReader_Ranking_Mail',
        NULL,
        NULL,
        '排除不上榜邮箱'
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
        '最近读者显示（默认为 30 个）'
    );
    $JReader_Ranking_Limit->setAttribute('class', 'joe_content joe_other');
    $form->addInput($JReader_Ranking_Limit->multiMode());
} ?>