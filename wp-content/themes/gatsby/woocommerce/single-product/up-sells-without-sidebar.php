<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product, $woocommerce_loop, $gatsby_settings;

if ( !$gatsby_settings['product-upsells'] ) {
	return;
}

$limit = $gatsby_settings['product-upsells-count'] ? $gatsby_settings['product-upsells-count'] : 4;

$upsells = wc_products_array_orderby( array_filter( array_map( 'wc_get_product', $product->get_upsell_ids() ), 'wc_products_array_filter_visible' ), 'rand', 'desc');
$upsells = $limit > 0 ? array_slice( $upsells, 0, $limit ) : $upsells;
$woocommerce_loop['columns'] = isset($gatsby_settings['product-upsells-cols']) ? absint($gatsby_settings['product-upsells-cols']) : 4;

if ( $upsells ) : ?>

	<div class="gt-content-element">

		<h3 class="gt-title-underline"><?php esc_html_e( 'You may also like&hellip;', 'gatsby' ) ?></h3>

		<div class="gt-products-holder gt-offers gt-view-grid gt-cols-<?php echo esc_attr($woocommerce_loop['columns']) ?>">

			<?php woocommerce_product_loop_start(); ?>

			<?php foreach ( $upsells as $upsell ) : ?>

				<?php
				$post_object = get_post( $upsell->get_id() );

				setup_postdata( $GLOBALS['post'] =& $post_object );

				wc_get_template_part( 'content', 'product' ); ?>

			<?php endforeach; ?>

			<?php woocommerce_product_loop_end(); ?>

		</div>

	</div>

<?php endif;

wp_reset_postdata();
