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

/*http://sc.chinaz.com/jiaobendemo.aspx?downloadid=6201712525383*/
/* alert插件 */
(function(){var zIndex=1000;var jqueryAlert=function(opts){var opt={"style":"wap","title":"","icon":"","content":"","contentTextAlign":"center","width":"auto","height":"auto","minWidth":"0","className":"","position":"fixed","animateType":"scale","modal":false,"isModalClose":false,"bodyScroll":false,"closeTime":3000,"buttons":{},};var option=$.extend({},opt,opts);var dialog={};dialog.time=450;dialog.init=function(){dialog.framework()};function IsPC(){var userAgentInfo=navigator.userAgent;var Agents=["Android","iPhone","SymbianOS","Windows Phone","iPad","iPod"];var flag=true;for(var v=0;v<Agents.length;v++){if(userAgentInfo.indexOf(Agents[v])>0){flag=false;break}}return flag}var isHaveTouch=IsPC();if(isHaveTouch){dialog.event="click"}else{dialog.event="touchstart"}var $modal=$("<div class='alert-modal'>");var $container=$("<div class='alert-container animated'>");var $title=$("<div class='alert-title'>"+option.title+"</div>");var $content=$("<div class='alert-content'>");var $buttonBox=$("<div class='alert-btn-box'>");var $closeBtn=$("<div class='alert-btn-close'>×</div>");if(!!option.content[0]&&(1==option.content[0].nodeType)){var $newContent=option.content.clone();$content.append($newContent)}else{$content.html(option.content)}dialog.framework=function(){dialog.buttons=[];for(var key in option.buttons){dialog.buttons.push(key)}dialog.buttonsLength=dialog.buttons.length;$container.append($title).append($content);if(option.style=="pc"){$container.append($closeBtn).addClass("pcAlert")}if(option.modal||option.modal=="true"){$("body").append($modal);option.bodyScroll&&$("body").css("overflow","hidden")}$("body").append($container);$content.css({"text-align":option.contentTextAlign});if(parseInt(option.minWidth)>parseInt($container.css("width"))){option.width=option.minWidth}$modal.css("position",option.position);$modal.css("z-index",zIndex);++zIndex;if(option.position=="fixed"){$container.css({"position":option.position,"left":"50%","top":"50%","z-index":zIndex,})}if(option.position=="absolute"){$container.css({"position":option.position,"left":$(window).width()/2,"top":$(window).height()/2+$(window).scrollTop(),"z-index":zIndex,})}$container.css("width",option.width);$container.css("height",option.height);if(option.width=="auto"){$container.css("width",$container[0].clientWidth+10)}if(parseInt($(window).height())<=parseInt($container.css("height"))){$container.css("height",$(window).height())}(!!option.className)&&$container.addClass(option.className);for(var key in option.buttons){var $button=$("<p class='alert-btn-p'>"+key+"</p>");if(option.style!="pc"){$button.css({"width":Math.floor(($container[0].clientWidth)/dialog.buttonsLength),})}$button.bind(dialog.event,option.buttons[key]);$buttonBox.append($button)}if(dialog.buttonsLength>0){$container.append($buttonBox);$content.css("padding-bottom","46px");if(window.navigator.userAgent.indexOf("MSIE")>=1){if($content[0].scrollHeight>$content[0].clientHeight){$content.css("height",parseInt($content.css("height"))-46)}}}if(option.title!=""){$content.css("padding-top","42px")}if(dialog.buttonsLength<=0&&option.title==""){$container.addClass("alert-container-black");if(!!option.icon){var img=new Image();img.onload=function(){$content.before(img)};img.src=option.icon;$(img).css({"width":"45px","height":"auto","display":"block","margin":"10px auto 0 auto"});$content.css({"padding-top":"5px"})}}$container.css({"margin-left":-parseInt($container.css("width"))/2,"margin-top":-parseInt($container.css("height"))/2,});if(option.animateType=="scale"){$container.addClass("bounceIn")}if(option.animateType=="linear"){$container.addClass("linearTop")}isSelfClose()};function isSelfClose(){if(dialog.buttonsLength<=0&&option.style!="pc"){setTimeout(function(){$container.fadeOut(300);$modal.fadeOut(300);option.bodyScroll&&$("body").css("overflow","auto")},option.closeTime)}}dialog.toggleAnimate=function(){if(option.animateType=="scale"){return $container.removeClass("bounceIn").addClass("bounceOut")}else{if(option.animateType=="linear"){return $container.removeClass("linearTop").addClass("linearBottom")}else{return $container}}};dialog.close=function(){dialog.toggleAnimate().fadeOut(dialog.time);$modal.fadeOut(dialog.time);option.bodyScroll&&$("body").css("overflow","auto")};option.style=="pc"&&$closeBtn.bind(dialog.event,dialog.close);option.isModalClose&&$modal.bind(dialog.event,dialog.close);dialog.destroy=function(){dialog.toggleAnimate().fadeOut(dialog.time);setTimeout(function(){$container.remove();$modal.remove();option.bodyScroll&&$("body").css("overflow","auto")},dialog.time)};dialog.show=function(){$modal.css("z-index",zIndex);++zIndex;$container.css({"z-index":zIndex,});if(option.animateType=="scale"){$container.fadeIn().removeClass("bounceOut").addClass("bounceIn")}else{if(option.animateType=="linear"){$container.fadeIn().removeClass("linearBottom").addClass("linearTop")}else{$container.fadeIn()}}if(option.position=="absolute"){$container.css({"top":$(window).height()/2+$(window).scrollTop(),})
}$modal.fadeIn();option.bodyScroll&&option.modal&&$("body").css("overflow","hidden");isSelfClose()};dialog.init();return dialog};if(typeof module!=="undefined"&&typeof exports==="object"){module.exports=jqueryAlert}else{if(typeof define==="function"&&(define.amd||define.cmd)){define(function(){return jqueryAlert})}else{this.jqueryAlert=jqueryAlert}}}).call(function(){return this||(typeof window!=="undefined"?window:global)}());

/* 隐藏header */
var agent = navigator.userAgent;
if (/.*Firefox.*/.test(agent)) {
    document.addEventListener("DOMMouseScroll", function(e) {
        e = e || window.event;
        var detail = e.detail;
        if (detail > 0) {
            headerShow()
        } else {
            headerHide()
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
            getIp();
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
         * 页面打开时触发
         */

        function getIp() {
            $.getJSON('/system/getIpInfo.php',{},function (e) {
                // var data = JSON.parse(e.data);
                if(e){
                    console.log('%c server %c 获取当前ip信息:%s %c%s',"background:#24272A; color:#ffffff",'',e.country+e.region+e.city,'color:green','[√]');

                    jqueryAlert({
                        'content' : e.msg,
                        'closeTime' : 2000,
                    }).show()
                }

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
            log('与终端服务器建立连接','已连接');
            ws.send('{"type":"getOnline"}');

        };
        ws.onmessage = function(e) {
            log('接受到服务器的信息',e.data);
            var data = JSON.parse(e.data);

            switch (data.type){
                case 'online':
                    $('.count_online_num').html(data.num);
                    break;
            }

        };
        ws.onerror = function () {
            elog('服务器连接失败','websocket连接失败')
        }


    })
    function log(tmp,val) {
        console.log('%c server %c '+tmp+':%s --%c%s',"background:#24272A; color:#ffffff",'',val,'color:green','[√]');
    }
    function elog(tmp,val) {
        console.error('%c server %c '+tmp+':%s --%c%s',"background:#24272A; color:#ffffff",'',val,'color:red','[X]')
    }
})(jQuery, document, window, theme_base_args);