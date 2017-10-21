			<footer id="footer" class="main-content-wrap">
			<span class="copyrights"> 博客已萌萌哒运行<span id="span_dt_dt"></span><br>
 &copy; 2016 <?php bloginfo('name'); ?> /
 Power By 
			<a target="_blank" href="http://wordpress/">WordPress</a> 
/ Designed By 
			<a target="_blank" href="http://qqdie.com/">Jrotty</a>
<div style="display:none">
<?php echo acg( 'acg_zztj'); ?>
</div>
			</span>
			</footer>
		</div>
	</div>
</div>
<div id="about">
	<div id="about-card">
		<div id="about-btn-close">
			<i class="fa fa-remove"></i>
		</div>
		<a href="<?php bloginfo('url'); ?>/wp-admin/" title="Aerry" target="_blank">
		<img id="about-card-picture" src="<?php bloginfo('template_url'); ?>/image/avatar.jpg"/></a>
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
<!--SCRIPTS-->
<script src="<?php bloginfo('template_url'); ?>/js/script.min.js" type="text/javascript"></script>
<!--PANGU AUTO SPACE-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pangu/3.0.0/pangu.min.js"></script>
<script> pangu.spacingPage(); </script>
<!--PANGU AUTO SPACE END-->
<script src="<?php bloginfo('template_url'); ?>/js/kz.js" type="text/javascript"></script>
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