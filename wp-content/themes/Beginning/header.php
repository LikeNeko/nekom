<?php if( Bing_is_ajax_load_page() ) return; ?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php echo esc_attr( get_bloginfo( 'charset' ) ); ?>" />
        <link rel="shortcut icon" href=" /favicon.ico" />
        <meta name="keywords"  content="wordpress 猫窝博客 猫窝 喵窝博客 喵窝 Neko" />
        <meta name="google-site-verification" content="rr8BzOo1mxgRE_L1IsxXxikLZbJMIbSTaJ3YOWVCHjo" />
        <meta name="sogou_site_verification" content="yYtQJCYryd"/>
        <link rel="alternate" href="https://i.nekom.cc/" hreflang="zh-Hans" />
        <meta name="theme-color" content="#f0f0f5"/>

        <?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?> >
    <!--wp-compress-html-->
		<div id="wrapper">
			<header id="header">
				<div class="box-md">
                    <div id="logo_before">
					<?php if ( is_home() || Bing_mpanel( 'headings_tags_downgrade' ) ) : ?>
						<h1 class="logo">
							<a href="<?php echo esc_url( home_url() ) ?>" title="<?php echo esc_attr( sprintf( '%s | %s', get_bloginfo( 'name', 'display' ), get_bloginfo( 'description', 'display' ) ) ); ?>"><?php bloginfo( 'name' ); ?></a>
						</h1>
					<?php else : ?>
						<div class="logo">
							<a href="<?php echo esc_url( home_url() ) ?>" title="<?php echo esc_attr( sprintf( '%s | %s', get_bloginfo( 'name', 'display' ), get_bloginfo( 'description', 'display' ) ) ); ?>"><?php bloginfo( 'name' ); ?></a>
						</div>
					<?php endif; ?>
                    </div>
					<nav class="menu header-menu-box" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
						<?php echo Bing_nav_menu( 'header_menu' ); ?>
					</nav>
<!--移除-->
                    <div id="yiyan">
                        <span class="type">[一言]</span>
                        <span class="info">
>>>
                        </span>
                    </div>
					<?php get_search_form(); ?>
				</div>
				<?php Bing_mobile_header(); ?>
			</header>
            <div id="placeholder"></div>
			<div class="box-md">
				<?php Bing_banner_span12( 'header' ); ?>
				<div class="wrapper-table-box">