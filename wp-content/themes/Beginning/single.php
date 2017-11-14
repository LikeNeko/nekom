<?php get_header(); ?>
	<section id="container">
		<div class="row">
			<?php the_post(); ?>
			<article id="post-box" itemscope itemtype="http://schema.org/Article" <?php post_class( 'span12' ); ?>>
				<div class="panel">
					<header class="panel-header">
						<div class="post-meta-box">
							<?php
							if ( Bing_mpanel( 'breadcrumbs' ) )
								Bing_Breadcrumbs::output();

							Bing_post_meta( array( 'author', 'date-abb', 'comments', 'tags','r-hide' ) );
							?>
                        </div>
						<?php
						the_title( '<' . Bing_get_page_title_tag() . ' class="post-title">', '</' . Bing_get_page_title_tag() . '>' );
						edit_post_link( '<span class="dashicons dashicons-edit"></span>' . __( '编辑', 'Bing' ), '<span class="right">', '</span>' );

						if ( Bing_mpanel( 'mobile_single_collapse' ) )
							Bing_mobile_tab_menu();
						?>
					</header>
					<section class="context">
						<?php
						the_content();
						wp_link_pages( array(
							'before' => '<div class="page-links">' . __( '页码：', 'Bing' ),
							'after'  => '</div>'
						) );
						?>
					</section>
				</div>
			</article>
            <!– 转载声明开始 –>
            <blockquote>
                <center><font color=gray size=-1>
                        本文由 [<strong><?php the_author_posts_link(); ?></strong>]
                        原创，转载请注明转自：<strong><?php bloginfo('name'); ?></strong>[<a
                                href="<?php echo get_settings('home'); ?>"><?php echo get_settings('home'); ?></a>]；<br>
                        本文链接：<a href="<?php the_permalink() ?>"
                                title="<?php the_title(); ?>"><?php the_permalink(); ?></a>
                    </font></center>
            </blockquote>
            <!– 转载声明结束 –>

            <?php
			Bing_banner_post_bottom();

			if( Bing_mpanel( 'related_posts' ) && get_post_type() == 'post' )
				Bing_related_posts();

			if( !post_password_required() && ( comments_open() || get_comments_number() > 0 ) )
				comments_template( '', true );
			?>
		</div>
	</section>
<?php get_footer(); ?>