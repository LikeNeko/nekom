<?php
if (is_home()) { //判断当前页面是否为首页
    echo '
<meta http-equiv="x-dns-prefetch-control" content="on" />
<link rel="dns-prefetch" href="//bdimg.share.baidu.com/" />
<link rel="dns-prefetch" href="//api.share.baidu.com/" />
<link rel="dns-prefetch" href="//hm.baidu.com/" />
<link rel="dns-prefetch" href="//0.gravatar.com/" />
<link rel="dns-prefetch" href="//1.gravatar.com/" />
 ';
} elseif (isset($_COOKIE['v7v3_cookie'])) { //判断是否为初次访问
    echo '<meta name="author" content="WordPress Dns Prefetch Is By NaiZui" />';
} else {
    echo '
<meta http-equiv="x-dns-prefetch-control" content="on" />
<link rel="dns-prefetch" href="//bdimg.share.baidu.com/" />
<link rel="dns-prefetch" href="//api.share.baidu.com/" />
<link rel="dns-prefetch" href="//hm.baidu.com/" />
<link rel="dns-prefetch" href="//0.gravatar.com/" />
<link rel="dns-prefetch" href="//1.gravatar.com/" />
    ';
}
?>