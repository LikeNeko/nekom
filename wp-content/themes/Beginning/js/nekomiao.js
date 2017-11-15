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


    });
})(jQuery, document, window, theme_base_args);