<?php
if ( !function_exists('Bing_posts_list') ) :
    /**
     * 主文章列表
     */
    function Bing_posts_list()
    {
        if ( have_posts() ) :
            echo '<ul class="posts-list' . ( Bing_mpanel('full_text') ? ' full-text' : '' ) . '">';

            while ( have_posts() ) :

                the_post();
                Bing_posts_list_loop();

            endwhile;

            echo '</ul>';

            Bing_page_navi(array('before' => '<div class="span12 posts-list-page-navi"><div class="panel page-navi">', 'after' => '</div></div>'));

            Bing_mobile_page_navi();
        else:
            ?>
            <div class="empty-posts-list span12">
                <article class="panel">
                    <?php
                    echo '<p>';
                    if ( is_home() ) {
                        _e('这里什么都没有', 'Bing');

                        echo '</p>';
                    }
                    else if ( is_search() ) {
                        _e('没有搜索到任何结果', 'Bing');

                        echo '</p>';
                    }
                    else {
                        _e('这里什么都没有，你也许可以使用搜索功能找到你需要的内容：', 'Bing');

                        echo '</p>';

                        get_search_form();
                    }
                    ?>
                </article>
            </div>
            <?php
        endif;
    }
endif;

if ( !function_exists('Bing_posts_list_loop') ) :
    /**
     * 主文章列表样式
     */
    function Bing_posts_list_loop()
    {
        $thumbnail_class = Bing_mpanel('thumbnail') ? 'thumbnail' : '';
        ?>
        <li <?php post_class(array('span12', $thumbnail_class)); ?>>
            <article class="panel">
                <header class="panel-header">
                    <?php the_title('<' . Bing_get_main_list_title_tag() . ' class="post-title"><a href="' . esc_url(get_permalink()) . '" title="' . the_title_attribute('echo=0') . '" rel="bookmark">', '</a></' . Bing_get_main_list_title_tag() . '>'); ?>
                </header>
                <?php if ( Bing_mpanel('full_text') ) : ?>
                    <section class="context">
                        <?php the_content(); ?>
                    </section>
                <?php else : ?>
                    <?php if ( Bing_mpanel('thumbnail') ) echo Bing_thumbnail(170, 120); ?>
                    <div class="right-box">
                        <p class="excerpt"><?php echo Bing_excerpt(120); ?></p>
                        <?php Bing_post_meta(); ?>
                    </div>
                <?php endif; ?>
            </article>
        </li>
        <?php
    }
endif;

if ( !function_exists('Bing_sidebar_posts_list') ) :
    /**
     * 边栏文章列表
     */
    function Bing_sidebar_posts_list($query_args, $thumbnail = true)
    {
        $query = new WP_Query($query_args);
        if ( $query->have_posts() ):
            echo '<ul class="sidebar-posts-list">';
            while ( $query->have_posts() ):
                $query->the_post();
                Bing_sidebar_posts_list_loop($thumbnail);
            endwhile;
            wp_reset_postdata();
            echo '</ul>';
        else:
            ?>
            <div class="empty-sidebar-posts-list">
                <p><?php _e('这里什么都没有，你也许可以使用搜索功能找到你需要的内容：'); ?></p>
                <?php get_search_form(); ?>
            </div>
            <?php
        endif;
    }
endif;

if ( !function_exists('Bing_sidebar_posts_list_loop') ) :
    /**
     * 边栏文章列表样式
     */
    function Bing_sidebar_posts_list_loop($thumbnail = true)
    {
        ?>
        <li <?php post_class($thumbnail ? 'thumbnail' : ''); ?>>
            <?php if ( $thumbnail ) echo Bing_thumbnail(50); ?>
            <div class="right-box">
                <?php the_title('<h4 class="post-title"><a href="' . esc_url(get_permalink()) . '" title="' . the_title_attribute('echo=0') . '" rel="bookmark">', '</a></h4>'); ?>
                <?php Bing_post_meta(array('date-abb', 'views')); ?>
            </div>
        </li>
        <?php
    }
endif;

if ( !function_exists('Bing_thumbnail') ) :
    /**
     * 文章缩略图
     */
    function Bing_thumbnail($width, $height = null, $link = true)
    {
        if ( empty($height) ) $height = $width;

        $title_attribute = the_title_attribute('echo=0');
        $url = Bing_post_thumbnail_url();

        if ( Bing_mpanel('crop_thumbnail') ) $url = Bing_crop_thumbnail($url, $width, $height);

        $code = sprintf('<img src="%s" class="thumbnail" width="%s" height="%s" title="%s" alt="%s" />', esc_url($url), esc_attr($width), esc_attr($height), $title_attribute, $title_attribute);

        if ( $link ) $code = sprintf('<a href="%s" class="thumbnail-link" rel="bookmark" title="%s">%s</a>', esc_url(get_permalink()), $title_attribute, $code);

        return $code;
    }
endif;

if ( !function_exists('Bing_post_meta') ) :
    /**
     * 文章信息
     */
    function Bing_post_meta($items = array('author', 'date', 'views'))
    {
        $items = (array)$items;

        if ( empty($items) ) return;

        echo '<ul class="post-meta">';
        foreach ( $items as $item ) :
            switch ( $item ) {
                case 'author' :
                    ?>
                    <li class="author">
                        <span class="dashicons dashicons-admin-users"></span>
                        <?php the_author_posts_link(); ?>
                    </li>
                    <?php
                    break;
                case 'date' :
                    ?>
                    <li class="date">
                        <span class="dashicons dashicons-calendar"></span>
                        <a href="<?php echo esc_url(get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('d'))); ?>"
                           title="<?php echo esc_attr(sprintf(__('《%s》的发布日期', 'Bing'), get_the_title())); ?>">
                            <time pubdate="pubdate"><?php echo get_the_date(); ?></time>
                        </a>
                    </li>
                    <?php
                    break;
                case 'date-abb' :
                    ?>
                    <li class="date date-abb">
                        <span class="dashicons dashicons-calendar"></span>
                        <a href="<?php echo esc_url(get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('d'))); ?>"
                           title="<?php echo esc_attr(get_the_date(__('发布于Y年m月d日', 'Bing'))); ?>">
                            <time pubdate="pubdate"><?php echo get_the_date('m-d'); ?></time>
                        </a>
                    </li>
                    <?php
                    break;
                case 'views' :
                    if ( get_post_type() == 'page' ) break;
                    ?>
                    <li class="views">
                        <span class="dashicons dashicons-visibility"></span>
                        <a href="javascript:;"
                           title="<?php echo esc_attr(sprintf(__('浏览了%s次', 'Bing'), Bing_Views_Stats::get())); ?>">
                            <?php echo Bing_Views_Stats::output(); ?>
                        </a>
                    </li>
                    <?php
                    break;
                case 'comments' :
                    ?>
                    <li class="comments">
                        <span class="dashicons dashicons-admin-comments"></span>
                        <?php comments_popup_link(__('无评论', 'Bing'), '1', '%', '', __('已关闭评论', 'Bing')); ?>
                    </li>
                    <?php
                    break;
                case 'r-hide' :
                    ?>
                    <li class="r-hide">
                        <a id="s-hide" href="javascript:;" class="">隐藏边栏</a>
                    </li>
                    <?php
                    break;
                case 'tags' :
                    the_tags('<li class="tags no-js-hide" title="' . esc_attr__('标签', 'Bing') . '"><span><i class="dashicons dashicons-tag"></i></span> <span class="tags-list">', ' | ', '</span></li>');
                    break;
            }
        endforeach;
        echo '</ul>';
    }
endif;

//End of page.
