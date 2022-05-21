<?php if ($this->is('index')) :  ?>
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
    <?php if (!_isMobile() && sizeof($carousel) > 0 || sizeof($recommend) === 2) : ?>
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
    <?php else : ?>
        <div class="joe_batten">
            <img width="100%" height="100%" class="image lazyload" style="border-radius: var(--radius-wrap);" src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQIARgBGAAD/2wBDAAYEBQYFBAYGBQYHBwYIChAKCgkJChQODwwQFxQYGBcUFhYaHSUfGhsjHBYWICwgIyYnKSopGR8tMC0oMCUoKSj/2wBDAQcHBwoIChMKChMoGhYaKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCj/wAARCAFAAoADASIAAhEBAxEB/90ABAAo/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREAAgECBAQDBAcFBAQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAVYnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPExcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwD6oooooAKKKKACmIzHO4YweKfRQAUUUUAFFFFAC0UUUAFFFFABRRRQAUUUUAFFFFABRRRQAUUUUAJRRRQAtFFFABRRRQAUUUZoATFGKNwpC4oAdRUfmUhlPagCWiohKe9OEimgB9FGaKAEooooAWiiigAooooASiiigBaKKKACiiigAooooAKKKKAEooooAWiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooA/9D6nyKWs2S6AHymktr358MeKBJmnRUcc0chwrVJQMWiiigAooooASiiigAooooAKKKKACiiigAJxTd/HSlcZpgFABvNL5lLtFJtNACiQd6XeD0pmz2oCYNAEoooHSigBKKKKAFooooAKaWx2p1IRQAA5pjU8UhGaAIc0Zp+2k20AMopcUmKAEoFGKMUASBuKfuqHFLigCXdRuqLBowaAJw2aWoBkU9WNAD6KSigBaKKKAFooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooA/9H6C8yk31BmlBpkXLSSMvIOK1LS8VkAY81iKacpIOQcUBzHTK4YcGnVgwXToeTmrkF783OSKTRRp0VDFcLIcdDU2aBhRRRQAUUUUAFFFFABRRRQAUmKWigAooooAMUUUUAJRRRQAUUUUAFFFFABRRRQAUUUUAFFFFADNtG2n0UARbKNlP3UbqAG7fal207NGaAE20bR6U/NGaAGbR6UoUCnZozQA3FAp2KMUAAooooAKKKKACiiigAooooASiiigAooooAWiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooA//0veBTh0pgpwNUzMkFPqlLeRxMQck+wzVc6k2ThBikBripYzWfY3iT8H5WH5VojGOCDQMlRjnircN0y8NyKy7mQxxErw3rVGOeXPMjGgdzqxcpjNOSdGOM1zcczEfeqaOV1Od1AHSA56UVlW192fpWlGwdcg5FIdx1FIzBFLMcAd6zf7d0vGft8GN5j++PvDtQK5p0hYL1NQi8tyoYTw7T0O8c15v4m1q61C9eKJ2W2jJCFAU3cYPPfkU0gudtceI9Kt5mhlvEDqQpABPJOMDA5P0qlrviqHS7r7OsRmfaGOGwBn8K86t7co25SEYdD6GpJY0YNJMSzE5Zs9Sepp2E5WPS9B8R2mryyRQ70kT+FxyR61uA5rw9HmhZzavIhI27k9DXf8AgTUgLMWd5Mnn5JjXgbhyeP1osCkdlRSClqSwooooAKKKKACiiigAooooAKKKKAEooooAKKKaGzQAuKMUtFACYoxS0UAFFFFABRRRQAtFFIDmgBaKKKACiiigAoqKaVIYnkkbaijJPtXJ6n4uIcpYxjaP437/AEFZ1KsaavJm1GhUrO0EdjRXn8Xi++Vv3iRMvoARXXaTqK3yHjDr1BqYV4T+FmtbBVaK5pLQ0aKKK2OQKKyry4vrMF/sq3cW4f6o7XRc/wB053Y9j+FX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" data-src="<?php $this->options->JIndex_Top_Image() ?>" />
            <div class="infomation">
                <div class="title">
                    <div class="sitelogo joe_header__above-logo">
                        <img class="lazyload" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php $this->options->JLogo() ?>" alt="<?php $this->options->title(); ?>" />
                        <svg class="profile-color-modes" height="45" viewBox="0 0 106 60" fill="none" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
                            <g class="profile-color-modes-illu-group profile-color-modes-illu-red">
                                <path d="M37.5 58.5V57.5C37.5 49.768 43.768 43.5 51.5 43.5V43.5C59.232 43.5 65.5 49.768 65.5 57.5V58.5"></path>
                            </g>
                            <g class="profile-color-modes-illu-group profile-color-modes-illu-orange">
                                <path d="M104.07 58.5C103.401 55.092 97.7635 54.3869 95.5375 57.489C97.4039 54.6411 99.7685 48.8845 94.6889 46.6592C89.4817 44.378 86.1428 50.1604 85.3786 54.1158C85.9519 50.4768 83.7226 43.294 78.219 44.6737C72.7154 46.0534 72.7793 51.3754 74.4992 55.489C74.169 54.7601 72.4917 53.3567 70.5 52.8196"></path>
                            </g>
                            <g class="profile-color-modes-illu-group profile-color-modes-illu-purple">
                                <path d="M5.51109 58.5V52.5C5.51109 41.4543 14.4654 32.5 25.5111 32.5C31.4845 32.5 36.8464 35.1188 40.5111 39.2709C40.7212 39.5089 40.9258 39.7521 41.1245 40"></path>
                                <path d="M27.511 49.5C29.6777 49.5 28.911 49.5 32.511 49.5"></path>
                                <path d="M27.511 56.5C29.6776 56.5 26.911 56.5 30.511 56.5"></path>
                            </g>
                            <g class="profile-color-modes-illu-group profile-color-modes-illu-green">
                                <circle cx="5.5" cy="12.5" r="4"></circle>
                                <circle cx="18.5" cy="5.5" r="4"></circle>
                                <path d="M18.5 9.5L18.5 27.5"></path>
                                <path d="M18.5 23.5C6 23.5 5.5 23.6064 5.5 16.5"></path>
                            </g>
                            <g class="profile-color-modes-illu-group profile-color-modes-illu-blue">
                                <g class="profile-color-modes-illu-frame">
                                    <path d="M40.6983 31.5C40.5387 29.6246 40.6456 28.0199 41.1762 27.2317C42.9939 24.5312 49.7417 26.6027 52.5428 30.2409C54.2551 29.8552 56.0796 29.6619 57.9731 29.6619C59.8169 29.6619 61.5953 29.8452 63.2682 30.211C66.0833 26.5913 72.799 24.5386 74.6117 27.2317C75.6839 28.8246 75.0259 33.7525 73.9345 37.5094C74.2013 37.9848 74.4422 38.4817 74.6555 39"></path>
                                </g>
                                <g class="profile-color-modes-illu-frame">
                                    <path d="M41.508 31.5C41.6336 31.2259 41.7672 30.9582 41.9085 30.6968C40.7845 26.9182 40.086 21.8512 41.1762 20.2317C42.9939 17.5312 49.7417 19.6027 52.5428 23.2409C54.2551 22.8552 56.0796 22.6619 57.9731 22.6619C59.8169 22.6619 61.5953 22.8452 63.2682 23.211C66.0833 19.5913 72.799 17.5386 74.6117 20.2317C75.6839 21.8246 75.0259 26.7525 73.9345 30.5094C75.1352 32.6488 75.811 35.2229 75.811 38.2283C75.811 38.49 75.8058 38.7472 75.7957 39"></path>
                                    <path d="M49.4996 33V35.6757"></path>
                                    <path d="M67.3375 33V35.6757"></path>
                                </g>
                                <g class="profile-color-modes-illu-frame">
                                    <path d="M41.508 31.5C41.6336 31.2259 41.7672 30.9582 41.9085 30.6968C40.7845 26.9182 40.086 21.8512 41.1762 20.2317C42.9939 17.5312 49.7417 19.6027 52.5428 23.2409C54.2551 22.8552 56.0796 22.6619 57.9731 22.6619C59.8169 22.6619 61.5953 22.8452 63.2682 23.211C66.0833 19.5913 72.799 17.5386 74.6117 20.2317C75.6839 21.8246 75.0259 26.7525 73.9345 30.5094C75.1352 32.6488 75.811 35.2229 75.811 38.2283C75.811 38.49 75.8058 38.7472 75.7957 39"></path>
                                </g>
                                <g class="profile-color-modes-illu-frame">
                                    <path d="M41.508 31.5C41.6336 31.2259 41.7672 30.9582 41.9085 30.6968C40.7845 26.9182 40.086 21.8512 41.1762 20.2317C42.9939 17.5312 49.7417 19.6027 52.5428 23.2409C54.2551 22.8552 56.0796 22.6619 57.9731 22.6619C59.8169 22.6619 61.5953 22.8452 63.2682 23.211C66.0833 19.5913 72.799 17.5386 74.6117 20.2317C75.6839 21.8246 75.0259 26.7525 73.9345 30.5094C75.1352 32.6488 75.811 35.2229 75.811 38.2283C75.811 38.49 75.8058 38.7472 75.7957 39"></path>
                                    <path d="M49.4996 33V35.6757"></path>
                                    <path d="M67.3375 33V35.6757"></path>
                                </g>
                                <g class="profile-color-modes-illu-frame">
                                    <path d="M41.508 31.5C41.6336 31.2259 41.7672 30.9582 41.9085 30.6968C40.7845 26.9182 40.086 21.8512 41.1762 20.2317C42.9939 17.5312 49.7417 19.6027 52.5428 23.2409C54.2551 22.8552 56.0796 22.6619 57.9731 22.6619C59.8169 22.6619 61.5953 22.8452 63.2682 23.211C66.0833 19.5913 72.799 17.5386 74.6117 20.2317C75.6839 21.8246 75.0259 26.7525 73.9345 30.5094C75.1352 32.6488 75.811 35.2229 75.811 38.2283C75.811 38.49 75.8058 38.7472 75.7957 39"></path>
                                </g>
                                <g class="profile-color-modes-illu-frame">
                                    <path d="M41.508 31.5C41.6336 31.2259 41.7672 30.9582 41.9085 30.6968C40.7845 26.9182 40.086 21.8512 41.1762 20.2317C42.9939 17.5312 49.7417 19.6027 52.5428 23.2409C54.2551 22.8552 56.0796 22.6619 57.9731 22.6619C59.8169 22.6619 61.5953 22.8452 63.2682 23.211C66.0833 19.5913 72.799 17.5386 74.6117 20.2317C75.6839 21.8246 75.0259 26.7525 73.9345 30.5094C75.1352 32.6488 75.811 35.2229 75.811 38.2283C75.811 38.49 75.8058 38.7472 75.7957 39"></path>
                                    <path d="M49.4996 33V35.6757"></path>
                                    <path d="M67.3375 33V35.6757"></path>
                                </g>
                                <g class="profile-color-modes-illu-frame">
                                    <path d="M73.4999 40.2236C74.9709 38.2049 75.8108 35.5791 75.8108 32.2283C75.8108 29.2229 75.1351 26.6488 73.9344 24.5094C75.0258 20.7525 75.6838 15.8246 74.6116 14.2317C72.7989 11.5386 66.0832 13.5913 63.2681 17.211C61.5952 16.8452 59.8167 16.6619 57.973 16.6619C56.0795 16.6619 54.2549 16.8552 52.5427 17.2409C49.7416 13.6027 42.9938 11.5312 41.176 14.2317C40.0859 15.8512 40.7843 20.9182 41.9084 24.6968C41.003 26.3716 40.4146 28.3065 40.2129 30.5"></path>
                                    <path d="M82.9458 30.5471L76.8413 31.657"></path>
                                    <path d="M76.2867 34.4319L81.8362 37.7616"></path>
                                    <path d="M49.4995 27.8242V30.4999"></path>
                                    <path d="M67.3374 27.8242V30.4998"></path>
                                </g>
                                <g class="profile-color-modes-illu-frame">
                                    <path d="M45.3697 34.2658C41.8877 32.1376 39.7113 28.6222 39.7113 23.2283C39.7113 20.3101 40.3483 17.7986 41.4845 15.6968C40.3605 11.9182 39.662 6.85125 40.7522 5.23168C42.5699 2.53117 49.3177 4.6027 52.1188 8.24095C53.831 7.85521 55.6556 7.66186 57.5491 7.66186C59.3929 7.66186 61.1713 7.84519 62.8442 8.21095C65.6593 4.59134 72.375 2.5386 74.1877 5.23168C75.2599 6.82461 74.6019 11.7525 73.5105 15.5094C74.7112 17.6488 75.3869 20.2229 75.3869 23.2283C75.3869 28.6222 73.2105 32.1376 69.7285 34.2658C70.8603 35.5363 72.6057 38.3556 73.3076 40"></path>
                                    <path d="M49.0747 19.8242V22.4999"></path>
                                    <path d="M54.0991 28C54.6651 29.0893 55.7863 30.0812 57.9929 30.0812C59.0642 30.0812 59.8797 29.8461 60.5 29.4788"></path>
                                    <path d="M66.9126 19.8242V22.4999"></path>
                                    <path d="M33.2533 20.0237L39.0723 22.1767"></path>
                                    <path d="M39.1369 25.0058L33.0935 27.3212"></path>
                                    <path d="M81.8442 19.022L76.0252 21.1751"></path>
                                    <path d="M75.961 24.0041L82.0045 26.3196"></path>
                                </g>
                                <g class="profile-color-modes-illu-frame">
                                    <path d="M73.4999 40.2236C74.9709 38.2049 75.8108 35.5791 75.8108 32.2283C75.8108 29.2229 75.1351 26.6488 73.9344 24.5094C75.0258 20.7525 75.6838 15.8246 74.6116 14.2317C72.7989 11.5386 66.0832 13.5913 63.2681 17.211C61.5952 16.8452 59.8167 16.6619 57.973 16.6619C56.0795 16.6619 54.2549 16.8552 52.5427 17.2409C49.7416 13.6027 42.9938 11.5312 41.176 14.2317C40.0859 15.8512 40.7843 20.9182 41.9084 24.6968C41.003 26.3716 40.4146 28.3065 40.2129 30.5"></path>
                                    <path d="M82.9458 30.5471L76.8413 31.657"></path>
                                    <path d="M76.2867 34.4319L81.8362 37.7616"></path>
                                    <path d="M49.4995 27.8242V30.4999"></path>
                                    <path d="M67.3374 27.8242V30.4998"></path>
                                </g>
                                <g class="profile-color-modes-illu-frame">
                                    <path d="M40.6983 31.5C40.5387 29.6246 40.6456 28.0199 41.1762 27.2317C42.9939 24.5312 49.7417 26.6027 52.5428 30.2409C54.2551 29.8552 56.0796 29.6619 57.9731 29.6619C59.8169 29.6619 61.5953 29.8452 63.2682 30.211C66.0833 26.5913 72.799 24.5386 74.6117 27.2317C75.6839 28.8246 75.0259 33.7525 73.9345 37.5094C74.2013 37.9848 74.4422 38.4817 74.6555 39"></path>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <div class="sitename">
                        <?php $this->options->title() ?>
                    </div>
                </div>
                <div class="desctitle" id="hitokoto" style="font-size: 1rem;">
                    <span id="hitokoto_text"><?php $this->options->description() ?></span>
                    <script>
                        fetch('https://v1.hitokoto.cn/?c=d')
                            .then(response => response.json())
                            .then(data => {
                                const hitokoto = document.getElementById('hitokoto_text')
                                hitokoto.href = 'https://hitokoto.cn/?uuid=' + data.uuid
                                hitokoto.innerText = data.hitokoto
                            })
                            .catch(console.error)
                    </script>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php elseif ($this->is('category')) :  ?>
    <div class="joe_batten">
        <img width="100%" height="100%" class="lazyload" src="<?php _getLazyload() ?>" data-src="<?php $this->options->JWallpaper_Batten() ?>" />
        <div class="infomation">
            <div class="title"><?php echo $this->category(',', false); ?></div>
            <div class="desctitle">共 <?php echo $this->getTotal(); ?> 篇</div>
        </div>
    </div>
