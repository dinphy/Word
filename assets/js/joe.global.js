document.addEventListener('DOMContentLoaded', () => {
	const encryption = str => window.btoa(unescape(encodeURIComponent(str)));
	const decrypt = str => decodeURIComponent(escape(window.atob(str)));

	/* 激活轮播图功能 */
	{
		if ($('.joe_index__banner .swiper-container').length !== 0) {
			let direction = 'horizontal';
			if (!Joe.IS_MOBILE && $('.joe_index__banner-recommend .item').length === 2) direction = 'vertical';
			new Swiper('.swiper-container', {
				keyboard: false,
				direction,
				loop: true,
				//autoplay: true,
				mousewheel: false,
				navigation: {
					nextEl: '.swiper-button-next',
					prevEl: '.swiper-button-prev'
				}
			});
		}
	}

	/* 初始化首页列表功能 */
	{
		let likeArr = localStorage.getItem(encryption('agree')) ? JSON.parse(decrypt(localStorage.getItem(encryption('agree')))) : [];
		const getListMode = _ => {
			if (_.mode === 'default') {
				return `
                    <li class="joe_list__item wow default">
                        <div class="line"></div>
                        <a href="${_.permalink}" class="thumbnail" title="${_.title}" target="_blank" rel="noopener noreferrer">
                            <img width="100%" height="100%" class="lazyload" src="${_.lazyload}" data-src="${_.image[0]}" alt="${_.title}" />
                            <time datetime="${_.time}">${_.category.length && _.category[0].name}</time>
                            <svg viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="20" height="20"><path d="M903.93 107.306H115.787c-51.213 0-93.204 42.505-93.204 93.72V825.29c0 51.724 41.99 93.717 93.717 93.717h788.144c51.72 0 93.717-41.993 93.717-93.717V201.025c-.512-51.214-43.017-93.719-94.23-93.719zm-788.144 64.527h788.657c16.385 0 29.704 13.316 29.704 29.704v390.229L760.54 402.285c-12.805-13.828-30.217-21.508-48.14-19.971-17.924 1.02-34.821 10.754-46.602 26.114l-172.582 239.16-87.06-85.52c-12.29-11.783-27.654-17.924-44.039-17.924-16.39.508-31.755 7.676-43.53 20.48L86.595 821.705V202.05c-1.025-17.416 12.804-30.73 29.191-30.217zm788.145 683.674H141.906l222.255-245.82 87.06 86.037c12.8 12.807 30.212 18.95 47.115 17.417 17.41-1.538 33.797-11.266 45.063-26.118l172.584-238.647 216.111 236.088 2.051-1.54V825.8c.509 16.39-13.315 29.706-30.214 29.706zm0 0"/><path d="M318.072 509.827c79.89 0 144.417-65.037 144.417-144.416 0-79.378-64.527-144.925-144.417-144.925-79.891 0-144.416 64.527-144.416 144.412 0 79.892 64.525 144.93 144.416 144.93zm0-225.327c44.553 0 80.912 36.362 80.912 80.91 0 44.557-35.847 81.43-80.912 81.43-45.068 0-80.916-36.36-80.916-80.915 0-44.556 36.872-81.425 80.916-81.425zm0 0"/></svg>
                        </a>
                        <div class="information">
                            <a href="${_.permalink}" class="title" title="${_.title}" target="_blank" rel="noopener noreferrer">
                                <span class="badge" style="display: ${_.type === 'sticky' ? 'inline-block' : 'none'}">置顶</span>${_.title}
                            </a>
                            <a class="abstract" href="${_.permalink}" title="文章摘要" target="_blank" rel="noopener noreferrer">${_.abstract}</a>
                            <div class="meta">
                                <ul class="items">
                                    <li>${_.created}</li>
                                </ul>
								<div class="meta-right">
									<ul class="items">
										<li class="like">
											<a class="like ${likeArr.includes(_.cid) ? 'active' : ''}" data-cid="${_.cid}" href="javascript:;">
												<span class="like-status">${likeArr.includes(_.cid) ? '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"><path fill="none" d="M0 0h24v24H0z"/><path d="M2 9h3v12H2a1 1 0 0 1-1-1V10a1 1 0 0 1 1-1zm5.293-1.293l6.4-6.4a.5.5 0 0 1 .654-.047l.853.64a1.5 1.5 0 0 1 .553 1.57L14.6 8H21a2 2 0 0 1 2 2v2.104a2 2 0 0 1-.15.762l-3.095 7.515a1 1 0 0 1-.925.619H8a1 1 0 0 1-1-1V8.414a1 1 0 0 1 .293-.707z"/></svg>' : '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"><path fill="none" d="M0 0h24v24H0z"/><path d="M14.6 8H21a2 2 0 0 1 2 2v2.104a2 2 0 0 1-.15.762l-3.095 7.515a1 1 0 0 1-.925.619H2a1 1 0 0 1-1-1V10a1 1 0 0 1 1-1h3.482a1 1 0 0 0 .817-.423L11.752.85a.5.5 0 0 1 .632-.159l1.814.907a2.5 2.5 0 0 1 1.305 2.853L14.6 8zM7 10.588V19h11.16L21 12.104V10h-6.4a2 2 0 0 1-1.938-2.493l.903-3.548a.5.5 0 0 0-.261-.571l-.661-.33-4.71 6.672c-.25.354-.57.644-.933.858zM5 11H3v8h2v-8z"/></svg>'}</span>
												<span class="like-num">${_.agree}</span>
											</a>
										</li>
										<li>
											<a href="${_.permalink}#comments">
												<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16"><path fill="none" d="M0 0h24v24H0z"/><path d="M2 8.994A5.99 5.99 0 0 1 8 3h8c3.313 0 6 2.695 6 5.994V21H8c-3.313 0-6-2.695-6-5.994V8.994zM20 19V8.994A4.004 4.004 0 0 0 16 5H8a3.99 3.99 0 0 0-4 3.994v6.012A4.004 4.004 0 0 0 8 19h12zm-6-8h2v2h-2v-2zm-6 0h2v2H8v-2z"/></svg>
												${_.commentsNum}
											</a>
										</li>
									</ul>
									<ul class="items">
										<li>
											<a href="javascript:void(0);">
												<em></em><em></em>
											</a>
										</li>
									</ul>
								</div>
                            </div>
                        </div>
                    </li>
                `;
			} else if (_.mode === 'single') {
				return `
                    <li class="joe_list__item wow single">
                        <div class="line"></div>
                        <div class="information">
							<a href="${_.permalink}" class="title" title="${_.title}" target="_blank" rel="noopener noreferrer">
								<span class="badge" style="display: ${_.type === 'sticky' ? 'inline-block' : 'none'}">置顶</span>${_.title}
							</a>
							<a class="abstract" href="${_.permalink}" title="文章摘要" target="_blank" rel="noopener noreferrer">${_.abstract}</a>
                        </div>
                        <a href="${_.permalink}" class="thumbnail" title="${_.title}" target="_blank" rel="noopener noreferrer">
                            <img width="100%" height="100%" class="lazyload" src="${_.lazyload}" data-src="${_.image[0]}" alt="${_.title}" />
                            <time datetime="${_.time}">${_.category.length && _.category[0].name}</time>
                            <svg viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="20" height="20"><path d="M903.93 107.306H115.787c-51.213 0-93.204 42.505-93.204 93.72V825.29c0 51.724 41.99 93.717 93.717 93.717h788.144c51.72 0 93.717-41.993 93.717-93.717V201.025c-.512-51.214-43.017-93.719-94.23-93.719zm-788.144 64.527h788.657c16.385 0 29.704 13.316 29.704 29.704v390.229L760.54 402.285c-12.805-13.828-30.217-21.508-48.14-19.971-17.924 1.02-34.821 10.754-46.602 26.114l-172.582 239.16-87.06-85.52c-12.29-11.783-27.654-17.924-44.039-17.924-16.39.508-31.755 7.676-43.53 20.48L86.595 821.705V202.05c-1.025-17.416 12.804-30.73 29.191-30.217zm788.145 683.674H141.906l222.255-245.82 87.06 86.037c12.8 12.807 30.212 18.95 47.115 17.417 17.41-1.538 33.797-11.266 45.063-26.118l172.584-238.647 216.111 236.088 2.051-1.54V825.8c.509 16.39-13.315 29.706-30.214 29.706zm0 0"/><path d="M318.072 509.827c79.89 0 144.417-65.037 144.417-144.416 0-79.378-64.527-144.925-144.417-144.925-79.891 0-144.416 64.527-144.416 144.412 0 79.892 64.525 144.93 144.416 144.93zm0-225.327c44.553 0 80.912 36.362 80.912 80.91 0 44.557-35.847 81.43-80.912 81.43-45.068 0-80.916-36.36-80.916-80.915 0-44.556 36.872-81.425 80.916-81.425zm0 0"/></svg>
                        </a>
						<div class="meta">
							<ul class="items">
								<li>${_.created}</li>
							</ul>
							<div class="meta-right">
								<ul class="items">
									<li class="like">
										<a class="like ${likeArr.includes(_.cid) ? 'active' : ''}" data-cid="${_.cid}" href="javascript:;">
											<span class="like-status">${likeArr.includes(_.cid) ? '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"><path fill="none" d="M0 0h24v24H0z"/><path d="M2 9h3v12H2a1 1 0 0 1-1-1V10a1 1 0 0 1 1-1zm5.293-1.293l6.4-6.4a.5.5 0 0 1 .654-.047l.853.64a1.5 1.5 0 0 1 .553 1.57L14.6 8H21a2 2 0 0 1 2 2v2.104a2 2 0 0 1-.15.762l-3.095 7.515a1 1 0 0 1-.925.619H8a1 1 0 0 1-1-1V8.414a1 1 0 0 1 .293-.707z"/></svg>' : '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"><path fill="none" d="M0 0h24v24H0z"/><path d="M14.6 8H21a2 2 0 0 1 2 2v2.104a2 2 0 0 1-.15.762l-3.095 7.515a1 1 0 0 1-.925.619H2a1 1 0 0 1-1-1V10a1 1 0 0 1 1-1h3.482a1 1 0 0 0 .817-.423L11.752.85a.5.5 0 0 1 .632-.159l1.814.907a2.5 2.5 0 0 1 1.305 2.853L14.6 8zM7 10.588V19h11.16L21 12.104V10h-6.4a2 2 0 0 1-1.938-2.493l.903-3.548a.5.5 0 0 0-.261-.571l-.661-.33-4.71 6.672c-.25.354-.57.644-.933.858zM5 11H3v8h2v-8z"/></svg>'}</span>
											<span class="like-num">${_.agree}</span>
										</a>
									</li>
									<li>
										<a href="${_.permalink}#comments">
											<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16"><path fill="none" d="M0 0h24v24H0z"/><path d="M2 8.994A5.99 5.99 0 0 1 8 3h8c3.313 0 6 2.695 6 5.994V21H8c-3.313 0-6-2.695-6-5.994V8.994zM20 19V8.994A4.004 4.004 0 0 0 16 5H8a3.99 3.99 0 0 0-4 3.994v6.012A4.004 4.004 0 0 0 8 19h12zm-6-8h2v2h-2v-2zm-6 0h2v2H8v-2z"/></svg>
											${_.commentsNum}
										</a>
									</li>
								</ul>
								<ul class="items">
									<li>
										<a href="javascript:void(0);">
											<em></em><em></em>
										</a>
									</li>
								</ul>
							</div>
						</div>
                    </li>
                `;
			} else if (_.mode === 'multiple') {
				return `
                    <li class="joe_list__item wow multiple">
                        <div class="line"></div>
                        <div class="information">
                            <a href="${_.permalink}" class="title" title="${_.title}" target="_blank" rel="noopener noreferrer">
                                <span class="badge" style="display: ${_.type === 'sticky' ? 'inline-block' : 'none'}">置顶</span>${_.title}
                            </a>
							<a class="category" target="_blank" rel="noopener noreferrer" href="${_.category.length && _.category[0].permalink}">${_.category.length && _.category[0].name}</a>
                            <a class="abstract" href="${_.permalink}" title="文章摘要" target="_blank" rel="noopener noreferrer">${_.abstract}</a>
                        </div>
                        <a href="${_.permalink}" class="thumbnail" title="${_.title}" target="_blank" rel="noopener noreferrer">
                            ${_.image
								.map((item, index) => {
									if (index < 3) {
										return `<img width="100%" height="100%" class="lazyload" src="${_.lazyload}" data-src="${item}" alt="${_.title}" />`;
									}
								})
								.join('')}
                        </a>
                        <div class="meta">
							<ul class="items">
								<li>${_.created}</li>
							</ul>
							<div class="meta-right">
								<ul class="items">
									<li class="like">
										<a class="like ${likeArr.includes(_.cid) ? 'active' : ''}" data-cid="${_.cid}" href="javascript:;">
											<span class="like-status">${likeArr.includes(_.cid) ? '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"><path fill="none" d="M0 0h24v24H0z"/><path d="M2 9h3v12H2a1 1 0 0 1-1-1V10a1 1 0 0 1 1-1zm5.293-1.293l6.4-6.4a.5.5 0 0 1 .654-.047l.853.64a1.5 1.5 0 0 1 .553 1.57L14.6 8H21a2 2 0 0 1 2 2v2.104a2 2 0 0 1-.15.762l-3.095 7.515a1 1 0 0 1-.925.619H8a1 1 0 0 1-1-1V8.414a1 1 0 0 1 .293-.707z"/></svg>' : '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"><path fill="none" d="M0 0h24v24H0z"/><path d="M14.6 8H21a2 2 0 0 1 2 2v2.104a2 2 0 0 1-.15.762l-3.095 7.515a1 1 0 0 1-.925.619H2a1 1 0 0 1-1-1V10a1 1 0 0 1 1-1h3.482a1 1 0 0 0 .817-.423L11.752.85a.5.5 0 0 1 .632-.159l1.814.907a2.5 2.5 0 0 1 1.305 2.853L14.6 8zM7 10.588V19h11.16L21 12.104V10h-6.4a2 2 0 0 1-1.938-2.493l.903-3.548a.5.5 0 0 0-.261-.571l-.661-.33-4.71 6.672c-.25.354-.57.644-.933.858zM5 11H3v8h2v-8z"/></svg>'}</span>
											<span class="like-num">${_.agree}</span>
										</a>
									</li>
									<li>
										<a href="${_.permalink}#comments">
											<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16"><path fill="none" d="M0 0h24v24H0z"/><path d="M2 8.994A5.99 5.99 0 0 1 8 3h8c3.313 0 6 2.695 6 5.994V21H8c-3.313 0-6-2.695-6-5.994V8.994zM20 19V8.994A4.004 4.004 0 0 0 16 5H8a3.99 3.99 0 0 0-4 3.994v6.012A4.004 4.004 0 0 0 8 19h12zm-6-8h2v2h-2v-2zm-6 0h2v2H8v-2z"/></svg>
											${_.commentsNum}
										</a>
									</li>
								</ul>
								<ul class="items">
									<li>
										<a href="javascript:void(0);">
											<em></em><em></em>
										</a>
									</li>
								</ul>
							</div>
						</div>
                    </li>
                `;
			} else if (_.mode === 'chat') {
				return `
                    <li class="joe_list__item wow chat">
                        <div class="information">
                            <a href="${_.authorlink}" target="_blank" rel="noopener noreferrer">
                                <img class="avatar" src="${_.avatar}" alt="头像">
                            </a>
							<a class="category" target="_blank" rel="noopener noreferrer" href="${_.category.length && _.category[0].permalink}">${_.category.length && _.category[0].name}</a>
                            <div class="desc">
                                <div class="title"><a href="${_.permalink}" target="_blank" rel="noopener noreferrer"><span class="badge" style="display: ${_.type === 'sticky' ? 'inline-block' : 'none'}">置顶</span>${_.title}</a></div>
                                <div class="time">${_.created}</div>
                            </div>
                        </div>
                        
                            <div class="content">
                                <div class="abstract">${_.abstract}</div>
								<div class="content-full" style="display: none;">${_.chatContent}</div>
                                <a href="javascript:void(0);" class="content-more">全文</a>
                            </div>
                        
                        <div class="meta">
							<ul class="items">
								<li>${_.views} 人围观</li>
							</ul>
							<div class="meta-right">
								<ul class="items">
									<li class="like">
										<a class="like ${likeArr.includes(_.cid) ? 'active' : ''}" data-cid="${_.cid}" href="javascript:;">
											<span class="like-status">${likeArr.includes(_.cid) ? '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"><path fill="none" d="M0 0h24v24H0z"/><path d="M2 9h3v12H2a1 1 0 0 1-1-1V10a1 1 0 0 1 1-1zm5.293-1.293l6.4-6.4a.5.5 0 0 1 .654-.047l.853.64a1.5 1.5 0 0 1 .553 1.57L14.6 8H21a2 2 0 0 1 2 2v2.104a2 2 0 0 1-.15.762l-3.095 7.515a1 1 0 0 1-.925.619H8a1 1 0 0 1-1-1V8.414a1 1 0 0 1 .293-.707z"/></svg>' : '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"><path fill="none" d="M0 0h24v24H0z"/><path d="M14.6 8H21a2 2 0 0 1 2 2v2.104a2 2 0 0 1-.15.762l-3.095 7.515a1 1 0 0 1-.925.619H2a1 1 0 0 1-1-1V10a1 1 0 0 1 1-1h3.482a1 1 0 0 0 .817-.423L11.752.85a.5.5 0 0 1 .632-.159l1.814.907a2.5 2.5 0 0 1 1.305 2.853L14.6 8zM7 10.588V19h11.16L21 12.104V10h-6.4a2 2 0 0 1-1.938-2.493l.903-3.548a.5.5 0 0 0-.261-.571l-.661-.33-4.71 6.672c-.25.354-.57.644-.933.858zM5 11H3v8h2v-8z"/></svg>'}</span>
											<span class="like-num">${_.agree}</span>
										</a>
									</li>
									<li>
										<a href="${_.permalink}#comments">
											<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16"><path fill="none" d="M0 0h24v24H0z"/><path d="M2 8.994A5.99 5.99 0 0 1 8 3h8c3.313 0 6 2.695 6 5.994V21H8c-3.313 0-6-2.695-6-5.994V8.994zM20 19V8.994A4.004 4.004 0 0 0 16 5H8a3.99 3.99 0 0 0-4 3.994v6.012A4.004 4.004 0 0 0 8 19h12zm-6-8h2v2h-2v-2zm-6 0h2v2H8v-2z"/></svg>
											${_.commentsNum}
										</a>
									</li>
								</ul>
								<ul class="items">
									<li>
										<a href="javascript:void(0);">
											<em></em><em></em>
										</a>
									</li>
								</ul>
							</div>
                        </div>
                    </li>
                `;
			} else {
				return `
                    <li class="joe_list__item wow none">
                        <div class="line"></div>
                        <div class="information">
                            <a href="${_.permalink}" class="title" title="${_.title}" target="_blank" rel="noopener noreferrer">
                                <span class="badge" style="display: ${_.type === 'sticky' ? 'inline-block' : 'none'}">置顶</span>${_.title}
                            </a>
							<a class="category" target="_blank" rel="noopener noreferrer" href="${_.category.length && _.category[0].permalink}">${_.category.length && _.category[0].name}</a>
                            <a class="abstract" href="${_.permalink}" title="文章摘要" target="_blank" rel="noopener noreferrer">${_.abstract}</a>
                            <div class="meta">
                                <ul class="items">
                                    <li>${_.created}</li>
                                </ul>
								<div class="meta-right">
									<ul class="items">
										<li class="like">
											<a class="like ${likeArr.includes(_.cid) ? 'active' : ''}" data-cid="${_.cid}" href="javascript:;">
												<span class="like-status">${likeArr.includes(_.cid) ? '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"><path fill="none" d="M0 0h24v24H0z"/><path d="M2 9h3v12H2a1 1 0 0 1-1-1V10a1 1 0 0 1 1-1zm5.293-1.293l6.4-6.4a.5.5 0 0 1 .654-.047l.853.64a1.5 1.5 0 0 1 .553 1.57L14.6 8H21a2 2 0 0 1 2 2v2.104a2 2 0 0 1-.15.762l-3.095 7.515a1 1 0 0 1-.925.619H8a1 1 0 0 1-1-1V8.414a1 1 0 0 1 .293-.707z"/></svg>' : '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"><path fill="none" d="M0 0h24v24H0z"/><path d="M14.6 8H21a2 2 0 0 1 2 2v2.104a2 2 0 0 1-.15.762l-3.095 7.515a1 1 0 0 1-.925.619H2a1 1 0 0 1-1-1V10a1 1 0 0 1 1-1h3.482a1 1 0 0 0 .817-.423L11.752.85a.5.5 0 0 1 .632-.159l1.814.907a2.5 2.5 0 0 1 1.305 2.853L14.6 8zM7 10.588V19h11.16L21 12.104V10h-6.4a2 2 0 0 1-1.938-2.493l.903-3.548a.5.5 0 0 0-.261-.571l-.661-.33-4.71 6.672c-.25.354-.57.644-.933.858zM5 11H3v8h2v-8z"/></svg>'}</span>
												<span class="like-num">${_.agree}</span>
											</a>
										</li>
										<li>
											<a href="${_.permalink}#comments">
												<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16"><path fill="none" d="M0 0h24v24H0z"/><path d="M2 8.994A5.99 5.99 0 0 1 8 3h8c3.313 0 6 2.695 6 5.994V21H8c-3.313 0-6-2.695-6-5.994V8.994zM20 19V8.994A4.004 4.004 0 0 0 16 5H8a3.99 3.99 0 0 0-4 3.994v6.012A4.004 4.004 0 0 0 8 19h12zm-6-8h2v2h-2v-2zm-6 0h2v2H8v-2z"/></svg>
												${_.commentsNum}
											</a>
										</li>
									</ul>
									<ul class="items">
										<li>
											<a href="javascript:void(0);">
												<em></em><em></em>
											</a>
										</li>
									</ul>
								</div>
                            </div>
                        </div>
                    </li>
                `;
			}
		};
		let queryData = { page: 1, pageSize: window.Joe.PAGE_SIZE, type: 'created' };
		const initDom = () => {
			$('.joe_index__list .joe_list').html('');
			$('.joe_load').show();
			let activeItem = $('.joe_index__title-title .item[data-type="' + queryData.type + '"]');
			let activeLine = $('.joe_index__title-title .line');
			activeItem.addClass('active').siblings().removeClass('active');
			if ($('.joe_index__title').length) {
				activeLine.css({ left: activeItem.position().left, width: activeItem.width() });
			}
		};
		const pushDom = () => {
			return new Promise((reslove, reject) => {
				$('.joe_load').attr('loading', true);
				$('.joe_load').html('loading...');
				$('.joe_index__list .joe_list__loading').show();
				$.ajax({
					url: Joe.BASE_API,
					type: 'POST',
					dataType: 'json',
					data: { routeType: 'publish_list', page: queryData.page, pageSize: queryData.pageSize, type: queryData.type },
					success(res) {
						if (res.data.length === 0) {
							$('.joe_load').removeAttr('loading');
							$('.joe_load').html('查看更多');
							$('.joe_load').hide();
							$('.joe_index__list .joe_list__loading').hide();
							return Qmsg.warning('没有更多内容了');
						}
						res.data.forEach(_ => $('.joe_index__list .joe_list').append(getListMode(_)));
						$('.joe_load').removeAttr('loading');
						$('.joe_load').html('查看更多');
						$('.joe_index__list .joe_list__loading').hide();
						reslove(res.data.length > 0 ? res.data.length - 1 : 0);
					}
				});
			});
		};
		initDom();
		pushDom();
		$('.joe_index__title-title .item').on('click', async function () {
			if ($(this).attr('data-type') === queryData.type) return;
			queryData = { page: 1, pageSize: window.Joe.PAGE_SIZE, type: $(this).attr('data-type') };
			initDom();
			pushDom();
		});
		$('.joe_load').on('click', async function () {
			if ($(this).attr('loading')) return;
			queryData.page++;
			let length = await pushDom();
			length = $('.joe_index__list .joe_list .joe_list__item').length - length;
			const queryElement = `.joe_index__list .joe_list .joe_list__item:nth-child(${length})`;
			const offset = $(queryElement).offset().top - $('.joe_header').height();
			window.scrollTo({ top: offset - 15, behavior: 'smooth' });
		});
	}

	/* 激活列表特效 */
	{
		const wow = $('.joe_index__list,.joe_archive__list').attr('data-wow');
		if (wow !== 'off' && wow) new WOW({ boxClass: 'wow', animateClass: `animated ${wow}`, offset: 0, mobile: true, live: true, scrollContainer: null }).init();
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
		$('.joe_list').on('click', '.like', function () {
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

	/* 初始化昼夜模式 */
	{
		if (localStorage.getItem('data-night')) {
			$('.joe_action_item.mode .icon-1').addClass('active');
			$('.joe_action_item.mode .icon-2').removeClass('active');
		} else {
			$('html').removeAttr('data-night');
			$('.joe_action_item.mode .icon-1').removeClass('active');
			$('.joe_action_item.mode .icon-2').addClass('active');
		}
		$('.joe_action_item.mode').on('click', () => {
			if (localStorage.getItem('data-night')) {
				$('.joe_action_item.mode .icon-1').removeClass('active');
				$('.joe_action_item.mode .icon-2').addClass('active');
				$('html').removeAttr('data-night');
				localStorage.removeItem('data-night');
				$('.joe_batten img,.joe_detail__article img:not([class]),.joe_batten .author__user-item #hitokoto').css('filter', 'none');
			} else {
				$('.joe_action_item.mode .icon-1').addClass('active');
				$('.joe_action_item.mode .icon-2').removeClass('active');
				$('html').attr('data-night', 'night');
				localStorage.setItem('data-night', 'night');
				$('.joe_batten img,.joe_detail__article img:not([class]),.joe_batten .author__user-item #hitokoto').css('filter', 'brightness(0.5)');
			}
		});
	}

	/* 动态背景 */
	{
		if (!Joe.IS_MOBILE && Joe.DYNAMIC_BACKGROUND !== 'off' && Joe.DYNAMIC_BACKGROUND && !Joe.WALLPAPER_BACKGROUND_PC) {
			$.getScript(window.Joe.THEME_URL + `assets/backdrop/${Joe.DYNAMIC_BACKGROUND}`);
		}
	}

	/* 搜索框弹窗 */
	{
		$('.joe_header__above-search .input').on('click', e => {
			e.stopPropagation();
			$('.joe_header__above-search .result').addClass('active');
		});
		$(document).on('click', function () {
			$('.joe_header__above-search .result').removeClass('active');
		});
	}

	/* 激活全局下拉框功能 */
	{
		$('.joe_dropdown').each(function (index, item) {
			const menu = $(this).find('.joe_dropdown__menu');
			const trigger = $(item).attr('trigger') || 'click';
			const placement = $(item).attr('placement') || $(this).height() || 0;
			menu.css('top', placement);
			if (trigger === 'hover') {
				$(this).hover(
					() => $(this).addClass('active'),
					() => $(this).removeClass('active')
				);
			} else {
				$(this).on('click', function (e) {
					$(this).toggleClass('active');
					$(document).one('click', () => $(this).removeClass('active'));
					e.stopPropagation();
				});
				menu.on('click', e => e.stopPropagation());
			}
		});
		$('.joe_dropdown__link')
			.has('.joe_dropdown__submenu')
			.hover(function () {
				$(this).children('.joe_dropdown__submenu').stop().toggleClass('active');
			});
	}

	/* 侧边栏开关 */
	{
		$('.joe_action_item.aside').on('click', function () {
			$('.joe_aside,.joe_menu').toggle(100);
		});
	}

	/* 激活全局返回顶部功能 */
	{
		let _debounce = null;
		const handleScroll = () => ((document.documentElement.scrollTop || document.body.scrollTop) > 300 ? $('.joe_action_item.scroll').addClass('active') : $('.joe_action_item.scroll').removeClass('active'));
		handleScroll();
		$(document).on('scroll', () => {
			clearTimeout(_debounce);
			_debounce = setTimeout(handleScroll, 80);
		});
		$('.joe_action_item.scroll').on('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
	}

	/* 激活侧边栏人生倒计时功能 */
	{
		if ($('.joe_aside__item.timelife').length) {
			let timelife = [
				{ title: '今日已经过去', endTitle: '小时', num: 0, percent: '0%' },
				{ title: '这周已经过去', endTitle: '天', num: 0, percent: '0%' },
				{ title: '本月已经过去', endTitle: '天', num: 0, percent: '0%' },
				{ title: '今年已经过去', endTitle: '个月', num: 0, percent: '0%' }
			];
			{
				let nowDate = +new Date();
				let todayStartDate = new Date(new Date().toLocaleDateString()).getTime();
				let todayPassHours = (nowDate - todayStartDate) / 1000 / 60 / 60;
				let todayPassHoursPercent = (todayPassHours / 24) * 100;
				timelife[0].num = parseInt(todayPassHours);
				timelife[0].percent = parseInt(todayPassHoursPercent) + '%';
			}
			{
				let weeks = { 0: 7, 1: 1, 2: 2, 3: 3, 4: 4, 5: 5, 6: 6 };
				let weekDay = weeks[new Date().getDay()];
				let weekDayPassPercent = (weekDay / 7) * 100;
				timelife[1].num = parseInt(weekDay);
				timelife[1].percent = parseInt(weekDayPassPercent) + '%';
			}
			{
				let year = new Date().getFullYear();
				let date = new Date().getDate();
				let month = new Date().getMonth() + 1;
				let monthAll = new Date(year, month, 0).getDate();
				let monthPassPercent = (date / monthAll) * 100;
				timelife[2].num = date;
				timelife[2].percent = parseInt(monthPassPercent) + '%';
			}
			{
				let month = new Date().getMonth() + 1;
				let yearPass = (month / 12) * 100;
				timelife[3].num = month;
				timelife[3].percent = parseInt(yearPass) + '%';
			}
			let htmlStr = '';
			timelife.forEach((item, index) => {
				htmlStr += `
						<div class="item">
							<div class="title">
								${item.title}
								<span class="text">${item.num}</span>
								${item.endTitle}
							</div>
							<div class="progress">
								<div class="progress-bar">
									<div class="progress-bar-inner progress-bar-inner-${index}" style="width: ${item.percent}"></div>
								</div>
								<div class="progress-percentage">${item.percent}</div>
							</div>
						</div>`;
			});
			$('.joe_aside__item.timelife .joe_aside__item-contain').html(htmlStr);
		}
	}

	/* 3d云标签 */
	{
		if ($('.joe_aside__item.tags').length) {
			const entries = [];
			const colors = ['#F8D800', '#0396FF', '#EA5455', '#7367F0', '#32CCBC', '#F6416C', '#28C76F', '#9F44D3', '#F55555', '#736EFE', '#E96D71', '#DE4313', '#D939CD', '#4C83FF', '#F072B6', '#C346C2', '#5961F9', '#FD6585', '#465EFB', '#FFC600', '#FA742B', '#5151E5', '#BB4E75', '#FF52E5', '#49C628', '#00EAFF', '#F067B4', '#F067B4', '#ff9a9e', '#00f2fe', '#4facfe', '#f093fb', '#6fa3ef', '#bc99c4', '#46c47c', '#f9bb3c', '#e8583d', '#f68e5f'];
			const random = (min, max) => {
				min = Math.ceil(min);
				max = Math.floor(max);
				return Math.floor(Math.random() * (max - min + 1)) + min;
			};
			$('.joe_aside__item-contain .list li').each((i, item) => {
				entries.push({
					label: $(item).attr('data-label'),
					url: $(item).attr('data-url'),
					target: '_blank',
					fontColor: colors[random(0, colors.length - 1)],
					fontSize: 15
				});
			});
			$('.joe_aside__item-contain .tag').svg3DTagCloud({
				entries,
				width: 220,
				height: 220,
				radius: '65%',
				radiusMin: 75,
				bgDraw: false,
				fov: 800,
				speed: 0.5,
				fontWeight: 500
			});
		}
	}

	/* 评论框点击切换画图模式和文本模式 */
	{
		if ($('.joe_comment').length) {
			$('.joe_comment__respond-type .item').on('click', function () {
				$(this).addClass('active').siblings().removeClass('active');
				if ($(this).attr('data-type') === 'draw') {
					$('.joe_comment__respond-form .body .draw').show().siblings().hide();
					$('#joe_comment_draw').prop('width', $('.joe_comment__respond-form .body').width());
					/* 设置表单格式为画图模式 */
					$('.joe_comment__respond-form').attr('data-type', 'draw');
				} else {
					$('.joe_comment__respond-form .body .text').show().siblings().hide();
					/* 设置表单格式为文字模式 */
					$('.joe_comment__respond-form').attr('data-type', 'text');
				}
			});
			$('.joe_comment__respond-form .body').mouseenter(function () {
				$('.joe_comment__respond-form .body .text').focus();
			});
		}
	}

	/* 激活画图功能 */
	{
		if ($('#joe_comment_draw').length) {
			/* 激活画板 */
			window.sketchpad = new Sketchpad({ element: '#joe_comment_draw', height: 200, penSize: 5, color: '303133' });
			/* 撤销上一步 */
			$('.joe_comment__respond-form .body .draw .icon-undo').on('click', () => window.sketchpad.undo());
			/* 动画预览 */
			$('.joe_comment__respond-form .body .draw .icon-animate').on('click', () => window.sketchpad.animate(10));
			/* 更改画板的线宽 */
			$('.joe_comment__respond-form .body .draw .line li').on('click', function () {
				window.sketchpad.penSize = $(this).attr('data-line');
				$(this).addClass('active').siblings().removeClass('active');
			});
			/* 更改画板的颜色 */
			$('.joe_comment__respond-form .body .draw .color li').on('click', function () {
				window.sketchpad.color = $(this).attr('data-color');
				$(this).addClass('active').siblings().removeClass('active');
			});
		}
	}

	/* 重写评论功能 */
	{
		if ($('.joe_comment__respond').length) {
			const respond = $('.joe_comment__respond');
			/* 重写回复功能 */
			$('.joe_comment__reply').on('click', function () {
				/* 父级ID */
				const coid = $(this).attr('data-coid');
				/* 当前的项 */
				const item = $('#' + $(this).attr('data-id'));
				/* 添加自定义属性表示父级ID */
				respond.find('.joe_comment__respond-form').attr('data-coid', coid);
				item.append(respond);
				$(".joe_comment__respond-type .item[data-type='text']").click();
				$('.joe_comment__cancle').show();
				window.scrollTo({
					top: item.offset().top - $('.joe_header').height() - 15,
					behavior: 'smooth'
				});
			});
			/* 重写取消回复功能 */
			$('.joe_comment__cancle').on('click', function () {
				/* 移除自定义属性父级ID */
				respond.find('.joe_comment__respond-form').removeAttr('data-coid');
				$('.joe_comment__cancle').hide();
				$('.joe_comment__title').after(respond);
				$(".joe_comment__respond-type .item[data-type='text']").click();
				/* window.scrollTo({
					top: $('.joe_comment').offset().top - $('.joe_header').height() - 15,
					behavior: 'smooth'
				}); */
			});
		}
	}

	/* 激活评论提交 */
	{
		if ($('.joe_comment').length) {
			let isSubmit = false;
			$('.joe_comment__respond-form').on('submit', function (e) {
				e.preventDefault();
				const action = $('.joe_comment__respond-form').attr('action') + '?time=' + +new Date();
				const type = $('.joe_comment__respond-form').attr('data-type');
				const parent = $('.joe_comment__respond-form').attr('data-coid');
				const author = $(".joe_comment__respond-form .head input[name='author']").val();
				const _ = $(".joe_comment__respond-form input[name='_']").val();
				const mail = $(".joe_comment__respond-form .head input[name='mail']").val();
				const url = $(".joe_comment__respond-form .head input[name='url']").val();
				let text = $(".joe_comment__respond-form .body textarea[name='text']").val();
				if (author.trim() === '') return Qmsg.info('请输入昵称！');
				if (!/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/.test(mail)) return Qmsg.info('请输入正确的邮箱！');
				if (type === 'text' && text.trim() === '') return Qmsg.info('请输入评论内容！');
				if (type === 'draw') {
					const txt = $('#joe_comment_draw')[0].toDataURL('image/webp', 0.1);
					text = '{!{' + txt + '}!} ';
				}
				if (isSubmit) return;
				isSubmit = true;
				$('.joe_comment__respond-form .foot .submit button').html('发送中...');
				$.ajax({
					url: action,
					type: 'POST',
					data: { author, mail, text, parent, url, _ },
					dataType: 'text',
					success(res) {
						let arr = [],
							str = '';
						arr = $(res).contents();
						Array.from(arr).forEach(_ => {
							if (_.parentNode.className === 'container') str = _;
						});
						if (!/Joe/.test(res)) {
							Qmsg.warning(str.textContent.trim() || '');
							isSubmit = false;
							$('.joe_comment__respond-form .foot .submit button').html('发表评论');
						} else {
							window.location.reload();
						}
					},
					error() {
						isSubmit = false;
						$('.joe_comment__respond-form .foot .submit button').html('发表评论');
						Qmsg.warning('发送失败！请刷新重试！');
					}
				});
			});
		}
	}

	/* 设置评论回复网址为新窗口打开 */
	{
		$('.comment-list__item .term .content .user .author a').each((index, item) => $(item).attr('target', '_blank'));
	}

	/* 格式化评论分页的hash值 */
	{
		$('.joe_comment .joe_pagination a').each((index, item) => {
			const href = $(item).attr('href');
			if (href && href.includes('#')) {
				$(item).attr('href', href.replace('#comments', '?scroll=joe_comment'));
			}
		});
	}

	/* 切换标签显示不同的标题 */
	{
		if (Joe.DOCUMENT_TITLE) {
			const TITLE = document.title;
			document.addEventListener('visibilitychange', () => {
				if (document.visibilityState === 'hidden') {
					document.title = Joe.DOCUMENT_TITLE;
				} else {
					document.title = TITLE;
				}
			});
		}
	}

	/* 小屏幕伸缩侧边栏 */
	{
		$('.joe_header__above-slideicon').on('click', function () {
			/* 关闭搜索框 */
			$('.joe_header__searchout').removeClass('active');
			/* 处理开启关闭状态 */
			if ($('.joe_header__slideout').hasClass('active')) {
				$('.joe_header__mask').removeClass('active slideout');
				$('.joe_header__slideout').removeClass('active');
			} else {
				$('.joe_header__mask').addClass('active slideout');
				$('.joe_header__slideout').addClass('active');
			}
		});
	}

	/* 消息弹窗 */
	{
		$('.joe_header__above-noticeicon').on('click', function () {
			/* 关闭弹窗 */
			$('.joe_header__notice').removeClass('active');
			/* 处理开启关闭状态 */
			if ($('.joe_header__notice').hasClass('active')) {
				$('.joe_header__mask').removeClass('active slideout');
				$('.joe_header__notice').removeClass('active');
			} else {
				$('.joe_header__mask').addClass('active');
				$('.joe_header__notice').addClass('active');
			}
			$('.joe_header__notice-close svg').on('click', function () {
				if ($('.joe_header__notice').hasClass('active')) {
					$('.joe_header__mask').removeClass('active slideout');
					$('.joe_header__notice').removeClass('active');
				}
			});
		});
	}

	/* 小屏幕搜索框 */
	{
		$('.joe_header__above-searchicon').on('click', function () {
			/* 关闭侧边栏 */
			$('.joe_header__slideout').removeClass('active');
			/* 处理开启关闭状态 */
			if ($('.joe_header__searchout').hasClass('active')) {
				$('.joe_header__mask').removeClass('active slideout');
				$('.joe_header__searchout').removeClass('active');
			} else {
				$('.joe_header__mask').addClass('active');
				$('.joe_header__searchout').addClass('active');
			}
		});
	}

	/* 点击遮罩层关闭 */
	{
		$('.joe_header__mask').on('click', function () {
			$('.joe_header__mask').removeClass('active slideout');
			$('.joe_header__notice').removeClass('active');
			$('.joe_header__searchout').removeClass('active');
			$('.joe_header__slideout').removeClass('active');
		});
	}

	/* 移动端侧边栏菜单手风琴 */
	{
		$('.joe_header__slideout-menu .current').parents('.panel-body').show().siblings('.panel').addClass('in');
		$('.joe_header__slideout-menu .panel').on('click', function () {
			const panelBox = $(this).parent().parent();
			/* 清除全部内容 */
			panelBox.find('.panel').not($(this)).removeClass('in');
			panelBox.find('.panel-body').not($(this).siblings('.panel-body')).stop().hide('fast');
			/* 激活当前的内容 */
			$(this).toggleClass('in').siblings('.panel-body').stop().toggle('fast');
		});
	}

	/* 初始化网站运行时间 */
	{
		const getRunTime = () => {
			const birthDay = new Date(Joe.BIRTHDAY);
			const today = +new Date();
			const timePast = today - birthDay.getTime();
			let day = timePast / (1000 * 24 * 60 * 60);
			let dayPast = Math.floor(day);
			let hour = (day - dayPast) * 24;
			let hourPast = Math.floor(hour);
			let minute = (hour - hourPast) * 60;
			let minutePast = Math.floor(minute);
			let second = (minute - minutePast) * 60;
			let secondPast = Math.floor(second);
			day = String(dayPast).padStart(2, 0);
			hour = String(hourPast).padStart(2, 0);
			minute = String(minutePast).padStart(2, 0);
			second = String(secondPast).padStart(2, 0);
			$('.joe_run__day').html(day);
			$('.joe_run__hour').html(hour);
			$('.joe_run__minute').html(minute);
			$('.joe_run__second').html(second);
		};
		if (Joe.BIRTHDAY && /(\d{4})\/(\d{1,2})\/(\d{1,2}) (\d{1,2})\:(\d{1,2})\:(\d{1,2})/.test(Joe.BIRTHDAY)) {
			getRunTime();
			setInterval(getRunTime, 1000);
		}
	}

	/* 初始化表情功能 */
	{
		if ($('.joe_owo__contain').length && $('.joe_owo__target').length) {
			$.ajax({
				url: window.Joe.THEME_URL + 'assets/json/joe.owo.json?1',
				dataType: 'json',
				success(res) {
					let barStr = '';
					let scrollStr = '';
					for (let key in res) {
						const item = res[key];
						barStr += `<div class="item" data-type="${key}">${key}</div>`;
						scrollStr += `
                            <ul class="scroll" data-type="${key}">
								${item.map(_ => `<li class="item" data-text="${_.data}">${key === '颜文字' ? `${_.icon}` : `<img src="${window.Joe.THEME_URL + _.icon}" alt="${_.data}"/>`}</li>`).join('')}
                            </ul>
                        `;
					}
					$('.joe_owo__contain').html(`
                        <div class="seat"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-4-7h8a4 4 0 1 1-8 0zm0-2a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm8 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/></svg></div>
                        <div class="box">
                            ${scrollStr}
                            <div class="bar">${barStr}</div>
                        </div>
                    `);
					$(document).on('click', function () {
						$('.joe_owo__contain .box').stop().slideUp('fast');
					});
					$('.joe_owo__contain .seat').on('click', function (e) {
						e.stopPropagation();
						$(this).siblings('.box').stop().slideToggle('fast');
					});
					$('.joe_owo__contain .box .bar .item').on('click', function (e) {
						e.stopPropagation();
						$(this).addClass('active').siblings().removeClass('active');
						const scrollIndx = '.joe_owo__contain .box .scroll[data-type="' + $(this).attr('data-type') + '"]';
						$(scrollIndx).show().siblings('.scroll').hide();
					});
					$('.joe_owo__contain .scroll .item').on('click', function () {
						const text = $(this).attr('data-text');
						$('.joe_owo__target').insertContent(text);
					});
					$('.joe_owo__contain .box .bar .item').first().click();
				}
			});
		}
	}

	/* 座右铭 */
	{
		let motto = Joe.MOTTO;
		if (!motto) motto = '有钱终成眷属，没钱亲眼目睹';
		if (motto.includes('http')) {
			$.ajax({
				url: motto,
				dataType: 'text',
				success: res => $('.joe_motto').html(res)
			});
		} else {
			$('.joe_motto').html(motto);
		}
	}

	/* 头部滚动 */
	{
		let flag = true;
		const handleHeader = diffY => {
			if (window.pageYOffset >= $('.joe_header').height() && diffY <= 0) {
				if (flag) return;
				$('.joe_header,.joe_tabbar').addClass('active');
				$('.joe_menu .joe_header__above-nav,.joe_aside .joe_aside__item:last-child').css('top', $('.joe_header').height() + 15);
				flag = true;
			} else {
				if (!flag) return;
				$('.joe_header,.joe_tabbar').removeClass('active');
				$('.joe_menu .joe_header__above-nav,.joe_aside .joe_aside__item:last-child').css('top', $('.joe_header').height());
				flag = false;
			}
		};
		let Y = window.pageYOffset;
		handleHeader(Y);
		let _last = Date.now();
		document.addEventListener('scroll', () => {
			let _now = Date.now();
			if (_now - _last > 15) {
				handleHeader(Y - window.pageYOffset);
				Y = window.pageYOffset;
				if (Y >= $('.joe_header').height()) {
					$('.joe_header').addClass('active');
				} else {
					$('.joe_header').removeClass('active');
				}
			}
			_last = _now;
		});
	}

	/* 初始化归档 */
	{
		let page = 0;
		initFiling();
		function initFiling() {
			if ($('.joe_census__filing .button').html() === 'loading...') return;
			$.ajax({
				url: Joe.BASE_API,
				type: 'POST',
				dataType: 'json',
				data: {
					routeType: 'article_filing',
					page: ++page
				},
				success(res) {
					if (!res.length) {
						$('.joe_census__filing .item.load').remove();
						return Qmsg.warning('没有更多内容了');
					}
					let htmlStr = '';
					res.forEach(item => {
						htmlStr += `
						<div class="item">
							<div class="tail"></div>
							<div class="head"></div>
							<div class="wrapper">
								<div class="panel">${item.date}（${item.count} 篇）<svg viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg"><path d="M21.6 772.8c28.8 28.8 74.4 28.8 103.2 0L512 385.6l387.2 387.2c28.8 28.8 74.4 28.8 103.2 0 28.8-28.8 28.8-74.4 0-103.2L615.2 282.4l-77.6-77.6c-14.4-14.4-37.6-14.4-51.2 0l-77.6 77.6L21.6 669.6c-28.8 28.8-28.8 75.2 0 103.2z" /></svg></div>
								<ol class="panel-body">
									${item.list.map(_ => `<li><a rel="noopener noreferrer" target="_blank" href="${_.permalink}">${_.title}</a></li>`).join('')}
								</ol>
							</div>
						</div>
					`;
					});
					$('#filing').append(htmlStr);
					$('#filing .item:first-child .panel').click();
					$('.joe_census__filing .button').html('加载更多');
				}
			});
		}
		$('.joe_census__filing .content').on('click', '.panel', function () {
			const panelBox = $(this).parents('.content');
			panelBox.find('.panel').not($(this)).removeClass('in');
			panelBox.find('.panel-body').not($(this).siblings('.panel-body')).stop().hide('fast');
			$(this).toggleClass('in').siblings('.panel-body').stop().toggle('fast');
		});
		$('.joe_census__filing .button').on('click', function () {
			initFiling();
			$(this).html('loading...');
		});
	}

	/* 动态发表 */
	{
		if ($('.joe_cross').length) {
			let isSubmit = false;
			$('.joe_cross__respond-form').on('submit', function (e) {
				e.preventDefault();
				const action = $('.joe_cross__respond-form').attr('action') + '?time=' + +new Date();
				const type = $('.joe_cross__respond-form').attr('data-type');
				const parent = $('.joe_cross__respond-form').attr('data-coid');
				const author = $(".joe_cross__respond-form .head input[name='author']").val();
				const _ = $(".joe_cross__respond-form input[name='_']").val();
				const mail = $(".joe_cross__respond-form .head input[name='mail']").val();
				const url = $(".joe_cross__respond-form .head input[name='url']").val();
				let text = $(".joe_cross__respond-form .body textarea[name='text']").val();
				if (type === 'text' && text.trim() === '') return Qmsg.info('别急，说一句呗~');
				if ($('#author').length) {
					if (author.trim() === '') return $('#author').focus();
				}
				if ($('#mail').length) {
					if (!/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/.test(mail)) return $('#mail').focus();
				}
				if (isSubmit) return;
				isSubmit = true;
				$('.joe_cross__respond-form .foot .submit button').html('发表中...');
				$.ajax({
					url: action,
					type: 'POST',
					data: { author, mail, text, parent, url, _ },
					dataType: 'text',
					success(res) {
						let arr = [],
							str = '';
						arr = $(res).contents();
						Array.from(arr).forEach(_ => {
							if (_.parentNode.className === 'container') str = _;
						});
						if (!/Joe/.test(res)) {
							Qmsg.warning(str.textContent.trim() || '');
							isSubmit = false;
							$('.joe_cross__respond-form .foot .submit button').html('确定');
						} else {
							window.location.reload();
						}
					},
					error() {
						isSubmit = false;
						$('.joe_cross__respond-form .foot .submit button').html('确定');
						Qmsg.error('失败了，刷新重试~');
					}
				});
			});
		}
		$('.joe_cross .content img:not(img.owo_image),.joe_list__item.chat .content-full img:not(img.owo_image)').each(function () {
			$(this).wrap($(`<span style="display: block;cursor: pointer;" data-fancybox="Word" href="${$(this).attr('src')}"></span>`));
		});
	}

	/* 动态回复 */
	{
		if ($('.joe_cross__respond').length) {
			const respond = $('.joe_cross__respond');
			/* 回复 */
			$('.joe_cross__reply').on('click', function () {
				const coid = $(this).attr('data-coid');
				const item = $('#' + $(this).attr('data-id'));
				respond.show();
				respond.find('.joe_cross__respond-form').attr('data-coid', coid);
				item.append(respond);
				$(".joe_cross__respond-type .item[data-type='text']").click();
				$('#textarea').focus();
				$('.joe_cross__cancle').show();
				window.scrollTo({
					top: item.offset().top - $('.joe_header').height() - 15,
					behavior: 'smooth'
				});
			});
			/* 取消回复 */
			$('.joe_cross__cancle').on('click', function () {
				if ($('.joe_cross__respond-form .head').length) {
					respond.hide();
				}
				respond.find('.joe_cross__respond-form').removeAttr('data-coid');
				$('.joe_cross__cancle').hide();
				$('.joe_cross__title').after(respond);
				$(".joe_cross__respond-type .item[data-type='text']").click();
				window.scrollTo({
					top: $('.joe_cross').offset().top - $('.joe_header').height() - 15,
					behavior: 'smooth'
				});
			});
		}
	}

	/* 动态回复网址为新窗口打开 */
	{
		$('.comment-list__item .term .content .user .author a').each((index, item) => $(item).attr('target', '_blank'));
	}

	/* 动态评论展开 */
	{
		$('.joe_cross__panel-header').click(function () {
			$(this).hide();
			$(this).next('.joe_cross__panel-body').slideToggle();
			$(this).parent('.joe_cross__panel').siblings().find('.joe_cross__panel-body').slideUp();
		});
	}

	/* 格式化分页的hash值 */
	{
		$('.joe_cross .joe_pagination a').each((index, item) => {
			const href = $(item).attr('href');
			if (href && href.includes('#')) {
				$(item).attr('href', href.replace('#comments', '?scroll=joe_cross'));
			}
		});
	}

	/* 动态点赞 */
	{
		$('.support').on('click', function () {
			$.ajax({
				url: `/?action=support`,
				type: 'POST',
				data: {
					coid: $(this).data('coid')
				},
				dataType: 'json',
				success: res => {
					if (res.success) {
						$(this).removeClass('zm zm-unlike').addClass('zm zm-like');
						$(this).text(res.count);
						Qmsg.success('谢谢你支持~');
					} else {
						Qmsg.info('明天再支持~');
					}
				}
			});
		});
	}

	/* 登录 */
	{
		$(".joe_header__above-sign button[type='button']").on('click', function (e) {
			if ($(".joe_header__above-sign input[name='name']").val().trim() === '') {
				$(".joe_header__above-sign input[name='name']").focus();
				return Qmsg.warning('请输入昵称');
			}
			if ($(".joe_header__above-sign input[name='password']").val().trim() === '') {
				$(".joe_header__above-sign input[name='password']").focus();
				return Qmsg.warning('请输入密码');
			}
			$(this).html('登录中...').attr('disabled', true);
			$('.joe_header__above-sign form').submit();
		});

		$('.joe_header__above-sign form').keydown(function () {
			var e = window.event;
			if (e && e.keyCode == 13) {
				if ($(".joe_header__above-sign input[name='name']").val().trim() === '') {
					$(".joe_header__above-sign input[name='name']").focus();
					return Qmsg.warning('请输入昵称');
				}
				if ($(".joe_header__above-sign input[name='password']").val().trim() === '') {
					$(".joe_header__above-sign input[name='password']").focus();
					return Qmsg.warning('请输入密码');
				}
				$(this).submit();
			}
		});

		$("#loginForm button[type='button']").on('click', function (e) {
			if ($("#loginForm input[name='name']").val().trim() === '') {
				return Qmsg.warning('请输入昵称');
			}
			if ($("#loginForm input[name='password']").val().trim() === '') {
				return Qmsg.warning('请输入密码');
			}
			$(this).html('登录中...').attr('disabled', true);
			$('#loginForm').submit();
		});
	}

	/* 私密评论 */
	{
		$('.privacy').on('click', function () {
			if ($('.lock').css('opacity') == 0) {
				$('#textarea').val('私语# ').focus();
				$('.body').addClass('active');
				$('.lock').addClass('active');
				$('.unlock').removeClass('active');
			} else {
				$('#textarea').val('');
				$('.body').removeClass('active');
				$('.lock').removeClass('active');
				$('.unlock').addClass('active');
			}
		});
	}

	/* 闲聊文章展开收起 */
	{
		$('.joe_list').on('click', '.content-more', function (event) {
			event.preventDefault();
			var $content = $(this).parent('.content');
			$content.find('.content-full').slideToggle();
			$content.find('.abstract').toggle();
			$(this).text(function (i, text) {
				return text === '全文' ? '收起' : '全文';
			});
		});
	}

	/* tabbar高亮显示当前 */
	{
		var current = window.location.href;
		$('.joe_tabbar__item a').each(function () {
			if ($(this).attr('href') == current) {
				$(this).addClass('active');
			}
		});
	}
});
