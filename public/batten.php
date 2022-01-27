<h1 class="joe_detail__title"><?php $this->title() ?>
</h1>
<div class="joe_detail__count">
    <div class="joe_detail__count-information">
        <div class="meta">
            <div class="item">
                <span class="text"><?php $this->date('Y-m-d'); ?></span>
                <span class="line"></span>
                <span class="text" id="Joe_Article_Views"><?php _getViews($this); ?> 阅读</span>
                <span class="text">
                    <div class="stretch" title="宽屏阅读">
                        <svg class="icon1" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                            <path d="M896 853.333333H128v-85.333333h768v85.333333z m42.666667-490.666666l-196.096 196.096-60.330667-60.330667L818.005333 362.666667 682.24 226.901333l60.330667-60.330666L938.666667 362.666667zM512 554.666667H128v-85.333334h384v85.333334z m0-298.666667H128V170.666667h384v85.333333z"></path>
                        </svg>
                        <svg class="icon2" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                            <path d="M896 853.333333H128v-85.333333h768v85.333333zM341.76 226.901333L205.994667 362.666667l135.765333 135.765333-60.330667 60.330667L85.333333 362.666667l196.096-196.096L341.76 226.901333zM896 554.666667h-384v-85.333334h384v85.333334z m0-298.666667h-384V170.666667h384v85.333333z"></path>
                        </svg>
                    </div>
                </span>
            </div>
        </div>
    </div>
    <?php if ($this->user->uid == $this->authorId) : ?>
        <time class="joe_detail__count-created">
            <?php if ($this->is('post')) : ?>
                <a target="_blank" rel="noopener noreferrer" href="<?php $this->options->adminUrl(); ?>write-post.php?cid=<?php echo $this->cid; ?>">
                    <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" width="16" height="16">
                        <path d="M810.667 810.667c1.046 0 0 0.93 0 4.74v-4.74z m0 0V524.463c0-23.564 19.102-42.667 42.666-42.667 23.564 0 42.667 19.103 42.667 42.667v290.944C896 861.11 856.749 896 810.667 896H213.333C167.251 896 128 861.11 128 815.407V208.593C128 162.89 167.251 128 213.333 128h390.084c23.564 0 42.666 19.103 42.666 42.667s-19.102 42.666-42.666 42.666H213.333v597.334h597.334z m-597.334 0v4.74c0-3.81-1.046-4.74 0-4.74z m0-602.074v4.74c-1.046 0 0-0.93 0-4.74zM542.17 584.837c-16.662 16.662-43.678 16.662-60.34 0-16.662-16.663-16.662-43.678 0-60.34l341.333-341.334c16.663-16.662 43.678-16.662 60.34 0 16.663 16.663 16.663 43.678 0 60.34L542.17 584.837z" p-id="2402" fill="#888888"></path>
                    </svg>
                </a>
            <?php else : ?>
                <a target="_blank" rel="noopener noreferrer" href="<?php $this->options->adminUrl(); ?>write-page.php?cid=<?php echo $this->cid; ?>">
                    <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" width="16" height="16">
                        <path d="M810.667 810.667c1.046 0 0 0.93 0 4.74v-4.74z m0 0V524.463c0-23.564 19.102-42.667 42.666-42.667 23.564 0 42.667 19.103 42.667 42.667v290.944C896 861.11 856.749 896 810.667 896H213.333C167.251 896 128 861.11 128 815.407V208.593C128 162.89 167.251 128 213.333 128h390.084c23.564 0 42.666 19.103 42.666 42.667s-19.102 42.666-42.666 42.666H213.333v597.334h597.334z m-597.334 0v4.74c0-3.81-1.046-4.74 0-4.74z m0-602.074v4.74c-1.046 0 0-0.93 0-4.74zM542.17 584.837c-16.662 16.662-43.678 16.662-60.34 0-16.662-16.663-16.662-43.678 0-60.34l341.333-341.334c16.663-16.662 43.678-16.662 60.34 0 16.663 16.663 16.663 43.678 0 60.34L542.17 584.837z" p-id="2402" fill="#888888"></path>
                    </svg>
                </a>
            <?php endif; ?>
        </time>
    <?php endif; ?>
</div>