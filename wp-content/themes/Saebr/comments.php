<?php
 
	/**
	 * COMMENTS TEMPLATE
	 */

	/*if('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die(esc_html__('Please do not load this page directly.', 'akina'));*/

	if(post_password_required()){
		return;
	}

?>

	<?php if(comments_open() != false): ?>

	<section id="comments" class="comments">

		<div class="commentwrap comments-hidden">
			<div class="notification"><i class="iconfont">&#xe731;</i><?php esc_html_e('查看评论', 'akina'); ?>
			</div>
		</div>

		<div class="comments-main">
		 <h3 id="comments-list-title"><span class="noticom"><?php comments_popup_link('Post a new comment', ' 1 条咸鱼在这里躺着', ' % 条咸鱼在这里躺着'); ?> </span></h3> 
		<div id="loading-comments"><span></span></div>
			<?php if(have_comments()): ?>

				<ul class="commentwrap">
					<?php wp_list_comments('type=comment&callback=akina_comment_format&max_depth=10000'); ?>	
				</ul>

          <nav id="comments-navi">
				<?php paginate_comments_links('prev_text=<&next_text=>');?>
			</nav>
		

			 <?php else : ?>

				<?php if(comments_open()): ?>
					<div class="commentwrap">
						<div class="notification-hidden">
							<i class="iconfont">&#xe731;</i>、
							<?php esc_html_e('Post a new comment', 'akina'); ?>
						</div>
					</div>
				<?php endif; ?>

			<?php endif; ?>
        

        

	  <div id="respond_box">
	<div id="respond" class="comment-respond">
		<div class="cancel-comment-reply">
			<?php cancel_comment_reply_link('取消回复'); ?>
		</div>
		<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
			<p><?php print '您必须'; ?><a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"> [ 登录 ] </a>才能发表留言！</p>
		<?php else : ?>
		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
			<?php if ( $user_ID ) : ?>
				<p class="loginwords"><?php print '咸鱼：'; ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>&nbsp;&nbsp;<a href="<?php echo wp_logout_url(get_permalink()); ?>" title="退出"><?php print '[ 退出 ]'; ?></a></p>
			<?php else :?>

				<div class="author-updown"><?php if($comment_author){
						printf(__('欢迎回来 , %s 大人~'), $comment_author);
					}else{
						printf(__('既然来了，不吐槽一下吗0v0?'), $comment_author);
					}

					?>
					<a id="toggle-comment-info" href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">[ 已有账号？立即登陆！ ]</a>
				</div>
			<?php endif; ?>
			<?php if ( ! $user_ID ): ?>
				<div id="comment-author-info">

					<input type="text" name="author" id="author" class="commenttext" placeholder="昵称（例：本间芽衣子）"  value="<?php echo $comment_author; ?>" size="22" tabindex="1" placeholder="Name" />
					<label for="author"></label>
					<input type="text" name="email" id="email" class="commenttext" value="<?php echo $comment_author_email; ?>" size="22" placeholder="邮箱（例：1986@163.com）" tabindex="2" />
					<label for="email"></label>
					<input type="text" name="url" id="url" class="commenttext" value="<?php echo $comment_author_url; ?>" size="22" placeholder="您的网站(例：www.baidu.com)" tabindex="3" />
		<label for="url"></label>

	</div>
	</br>
	</br>
	</br>
        
      <?php endif; ?>


<script type="text/javascript" language="javascript">
	/* <![CDATA[ */

    var tag;

/* ]]> */

</script>
<div class="comt-smilies">
<a href="javascript:grin(':?:')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_question.gif" alt="" /></a>

<a href="javascript:grin(':razz:')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_razz.gif" alt="" /></a>

<a href="javascript:grin(':sad:')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_sad.gif" alt="" /></a>

<a href="javascript:grin(':evil:')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_evil.gif" alt="" /></a>

<a href="javascript:grin(':!:')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_exclaim.gif" alt="" /></a>

<a href="javascript:grin(':smile:')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_smile.gif" alt="" /></a>

<a href="javascript:grin(':oops:')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_redface.gif" alt="" /></a>

<a href="javascript:grin(':grin:')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_biggrin.gif" alt="" /></a>

<a href="javascript:grin(':eek:')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_surprised.gif" alt="" /></a>

<a href="javascript:grin(':shock:')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_eek.gif" alt="" /></a>

<a href="javascript:grin(':???:')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_confused.gif" alt="" /></a>

<a href="javascript:grin(':cool:')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_cool.gif" alt="" /></a>

<a href="javascript:grin(':lol:')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_lol.gif" alt="" /></a>

<a href="javascript:grin(':mad:')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_mad.gif" alt="" /></a>

<a href="javascript:grin(':twisted:')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_twisted.gif" alt="" /></a>

<a href="javascript:grin(':roll:')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_rolleyes.gif" alt="" /></a>

<a href="javascript:grin(':wink:')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_wink.gif" alt="" /></a>

<a href="javascript:grin(':idea:')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_idea.gif" alt="" /></a>

<a href="javascript:grin(':arrow:')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_arrow.gif" alt="" /></a>

<a href="javascript:grin(':neutral:')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_neutral.gif" alt="" /></a>

<a href="javascript:grin(':cry:')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_cry.gif" alt="" /></a>

<a href="javascript:grin(':mrgreen:')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_mrgreen.gif" alt="" /></a>
</div>

      <div class="clear"></div>
         

		<p class="coments_words" style="border:1px #0a8cd2 solid;"><textarea name="comment" id="comment" placeholder="有意义的评论能给后来的小伙伴参考" tabindex="4" cols="50" rows="5"></textarea></p>
		<div class="com-footer">
	
		
			<input class="submit" name="submit" type="submit" id="submit" tabindex="5" value="寄出" />
			<?php comment_id_fields(); ?>
	  </div>
		</div>
		<?php do_action('comment_form', $post->ID); ?>
    </form>
	<div class="clear"></div>
    <?php endif; // If registration required and not logged in ?>
  </div>
  </div>
	</div>
	</section>

<?php endif; ?>

        

				

