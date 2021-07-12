<?php
/**
 * Content wrappers
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/wrapper-start.php.
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
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $woocommerce_loop, $gatsby_settings;

$woocommerce_columns = $gatsby_settings['shop-product-cols'];

if ( gatsby_is_product_category() ) {
	$woocommerce_columns = $gatsby_settings['category-product-cols'];
}

$overview_column_count = gatsby_get_meta_value('overview_column_count');

if ( !empty($overview_column_count) ) { $woocommerce_columns = $overview_column_count; }

$shop_view = $gatsby_settings['category-view-mode'];
$shop_layout = $gatsby_settings['product-type-layout'];
$shop_meta_view = gatsby_get_meta_value('shop_view');
$shop_meta_layout = gatsby_get_meta_value('shop_layout');

if ( !empty($shop_meta_view) ) {
	$shop_view = $shop_meta_view;
}

if ( !empty($shop_meta_layout) ) {
	$shop_layout = $shop_meta_layout;
}

$css_classes = array(
	'gt-products-holder',
	$shop_view, $shop_layout
);

if ( !empty( $woocommerce_columns ) ) { $css_classes[] = 'gt-cols-' . absint($woocommerce_columns); }

$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
?>

<?php if ( !gatsby_is_product() ): ?>
	<div class="<?php echo esc_attr( trim( $css_class ) ) ?>">
<?php endif; ?>
