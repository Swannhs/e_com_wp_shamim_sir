<?php

if (!class_exists('Gatsby_Compare_Mod')) {

	class Gatsby_Compare_Mod {

		public $action_recount = 'action_recount';
		public $action_recount_after_remove = 'action_recount_after_remove';
		public $cookie_name = 'yith_woocompare_list';

		public $products_list = array();

		public $action_add = 'yith-woocompare-add-product';

		function __construct() {

			global $woocommerce;

			if ( ! isset( $woocommerce ) || ! function_exists( 'WC' ) ) { return; }

			if ( defined( 'YITH_WOOCOMPARE' ) ) {

				global $gatsby_settings;

				if ( $gatsby_settings['product-compare-view'] ) {
					if ( get_option( 'yith_woocompare_compare_button_in_products_list' ) == 'yes' ) {
						add_action( 'gatsby-after-product-image', array( $this, 'compare_button' ), 13 );
					}
				}

				if ( $gatsby_settings['product-compare-view'] ) {
					if ( get_option('yith_woocompare_compare_button_in_product_page') == 'yes' )  {
						add_action( 'woocommerce_single_product_summary', array( $this, 'compare_button' ), 35 );
					}
				}

				$this->products_list = isset( $_COOKIE[ $this->cookie_name ] ) && !empty($_COOKIE[ $this->cookie_name ]) ? maybe_unserialize( $_COOKIE[ $this->cookie_name ] ) : array();

			}

		}

		public function compare_button($product_id) {
			global $product;

			$product_id = isset( $product_id ) ? $product_id : $product->get_id() ? $product->get_id() : 0;

			// return if product doesn't exist
			if ( empty( $product_id ) || apply_filters( 'yith_woocompare_remove_compare_link_by_cat', false, $product_id ) )
				return;

			$button_text = get_option( 'yith_woocompare_button_text', esc_html__( 'Add to Compare', 'gatsby' ) ); ?>

			<div class="compare-button">
				<a href="<?php echo esc_url($this->add_product_url( $product_id )) ?>" class="compare" data-product_id="<?php echo esc_attr($product_id) ?>" rel="nofollow">
					<span class="tooltip"><?php echo esc_html($button_text) ?></span>
				</a>
			</div>
			<?php
		}

		public function add_product_url( $product_id ) {
			$url_args = array(
				'action' => $this->action_add,
				'id' => $product_id
			);
			return apply_filters( 'yith_woocompare_add_product_url', esc_url_raw( add_query_arg( $url_args ) ), $this->action_add );
		}

	}

}