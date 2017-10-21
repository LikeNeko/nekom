<?php
/**
 * Akina functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Akina
 */

define('SIREN_VERSION', '2.0.5');

if (!function_exists('akina_setup')) :
    //函数开始
    include('inc/pinyin-permalink.php');//固定连接文章名称转拼音
    //theme info
    include('inc/info.php');
    //定义菜单
    if (function_exists('register_nav_menus')) {
        register_nav_menus(array(
            'nav' => __('导航')
        ));
    }
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */

    if (!function_exists('optionsframework_init')) {
        define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/');
        require_once dirname(__FILE__) . '/inc/options-framework.php';
    }


    function akina_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Akina, use a find and replace
         * to change 'akina' to the name of your theme in all the template files.
         */
        load_theme_textdomain('akina', get_template_directory() . '/languages');


        /**
         * ‘post-thumbnails’ —– 增加缩略图支持
         * 'automatic-feed-links’ 自动输出RSS
         * ‘post-formats’—– 增加文章格式功能
         * ‘custom-background’—– 增加自定义背景
         * ‘custom-header’—– 增加自定义顶部图像
         *   仅在 post 和 movies 中使用
         * add_theme_support( 'post-thumbnails', array( 'post', 'movie' ) ); // Posts and Movies
         */
        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(150, 150, true);

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => esc_html__('导航菜单', 'akina'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        /*
         * Enable support for Post Formats.
         * See https://developer.wordpress.org/themes/functionality/post-formats/
         */
        add_theme_support('post-formats', array(
            'aside',
            'image',
            'status',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('akina_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        add_filter('pre_option_link_manager_enabled', '__return_true');

        // 优化代码
        //去除头部冗余代码
        remove_action('wp_head', 'feed_links_extra', 3);
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wlwmanifest_link');
        remove_action('wp_head', 'index_rel_link');
        remove_action('wp_head', 'start_post_rel_link', 10, 0);
        remove_action('wp_head', 'wp_generator');
        remove_action('wp_head', 'wp_generator'); //隐藏wordpress版本
        remove_filter('the_content', 'wptexturize'); //取消标点符号转义

        remove_action('rest_api_init', 'wp_oembed_register_route');
        remove_filter('rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4);
        remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
        remove_filter('oembed_response_data', 'get_oembed_response_data_rich', 10, 4);
        remove_action('wp_head', 'wp_oembed_add_discovery_links');
        remove_action('wp_head', 'wp_oembed_add_host_js');
        // Remove the Link header for the WP REST API
        // [link] => <http://cnzhx.net/wp-json/>; rel="https://api.w.org/"
        remove_action('template_redirect', 'rest_output_link_header', 11, 0);

        function coolwp_remove_open_sans_from_wp_core()
        {
            wp_deregister_style('open-sans');
            wp_register_style('open-sans', false);
            wp_enqueue_style('open-sans', '');
        }

        add_action('init', 'coolwp_remove_open_sans_from_wp_core');

        /**
         * Disable the emoji's
         */
        function disable_emojis()
        {
            remove_action('wp_head', 'print_emoji_detection_script', 7);
            remove_action('admin_print_scripts', 'print_emoji_detection_script');
            remove_action('wp_print_styles', 'print_emoji_styles');
            remove_action('admin_print_styles', 'print_emoji_styles');
            remove_filter('the_content_feed', 'wp_staticize_emoji');
            remove_filter('comment_text_rss', 'wp_staticize_emoji');
            remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
            add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
        }

        add_action('init', 'disable_emojis');

        /**
         * Filter function used to remove the tinymce emoji plugin.
         *
         * @param    array $plugins
         * @return   array             Difference betwen the two arrays
         */
        function disable_emojis_tinymce($plugins)
        {
            if (is_array($plugins)) {
                return array_diff($plugins, array('wpemoji'));
            } else {
                return array();
            }
        }

        /*
     * 评论表情
     */

        function custom_smilies_src($src, $img)
        {

            return get_bloginfo('template_directory') . '/images/smilies/' . $img;
        }

        add_filter('smilies_src', 'custom_smilies_src', 10, 2);

        function init_akinasmilie()
        {
            global $wpsmiliestrans;
            //默认表情文本与表情图片的对应关系(可自定义修改)
            $wpsmiliestrans = array(
                ':mrgreen:' => 'icon_mrgreen.gif',
                ':neutral:' => 'icon_neutral.gif',
                ':twisted:' => 'icon_twisted.gif',
                ':arrow:' => 'icon_arrow.gif',
                ':shock:' => 'icon_eek.gif',
                ':smile:' => 'icon_smile.gif',
                ':???:' => 'icon_confused.gif',
                ':cool:' => 'icon_cool.gif',
                ':evil:' => 'icon_evil.gif',
                ':grin:' => 'icon_biggrin.gif',
                ':idea:' => 'icon_idea.gif',
                ':oops:' => 'icon_redface.gif',
                ':razz:' => 'icon_razz.gif',
                ':roll:' => 'icon_rolleyes.gif',
                ':wink:' => 'icon_wink.gif',
                ':cry:' => 'icon_cry.gif',
                ':eek:' => 'icon_surprised.gif',
                ':lol:' => 'icon_lol.gif',
                ':mad:' => 'icon_mad.gif',
                ':sad:' => 'icon_sad.gif',
                '8-)' => 'icon_cool.gif',
                '8-O' => 'icon_eek.gif',
                ':-(' => 'icon_sad.gif',
                ':-)' => 'icon_smile.gif',
                ':-?' => 'icon_confused.gif',
                ':-D' => 'icon_biggrin.gif',
                ':-P' => 'icon_razz.gif',
                ':-o' => 'icon_surprised.gif',
                ':-x' => 'icon_mad.gif',
                ':-|' => 'icon_neutral.gif',
                ';-)' => 'icon_wink.gif',
                '8O' => 'icon_eek.gif',
                ':(' => 'icon_sad.gif',
                ':)' => 'icon_smile.gif',
                ':?' => 'icon_confused.gif',
                ':D' => 'icon_biggrin.gif',
                ':P' => 'icon_razz.gif',
                ':o' => 'icon_surprised.gif',
                ':x' => 'icon_mad.gif',
                ':|' => 'icon_neutral.gif',
                ';)' => 'icon_wink.gif',
                ':!:' => 'icon_exclaim.gif',
                ':?:' => 'icon_question.gif',
            );

        }

        add_action('init', 'init_akinasmilie', 5);


        // 移除菜单冗余代码
        add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1);
        add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1);
        add_filter('page_css_class', 'my_css_attributes_filter', 100, 1);
        function my_css_attributes_filter($var)
        {
            return is_array($var) ? array_intersect($var, array('current-menu-item', 'current-post-ancestor', 'current-menu-ancestor', 'current-menu-parent')) : '';
        }

    }
endif;
add_action('after_setup_theme', 'akina_setup');
// 当主题功能文件加载完毕之后会执行akina_setup函数

function admin_lettering()
{
    echo '<style type="text/css">body{font-family: 宋体;}</style>';
}

add_action('admin_head', 'admin_lettering');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function akina_content_width()
{
    $GLOBALS['content_width'] = apply_filters('akina_content_width', 640);
}

add_action('after_setup_theme', 'akina_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function akina_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('我的left侧边栏', 'akina'),
        'id' => 'sidebar-left',
        'description' => esc_html__('放置杂务处( • ̀ω•́ )✧', 'akina'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('我的right侧边栏', 'akina'),
        'id' => 'sidebar-right',
        'description' => esc_html__('放置杂务处( • ̀ω•́ )✧', 'akina'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}

add_action('widgets_init', 'akina_widgets_init');

/*
 * 删除自带小工具
*/
//function unregister_default_widgets()
//{
//    unregister_widget("WP_Widget_Pages");
//    unregister_widget("WP_Widget_Calendar");
//    unregister_widget("WP_Widget_Archives");
//    unregister_widget("WP_Widget_Links");
//    unregister_widget("WP_Widget_Meta");
//    unregister_widget("WP_Widget_Search");
//    unregister_widget("WP_Widget_Text");
//    unregister_widget("WP_Widget_Categories");
//    unregister_widget("WP_Widget_Recent_Posts");
//    unregister_widget("WP_Widget_Recent_Comments");
//    unregister_widget("WP_Widget_RSS");
//    unregister_widget("WP_Widget_Tag_Cloud");
//    unregister_widget("WP_Nav_Menu_Widget");
//}
//
//add_action("widgets_init", "unregister_default_widgets", 11);

/**
 * Enqueue scripts and styles.
 */
function akina_scripts()
{
    wp_enqueue_style('siren', get_stylesheet_uri(), array(), SIREN_VERSION);
    wp_enqueue_script('jq', get_template_directory_uri() . '/js/jquery.min.js', array(), SIREN_VERSION, true);
    wp_enqueue_script('pjax-libs', get_template_directory_uri() . '/js/jquery.pjax.js', array(), SIREN_VERSION, true);
    wp_enqueue_script('input', get_template_directory_uri() . '/js/input.min.js', array(), SIREN_VERSION, true);
    wp_enqueue_script('app', get_template_directory_uri() . '/js/app.js', array(), SIREN_VERSION, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    // 20161116
    $mv_live = akina_option('focus_mvlive') ? 'open' : 'close';
    $movies = akina_option('focus_amv') ? array('url' => akina_option('amv_url'), 'name' => akina_option('amv_title'), 'live' => $mv_live) : 'close';
    $auto_height = akina_option('focus_height') ? 'fixed' : 'auto';
    $code_lamp = akina_option('open_prism_codelamp') ? 'open' : 'close';
    if (wp_is_mobile()) $auto_height = 'fixed'; //拦截移动端
    wp_localize_script('app', 'Poi', array(
        'pjax' => akina_option('poi_pjax'),
        'movies' => $movies,
        'windowheight' => $auto_height,
        'codelamp' => $code_lamp,
        'ajaxurl' => admin_url('admin-ajax.php'),
        'order' => get_option('comment_order'), // ajax comments
        'formpostion' => 'bottom' // ajax comments 默认为bottom，如果你的表单在顶部则设置为top。
    ));
}

add_action('wp_enqueue_scripts', 'akina_scripts');

/**
 * load .php.
 */
require get_template_directory() . '/inc/decorate.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * function update
 */
require get_template_directory() . '/inc/siren-update.php';
require get_template_directory() . '/inc/categories-images.php';


/**
 * COMMENT FORMATTING
 */
if (!function_exists('akina_comment_format')) {
    function akina_comment_format($comment, $args, $depth)
    {
        $GLOBALS['comment'] = $comment;
        ?>
    <li <?php comment_class(); ?> id="comment-<?php echo esc_attr(comment_ID()); ?>" style="list-style: none;">
        <div class="contents">
            <div class="comment-arrow">
                <div class="main shadow">
                    <div class="profile">
                        <a href="<?php comment_author_url(); ?>">
                            <?php echo get_avatar($comment, '80', 'mystery'); ?>
                        </a>
                    </div>
                    <div class="commentinfo">
                        <section class="commeta">
                            <div class="left">
                                <h4 class="author"><a
                                        href="<?php comment_author_url(); ?>"><?php echo get_avatar($comment, '80', 'mystery'); ?>
                                        <span class="isauthor"
                                              title="<?php esc_attr_e('Author', 'akina'); ?>">风纪委员</span><?php comment_author(); ?>
                                    </a></h4>
                            </div>

                            <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                            <div class="right">
                                <div class="info">
                                    <time
                                        datetime="<?php comment_date('Y-m-d'); ?>"><?php echo poi_time_since(strtotime($comment->comment_date_gmt), true);
                                        ?></time><?php echo siren_get_useragent($comment->comment_agent); ?></div>
                            </div>
                        </section>
                    </div>
                    <div class="body">
                        <?php comment_text(); ?>
                    </div>
                </div>
                <div class="arrow-left"></div>
            </div>
        </div>
        <hr>
        <?php
    }
}


/**
 * post views.
 * @bigfa
 */
function restyle_text($number)
{
    if ($number >= 1000) {
        return round($number / 1000, 2) . 'k';
    } else {
        return $number;
    }
}

function set_post_views()
{
    global $post;
    $post_id = intval($post->ID);
    $count_key = 'views';
    $views = get_post_custom($post_id);
    $views = intval($views['views'][0]);
    if (is_single() || is_page()) {
        if (!update_post_meta($post_id, 'views', ($views + 1))) {
            add_post_meta($post_id, 'views', 1, true);
        }
    }
}

add_action('get_header', 'set_post_views');

function get_post_views($post_id)
{
    $count_key = 'views';
    $views = get_post_custom($post_id);
    $views = intval($views['views'][0]);
    $post_views = intval(post_custom('views'));
    if ($views == '') {
        return 0;
    } else {
        return restyle_text($views);
    }
}


/*
 * Ajax点赞
 */
add_action('wp_ajax_nopriv_specs_zan', 'specs_zan');
add_action('wp_ajax_specs_zan', 'specs_zan');
function specs_zan()
{
    global $wpdb, $post;
    $id = $_POST["um_id"];
    $action = $_POST["um_action"];
    if ($action == 'ding') {
        $specs_raters = get_post_meta($id, 'specs_zan', true);
        $expire = time() + 99999999;
        $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false; // make cookies work with localhost
        setcookie('specs_zan_' . $id, $id, $expire, '/', $domain, false);
        if (!$specs_raters || !is_numeric($specs_raters)) {
            update_post_meta($id, 'specs_zan', 1);
        } else {
            update_post_meta($id, 'specs_zan', ($specs_raters + 1));
        }
        echo get_post_meta($id, 'specs_zan', true);
    }
    die;
}


/*
 * 友情链接
 */
function get_the_link_items($id = null)
{
    $bookmarks = get_bookmarks('orderby=date&category=' . $id);
    $output = '';
    if (!empty($bookmarks)) {
        $output .= '<ul class="link-items fontSmooth">';
        foreach ($bookmarks as $bookmark) {
            $output .= '<li class="link-item"><a class="link-item-inner effect-apollo" href="' . $bookmark->link_url . '" title="' . $bookmark->link_description . '" target="_blank" ><img class="linksimage" src="https://api.byi.pw/favicon/?url=' . $bookmark->link_url . ' &expire=3600" alt=""><span class="sitename">' . $bookmark->link_name . '</span><div class="linkdes">' . '' . $bookmark->link_description . '</div></a></li>';
        }
        $output .= '</ul>';
    }
    return $output;
}

function get_link_items()
{
    $linkcats = get_terms('link_category');
    if (!empty($linkcats)) {
        $result = '';
        foreach ($linkcats as $linkcat) {
            $result .= '<h3 class="link-title">' . $linkcat->name . '</h3>';
            if ($linkcat->description) $result .= '<div class="link-description">' . $linkcat->description . '</div>';
            $result .= get_the_link_items($linkcat->term_id);
        }
    } else {
        $result = get_the_link_items();
    }
    return $result;
}


/*
 * 阻止站内文章互相Pingback 
 */
function theme_noself_ping(&$links)
{
    $home = get_option('home');
    foreach ($links as $l => $link)
        if (0 === strpos($link, $home))
            unset($links[$l]);
}

add_action('pre_ping', 'theme_noself_ping');


/*
 * 订制body类
*/
function akina_body_classes($classes)
{
    // Adds a class of group-blog to blogs with more than 1 published author.
    if (is_multi_author()) {
        $classes[] = 'group-blog';
    }
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }
    return $classes;
}

add_filter('body_class', 'akina_body_classes');


/*
 * 图片七牛云缓存
 */
add_filter('upload_dir', 'wpjam_custom_upload_dir');
function wpjam_custom_upload_dir($uploads)
{
    $upload_path = '';
    $upload_url_path = akina_option('qiniu_cdn');

    if (empty($upload_path) || 'wp-content/uploads' == $upload_path) {
        $uploads['basedir'] = WP_CONTENT_DIR . '/uploads';
    } elseif (0 !== strpos($upload_path, ABSPATH)) {
        $uploads['basedir'] = path_join(ABSPATH, $upload_path);
    } else {
        $uploads['basedir'] = $upload_path;
    }

    $uploads['path'] = $uploads['basedir'] . $uploads['subdir'];

    if ($upload_url_path) {
        $uploads['baseurl'] = $upload_url_path;
        $uploads['url'] = $uploads['baseurl'] . $uploads['subdir'];
    }
    return $uploads;
}


/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 */
function akina_jetpack_setup()
{
    // Add theme support for Infinite Scroll.
    add_theme_support('infinite-scroll', array(
        'container' => 'main',
        'render' => 'akina_infinite_scroll_render',
        'footer' => 'page',
    ));

    // Add theme support for Responsive Videos.
    add_theme_support('jetpack-responsive-videos');
}

add_action('after_setup_theme', 'akina_jetpack_setup');

/**
 * Custom render function for Infinite Scroll.
 */
function akina_infinite_scroll_render()
{
    while (have_posts()) {
        the_post();
        if (is_search()) :
            get_template_part('tpl/content', 'search');
        else :
            get_template_part('tpl/content', get_post_format());
        endif;
    }
}


/*
 * 编辑器增强
 */
function enable_more_buttons($buttons)
{
    $buttons[] = 'hr';
    $buttons[] = 'del';
    $buttons[] = 'sub';
    $buttons[] = 'sup';
    $buttons[] = 'fontselect';
    $buttons[] = 'fontsizeselect';
    $buttons[] = 'cleanup';
    $buttons[] = 'styleselect';
    $buttons[] = 'wp_page';
    $buttons[] = 'anchor';
    $buttons[] = 'backcolor';
    return $buttons;
}

add_filter("mce_buttons_3", "enable_more_buttons");

/*
 * 评论邮件回复
 */
if (!function_exists('comment_mail_notify')) {
    function comment_mail_notify($comment_id)
    {

        $mail_user_name = akina_option('mail_user_name') ? akina_option('mail_user_name') : 'poi';
        $comment = get_comment($comment_id);
        $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
        $spam_confirmed = $comment->comment_approved;

        if (($parent_id != '') && ($spam_confirmed != 'spam')) {
            $wp_email = $mail_user_name . '@' . 'email.' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME']));
            $to = trim(get_comment($parent_id)->comment_author_email);
            $subject = '你在 [' . get_option("blogname") . '] 的留言有了回应';
            $message = '
    <table border="1" cellpadding="0" cellspacing="0" width="600" align="center" style="border-collapse: collapse; border-style: solid; border-width: 1;border-color:#ddd;">
	<tbody>
          <tr>
            <td>
				<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" height="48" >
                    <tbody><tr>
                        <td width="100" align="center" style="border-right:1px solid #ddd;"> ' . get_option("blogname") . '</td>
                        <td width="300" style="padding-left:20px; color:#ec3409;"><strong>您有一条来自' . get_option("blogname") . ' 的回复,系统发送，请勿回复</strong></td>
						</tr>
					</tbody>
				</table>
			</td>
          </tr>
          <tr>
            <td  style="padding:15px;"><p><strong>' . trim(get_comment($parent_id)->comment_author) . '</strong>, 你好!</span>
              <p>你在《' . get_the_title($comment->comment_post_ID) . '》的留言:</p><p style="border-left:3px solid #ddd;padding-left:1rem;color:#999;">'
                . trim(get_comment($parent_id)->comment_content) . '</p><p>
              ' . trim($comment->comment_author) . ' 给你的回复:</p><p style="border-left:3px solid #ddd;padding-left:1rem;color:#999;">'
                . trim($comment->comment_content) . '</p>
        <center ><a href="' . htmlspecialchars(get_comment_link($parent_id)) . '" target="_blank" style="background-color:#6ec3c8; border-radius:10px; display:inline-block; color:#fff; padding:15px 20px 15px 20px; text-decoration:none;margin-top:20px; margin-bottom:20px;">点击查看完整内容</a></center>
</td>
          </tr>
          <tr>
            <td align="center" valign="center" height="38" style="font-size:0.8rem; color:#999;">Copyright © ' . get_option("blogname") . '</td>
          </tr>
		  </tbody>
  </table>';
            $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
            $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
            wp_mail($to, $subject, $message, $headers);
        }
    }
}

add_action('comment_post', 'comment_mail_notify');

//移除wp-json链接
//add_filter('rest_enabled', '_return_false');
//add_filter('rest_jsonp_enabled', '_return_false');
remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);

/**
 * 移除 WordPress 加载的JS和CSS链接中的版本号
 * https://www.wpdaxue.com/remove-js-css-version.html
 */
function wpdaxue_remove_cssjs_ver($src)
{
    if (strpos($src, 'ver='))
        $src = remove_query_arg('ver', $src);
    return $src;
}

add_filter('style_loader_src', 'wpdaxue_remove_cssjs_ver', 999);
add_filter('script_loader_src', 'wpdaxue_remove_cssjs_ver', 999);

/*Using SinaApp jQuery CDN*/
function cwp_modify_jquery()
{
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', 'https://lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js', false, '1.9.1');
        wp_enqueue_script('jquery');
    }
}

add_action('init', 'cwp_modify_jquery');
//禁止wptexturize函数
remove_filter('the_content', 'wptexturize');
remove_action('pre_post_update', 'wp_save_post_revision');
add_action('wp_print_scripts', 'disable_autosave');
function disable_autosave()
{
    wp_deregister_script('autosave');
}

//去除冗余的html代码
remove_action('wp_head', 'feed_links', 2); //移除feed
remove_action('wp_head', 'feed_links_extra', 3); //移除feed
remove_action('wp_head', 'rsd_link'); //移除离线编辑器开放接口
remove_action('wp_head', 'wlwmanifest_link');  //移除离线编辑器开放接口
remove_action('wp_head', 'index_rel_link');//去除本页唯一链接信息
remove_action('wp_head', 'parent_post_rel_link', 10, 0);//清除前后文信息
remove_action('wp_head', 'start_post_rel_link', 10, 0);//清除前后文信息
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('publish_future_post', 'check_and_publish_future_post', 10, 1);
remove_action('wp_head', 'noindex', 1);
remove_action('wp_head', 'wp_print_head_scripts', 9);
remove_action('wp_head', 'wp_generator'); //移除WordPress版本
remove_action('wp_head', 'rel_canonical');
remove_action('wp_footer', 'wp_print_footer_scripts');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('template_redirect', 'wp_shortlink_header', 11, 0);
add_action('widgets_init', 'my_remove_recent_comments_style');
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
}

//禁用 auto-embeds
remove_filter('the_content', array($GLOBALS['wp_embed'], 'autoembed'), 8);
//禁用XML-RPC接口
add_filter('xmlrpc_enabled', '__return_false');
//使用相对链接
add_action('template_redirect', 'rw_relative_urls');
function rw_relative_urls()
{
    if (is_feed() || get_query_var('sitemap')) //判断是否为feed页面或者sitemap页面
        return;
    $filters = array(
        'post_link',
        'post_type_link',
        'page_link',
        'attachment_link',
        'get_shortlink',
        'post_type_archive_link',
        'get_pagenum_link',
        'get_comments_pagenum_link',
        'term_link',
        'search_link',
        'day_link',
        'month_link',
        'year_link',
    );
    foreach ($filters as $filter) {
        add_filter($filter, 'wp_make_link_relative');
    }
}

//强制jquery库文件底部载入
function ds_print_jquery_in_footer(&$scripts)
{
    if (!is_admin())
        $scripts->add_data('jquery', 'group', 1);
}

add_action('wp_default_scripts', 'ds_print_jquery_in_footer');
//DNS预取
function set_newuser_cookie()
{
    if (!isset($_COOKIE['v7v3_cookie'])) {
        setcookie('v7v3_cookie', 1, time() + 1209600, COOKIEPATH, COOKIE_DOMAIN, false);
    }
}

add_action('after_setup_theme', 'set_newuser_cookie');
//开启Gzip
function gzippy()
{
    ob_start('ob_gzhandler');
}

//防止七牛镜像
if (strpos($_SERVER['HTTP_USER_AGENT'], 'qiniu-imgstg-spider') !== false) {
    header('HTTP/1.1 503 Service Temporarily Unavailable');
    echo '防七牛镜像';
    exit;
}
//压缩html代码 
function wp_compress_html()
{
    function wp_compress_html_main($buffer)
    {
        $initial = strlen($buffer);
        $buffer = explode("<!--wp-compress-html-->", $buffer);
        $count = count($buffer);
        $buffer_out = null;
        for ($i = 0; $i <= $count; $i++) {
            if (stristr($buffer[$i], '<!--wp-compress-html no compression-->')) {
                $buffer[$i] = (str_replace("<!--wp-compress-html no compression-->", " ", $buffer[$i]));
            } else {
                $buffer[$i] = (str_replace("\t", " ", $buffer[$i]));
                $buffer[$i] = (str_replace("\n\n", "\n", $buffer[$i]));
                $buffer[$i] = (str_replace("\n", "", $buffer[$i]));
                $buffer[$i] = (str_replace("\r", "", $buffer[$i]));
                while (stristr($buffer[$i], '  ')) {
                    $buffer[$i] = (str_replace("  ", " ", $buffer[$i]));
                }
            }
            $buffer_out .= $buffer[$i];
        }
        $final = strlen($buffer_out);
        $savings = ($initial - $final) / $initial * 100;
        $savings = round($savings, 2);
        $buffer_out .= "\n<!--压缩前的大小: $initial bytes; 压缩后的大小: $final bytes; 节约：$savings% -->";
        return $buffer_out;
    }

    ob_start("wp_compress_html_main");
}

//WordPress SSL
add_filter('get_header', 'fanly_ssl');
function fanly_ssl()
{
    if (is_ssl()) {
        function fanly_ssl_main($content)
        {
            $siteurl = get_option('siteurl');
            $upload_dir = wp_upload_dir();
            $content = str_replace('http:' . strstr($siteurl, '//'), strstr($siteurl, '//'), $content);
            $content = str_replace('http:' . strstr($upload_dir['baseurl'], '//'), strstr($upload_dir['baseurl'], '//'), $content);
            return $content;
        }

        ob_start("fanly_ssl_main");
    }
}

add_action('get_header', 'wp_compress_html');
//防止CC攻击
session_start(); //开启session
$timestamp = time();
$ll_nowtime = $timestamp;
//判断session是否存在 如果存在从session取值，如果不存在进行初始化赋值
if ($_SESSION) {
    $ll_lasttime = $_SESSION['ll_lasttime'];
    $ll_times = $_SESSION['ll_times'] + 1;
    $_SESSION['ll_times'] = $ll_times;
} else {
    $ll_lasttime = $ll_nowtime;
    $ll_times = 1;
    $_SESSION['ll_times'] = $ll_times;
    $_SESSION['ll_lasttime'] = $ll_lasttime;
}
//现在时间-开始登录时间 来进行判断 如果登录频繁 跳转 否则对session进行赋值
if (($ll_nowtime - $ll_lasttime) < 3) {
    if ($ll_times >= 5) {
        header("location:https://www.nekomiao.cn");//可以换成其他链接，比如站内的404错误显示页面(千万不要用动态页面)
        exit;
    }
} else {
    $ll_times = 0;
    $_SESSION['ll_lasttime'] = $ll_nowtime;
    $_SESSION['ll_times'] = $ll_times;
}

/*
 * 日期：2017年8月27日
 * 状态：添加
 * 功能：解析url地址中/后页码的问题
 */
//解析url的钩子
add_filter('post_rewrite_rules', 'add_custom_post_rewrite_rules');
function add_custom_post_rewrite_rules($rules)
{
    $custom_rules = array('post-(\d+)-(\d+)\.html$' => 'index.php?p=$matches[1]&page=$matches[2]');

    //你想改的样子
    $rules = array_merge($custom_rules, $rules);
    return $rules;
}

//设置url钩子
add_filter('wp_link_pages_link', 'post_custom_rewrite_url');
function post_custom_rewrite_url($output)
{
    $preg = "/(.*)\/post-(\d+)\.html\/(\d+)\//";
    //你目前的分页链接
    $output = preg_replace($preg, "$1/post-$2-$3.html", $output);
    // 要匹配的连接
    return $output;
}

//不许跳转
add_filter('redirect_canonical', 'post_custom_redirect_url');
function post_custom_redirect_url($output)
{
    return false;
}


/**
 * 功能：添加邮件名和邮件地址的过滤
 */
add_filter('wp_mail_from', 'my_mail_from');
//定义过滤器函数my_mail_from
function my_mail_from($from_mail) {
    return "Neko@nekomiao.cn";
}
add_filter('wp_mail_from_name', 'my_mail_from_name');
//定义过滤器函数my_mail_from_name
function my_mail_from_name($from_mail) {
    return "Neko";
}

