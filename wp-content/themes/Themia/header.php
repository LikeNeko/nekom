<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<title><?php if ( is_home() ) {
		bloginfo('name'); echo " - "; bloginfo('description');
	} elseif ( is_category() ) {
		single_cat_title(); echo " - "; bloginfo('name');
	} elseif (is_single() || is_page() ) {
		single_post_title();
	} elseif (is_search() ) {
		echo "搜索结果"; echo " - "; bloginfo('name');
	} elseif (is_404() ) {
		echo '页面未找到!';
	} else {
		wp_title('',true);
	} ?></title>
<meta name="theme-color" content="#fff">
<link rel="icon" id="web-icon" href="<?php bloginfo('template_url'); ?>/favicon.png">
<link rel="apple-touch-icon" href="<?php bloginfo('template_url'); ?>/favicon.png"/>
<link rel="alternative" type="application/atom+xml" title="RSS" href="http://acglifan.me/blog/feed/">
<meta property="og:image" content="<?php bloginfo('template_url'); ?>/image/avatar.jpg">
<meta property="og:title" content="ACG里番社"/>
<meta property="og:description" content=" <?php bloginfo('description'); ?>">
<meta itemprop="image" content="<?php bloginfo('template_url'); ?>/image/avatar.jpg">
<!--STYLES-->
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/fontawesome.css" type="text/css">
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.min.css" type="text/css">
<style>
.postShorten-header {text-align: center;}
</style>
<!--STYLES END-->
<meta name="description" content="<?php echo acg( 'acg_ms' ); ?>"/>
<meta name="keywords" content="<?php echo acg( 'acg_gjc', '' ); ?>"/>
<link rel="alternate" type="application/rss+xml" title="RSS 2.0 - 所有文章" href="<?php echo get_bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0 - 所有评论" href="<?php bloginfo('comments_rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_head(); ?>
</head>
<body>
<div id="sos">
	<div id="blog">
		<!--[if lt IE 9]>
		<div class="browsehappy" role="dialog">
			当前网页 <strong>不支持</strong> 你正在使用的浏览器. 为了正常的访问, 请 <a href="http://browsehappy.com/">升级你的浏览器</a>.
		</div>
		<![endif]-->
		<header id="header" data-behavior="1">
		<i id="btn-open-sidebar" class="fa fa-lg fa-bars"></i>
		<h1 class="header-title">
		<a class="header-title-link" href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>
		</h1>
		<a class="header-right-icon st-search-show-outputs" id="sou">
		<i class="fa fa-lg fa-search"></i>
		</a>
		</header>
		<nav id="sidebar" data-behavior="1">
		<div class="sidebar-profile">
			<a href="/#about">
			<img class="sidebar-profile-picture" src="<?php bloginfo('template_url'); ?>/image/avatar.jpg"/></a>
			<span class="sidebar-profile-name"><?php bloginfo('name'); ?></span>
		</div>
		<ul class="sidebar-buttons">
			<li class="sidebar-button">
			<a class="sidebar-button-link " href="<?php echo get_option('home'); ?>">
			<i class="sidebar-button-icon fa fa-lg fa-home"></i>
			<span class="sidebar-button-desc">主页</span>
			</a>
			</li>
			<li class="sidebar-button">
			<a class="sidebar-button-link " href="<?php echo acg( 'acg_flgd'); ?>">
			<i class="sidebar-button-icon fa fa-lg fa-bookmark"></i>
			<span class="sidebar-button-desc">分类归档</span>
			</a>
			</li>
			<li class="sidebar-button">
			<a class="sidebar-button-link " href="<?php echo acg( 'acg_sjgd' ); ?>">
			<i class="sidebar-button-icon fa fa-lg fa-calendar"></i>
			<span class="sidebar-button-desc">时间归档</span>
			</a>
			</li>
			<li class="sidebar-button"  id="sou">
                
                    <a  class="sidebar-button-link st-search-show-outputs" >
                
                    <i class="sidebar-button-icon fa fa-lg fa-search"></i>
                    <span class="sidebar-button-desc">搜索</span>
                </a>
			</li>
			<li class="sidebar-button">
			<a class="sidebar-button-link " href="<?php echo acg( 'acg_gyu' ); ?>">
			<i class="sidebar-button-icon fa fa-lg fa-info-circle"></i>
			<span class="sidebar-button-desc">关于</span>
			</a>
			</li>
		</ul>
		<ul class="sidebar-buttons">
			<li class="sidebar-button">
			<a class="sidebar-button-link " href="http://weibo.com/jinzeboke" target="_blank">
			<i class="sidebar-button-icon fa fa-lg fa-weibo"></i>
			<span class="sidebar-button-desc">微博</span>
			</a>
			</li>
			<li class="sidebar-button">
			<a class="sidebar-button-link " href="<?php echo acg( 'acg_yl' ); ?>">
			<i class="sidebar-button-icon fa fa-lg fa-chain"></i>
			<span class="sidebar-button-desc">友链</span>
			</a>
			</li>
		</ul>
		</nav>