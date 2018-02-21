# nekom.cc

## 个人博客

主要做了很多前端的一些优化，以及后端的备份之类的防护措施

## 缓存优化

- 后端：页面静态化到Memcache缓存
- HTTP浏览器缓存：图片的Memory Cache缓存
- JavaScript、Css ：合并以减少客户端请求次数。
- JavaScript：压缩代码
- HTML：压缩html代码
- 图片：采用延迟加载技术延迟加载图片，并配合ajax缓存图片

## 后端

- 脚本备份数据库
- 数据库主从复制
