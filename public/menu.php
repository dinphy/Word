<div class="joe_menu" style="display: <?php echo $this->is('post') ? 'none' : '' ?>">
    <nav class="joe_header__above-nav">
        <a class="item <?php echo $this->is('index') ? 'active' : '' ?>" href="<?php $this->options->siteUrl(); ?>" title="首页">首页</a>
        <?php $this->widget('Widget_Metas_Category_List')->to($category); ?>
        <?php if ($this->options->JNavStatus == 'on') : ?>
            <?php while ($category->next()) : ?>
                <?php if ($category->levels === 0) : ?>
                    <?php $children = $category->getAllChildren($category->mid); ?>
                    <?php if (empty($children)) : ?>
                        <a class="item <?php echo $this->is('category', $category->slug) ? 'active' : '' ?>" href="<?php $category->permalink(); ?>" title="<?php $category->name(); ?>"><?php $category->name(); ?></a>
                    <?php else : ?>
                        <div class="joe_dropdown" trigger="<?php $this->options->JNavDropdown ?$this->options->JNavDropdown() : 'hover' ?>" placement="45px">
                            <div class="joe_dropdown__link">
                                <a class="item <?php echo $this->is('category', $category->slug) ? 'active' : '' ?>" href="<?php $category->permalink(); ?>" title="<?php $category->name(); ?>"><?php $category->name(); ?></a>
                            </div>
                            <nav class="joe_dropdown__menu">
                                <?php foreach ($children as $mid) : ?>
                                    <?php $child = $category->getCategory($mid); ?>
                                    <a class="<?php echo $this->is('category', $child['slug']) ? 'active' : '' ?>" href="<?php echo $child['permalink'] ?>" title="<?php echo $child['name']; ?>"><?php echo $child['name']; ?></a>
                                <?php endforeach; ?>
                            </nav>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endwhile; ?>
        <?php else : ?>
            <div class="joe_dropdown" trigger="<?php $this->options->JNavDropdown ?$this->options->JNavDropdown() : 'hover' ?>" placement="45px" style="margin-right: 15px;">
                <div class="joe_dropdown__link">
                    <a href="javascript:void(0);" rel="nofollow">分类</a>
                </div>
                <nav class="joe_dropdown__menu">
                    <?php while ($category->next()) : ?>
                        <?php if ($category->levels === 0) : ?>
                            <?php $children = $category->getAllChildren($category->mid); ?>
                            <?php if (empty($children)) : ?>
                                <a class="item <?php echo $this->is('category', $category->slug) ? 'active' : '' ?>" href="<?php $category->permalink(); ?>" title="<?php $category->name(); ?>"><?php $category->name(); ?></a>
                            <?php else : ?>
                                <div class="joe_dropdown">
                                    <div class="joe_dropdown__link">
                                        <a class="item <?php echo $this->is('category', $category->slug) ? 'active' : '' ?>" href="<?php $category->permalink(); ?>" title="<?php $category->name(); ?>"><?php $category->name(); ?></a>
                                        <svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" width="16" height="16">
                                            <path d="M381.57809 345.996199c-2.908236 4.233418-4.614088 9.380648-4.614088 14.892175s1.705851 10.658757 4.614088 14.922874L544.443411 539.42256c10.32209 10.324136 10.32209 27.042913 0 37.381375L385.842207 735.921909c-5.376451 4.843308-8.771781 11.818163-8.771781 19.61371 0 14.602579 11.83249 26.433022 26.434046 26.433022 5.953595 0 11.420097-1.979074 15.835663-5.298679l5.300726-5.299703 175.866427-175.884846c20.650319-20.647249 20.650319-54.114478 0-74.763774L422.95036 343.132988l-1.811252-1.794879c-4.690836-4.264117-10.903328-6.884804-17.740036-6.884804C394.339742 334.453305 386.34465 339.02339 381.57809 345.996199z"></path>
                                        </svg>
                                        <div class="joe_dropdown__submenu">
                                            <?php foreach ($children as $mid) : ?>
                                                <?php $child = $category->getCategory($mid); ?>
                                                <a class="<?php echo $this->is('category', $child['slug']) ? 'active' : '' ?>" href="<?php echo $child['permalink'] ?>" title="<?php echo $child['name']; ?>"><?php echo $child['name']; ?></a>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </nav>
            </div>
        <?php endif; ?>

        <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
        <?php if (count($pages->stack) <= $this->options->JNavMaxNum) : ?>
            <?php foreach ($pages->stack as $item) : ?>
                <a class="item <?php echo $this->is('page', $item['slug']) ? 'active' : '' ?>" href="<?php echo $item['permalink'] ?>" title="<?php echo $item['title'] ?>"><?php echo $item['title'] ?></a>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="joe_dropdown" trigger="<?php $this->options->JNavDropdown ?$this->options->JNavDropdown() : 'hover' ?>" placement="45px" style="margin-right: 15px;">
                <div class="joe_dropdown__link">
                    <a href="javascript:void(0);" rel="nofollow">页面</a>
                </div>
                <nav class="joe_dropdown__menu">
                    <?php foreach (array_slice($pages->stack, $this->options->JNavMaxNum) as $item) : ?>
                        <a class="<?php echo $this->is('page', $item['slug']) ? 'active' : '' ?>" href="<?php echo $item['permalink'] ?>" title="<?php echo $item['title'] ?>"><?php echo $item['title'] ?></a>
                    <?php endforeach; ?>
                </nav>
            </div>
            <?php foreach (array_slice($pages->stack, 0, $this->options->JNavMaxNum) as $item) : ?>
                <a class="item <?php echo $this->is('page', $item['slug']) ? 'active' : '' ?>" href="<?php echo $item['permalink'] ?>" title="<?php echo $item['title'] ?>"><?php echo $item['title'] ?></a>
            <?php endforeach; ?>
        <?php endif; ?>
        <?php
        $custom = [];
        $custom_text = $this->options->JCustomNavs;
        if ($custom_text) {
            $custom_arr = explode("\r\n", $custom_text);
            if (count($custom_arr) > 0) {
                for ($i = 0; $i < count($custom_arr); $i++) {
                    $title = explode("||", $custom_arr[$i])[0];
                    $url = explode("||", $custom_arr[$i])[1];
                    $custom[] = array("title" => trim($title), "url" => trim($url));
                };
            }
        }
        ?>
        <?php if (sizeof($custom) > 0) : ?>
            <div class="joe_dropdown" trigger="<?php $this->options->JNavDropdown ?$this->options->JNavDropdown() : 'hover' ?>" placement="45px">
                <div class="joe_dropdown__link">
                    <a href="javascript:void(0);" rel="nofollow" style="padding-left: 0;">推荐</a>
                    <svg class="joe_dropdown__link-icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="14" height="14">
                        <path d="M561.873 725.165c-11.262 11.262-26.545 21.72-41.025 18.502-14.479 2.413-28.154-8.849-39.415-18.502L133.129 375.252c-17.697-17.696-17.697-46.655 0-64.352s46.655-17.696 64.351 0l324.173 333.021 324.977-333.02c17.696-17.697 46.655-17.697 64.351 0s17.697 46.655 0 64.351L561.873 725.165z" fill="var(--main)" />
                    </svg>
                </div>
                <nav class="joe_dropdown__menu">
                    <?php foreach ($custom as $item) : ?>
                        <a href="<?php echo $item['url'] ?>" target="_blank" rel="noopener noreferrer nofollow"><?php echo $item['title'] ?></a>
                    <?php endforeach; ?>
                </nav>
            </div>
        <?php endif; ?>
    </nav>
</div>