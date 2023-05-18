<?php
/* 获取主题当前版本号 */
function _getVersion()
{
	$info = Typecho_Plugin::parseInfo(Helper::options()->themeFile(Helper::options()->theme, 'index.php'));
	return $info['version'];
};

/* 判断是否是手机 */
function _isMobile()
{
	if (isset($_SERVER['HTTP_X_WAP_PROFILE']))
		return true;
	if (isset($_SERVER['HTTP_VIA'])) {
		return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
	}
	if (isset($_SERVER['HTTP_USER_AGENT'])) {
		$clientkeywords = array('nokia', 'sony', 'ericsson', 'mot', 'samsung', 'htc', 'sgh', 'lg', 'sharp', 'sie-', 'philips', 'panasonic', 'alcatel', 'lenovo', 'iphone', 'ipod', 'blackberry', 'meizu', 'android', 'netfront', 'symbian', 'ucweb', 'windowsce', 'palm', 'operamini', 'operamobi', 'openwave', 'nexusone', 'cldc', 'midp', 'wap', 'mobile');
		if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
			return true;
	}
	if (isset($_SERVER['HTTP_ACCEPT'])) {
		if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
			return true;
		}
	}
	return false;
}

/* 根据评论agent获取浏览器类型 */
function _getAgentBrowser($agent)
{
	if (preg_match('/MSIE\s([^\s|;]+)/i', $agent, $regs)) {
		$outputer = 'Internet Explore';
	} else if (preg_match('/FireFox\/([^\s]+)/i', $agent, $regs)) {
		$outputer = 'FireFox';
	} else if (preg_match('/Maxthon([\d]*)\/([^\s]+)/i', $agent, $regs)) {
		$outputer = 'MicroSoft Edge';
	} else if (preg_match('#360([a-zA-Z0-9.]+)#i', $agent, $regs)) {
		$outputer = '360 Fast Browser';
	} else if (preg_match('/Edge([\d]*)\/([^\s]+)/i', $agent, $regs)) {
		$outputer = 'MicroSoft Edge';
	} else if (preg_match('/UC/i', $agent)) {
		$outputer = 'UC Browser';
	} else if (preg_match('/QQ/i', $agent, $regs) || preg_match('/QQ Browser\/([^\s]+)/i', $agent, $regs)) {
		$outputer = 'QQ Browser';
	} else if (preg_match('/UBrowser/i', $agent, $regs)) {
		$outputer = 'UC Browser';
	} else if (preg_match('/Opera[\s|\/]([^\s]+)/i', $agent, $regs)) {
		$outputer = 'Opera';
	} else if (preg_match('/Chrome([\d]*)\/([^\s]+)/i', $agent, $regs)) {
		$outputer = 'Google Chrome';
	} else if (preg_match('/safari\/([^\s]+)/i', $agent, $regs)) {
		$outputer = 'Safari';
	} else {
		$outputer = 'Google Chrome';
	}
	echo $outputer;
}

/* 根据评论agent获取设备类型 */
function _getAgentOS($agent)
{
	$os = "Linux";
	if (preg_match('/win/i', $agent)) {
		if (preg_match('/nt 6.0/i', $agent)) {
			$os = 'Windows Vista';
		} else if (preg_match('/nt 6.1/i', $agent)) {
			$os = 'Windows 7';
		} else if (preg_match('/nt 6.2/i', $agent)) {
			$os = 'Windows 8';
		} else if (preg_match('/nt 6.3/i', $agent)) {
			$os = 'Windows 8.1';
		} else if (preg_match('/nt 5.1/i', $agent)) {
			$os = 'Windows XP';
		} else if (preg_match('/nt 10.0/i', $agent)) {
			$os = 'Windows 10';
		} else {
			$os = 'Windows X64';
		}
	} else if (preg_match('/android/i', $agent)) {
		if (preg_match('/android 9/i', $agent)) {
			$os = 'Android Pie';
		} else if (preg_match('/android 8/i', $agent)) {
			$os = 'Android Oreo';
		} else {
			$os = 'Android';
		}
	} else if (preg_match('/ubuntu/i', $agent)) {
		$os = 'Ubuntu';
	} else if (preg_match('/linux/i', $agent)) {
		$os = 'Linux';
	} else if (preg_match('/iPhone/i', $agent)) {
		$os = 'iPhone';
	} else if (preg_match('/mac/i', $agent)) {
		$os = 'MacOS';
	} else if (preg_match('/fusion/i', $agent)) {
		$os = 'Android';
	} else {
		$os = 'Linux';
	}
	echo $os;
}

