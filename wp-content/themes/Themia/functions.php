<?php

/*
 * Loads the Options Panel
 *
 * If you're loading from a child theme use stylesheet_directory
 * instead of template_directory
 */

define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
require_once dirname( __FILE__ ) . '/inc/options-framework.php';

// Loads options.php from child or parent theme
$optionsfile = locate_template( 'options.php' );
load_template( $optionsfile );
// 自定义菜单
register_nav_menus( array(
		'primary' => esc_html__( '导航菜单', 'akina' ),
	) );
//屏蔽顶部工具栏
add_filter( 'show_admin_bar', '__return_false' );
wp_enqueue_script('jquery');

// 评论邮件
add_action('comment_post','comment_mail_notify');
/* comment_mail_notify v1.0 by willin kan. (所有回复都发邮件) */
function comment_mail_notify($comment_id) {
    $comment = get_comment($comment_id);
    $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
    $spam_confirmed = $comment->comment_approved;
    if (($parent_id != '') && ($spam_confirmed != 'spam')) {
        $wp_email = 'no-reply@' . preg_replace('#^www.#', '', strtolower($_SERVER['SERVER_NAME'])); //e-mail 发出点, no-reply 可改为可用的 e-mail.
        $to = trim(get_comment($parent_id)->comment_author_email);
        $subject = '您在 [' . get_option("blogname") . '] 的留言有了回复';
        $message = '
    <table cellpadding="0" cellspacing="0" class="email-container" align="center" width="550" style="font-size: 15px; font-weight: normal; line-height: 22px; text-align: left; border: 1px solid rgb(177, 213, 245); width: 550px;">
<tbody><tr>
<td>
<table cellpadding="0" cellspacing="0" class="padding" width="100%" style="padding-left: 40px; padding-right: 40px; padding-top: 30px; padding-bottom: 35px;">
<tbody>
<tr class="logo">
<td align="center">
<table class="logo" style="margin-bottom: 10px;">
<tbody>
<tr>
<td>
<span style="font-size: 22px;padding: 10px 20px;margin-bottom: 5%;color: #65c5ff;border: 1px solid;box-shadow: 0 5px 20px -10px;border-radius: 2px;display: inline-block;">' . get_option("blogname") . '</span>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr class="content">
<td>
<hr style="height: 1px;border: 0;width: 100%;background: #eee;margin: 15px 0;display: inline-block;">
<p>Hi ' . trim(get_comment($parent_id)->comment_author) . '!<br>Your comment by "' . get_the_title($comment->comment_post_ID) . '":</p>
<p style="background: #eee;padding: 1em;text-indent: 2em;line-height: 30px;">' . trim(get_comment($parent_id)->comment_content) . '</p>
<p>'. $comment->comment_author .' give you reply:</p>
<p style="background: #eee;padding: 1em;text-indent: 2em;line-height: 30px;">' . trim($comment->comment_content) . '</p>
</td>
</tr>
<tr>
<td align="center">
<table cellpadding="12" border="0" style="font-family: Lato, \'Lucida Sans\', \'Lucida Grande\', SegoeUI, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 16px; font-weight: bold; line-height: 25px; color: #444444; text-align: left;">
<tbody><tr>
<td style="text-align: center;">
<a target="_blank" style="color: #fff;background: #65c5ff;box-shadow: 0 5px 20px -10px #44b0f1;border: 1px solid #44b0f1;width: 200px;font-size: 14px;padding: 10px 0;border-radius: 2px;margin: 10% 0 5%;text-align:center;display: inline-block;text-decoration: none;" href="' . htmlspecialchars(get_comment_link($parent_id)) . '">Now Reply</a>
</td>
</tr>
</tbody></table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>

<table border="0" cellpadding="0" cellspacing="0" align="center" class="footer" style="max-width: 550px; font-family: Lato, \'Lucida Sans\', \'Lucida Grande\', SegoeUI, \'Helvetica Neue\', Helvetica, Arial, sans-serif; font-size: 15px; line-height: 22px; color: #444444; text-align: left; padding: 20px 0; font-weight: normal;">
<tbody><tr>
<td align="center" style="text-align: center; font-size: 12px; line-height: 18px; color: rgb(163, 163, 163); padding: 5px 0px;">
</td>
</tr>
<tr>
<td style="text-align: center; font-weight: normal; font-size: 12px; line-height: 18px; color: rgb(163, 163, 163); padding: 5px 0px;">
<p>Please do not reply to this message , because it is automatically sent.</p>
<p>© '.date("Y").' <a name="footer_copyright" href="' . home_url() . '" style="color: rgb(43, 136, 217); text-decoration: underline;" target="_blank">' . get_option("blogname") . '</a></p>
</td>
</tr>
</tbody>
</table>';
        $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
        $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
        wp_mail( $to, $subject, $message, $headers );
    }
}


