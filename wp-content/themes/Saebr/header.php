<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Akina
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title itemprop="name"><?php global $page, $paged;
        wp_title('-', true, 'right');
        bloginfo('name');
        $site_description = get_bloginfo('description', 'display');
        if ($site_description && (is_home() || is_front_page())) echo " - $site_description";
        if ($paged >= 2 || $page >= 2) echo ' - ' . sprintf(__('第 %s 页'), max($paged, $page)); ?>
    </title>
    <script src="<?php bloginfo('template_url'); ?>/js/jquery.min2.js" type="text/javascript"></script>
    <script type="text/javascript">jQuery.noConflict();
        jQuery(document).ready(function () {
            jQuery(window).bind("beforeunload", function () {
                jQuery("html").fadeOut("' . $fadeunloadspeed . '");
            });
        });</script>
    <!--wp-compress-html--><!--wp-compress-html no compression-->
    <script>
        function grin(tag) {
            var myField;
            tag = ' ' + tag + ' ';
            if (document.getElementById('comment') && document.getElementById('comment').type == 'textarea') {
                myField = document.getElementById('comment');
            } else {
                return false;
            }
            if (document.selection) {
                myField.focus();
                sel = document.selection.createRange();
                sel.text = tag;
                myField.focus();
            }
            else if (myField.selectionStart || myField.selectionStart == '0') {
                var startPos = myField.selectionStart;
                var endPos = myField.selectionEnd;
                var cursorPos = endPos;
                myField.value = myField.value.substring(0, startPos)
                    + tag
                    + myField.value.substring(endPos, myField.value.length);
                cursorPos += tag.length;
                myField.focus();
                myField.selectionStart = cursorPos;
                myField.selectionEnd = cursorPos;
            }
            else {
                myField.value += tag;
                myField.focus();
            }
        }
    </script>
    <!--wp-compress-html no compression--><!--wp-compress-html-->
    <?php
    if (akina_option('akina_meta') == true) {
        $keywords = '';
        $description = '';
        if (is_singular()) {
            $keywords = '';
            $tags = get_the_tags();
            $categories = get_the_category();
            if ($tags) {
                foreach ($tags as $tag) {
                    $keywords .= $tag->name . ',';
                };
            };
            if ($categories) {
                foreach ($categories as $category) {
                    $keywords .= $category->name . ',';
                };
            };
            $description = mb_strimwidth(str_replace("\r\n", '', strip_tags($post->post_content)), 0, 240, '…');
        } else {
            $keywords = akina_option('akina_meta_keywords');
            $description = akina_option('akina_meta_description');
        };
        ?>
        <meta name="description" content="<?php echo $description; ?>"/>
        <meta name="keywords" content="<?php echo $keywords; ?>"/>
        <meta http-equiv="x-dns-prefetch-control" content="on">
    <?php } ?>
    <link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/ico.png"/>
    <?php include TEMPLATEPATH . '/inc/dns.php'; ?>
    <?php wp_head(); ?>
    <script type="text/javascript">
        if (!!window.ActiveXObject || "ActiveXObject" in window) {
            alert('请抛弃万恶的IE系列浏览器吧。');
        }
    </script>

</head>
<body <?php body_class(); ?>>
<section id="main-container">
    <?php
    if (!akina_option('head_focus')) {
        $filter = akina_option('focus_img_filter');
        ?>
        <div class="headertop <?php echo $filter; ?>">
            <?php get_template_part('layouts/imgbox'); ?>
        </div>
    <?php } ?>
    <div id="page" class="site wrapper">
        <header class="site-header" role="banner">
            <div class="site-top">
                <div class="site-branding">
                    <h1 class="site-title"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
                    <!-- logo end -->
                </div><!-- .site-branding -->
                <?php header_user_menu();
                if (akina_option('top_search') == 'yes') { ?>
                    <div class="searchbox"><i class="iconfont js-toggle-search iconsearch">&#xe65c;</i></div>
                <?php } ?>
                <div class="lower" style="font-family: 宋体;">
                    <?php if (!akina_option('shownav')) { ?>
                        <div id="show-nav" class="showNav">
                            <div class="line line1"></div>
                            <div class="line line2"></div>
                            <div class="line line3"></div>
                        </div><?php } ?>
                    <nav><?php wp_nav_menu(array('depth' => 2, 'theme_location' => 'primary', 'container' => false)); ?></nav>
                    <!-- #site-navigation -->
                </div>
            </div>
        </header><!-- #masthead -->
        <?php get_sidebar();
        if( ! is_home()){
        ?>
        <script>
            jQuery(document).ready(function(){
                jQuery('#secondary').css({top:'40%'})
            });
        </script>
        <?php }?>
        <?php the_headPattern(); ?>
        <div id="content" class="site-content">