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
    wp_enqueue_script( 'nekomiao', get_template_directory_uri() . '/js/nekomiao.js', ['jquery'], THEME_DB_VERSION );
    wp_enqueue_style( 'nekomiao', get_template_directory_uri() . '/css/nekomiao.css', [], THEME_DB_VERSION );

}

add_action( 'wp_enqueue_scripts', 'Neko_enqueue_scripts' );


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
function wp_compress_html()
{
    function wp_compress_html_main( $buffer )
    {
        $initial = strlen( $buffer );
        $buffer = explode( "<!--wp-compress-html-->", $buffer );
        $count = count( $buffer );
        $buffer_out = '';

        for ( $i = 0; $i <= $count; $i++ ) {
            if ( stristr( $buffer[$i], '<!--wp-compress-html no compression-->' ) ) {
                $buffer[$i] = (str_replace( "<!--wp-compress-html no compression-->", " ", $buffer[$i] ));
            } else {
                $buffer[$i] = (str_replace( "\t", " ", $buffer[$i] ));
                $buffer[$i] = (str_replace( "\n\n", "\n", $buffer[$i] ));
                $buffer[$i] = (str_replace( "\n", "", $buffer[$i] ));
                $buffer[$i] = (str_replace( "\r", "", $buffer[$i] ));
                while ( stristr( $buffer[$i], '  ' ) ) {
                    $buffer[$i] = (str_replace( "  ", " ", $buffer[$i] ));
                }
            }
            $buffer_out .= $buffer[$i];
        }
        $final = strlen( $buffer_out );
        $savings = ($initial - $final) / $initial * 100;
        $savings = round( $savings, 2 );
        $buffer_out .= "\n<!--压缩前的大小: $initial bytes; 压缩后的大小: $final bytes; 节约：$savings% -->";
        return $buffer_out;
    }

    ob_start( "wp_compress_html_main" );
}

add_action( 'get_header', 'wp_compress_html' );


function login_protection()
{
    if ( $_GET["入口"] != "芝麻开门" ) header( "Location: https://www.nekomiao.cn" );
}

add_action( "login_enqueue_scripts", "login_protection" );


//End of page.