/* Archives list by zwwooooo | http://zww.me */
 function zww_archives_list() {
     if( !$output = get_option('zww_archives_list') ){
         $output = '<div id="archives">';
         $the_query = new WP_Query( 'posts_per_page=-1&ignore_sticky_posts=1' ); //update: 加上忽略置顶文章
         $year=0; $mon=0; $i=0; $j=0;
         while ( $the_query->have_posts() ) : $the_query->the_post();
             $year_tmp = get_the_time('Y');
             $mon_tmp = get_the_time('m');
             $y=$year; $m=$mon;
             if ($mon != $mon_tmp && $mon > 0) $output .= '</ul></li>';
             if ($year != $year_tmp && $year > 0) $output .= '</ul>';
             if ($year != $year_tmp) {
                 $year = $year_tmp;
                 $output .= '<h3 class="al_year">'. $year .' 年</h3><ul class="al_mon_list">'; //输出年份
             }
             if ($mon != $mon_tmp) {
                 $mon = $mon_tmp;
                 $output .= '<li><span class="al_mon">'. $mon .' 月</span><ul class="al_post_list">'; //输出月份
             }
             $output .= '<li>'. get_the_time('d日: ') .'<a href="'. get_permalink() .'">'. get_the_title() .'</a> <em>('. get_comments_number('0', '1', '%') .')</em></li>'; //输出文章日期和标题
         endwhile;
         wp_reset_postdata();
         $output .= '</ul></li></ul></div>';
         update_option('zww_archives_list', $output);
     }
     echo $output;
 }
 function clear_zal_cache() {
     update_option('zww_archives_list', ''); // 清空 zww_archives_list
 }
 add_action('save_post', 'clear_zal_cache'); // 新发表文章/修改文章时

/**
 * post views.
 * @bigfa
 */
function restyle_text($number) {
    if($number >= 1000) {
        return round($number/1000,2) . 'k';
    }else{
        return $number;
    }
}

function set_post_views() {
    global $post;
    $post_id = intval($post->ID);
    $count_key = 'views';
    $views = get_post_custom($post_id);
    $views = intval($views['views'][0]);
    if(is_single() || is_page()) {
        if(!update_post_meta($post_id, 'views', ($views + 1))) {
            add_post_meta($post_id, 'views', 1, true);
        }
    }
}
add_action('get_header', 'set_post_views');

function get_post_views($post_id) {
    $count_key = 'views';
    $views = get_post_custom($post_id);
    $views = intval($views['views'][0]);
    $post_views = intval(post_custom('views'));
    if($views == '') {
        return 0;
    }else{
        return restyle_text($views);
    }
} 


