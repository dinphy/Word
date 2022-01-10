<div class="joe_banner">
    <img width="100%" height="100%" class="lazyload" src="<?php _getLazyload() ?>" data-src="<?php echo _getThumbnails($this)[0] ?>" alt="<?php $this->title() ?>" />
    <div class="infomation">
        <div class="title"><?php $this->title() ?></div>
        <div class="desctitle"><?php $this->fields->desctitle(); ?></div>
    </div>
</div>