/* 获取全局懒加载图 */
function _getLazyload($type = true)
{
	if ($type) echo Helper::options()->JLazyload;
	else return Helper::options()->JLazyload;
}

/* 获取头像懒加载图 */
function _getAvatarLazyload($type = true)
{
	$str = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAFAAAABQCAMAAAC5zwKfAAAC/VBMVEUAAAD87++g2veg2ff++fmg2feg2fb75uag2fag2fag2fag2fag2feg2vah2fef2POg2feg2vag2fag2fag2fag2fag2vah2fag2vb7u3Gg2fag2fb0tLSg2fb3vHig2ff0s7P2wMD0s7Og2fXzs7Pzs7Of2fWh2veh2vf+/v7///+g2vf9/f2e1/ag2fSg2/mg3PT3r6+30tSh2fb+0Hj76ev4u3P6u3K11dr60H3UyKr+/v766On80Hz49vj2xcXm5u3z0IfUx6v2u7vazKTn0pfi6PKg2fbztLT///+g2faf2fag2vf///+g2feg2fe63O6l3vb///+g2fb80Kb8um+x1uD80Hv86er+0Hf73tb0s7P10YX/0Hiq2Or+/v6g2vbe0qL60YT+/v6y1NzuvoS20dSz09ru0Y6z3fTI1MDbxp+h2fag2fb////O4PDuv4XA3/LOz7bh06Du0o/1t7ex3PP+/v6h2ffSzrLdxZ3s5u3/2qag2fb7+/z40NCg2fb9/f2f2PWf2PX0tLT+/v70s7P+/v7M7Pyf1/b1s7P////zs7P0tbWZ2fL20dH+/v7+0Hep2vWl2O+x2/P+/v641tbI1b7C1cf8xpCz0tj1wMD1x8fTya392KPo0ZT56ez4vXbN1bn26Orh0p3x8/jbxZ/CzcT8xo7327DV1tHt0Y7u8/n759661tLyy6L049710IK8z870s7PX1a3xvX/y6OzA1cvBzsXI1cG30dP+38D73Mn/0oX3ysrpwYzv5+zo0pXv5+zH4PDW4e/n5O3+/v786+vN4vP9/f30s7P9/f2f2fSu0er//Pzgu8X///+4zOD////z8/OW0vCq1f+g2fb86er0s7P+z3f8um/+/v72xcX948ym2O/85+T839D8v3v86ej54eH828X+3Kz80qz8w4T8u3Oq2/Wq1ees2Ob64OCx1d/F2N785tv529v94MH82b/1vb382bj93LD91pf91ZH+04b+0X2p2er+2aH8zJ78yZX8yJU3IRXQAAAA1nRSTlMA8PbEz5vhv1X6Y0wzrX9A8/DJt6mHsnH98uzo4NzY19DJwKGAf3tpZmVVSD86LysgIP787ejn4uHf29jW1M3MysnHxcK+vbywn5ONg39wW0AlIBr8+/f29PTx7+rm5eTj4+Df29nX1tLR0dHQz8zKyMXFxcPCwL+9u7u5t7KsqaObmH1wbWBcVVJQSUAwFA34+Pbz8vHx8O7u7ero6Ofl4ODf3t7d3Nvb2djY19fU1NLS0M/NzcrJycjHx8LCwcHAwL68uraxr5SSkId4X1NTNTItFREGybAGmgAABQNJREFUWMOl13N0HEEcwPFp2lzTpElq20jTpLZt27Zt27Zt27b7m9vbpqlt+3Xvdvd2ZncWufv+e+993t7saJFJ0wL8M1UKjJ4yTpyU0QMrZfIPmIa8qLZ/edBU3r+2Z1pY5qGg09DMYVHmsicCwxJljxIXnABMSxBsmcsxAiw1IoclLtQXLOcbau75tYAo1MLPzMsEUSyTsZceolx6Iy86eFB0fS8ZeFQyPS85eFhythcfPC4+y0sIXpRQ6yUGr0qs9vzBy/xpLwC8LsDghXj/YvzApJdgHrmsB4BuzfaXKVkwT6u6+VL1KNXOEBygeNVBrwJlm3LOlj13OEtV6r6BWN10Cc/rwEl9rOMQy1fIYFGbTZk9Mzm5iEYOubYFTKdOPPa/LckpvccP3WLSUnpgPOkIAVb1CnJEGP9xKHXWE8VDpgowekt5PzD+5CDSG8gqLrALaHvdhCP7hnHkQ1Jcyga7OL3YwGgNR/UUY1yHBOvmYouxdbatBRzdRwF84CBrq7+NpQZN91vR3s9HWOifw3wYUyOUE7St4uh+Y6x5xHzALCeaCNo2q8AI7OoZJbJHcSLKDJp+cepXIhb5nATXMcHMKAg0zedUc0buATl1kjLBIOQLmlqqn08RXxAic+PxRYyL5XLS+4rJnhD/+hXzIsraGYhV8j0C00U+kx7yxd937P3BBprqu5fw10dY04Mnn748exKJMRO0oVhA16l3h40u8ef3L5HYqO2DetXTgLGQD1CVFajDOCIi4j02a6HDkb+NGvRR3ZA4Z0OwlcQtd5Hm3pRSO2GOWvKKiLNRNXlSoq7kLsi5arjVCniEuXt3pU68Thxn/T9vEMGVqpOPWinysVTUgrfDIdVetVKygFIeGTxhDm6SwYEUmIU8AZpxUgN7mnqnIL8EHqfPAPKmflDy8syGwSZe3n4wSAJTUfd36ibXWwJPAtiKGINnANo4pHKTdzrqLrxT9PqAUD9D7ywIHUgqgu2omzF5qDR0eWXB1WkDb7W4XneJw1iGPFLIu9c2J9dU+DkJOCunP4A2EGu/1wn2UN+/RoNYH2G+9PIRPBGEnnnZXom4irA+lSAeArnRiHF1SOIe5DklGNyK7kCV6+2r+8qkYX2C5iZ2yI6DG9BcgxIvLXyYBtNbpAASZDllAj3a130WGBWMpAIpkNpyEwTVrnmh3Ja1xYoVG3atFgqtVl7fC2R/9vj4EFz2kKojeaL+VW/FrhTH/NNnFBP0rZExBq/pfMabVeKyvFFIKcxGgNIYpr6asbFdAh9/XlxRBmPaG2cMDdR6tjACJDexONLjXU9ht8vgG3sK1NoN2u27p1bTgFkQVaAK9Btutysg/jA8K6+AQuP8NG+ErqaNAoOz3ZNBORpMN5YWbTWRKvfvcV0erwKbt6bBvvz4YPrLUVNCBQzKxtPg48/pkBrkswWRd2tGCWQwdY3CIki9FBoszfOFa8R1z1fEzFecNlC9Iq8C8YfHvAbkR1ZzH3U6VRaveJN5AqSiQX6yuJVWRrq5RiWgmwJG09bI7iwtL9QtQLwFG5QYIN54XgbZKSCf1QaxsiPDYkPl/tbBYVfi3UEm3Z3AWwfnTkDmjbUEFuddVUUWylrYKtg8K7LU7cszLIEXpyOr1arILzEGj/HnQswUmgyZeimNnpZmTHjIDeRB4WMYZoVx4ciLwqdMypChQroUwmOlq5Ahw6QpZuP2HxxXd11eM9wcAAAAAElFTkSuQmCC";
	if ($type) echo $str;
	else return $str;
}

