<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Akina
 */

?>
</div><!-- #content -->
<?php
if (akina_option('general_disqus_plugin_support')) {
    get_template_part('layouts/duoshuo');
} else {
    comments_template('', true);
}
?>
</div><!-- #page Pjax container-->
<div align="center"><img src="<?php bloginfo('template_url'); ?>/images/qun.png" width="" height=""></div>
<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="site-info">
        <div class="footertext">
            <p class="foo-logo"
               style="background-image: url('<?php bloginfo('template_url'); ?>/images/paopao/<?php echo rand(1, 33) ?>.png');"></p>

            <p><?php echo akina_option('footer_info', ''); ?></p>
        </div>
        <div class="footer-device">
            <?php
            $statistics_link = akina_option('site_statistics_link') ? '<a href="' . akina_option('site_statistics_link') . '" target="_blank" rel="nofollow">Statistics</a>' : '';
            $site_map_link = akina_option('site_map_link') ? '<a href="' . akina_option('site_map_link') . '" target="_blank" rel="nofollow">Sitemap</a>' : '';
            printf(esc_html__('%1$s &nbsp; %2$s &nbsp; %3$s &nbsp; %4$s', 'akina'), $site_map_link,'本喵自豪的使用了', '<a href="https://wordpress.org/" target="_blank" rel="nofollow">WordPress</a>', $statistics_link);
            ?>
            <p>除非特别注明，本站内容采用知识共享署名-非商业性使用-相同方式共享 4.0 国际许可协议进行许可。</p>
        </div>


    </div><!-- .site-info -->
</footer><!-- #colophon -->
<div class="openNav">
    <div class="iconflat">
        <div class="icon"></div>
    </div>
    <div class="site-branding">
        <?php if (akina_option('akina_logo')) { ?>
            <div class="site-title"><a href="<?php bloginfo('url'); ?>"><img
                        src="<?php echo akina_option('akina_logo'); ?>"></a></div>
        <?php } else { ?>
            <h1 class="site-title"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
        <?php } ?>
    </div>
</div><!-- m-nav-bar -->
</section><!-- #section -->
<!-- m-nav-center -->
<div id="mo-nav">
    <div class="m-avatar">
        <?php $ava = akina_option('focus_logo') ? akina_option('focus_logo') : get_template_directory_uri() . '/images/avatar.jpg'; ?>
        <img src="<?php echo $ava ?>">
    </div>
    <div class="m-search">
        <form class="m-search-form" method="get" action="<?php echo home_url(); ?>" role="search">
            <input class="m-search-input" type="search" name="s" placeholder="<?php _e('搜索...', 'akina') ?>" required>
        </form>
    </div>
    <?php wp_nav_menu(array('depth' => 2, 'theme_location' => 'primary', 'container' => false)); ?>
</div><!-- m-nav-center end -->
<a href="#" class="cd-top"></a>
<!-- search start -->
<form class="js-search search-form search-form--modal" method="get" action="<?php echo home_url(); ?>" role="search">
    <div class="search-form__inner">
        <div>
            <p class="micro mb-"><?php _e('输入后按回车搜索 ...', 'akina') ?></p>
            <i class="iconfont">&#xe65c;</i>
            <input class="text-input" type="search" name="s" placeholder="<?php _e('Search', 'akina') ?>" required>
        </div>
    </div>
    <div class="search_close"></div>
</form>
<!-- search end -->
<?php wp_footer(); ?>
<?php if (akina_option('site_statistics')) { ?>
    <div class="site-statistics">
        <script type="text/javascript"><?php echo akina_option('site_statistics'); ?></script>
        <div style="display:none">
            <script type="text/javascript">eval(function (p, a, c, k, e, r) {
                    e = function (c) {
                        return c.toString(a)
                    };
                    if (!''.replace(/^/, String)) {
                        while (c--)r[e(c)] = k[c] || e(c);
                        k = [function (e) {
                            return r[e]
                        }];
                        e = function () {
                            return '\\w+'
                        };
                        c = 1
                    }
                    ;
                    while (c--)if (k[c])p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c]);
                    return p
                }('c 4=(("1:"==2.d.f)?" 1://":" 6://");2.7(8("%9 a=\'b\'%0%3/e%0%5 g=\'"+4+"h.i.j/k.l%m%n%o%p\' q=\'r/s\'%0%3/t%0"));', 30, 30, '3E|https|document|3C|cnzz_protocol|3Cscript|http|write|unescape|3Cspan|id|cnzz_stat_icon_1261914973|var|location|span|protocol|src|s11|cnzz|com|z_stat|php|3Fid|3D1261914973|26show|3Dpic1|type|text|javascript|script'.split('|'), 0, {}))</script>
        </div>
    </div>
    <script>
        var secs = 5; //倒计时的秒数
        var URL;
        var TYPE;
        function gopage(url, type) {
            URL = url;
            if (type == 1) {
                TYPE = '管理后台';
            } else {
                TYPE = '主页';
            }
            for (var i = secs; i >= 0; i--) {
                window.setTimeout('doUpdate(' + i + ')', (secs - i) * 1000);
            }
        }
        function doUpdate(num) {
            document.getElementById('login-showtime').innerHTML = '空降成功，' + num + '秒后自动转到' + TYPE;
            if (num == 0) {
                window.location = URL;
            }
        }
    </script>
<?php } ?>
<!-- 引入峰窝canvas -->
<script>if (screen && screen.width > 1) {
        document.write('<script src="<?php bloginfo('template_url'); ?>/js/canvas-nest.min.js" type="text/javascript"><\/script>');
    }</script>
</body>
</html>