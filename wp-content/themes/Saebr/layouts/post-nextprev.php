<?php 

/**
 * NEXT / PREVIOUS POSTS (精华版)
 */

if ( akina_option('post_nepre') == 'yes') {
?>
<section class="post-squares nextprev">
	<div class="post-nepre <?php if(get_next_post()){echo 'half';}else{echo 'full';} ?> previous">
		<?php previous_post_link('%link','<div class="background" style="background-image:url(https://wx4.sinaimg.cn/large/3c3695d6ly1fghdxa5k01j21gs0hkqeq.jpg);"></div><span class="label">Previous Post</span><div class="info"><h3>%title</h3><hr></div>') ?>
	</div>
	<div class="post-nepre <?php if(get_previous_post()){echo 'half';}else{echo 'full';} ?> next">
		<?php next_post_link('%link','<div class="background" style="background-image:url(https://wx3.sinaimg.cn/large/3c3695d6ly1fghdxi764ij21kw0sqqsp.jpg);"></div><span class="label">Next Post</span><div class="info"><h3>%title</h3><hr></div>') ?>
	</div>
</section>
<?php } ?>