/* 查询文章浏览量 */
function _getViews($item, $type = true)
{
	$db = Typecho_Db::get();
	if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
		$db->query('ALTER TABLE `' . $db->getPrefix() . 'contents` ADD `views` INT(10) DEFAULT 0;');
		echo 0;
		return;
	}
	$result = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $item->cid))['views'];
	if ($item->is('single')) {
		$views = Typecho_Cookie::get('extend_contents_views');
		if (empty($views)) {
			$views = array();
		} else {
			$views = explode(',', $views);
		}
		if (!in_array($item->cid, $views)) {
			$db->query($db->update('table.contents')->rows(array('views' => (int) $result + 1))->where('cid = ?', $item->cid));
			array_push($views, $item->cid);
			$views = implode(',', $views);
			Typecho_Cookie::set('extend_contents_views', $views); //记录查看cookie
		}
	}
	if ($type) echo format_number($result);
	else return format_number($result);
}
/* 查询文章点赞量 */
function _getAgree($item, $type = true)
{
	$db = Typecho_Db::get();
	$result = $db->fetchRow($db->select('agree')->from('table.contents')->where('cid = ?', $item->cid))['agree'];
	if ($type) echo number_format($result);
	else return number_format($result);
}

/* 页面开始计时 */
function _startCountTime()
{
	global $timeStart;
	$mTime     = explode(' ', microtime());
	$timeStart = $mTime[1] + $mTime[0];
	return true;
}

