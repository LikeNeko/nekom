<?php /*
Template Name: 分类目录
*/ get_header();
?>

<div id="main" data-behavior="1"
                 class="
                        hasCoverMetaIn
                        ">
                <div id="categories-archives" class="main-content-wrap">

             <h4 class="archive-result text-color-base text-xlarge"> </h4>
   <section>
                                                                                                                                                    
                                    <?php
	// 获取分类
	$terms = get_terms('category', 'orderby=name&hide_empty=0' );

	// 获取到的分类数量
	$count = count($terms);
	if($count > 0){
		// 循环输出所有分类信息
		foreach ($terms as $term) {
			echo '<a href="'.get_term_link($term, $term->slug).'" title="'.$term->name.'" class="tag tag--primary tag--small t-link">'.$term->name.'</a>';
		}
 	}
?>                                                                                                                            
    </section>
    <section class="boxes"  id="disqus_thread">                              
                    <ul class="archive-posts">
                        <?php
//for each category, show all posts
$cat_args=array(
'orderby' => 'name',
'order' => 'ASC'
);
$categories=get_categories($cat_args);
foreach($categories as $category) {
$args=array(
'showposts' => -1,
'category__in' => array($category->term_id),
'caller_get_posts'=>1
);
$posts=get_posts($args);
if ($posts) {
echo '<div id="posts-list-Typecho" class="archive box" data-category="' . sprintf( __( "View all posts in %s" ), $category->name ) . '">
<h4 class="archive-title"><a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . ' class="link-unstyled" id="posts-list-typecho">' . $category->name.'</a></h4><ul class="archive-posts archive-month">							
 ';
foreach($posts as $post) {
setup_postdata($post); ?>
<li class="archive-post">
<a href="<?php the_permalink() ?>" class="archive-post-title" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                <span class="archive-post-date">Aug <?php the_time('d，Y') ?></span>
</li>					
<?php
} // foreach($posts
} // if ($posts
} // foreach($categories
?>                                                                                                                                                   
                    </ul>
                </div>        
    </section>
</div>
<?php get_footer(); ?>