<?php if (sizeof($this->categories) > 0 || $this->user->uid == $this->authorId) : ?>
    <div class="joe_detail__category">
        <?php if (sizeof($this->categories) > 0) : ?>
            <?php foreach (array_slice($this->categories, 0, 5) as $key => $item) : ?>
                <a href="<?php echo $item['permalink']; ?>" class="item item-<?php echo $key ?>" title="<?php echo $item['name']; ?>"><?php echo $item['name']; ?></a>
            <?php endforeach; ?>
        <?php endif; ?>
        <?php if ($this->user->uid == $this->authorId) : ?>
            <?php if ($this->is('post')) : ?>
                <a class="edit" target="_blank" rel="noopener noreferrer" href="<?php $this->options->adminUrl(); ?>write-post.php?cid=<?php echo $this->cid; ?>">编辑文章</a>
            <?php else : ?>
                <a class="edit" target="_blank" rel="noopener noreferrer" href="<?php $this->options->adminUrl(); ?>write-page.php?cid=<?php echo $this->cid; ?>">编辑页面</a>
            <?php endif; ?>
        <?php endif; ?>
    </div>
<?php endif; ?>

<h1 class="joe_detail__title"><?php $this->title() ?></h1>
<div class="joe_detail__count">
    <div class="joe_detail__count-information">
        <img width="35" height="35" class="avatar lazyload" src="<?php _getAvatarLazyload(); ?>" data-src="<?php _getAvatarByMail($this->author->mail) ?>" alt="<?php $this->author(); ?>" />
        <div class="meta">
            <div class="author">
                <a class="link" href="<?php $this->author->permalink(); ?>" title="<?php $this->author(); ?>"><?php $this->author(); ?></a>
            </div>
            <div class="item">
                <span class="text"><?php $this->date('Y-m-d'); ?></span>
                <span class="line">/</span>
                <span class="text"><?php $this->commentsNum('%d'); ?> 评论</span>
                <span class="line">/</span>
                <span class="text" id="Joe_Article_Views"><?php _getViews($this); ?> 阅读</span>
                <span class="line">/</span>
                <span class="text" id="Joe_Baidu_Record">正在检测是否收录...</span>
                <div class="joe_stretch">
                    <div class="contain">
                        <span class="line">/</span>
                        <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="19922">
                            <path d="M1004.16 661.12V184.32H19.84v476.16h448v123.52H245.12v40.32h533.76v-39.68H556.8v-123.52zM83.84 248.32h856.32v348.8H83.84z" p-id="19923"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <time class="joe_detail__count-created" datetime="<?php $this->date('m/d'); ?>"><?php $this->date('m/d'); ?></time>
</div>