/* 页面结束计时 */
function _endCountTime($precision = 3)
{
	global $timeStart, $timeEnd;
	$mTime     = explode(' ', microtime());
	$timeEnd   = $mTime[1] + $mTime[0];
	$timeTotal = number_format($timeEnd - $timeStart, $precision);
	echo $timeTotal < 1 ? $timeTotal * 1000 . 'ms' : $timeTotal . 's';
}

/* 通过邮箱生成头像地址 */
function _getAvatarByMail($mail, $type = true)
{
	$gravatarsUrl = Helper::options()->JCustomAvatarSource ? Helper::options()->JCustomAvatarSource : 'https://gravatar.helingqi.com/wavatar/';
	$mailLower = strtolower($mail);
	$md5MailLower = md5($mailLower);
	$qqMail = str_replace('@qq.com', '', $mailLower);
	if (strstr($mailLower, "qq.com") && is_numeric($qqMail) && strlen($qqMail) < 11 && strlen($qqMail) > 4) {
		if ($type) {
			echo 'https://thirdqq.qlogo.cn/g?b=qq&nk=' . $qqMail . '&s=100';
		} else {
			return 'https://thirdqq.qlogo.cn/g?b=qq&nk=' . $qqMail . '&s=100';
		}
	} else {
		if ($type) {
			echo $gravatarsUrl . $md5MailLower . '?d=mm';
		} else {
			return $gravatarsUrl . $md5MailLower . '?d=mm';
		}
	}
};

/* 获取侧边栏随机一言 */
function _getAsideAuthorMotto()
{
	$JMottoRandom = explode("\r\n", Helper::options()->JAside_Author_Motto);
	echo $JMottoRandom[array_rand($JMottoRandom, 1)];
}

/* 获取文章摘要 */
function _getAbstract($item, $type = true)
{
	$abstract = "";
	if ($item->password) {
		$abstract = "加密文章，请前往内页查看";
	} else {
		if ($item->fields->abstract) {
			$abstract = $item->fields->abstract;
		} else {
			$abstract = strip_tags($item->excerpt);
			if (strpos($abstract, '{hide') !== false) {
				$abstract = preg_replace('/{hide[^}]*}([\s\S]*?){\/hide}/', '隐藏内容，请前往内页查看', $abstract);
			}
		}
	}
	if ($abstract === '') $abstract = "暂无简介";
	if ($type) echo $abstract;
	else return $abstract;
}

/* 获取文章内容 */
function _getContent($item, $type = true)
{
	$content = "";
	if ($item->password) {
		$content = "加密文章，请前往内页查看";
	} else {
		if ($item->content) {
			$content = $item->content;
		} else {
			$content = strip_tags($item->content);
			if (strpos($content, '{hide') !== false) {
				$content = preg_replace('/{hide[^}]*}([\s\S]*?){\/hide}/', '隐藏内容，请前往内页查看', $content);
			}
		}
	}
	if ($content === '') $content = "暂无内容";
	if ($type) echo $content;
	else return $content;
}

