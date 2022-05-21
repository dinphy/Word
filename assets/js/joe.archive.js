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

	/* 激活文章列表赞功能 */
	{
		let likeArr = localStorage.getItem(encryption('agree')) ? JSON.parse(decrypt(localStorage.getItem(encryption('agree')))) : [];
		likeArr.forEach(item => {
			$('.like-' + item)
				.addClass('active')
				.find('.like-status')
				.html('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"><path fill="none" d="M0 0h24v24H0z"/><path d="M2 9h3v12H2a1 1 0 0 1-1-1V10a1 1 0 0 1 1-1zm5.293-1.293l6.4-6.4a.5.5 0 0 1 .654-.047l.853.64a1.5 1.5 0 0 1 .553 1.57L14.6 8H21a2 2 0 0 1 2 2v2.104a2 2 0 0 1-.15.762l-3.095 7.515a1 1 0 0 1-.925.619H8a1 1 0 0 1-1-1V8.414a1 1 0 0 1 .293-.707z"/></svg>');
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
						Qmsg.info('我会努力的~');
						$(this).find('.like-status').html('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"><path fill="none" d="M0 0h24v24H0z"/><path d="M14.6 8H21a2 2 0 0 1 2 2v2.104a2 2 0 0 1-.15.762l-3.095 7.515a1 1 0 0 1-.925.619H2a1 1 0 0 1-1-1V10a1 1 0 0 1 1-1h3.482a1 1 0 0 0 .817-.423L11.752.85a.5.5 0 0 1 .632-.159l1.814.907a2.5 2.5 0 0 1 1.305 2.853L14.6 8zM7 10.588V19h11.16L21 12.104V10h-6.4a2 2 0 0 1-1.938-2.493l.903-3.548a.5.5 0 0 0-.261-.571l-.661-.33-4.71 6.672c-.25.354-.57.644-.933.858zM5 11H3v8h2v-8z"/></svg>');
					} else {
						likeArr.push(cid);
						$(this).addClass('active');
						Qmsg.success('谢谢你支持~');
						$(this).find('.like-status').html('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"><path fill="none" d="M0 0h24v24H0z"/><path d="M2 9h3v12H2a1 1 0 0 1-1-1V10a1 1 0 0 1 1-1zm5.293-1.293l6.4-6.4a.5.5 0 0 1 .654-.047l.853.64a1.5 1.5 0 0 1 .553 1.57L14.6 8H21a2 2 0 0 1 2 2v2.104a2 2 0 0 1-.15.762l-3.095 7.515a1 1 0 0 1-.925.619H8a1 1 0 0 1-1-1V8.414a1 1 0 0 1 .293-.707z"/></svg>');
					}
					const name = encryption('agree');
					const val = encryption(JSON.stringify(likeArr));
					localStorage.setItem(name, val);
				}
			});
		});
	}
});
