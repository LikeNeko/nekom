<?php
/**
 * Template Name:分类目录
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Akina
 */

?>
	<article class="post post-list-thumb <?php echo $class; ?>" itemscope="" itemtype="http://schema.org/BlogPosting">
		<div class="post-thumb">
			<a href="<?php the_permalink(); ?>" style="background-image: url(<?php bloginfo('template_url'); ?>/images/ts/<?php echo rand(1,8)?>.jpg"></a>
		</div><!-- thumbnail-->
		<div class="post-content-wrap">
			<div class="post-content">
				<div class="post-date">
					<i class="iconfont"></i><?php echo poi_time_since(strtotime($post->post_date_gmt)); ?>
					<?php if(is_sticky()) : ?>
					 <i class="iconfont hotpost"></i>
			 		<?php endif ?>
				</div>
				<a href="<?php the_permalink(); ?>" class="post-title"><h3><?php the_title();?></h3></a>
				<div class="post-meta">
					<span><i class="iconfont"></i><?php echo get_post_views(get_the_ID()); ?> 次调戏</span>
					<span class="comments-number"><i class="iconfont"></i><?php comments_popup_link('暂无咸鱼', '1 条咸鱼', '% 条咸鱼'); ?></span>
					<span><i class="iconfont"></i><a href="<?php echo esc_url(get_category_link($the_cat[0]->cat_ID)); ?>"><?php echo $the_cat[0]->cat_name; ?></a>
					</span>
				</div>
				<div class="float-content">
					<p class="post-text"><?php echo mb_strimwidth(strip_shortcodes(strip_tags(apply_filters('the_content', $post->post_content))), 0, 120," ...");?></p>
					<div class="post-bottom">
						<a href="<?php the_permalink(); ?>" class="button-normal"><span style='text-shadow:0 0 1px #BDC0BA;'><i class='fa fa-hand-peace-o' aria-hidden='true'></i>Σ(°Д°;&nbsp;&nbsp;翻&nbsp;&nbsp;牌&nbsp;&nbsp;子</span></a>
					</div>
				</div>
			</div>
		</div>
	</article><!-- #post-## -->