/* 获取列表缩略图 */
function _getThumbnails($item)
{
	$result = [];
	$pattern = '/\<img.*?src\=\"(.*?)\"[^>]*>/i';
	$patternMD = '/\!\[.*?\]\((http(s)?:\/\/.*?(jpg|jpeg|gif|png|webp))/i';
	$patternMDfoot = '/\[.*?\]:\s*(http(s)?:\/\/.*?(jpg|jpeg|gif|png|webp))/i';
	/* 如果填写了自定义缩略图，则优先显示填写的缩略图 */
	if ($item->fields->thumb) {
		$fields_thumb_arr = explode("\r\n", $item->fields->thumb);
		foreach ($fields_thumb_arr as $list) $result[] = $list;
	}
	/* 如果匹配到正则，则继续补充匹配到的图片 */
	if (preg_match_all($pattern, $item->content, $thumbUrl)) {
		foreach ($thumbUrl[1] as $list) $result[] = $list;
	}
	if (preg_match_all($patternMD, $item->content, $thumbUrl)) {
		foreach ($thumbUrl[1] as $list) $result[] = $list;
	}
	if (preg_match_all($patternMDfoot, $item->content, $thumbUrl)) {
		foreach ($thumbUrl[1] as $list) $result[] = $list;
	}
	/* 如果上面的数量不足3个，则直接补充3个随即图进去 */
	if (sizeof($result) < 3) {
		$custom_thumbnail = Helper::options()->JThumbnail;
		/* 将for循环放里面，减少一次if判断 */
		if ($custom_thumbnail) {
			$custom_thumbnail_arr = explode("\r\n", $custom_thumbnail);
			for ($i = 0; $i < 3; $i++) {
				$result[] = $custom_thumbnail_arr[array_rand($custom_thumbnail_arr, 1)] . "?key=" . mt_rand(0, 1000000);
			}
		} else {
			for ($i = 0; $i < 3; $i++) {
				$result[] = 'https://fastly.jsdelivr.net/npm/typecho-joe-next@6.0.0/assets/thumb/' . rand(1, 42) . '.jpg';
			}
		}
	}
	return $result;
}

/* 获取父级评论 */
function _getParentReply($parent)
{
	if ($parent !== "0") {
		$db = Typecho_Db::get();
		$commentInfo = $db->fetchRow($db->select('author')->from('table.comments')->where('coid = ?', $parent));
		echo '<span>@' . $commentInfo['author'] . '：</span>';
	}
}

/* 获取子评论数量 */
function getChildCommentCount($parent_id)
{
	$db = Typecho_Db::get();
	$sub_comment_count = $db->fetchObject($db->select('COUNT(*)')->from('table.comments')
		->where('parent = ?', $parent_id))->{"COUNT(*)"};
	$sub_comments = $db->fetchAll($db->select()->from('table.comments')
		->where('parent = ?', $parent_id));
	foreach ($sub_comments as $sub_comment) {
		$sub_comment_count += getChildCommentCount($sub_comment['coid']);
	}
	return $sub_comment_count;
}

/* 统计子评论总数 */
function _commentNum($comment)
{
	$childrenNum = getChildCommentCount($comment->coid);

	if ($childrenNum == 0) {
		return;
	} else {
		echo '<a href="javascript:void(0);">展开评论 /<span style="padding: 0 5px;">' . $childrenNum . '</span>条</a>';
	}
}

/* 私密评论 */
function secretComment($comments)
{
	$db = Typecho_Db::get();
	$select = $db->select('mail')->from('table.comments')->where('coid = ?', $comments->parent)->limit(1);
	$parent_comment = $db->fetchRow($select);

	if ($parent_comment === null) {
		$parent_comment_mail = '';
	} else {
		$parent_comment_mail = $parent_comment['mail'];
	}

	$user = Typecho_Widget::widget('Widget_User');
	$comment_mail = $comments->mail;
	$is_secret_comment = strpos($comments->content, '私语#') !== false;

	if ($is_secret_comment) {
		$remembered_mail = Typecho_Cookie::get('__typecho_remember_mail');

		if (
			$comment_mail == $user->mail
			|| $comment_mail == $remembered_mail
			|| $user->group == 'administrator'
			|| ($parent_comment_mail == $remembered_mail && !empty($parent_comment_mail))
		) {
			echo _getParentReply($comments->parent) . _parseCommentReply(str_replace('私语#', '', str_replace('<p>', '<span>', $comments->content)));
		} else {
			echo '<div class="secret">此条为私语，发布者可见</div>';
		}
	} else {
		echo _getParentReply($comments->parent) . _parseCommentReply(str_replace('<p>', '<span>', $comments->content));
	}
}

