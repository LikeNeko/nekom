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

    <a href="#" class="cd-top"  data-no-ajax></a>
    <?php
endif;
wp_footer();
?>
</script>

<script type="text/javascript">
    if (window.console && window.console.log) {
        console.log("%c Neko  %c","background:#24272A; color:#ffffff","","喵?被两脚兽发现惹！Σ( ° △ °|||)︴ ");
    }
    
    /**
     * 右键复制追加版权
     */
    function addLink() {
        var body_element = document.body;
        var selection;
        selection = window.getSelection();
        if ( ! window.clipboardData) {
            var pagelink = "——出自[ 猫窝博客 ] ， 转载请保留原文链接: " + document.location.href + "";
            var copytext = selection + pagelink;
            var newdiv = document.createElement('div');
            newdiv.style.position = 'absolute';
            newdiv.style.left = '-99999px';
            body_element.appendChild(newdiv);
            newdiv.innerHTML = copytext;
            selection.selectAllChildren(newdiv);
            window.setTimeout(function () {
                body_element.removeChild(newdiv);
            }, 0);

        } else {
            /* Internet Explorer*/
            var pagelink = "\r\n\r\n原文出自[ 猫窝博客 ] 转载请保留原文链接: " + document.location.href + "";
            var copytext = selection + pagelink;
            window.clipboardData.setData("Text", copytext);
            return false;
        }
    }

    document.oncopy = function () {
        /*addLink();*/
    };
function getOs()
{
    var OsObject = "";
    if(navigator.userAgent.indexOf("MSIE")>0) {
        return "MSIE";
    }
    if(isFirefox=navigator.userAgent.indexOf("Firefox")>0){
        return "Firefox";
    }
    if(isSafari=navigator.userAgent.indexOf("Safari")>0) {
        return "Safari";
    }
    if(isCamino=navigator.userAgent.indexOf("Camino")>0){
        return "Camino";
    }
    if(isMozilla=navigator.userAgent.indexOf("Gecko/")>0){
        return "Gecko";
    }

}
switch (getOs()){
    case  'Firefox':
        if(localStorage.isShow == undefined){
            alert("检测到您的浏览器类型为:火狐\n当前博主未对该浏览器进行任何优化\n为给您以最优质的浏览体验，建议您使用\n谷歌浏览器、QQ浏览器等进行访问~\n本弹框仅在第一次访问时弹出。\n谢谢，祝您浏览愉快~");
            localStorage.isShow = 1;
        }
}


</script>
<!--wp-compress-html-->
</body>
</html>
