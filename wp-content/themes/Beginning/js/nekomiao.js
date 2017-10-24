( function( $, document, window, args ){
    $(function() {
        $('#侧边栏隐藏').bind('click',function () {
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
        $("body").contextMenu({
            width: 110, // width
            itemHeight: 30, // 菜单项height
            bgColor: "#333", // 背景颜色
            color: "#fff", // 字体颜色
            fontSize: 12, // 字体大小
            hoverColor: "#fff", // hover字体颜色
            hoverBgColor: "#99CC66", // hover背景颜色
            target: function(ele) { // 当前元素--jq对象
                console.log(ele);
            },
            menu: [{ // 菜单项
                text: "新增",
                icon: "img/1.png",
                callback: function() {
                    alert("新增");
                }
            },
                {
                    text: "复制",
                    icon: "img/2.png",
                    callback: function() {
                        alert("复制");
                    }
                },
                {
                    text: "粘贴",
                    icon: "img/3.png",
                    callback: function() {
                        alert("粘贴");
                    }
                },
                {
                    text: "删除",
                    icon: "img/4.png",
                    callback: function() {
                        alert("删除");
                    }
                }
            ]

        });
    });
} )( jQuery, document, window, theme_base_args );