/* 获取侧边栏作者随机文章 */
function _getRandomPosts()
{
	if (Helper::options()->JAside_Rand && Helper::options()->JAside_Rand !== "off") {
		$limit = Helper::options()->JAside_Rand;
		$db = Typecho_Db::get();
		$adapterName = $db->getAdapterName(); //兼容非MySQL数据库
		if ($adapterName == 'pgsql' || $adapterName == 'Pdo_Pgsql' || $adapterName == 'Pdo_SQLite' || $adapterName == 'SQLite') {
			$order_by = 'RANDOM()';
		} else {
			$order_by = 'RAND()';
		}
		$sql = $db->select()->from('table.contents')
			->where('status = ?', 'publish')
			->where('table.contents.created <= ?', time())
			->where('type = ?', 'post')
			->limit($limit)
			->order($order_by);
		$result = $db->query($sql);
		if ($result instanceof Traversable) {
			foreach ($result as $item) {
				$item = Typecho_Widget::widget('Widget_Abstract_Contents')->push($item);
				$title = htmlspecialchars($item['title']);
				$permalink = $item['permalink'];
				$date = _dateFormat($item['created']);
				echo "
						<li class='item'>
							<a class='link' href='{$permalink}' title='{$title}'>{$title}</a>
							<span>{$date}</span>
						</li>
					";
			}
		}
	}
}

function _curl($url)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_NOSIGNAL, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, 3000);
	curl_setopt($ch, CURLOPT_TIMEOUT_MS, 3000);
	if (strpos($url, 'https') !== false) {
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	}
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.190 Safari/537.36');
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}

/* 判断敏感词是否在字符串内 */
function _checkSensitiveWords($words_str, $str)
{
	$words = explode("||", $words_str);
	if (empty($words)) {
		return false;
	}
	foreach ($words as $word) {
		if (false !== strpos($str, trim($word))) {
			return true;
		}
	}
	return false;
}

/* 动态点赞 */
function _getSupport($coid)
{
	$db = Typecho_Db::get();
	$prefix = $db->getPrefix();
	if (!array_key_exists('support', $db->fetchRow($db->select()->from('table.comments')))) {
		$db->query('ALTER TABLE `' . $prefix . 'comments` ADD `support` INT(10) DEFAULT 0;');
		return [
			'icon' => 'zm zm-thumb-up-line',
			'count' => 0,
			'text' => ''
		];
	}
	$row = $db->fetchRow($db->select('support')->from('table.comments')->where('coid = ?', $coid));
	$support = Typecho_Cookie::get('extend_comments_support');
	if (empty($support)) {
		$support = array();
	} else {
		$support = explode(',', $support);
	}
	if (!in_array($coid, $support)) {
		return [
			'icon' => 'zm zm-unlike',
			'count' => $row['support'],
			'text' => ''
		];
	} else {
		return [
			'icon' => 'zm zm-like',
			'count' => $row['support'],
			'text' => ''
		];
	}
}

function _addSupport($coid)
{
	$db = Typecho_Db::get();
	$row = $db->fetchRow($db->select('support')->from('table.comments')->where('coid = ?', $coid));
	$support = Typecho_Cookie::get('extend_comments_support');
	if (empty($support)) {
		$support = array();
	} else {
		$support = explode(',', $support);
	}
	if (!in_array($coid, $support)) {
		$db->query($db->update('table.comments')->rows(array('support' => (int)$row['support'] + 1))->where('coid = ?', $coid));
		array_push($support, $coid);
		$support = implode(',', $support);
		Typecho_Cookie::set('extend_comments_support', $support);
		return $row['support'] + 1;
	} else {
		return false;
	}
}

/* 时间格式化：几小时前、几天前 */
function _dateFormat($time)
{
	$t = time() - $time;
	$h = date("H:i", $time);
	if ($t < 1) {
		return '刚刚';
	}
	if ($t > 0 && $t < 172800 && (date('z', $time) + 1 == date('z', time()) || date('z', $time) + 1 == date('L') + 365 + date('z', time()))) {
		return '昨天 ' . $h;
	}
	$f = array(
		'31536000' => '年',
		'2592000' => '个月',
		'604800' => '周',
		'86400' => '天',
		'3600' => '小时',
		'60' => '分钟',
		'1' => '秒'
	);
	foreach ($f as $k => $v) {
		if (0 != $c = floor($t / (int)$k)) {
			return $c . $v . '前';
		}
	}
}

