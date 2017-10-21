<?php
/**
 *Te响应式主题 : Themia，一款个性化十分丰富，附加功能非常全面，自定义字段非常屌的华丽的响应式模板。
 * 
 * @package Themia
 * @author Jrotty
 * @version 3.7.5
 * @link http://qqdie.com
 */
get_header();
?>
		<div id="main" data-behavior="1" class=" hascovermetain ">
			<section class="postShorten-group main-content-wrap">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<article class="postShorten" itemscope itemtype="http://schema.org/BlogPosting" id="article">
			<div class="postShorten-wrap">
				<div class="postShorten-header">
					<h1 class="postShorten-title" itemprop="headline">
					<a class="link-unstyled" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h1>
					<div class="postShorten-meta">
						<time itemprop="datePublished" content="<?php the_time('Y-m-d H:i') ?>">
		     Aug <?php the_time('d，Y') ?>    	
						</time>
						<span>in </span>
						<a class="category-link"><?php
$category = get_the_category();
if($category[0]){
echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
}
?></a>
						<?php edit_post_link('编辑', '', ''); ?>
					</div>
				</div>
				<div class="postShorten-excerpt" itemprop="articleBody">
					<p style=" margin: 0 0 0em;">
     <?php echo mb_strimwidth(strip_shortcodes(strip_tags(apply_filters('the_content', $post->post_content))), 0, 300, '...'); ?>
					</p>
					<a href="<?php the_permalink(); ?>" class="postShorten-excerpt_link link ">
   继续阅读   
					</a>
				</div>
			</div> 
        </article>
<?php endwhile; ?>
			<div class="pagination-bar">
				<ul class="pagination">
					        <li class="pagination-prev">
<?php previous_posts_link('<xb class="btn btn--default btn--small">&nbsp;<i class="fa fa-angle-left text-base icon-mr"></i><span>上一页</span>&nbsp;  </xb>', 0); ?>
					<li class="pagination-next">
					<?php next_posts_link('<xb class="btn btn--default btn--small">&nbsp;<span>下一页</span><i class="fa fa-angle-right text-base icon-ml"></i>&nbsp;</xb>', 0); ?>
				</ul>
			</div>
<?php else : ?>
		<h3 class="title"><a href="#" rel="bookmark">未找到</a></h3>
		<p>没有找到任何文章！</p>
		<?php endif; ?>
			</section>
<?php get_footer(); ?>