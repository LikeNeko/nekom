  <!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<title><?php if ( is_home() ) {
		bloginfo('name'); echo " - "; bloginfo('description');
	} elseif ( is_category() ) {
		single_cat_title(); echo " - "; bloginfo('name');
	} elseif (is_single() || is_page() ) {
		single_post_title();
	} elseif (is_search() ) {
		echo "搜索结果"; echo " - "; bloginfo('name');
	} elseif (is_404() ) {
		echo '页面未找到!';
	} else {
		wp_title('',true);
	} ?></title>
<meta name="theme-color" content="#fff">
<link rel="icon" id="web-icon" href="<?php bloginfo('template_url'); ?>/favicon.png">
<link rel="apple-touch-icon" href="<?php bloginfo('template_url'); ?>/favicon.png"/>
<meta property="og:image" content="<?php bloginfo('template_url'); ?>/image/avatar.jpg">
<meta property="og:title" content="<?php bloginfo('name'); ?>"/>
<meta property="og:description" content=" <?php bloginfo('description'); ?>">
<meta itemprop="image" content="<?php bloginfo('template_url'); ?>/image/avatar.jpg">
<!--STYLES-->
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/fontawesome.css" type="text/css">
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.min.css" type="text/css">
<style>
.postShorten-header {text-align: center;}
</style>
<!--STYLES END-->
<meta name="description" content="<?php echo acg( 'acg_ms'); ?>"/>
<meta name="keywords" content="<?php echo acg( 'acg_gjc'); ?>"/>
<link rel="alternate" type="application/rss+xml" title="RSS 2.0 - 所有文章" href="<?php echo get_bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0 - 所有评论" href="<?php bloginfo('comments_rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_head(); ?>
</head>
<body>
<div id="sos">
	<div id="blog">
		<!--[if lt IE 9]>
		<div class="browsehappy" role="dialog">
			当前网页 <strong>不支持</strong> 你正在使用的浏览器. 为了正常的访问, 请 <a href="http://browsehappy.com/">升级你的浏览器</a>.
		</div>
		<![endif]-->
		<header id="header" data-behavior="1">
		<i id="btn-open-sidebar" class="fa fa-lg fa-bars"></i>
		<h1 class="header-title">
		<a class="header-title-link" href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>
		</h1>
		
		</header>
		<nav id="sidebar" data-behavior="1">
		<div class="sidebar-profile">
			<a href="/#about">
			<img class="sidebar-profile-picture" src="<?php bloginfo('template_url'); ?>/image/avatar.jpg"/></a>
			<span class="sidebar-profile-name"><?php bloginfo('name'); ?></span>
		</div>
		<ul class="sidebar-buttons">
			<li class="sidebar-button">
			<a class="sidebar-button-link " href="<?php echo get_option('home'); ?>">
			<i class="sidebar-button-icon fa fa-lg fa-home"></i>
			<span class="sidebar-button-desc">主页</span>
			</a>
			</li>
			<li class="sidebar-button">
			<a class="sidebar-button-link " href="<?php echo acg( 'acg_flgd'); ?>">
			<i class="sidebar-button-icon fa fa-lg fa-bookmark"></i>
			<span class="sidebar-button-desc">分类归档</span>
			</a>
			</li>
			<li class="sidebar-button">
			<a class="sidebar-button-link " href="<?php echo acg( 'acg_sjgd'); ?>">
			<i class="sidebar-button-icon fa fa-lg fa-calendar"></i>
			<span class="sidebar-button-desc">时间归档</span>
			</a>
			</li>
			<li class="sidebar-button"  id="sou">
                
                    <a  class="sidebar-button-link st-search-show-outputs" >
                
                    <i class="sidebar-button-icon fa fa-lg fa-search"></i>
                    <span class="sidebar-button-desc">搜索</span>
                </a>
			</li>
			<li class="sidebar-button">
			<a class="sidebar-button-link " href="<?php echo acg( 'acg_gyu'); ?>">
			<i class="sidebar-button-icon fa fa-lg fa-info-circle"></i>
			<span class="sidebar-button-desc">关于</span>
			</a>
			</li>
		</ul>
		<ul class="sidebar-buttons">
			<li class="sidebar-button">
			<a class="sidebar-button-link " href="<?php echo acg( 'acg_weibo'); ?>" target="_blank">
			<i class="sidebar-button-icon fa fa-lg fa-weibo"></i>
			<span class="sidebar-button-desc">微博</span>
			</a>
			</li>
			<li class="sidebar-button">
			<a class="sidebar-button-link " href="<?php echo acg( 'acg_yl'); ?>">
			<i class="sidebar-button-icon fa fa-lg fa-chain"></i>
			<span class="sidebar-button-desc">友链</span>
			</a>
			</li>
		</ul>
		</nav>
		<div id="main" data-behavior="1"class="hasCoverMetaIn">
			<article class="post" itemscope itemtype="http://schema.org/BlogPosting">
			<div class="post-header main-content-wrap text-center">
				<h1 class="post-title" itemprop="headline">  <?php the_title(); ?>    </h1>
				<div class="post-meta">
					<time itemprop="datePublished" content="<?php the_time('Y-m-d H:i') ?>">
		     Aug <?php the_time('d，Y') ?>    	
						</time>
					<a class="category-link"><a class="category-link"><?php
