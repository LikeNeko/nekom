<div id="sticky">
	<?php
		$args = array(
			'posts_per_page' => get_option('cx_sticky_n'),
			'post__in'  => get_option( 'sticky_posts' ),
			'ignore_sticky_posts' => 1
		);
		query_posts($args);
	?>
	<?php while (have_posts()) : the_post(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="sticky-box" onMouseOut="this.className='sticky-box'" onMouseOver="this.className='sticky-box-m'">
			<span class="sticky-ico">荐</span>
			<div class="sticky-main">
				<header class="sticky-header">
					<div class="title-heavy"></div>
					<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="详细阅读 <?php the_title(); ?>"><?php the_title(); ?></a></h2>
				</header>
				<figure class="sticky-thumbnail">
					<?php get_template_part( 'inc/thumbnail' ); ?>
				</figure>
				<div class="sticky-entry">
					<?php if ( wp_is_mobile() ) { ?>
						<a href="<?php the_permalink(); ?>" rel="bookmark" title="详细阅读 <?php the_title(); ?>">
							<?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 200,"..."); ?>
						</a>
					<?php } else { ?>
						<?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 200,"..."); ?>
					<?php } ?>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</article>
	<?php endwhile; ?>
	<?php wp_reset_query(); ?>
	<div class="clear"></div>
</div>