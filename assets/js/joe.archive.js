/* 搜索页面需要用到的JS */
document.addEventListener('DOMContentLoaded', function () {
	const encryption = str => window.btoa(unescape(encodeURIComponent(str)));
	const decrypt = str => decodeURIComponent(escape(window.atob(str)));

	/* 激活列表特效 */
	{
		var wow = $('.joe_archive__list').attr('data-wow');
		if (wow !== 'off' && wow)
			new WOW({
				boxClass: 'wow',
				animateClass: 'animated '.concat(wow),
				offset: 0,
				mobile: true,
				live: true,
				scrollContainer: null
			}).init();
	}

	/* 激活文章列表点赞功能 */
	{
		let likeArr = localStorage.getItem(encryption('agree')) ? JSON.parse(decrypt(localStorage.getItem(encryption('agree')))) : [];
		likeArr.forEach(item => {
			$('.like-' + item)
				.addClass('active')
				.find('.like-status')
				.html('已赞');
		});
		$('.like').on('click', function () {
			const cid = $(this).attr('data-cid');
			likeArr = localStorage.getItem(encryption('agree')) ? JSON.parse(decrypt(localStorage.getItem(encryption('agree')))) : [];
			let flag = likeArr.includes(cid);
			$.ajax({
				url: Joe.BASE_API,
				type: 'POST',
				dataType: 'json',
				data: { routeType: 'handle_agree', cid, type: flag ? 'disagree' : 'agree' },
				success: res => {
					if (res.code !== 1) return;
					$(this).find('.like-num').html(res.data.agree);
					if (flag) {
						const index = likeArr.findIndex(_ => _ === cid);
						likeArr.splice(index, 1);
						$(this).removeClass('active');
						$(this).find('.like-status').html('点赞');
					} else {
						likeArr.push(cid);
						$(this).addClass('active');
						$(this).find('.like-status').html('已赞');
					}
					const name = encryption('agree');
					const val = encryption(JSON.stringify(likeArr));
					localStorage.setItem(name, val);
				}
			});
		});
	}
});
