<?php
/**
 * Product loop sale flash
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/sale-flash.php.
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
	exit; // Exit if accessed directly
}

global $post, $product, $gatsby_settings;

?>
<?php if ( $product->is_on_sale() ) : ?>

	<?php if ( $gatsby_settings['product-sale'] ): ?>
		<?php echo apply_filters( 'woocommerce_sale_flash', '<div class="gt-label gt-sale">' . esc_html__( 'Sale!', 'gatsby' ) . '</div>', $post, $product ); ?>
	<?php endif; ?>

<?php endif; ?>

<?php if ( $product->is_featured() ) : ?>

	<?php if ( $gatsby_settings['product-featured'] ): ?>
		<?php echo apply_filters( 'woocommerce_featured_flash', '<div class="gt-label gt-featured">' . esc_html__( 'Featured!', 'gatsby' ) . '</div>', $post, $product ); ?>
	<?php endif; ?>

<?php endif; ?>

<?php if ( $gatsby_settings['product-new'] ): ?>
	<?php Gatsby_WC_Nb::woocommerce_show_product_loop_new_badge(); ?>
<?php endif; ?>

<?php if ( !$product->is_in_stock() ): ?>

	<?php if ( $gatsby_settings['product-stock'] ): ?>
		<?php $label = apply_filters( 'out_of_stock_add_to_cart_text', esc_html__( 'Out of stock', 'gatsby' ) ); ?>
		<?php printf( '<div class="gt-label gt-out-of-stock">%s</div>', $label ); ?>
	<?php endif; ?>

<?php endif; ?>



