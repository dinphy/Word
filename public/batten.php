<?php if ($this->is('index')) :  ?>
    <div class="joe_batten joe_batten-index">
        <img width="100%" height="100%" class="image lazyload" src="https://pic.imgdb.cn/item/620e24df2ab3f51d9132481f.png" data-src="<?php $this->options->JIndex_Top_Image() ?>" />
        <div class="information motto">
            <div class="title"><?php $this->options->title() ?></div>
            <div class="desctitle">
                <p class="joe_motto"></p>
            </div>
        </div>
    </div>
<?php elseif ($this->is('category')) :  ?>
    <div class="joe_batten">
        <img width="100%" height="100%" class="lazyload" src="<?php _getLazyload() ?>" data-src="<?php $this->options->JWallpaper_Batten() ?>" />
        <div class="information">
            <div class="title"><?php echo $this->category(',', false); ?></div>
            <div class="desctitle">共 <?php echo $this->getTotal(); ?> 篇</div>
        </div>
    </div>
<?php elseif ($this->is('search')) :  ?>
    <div class="joe_batten">
        <img width="100%" height="100%" class="lazyload" src="<?php _getLazyload() ?>" data-src="<?php $this->options->JWallpaper_Batten() ?>" />
        <div class="information">
            <div class="title">找到「<?php echo $this->keywords; ?>」的结果</div>
            <div class="desctitle">共 <?php echo $this->getTotal(); ?> 条</div>
        </div>
    </div>
<?php elseif ($this->is('post')) :  ?>
    <div class="joe_batten">
        <img width="100%" height="100%" class="lazyload" src="<?php _getLazyload() ?>" data-src="<?php $this->options->JWallpaper_Batten() ?>" alt="<?php $this->title() ?>" />
        <div class="information">
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
        <div class="information">
            <div class="title"><?php $this->title() ?></div>
            <div class="desctitle">
                <?php $this->fields->desctitle ? $this->fields->desctitle() : $this->options->description(); ?>
            </div>
        </div>
    </div>
<?php endif; ?>