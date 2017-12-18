<?php /*
    Template Name: 说说
    author: 秋叶
    url: http://www.mizuiren.com/141.html
    */
get_header(); ?>
<section id="container">
    <div class="row">
        <article id="post-box" itemscope itemtype="http://schema.org/Article" <?php post_class( 'span12' ); ?>>
            <div class="panel">
                <header class="panel-header">
                    <div class="post-meta-box">
                        <?php
                        if ( Bing_mpanel( 'breadcrumbs' ) )
                            Bing_Breadcrumbs::output();
                        ?>
                    </div>
                </header>
                <section class="context">
                    <ul class="cbp_tmtimeline">
                    <?php query_posts("post_type=shuoshuo&post_status=publish&posts_per_page=-1");if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <li> <span class="shuoshuo_author_img"><img src="https://i.nekom.cc/wp-content/uploads/2017/08/cropped-84be870c156b65500df3e32b.jpg" class="avatar avatar-48" width="48" height="48"></span>
                        <a class="cbp_tmlabel" href="javascript:void(0)">
                            <p></p>
                            <p><?php the_title(); ?><?php the_content();?></p>
                            <p></p>
                            <p class="shuoshuo_time"><i class="fa fa-clock-o"></i>
                                <?php the_time('Y年n月j日G:i'); ?>
                            </p>
                        </a>
                        <?php endwhile;endif; ?>
                    </li>
                    </ul>
                </section>
            </div>
        </article>
    </div>
</section>

<script type="text/javascript">
        $(function () {
            var oldClass = "";
            var Obj = "";
            $(".cbp_tmtimeline li").hover(function () {
                Obj = $(this).children(".shuoshuo_author_img");
                Obj = Obj.children("img");
                oldClass = Obj.attr("class");
                var newClass = oldClass + " zhuan";
                Obj.attr("class", newClass);
            }, function () {
                Obj.attr("class", oldClass);
            })
        })
    </script>

<?php get_footer();?>
