<?php

/* ---------------------------------------------------------------------- */
/*	Product Custom Tab Filter
/* ---------------------------------------------------------------------- */

if ( !function_exists('gatsby_woocommerce_product_custom_tab') ) {

	function gatsby_woocommerce_product_custom_tab($key) {
		global $post;

		$title_product_tab = $content_product_tab = '';
		$custom_tabs_array = get_post_meta($post->ID, 'gatsby_custom_tabs', true);
		$custom_tab = $custom_tabs_array[$key];

		extract($custom_tab);

		if ( $title_product_tab != '' ) {

			preg_match("!\[embed.+?\]|\[video.+?\]!", $content_product_tab, $match_video);
			preg_match("!\[(?:)?gallery.+?\]!", $content_product_tab, $match_gallery);

			if (!empty($match_video)) {

				global $wp_embed;

				$video = $match_video[0];
				$before = "<div class='gt-responsive-iframe'>";
				$before .= do_shortcode($wp_embed->run_shortcode($video));
				$before .= "</div>";
				$before = apply_filters('the_content', $before);
				echo $before;

			} elseif ( !empty($match_gallery) ) {

				$gallery = $match_gallery[0];
				if (strpos($gallery, 'vc_') === false) {
					$gallery = str_replace("gallery", 'gatsby_gallery image_size="848*370"', $gallery);
				}
				$before = apply_filters('the_content', $gallery);
				echo do_shortcode($before);

			} else {
				echo do_shortcode($content_product_tab);
			}

		}

	}
}

/* ---------------------------------------------------------------------- */
/*	Overwrite catalog ordering
/* ---------------------------------------------------------------------- */

if ( !function_exists('gatsby_overwrite_catalog_ordering') ) {

	function gatsby_overwrite_catalog_ordering($args) {

		global $gatsby_config;

		$keys = array( 'product_order', 'product_count' );
		if ( empty($gatsby_config['woocommerce'])) $gatsby_config['woocommerce'] = array();

		foreach ( $keys as $key ) {
			if (isset($_GET[$key]) ) {
				$_SESSION['gatsby_woocommerce'][$key] = esc_attr($_GET[$key]);
			}
			if ( isset($_SESSION['gatsby_woocommerce'][$key]) ) {
				$gatsby_config['woocommerce'][$key] = $_SESSION['gatsby_woocommerce'][$key];
			}
		}

		extract($gatsby_config['woocommerce']);

		if ( isset($product_order) && !empty($product_order) ) {
			switch ( $product_order ) {
				case 'date'  : $orderby = 'date'; $order = 'desc'; $meta_key = '';  break;
				case 'price' : $orderby = 'meta_value_num'; $order = 'asc'; $meta_key = '_price'; break;
				case 'popularity' : $orderby = 'meta_value_num'; $order = 'desc'; $meta_key = 'total_sales'; break;
				case 'title' : $orderby = 'title'; $order = 'asc'; $meta_key = ''; break;
				case 'default':
				default : $orderby = 'menu_order title'; $order = 'asc'; $meta_key = ''; break;
			}
		}

		if ( isset($orderby) )  $args['orderby'] = $orderby;
		if ( isset($order) ) 	$args['order'] = $order;

		if ( !empty($meta_key) ) {
			$args['meta_key'] = $meta_key;
		}

		return $args;
	}

	add_action( 'woocommerce_get_catalog_ordering_args', 'gatsby_overwrite_catalog_ordering');

}

/* ---------------------------------------------------------------------- */
/*	Change product thumbnail in products widget
/* ---------------------------------------------------------------------- */

if ( !function_exists('gatsby_widget_product_thumbnail') ) {

	function gatsby_widget_product_thumbnail() {
		$id = get_the_ID();
		$size = 'shop_thumbnail';

		$gallery = get_post_meta($id, '_product_image_gallery', true);
		$attachment_image = '';
		if ( !empty($gallery) ) {
			$gallery = explode(',', $gallery);
			$first_id = $gallery[0];
			$attachment_image = wp_get_attachment_image( $first_id , $size, false, array('class' => 'hover-image ') );
		}

		$thumb_image = get_the_post_thumbnail($id , $size);
		if ( !$thumb_image ) {
			if ( wc_placeholder_img_src() ) {
				$thumb_image = wc_placeholder_img( $size );
			}
		}

		$output = '<div class="inner'.(($attachment_image) ?' img-effect' : '').'">';

		// show images
		$output .= $thumb_image;
		$output .= $attachment_image;

		$output .= '</div>';

		echo $output;
	}

}

if ( !function_exists('gatsby_woocommerce_product_count') ) {
	function gatsby_woocommerce_product_count() {
		global $gatsby_settings;

		parse_str($_SERVER['QUERY_STRING'], $params);

		if ( $gatsby_settings['category-item'] ) {
			$per_page = explode(',', $gatsby_settings['category-item']);
		} else {
			$per_page = explode(',', '24,16,8');
		}

		$count = !empty($params['product_count']) ? $params['product_count'] : $per_page[0];
		return $count;
	}
}
