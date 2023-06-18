<?php

/**
 * 一款专为文字创作而生，又简而不凡的全新 typecho 主题
 * 
 * @package Word
 * @author 小王先森
 * @version  1.2.5.5
 * @link https://xwsir.cn
 */

?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
	<?php $this->need('public/include.php'); ?>
	<link rel="stylesheet" href="https://lib.baomitu.com/Swiper/5.4.5/css/swiper.min.css">
	<script src="https://lib.baomitu.com/Swiper/5.4.5/js/swiper.min.js"></script>
	<script src="https://lib.baomitu.com/wow/1.1.2/wow.min.js"></script>
</head>

<body>
	<div id="Joe">
		<?php $this->need('public/head.php'); ?>
		<div class="joe_container">
			<?php $this->need('public/menu.php'); ?>
			<div class="joe_main">
				<?php $this->need('public/header.php'); ?>
				<?php $this->need('public/batten.php'); ?>
				<div class="joe_index">
					<?php
					$carousel = [];
					$carousel_text = $this->options->JIndex_Carousel;
					if ($carousel_text) {
						$carousel_arr = explode("\r\n", $carousel_text);
						if (count($carousel_arr) > 0) {
							for ($i = 0; $i < count($carousel_arr); $i++) {
								$img = explode("||", $carousel_arr[$i])[0];
								$url = explode("||", $carousel_arr[$i])[1];
								$title = explode("||", $carousel_arr[$i])[2];
								$carousel[] = array("img" => trim($img), "url" => trim($url), "title" => trim($title));
							};
						}
					}
					$recommend = [];
					$recommend_text = $this->options->JIndex_Recommend;
					if ($recommend_text) {
						$recommend_arr = explode("||", $recommend_text);
						if (count($recommend_arr) === 2) $recommend = $recommend_arr;
					}
					?>
					<?php if (sizeof($carousel) > 0 || sizeof($recommend) === 2) : ?>
						<div class="joe_index__banner">
							<?php if (sizeof($carousel) > 0) : ?>
								<div class="swiper-container">
									<div class="swiper-wrapper">
										<?php foreach ($carousel as $item) : ?>
											<div class="swiper-slide">
												<a class="item" href="<?php echo $item['url'] ?>" target="_blank" rel="noopener noreferrer nofollow">
													<img width="100%" height="100%" class="thumbnail lazyload" src="<?php _getLazyload() ?>" data-src="<?php echo $item['img'] ?>" alt="<?php echo $item['title'] ?>" />
													<div class="title"><?php echo $item['title'] ?></div>
													<svg class="icon" viewBox="0 0 1026 1024" xmlns="http://www.w3.org/2000/svg" width="18" height="18">
														<path d="M784.3 1007.961a33.2 33.2 0 0 1-27.106-9.062L540.669 854.55 431.766 962.813c-9.062 9.062-36.168 18.044-45.23 9.062a49.72 49.72 0 0 1-27.106-45.23V727.763a33.2 33.2 0 0 1 9.463-27.106l343.071-370.578a44.748 44.748 0 0 1 63.274 63.274l-334.17 361.515v72.175l63.273-54.211a42.583 42.583 0 0 1 54.212-9.062l198.64 126.386L910.847 140.34 151.647 510.837 323.343 619.34c18.044 9.062 27.106 45.23 9.062 63.273-9.062 18.044-45.23 27.106-63.273 18.044L34.082 547.005c-8.981-8.982-18.043-17.723-18.043-36.168s9.062-27.105 27.105-36.167l903.79-451.815c18.043-9.062 36.167-9.062 45.229 0 18.284 9.223 18.284 27.106 18.284 45.15L829.69 971.794c0 18.043-9.062 27.105-27.105 36.167z" />
													</svg>
												</a>
											</div>
										<?php endforeach; ?>
									</div>
									<div class="swiper-pagination"></div>
									<div class="swiper-button-next"></div>
									<div class="swiper-button-prev"></div>
								</div>
							<?php endif; ?>
							<?php if (sizeof($recommend) === 2) : ?>
								<div class="joe_index__banner-recommend <?php echo sizeof($carousel) === 0 ? 'noswiper' : '' ?>">
									<?php foreach ($recommend as $cid) : ?>
										<?php $this->widget('Widget_Contents_Post@' . $cid, 'cid=' . $cid)->to($item); ?>
										<figure class="item">
											<a class="thumbnail" href="<?php $item->permalink() ?>" title="<?php $item->title() ?>">
												<img width="100%" height="100%" class="lazyload" src="<?php _getLazyload(); ?>" data-src="<?php echo _getThumbnails($item)[0]; ?>" alt="<?php $item->title() ?>" />
											</a>
											<figcaption class="information">
												<!-- <span class="type">推荐</span> -->
												<div class="text"><?php $item->title() ?></div>
											</figcaption>
										</figure>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
						</div>
					<?php endif; ?>
					<?php if ($this->options->JIndex_Hot === "on") : ?>
						<?php $this->widget('Widget_Contents_Hot@Index', 'pageSize=3')->to($item); ?>
						<div class="joe_index__hot">
							<ul class="joe_index__hot-list">
								<?php while ($item->next()) : ?>
									<li class="item">
										<a class="link" href="<?php $item->permalink(); ?>" title="<?php $item->title(); ?>">
											<figure class="inner">
												<span class="views"><?php echo format_number($item->views); ?> ℃</span>
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
					$index_notice_text = $this->options->JIndex_Notice;
					$index_notice = null;
					if ($index_notice_text) {
						$index_notice_arr = explode("||", $index_notice_text);
						if (count($index_notice_arr) === 2) $index_notice = array("text" => trim($index_notice_arr[0]), "url" => trim($index_notice_arr[1]));
					}
					?>
					<?php if ($index_notice) : ?>
						<div class="joe_index__title">
							<svg viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="20" height="20">
								<path d="M656.261 347.208a188.652 188.652 0 1 0 0 324.05v-324.05z" fill="#F4CA1C" />
								<path d="M668.35 118.881a73.35 73.35 0 0 0-71.169-4.06l-310.01 148.68a4.608 4.608 0 0 1-2.013.46h-155.11a73.728 73.728 0 0 0-73.728 73.636v349.64a73.728 73.728 0 0 0 73.728 73.636h156.554a4.68 4.68 0 0 1 1.94.43l309.592 143.196a73.702 73.702 0 0 0 104.668-66.82V181.206a73.216 73.216 0 0 0-34.453-62.326zM125.403 687.237v-349.64a4.608 4.608 0 0 1 4.608-4.608h122.035v358.882H130.048a4.608 4.608 0 0 1-4.644-4.634zm508.319 150.441a4.608 4.608 0 0 1-6.564 4.193L321.132 700.32V323.773l305.97-146.723a4.608 4.608 0 0 1 6.62 4.157v656.471zM938.26 478.72H788.01a34.509 34.509 0 1 0 0 69.018H938.26a34.509 34.509 0 1 0 0-69.018zM810.01 360.96a34.447 34.447 0 0 0 24.417-10.102l106.245-106.122a34.524 34.524 0 0 0-48.84-48.809L785.587 302.08a34.509 34.509 0 0 0 24.423 58.88zm24.417 314.609a34.524 34.524 0 1 0-48.84 48.814L891.832 830.52a34.524 34.524 0 0 0 48.84-48.809z" fill="#595BB3" />
							</svg>
							<div class=" joe_index__title-notice">
								<a href="<?php echo $index_notice['url'] ?>" target="_blank" rel="noopener noreferrer nofollow" title="<?php echo $index_notice['text'] ?>"><?php echo $index_notice['text'] ?></a>
							</div>
						</div>
					<?php endif; ?>

					<div class="joe_index__list" data-wow="<?php $this->options->JList_Animate() ?>">
						<ul class="joe_list"></ul>
						<ul class="joe_list__loading">
							<li class="item">
								<div class="information">
									<div class="title"></div>
									<div class="abstract">
										<p></p>
										<p></p>
									</div>
								</div>
								<div class="thumbnail"></div>
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
					<?php if ($this->options->JPageStatus === 'default') : ?>
						<?php $this->pageNav(
							'<svg class="icon icon-prev" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="12" height="12"><path d="M822.272 146.944l-396.8 396.8c-19.456 19.456-51.2 19.456-70.656 0-18.944-19.456-18.944-51.2 0-70.656l396.8-396.8c19.456-19.456 51.2-19.456 70.656 0 18.944 19.456 18.944 45.056 0 70.656z"/><path d="M745.472 940.544l-396.8-396.8c-19.456-19.456-19.456-51.2 0-70.656 19.456-19.456 51.2-19.456 70.656 0l403.456 390.144c19.456 25.6 19.456 51.2 0 76.8-26.112 19.968-51.712 19.968-77.312.512zm-564.224-63.488c0-3.584 0-7.68.512-11.264h-.512v-714.24h.512c-.512-3.584-.512-7.168-.512-11.264 0-43.008 21.504-78.336 48.128-78.336s48.128 34.816 48.128 78.336c0 3.584 0 7.68-.512 11.264h.512v714.24h-.512c.512 3.584.512 7.168.512 11.264 0 43.008-21.504 78.336-48.128 78.336s-48.128-35.328-48.128-78.336z"/></svg>',
							'<svg class="icon icon-next" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="12" height="12"><path d="M822.272 146.944l-396.8 396.8c-19.456 19.456-51.2 19.456-70.656 0-18.944-19.456-18.944-51.2 0-70.656l396.8-396.8c19.456-19.456 51.2-19.456 70.656 0 18.944 19.456 18.944 45.056 0 70.656z"/><path d="M745.472 940.544l-396.8-396.8c-19.456-19.456-19.456-51.2 0-70.656 19.456-19.456 51.2-19.456 70.656 0l403.456 390.144c19.456 25.6 19.456 51.2 0 76.8-26.112 19.968-51.712 19.968-77.312.512zm-564.224-63.488c0-3.584 0-7.68.512-11.264h-.512v-714.24h.512c-.512-3.584-.512-7.168-.512-11.264 0-43.008 21.504-78.336 48.128-78.336s48.128 34.816 48.128 78.336c0 3.584 0 7.68-.512 11.264h.512v714.24h-.512c.512 3.584.512 7.168.512 11.264 0 43.008-21.504 78.336-48.128 78.336s-48.128-35.328-48.128-78.336z"/></svg>',
							1,
							'...',
							array(
								'wrapTag' => 'ul',
								'wrapClass' => 'joe_pagination',
								'itemTag' => 'li',
								'textTag' => 'a',
								'currentClass' => 'active',
								'prevClass' => 'prev',
								'nextClass' => 'next'
							)
						);
						?>
					<?php else : ?>
						<div class="joe_load">查看更多</div>
					<?php endif ?>
				</div>
			</div>
			<?php if ($this->options->JAside_Switch === "on") : ?>
				<?php $this->need('public/aside.php'); ?>
			<?php endif; ?>
		</div>
		<?php $this->need('public/footer.php'); ?>
	</div>
</body>

</html>