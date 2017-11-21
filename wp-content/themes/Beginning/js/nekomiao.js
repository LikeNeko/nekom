(function ($, document, window, args) {
    $(function () {

        // 隐藏侧边
        $(document).on('click','.r-hide',function(){
            var R = $("#sidebar");
            if (R.attr('class') == "r-hide") {
                R.attr("class", '')
                $("#s-hide").html('隐藏侧边')
                R.show('slow');
            } else if (R.attr('class') == "") {
                R.attr("class", 'r-hide')
                $("#s-hide").html('显示侧边')
                R.hide("slow");
            }
        })
        var now = new Date();
        var KeepTime = setInterval(function () {
            var grt = new Date("08/23/2017 00:00:00");
            /* 此处修改你的建站时间或者网站上线时间 */
            now.setTime(now.getTime() + 250);
            days = (now - grt ) / 1000 / 60 / 60 / 24;
            dnum = Math.floor(days);
            hours = (now - grt ) / 1000 / 60 / 60 - (24 * dnum);
            hnum = Math.floor(hours);
            if (String(hnum).length == 1) {
                hnum = "0" + hnum;
            }
            minutes = (now - grt ) / 1000 / 60 - (24 * 60 * dnum) - (60 * hnum);
            mnum = Math.floor(minutes);
            if (String(mnum).length == 1) {
                mnum = "0" + mnum;
            }
            seconds = (now - grt ) / 1000 - (24 * 60 * 60 * dnum) - (60 * 60 * hnum) - (60 * mnum);
            snum = Math.round(seconds);
            if (String(snum).length == 1) {
                snum = "0" + snum;
            }
            document.getElementById("timeDate").innerHTML = " " + dnum + "天 ";
            document.getElementById("times").innerHTML = hnum + "小时" + mnum + "分" + snum + "秒";
        }, 250);

        /* 增加页面离开修改title */
        var OriginTitile = document.title;
        var titleTime;
        document.addEventListener('visibilitychange', function () {
            if (document.hidden) {
                document.title = '(つェ⊂)我藏好了哦~ ' + OriginTitile;

                clearTimeout(titleTime);
            }
            else {
                document.title = '(*´∇｀*) 被你发现啦~ ' + OriginTitile;
                titleTime = setTimeout(function () {
                    document.title = OriginTitile;
                }, 2000);
            }
        });

        /**
         * 缓存成应用
         *  if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('service-worker.js');
        };
         */
        /**
         * 百度自动提交
         */
        var bp = document.createElement('script');
        var curProtocol = window.location.protocol.split(':')[0];
        if (curProtocol === 'https') {
            bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
        }
        else {
            bp.src = 'http://push.zhanzhang.baidu.com/push.js';
        }
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(bp, s);
        /**
         *  链接复制
         */
        $(document).on("click",'#copy_url',function () {
            var text = $("#copy_url").attr("url-data");
            if (window.clipboardData) {
                window.clipboardData.setData("Text", text)
                alert("已经成功将原文链接复制到剪贴板！");
            } else {
                var x=prompt('你的浏览器可能不能正常复制\n请您手动进行：',text);
            }
            return false;
        })

        /**
         * 字号调整
         */
        $(document).on('click',".bigger, .smaller",function(){
            var thisEle = $(".context").css("font-size");
            var textFontSize = parseFloat(thisEle , 10);
            var unit = thisEle.slice(-2);
            var cName = $(this).attr("class");
            if(cName == "bigger"){
                textFontSize += 2;
            }else if(cName == "smaller"){
                textFontSize -= 2;
            }
            $(".context").css("font-size",  textFontSize + unit );
        });

        /**
         * 点击板块跳转
         */
        $(document).on("click",'.panel',function () {
            $(this).children("a").click();
        })

        /**
         * 点击a标签替换标题
         * */
        $(document).on("click",'.post-title a',function () {
            $(this).addClass('loading').text("正在努力加载中……");
            return false;
        })
    });

})(jQuery, document, window, theme_base_args);