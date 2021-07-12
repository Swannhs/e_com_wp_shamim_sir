<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<?php echo gatsby_title( array( 'heading' => 'h2', 'title' => woocommerce_page_title(false) ) ); ?>

<div class="gt-content-element">

	<form action="<?php echo esc_url( wc_get_cart_url() ); ?>" class="gt-shopping-cart-form" method="post">

		<div class="gt-table-holder gt-horizontal gt-shopping-cart-full">

			<div class="gt-table-inner">

				<?php do_action( 'woocommerce_before_cart_table' ); ?>

				<table class="shop-table" cellspacing="0">

					<thead>
						<tr>
							<th class="gt-close-col">&nbsp;</th>
							<th class="gt-product-col product-name">
								<div class="gt-cell-content"><?php esc_html_e( 'Product', 'gatsby' ); ?></div>
							</th>
							<th class="gt-price-col product-price">
								<div class="gt-cell-content"><?php esc_html_e( 'Price', 'gatsby' ); ?></div>
							</th>
							<th class="gt-qty-col product-quantity">
								<div class="gt-cell-content"><?php esc_html_e( 'Quantity', 'gatsby' ); ?></div>
							</th>
							<th class="gt-total-col product-subtotal">
								<div class="gt-cell-content"><?php esc_html_e( 'Total', 'gatsby' ); ?></div>
							</th>
						</tr>
					</thead>

					<tbody>

						<?php do_action( 'woocommerce_before_cart_contents' ); ?>

					<?php
						foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
							$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
							$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

							if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
								$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
								?>
								<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

									<td class="gt-close-col product-remove">

										<div class="gt-cell-content">

											<?php
											echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
												'<a href="%s" class="gt-close" title="%s" data-product_id="%s" data-product_sku="%s"></a>',
												esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
												esc_html__( 'Remove this item', 'gatsby' ),
												esc_attr( $product_id ),
												esc_attr( $_product->get_sku() )
											), $cart_item_key );
											?>

										</div>

									</td>

									<td class="gt-product-col product-name" data-title="<?php esc_html_e('Product', 'gatsby') ?>">

										<div class="gt-cell-content">

											<div class="gt-product">

												<?php
												$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

												if ( ! $product_permalink ) {
													echo wp_kses_post( $thumbnail );
												} else {
													printf( '<a class="gt-product-image" href="%s">%s</a>', esc_url( $product_permalink ), wp_kses_post( $thumbnail ) );
												}
												?>

												<div class="gt-product-description">

													<?php
													if ( ! $product_permalink ) {
														echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
													} else {
														echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<h5 class="gt-product-name"><a href="%s">%s</a></h5>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
													}
													?>

													<div class="gt-product-info">

														<div class="gt-product-characteristics">
															<?php

															do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

															// Meta data
															echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

															// Backorder notification
															if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
																echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'gatsby' ) . '</p>' ) );
															}
															?>

														</div>

													</div><!--/ .gt-product-info -->

												</div><!--/ .gt-product-description -->

											</div><!--/ .gt-product -->

										</div><!--/ .gt-cell-content -->

									</td>

									<td class="gt-price-col product-price" data-title="<?php esc_html_e( 'Price', 'gatsby' ); ?>">

										<div class="gt-cell-content">

											<div class="gt-product-price">
												<?php
												echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
												?>
											</div>

										</div><!--/ .gt-cell-content -->

									</td>

									<td class="gt-qty-col product-quantity" data-title="<?php esc_html_e( 'Quantity', 'gatsby' ); ?>">

										<div class="gt-cell-content">

											<?php
											if ( $_product->is_sold_individually() ) {
												$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
											} else {
												$product_quantity = woocommerce_quantity_input( array(
													'input_name'   => "cart[{$cart_item_key}][qty]",
													'input_value'  => $cart_item['quantity'],
													'max_value'    => $_product->get_max_purchase_quantity(),
													'min_value'    => '0',
													'product_name' => $_product->get_name(),
												), $_product, false );
											}

											echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
											?>

										</div><!--/ .gt-cell-content -->

									</td>

									<td class="gt-total-col product-subtotal" data-title="<?php esc_html_e( 'Total', 'gatsby' ); ?>">

										<div class="gt-cell-content">

											<div class="gt-total-price">
												<?php
													echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
												?>
											</div>

										</div><!--/ .gt-cell-content -->

									</td>

								</tr>
								<?php
							}
						}

						do_action( 'woocommerce_cart_contents' ); ?>

						<?php do_action( 'woocommerce_after_cart_contents' ); ?>

					</tbody>

				</table>

				<?php do_action( 'woocommerce_after_cart_table' ); ?>

			</div>

		</div>

		<footer class="gt-shopping-cart-footer">

			<div class="gt-left-edge">

				<?php if ( wc_coupons_enabled() ) { ?>
					<div class="gt-switch-view gt-coupon-form">

						<div class="gt-left-element">
							<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'gatsby' ); ?>" />
						</div><!--/ .gt-left-element -->

						<div class="gt-right-element">

							<input type="submit" class="gt-btn-3" name="apply_coupon" value="<?php esc_attr_e( 'Apply Coupon', 'gatsby' ); ?>">

						</div><!--/ .gt-right-element -->

						<?php do_action( 'woocommerce_cart_coupon' ); ?>

					</div>
				<?php } ?>

			</div><!--/ .gt-left-edge -->

			<div class="gt-right-edge">

				<input type="submit" class="gt-btn-3 gt-reverse alignright" name="update_cart" value="<?php esc_attr_e( 'Update Cart', 'gatsby' ); ?>" />

				<?php do_action( 'woocommerce_cart_actions' ); ?>

				<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>

			</div><!--/ .gt-right-edge -->

		</footer>

	</form>

</div>

<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

<?php do_action( 'woocommerce_cart_collaterals' ); ?>

<?php do_action( 'woocommerce_after_cart' ); ?>
