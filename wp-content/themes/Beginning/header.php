<?php if( Bing_is_ajax_load_page() ) return; ?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php echo esc_attr( get_bloginfo( 'charset' ) ); ?>" />
		<link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="shortcut icon" href=" /favicon.ico" />
        <meta name="keywords"  content="wordpress 猫窝博客" />

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
					<ul class="control">
						<li class="previous">
							<a class="dashicons dashicons-arrow-left-alt" href="javascript:history.go( -1 );" title="<?php esc_attr_e( '后退', 'Bing' ); ?>"></a>
						</li>
						<li class="next">
							<a class="dashicons dashicons-arrow-right-alt" href="javascript:history.go( 1 );" title="<?php esc_attr_e( '前进', 'Bing' ); ?>"></a>
						</li>
						<li class="refresh">
							<a class="dashicons dashicons-image-rotate" href="javascript:location.reload();" title="<?php esc_attr_e( '刷新', 'Bing' ); ?>"></a>
						</li>
					</ul>

					<?php get_search_form(); ?>
				</div>
				<?php Bing_mobile_header(); ?>
			</header>
            <div id="placeholder"></div>
			<div class="box-md">
				<?php Bing_banner_span12( 'header' ); ?>
				<div class="wrapper-table-box">