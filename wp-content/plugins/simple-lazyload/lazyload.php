<?php if (!defined('ABSPATH')) exit;
/*
Plugin Name: Simple Lazyload
Plugin URI: http://www.brunoxu.com/simple-lazyload.html
Description: Lazy load all images without configurations. It helps to decrease number of requests and improve page loading time. 延迟加载所有图片，无需配置，有助于减少请求数，提高页面加载速度。
Author: Bruno Xu
Author URI: http://www.brunoxu.com/
Version: 2.8
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( is_admin() || in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php')) ) {
	return;
}

define('SIMPLE_LAZYLOAD_VER', '2.8');
define('SIMPLE_LAZYLOAD_PLUGIN_URL', plugin_dir_url( __FILE__ ));
define('SIMPLE_LAZYLOAD_PLUGIN_DIR', plugin_dir_path( __FILE__ ));

$simple_lazyload_is_strict_lazyload = FALSE;


add_action('wp_enqueue_scripts', 'simple_lazyload_script');
function simple_lazyload_script()
{
	wp_enqueue_script('jquery');
}

function simple_lazyload_lazyload()
{
	add_action('template_redirect', 'simple_lazyload_enqueue_scripts');
	function simple_lazyload_enqueue_scripts() {
		$skip_lazyload = apply_filters('simple_lazyload_skip_lazyload', false);

		// don't lazyload for feeds, previews
		if ( $skip_lazyload || is_feed() || is_preview() ) {
			return;
		}

		wp_enqueue_style('responsively-lazy', SIMPLE_LAZYLOAD_PLUGIN_URL.'responsively-lazy/1.2.1/responsivelyLazy.min.css');
		wp_enqueue_script('responsively-lazy', SIMPLE_LAZYLOAD_PLUGIN_URL.'responsively-lazy/1.2.1/responsivelyLazy.min.js');
	}

	add_action('template_redirect','simple_lazyload_obstart');
	function simple_lazyload_obstart() {
		ob_start('simple_lazyload_obend');
	}
	function simple_lazyload_obend($content) {
		return simple_lazyload_content_filter_lazyload($content);
	}
	function simple_lazyload_content_filter_lazyload($content)
	{
		$skip_lazyload = apply_filters('simple_lazyload_skip_lazyload', false);

		// don't lazyload for feeds, previews
		if ( $skip_lazyload || is_feed() || is_preview() ) {
			return $content;
		}

		global $simple_lazyload_is_strict_lazyload;

		if ($simple_lazyload_is_strict_lazyload) {
			$regexp = "/<img([^<>]*)\.(bmp|gif|jpeg|jpg|png)([^<>]*)>/i";
		} else {
			$regexp = "/<img([^<>]*)>/i";
		}

		$content = preg_replace_callback(
			$regexp,
			"simple_lazyload_lazyimg_str_handler",
			$content
		);

		return $content;
	}
	function simple_lazyload_lazyimg_str_handler($matches)
	{
		global $simple_lazyload_is_strict_lazyload;

		$lazyimg_str = $matches[0];

		// no need to use lazy load
		if (stripos($lazyimg_str, 'src=') === FALSE) {
			return $lazyimg_str;
		}
		if (stripos($lazyimg_str, 'skip_lazyload') !== FALSE) {
			return $lazyimg_str;
		}
		if (preg_match("/\/plugins\/wp-postratings\//i", $lazyimg_str)) {
			return $lazyimg_str;
		}

		if (preg_match("/width=/i", $lazyimg_str)
				|| preg_match("/width:/i", $lazyimg_str)
				|| preg_match("/height=/i", $lazyimg_str)
				|| preg_match("/height:/i", $lazyimg_str)) {
			$alt_image_src = SIMPLE_LAZYLOAD_PLUGIN_URL.'blank_1x1.gif';
		} else {
			if (preg_match("/\/smilies\//i", $lazyimg_str)
					|| preg_match("/\/smiles\//i", $lazyimg_str)
					|| preg_match("/\/avatar\//i", $lazyimg_str)
					|| preg_match("/\/avatars\//i", $lazyimg_str)) {
				$alt_image_src = SIMPLE_LAZYLOAD_PLUGIN_URL.'blank_1x1.gif';
			} else {
				$alt_image_src = SIMPLE_LAZYLOAD_PLUGIN_URL.'blank_250x250.gif';
			}
		}

		if (stripos($lazyimg_str, "class=") === FALSE) {
			$lazyimg_str = preg_replace(
				"/<img(.*)>/i",
				'<img class="sl_lazyimg"$1>',
				$lazyimg_str
			);
		} else {
			$lazyimg_str = preg_replace(
				"/<img(.*)class=['\"]([\w\-\s]*)['\"](.*)>/i",
				'<img$1class="$2 sl_lazyimg"$3>',
				$lazyimg_str
			);
		}

		if (stripos($lazyimg_str,'srcset=')) {
			if (!stripos($lazyimg_str,'data-srcset=')) {
				$regexp = "/<img([^<>]*)srcset=['\"]([^<>'\"]*)['\"]([^<>]*)>/i";
				$replace = '<img$1srcset="data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-srcset="$2"$3>';
				$lazyimg_str = preg_replace(
					$regexp,
					$replace,
					$lazyimg_str
				);
				$lazyimg_str = str_ireplace('sl_lazyimg','responsively-lazy',$lazyimg_str);
			}
			$lazyimg_str = str_ireplace('sl_lazyimg','',$lazyimg_str);
		} else {
			if ($simple_lazyload_is_strict_lazyload) {
				$regexp = "/<img([^<>]*)src=['\"]([^<>'\"]*)\.(bmp|gif|jpeg|jpg|png)([^<>'\"]*)['\"]([^<>]*)>/i";
				$replace = '<img$1src="'.$alt_image_src.'" file="$2.$3$4"$5><noscript>'.$matches[0].'</noscript>';
			} else {
				$regexp = "/<img([^<>]*)src=['\"]([^<>'\"]*)['\"]([^<>]*)>/i";
				$replace = '<img$1src="'.$alt_image_src.'" file="$2"$3><noscript>'.$matches[0].'</noscript>';
			}
			$lazyimg_str = preg_replace(
				$regexp,
				$replace,
				$lazyimg_str
			);
		}

		return $lazyimg_str;
	}

	//add_action('wp_head', 'simple_lazyload_footer_lazyload', 11);
	add_action('wp_footer', 'simple_lazyload_footer_lazyload', 11);
	function simple_lazyload_footer_lazyload()
	{
        echo <<<EOF
<style type="text/css">
.sl_lazyimg{
    opacity:0.1;filter:alpha(opacity=10);
    background:url('./wp-content/plugins/simple-lazyload/loading3.gif') no-repeat center center;
}
</style>

<noscript>
<style type="text/css">
.sl_lazyimg{display:none;}
</style>
</noscript>
EOF;
        wp_enqueue_script('responsively-lazy-qt', SIMPLE_LAZYLOAD_PLUGIN_URL.'qt.js');
	}
}
simple_lazyload_lazyload();
