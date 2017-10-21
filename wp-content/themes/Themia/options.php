<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */
function optionsframework_option_name() {
	// This gets the theme name from the stylesheet
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );
	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */
function optionsframework_options() {

// 将所有页面（pages）加入数组
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = '选择页面：';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}
	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	$options_metainfo = array(
		'author' => '作者',
		'cat' => '分类',
		'time' => '时间',
		'view' => '浏览量',
		'like' => '喜欢'
	);
	
	$wp_editor_settings = array(
		'wpautop' => true, // 默认
		'textarea_rows' => 5,
		'tinymce' => array( 'plugins' => 'wordpress' )
	);
	$topslide_array = array(		
		'DESC' => __('默认排序'),
		'date' => __('时间排序'),
		'rand' => __('随机排序')
	);
	$avatar_array = array(		
		'one' => 'WP默认',
		'two' => 'V2EX',		
	);

	$index3_array = array(		
		'one' => '显示分类',
		'two' => '显示顶置文章',
		'three' => '关闭',	
	);


    $options_links = array();
    $options_links_obj = get_terms( 'link_category' );
    foreach ($options_links_obj as $link) {
        $options_links[$link->term_id] = $link->name;
    }

	$imagepath =  get_template_directory_uri() . '/img/themestyle/';

	$options = array();
	
	/*****SEO设置*****/
	$options[] = array(
		'name' => __('SEO设置'),
		'type' => 'heading');
	
	$options[] = array(
		'name' => __('网站关键词'),
		'desc' => __('各关键字间用半角逗号","分割，数量在5个以内最佳。'),
		'id' => 'acg_gjc',
		'type' => 'text');

	$options[] = array(
		'name' => __('网站描述'),
		'desc' => __('用简洁的文字描述本站点，字数建议在120个字以内。'),
		'id' => 'acg_ms',
		'type' => 'textarea');


	/*****底部设置*****/
	$options[] = array(
		'name' => __('底部设置'),
		'type' => 'heading');
	
$options[] = array(
		'name' => __('博客成立时间'),
		'desc' => __('在这里填入博客的成立时间,格式要求，完整如填入“2015/06/06 00:00:00”或者只填写年月日“2015/06/06”。'),
		'id' => 'acg_cl',
   'std' => '2017/01/01',
		'type' => 'text');

	$options[] = array(
		'name' => __('站长统计'),
		'desc' => __('填写统计代码，将被隐藏。'),
		'id' => 'acg_zztj',
		'type' => 'textarea');

	/*****导航设置*****/
	$options[] = array(
		'name' => __('导航设置'),
		'type' => 'heading');
	
	$options[] = array(
		'name' => __('Categories分类归档地址'),
		'desc' => __('新建独立页面，选择模板分类目录，这里填入新建页面的完整地址'),
		'id' => 'acg_flgd',
   'std' => '#',
		'type' => 'text');


	$options[] = array(
		'name' => __('Archive时间归档地址'),
		'desc' => __('新建独立页面，选择模板文章归档，这里填入新建页面的完整地址'),
		'id' => 'acg_sjgd',
   'std' => '#',
		'type' => 'text');
	
$options[] = array(
		'name' => __('links友情链接地址'),
		'desc' => __('新建独立页面，写上朋友的链接，作为友情链接页面，然后把页面地址填入这里'),
		'id' => 'acg_yl',
   'std' => '#',
		'type' => 'text');

$options[] = array(
		'name' => __('about链接地址'),
		'desc' => __('新建独立页面，写上关于自己的属性，然后把页面地址填入这里'),
		'id' => 'acg_gyu',
   'std' => '#',
		'type' => 'text');

$options[] = array(
		'name' => __('新浪微博地址'),
		'desc' => __('填写你的新浪微博主页地址到菜单目录中'),
		'id' => 'acg_weibo',
   'std' => '#',
		'type' => 'text');


return $options;
}