//发表文章时间显示XX天前
function timeago( $ptime ) {
    $ptime = strtotime($ptime);
    $etime = time() - $ptime;
    if($etime < 1) return '刚刚';
    $interval = array (
        12 * 30 * 24 * 60 * 60  =>  '年前 ('.date('Y-m-d', $ptime).')',
        30 * 24 * 60 * 60       =>  '个月前 ('.date('m-d', $ptime).')',
        7 * 24 * 60 * 60        =>  '周前 ('.date('m-d', $ptime).')',
        24 * 60 * 60            =>  '天前',
        60 * 60                 =>  '小时前',
        60                      =>  '分钟前',
        1                       =>  '秒前'
    );
    foreach ($interval as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
            $r = round($d);
            return $r . $str;
        }
    };
}
 /* Mini Pagenavi v1.0 by Willin Kan. Edit by zwwooooo */
if ( !function_exists('pagenavi') ) {
	function pagenavi( $p = 5 ) {
		if ( is_singular() ) return;
		global $wp_query, $paged;
		$max_page = $wp_query->max_num_pages;
		if ( $max_page == 1 ) return;
		if ( empty( $paged ) ) $paged = 1;
		//echo '<ul class="page-change"><li class="active">Page: ' . $paged . ' of ' . $max_page . ' </li></ul> ';
		if ( $paged > 1 ) p_link( $paged - 1, '上一页', '«' );
		if ( $paged > $p + 1 ) p_link( 1, '最前页' );
		if ( $paged > $p + 2 ) echo '... ';
		for( $i = $paged - $p; $i <= $paged + $p; $i++ ) {
			if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "{$i} " : p_link( $i );
		}
		if ( $paged < $max_page - $p - 1 ) echo '... ';
		if ( $paged < $max_page - $p ) p_link( $max_page, '最后页' );
		if ( $paged < $max_page ) p_link( $paged + 1,'下一页', '»' );
	}
	function p_link( $i, $title = '', $linktype = '' ) {
		if ( $title == '' ) $title = "第 {$i} 页";
		if ( $linktype == '' ) { $linktext = $i; } else { $linktext = $linktype; }
		echo "<li><a href='", esc_html( get_pagenum_link( $i ) ), "' title='{$title}'>{$linktext}</a></li>";
	}
}

//a标签
function add_menuclass($ulclass) {
   return preg_replace('/<a /', '<a class="blog-nav-item"', $ulclass);
}
add_filter('wp_nav_menu','add_menuclass');
 
// 评论添加@，by Ludou
function ludou_comment_add_at( $comment_text, $comment = '') {
  if( $comment->comment_parent > 0) {
    $comment_text = '@<a href="#comment-' . $comment->comment_parent . '">'.get_comment_author( $comment->comment_parent ) . '</a> ' . $comment_text;
  }

  return $comment_text;
}
add_filter( 'comment_text' , 'ludou_comment_add_at', 20, 2);

/*-----------------------------------------------------------------------------------*/
	/* COMMENT FORMATTING
	/*-----------------------------------------------------------------------------------*/

	function aurelius_comment($comment, $args, $depth) 
{
   $GLOBALS['comment'] = $comment; ?>

     <ol class="comment-list">
			<li itemscope itemtype="http://schema.org/UserComments" id="comment-870" class="comment-body comment-parent comment-odd">
			<div class="comment-author" itemprop="creator" itemscope itemtype="http://schema.org/Person">
      <span itemprop="image"><?php if (function_exists('get_avatar') && get_option('show_avatars')) { echo get_avatar($comment, 32); } ?></span>
      <cite class="fn" itemprop="name"><?php comment_author_link() ?></cite>
			<div class="comment-meta">
				<time itemprop="commentTime" datetime="<?php echo get_comment_time('Y-m-d T H:i:s'); ?>+00:00"><?php echo get_comment_time('Y-m-d H:i:s'); ?></time>
			</div>
			<div class="comment-content" itemprop="commentText">
				<p>
					<?php comment_text(); ?>
				</p>
			</div>
			<div class="comment-reply">
				<?php comment_reply_link(array_merge( $args, array('reply_text' => '回复','depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
					</div>
					</li>
				</ol>
<?php } ?>