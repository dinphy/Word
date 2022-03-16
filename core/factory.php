<?php

require_once("phpmailer.php");
require_once("smtp.php");

/* 加强评论拦截功能 */
Typecho_Plugin::factory('Widget_Feedback')->comment = array('Intercept', 'message');
class Intercept
{
    public static function message($comment)
    {
        /* 用户输入内容画图模式 */
        if (preg_match('/\{!\{(.*)\}!\}/', $comment['text'], $matches)) {
            /* 如果判断是否有双引号，如果有双引号，则禁止评论 */
            if (strpos($matches[1], '"') !== false || _checkXSS($matches[1])) {
                $comment['status'] = 'waiting';
            }
            /* 普通评论 */
        } else {
            /* 判断用户输入是否大于字符 */
            if (Helper::options()->JTextLimit && strlen($comment['text']) > Helper::options()->JTextLimit) {
                $comment['status'] = 'waiting';
            } else {
                /* 判断评论内容是否包含敏感词 */
                if (Helper::options()->JSensitiveWords) {
                    if (_checkSensitiveWords(Helper::options()->JSensitiveWords, $comment['text'])) {
                        $comment['status'] = 'waiting';
                    }
                }
                /* 判断评论是否至少包含一个中文 */
                if (Helper::options()->JLimitOneChinese === "on") {
                    if (preg_match("/[\x{4e00}-\x{9fa5}]/u", $comment['text']) == 0) {
                        $comment['status'] = 'waiting';
                    }
                }
            }
        }
        Typecho_Cookie::delete('__typecho_remember_text');
        return $comment;
    }
}

/* 邮件通知 */
if (
    Helper::options()->JCommentMail === 'on' &&
    Helper::options()->JCommentMailHost &&
    Helper::options()->JCommentMailPort &&
    Helper::options()->JCommentMailFromName &&
    Helper::options()->JCommentMailAccount &&
    Helper::options()->JCommentMailPassword &&
    Helper::options()->JCommentSMTPSecure
) {
    Typecho_Plugin::factory('Widget_Feedback')->finishComment = array('Email', 'send');
}

