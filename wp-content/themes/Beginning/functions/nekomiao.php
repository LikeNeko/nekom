<?php
/**
 * 自定义登陆界面
 */
function custom_login_logo() {
echo '
<link rel="stylesheet" id="wp-admin-css" href="'.get_bloginfo('template_directory').'/css/xinadmin.css"
      type="text/css"/>';
}
add_action('login_head', 'custom_login_logo');

/**
 * 自定义 加载Js、Css
 *
 * @uses wp_register_style() 注册 CSS 样式表
 * @uses wp_enqueue_style()  挂载 CSS 样式表
 *
 * @uses wp_register_script() 注册 JavaScript 脚本
 * @uses wp_enqueue_script()  挂载 JavaScript 脚本
 */
function Neko_enqueue_scripts() {
//    wp_deregister_script('jquery');
//    wp_register_script('jquery', 'https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js', false);
//    wp_enqueue_script('jquery');

//    wp_enqueue_script( 'test',get_template_directory_uri() . '/js/nekomiao.js',['jquery']);
 }
add_action( 'wp_enqueue_scripts', 'Neko_enqueue_scripts' );


/**
 * 去除控制台显示的jQuery迁徙
 *
 */
add_action( 'wp_default_scripts', function( $scripts ) {
    if ( ! empty( $scripts->registered['jquery'] ) ) {
        $jquery_dependencies = $scripts->registered['jquery']->deps;
        $scripts->registered['jquery']->deps = array_diff( $jquery_dependencies, array( 'jquery-migrate' ) );
    }
} );

/**
 * 加入文章目录
 *
 */
function article_index($content) {
    $matches = array();
    $ul_li = '';

    $r = '/<h([2-6]).*?\>(.*?)<\/h[2-6]>/is';

    if(is_single() && preg_match_all($r, $content, $matches)) {
        foreach($matches[1] as $key => $value) {
            $title = trim(strip_tags($matches[2][$key]));
            $content = str_replace($matches[0][$key], '<h' . $value . ' id="title-' . $key . '">'.$title.'</h2>', $content);
            $ul_li .= '<li><a href="#title-'.$key.'" title="'.$title.'">'.$title."</a></li>\n";
        }

        $content = "\n<div id=\"article-index\">
<strong>文章目录</strong>
<ol id=\"index-ul\">\n" . $ul_li . "</ol>
</div>\n" . $content;
    }

    return $content;
}
add_filter( 'the_content', 'article_index' );

//End of page.