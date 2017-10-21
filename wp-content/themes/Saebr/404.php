<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Akina
 */

?>

<!DOCTYPE html>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<html>
<meta charset="UTF-8">
<title>ページは存在しません</title>
<div align="center" style='font-family:"微软雅黑"'>
    <img src="<?php bloginfo('template_url'); ?>/images/404/404_<?php $arr=['1.jpg','2.jpg','3.png','4.jpg','def.jpg'];echo $arr[random_int(0,4)];?>" border="0" height=""/>
    <br>
    没有找到这个页面喵！<br />
    喵才不会提醒你，要看看是不是浏览器地址填错了呢！o(´^｀)o<br>
    <br>

    <audio src="<?php bloginfo('template_url'); ?>/images/404.mp3" controls="controls">
        <audio autoplay="autoplay">
           <source src="<?php bloginfo('template_url'); ?>/images/404.mp3" type="audio/mpeg"/>
        </audio>
        <a target="_blank" href="/"></a>
    </audio>

</div>
</div>
</footer>
</html>
