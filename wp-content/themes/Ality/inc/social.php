<div id="social">
	<div class="social-main">
		<span class="like">
	         <a href="javascript:;" data-action="ding" data-id="<?php the_ID(); ?>" title="我赞" class="favorite<?php if(isset($_COOKIE['ality_like_'.$post->ID])) echo ' done';?>"><i class="icon-zan"></i>喜欢 <i class="count">
	            <?php if( get_post_meta($post->ID,'ality_like',true) ){
					echo get_post_meta($post->ID,'ality_like',true);
				} else {
					echo '0';
				}?></i>
	        </a>
		</span>
		<span class="comment-s"><i class="icon-comment"></i><?php comments_popup_link( '抢沙发', '还有板凳', '评论 % ' ); ?></span>
		<span class="share-s"><a href="#share" id="share-main-s" title="分享"><i class="icon-share"></i>分享</a></span>
	</div>
	<div class="clear"></div>
</div>