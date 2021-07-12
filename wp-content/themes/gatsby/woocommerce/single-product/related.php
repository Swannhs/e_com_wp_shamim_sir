<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product, $woocommerce_loop, $gatsby_settings, $gatsby_config;

if ( !$gatsby_settings['product-related'] || $gatsby_config['sidebar_position'] != 'gt-no-sidebar' || empty( $product ) || ! $product->exists() ) {
	return;
}

$woocommerce_loop['columns'] = isset($gatsby_settings['product-related-cols']) ? absint($gatsby_settings['product-related-cols']) : 4;

if ( $related_products ) : ?>

	<div class="gt-content-element">

		<h3 class="gt-title-underline"><?php esc_html_e( 'Related Products', 'gatsby' ); ?></h3>

		<div class="gt-products-holder gt-offers gt-view-grid gt-cols-<?php echo esc_attr($woocommerce_loop['columns']) ?>">

			<?php woocommerce_product_loop_start(); ?>

			<?php foreach ( $related_products as $related_product ) : ?>

				<?php
				$post_object = get_post( $related_product->get_id() );

				setup_postdata( $GLOBALS['post'] =& $post_object );

				wc_get_template_part( 'content', 'product' ); ?>

			<?php endforeach; ?>

			<?php woocommerce_product_loop_end(); ?>

		</div>

	</div>

<?php endif;

wp_reset_postdata();
