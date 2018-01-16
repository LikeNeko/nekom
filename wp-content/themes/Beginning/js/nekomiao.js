/*逐字打印效果插件 */
(function ( $ ) {
    $.fn.lbyl = function( options ) {

        var s = $.extend({
            content: '',
            speed: 10,
            type: 'fade',
            fadeSpeed: 500,
            finished: function(){}
        }, options );

        var elem = $(this),
            letterArray = [],
            lbylContent = s.content,
            count = $(this).length;

        elem.empty();
        elem.attr('data-time', lbylContent.length * s.speed)

        for (var i = 0; i < lbylContent.length; i++) {
            letterArray.push(lbylContent[i]);
        }

        $.each(letterArray, function(index, value) {
            elem.append('<span style="display: none;">' + value + '</span>');

            setTimeout(function(){
                if (s.type == 'show') {
                    elem.find('span:eq(' + index + ')').show();
                } else if (s.type == 'fade') {
                    elem.find('span:eq(' + index + ')').fadeIn(s.fadeSpeed);
                }
            }, index * s.speed);

        });

        setTimeout(function(){
            s.finished();
        }, lbylContent.length * s.speed);

    };

}( jQuery ));

/*判断是不是手机端*/
var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i) ? true : false;
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i) ? true : false;
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i) ? true : false;
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i) ? true : false;
    },
    any: function() {
        return (this.Android() || this.BlackBerry() || this.iOS() || this.Windows());
    }
};

/* 隐藏header */
var agent = navigator.userAgent;
if (/.*Firefox.*/.test(agent)) {
    document.addEventListener("DOMMouseScroll", function(e) {
        e = e || window.event;
        var detail = e.detail;
        if (detail > 0) {
            // $("#header").css('display','none');
            $("#header").animate({'top': '100px'}, "slow");
        } else {
            $("#header").css('display','block');

        }
    });
} else {
    document.onmousewheel = function(e) {
        e = e || window.event;
        var wheelDelta = e.wheelDelta;
        if (wheelDelta > 0) {
                headerShow();


        } else {

                headerHide();
            

        }
    }
}

function headerShow() {
    // $("#header").css('display','block');
    $("#header").animate({
        opacity: 'show'
    }, 600,function () {
        $(".toc_widget").css({
            top:'100px'
        });
        $(".site_info").css({
            top:'100px'
        });
    });
}
function headerHide() {
    // $("#header").css('display','none');
    $("#header").animate({
        opacity: 'hide'
    }, 600,function () {
        $(".toc_widget").css({
            top:'2px'
        });
        $(".site_info").css({
            top:'2px'
        });
    });
}

(function ($, document, window, args) {
    AOS.init({
        offset: 100,
        duration: 600,
        easing: "ease-out-back",
        delay: 100,
    });

    $(function () {

        // 隐藏侧边
        $(document).on('click','.r-hide',function(){
            var R = $("#sidebar");
            if (R.attr('class') == "r-hide") {
                R.attr("class", '')
                $("#s-hide").html('隐藏侧边')
                $(".context").css('font-size','14px');
                R.show('slow');
            } else if (R.attr('class') == "") {
                R.attr("class", 'r-hide')

                $(".context").css('font-size','20px');
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
        // $(document).on("click",'.panel',function () {
        //     $(this).children("a").click();
        // })

        /**
         * 一言
         */
        if( ! isMobile.any()){
            yiyan();
            setInterval(function () {
                yiyan();
            },10000)
        }
        function yiyan() {
            $.get("https://api.lwl12.com/hitokoto/main/get",{},function (data) {
                var s_str = data;
                if(data.length>=50){
                   s_str = s_str.substring(0,50)+'...';
                }
                $('.info').lbyl({
                    content:s_str,
                    speed: 150,
                    type: 'fade',
                    fadeSpeed: 500
                })
                
            })
        }

        /**
         * 小部件优化 跟随滚动,bug首页时获取不到toc_widget，临时解决办法。
         */
        var elementPosition = 1065;
        if($(".toc_widget").html()){
            elementPosition= $('.toc_widget').offset().top;
        }

        var objWidth = $('#sidebar').width();

        $(window).scroll(function(){
            if($(window).scrollTop() > elementPosition){
                $('.toc_widget').css('position','fixed').css('width',objWidth);
            } else {
                $('.toc_widget').css('position','static');
            }
        });




    });
    $(function () {

        ws = new WebSocket("wss://i.nekom.cc:2333");

        ws.onopen = function() {
            console.log('%c server %c 与终端服务器建立连接……%c%s',"background:#24272A; color:#ffffff",'','color:green','[√]');
            ws.send('{"type":"getOnline"}');

        };
        ws.onmessage = function(e) {
            console.log('%c server %c 接受到服务器的信息:%s --%c%s',"background:#24272A; color:#ffffff",'',e.data,'color:green','[√]');
            var data = JSON.parse(e.data);

            switch (data.type){
                case 'online':
                    $('.count_online_num').html(data.num);
                    break;
            }

        };
        ws.onerror = function () {
            console.error('服务器连接失败……%c%s','color:red','[X]')
        }


    })
})(jQuery, document, window, theme_base_args);