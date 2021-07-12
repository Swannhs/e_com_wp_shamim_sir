<?php

if ( ! function_exists('gatsby_vc_manager') ) {
	function gatsby_vc_manager() {
		return Gatsby_Vc_Config::getInstance();
	}
}

if ( ! function_exists('gatsby_vc_asset_url') ) {
	function gatsby_vc_asset_url( $file ) {
		return gatsby_vc_manager()->assetUrl( $file );
	}
}

if ( ! function_exists('gatsby_get_sort_classes') ) {
	function gatsby_get_sort_classes() {
		$classes = "";
		$item_categories = get_the_terms( get_the_ID(), 'portfolio_categories' );
		if ( is_object($item_categories) || is_array($item_categories) ) {
			foreach ($item_categories as $cat) {
				$classes .= $cat->slug . ' ';
			}
		}
		return str_replace( '%', '', $classes );
	}
}

if ( ! function_exists('gatsby_portfolio_get_image_sizes') ) {
	function gatsby_portfolio_get_image_sizes( $params, $id ) {
		$sizes = array();
		$image_size = '';

		if ( ( $params['layout'] == 'gt-type-3' ) && empty($params['img_size']) ) {

			$image_size = mad_meta( 'gatsby_image_size', '', $id );
			switch ( $image_size ) {
				case 'medium':
				case 'large':
					$sizes['item_size'] = 'gt-x2';
					break;
				case 'extra-large':
					$sizes['item_size'] = 'gt-x3';
					break;
			}

		}

		$sizes['image_size'] = Gatsby_Custom_Content_Types_and_Taxonomies::get_image_sizes( $params, $image_size );
		return $sizes;
	}
}
