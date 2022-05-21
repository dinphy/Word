<?php

/**
 * “ 心中无女人，代码自然神 - 78.AL ” <br /> “ 环境要求：PHP 5.4 ~ 7.4 ”
 * @package Joe
 * @author Joe
 * @link https://78.al
 */

?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
	<?php $this->need('public/include.php'); ?>
	<link rel="stylesheet" href="https://lib.baomitu.com/Swiper/5.4.5/css/swiper.min.css">
	<script src="https://lib.baomitu.com/Swiper/5.4.5/js/swiper.min.js"></script>
	<script src="https://lib.baomitu.com/wow/1.1.2/wow.min.js"></script>
	<link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/joe.index.min.css?v=7.3.7@1'); ?>">
	<script src="<?php $this->options->themeUrl('assets/js/joe.index.min.js?v=7.3.7@1'); ?>"></script>
</head>

<body>
	<div id="Joe">
		<div class="joe_container">
			<div class="joe_main">
				<?php $this->need('public/header.php'); ?>
				<?php $this->need('public/batten.php'); ?>
				<div class="joe_index">
					<?php if ($this->options->JIndex_Hot === "on") : ?>
						<?php $this->widget('Widget_Contents_Hot@Index', 'pageSize=4')->to($item); ?>
						<div class="joe_index__hot">
							<ul class="joe_index__hot-list">
								<?php while ($item->next()) : ?>
									<li class="item">
										<a class="link" href="<?php $item->permalink(); ?>" title="<?php $item->title(); ?>">
											<figure class="inner">
												<span class="views"><?php echo number_format($item->views); ?> ℃</span>
												<img width="100%" height="120" class="image lazyload" src="<?php _getLazyload(); ?>" data-src="<?php echo _getThumbnails($item)[0]; ?>" alt="<?php $item->title(); ?>" />
												<figcaption class="title"><?php $item->title(); ?></figcaption>
											</figure>
										</a>
									</li>
								<?php endwhile; ?>
							</ul>
						</div>
					<?php endif; ?>
					<?php
					$index_ad_text = $this->options->JIndex_Ad;
					$index_ad = null;
					if ($index_ad_text) {
						$index_ad_arr = explode("||", $index_ad_text);
						if (count($index_ad_arr) === 2) $index_ad = array("image" => trim($index_ad_arr[0]), "url" => trim($index_ad_arr[1]));
					}
					?>
					<?php if ($index_ad) : ?>
						<div class="joe_index__ad">
							<a class="joe_index__ad-link" href="<?php echo $index_ad['url'] ?>" target="_blank" rel="noopener noreferrer nofollow">
								<img width="100%" height="200" class="image lazyload" src="<?php _getLazyload() ?>" data-src="<?php echo $index_ad['image'] ?>" alt="<?php echo $index_ad['url'] ?>" />
								<span class="icon">广告</span>
							</a>
						</div>
					<?php endif; ?>

					<div class="joe_index__title">
						<ul class="joe_index__title-title">
							<li class="item" data-type="created">最新</li>
							<li class="item" data-type="views">热门</li>
							<li class="item" data-type="commentsNum">评论</li>
							<li class="item" data-type="agree">点赞</li>
							<li class="line"></li>
						</ul>
						<?php if ($this->options->JIndex_Dynamic === "on") : ?>
							<?php _indexDynamic(); ?>
						<?php else : ?>
							<?php
							$index_notice_text = $this->options->JIndex_Notice;
							$index_notice = null;
							if ($index_notice_text) {
								$index_notice_arr = explode("||", $index_notice_text);
								if (count($index_notice_arr) === 2) $index_notice = array("text" => trim($index_notice_arr[0]), "url" => trim($index_notice_arr[1]));
							}
							?>
							<?php if ($index_notice) : ?>
								<div class="joe_index__title-notice">
									<svg viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="20" height="20">
										<path d="M656.261 347.208a188.652 188.652 0 1 0 0 324.05v-324.05z" fill="#F4CA1C" />
										<path d="M668.35 118.881a73.35 73.35 0 0 0-71.169-4.06l-310.01 148.68a4.608 4.608 0 0 1-2.013.46h-155.11a73.728 73.728 0 0 0-73.728 73.636v349.64a73.728 73.728 0 0 0 73.728 73.636h156.554a4.68 4.68 0 0 1 1.94.43l309.592 143.196a73.702 73.702 0 0 0 104.668-66.82V181.206a73.216 73.216 0 0 0-34.453-62.326zM125.403 687.237v-349.64a4.608 4.608 0 0 1 4.608-4.608h122.035v358.882H130.048a4.608 4.608 0 0 1-4.644-4.634zm508.319 150.441a4.608 4.608 0 0 1-6.564 4.193L321.132 700.32V323.773l305.97-146.723a4.608 4.608 0 0 1 6.62 4.157v656.471zM938.26 478.72H788.01a34.509 34.509 0 1 0 0 69.018H938.26a34.509 34.509 0 1 0 0-69.018zM810.01 360.96a34.447 34.447 0 0 0 24.417-10.102l106.245-106.122a34.524 34.524 0 0 0-48.84-48.809L785.587 302.08a34.509 34.509 0 0 0 24.423 58.88zm24.417 314.609a34.524 34.524 0 1 0-48.84 48.814L891.832 830.52a34.524 34.524 0 0 0 48.84-48.809z" fill="#595BB3" />
									</svg>
									<a href="<?php echo $index_notice['url'] ?>" target="_blank" rel="noopener noreferrer nofollow"><?php echo $index_notice['text'] ?></a>
								</div>
							<?php endif; ?>
						<?php endif; ?>
					</div>
					<div class="joe_index__list" data-wow="<?php $this->options->JList_Animate() ?>">
						<ul class="joe_list"></ul>
						<ul class="joe_list__loading">
							<li class="item">
								<div class="thumbnail"></div>
								<div class="information">
									<div class="title"></div>
									<div class="abstract">
										<p></p>
										<p></p>
									</div>
								</div>
							</li>
							<li class="item">
								<div class="thumbnail"></div>
								<div class="information">
									<div class="title"></div>
									<div class="abstract">
										<p></p>
										<p></p>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="joe_load">查看更多</div>
			</div>
			<?php if ($this->options->JAside_Switch === "on") : ?>
				<?php $this->need('public/aside.php'); ?>
			<?php endif; ?>
		</div>
		<?php $this->need('public/footer.php'); ?>
	</div>
</body>

</html>