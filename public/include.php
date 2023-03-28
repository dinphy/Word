<?php $this->need('public/config.php'); ?>
<meta charset="utf-8" />
<meta name="renderer" content="webkit" />
<meta name="format-detection" content="email=no" />
<meta name="format-detection" content="telephone=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, shrink-to-fit=no, viewport-fit=cover">
<link rel="shortcut icon" href="<?php $this->options->JFavicon() ?>" />
<title><?php $this->archiveTitle(array('category' => '分类 %s 下的文章', 'search' => '包含关键字 %s 的文章', 'tag' => '标签 %s 下的文章', 'author' => '%s 发布的文章'), '', ' - '); ?><?php $this->options->title(); ?></title>
<?php if ($this->is('single')) : ?>
	<meta name="keywords" content="<?php echo $this->fields->keywords ? $this->fields->keywords : htmlspecialchars($this->_keywords); ?>" />
	<meta name="description" content="<?php echo $this->fields->description ? $this->fields->description : htmlspecialchars($this->_description); ?>" />
	<?php $this->header('keywords=&description='); ?>
<?php else : ?>
	<?php $this->header(); ?>
<?php endif; ?>
<link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/joe.mode.min.css'); ?>?<?php echo _getVersion(); ?>">
<link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/joe.normalize.min.css'); ?>?<?php echo _getVersion(); ?>">
<link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/joe.global.min.css'); ?>?<?php echo _getVersion(); ?>">
<link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/joe.responsive.min.css'); ?>?<?php echo _getVersion(); ?>">
<link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/qmsg.css'); ?>">
<link rel="stylesheet" href="https://lib.baomitu.com/fancybox/3.5.7/jquery.fancybox.min.css" />
<link rel="stylesheet" href="https://lib.baomitu.com/animate.css/3.7.2/animate.min.css" />
<link rel="stylesheet" href="https://lib.baomitu.com/font-awesome/4.7.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="https://lib.baomitu.com/aplayer/1.10.1/APlayer.min.css" />
<link rel="stylesheet" href="//at.alicdn.com/t/c/font_1159885_aq7qptpvhk.css">
<script src="https://lib.baomitu.com/jquery/3.6.0/jquery.min.js"></script>
<script src="<?php $this->options->themeUrl('assets/js/joe.scroll.js'); ?>"></script>
<script src="https://lib.baomitu.com/lazysizes/5.3.2/lazysizes.min.js"></script>
<script src="https://lib.baomitu.com/aplayer/1.10.1/APlayer.min.js"></script>
<script src="<?php $this->options->themeUrl('assets/js/joe.sketchpad.js'); ?>"></script>
<script src="https://lib.baomitu.com/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<script src="<?php $this->options->themeUrl('assets/js/joe.extend.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/qmsg.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/joe.smooth.js'); ?>" async></script>
<?php if ($this->options->JAside_3DTag === 'on') : ?>
	<script src="<?php $this->options->themeUrl('assets/js/3dtag.min.js'); ?>"></script>
<?php endif; ?>
<?php if ($this->options->JCursorEffects && $this->options->JCursorEffects !== 'off') : ?>
	<script src="<?php $this->options->themeUrl('assets/cursor/' . $this->options->JCursorEffects); ?>" async></script>
<?php endif; ?>
<script src="<?php $this->options->themeUrl('assets/js/joe.global.min.js'); ?>?<?php echo _getVersion(); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/joe.short.min.js'); ?>?<?php echo _getVersion(); ?>"></script>
<?php $this->options->JCustomHeadEnd() ?>