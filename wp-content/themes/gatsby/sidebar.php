
<?php
// reset all previous queries
wp_reset_postdata();

global $gatsby_settings;
$post_id = gatsby_post_id();
$custom_sidebar = $gatsby_settings['sidebar'];

$page_sidebar = trim(mad_meta( 'gatsby_page_sidebar', '', $post_id));

if ( $page_sidebar ) {
	$custom_sidebar = $page_sidebar;
}

if ( is_singular() && !empty($post_id) ) {
	$custom_sidebar = $page_sidebar;
}

if ( gastby_is_realy_woocommerce_page() ) {

	$custom_sidebar = $gatsby_settings['product-sidebar'];

	if ( gatsby_is_product() ) {

		if ( !empty($post_id) ) {
			$custom_sidebar = $page_sidebar;
		}

		if ( empty($custom_sidebar) ) {
			$custom_sidebar = $gatsby_settings['product-sidebar'];
		}

	}

}

?>

<aside id="sidebar" class="col-md-3 col-sm-4 gt-sidebar">
	<?php
	if ( !empty($custom_sidebar) ) {
		dynamic_sidebar($custom_sidebar);
	} else {
		if ( is_active_sidebar('general-widget-area') ) {
			dynamic_sidebar('General Widget Area');
		} else {
		 ?>
			<div class="widget widget_archive">
				<h3 class="widget_title"><?php esc_html_e('Archives', 'gatsby'); ?></h3>
				<ul>
					<?php wp_get_archives('type=monthly'); ?>
				</ul>
			</div><!--/ .widget -->

			<div class="widget widget_meta">
				<h3 class="widget_title"><?php esc_html_e('Meta', 'gatsby'); ?></h3>
				<ul>
					<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
			</div><!--/ .widget -->
		<?php
		}
	}
	?>
</aside>