$category = get_the_category();
if($category[0]){
echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
}
?></a></a>
					<a class="category-link" id="translateLink" href="javascript:translatePage();">繁</a>
					
				</div>
			</div>
			<div class="post-content markdown" itemprop="articleBody">
				<div class="main-content-wrap" id="yl">
					<?php if (have_posts()) while (have_posts()) {
            the_post();
            the_content();
        }; ?>
				</div>
			</div>
			<div class="post-footer main-content-wrap">
				<div style=" text-align: center;">
					<div id="QR" style="display: none;">
					</div>
					<div id="ew" style="display: none;">
						<div id="erweima" style="display: inline-block">
							<img id="erwei_qr" src="https://pan.baidu.com/share/qrcode?w=143&h=143&url=<?php the_permalink(); ?>"/>
							<p style=" text-indent: 0em; margin-left:-0em;">
								文章二维码
							</p>
						</div>
					</div>
					<a id="rewardButton" disable="enable" onclick="var qr = document.getElementById('ew');var ds = document.getElementById('QR');if (qr.style.display === 'none') {qr.style.display='block';} else {qr.style.display='none'}{ds.style.display='none'}" class="tag tag--primary tag--small t-link">
   文章二维码
					</a>
					
				</div>
				<div class="post-footer-tags">
					<div style="float:right">
						最后由<?php the_author_posts_link(); ?>编辑于<i><?php if ((get_the_modified_time('Y')*365+get_the_modified_time('z')) > (get_the_time('Y')*365+get_the_time('z'))) : ?>
<?php the_modified_time('Y-m-j h:s'); ?>
<?php else : ?>
<?php the_date_xml(); ?>
<?php endif; ?>
</i>
  <xa title="点我点我" id="ymzz"></xa>
					</div>
					<span class="text-color-light text-small">文章分类：</span><br/>
					<nav class="tag tag--primary tag--small t-link" style=" display: inline-block;">
					<sx><?php
$category = get_the_category();
if($category[0]){
echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
}
?></a></sx>
					</nav>
				</div>
				<div class="post-actions-wrap">
					<nav>
					<ul class="post-actions post-action-nav">
						<?php
	$prev_post = get_previous_post();
	if(!empty($prev_post)):?>
<li class="post-action"><a class="post-action-btn btn btn--default tooltip--top" href="<?php echo get_permalink($prev_post->ID);?>" data-tooltip="<?php echo $prev_post->post_title;?>"><i class="fa fa-angle-left"></i><span class="hide-xs hide-sm text-small ml">前篇</span></a></li>
<?php endif;?> 
<?php
	$next_post = get_next_post();
	if(!empty($next_post)):?>
		<li class="post-action">
						<a class="post-action-btn btn btn--default tooltip--top" href="<?php echo get_permalink($next_post->ID);?>" data-tooltip="<?php echo $next_post->post_title;?>"><span class="hide-xs hide-sm text-small icon-mr">后篇</span><i class="fa fa-angle-right"></i></a></li>
<?php endif;?>
					</ul>
					</nav>
					<ul class="post-actions post-action-share">
						<li class="post-action hide-lg hide-md hide-sm">
						<a class="post-action-btn btn btn--default btn-open-shareoptions" href="#btn-open-shareoptions">
						<i class="fa fa-share-alt"></i>
						</a>
						</li>
						<li class="post-action hide-xs">
						<a class="post-action-btn btn btn--default" target="_blank" data-tooltip="分享至Google" href="https://plus.google.com/share?url=<?php the_permalink(); ?>">
						<i class="fa fa-google-plus"></i>
						</a>
						</li>
						<li class="post-action hide-xs">
						<a class="post-action-btn btn btn--default tooltip--top" target="new" data-tooltip="分享至QQ空间" href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?php the_permalink(); ?>/&title=<?php the_title(); ?>&site=<?php bloginfo('name'); ?>/&pics=<?php the_permalink(); ?>&logo=https://api.ikmoe.com/moeu-rand-background.php">
						<i class="fa fa-qq"></i>
						</a>
						</li>
						<li class="post-action hide-xs">
						<a class="post-action-btn btn btn--default" target="new" data-tooltip="分享至新浪微博" href="http://service.weibo.com/share/share.php?url=<?php the_permalink(); ?>/&appkey=<?php bloginfo('name'); ?>/&title=<?php the_title(); ?>&pic=<?php the_permalink(); ?>&logo=https://api.ikmoe.com/moeu-rand-background.php">
						<i class="fa fa-weibo"></i>
						</a>
						</li>
						<li class="post-action">
						<a class="post-action-btn btn btn--default" href="#disqus_thread">
						<i class="fa fa-comment-o"></i>
						</a>
						</li>
						<li class="post-action">
						<a class="post-action-btn btn btn--default" href="#" onclick="gotoTop();return false;">
						<i class="fa fa-arrow-up"></i>
						</a></li>
					</ul>
				</div>		