class Email
{
    public static function send($comment)
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->CharSet = 'UTF-8';
        $mail->SMTPSecure = Helper::options()->JCommentSMTPSecure;
        $mail->Host = Helper::options()->JCommentMailHost;
        $mail->Port = Helper::options()->JCommentMailPort;
        $mail->FromName = Helper::options()->JCommentMailFromName;
        $mail->Username = Helper::options()->JCommentMailAccount;
        $mail->From = Helper::options()->JCommentMailAccount;
        $mail->Password = Helper::options()->JCommentMailPassword;
        $mail->isHTML(true);
        $text = $comment->text;
        $text = preg_replace_callback(
            '/\:\:\(\s*(呵呵|哈哈|吐舌|太开心|笑眼|花心|小乖|乖|捂嘴笑|滑稽|你懂的|不高兴|怒|汗|黑线|泪|真棒|喷|惊哭|阴险|鄙视|酷|啊|狂汗|what|疑问|酸爽|呀咩爹|委屈|惊讶|睡觉|笑尿|挖鼻|吐|犀利|小红脸|懒得理|勉强|爱心|心碎|玫瑰|礼物|彩虹|太阳|星星月亮|钱币|茶杯|蛋糕|大拇指|胜利|haha|OK|沙发|手纸|香蕉|便便|药丸|红领巾|蜡烛|音乐|灯泡|开心|钱|咦|呼|冷|生气|弱|吐血|狗头)\s*\)/is',
            function ($match) {
                return '<img style="max-height: 22px;" src="' . Helper::options()->themeUrl . '/assets/owo/paopao/' . str_replace('%', '', urlencode($match[1])) . '_2x.png"/>';
            },
            $text
        );
        $text = preg_replace_callback(
            '/\:\@\(\s*(高兴|小怒|脸红|内伤|装大款|赞一个|害羞|汗|吐血倒地|深思|不高兴|无语|亲亲|口水|尴尬|中指|想一想|哭泣|便便|献花|皱眉|傻笑|狂汗|吐|喷水|看不见|鼓掌|阴暗|长草|献黄瓜|邪恶|期待|得意|吐舌|喷血|无所谓|观察|暗地观察|肿包|中枪|大囧|呲牙|抠鼻|不说话|咽气|欢呼|锁眉|蜡烛|坐等|击掌|惊喜|喜极而泣|抽烟|不出所料|愤怒|无奈|黑线|投降|看热闹|扇耳光|小眼睛|中刀)\s*\)/is',
            function ($match) {
                return '<img style="max-height: 22px;" src="' . Helper::options()->themeUrl . '/assets/owo/aru/' . str_replace('%', '', urlencode($match[1])) . '_2x.png"/>';
            },
            $text
        );
        $text = preg_replace('/\{!\{([^\"]*)\}!\}/', '<img style="max-width: 100%;vertical-align: middle;" src="$1"/>', $text);
        $html = '
            <style>.Joe{width:550px;margin:0 auto;border-radius:8px;overflow:hidden;font-family:"Helvetica Neue",Helvetica,"PingFang SC","Hiragino Sans GB","Microsoft YaHei","微软雅黑",Arial,sans-serif;box-shadow:0 2px 12px 0 rgba(0,0,0,0.1);word-break:break-all}.Joe_title{color:#fff;background:linear-gradient(-45deg,rgba(9,69,138,0.2),rgba(68,155,255,0.7),rgba(117,113,251,0.7),rgba(68,155,255,0.7),rgba(9,69,138,0.2));background-size:400% 400%;background-position:50% 100%;padding:15px;font-size:15px;line-height:1.5}</style>
            <div class="Joe"><div class="Joe_title">{title}</div><div style="background: #fff;padding: 20px;font-size: 13px;color: #666;"><div style="margin-bottom: 20px;line-height: 1.5;">{subtitle}</div><div style="padding: 15px;margin-bottom: 20px;line-height: 1.5;background: repeating-linear-gradient(145deg, #f2f6fc, #f2f6fc 15px, #fff 0, #fff 25px);">{content}</div><div style="line-height: 2">请注意：此邮件由系统自动发送，请勿直接回复。<br>若此邮件不是您请求的，请忽略并删除！</div></div></div>
        ';
        /* 如果是博主发的评论 */
        if ($comment->authorId == $comment->ownerId) {
            /* 发表的评论是回复别人 */
            if ($comment->parent != 0) {
                $db = Typecho_Db::get();
                $parentInfo = $db->fetchRow($db->select('mail')->from('table.comments')->where('coid = ?', $comment->parent));
                $parentMail = $parentInfo['mail'];
                /* 被回复的人不是自己时，发送邮件 */
                if ($parentMail != $comment->mail) {
                    $mail->Body = strtr(
                        $html,
                        array(
                            "{title}" => '您在 [' . $comment->title . '] 的评论有了新的回复！',
                            "{subtitle}" => '博主：[ ' . $comment->author . ' ] 在《 <a style="color: #12addb;text-decoration: none;" href="' . substr($comment->permalink, 0, strrpos($comment->permalink, "#")) . '" target="_blank">' . $comment->title . '</a> 》上回复了您:',
                            "{content}" => $text,
                        )
                    );
                    $mail->addAddress($parentMail);
                    $mail->Subject = '您在 [' . $comment->title . '] 的评论有了新的回复！';
                    $mail->send();
                }
            }
            /* 如果是游客发的评论 */
        } else {
            /* 如果是直接发表的评论，不是回复别人，那么发送邮件给博主 */
            if ($comment->parent == 0) {
                $db = Typecho_Db::get();
                $authoInfo = $db->fetchRow($db->select()->from('table.users')->where('uid = ?', $comment->ownerId));
                $authorMail = $authoInfo['mail'];
                if ($authorMail) {
                    $mail->Body = strtr(
                        $html,
                        array(
                            "{title}" => '您的文章 [' . $comment->title . '] 收到一条新的评论！',
                            "{subtitle}" => $comment->author . ' [' . $comment->ip . '] 在您的《 <a style="color: #12addb;text-decoration: none;" href="' . substr($comment->permalink, 0, strrpos($comment->permalink, "#")) . '" target="_blank">' . $comment->title . '</a> 》上发表评论:',
                            "{content}" => $text,
                        )
                    );
                    $mail->addAddress($authorMail);
                    $mail->Subject = '您的文章 [' . $comment->title . '] 收到一条新的评论！';
                    $mail->send();
                }
                /* 如果发表的评论是回复别人 */
            } else {
                $db = Typecho_Db::get();
                $parentInfo = $db->fetchRow($db->select('mail')->from('table.comments')->where('coid = ?', $comment->parent));
                $parentMail = $parentInfo['mail'];
                /* 被回复的人不是自己时，发送邮件 */
                if ($parentMail != $comment->mail) {
                    $mail->Body = strtr(
                        $html,
                        array(
                            "{title}" => '您在 [' . $comment->title . '] 的评论有了新的回复！',
                            "{subtitle}" => $comment->author . ' 在《 <a style="color: #12addb;text-decoration: none;" href="' . substr($comment->permalink, 0, strrpos($comment->permalink, "#")) . '" target="_blank">' . $comment->title . '</a> 》上回复了您:',
                            "{content}" => $text,
                        )
                    );
                    $mail->addAddress($parentMail);
                    $mail->Subject = '您在 [' . $comment->title . '] 的评论有了新的回复！';
                    $mail->send();
                }
            }
        }
    }
}

