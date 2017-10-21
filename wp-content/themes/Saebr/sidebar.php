<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Akina
 */

if ( ! is_active_sidebar( 'sidebar-left' ) ) {
	return;
}
?>
<aside id="secondary" class="widget-area" role="complementary">
	<div class="left">
		<?php dynamic_sidebar( 'sidebar-left' ); ?>
	</div>
</aside><!-- #secondary -->
