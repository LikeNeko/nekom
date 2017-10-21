<?php /*
Template Name: 文章归档
*/ get_header();
?>
<script type="text/javascript" src="http://lib.sinaapp.com/js/jquery/1.4.2/jquery.min.js"></script>
<div id="main" data-behavior="1" 
 class="hasCoverMetaIn">
    <section class="boxes"  id="disqus_thread">
<?php zww_archives_list(); ?>
</section>  
</div> 
<script type="text/javascript">jQuery(document).ready(function($){
 //===================================存档页面 jQ伸缩
     (function(){
         $('#al_expand_collapse,#archives span.al_mon').css({cursor:"s-resize"});
         $('#archives span.al_mon').each(function(){
             var num=$(this).next().children('li').size();
             var text=$(this).text();
             $(this).html(text+'<em> ( '+num+' 篇文章 )</em>');
         });
         var $al_post_list=$('#archives ul.al_post_list'),
             $al_post_list_f=$('#archives ul.al_post_list:first');
         $al_post_list.hide(1,function(){
             $al_post_list_f.show();
         });
         $('#archives span.al_mon').click(function(){
             $(this).next().slideToggle(400);
             return false;
         });
         $('#al_expand_collapse').toggle(function(){
             $al_post_list.show();
         },function(){
             $al_post_list.hide();
         });
     })();
 });</script>            
<?php get_footer(); ?>