<?php comments_template(); ?>		
			<footer id="footer" class="main-content-wrap">
			<span class="copyrights"> 博客已萌萌哒运行<span id="span_dt_dt"></span><br>
 &copy; 2016 <?php bloginfo('name'); ?> /
 Power By 
			<a target="_blank" href="http://wordpress.org/">WordPress</a> 
/ Designed By 
			<a target="_blank" href="http://qqdie.com/">Jrotty</a>
<div style="display:none">
<?php echo acg( 'acg_zztj'); ?>
</div>
			</span>
			</footer>
		</div>
		<div id="bottom-bar" class="post-bottom-bar" data-behavior="1">
			<div class="post-actions-wrap">
				<nav>
				<ul class="post-actions post-action-nav">
						<?php
	$prev_post = get_previous_post();
	if(!empty($prev_post)):?>
<li class="post-action"><a class="post-action-btn btn btn--default tooltip--top" href="<?php echo get_permalink($prev_post->ID);?>" data-tooltip="<?php echo $prev_post->post_title;?>"><i class="fa fa-angle-left"></i><span class="hide-xs hide-sm text-small ml">前篇</span></a></li>
<?php endif;?> 
<?php
	$next_post = get_next_post();
	if(!empty($next_post)):?>
		<li class="post-action">
						<a class="post-action-btn btn btn--default tooltip--top" href="<?php echo get_permalink($next_post->ID);?>" data-tooltip="<?php echo $next_post->post_title;?>"><span class="hide-xs hide-sm text-small icon-mr">后篇</span><i class="fa fa-angle-right"></i></a></li>
<?php endif;?>
					</ul>
				</nav>
				<ul class="post-actions post-action-share">
						<li class="post-action hide-lg hide-md hide-sm">
						<a class="post-action-btn btn btn--default btn-open-shareoptions" href="#btn-open-shareoptions">
						<i class="fa fa-share-alt"></i>
						</a>
						</li>
						<li class="post-action hide-xs">
						<a class="post-action-btn btn btn--default" target="_blank" data-tooltip="分享至Google" href="https://plus.google.com/share?url=<?php the_permalink(); ?>">
						<i class="fa fa-google-plus"></i>
						</a>
						</li>
						<li class="post-action hide-xs">
						<a class="post-action-btn btn btn--default tooltip--top" target="new" data-tooltip="分享至QQ空间" href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?php the_permalink(); ?>/&title=<?php the_title(); ?>&site=<?php bloginfo('name'); ?>/&pics=<?php the_permalink(); ?>&logo=https://api.ikmoe.com/moeu-rand-background.php">
						<i class="fa fa-qq"></i>
						</a>
						</li>
						<li class="post-action hide-xs">

						<a class="post-action-btn btn btn--default" target="new" data-tooltip="分享至新浪微博" href="http://service.weibo.com/share/share.php?url=<?php the_permalink(); ?>/&appkey=<?php bloginfo('name'); ?>/&title=<?php the_title(); ?>&pic=<?php the_permalink(); ?>&logo=https://api.ikmoe.com/moeu-rand-background.php">
						<i class="fa fa-weibo"></i>
						</a>
						</li>
						<li class="post-action">
						<a class="post-action-btn btn btn--default" href="#disqus_thread">
						<i class="fa fa-comment-o"></i>
						</a>
						</li>
						<li class="post-action">
						<a class="post-action-btn btn btn--default" href="#" onclick="gotoTop();return false;">
						<i class="fa fa-arrow-up"></i>
						</a></li>
					</ul>
			</div>
		</div>
		<div id="share-options-bar" class="share-options-bar" data-behavior="1">
			<ul class="share-options">
        <li class="share-option">
            <a class="share-option-btn" target="new" href="http://service.weibo.com/share/share.php?url=<?php the_permalink(); ?>/&appkey=<?php bloginfo('name'); ?>/&title=<?php the_title(); ?>&pic=https://api.ikmoe.com/moeu-rand-background.php">
                 <i class="fa fa-weibo"></i><span class="">Share on 新浪微博</span>
            </a>
        </li>
     
        <li class="share-option">
            <a class="share-option-btn" target="new" href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>&site=<?php bloginfo('name'); ?>/&pics=https://api.ikmoe.com/moeu-rand-background.php">
                <i class="fa fa-qq"></i><span>Share on QQ空间</span>
            </a>
        </li><li class="share-option">
            <a class="share-option-btn" target="new" href="https://plus.google.com/share?url=<?php the_permalink(); ?>">
                <i class="fa fa-google-plus"></i><span>Share on Google</span>
            </a>
        </li>
    </ul>
