<?php

get_header(); 

?>
<div class="author_info">
	<div class="avatar">
		<img src="<?php echo akina_option('akina_logo'); ?>" itemprop="image" alt="<?php the_author(); ?>" height="70" width="70">
	</div>
	<div class="author-center">
		<h3><?php the_author() ?></h3>
		<p>正因为生来什么都没有，因此我们能拥有一切。</p>
	</div>
</div>
<style type="text/css">
.author_info{margin-top:50px;overflow:hidden;padding:40px 0;position:relative;border-bottom:1px solid #eee;font-family:宋体}.author_info .avatar{float:left;margin-right:9pt;margin-left:8px}.author_info .avatar img{border-radius:100%;border:2px solid #fff;background:#fff;vertical-align:middle}.author_info .author-center{line-height:28px;padding-top:9px}.author_info .author-center h3{font-weight:700;font-size:20px;line-height:1.2;margin-bottom:5px;display:inline}.author-description{font-size:14px;color:rgba(0,0,0,.4);line-height:1.2}
</style>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : 
			/* Start the Loop */
			while ( have_posts() ) : the_post();  
			/*
			* Include the Post-Format-specific template for the content.
			* If you want to override this in a child theme, then include a file
			* called content-___.php (where ___ is the Post Format name) and that will be used instead.
			*/
			get_template_part( 'tpl/content', get_post_format() );
			endwhile; 
		?>
		<div class="clearer"></div>
		<?php else :

			get_template_part( 'tpl/content', 'none' );

		endif; ?>

		</main><!-- #main -->
		<?php if ( akina_option('pagenav_style') == 'ajax') { ?>
		<div id="pagination"><?php next_posts_link(__('下一页(๑•̀ㅂ•́)و✧')); ?></div>
		<?php }else{ ?>
		<nav class="navigator">
        <?php previous_posts_link('<i class="iconfont">&#xe679;</i>') ?><?php next_posts_link('<i class="iconfont">&#xe6a3;</i>') ?>
		</nav>
		<?php } ?>
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
