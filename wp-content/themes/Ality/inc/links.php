<?php if ( is_home()&&!is_paged() ){ ?>
<div id="links">
	<ul>
		<?php
			if(function_exists('wp_hot_get_links')){
			wp_hot_get_links();
			}else{
			wp_list_bookmarks('title_li=&categorize=0&category=&orderby=rand&show_images=&limit='.get_option('cx_link_n'));
			}
		?>
		<li><a href="<?php echo stripslashes(get_option('cx_link_url')); ?>" title="友情链接">更多链接</a></li>
	</ul>
	<div class="clear"></div>
</div>
<?php } ?>