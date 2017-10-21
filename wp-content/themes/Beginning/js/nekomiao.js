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

    });
} )( jQuery, document, window, theme_base_args );