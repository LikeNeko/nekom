<?php
/*
Plugin Name: imgshow
Plugin URI: http://www.i5a6.com/imgshow/
Description: Mouse Wheel zoom picture when you onclick it,All photo will  show !You not need use code! You also use sample:[imgShow:<img src="http://www.i5a6.com/imgshow/showPhoto.jpg" border="0" alt="skag"  width="560"/>] this is ok Support for ie, firefox, chrome, opera, Safari Do not want to make the corresponding picture effect is enabled, you can use <!--noimgshow--><img src="pic.jpg" /><!--noimgshow--> to prevent the effect of
Version: 2.1
Author: liyz
Author URI: http://www.i5a6.com/

License:

Copyright (c) 2009-2012 liyz

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/

// Pre-2.6 compatibility for wp-content folder location
if (!defined("WP_CONTENT_URL")) {
	define("WP_CONTENT_URL", get_option("siteurl") . "/wp-content");
}
if (!defined("WP_CONTENT_DIR")) {
	define("WP_CONTENT_DIR", ABSPATH . "wp-content");
}

if (!class_exists('ShowPhoto')) {
    class ShowPhoto {
		// Name for serialized options saved in database
		var $optionsName = "Imgshow_options";

		var $version = "2.1";
		
		var $docURL = "http://www.i5a6.com/imgshow/";
		
		// Internationalisation
		var $textDomain = "showPhoto";
		var $languageFileLoaded = false;

		// Various path variables
		var $pluginURL = "";
		var $pluginPath = "";
		var $playerURL = "";
		var $imgRoot = "";
		var $imgAbsPath = "";
		var $isCustomImgRoot = false;
		
		// Options page name
		var $optionsPageName = "show-photo-options";
		
		// Declare instances global variable
		var $instances = array();
		
		// Flag for dealing with excerpts
		var $inExcerpt = false;
		
		/**
		 * Constructor
		 */
		function ShowPhoto() {
			// Get plugin URL and absolute path
			$this->pluginPath = WP_CONTENT_DIR . "/plugins/" . plugin_basename(dirname(__FILE__));
			$this->pluginURL = WP_CONTENT_URL . "/plugins/" . plugin_basename(dirname(__FILE__));
			// Add action and filter hooks to WordPress
			
			add_action("wp_head", array(&$this, "addHeaderCode"));
			add_filter("the_content", array(&$this, "processContent"), 2);
		}
		
		
		/**
		 * Filter function (inserts show instances according to behaviour option)
		 * @return the parsed and formatted content
		 * @param $content String[optional] the content to parse
		 */
		function processContent($content = '') {
			// Replace [imgShow syntax]
				$pattern = "/(<p>)?\[imgShow:(([^]]+))\](<\/p>)?/i";
				$content = preg_replace_callback( $pattern, array(&$this, "insertImgShow"), $content );
				$content=$this->getImgShow($content);
			return $content;
		}
		
		/**
		 * Callback function for preg_replace_callback
		 * @return string to replace matches with
		 * @param $matches Array
		 */
		function insertImgShow($matches) {
			$data=$matches[3];
			// Return imgshow instance code
			//return $this->getImgShow($data);
			return $data;
		}
		
		function getImgShow($source) {
				//$imgCode=strtolower($source);
				$imgCode=$source;
			//	preg_match("@src=[\"|']{0,}(.*?)[\"|'| |>]@is",$imgCode,$matchSrc);
			//	$addOnclickZoom='<img  onclick="zoom(this,\''.$matchSrc[1].'\')"';
			$addOnclickZoom='<img  onclick="zoom(this,false);"   style="cursor:pointer;"';
			
			$imgCode=preg_replace("/<!--noimgshow--><img/","<!--noimgshow--><--img",$imgCode);
			$imgCode=preg_replace("/<img/",$addOnclickZoom,$imgCode);
		    $imgCode=preg_replace("/><img/","  onclick='return showpotonohref();'  ><img",$imgCode);
		    $imgCode=preg_replace("/<!--noimgshow--><--img/","<!--noimgshow--><img",$imgCode);
				return $imgCode;
		}

		/**
		 * Output necessary stuff to WP head section
		 */
		function addHeaderCode() {
		    if(is_single()){
                echo '<script type="text/javascript">';
                echo "var IMGDIR = '".$this->pluginURL."/sets';var attackevasive = '0';var gid = 0;var fid = parseInt('0');var tid = parseInt('0');";
                echo '</script>';
                echo '<link rel="stylesheet" type="text/css" href="' . $this->pluginURL . '/sets/showphotostyle.css" />';
                echo '<div id="append_parent"></div><div id="ajaxwaitid"></div>';
                wp_enqueue_script('showphoto',$this->pluginURL . "/sets/showphoto.min.js",[],'',true);
            }

		}
	}
}

// Instantiate the class
if (class_exists('ShowPhoto')) {
	$ShowPhoto = new ShowPhoto();
}

/**
 * Experimental "tag" function for inserting imgshow anywhere
 * @return 
 * @param $source Object
 */
function insert_img_show($source) {
	global $ShowPhoto;
	echo $ShowPhoto->processContent($source);
}

?>