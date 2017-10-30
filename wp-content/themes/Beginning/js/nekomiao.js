(function ($, document, window, args) {
    $(function () {
        $('#侧边栏隐藏').bind('click', function () {
            // 隐藏侧边
            var R = document.getElementById("sidebar");
            var L = document.getElementById("container");

            if (L.className == "container") {
                $("#sidebar").hide("slow");
                L.className = "";
            } else {
                $("#sidebar").show("slow");
                L.className = "container";
            }

        })

        var now = new Date();
        var KeepTime = setInterval(function () {
            var grt = new Date("08/23/2017 00:00:00");
            /*此处修改你的建站时间或者网站上线时间*/
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
            document.getElementById("timeDate").innerHTML = " "+ dnum + "天 ";
            document.getElementById("times").innerHTML = hnum + "小时" + mnum + "分" + snum + "秒";
        }, 250);

    });
})(jQuery, document, window, theme_base_args);