/* 评论显示IP */
function convertip($ip)
{
	$ip1num = 0;
	$ip2num = 0;
	$ipAddr1 = "";
	$ipAddr2 = "";
	$dat_path = './usr/themes/Word/assets/qqwry.dat';
	if (!preg_match("/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/", $ip)) {
		return 'IP数据库路径不对';
	}
	if (!$fd = @fopen($dat_path, 'rb')) {
		return 'IP数据库路径不正确';
	}
	$ip = explode('.', $ip);
	$ipNum = $ip[0] * 16777216 + $ip[1] * 65536 + $ip[2] * 256 + $ip[3];
	$DataBegin = fread($fd, 4);
	$DataEnd = fread($fd, 4);
	$ipbegin = implode('', unpack('L', $DataBegin));
	if ($ipbegin < 0) $ipbegin += pow(2, 32);
	$ipend = implode('', unpack('L', $DataEnd));
	if ($ipend < 0) $ipend += pow(2, 32);
	$ipAllNum = ($ipend - $ipbegin) / 7 + 1;
	$BeginNum = 0;
	$EndNum = $ipAllNum;
	while ($ip1num > $ipNum || $ip2num < $ipNum) {
		$Middle = intval(($EndNum + $BeginNum) / 2);
		fseek($fd, $ipbegin + 7 * $Middle);
		$ipData1 = fread($fd, 4);
		if (strlen($ipData1) < 4) {
			fclose($fd);
			return 'System Error';
		}
		$ip1num = implode('', unpack('L', $ipData1));
		if ($ip1num < 0) $ip1num += pow(2, 32);

		if ($ip1num > $ipNum) {
			$EndNum = $Middle;
			continue;
		}
		$DataSeek = fread($fd, 3);
		if (strlen($DataSeek) < 3) {
			fclose($fd);
			return 'System Error';
		}
		$DataSeek = implode('', unpack('L', $DataSeek . chr(0)));
		fseek($fd, $DataSeek);
		$ipData2 = fread($fd, 4);
		if (strlen($ipData2) < 4) {
			fclose($fd);
			return 'System Error';
		}
		$ip2num = implode('', unpack('L', $ipData2));
		if ($ip2num < 0) $ip2num += pow(2, 32);
		if ($ip2num < $ipNum) {
			if ($Middle == $BeginNum) {
				fclose($fd);
				return 'Unknown';
			}
			$BeginNum = $Middle;
		}
	}
	$ipFlag = fread($fd, 1);
	if ($ipFlag == chr(1)) {
		$ipSeek = fread($fd, 3);
		if (strlen($ipSeek) < 3) {
			fclose($fd);
			return 'System Error';
		}
		$ipSeek = implode('', unpack('L', $ipSeek . chr(0)));
		fseek($fd, $ipSeek);
		$ipFlag = fread($fd, 1);
	}
	if ($ipFlag == chr(2)) {
		$AddrSeek = fread($fd, 3);
		if (strlen($AddrSeek) < 3) {
			fclose($fd);
			return 'System Error';
		}
		$ipFlag = fread($fd, 1);
		if ($ipFlag == chr(2)) {
			$AddrSeek2 = fread($fd, 3);
			if (strlen($AddrSeek2) < 3) {
				fclose($fd);
				return 'System Error';
			}
			$AddrSeek2 = implode('', unpack('L', $AddrSeek2 . chr(0)));
			fseek($fd, $AddrSeek2);
		} else {
			fseek($fd, -1, SEEK_CUR);
		}
		while (($char = fread($fd, 1)) != chr(0))
			$ipAddr2 .= $char;
		$AddrSeek = implode('', unpack('L', $AddrSeek . chr(0)));
		fseek($fd, $AddrSeek);
		while (($char = fread($fd, 1)) != chr(0))
			$ipAddr1 .= $char;
	} else {
		fseek($fd, -1, SEEK_CUR);
		while (($char = fread($fd, 1)) != chr(0))
			$ipAddr1 .= $char;
		$ipFlag = fread($fd, 1);
		if ($ipFlag == chr(2)) {
			$AddrSeek2 = fread($fd, 3);
			if (strlen($AddrSeek2) < 3) {
				fclose($fd);
				return 'System Error';
			}
			$AddrSeek2 = implode('', unpack('L', $AddrSeek2 . chr(0)));
			fseek($fd, $AddrSeek2);
		} else {
			fseek($fd, -1, SEEK_CUR);
		}
		while (($char = fread($fd, 1)) != chr(0)) {
			$ipAddr2 .= $char;
		}
	}
	fclose($fd);
	if (preg_match('/http/i', $ipAddr2)) {
		$ipAddr2 = '';
	}
	$ipaddr = "$ipAddr1";
	$ipaddr = preg_replace('/CZ88.NET/is', '', $ipaddr);
	$ipaddr = preg_replace('/^s*/is', '', $ipaddr);
	$ipaddr = preg_replace('/s*$/is', '', $ipaddr);
	if (preg_match('/http/i', $ipaddr) || $ipaddr == '') {
		$ipaddr = '可能来自火星';
	}
	$ipaddr = iconv('gbk', 'utf-8//IGNORE', $ipaddr); //转换编码
	return $ipaddr;
}