<?php elseif ($this->is('search')) :  ?>
    <div class="joe_batten">
        <img width="100%" height="100%" class="lazyload" src="<?php _getLazyload() ?>" data-src="<?php $this->options->JWallpaper_Batten() ?>" />
        <div class="infomation">
            <div class="title">与「<?php echo $this->keywords; ?>」相关的结果</div>
            <div class="desctitle">共 <?php echo $this->getTotal(); ?> 条</div>
        </div>
    </div>
<?php elseif ($this->is('post')) :  ?>
    <div class="joe_batten">
        <img width="100%" height="100%" class="lazyload" src="<?php _getLazyload() ?>" data-src="<?php $this->options->JWallpaper_Batten() ?>" alt="<?php $this->title() ?>" />
        <div class="infomation">
            <div class="title"><?php $this->title() ?></div>
            <div class="desctitle">
                <span class="text"><?php $this->dateWord(); ?></span>
                <span class="line"></span>
                <span class="text" id="Joe_Article_Views"><?php _getViews($this); ?> 阅读</span>
                <?php if ($this->user->hasLogin()) : ?>
                    <span class="line"></span>
                    <span class="text">
                        <?php if ($this->user->uid == $this->authorId) : ?>
                            <?php if ($this->is('post')) : ?>
                                <a target="_blank" rel="noopener noreferrer" href="<?php $this->options->adminUrl(); ?>write-post.php?cid=<?php echo $this->cid; ?>">
                                    <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" width="16" height="16">
                                        <path d="M810.667 810.667c1.046 0 0 0.93 0 4.74v-4.74z m0 0V524.463c0-23.564 19.102-42.667 42.666-42.667 23.564 0 42.667 19.103 42.667 42.667v290.944C896 861.11 856.749 896 810.667 896H213.333C167.251 896 128 861.11 128 815.407V208.593C128 162.89 167.251 128 213.333 128h390.084c23.564 0 42.666 19.103 42.666 42.667s-19.102 42.666-42.666 42.666H213.333v597.334h597.334z m-597.334 0v4.74c0-3.81-1.046-4.74 0-4.74z m0-602.074v4.74c-1.046 0 0-0.93 0-4.74zM542.17 584.837c-16.662 16.662-43.678 16.662-60.34 0-16.662-16.663-16.662-43.678 0-60.34l341.333-341.334c16.663-16.662 43.678-16.662 60.34 0 16.663 16.663 16.663 43.678 0 60.34L542.17 584.837z" p-id="2402" fill="#f3f3f3"></path>
                                    </svg>
                                </a>
                            <?php else : ?>
                                <a target="_blank" rel="noopener noreferrer" href="<?php $this->options->adminUrl(); ?>write-page.php?cid=<?php echo $this->cid; ?>">
                                    <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" width="16" height="16">
                                        <path d="M810.667 810.667c1.046 0 0 0.93 0 4.74v-4.74z m0 0V524.463c0-23.564 19.102-42.667 42.666-42.667 23.564 0 42.667 19.103 42.667 42.667v290.944C896 861.11 856.749 896 810.667 896H213.333C167.251 896 128 861.11 128 815.407V208.593C128 162.89 167.251 128 213.333 128h390.084c23.564 0 42.666 19.103 42.666 42.667s-19.102 42.666-42.666 42.666H213.333v597.334h597.334z m-597.334 0v4.74c0-3.81-1.046-4.74 0-4.74z m0-602.074v4.74c-1.046 0 0-0.93 0-4.74zM542.17 584.837c-16.662 16.662-43.678 16.662-60.34 0-16.662-16.663-16.662-43.678 0-60.34l341.333-341.334c16.663-16.662 43.678-16.662 60.34 0 16.663 16.663 16.663 43.678 0 60.34L542.17 584.837z" p-id="2402" fill="#f3f3f3"></path>
                                    </svg>
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </span>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="joe_batten">
        <img width="100%" height="100%" class="lazyload" src="<?php _getLazyload() ?>" data-src="<?php $this->options->JWallpaper_Batten() ?>" alt="<?php $this->title() ?>" />
        <div class="infomation">
            <div class="title"><?php $this->title() ?></div>
            <div class="desctitle">
                <?php $this->fields->desctitle ? $this->fields->desctitle() : $this->options->description(); ?>
            </div>
        </div>
    </div>
<?php endif; ?>