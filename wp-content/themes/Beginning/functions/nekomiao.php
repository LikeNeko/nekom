<?php
/**
 * 自定义登陆界面
 */
function custom_login_logo()
{
    echo '
<link rel="stylesheet" id="wp-admin-css" href="' . get_bloginfo( 'template_directory' ) . '/css/xinadmin.css"
      type="text/css"/>';
}

add_action( 'login_head', 'custom_login_logo' );

/**
 * 自定义 加载Js、Css
 *
 * @uses wp_register_style() 注册 CSS 样式表
 * @uses wp_enqueue_style()  挂载 CSS 样式表
 *
 * @uses wp_register_script() 注册 JavaScript 脚本
 * @uses wp_enqueue_script()  挂载 JavaScript 脚本
 */
function Neko_enqueue_scripts()
{
//    wp_deregister_script('jquery');
//    wp_register_script('jquery', 'https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js', false);
//    wp_enqueue_script('jquery');
//    wp_enqueue_style('prettify','https://cdn.bootcss.com/prettify/r298/prettify.min.js');
    //    wp_enqueue_script('prettify','https://cdn.bootcss.com/prettify/r298/prettify.min.css');
    wp_enqueue_script( 'nekomiao', get_template_directory_uri() . '/js/nekomiao.js', ['jquery'], '' ,true);
    wp_enqueue_script( 'nekomiao', get_template_directory_uri() . '/js/jquery.headroom.min.js', ['jquery'], '' ,true);
    wp_enqueue_style( 'nekomiao', get_template_directory_uri() . '/css/nekomiao.css', [], THEME_DB_VERSION );
    if ( !is_admin() ) {
        wp_deregister_script( 'jquery' );
        wp_enqueue_script( 'jquery', ( get_template_directory_uri() . '/js/jquery.min.js' ), false, THEME_DB_VERSION, true );
        

    }
}

add_action( 'wp_enqueue_scripts', 'Neko_enqueue_scripts' );

function ds_print_jquery_in_footer( &$scripts) {
    if ( ! is_admin() )
        $scripts->add_data( 'jquery', 'group', 1 );
}
add_action( 'wp_default_scripts', 'ds_print_jquery_in_footer' );

/**
 * 去除控制台显示的jQuery迁徙
 *
 */
add_action( 'wp_default_scripts', function ( $scripts ) {
    if ( !empty( $scripts->registered['jquery'] ) ) {
        $jquery_dependencies = $scripts->registered['jquery']->deps;
        $scripts->registered['jquery']->deps = array_diff( $jquery_dependencies, array('jquery-migrate') );

    }
} );

//压缩html代码
//function wp_compress_html()
//{
//    function wp_compress_html_main( $buffer )
//    {
//        $initial = strlen( $buffer );
//        $buffer = explode( "<!--wp-compress-html-->", $buffer );
//        $count = count( $buffer );
//        $buffer_out = '';
//
//        for ( $i = 0; $i <= $count; $i++ ) {
//            if ( stristr( $buffer[$i], '<!--wp-compress-html no compression-->' ) ) {
//                $buffer[$i] = (str_replace( "<!--wp-compress-html no compression-->", " ", $buffer[$i] ));
//            } else {
//                $buffer[$i] = (str_replace( "\t", " ", $buffer[$i] ));
//                $buffer[$i] = (str_replace( "\n\n", "\n", $buffer[$i] ));
//                $buffer[$i] = (str_replace( "\n", "", $buffer[$i] ));
//                $buffer[$i] = (str_replace( "\r", "", $buffer[$i] ));
//                while ( stristr( $buffer[$i], '  ' ) ) {
//                    $buffer[$i] = (str_replace( "  ", " ", $buffer[$i] ));
//                }
//            }
//            $buffer_out .= $buffer[$i];
//        }
//        $final = strlen( $buffer_out );
//        $savings = ($initial - $final) / $initial * 100;
//        $savings = round( $savings, 2 );
//        $buffer_out .= "\n<!--压缩前的大小: $initial bytes; 压缩后的大小: $final bytes; 节约：$savings% -->";
//        return $buffer_out;
//    }
//
//    ob_start( "wp_compress_html_main" );
//}

//add_action( 'get_header', 'wp_compress_html' );


/**
 * @desc 隐藏后台登陆入口
 */
function login_protection()
{
    if ( $_GET["入口"] != "芝麻开门" ) header( "Location: https://". $_SERVER["HTTP_HOST"]  );
}

