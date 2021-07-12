<?php

if ( !class_exists('Gatsby_Wishlist_Mod') ) {

	class Gatsby_Wishlist_Mod {

		function __construct() {

			if ( !class_exists('WooCommerce') ) return;

			if ( defined('YITH_WCWL') ) {

				global $gatsby_settings;

				if ( $gatsby_settings['product-wishlist-view'] ) {
					if ( get_option( 'yith_wcwl_enabled' ) == 'yes' ) {
						add_action( 'gatsby-after-product-image', create_function( '', 'echo do_shortcode( "[yith_wcwl_add_to_wishlist]" );' ), 11 );
						add_action( 'woocommerce_single_product_summary', create_function( '', 'echo do_shortcode( "[yith_wcwl_add_to_wishlist]" );' ), 30 );
					}
				}

			}

		}

	}

}