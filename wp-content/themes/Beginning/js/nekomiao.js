/*弹框插件*/
(function($){
    $.fn.dailog = function(options,callBack){
        var _this = this;
        var defaultDailog = {
            width:              280,                    	  //宽度
            height:             'auto',                     //高度
            padding:            '10px 16px',                //padding
            title:              '提示!',                    //提醒信息
            discription:        '这是弹窗的描述!',          //描述
            borderRadius:       '4px',                      //圆角
            bottons:            ['确定','取消'],            //按钮信息
            maskBg:             'rgba(0,0,0,0.6)',          //遮罩层背景色
            dailogBg:           '#fff',                     //弹出框的背景色
            type:               'defalut',                  //类型 defalut primary   success  danger  warning
            zIndex:             '10000011',                 //层级
            hideScroll: 	  	  false, 					  //是否关闭滚动条
            isBtnHasBgColor: 	  true, 					  //确定  取消按钮是否有背景色
            showBoxShadow: 	  false, 					  //弹窗是否显示boxshadow
            animateStyle: 	  'fadeInNoTransform',	   	  //进入的效果
            isInput: 			  false, 					  //是否显示输入框
            inputPlaceholder:   '填写相关内容', 			  //文本输入提示框
        };

        var opt = $.extend(defaultDailog,options||{});

        // 设置btn是否有颜色
        var btn_className = opt.isBtnHasBgColor?'':'no_bg';

        // 点击的索引
        var btnIndex = '';

        if($('.cpt_mask_dailog').length){
            return;
        };

        var _isScroll = function(){
            if(opt.hideScroll){
                $('body,html').css({
                    overflow:'hidden',
                });
            }
        }

        var _colseScroll = function(){
            $('body,html').css({
                overflow:'auto',
            });
        }

        var _overflowBtn = function(){
            // bottons超过两个提示
            if(opt.bottons.length>2){
                $dw.showMessage('按钮的最多显示上限不超过2个',3000,false);
            }
        }

        var _isBoxShadow = function(){
            // 是否显示boxshadow
            if(!opt.showBoxShadow){
                _this.dailog_div.addClass('no_boxShadow');
            };
        }

        var _btnIndex = function(name){
            //获取点击的索引
            var btnName = name || '';
            for(var i = 0;i<opt.bottons.length;i++){
                if(btnName === opt.bottons[i]){
                    btnIndex = i;
                }
            }
        }

        var _init = function(){
            _this.dailog_mask = $("<div class='"+opt.animateStyle+" animated cpt_mask_dailog "+opt.type+"'></div>").css({
                'background':opt.maskBg,
                'z-index':opt.zIndex,
            }).appendTo($('body'));

            _isScroll();
            // 判断按钮是否超出两个
            _overflowBtn();

            _this.dailog_div = $("<div class='div_dailog'></div>").css({
                'width':opt.width,
                'height':opt.height,
                'background':opt.dailogBg,
                '-moz-border-radius':opt.borderRadius,
                '-webkit-border-radius':opt.borderRadius,
                'border-radius':opt.borderRadius,
                'padding':opt.padding,
            }).appendTo(_this.dailog_mask);

            _this.title_dailog = $("<div class='title_dailog'></div>").html(opt.title).appendTo(_this.dailog_div);

            if(!opt.isInput){
                _this.discription_dailog = $("<div class='discription_dailog'></div>").html(opt.discription).appendTo(_this.dailog_div);
            }else{
                _this.discription_dailog = $("<div class='discription_dailog'></div>").css({
                    'text-indent':0,
                }).appendTo(_this.dailog_div);
                _this.input_dailog = $("<input type='text' class='dailog_input' placeholder="+opt.inputPlaceholder+">").appendTo(_this.discription_dailog);
            }

            _this.dailog_divOperation = $("<div class='dailog_divOperation'></div>").appendTo(_this.dailog_div);

            if(!(opt.bottons.length === 2)){
                _this.firstBtn = $("<span class='btn_span "+btn_className+"'></span>").html(opt.bottons[0]).attr({'data-name':opt.bottons[0]}).appendTo(_this.dailog_divOperation);
            }else{
                _this.firstBtn = $("<span class='btn_span "+btn_className+"'></span>").html(opt.bottons[0]).attr({'data-name':opt.bottons[0]}).appendTo(_this.dailog_divOperation);
                _this.secondBtn = $("<span class='btn_span "+btn_className+"'></span>").html(opt.bottons[1]).attr({'data-name':opt.bottons[1]}).appendTo(_this.dailog_divOperation);
            }

            //是否显示boxshadow
            _isBoxShadow();
        }

        _init();

        //关闭点击和触摸的默认事件
        _this.dailog_mask.on('click',function(e){
            e.stopPropagation();
            e.preventDefault();
        });

        _this.dailog_mask.on('touchmove',function(e){
            e.stopPropagation();
            e.preventDefault();
        });


        // 点击的回调
        _this.dailog_divOperation.children().on('click',function(e){
            var name = $(this).attr('data-name');
            //获取点击的索引
            // _this.bottonIndex(name);
            _btnIndex(name);

            var inputstatus = _this.input_dailog? 1:0;
            var inputvalue = inputstatus? _this.input_dailog.val():'';

            // 设置返回值
            var ret = {
                index:btnIndex,
                input:{
                    status:inputstatus,
                    value:inputvalue,
                }
            };

            _colseScroll();

            //未写回调函数则不会有效果
            if(typeof(callBack) === 'function'){
                //执行回调函数
                callBack(ret);
            }
            _this.dailog_mask.remove();
        });

        return _this;
    };

})(jQuery);

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



    });

})(jQuery, document, window, theme_base_args);