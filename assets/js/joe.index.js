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
											<a class="like like-handle ${likeArr.includes(_.cid) ? 'active' : ''}" data-cid="${_.cid}" href="javascript:;">
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
										<a class="like like-handle ${likeArr.includes(_.cid) ? 'active' : ''}" data-cid="${_.cid}" href="javascript:;">
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
										<a class="like like-handle ${likeArr.includes(_.cid) ? 'active' : ''}" data-cid="${_.cid}" href="javascript:;">
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
                                <div class="title"><a href="${_.permalink}" target="_blank" rel="noopener noreferrer">${_.title}</a></div>
                                <div class="time">${_.created}</div>
                            </div>
                        </div>
                        <a href="${_.permalink}" target="_blank" rel="noopener noreferrer">
                            <div class="content">
                                <div class="abstract">
                                    ${_.abstract}
                                </div>
                            </div>
                        </a>
                        <div class="meta">
							<ul class="items">
								<li>${_.views} 人围观</li>
							</ul>
							<ul class="items">
								<li class="like">
									<a class="like like-handle ${likeArr.includes(_.cid) ? 'active' : ''}" data-cid="${_.cid}" href="javascript:;">
										<span class="like-status">${likeArr.includes(_.cid) ? '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"><path fill="none" d="M0 0h24v24H0z"/><path d="M2 9h3v12H2a1 1 0 0 1-1-1V10a1 1 0 0 1 1-1zm5.293-1.293l6.4-6.4a.5.5 0 0 1 .654-.047l.853.64a1.5 1.5 0 0 1 .553 1.57L14.6 8H21a2 2 0 0 1 2 2v2.104a2 2 0 0 1-.15.762l-3.095 7.515a1 1 0 0 1-.925.619H8a1 1 0 0 1-1-1V8.414a1 1 0 0 1 .293-.707z"/></svg>' : '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"><path fill="none" d="M0 0h24v24H0z"/><path d="M14.6 8H21a2 2 0 0 1 2 2v2.104a2 2 0 0 1-.15.762l-3.095 7.515a1 1 0 0 1-.925.619H2a1 1 0 0 1-1-1V10a1 1 0 0 1 1-1h3.482a1 1 0 0 0 .817-.423L11.752.85a.5.5 0 0 1 .632-.159l1.814.907a2.5 2.5 0 0 1 1.305 2.853L14.6 8zM7 10.588V19h11.16L21 12.104V10h-6.4a2 2 0 0 1-1.938-2.493l.903-3.548a.5.5 0 0 0-.261-.571l-.661-.33-4.71 6.672c-.25.354-.57.644-.933.858zM5 11H3v8h2v-8z"/></svg>'}</span>
										<span class="like-num">${_.agree}</span>
									</a>
								</li>
							</ul>
							<ul class="items">
								<li>
									<a href="${_.permalink}#comments">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16"><path fill="none" d="M0 0h24v24H0z"/><path d="M2 8.994A5.99 5.99 0 0 1 8 3h8c3.313 0 6 2.695 6 5.994V21H8c-3.313 0-6-2.695-6-5.994V8.994zM20 19V8.994A4.004 4.004 0 0 0 16 5H8a3.99 3.99 0 0 0-4 3.994v6.012A4.004 4.004 0 0 0 8 19h12zm-6-8h2v2h-2v-2zm-6 0h2v2H8v-2z"/></svg>
										${_.commentsNum}
									</a>
								</li>
							</ul>
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
											<a class="like like-handle ${likeArr.includes(_.cid) ? 'active' : ''}" data-cid="${_.cid}" href="javascript:;">
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
			activeLine.css({ left: activeItem.position().left, width: activeItem.width() });
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

		/* 激活文章列表赞功能 */
		$('.joe_list').on('click', '.like-handle', function () {
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

	/* 激活列表特效 */
	{
		const wow = $('.joe_index__list').attr('data-wow');
		if (wow !== 'off' && wow) new WOW({ boxClass: 'wow', animateClass: `animated ${wow}`, offset: 0, mobile: true, live: true, scrollContainer: null }).init();
	}
});