/* 那年今日 */
function _historyDay($created)
{
	$date = date('m/d', $created);
	$time = time();
	$db = Typecho_Db::get();
	$prefix = $db->getPrefix();
	$sql = "SELECT * FROM `{$prefix}contents` WHERE DATE_FORMAT(FROM_UNIXTIME(created), '%m/%d') = '{$date}' and created <= {$time} and created != {$created} and type = 'post' and status = 'publish' and (password is NULL or password = '') ORDER BY created DESC LIMIT 10";
	$result = $db->query($sql);
	$historyTodaylist = [];
	if ($result instanceof Traversable) {
		foreach ($result as $item) {
			$item = Typecho_Widget::widget('Widget_Abstract_Contents')->push($item);
			$historyTodaylist[] = array(
				"title" => htmlspecialchars($item['title']),
				"permalink" => $item['permalink'],
				"date" => $item['year'] . ' ' . $item['month'] . '/' . $item['day']
			);
		}
	}
	if (count($historyTodaylist) > 0) {
		echo '
			<section class="joe_aside__item today">
				<div class="joe_aside__item-title">
					<svg class="icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="18" height="18">
						<path d="M701.217 207.026H304.974v26.713c0 17.809-13.357 33.391-33.391 33.391-17.81 0-33.392-13.356-33.392-33.39v-26.714h-91.27c-33.39 0-60.104 26.713-60.104 60.104v601.044c0 33.391 26.713 60.104 60.105 60.104h739.06a60.817 60.817 0 0 0 60.105-60.104V267.13c0-33.39-26.713-60.104-60.104-60.104h-120.21v26.713c0 17.809-13.356 33.391-33.39 33.391-17.81 0-33.392-13.356-33.392-33.39v-26.714zm64.557-64.556h120.209c69.008 0 124.66 55.652 124.66 124.66v601.044c0 33.391-13.356 64.556-35.617 89.043-22.26 22.261-55.652 35.618-89.043 35.618H146.922c-33.392 0-64.557-13.357-89.044-35.618-22.26-22.26-35.617-55.652-35.617-89.043V267.13c0-69.008 55.652-124.66 124.66-124.66h91.27V53.426c0-17.809 13.357-33.391 33.392-33.391 17.808 0 33.39 13.356 33.39 33.391v89.044h396.244V53.426c0-17.809 15.583-31.165 33.392-31.165S768 35.617 768 55.652v86.818zm0 0" />
						<path d="M471.93 460.8c46.748 20.035 91.27 44.522 129.113 73.46l-26.713 44.523c-42.295-31.166-86.817-57.879-129.113-75.687L471.93 460.8zm-153.6 129.113h396.244v40.07c-33.391 89.043-106.852 155.826-215.93 202.574l-35.618-46.748c91.27-35.618 153.6-84.592 189.217-149.148H318.33v-46.748zm180.313-269.356h37.844c66.783 75.686 149.148 135.79 240.417 180.313l-26.713 48.973c-91.27-46.747-166.956-106.852-231.513-180.313-57.878 69.01-135.791 129.113-231.513 180.313l-26.713-48.973c93.496-46.748 173.635-109.079 238.191-180.313zm0 0" />
					</svg>
					<span class="text">那年今日</span>
					<span class="line"></span>
				</div>
				<ul class="joe_aside__item-contain">
			';
		foreach ($historyTodaylist as $item) {
			echo "
					<li class='item'>
						<div class='tail'></div>
						<div class='head'></div>
						<div class='desc'>
							<time datetime='{$item['date']}'>{$item['date']}</time>
							<a href='{$item['permalink']}' title='{$item['title']}'>{$item['title']}</a>
						</div>
					</li>
                ";
		}
		echo '</ul></section>';
	}
}

/* 数字k\w格式化 */
function format_number($number)
{
	if ($number >= 10000) {
		# 判断是否超过w
		$newNum = round($number / 1000, 2) . 'w';
	} elseif ($number >= 1000) {
		# 判断是否超过k
		$newNum = round($number / 1000, 1) . 'k';
	} else {
		$newNum = $number;
	}
	return $newNum;
}