add_action( "login_enqueue_scripts", "login_protection" );

/**
 * 说
 */
add_action('init', 'my_custom_init');
function my_custom_init()
{
    $labels = array(
        'name'               => '说说',
        'singular_name'      => '发布说说',
        'add_new'            => '发表说说',
        'add_new_item'       => '发表说说',
        'edit_item'          => '编辑说说',
        'new_item'           => '新说说',
        'view_item'          => '查看说说',
        'search_items'       => '搜索说说',
        'not_found'          => '暂无说说',
        'not_found_in_trash' => '没有已遗弃的说说',
        'parent_item_colon'  => '',
        'menu_name'          => '说说'
    );
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'editor', 'author')
    );
    register_post_type('shuoshuo', $args);
}

/**
 * Add dashboard widgets没什么卵用待开发的东西
 *
 */

if ( ! function_exists( 'add_dashboard_widgets' ) ) :
    function welcome_dashboard_widget_function() {
        echo "<ul><li><a href='post-new.php'>发布内容</a></li><li><a href='edit.php'>修改内容</a></li></ul>";
    }
    function add_dashboard_widgets() {
        wp_add_dashboard_widget('welcome_dashboard_widget', '常规任务', 'welcome_dashboard_widget_function');
    }
    add_action('wp_dashboard_setup', 'add_dashboard_widgets' );
endif;


/**
 * 提高搜索结果相关性
 */
if(is_search()){
    add_filter('posts_orderby_request', 'search_orderby_filter');
}
function search_orderby_filter($orderby = ''){
    global $wpdb;
    $keyword = $wpdb->prepare($_REQUEST['s']);
    return "((CASE WHEN {$wpdb->posts}.post_title LIKE '%{$keyword}%' THEN 2 ELSE 0 END) + (CASE WHEN {$wpdb->posts}.post_content LIKE '%{$keyword}%' THEN 1 ELSE 0 END)) DESC,
{$wpdb->posts}.post_modified DESC, {$wpdb->posts}.ID ASC";
}

/**
 * @desc 自定义表情
 */
function disable_emoji($plugins) {
    if (is_array($plugins)) {
        return array_diff($plugins, array(
            'wpemoji'
        ));
    } else {
        return array();
    }
}
//取当前主题下images\smilies\下表情图片路径
function custom_smilie_src($old, $img) {
    return get_stylesheet_directory_uri() . '/images/smilies/' . $img;
}
function init_fixsmilie() {
    global $wpsmiliestrans;
    //默认表情文本与表情图片的对应关系(可自定义修改)
    $wpsmiliestrans = array(
        ':mrgreen:' => '1.png',
        ':neutral:' => '2.png',
        ':twisted:' => '3.png',
        ':arrow:' => '4.png',
        ':shock:' => '5.png',
        ':smile:' => '6.png',
        ':???:' => '7.png',
        ':cool:' => '8.png',
        ':evil:' => '9.png',
        ':grin:' => '10.png',
        ':idea:' => '11.png',
        ':oops:' => '12.png',
        ':razz:' => '13.png',
        ':roll:' => '14.png',
        ':wink:' => '15.png',
        ':cry:' => '16.png',
        ':eek:' => '17.png',
        ':lol:' => '18.png',
        ':mad:' => '19.png',
        ':sad:' => '20.png',
        '8-)' => '21.png',
        '8-O' => '22.png',
        ':-(' => '23.png',
        ':-)' => '24.png',
        ':-?' => '25.png',
        ':-D' => '26.png',
        ':-P' => '27.png',
        ':-o' => '28.png',
        ':-x' => '29.png',
        ':-|' => '30.png',
        ';-)' => '31.png',
        '8O' => '32.png',
        ':(' => '33.png',
        ':)' => '34.png',
        ':?' => '35.png',
        ':D' => '36.png',
        ':P' => '37.png',
        ':o' => '38.png',
        ':x' => '39.png',
        ':|' => '40.png',
        ';)' => '41.png',
        ':!:' => '42.png',
        ':?:' => '43.png',
    );
    //移除WordPress4.2版本更新所带来的Emoji钩子同时挂上主题自带的表情路径
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    add_filter('tiny_mce_plugins', 'disable_emoji');
    add_filter('smilies_src', 'custom_smilie_src', 10, 2);
}
add_action('init', 'init_fixsmilie', 5);