Typecho_Plugin::factory('admin/write-post.php')->bottom = array('editor', 'reset');
Typecho_Plugin::factory('admin/write-page.php')->bottom = array('editor', 'reset');
class editor
{
    public static function reset()
    {
        Typecho_Widget::widget('Widget_Options')->to($options);
?>

        <style>
            .wmd-button.custom {
                width: 20px;
                height: 20px;
                line-height: 20px;
                text-align: center;
            }

            .wmd-button.custom svg {
                width: 15px;
                height: 15px;
                fill: #888888;
                vertical-align: middle;
            }

            body.fullscreen {
                overflow-x: hidden;
            }

            .wmd-button-row {
                height: auto;
            }

            #custom-field .typecho-list-table tbody textarea {
                width: 100%;
                height: 100px;
            }

            #custom-field .typecho-list-table tbody input[type="text"] {
                width: 100%;
            }

            #j-wmd-expand {
                position: relative;
            }

            #j-wmd-expand .dropdown {
                position: absolute;
                visibility: hidden;
                opacity: 0;
                transition: visibility 0.35s, opacity 0.35s, transform 0.35s;
                transform: translate3d(0, 15px, 0);
                left: -8px;
                top: 33px;
                padding: 5px;
                background: #F6F6F3;
                border: 1px solid #D9D9D6;
            }

            #j-wmd-expand .dropdown.active {
                transform: translate3d(0, 0, 0);
                opacity: 1;
                visibility: visible;
            }

            #j-wmd-expand .dropdown:before {
                content: "";
                position: absolute;
                top: -7px;
                left: 50%;
                transform: translateX(-50%);
                width: 0;
                height: 0;
                border-left: 7px solid transparent;
                border-right: 7px solid transparent;
                border-bottom: 7px solid #D9D9D6;
            }

            #j-wmd-expand .dropdown .content .item {
                line-height: 1.5;
                cursor: pointer;
                padding: 5px;
            }

            #j-wmd-expand .dropdown .content svg {
                width: 18px;
                height: 18px;
                fill: #888888;
                vertical-align: middle;
            }

            #j-wmd-expand .dropdown .content .item:hover {
                background: #E9E9E6;
            }
        </style>
        <script>
            $(function() {
                $("#wmd-button-row .wmd-spacer").remove()
                $("#wmd-button-row #wmd-code-button").remove()
                $("#wmd-fullscreen-button").on("click", function() {
                    $(".fullscreen #text").css("top", $('.fullscreen #wmd-button-bar').outerHeight())
                })
                $("#wmd-button-row #wmd-fullscreen-button").before(`
                    <li class="wmd-button custom" id="j-wmd-expand" title="更多功能">
                        <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M128 640c70.656 0 128-57.344 128-128S198.656 384 128 384 0 441.344 0 512 57.344 640 128 640zM512 640c70.656 0 128-57.344 128-128S582.656 384 512 384 384 441.344 384 512 441.344 640 512 640zM896 640c70.656 0 128-57.344 128-128s-57.344-128-128-128-128 57.344-128 128S825.344 640 896 640z"></path></svg>
                        <div class="dropdown">
                            <div class="content">
                                <div class="item" id="j-wmd-tab" title="标签选卡">
                                    <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M483.2 480l-89.6 224h41.6l22.4-57.6h99.2L576 704h41.6L528 480h-44.8z m-16 137.6l38.4-99.2 38.4 99.2h-76.8zM192 512h76.8v192h38.4V512h80v-32H192z m592 73.6c12.8-3.2 22.4-9.6 28.8-19.2 6.4-9.6 9.6-19.2 9.6-32 0-16-6.4-32-19.2-41.6-12.8-9.6-32-16-54.4-16H640v224h108.8c25.6 0 44.8-3.2 57.6-12.8 16-9.6 25.6-28.8 25.6-51.2 0-16-3.2-28.8-12.8-35.2-6.4-6.4-19.2-12.8-35.2-16z m-105.6-76.8h60.8c16 0 28.8 3.2 35.2 6.4 6.4 3.2 9.6 12.8 9.6 22.4 0 12.8-3.2 19.2-9.6 25.6-6.4 6.4-19.2 6.4-35.2 6.4h-60.8v-60.8z m99.2 160c-9.6 3.2-19.2 6.4-35.2 6.4h-64v-70.4h64c16 0 28.8 3.2 38.4 9.6 6.4 6.4 12.8 16 12.8 28.8 0 9.6-6.4 19.2-16 25.6zM96 128h384c19.2 0 32-12.8 32-32s-16-32-32-32H96c-19.2 0-32 12.8-32 32s16 32 32 32z"></path><path d="M896 192H128c-35.2 0-64 28.8-64 64v640c0 35.2 28.8 64 64 64h768c35.2 0 64-28.8 64-64V256c0-35.2-28.8-64-64-64z m0 672c0 16-12.8 32-32 32H160c-19.2 0-32-16-32-32V288c0-16 12.8-32 32-32h704c19.2 0 32 16 32 32v576z"></path></svg>
                                </div>
                                <div class="item" id="j-wmd-timeline" title="时间轴">
                                    <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M562.3 344.5h283.5c18.6 0 33.6-15 33.6-33.6s-15-33.6-33.6-33.6H562.3c-18.6 0-33.6 15-33.6 33.6s15.1 33.6 33.6 33.6zM845.8 663.3H562.3c-18.6 0-33.6 15-33.6 33.6s15 33.6 33.6 33.6h283.5c18.6 0 33.6-15 33.6-33.6 0-18.5-15-33.6-33.6-33.6zM412.5 310.9c0-62.3-42.7-114.8-100.4-129.7V98.7c0-18.6-15-33.6-33.6-33.6s-33.6 15-33.6 33.6v82.4c-57.7 14.9-100.4 67.4-100.4 129.7S187.3 425.6 245 440.6v126.7c-57.7 14.9-100.4 67.4-100.4 129.7S187.3 811.7 245 826.6v98.6c0 18.6 15 33.6 33.6 33.6s33.6-15 33.6-33.6v-98.6c57.7-14.9 100.4-67.4 100.4-129.7s-42.7-114.8-100.4-129.7V440.6c57.6-15 100.3-67.5 100.3-129.7z m-200.7 0c0-36.8 30-66.8 66.8-66.8s66.8 30 66.8 66.8-30 66.8-66.8 66.8c-36.9-0.1-66.8-30-66.8-66.8z m133.5 386c0 36.8-30 66.8-66.8 66.8s-66.8-30-66.8-66.8 30-66.8 66.8-66.8c36.9 0.1 66.8 30 66.8 66.8z"></path></svg>
                                </div>
                                <div class="item" id="j-wmd-collapse" title="展开折叠">
                                    <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M774.4 246.4c-6.4-6.4-16-9.6-22.4-9.6-9.6 0-16 3.2-22.4 9.6l-67.2 67.2c-12.8 12.8-12.8 32 0 44.8 12.8 12.8 32 12.8 44.8 0l44.8-44.8 44.8 44.8c12.8 12.8 32 12.8 44.8 0 12.8-12.8 12.8-32 0-44.8l-67.2-67.2z"></path><path d="M896 128H128c-35.2 0-64 28.8-64 64v640c0 35.2 28.8 64 64 64h768c35.2 0 64-28.8 64-64V192c0-35.2-28.8-64-64-64z m0 672c0 16-12.8 32-32 32H160c-19.2 0-32-16-32-32V480h768v320z m0-384H128V224c0-16 12.8-32 32-32h704c19.2 0 32 16 32 32v192z"></path></svg>
                                </div>
                                <div class="item" id="j-wmd-reply" title="回复可见">
                                    <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M942.3 486.4l-0.1-0.1-0.1-0.1c-36.4-76.7-80-138.7-130.7-186L760.7 351c43.7 40.2 81.5 93.7 114.1 160.9C791.5 684.2 673.4 766 512 766c-51.3 0-98.3-8.3-141.2-25.1l-54.7 54.7C374.6 823.8 439.8 838 512 838c192.2 0 335.4-100.5 430.2-300.3 7.7-16.2 7.7-35 0.1-51.3z m-64-332.2l-42.4-42.4c-3.1-3.1-8.2-3.1-11.3 0L707.8 228.5C649.4 200.2 584.2 186 512 186c-192.2 0-335.4 100.5-430.2 300.3v0.1c-7.7 16.2-7.7 35.2 0 51.5 36.4 76.7 80 138.7 130.7 186.1L111.8 824.5c-3.1 3.1-3.1 8.2 0 11.3l42.4 42.4c3.1 3.1 8.2 3.1 11.3 0l712.8-712.8c3.1-3 3.1-8.1 0-11.2zM398.9 537.4c-1.9-8.2-2.9-16.7-2.9-25.4 0-61.9 50.1-112 112-112 8.7 0 17.3 1 25.4 2.9L398.9 537.4z m184.5-184.5C560.5 342.1 535 336 508 336c-97.2 0-176 78.8-176 176 0 27 6.1 52.5 16.9 75.4L263.3 673c-43.7-40.2-81.5-93.7-114.1-160.9C232.6 339.8 350.7 258 512 258c51.3 0 98.3 8.3 141.2 25.1l-69.8 69.8z"></path><path d="M508 624c-6.4 0-12.7-0.5-18.8-1.6l-51.1 51.1c21.4 9.3 45.1 14.4 69.9 14.4 97.2 0 176-78.8 176-176 0-24.8-5.1-48.5-14.4-69.9l-51.1 51.1c1 6.1 1.6 12.4 1.6 18.8C620 573.9 569.9 624 508 624z"></path></svg>
                                </div>
                                <div class="item" id="j-wmd-card" title="卡片描述">
                                    <svg viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="20" height="20"><path d="M167.830915 233.164411 856.168062 233.164411 856.168062 439.666578 167.830915 439.666578 167.830915 233.164411Z" p-id="213185"></path><path d="M854.529749 64.580854l-66.00325 0 0 38.987966 66.00325 0L854.529749 64.580854 854.529749 64.580854zM749.640863 64.580854l-66.00325 0 0 38.987966 66.00325 0L749.640863 64.580854 749.640863 64.580854zM644.751978 64.580854l-66.00325 0 0 38.987966 66.00325 0L644.751978 64.580854 644.751978 64.580854zM539.863093 64.580854l-66.00325 0 0 38.987966 66.00325 0L539.863093 64.580854 539.863093 64.580854zM434.974207 64.580854l-66.00325 0 0 38.987966 66.00325 0L434.974207 64.580854 434.974207 64.580854zM330.085322 64.580854l-66.00325 0 0 38.987966 66.00325 0L330.085322 64.580854 330.085322 64.580854zM225.196437 64.580854l-66.00325 0 0 38.987966 66.00325 0L225.196437 64.580854 225.196437 64.580854zM120.307551 64.580854 64.580343 64.580854l0 38.987966 55.727209 0L120.307551 64.580854 120.307551 64.580854zM103.568309 113.741507l-38.987966 0 0 66.00325 38.987966 0L103.568309 113.741507 103.568309 113.741507zM103.568309 218.630393l-38.987966 0 0 66.00325 38.987966 0L103.568309 218.630393 103.568309 218.630393zM103.568309 323.519278l-38.987966 0 0 66.00325 38.987966 0L103.568309 323.519278 103.568309 323.519278zM103.568309 428.408163l-38.987966 0 0 66.00325 38.987966 0L103.568309 428.408163 103.568309 428.408163zM103.568309 533.297049l-38.987966 0 0 66.00325 38.987966 0L103.568309 533.297049 103.568309 533.297049zM103.568309 638.185934l-38.987966 0 0 66.00325 38.987966 0L103.568309 638.185934 103.568309 638.185934zM103.568309 743.074819l-38.987966 0 0 66.00325 38.987966 0L103.568309 743.074819 103.568309 743.074819zM103.568309 847.963705l-38.987966 0 0 66.00325 38.987966 0L103.568309 847.963705 103.568309 847.963705zM124.017036 920.43118 64.580343 920.43118l0 32.42141 0 0 0-32.42141 0 32.42141 0 0 0 6.566556 38.987966 0 0 0 0 0 0 0 0 0c11.20111 0 20.448728 0 20.448728 0L124.017036 920.43118 124.017036 920.43118zM228.905922 920.43118l-66.00325 0 0 38.987966 66.00325 0L228.905922 920.43118 228.905922 920.43118zM333.794807 920.43118l-66.00325 0 0 38.987966 66.00325 0L333.794807 920.43118 333.794807 920.43118zM438.683692 920.43118l-66.00325 0 0 38.987966 66.00325 0L438.683692 920.43118 438.683692 920.43118zM543.572578 920.43118l-66.00325 0 0 38.987966 66.00325 0L543.572578 920.43118 543.572578 920.43118zM648.461463 920.43118l-66.00325 0 0 38.987966 66.00325 0L648.461463 920.43118 648.461463 920.43118zM753.350348 920.43118l-66.00325 0 0 38.987966 66.00325 0L753.350348 920.43118 753.350348 920.43118zM858.239234 920.43118l-66.00325 0 0 38.987966 66.00325 0L858.239234 920.43118 858.239234 920.43118zM959.418634 920.43118l-62.293765 0 0 38.987966 62.293765 0L959.418634 920.43118 959.418634 920.43118zM959.418634 850.820776l-38.987966 0 0 66.00325 38.987966 0L959.418634 850.820776 959.418634 850.820776zM959.418634 745.93189l-38.987966 0 0 66.00325 38.987966 0L959.418634 745.93189 959.418634 745.93189zM959.418634 641.043005l-38.987966 0 0 66.00325 38.987966 0L959.418634 641.043005 959.418634 641.043005zM959.418634 536.15412l-38.987966 0 0 66.00325 38.987966 0L959.418634 536.15412 959.418634 536.15412zM959.418634 431.265234l-38.987966 0 0 66.00325 38.987966 0L959.418634 431.265234 959.418634 431.265234zM959.418634 326.376349l-38.987966 0 0 66.00325 38.987966 0L959.418634 326.376349 959.418634 326.376349zM959.418634 221.487463l-38.987966 0 0 66.00325 38.987966 0L959.418634 221.487463 959.418634 221.487463zM959.418634 116.598578l-38.987966 0 0 66.00325 38.987966 0L959.418634 116.598578 959.418634 116.598578zM959.418634 64.580854l-66.00325 0 0 38.987966 66.00325 0L959.418634 64.580854 959.418634 64.580854z"></path></svg>
                                </div>
                                <div class="item" id="j-wmd-code" title="代码块">
                                    <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M958.17 447.4L760.69 249.92l-65.82 65.83 197.47 197.47L694.87 710.7l65.82 65.82 197.48-197.47 65.83-65.83zM263.3 249.92L65.82 447.4 0 513.22l65.82 65.83L263.3 776.52l65.82-65.82-197.47-197.48 197.47-197.47zM343.247 949.483L590.96 52.19l89.72 24.768-247.713 897.295z"></path></svg>
                                </div>
                                <div class="item" id="j-wmd-mtitle" title="居中标题">
                                    <svg viewBox="0 0 1025 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M983.04 772.48H44.16a37.76 37.76 0 0 1 0-74.88h938.88a37.76 37.76 0 1 1 0 74.88z" fill="#888888" p-id="62196"></path><path d="M27.52 348.16h211.2V384H154.24v222.08h-42.24V384H27.52zM269.44 348.16h42.24v256h-42.24zM342.4 348.16h211.84V384H469.76v222.08h-42.24V384H342.4zM584.96 348.16h41.6v222.08H768v35.84H584.96zM798.72 348.16h186.24V384h-144v71.68h135.68v36.48h-135.68v78.08h150.4v35.84h-192z"></path></svg>
                                </div>
                            </div>
                        </div>
                </li>`)
                /* $("#j-wmd-expand").on("click", function() {
                    $('.dropdown').toggle();
                }) */
                $('#j-wmd-expand').hover(
					() => $('#j-wmd-expand .dropdown').addClass('active'),
					() => $('#j-wmd-expand .dropdown').removeClass('active')
				);

                $("#j-wmd-tab").on("click", function() {
                    insertAtCursor('{tabs}\n{tabs-pane label="标签一"}\n 标签一内容\n{/tabs-pane}\n{tabs-pane label="标签二"}\n 标签二内容\n{/tabs-pane}\n{/tabs}\n');
                })
                $("#j-wmd-timeline").on("click", function() {
                    insertAtCursor('{timeline}\n{timeline-item color="#19be6b"}\n 时间节点一\n{/timeline-item}\n{timeline-item color="#ed4014"}\n 时间节点二\n{/timeline-item}\n{/timeline}\n');
                })
                $("#j-wmd-collapse").on("click", function() {
                    insertAtCursor('{collapse}\n{collapse-item label="折叠标题一" open}\n 折叠内容一\n{/collapse-item}\n{collapse-item label="折叠标题二"}\n 折叠内容二\n{/collapse-item}\n{/collapse}\n');
                })
                $("#j-wmd-reply").on("click", function() {
                    insertAtCursor('{hide}\n回复可见的内容\n{/hide}\n');
                })
                $("#j-wmd-card").on("click", function() {
                    insertAtCursor('{card-describe title="卡片描述"}\n卡片内容\n{/card-describe}\n');
                })
                $("#j-wmd-code").on("click", function() {
                    insertAtCursor('\`\`\`html\ncode here...\n\`\`\`\n');
                })
                $("#j-wmd-mtitle").on("click", function() {
                    insertAtCursor('{mtitle title="要居中的内容"/}\n');
                })

                function insertAtCursor(myValue, myField = $('#text')[0]) {
                    if (document.selection) {
                        myField.focus();
                        sel = document.selection.createRange();
                        sel.text = myValue;
                        sel.select();
                    } else if (myField.selectionStart || myField.selectionStart == '0') {
                        var startPos = myField.selectionStart;
                        var endPos = myField.selectionEnd;
                        var restoreTop = myField.scrollTop;
                        myField.value = myField.value.substring(0, startPos) + myValue + myField.value.substring(endPos, myField.value.length);
                        if (restoreTop > 0) {
                            myField.scrollTop = restoreTop;
                        }
                        myField.focus();
                        myField.selectionStart = startPos + myValue.length;
                        myField.selectionEnd = startPos + myValue.length;
                    } else {
                        myField.value += myValue;
                        myField.focus();
                    }
                }
            })
        </script>
<?php }
} ?>