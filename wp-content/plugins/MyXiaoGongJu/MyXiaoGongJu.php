<?php
/*Plugin Name:  我的工具
Description: 这是我的一个小工具
Version: 0.1
Author: Neko
Author URI: https://www.nekomiao.cn
License: GPLv2
*/
?>
<?php
function my_check_xiaogongju(){
    //首先检测当前访问的是否是一个页面
    if( is_page() ) {
        echo "<script>alert(2)</script>";
        global $post;

        // 接着检测该页面是否有父级页面
        if ( $post->post_parent ){

            // 获取父级页面名单
            $parents = array_reverse( get_post_ancestors( $post->ID ) );

            // 获取最顶级页面
            return $parents[0];

        }

        // 返回ID  - 如果存在父级页面，就返回最顶级的页面ID，否则返回当前页面ID, or the current page if not
        return $post->ID;

    }
}

class MyXiaoGongJu extends WP_Widget {

    function __construct(){
        parent::__construct(
            // 小工具ID
            'MyXiaoGongJu',

            // 小工具名称
            __('我的小工具', 'tutsplus' ),

            // 小工具选项
            array (
                'description' => __( '这是我的一个小工具.', 'tutsplus' )
            )
        );
    }

    function form( $instance ) {

        $defaults = array(
            'depth' => '-1'
        );
        $depth = $instance[ 'depth' ];

        // markup for form 断开标记 ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'depth' ); ?>">Depth of list:</label>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'depth' ); ?>" name="<?php echo $this->get_field_name( 'depth' ); ?>" value="<?php echo esc_attr( $depth ); ?>">
        </p>

        <?php // 重新衔接
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance[ 'depth' ] = strip_tags( $new_instance[ 'depth' ] );
        return $instance;

    }
    // 所有使用这个小部件显示页面的都会执行下面的代码
    function widget( $args, $instance ) {
        // kick things off
        extract( $args );
        echo $before_widget;
        echo $before_title . 'In this section:' . $after_title;

        // run a query if on a page
        if ( is_page() ) {

            // run the tutsplus_check_for_page_tree function to fetch top level page
            $ancestor = my_check_xiaogongju();

            // set the arguments for children of the ancestor page
            $args = array(
                'child_of' => $ancestor,
                'depth' => $instance[ 'depth' ],
                'title_li' => '',
            );
            echo "<script>alert('$ancestor')</script>";
            // set a value for get_pages to check if it's empty
            $list_pages = get_pages( $args );

            // check if $list_pages has values
            if( $list_pages ) {

                // open a list with the ancestor page at the top
                ?>
                <ul class="page-tree">
                    <?php // list ancestor page ?>
                    <li class="ancestor">
                        <a href="<?php echo get_permalink( $ancestor ); ?>"><?php echo get_the_title( $ancestor ); ?></a>
                    </li>

                    <?php
                    // use wp_list_pages to list subpages of ancestor or current page
                    wp_list_pages( $args );;
                    // close the page-tree list
                    ?>
                </ul>

                <?php
            }
        }
    }

}
?>
<?php
// 注册小工具的钩子
function MyXiaoGongJu() {

    register_widget( 'MyXiaoGongJu' );


}
add_action( 'widgets_init', 'MyXiaoGongJu' );

?>
