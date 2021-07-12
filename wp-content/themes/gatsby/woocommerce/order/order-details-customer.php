<?php
/**
 * Order Customer Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$show_shipping = ! wc_ship_to_billing_address_only() && $order->needs_shipping_address();
?>

<div class="gt-content-element">

	<h4><?php esc_html_e( 'Customer Details', 'gatsby' ); ?></h4>

	<div class="gt-table-holder gt-vertical gt-type-1 gt-light-grey">

		<div class="gt-table-inner">

			<table class="shop_table customer_details">

				<?php if ( $order->get_customer_note() ) : ?>
					<tr>
						<th><?php esc_html_e( 'Note:', 'gatsby' ); ?></th>
						<td><?php echo wptexturize( $order->get_customer_note() ); ?></td>
					</tr>
				<?php endif; ?>

				<?php if ( $order->get_billing_email() ) : ?>
					<tr>
						<th><?php esc_html_e( 'Email:', 'gatsby' ); ?></th>
						<td><?php echo esc_html( $order->get_billing_email() ); ?></td>
					</tr>
				<?php endif; ?>

				<?php if ( $order->get_billing_phone() ) : ?>
					<tr>
						<th><?php esc_html_e( 'Telephone:', 'gatsby' ); ?></th>
						<td><?php echo esc_html( $order->get_billing_phone() ); ?></td>
					</tr>
				<?php endif; ?>

				<?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>

			</table>

		</div>

	</div>

</div>

<?php if ( $show_shipping ) : ?>

<div class="row">

	<div class="col-lg-3 col-md-4 col-sm-6">

<?php endif; ?>

<h4><?php esc_html_e( 'Billing Address', 'gatsby' ); ?></h4>
<address>
	<?php echo wp_kses_post( $order->get_formatted_billing_address( __( 'N/A', 'gatsby' ) ) ); ?>

	<?php if ( $order->get_billing_phone() ) : ?>
		<p class="woocommerce-customer-details--phone"><?php echo esc_html( $order->get_billing_phone() ); ?></p>
	<?php endif; ?>
	<?php if ( $order->get_billing_email() ) : ?>
		<p class="woocommerce-customer-details--email"><?php echo esc_html( $order->get_billing_email() ); ?></p>
	<?php endif; ?>
</address>

<?php if ( $show_shipping ) : ?>

	</div>
	<div class="col-lg-3 col-md-4 col-sm-6">
		<h4><?php esc_html_e( 'Shipping Address', 'gatsby' ); ?></h4>
		<address>
			<?php echo wp_kses_post( $order->get_formatted_shipping_address( __( 'N/A', 'gatsby' ) ) ); ?>
		</address>

	</div>
</div>

<?php endif; ?>
