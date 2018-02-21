</div>
<?php Bing_banner_span12( 'footer' ); ?>
</div>
<!--蒲公英-->
<div class="dandelion">
    <span class="smalldan"></span>
    <span class="bigdan"></span>
</div>

<footer id="footer">
    <div class="box-md">
        <?php if ( Bing_mpanel( 'footer_menu' ) ): ?>
            <nav class="menu footer-menu-box" role="navigation" itemscope
                 itemtype="http://schema.org/SiteNavigationElement">
                <span class="menu-title"><span
                            class="dashicons dashicons-menu"></span><?php echo Bing_menu_name( 'footer_menu' ); ?></span>
                <?php echo Bing_nav_menu( 'footer_menu' ); ?>
            </nav>
        <?php endif; ?>
        <p class="footer-left"><?php echo Bing_mpanel( 'footer_text_left' ); ?></p>
        <p class="footer-right"><?php echo Bing_mpanel( 'footer_text_right' ); ?></p>
    </div>
    <?php Bing_mobile_menu(); ?>
</footer>
</div>
<?php if ( Bing_mpanel( 'return_top' ) ): ?>

    <a class="cd-top" title="点我回到顶端哟o(*≧▽≦)ツ"  data-no-ajax ></a>
    <?php
endif;
wp_footer();
?>
</script>

<script type="text/javascript">
    if (window.console && window.console.log) {
        console.log("%c  Neko  %c","background:#24272A; color:#ffffff","","喵?被两脚兽发现惹！Σ( ° △ °|||)︴ ");
    }

</script>

<!--wp-compress-html-->
</body>
</html>
