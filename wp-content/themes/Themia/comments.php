<?php
	if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
?>
				<div id="disqus_thread">
					<div class="comments" id="comments">
						<span class="widget-title"><?php comments_popup_link('已有 0 条评论', '已有 1 条评论', '已有 % 条评论', '', '评论已关闭'); ?></span>
		<?php 
    if (!empty($post->post_password) && $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) { 
        // if there's a password
        // and it doesn't match the cookie
    ?>
    <li class="decmt-box">
        <p><a href="#addcomment">请输入密码再查看评论内容.</a></p>
    </li>
    <?php 
        } else if ( !comments_open() ) {
    ?>
    <li class="decmt-box">
        <p><a href="#addcomment">评论功能已经关闭!</a></p>
    </li>
    <?php 
        } else if ( !have_comments() ) { 
    ?>
    <?php 
        } else {
            wp_list_comments('type=comment&callback=aurelius_comment');
        }
    ?>
	<?php 
if ( !comments_open() ) :
// If registration required and not logged in.
elseif ( get_option('comment_registration') && !is_user_logged_in() ) : 
?>
<p>你必须 <a href="<?php echo wp_login_url( get_permalink() ); ?>">登录</a> 才能发表评论.</p>
<?php else  : ?>
<ol class="page-navigator"> 
<?php paginate_comments_links('prev_text=« &next_text= »');?>
</ol>
		<div id="respond-post-870" class="respond">
			<div class="cancel-comment-reply">
				<?php cancel_comment_reply_link('取消回复'); ?>
			</div>
			<h4 id="response"> 添加新评论 </h4>
<form method="post" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" id="comment-form" role="form">
                        <div>
        <?php if ( !is_user_logged_in() ) : ?>
<div class="col2">
					<p>
						<label for="author" class="required"> 昵称 </label><input type="text" name="author" id="author" class="text form-control" placeholder="（必填）" value="<?php echo $comment_author; ?>" required/>
					</p>
					<p>
						<label for="mail" class="required"> 邮箱 </label><input type="email" name="email" id="email" class="text form-control" placeholder="（必填）" value="<?php echo $comment_author_email; ?>" required/>
					</p>
					<p>
						<label for="url"> 网站 </label><input type="url" name="url" id="url" class="text form-control" placeholder="（http://）" value="<?php echo $comment_author_url; ?>"/>
					</p>
        <?php else : ?>
        <?php endif; ?>
       
              					<div class="col1">
						<p>
							<textarea rows="8" cols="50" name="comment" id="message comment" placeholder="请文明发言，期待您的精彩评论！" class="textarea" onkeydown="if(event.ctrlKey&&event.keyCode==13){document.getElementById('misubmit').click();return false}; form-control" required></textarea>
						</p>
					</div>
					<p>
						<button type="submit" id="submit" name="submit" class="submit"> 提交评论 （Ctrl+Enter） </button>
					</p>
				</div>
    <?php comment_id_fields(); ?>
    <?php do_action('comment_form', $post->ID); ?>
							</form>
						</div>
					</div>
				</div>
			</div>
			</article>
<?php endif; ?>