</div>
		<div id="share-options-mask" class="share-options-mask">
		</div>
	</div>
</div>
<div id="about">
	<div id="about-card">
		<div id="about-btn-close">
			<i class="fa fa-remove"></i>
		</div>
		<a href="<?php bloginfo('url'); ?>/wp-login.php" target="_blank"><img id="about-card-picture" src="<?php bloginfo('template_url'); ?>/image/avatar.jpg"/></a>
		<h4 id="about-card-name">  <?php the_author_posts_link(); ?></h4>
		<h5 id="about-card-bio">
		<p>
			<?php bloginfo('description'); ?>
		</p>
		<script language="javascript">
function show_date_time(){window.setTimeout("show_date_time()",1e3);var BirthDay=new Date("<?php echo acg( 'acg_cl'); ?>"),today=new Date,timeold=today.getTime()-BirthDay.getTime(),msPerDay=864e5,e_daysold=timeold/msPerDay,daysold=Math.floor(e_daysold),e_hrsold=24*(e_daysold-daysold),hrsold=Math.floor(e_hrsold),e_minsold=60*(e_hrsold-hrsold),minsold=Math.floor(60*(e_hrsold-hrsold)),seconds=Math.floor(60*(e_minsold-minsold));span_dt_dt.innerHTML=daysold+"天"+hrsold+"小时"+minsold+"分"+seconds+"秒"}
show_date_time();
		</script>
	</div>
</div>
<div id="cover"style="background-image:url('<?php bloginfo('template_url'); ?>/image/bg.jpg');">
</div>
<!--- 简繁转换开始 --->
<script>
var defaultEncoding = 2; // 1: 繁體, 2: 简体
var translateDelay = 0; //延迟时间,若不在前, 要设定延迟翻译时间, 如100表示100ms,默认为0
var cookieDomain = "http://acglifan.me/blog/";
</script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/cn_tw.js"></script>
<!--- 简繁转换结束 --->
<script>
document.body.addEventListener('copy', function (e) {
    if (window.getSelection().toString() && window.getSelection().toString().length > 42) {
        setClipboardText(e);
     notie({
  type: 'info',
  text: '商业转载请联系作者获得授权，非商业转载请注明出处，谢谢合作。',
  autoHide: true
})
    }
}); 
function setClipboardText(event) {
    var clipboardData = event.clipboardData || window.clipboardData;
    if (clipboardData) {
        event.preventDefault();
        var htmlData = ''
            + '著作权归作者所有。<br>'
            + '商业转载请联系作者获得授权，非商业转载请注明出处。<br>'
            + '作者：<?php the_author(); ?><br>'
            + '链接：' + window.location.href + '<br>'
            + '来源：<?php bloginfo('url'); ?>/<br><br>'
            + window.getSelection().toString();
        var textData = ''
            + '著作权归作者所有。\n'
            + '商业转载请联系作者获得授权，非商业转载请注明出处。\n'
            + '作者：<?php the_author(); ?>\n'
            + '链接：' + window.location.href + '\n'
            + '来源：<?php bloginfo('url'); ?>/\n\n'
            + window.getSelection().toString();
        clipboardData.setData('text/html', htmlData);
        clipboardData.setData('text/plain',textData);
    }
}
</script>
<!--SCRIPTS-->
<script src="<?php bloginfo('template_url'); ?>/js/script.min.js" type="text/javascript"></script>
<!--PANGU AUTO SPACE-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pangu/3.0.0/pangu.min.js"></script>
<script> pangu.spacingPage(); </script>
<!--PANGU AUTO SPACE END-->
<script src="<?php bloginfo('template_url'); ?>/js/kz.js" type="text/javascript"></script>
<script type="text/javascript">
        $(document).ready(function(){ 
            $('.tag sx').replaceWith('<a class="category-link"><?php
$category = get_the_category();
if($category[0]){
echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
}
?></a></div>'); 
        });  
    </script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/bga.min.js"></script>
<div class="search_form">
	<form method="post" class="sosuo">
		<input class="search_key" name="s" autocomplete="off" placeholder="Enter search keywords..." type="text" value="" required="required">
		<button type="submit" class="submit"><i class="fa fa-lg fa-search" id="bt"></i></button>
	</form>
	<span class="search_close"><i class="fa fa-close" id="close"></i></span>
</div>
<?php wp_footer(); ?>
</body>
</html>