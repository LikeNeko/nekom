<i class="icon-zan"></i>喜欢
<?php if( get_post_meta($post->ID,'ality_like',true) ){
		echo get_post_meta($post->ID,'ality_like',true);
	} else {
		echo '0';
}?>