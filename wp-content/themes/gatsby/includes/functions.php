<?php

/*	Post ID
/* ---------------------------------------------------------------------- */

if (!function_exists('gatsby_post_id')) {

	function gatsby_post_id() {
		$object_id = get_queried_object_id();

		$post_id = false;

		if ( get_option( 'show_on_front' ) && get_option( 'page_for_posts' ) && is_home() ) {
			$post_id = get_option( 'page_for_posts' );
		} else {
			// Use the $object_id if available.
			if ( isset( $object_id ) ) {
				$post_id = $object_id;
			}
			// If we're not on a singular post, set to false.
			if ( ! is_singular() ) {
				$post_id = false;
			}
			// Front page is the posts page.
			if ( isset( $object_id ) && 'posts' == get_option( 'show_on_front' ) && is_home() ) {
				$post_id = $object_id;
			}
			// The woocommerce shop page.
			if ( class_exists( 'WooCommerce' ) && ( is_shop() || is_tax( 'product_cat' ) || is_tax( 'product_tag' ) ) ) {
				$post_id = get_option( 'woocommerce_shop_page_id' );
			}
		}

		return $post_id;
	}
}

/*	Blog alias
/* ---------------------------------------------------------------------- */

if ( !function_exists('gatsby_blog_alias') ) {

	function gatsby_blog_alias ( $format = 'standard', $image_size = array(), $style = '', $layout = '' ) {
		global $gatsby_config;
		$sidebar_position = $gatsby_config['sidebar_position'];

		if ( !empty($image_size) ) {
			if ( is_array($image_size) ) {
				$alias = ( $format == 'audio' || $format == 'video' ) ? $image_size[1] : $image_size[0];
				return $alias;
			}
		}

		if ( $layout == 'gt-type-1' ) {

			switch ( $format ) {
				case 'standard':
				case 'gallery':
					$alias = ( $sidebar_position == 'gt-no-sidebar' ) ? '570*450' : '415*385';
				break;
				default:
					$alias = ( $sidebar_position == 'gt-no-sidebar' ) ? '570*450' : '415*385';
					break;
			}

			return $alias;

		} elseif ( $layout == 'gt-type-3' ) {

			switch ( $format ) {
				case 'standard':
				case 'gallery':
					$alias = ( $sidebar_position == 'gt-no-sidebar' ) ? '570*315' : '470*260';
				break;
				default:
					$alias = ( $sidebar_position == 'gt-no-sidebar' ) ? '570*315' : '260*260';
				break;
			}

			return $alias;

		} elseif ( $layout == 'gt-type-4' ) {

			switch ( $style ) {

				case 'gt-big-thumbs':

					switch ( $format ) {
						case 'standard':
						case 'gallery':
							$alias = ( $sidebar_position == 'gt-no-sidebar' ) ? '1170*380' : '870*280';
						break;
						default:
							$alias = ( $sidebar_position == 'gt-no-sidebar' ) ? '1170*380' : '870*280';
							break;
					}

					return $alias;

				break;
				case 'gt-small-thumbs':

					switch ( $format ) {
						case 'standard':
						case 'gallery':
							$alias = ( $sidebar_position == 'gt-no-sidebar' ) ? '570*450' : '470*370';
						break;
						default:
							$alias = ( $sidebar_position == 'gt-no-sidebar' ) ? '570*450' : '470*370';
							break;
					}

					return $alias;

				break;

			}

		}

	}
}

/*	Debug function print_r
/* ---------------------------------------------------------------------- */

if (!function_exists('t_print_r')) {
	function t_print_r( $arr ) {
		echo "<pre>";
		print_r($arr);
		echo "</pre>";
	}
}

/* 	Pagination
/* ---------------------------------------------------------------------- */

if( !function_exists( 'gatsby_pagination' ) ) {

	function gatsby_pagination( $entries = '', $args = array(), $range = 10 ) {

		global $wp_query;

		$paged = (get_query_var('paged')) ? get_query_var('paged') : false;

		if ( $paged === false ) $paged = (get_query_var('page')) ? get_query_var('page') : false;
		if ( $paged === false ) $paged = 1;

		if ($entries == '') {

			if ( isset( $wp_query->max_num_pages ) )
				$pages = $wp_query->max_num_pages;

			if( !$pages )
				$pages = 1;

		} else {
			$pages = $entries->max_num_pages;
		}

		if ( 1 != $pages ) { ob_start(); ?>

			<!-- - - - - - - - - - - - - - Pagination - - - - - - - - - - - - - - - - -->

			<ul class="gt-pagination gt-fullwidth">

				<?php if( $paged > 1 ):  ?>
					<li><a class='gt-prev-page' href='<?php echo esc_url(get_pagenum_link( $paged - 1 )) ?>'></a></li>
				<?php endif; ?>

				<?php for( $i=1; $i <= $pages; $i++ ): ?>
					<?php if ( 1 != $pages &&( !( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $range ) ): ?>
						<?php $class = ( $paged == $i ) ? " gt-active" : ''; ?>
						<li><a class="<?php echo sanitize_html_class($class) ?>" href='<?php echo esc_url(get_pagenum_link( $i )) ?>'><?php echo esc_html($i) ?></a></li>
					<?php endif; ?>
				<?php endfor; ?>

				<?php if ( $paged < $pages ):  ?>
					<li><a class='gt-next-page' href='<?php echo esc_url(get_pagenum_link( $paged + 1 )) ?>'></a></li>
				<?php endif; ?>

			</ul>

			<!-- - - - - - - - - - - - - - End of Pagination - - - - - - - - - - - - - - - - -->

		<?php return ob_get_clean(); }
	}
}

/* Shop Corenavi
/* ---------------------------------------------------------------------- */

if (!function_exists('gatsby_shop_corenavi')) {

	function gatsby_shop_corenavi($pages = "", $a = array(), $args = array()) {
		global $wp_query;

		if (empty($args['tag'])) $args['tag'] = 'footer';
		if (empty($args['class'])) $args['class'] = 'bottom_box';

		if ($pages == '') {
			$max = $wp_query->max_num_pages;
		} else {
			$max = $pages;
		}

		ob_start(); ?>

		<?php if ($max > 1): ?>

			<div class="woocommerce-pagination">

				<<?php echo esc_attr($args['tag']) ?> class="<?php echo esc_attr($args['class']); ?> on_the_sides">

				<div class="left_side">
					<?php woocommerce_result_count(); ?>
				</div><!--/ .left_side-->

				<div class="right_side">
					<div class="pagination">
						<?php echo woocommerce_pagination(); ?>
					</div><!--/ .pagination-->
				</div><!--/ .right_side-->

				</<?php echo esc_attr($args['tag']) ?>>

			</div>

		<?php endif;

		return ob_get_clean();
	}

}

/*  Is shop installed
/* ---------------------------------------------------------------------- */

if (!function_exists('gatsby_is_shop_installed')) {
	function gatsby_is_shop_installed() {
		global $woocommerce;
		if ( isset( $woocommerce ) ) {
			return true;
		} else {
			return false;
		}
	}
}

/*  Is product
/* ---------------------------------------------------------------------- */

if ( ! function_exists('gatsby_is_product') ) {
	function gatsby_is_product() {
		return is_singular( array( 'product' ) );
	}
}

/*  Get WC page id
/* ---------------------------------------------------------------------- */

if ( ! function_exists('gatsby_wc_get_page_id') ) {
	function gatsby_wc_get_page_id( $page ) {

		if ( $page == 'pay' || $page == 'thanks' ) {
			_deprecated_argument( __FUNCTION__, '2.1', 'The "pay" and "thanks" pages are no-longer used - an endpoint is added to the checkout instead. To get a valid link use the WC_Order::get_checkout_payment_url() or WC_Order::get_checkout_order_received_url() methods instead.' );

			$page = 'checkout';
		}
		if ( $page == 'change_password' || $page == 'edit_address' || $page == 'lost_password' ) {
			_deprecated_argument( __FUNCTION__, '2.1', 'The "change_password", "edit_address" and "lost_password" pages are no-longer used - an endpoint is added to the my-account instead. To get a valid link use the wc_customer_edit_account_url() function instead.' );

			$page = 'myaccount';
		}

		$page = apply_filters( 'woocommerce_get_' . $page . '_page_id', get_option('woocommerce_' . $page . '_page_id' ) );

		return $page ? absint( $page ) : -1;
	}
}

/*  Is shop
/* ---------------------------------------------------------------------- */

if ( ! function_exists('gatsby_is_shop') ) {
	function gatsby_is_shop() {
		return is_post_type_archive( 'product' ) || is_page( gatsby_wc_get_page_id( 'shop' ) );
	}
}

/*  Is product tax
/* ---------------------------------------------------------------------- */

if ( ! function_exists('gatsby_is_product_tax') ) {
	function gatsby_is_product_tax() {
		return is_tax( get_object_taxonomies( 'product' ) );
	}
}

/*  Is product category
/* ---------------------------------------------------------------------- */

if ( ! function_exists('gatsby_is_product_category') ) {
	function gatsby_is_product_category( $term = '' ) {
		return is_tax( 'product_cat', $term );
	}
}

/*  Is product tag
/* ---------------------------------------------------------------------- */

if ( ! function_exists('gatsby_is_product_tag') ) {
	function gatsby_is_product_tag( $term = '' ) {
		return is_tax( 'product_tag', $term );
	}
}

/*  Is really woocommerce pages
/* ---------------------------------------------------------------------- */

if ( ! function_exists('gastby_is_realy_woocommerce_page') ) {
	function gastby_is_realy_woocommerce_page( $archive = true ) {

		if ( is_search() ) {
			return false;
		}

		if ( $archive ) {
			if ( gatsby_is_shop() || gatsby_is_product_tax() || gatsby_is_product() ) {
				return true;
			}
		}

		$woocommerce_keys = array("gatsby_woocommerce_shop_page_id",
			"woocommerce_terms_page_id",
			"woocommerce_cart_page_id",
			"woocommerce_checkout_page_id",
			"woocommerce_pay_page_id",
			"woocommerce_thanks_page_id",
			"woocommerce_myaccount_page_id",
			"woocommerce_edit_address_page_id",
			"woocommerce_view_order_page_id",
			"woocommerce_change_password_page_id",
			"woocommerce_logout_page_id",
			"woocommerce_lost_password_page_id");

		foreach ( $woocommerce_keys as $wc_page_id ) {

			if ( get_the_ID() == get_option($wc_page_id, 0 ) ) {
				return true;
			}
		}
		return false;
	}
}

/*  Get Blog ID
/* ---------------------------------------------------------------------- */

if ( ! function_exists('gastby_get_blog_id') ) {
	function gastby_get_blog_id()
	{
		return apply_filters( 'gatsby_get_blog_id', get_current_blog_id() );
	}
}

/*  Related Portfolio
/* ---------------------------------------------------------------------- */

if ( !class_exists('Gatsby_Portfolio_Related') ) {

	class Gatsby_Portfolio_Related {

		public $entries = '';
		public $id = 0;
		public $atts = array();
		public $defaults = array(
			'title' => '',
			'id' => '',
			'link' => '',
			'columns' => 3,
			'posts_per_page' => 10,
			'orderby' => 'rand',
			'image_size' => '450*295'
		);

		function __construct( $id, $args = array() ) {
			$this->atts = wp_parse_args( $args, $this->defaults );
			$this->id = absint($id);
			$this->query_entries();
		}

		public function get_related_terms( $this_id, $term ) {
			$terms_array = array();

			$terms = apply_filters( 'gatsby_get_related_' . $term . '_terms', wp_get_post_terms( $this_id, $term ), $this_id );
			foreach ( $terms as $term ) {
				$terms_array[] = $term->term_id;
			}

			return array_map( 'absint', $terms_array );
		}

		public function query_entries() {

			$this_id = $this->id;

			if ( sizeof( $this_id ) == 0 ) return;

			$tax_query = array();
			$posts_per_page = $orderby = '';

			extract($this->atts);

			if ( !$posts_per_page ) {
				$posts_per_page = get_option('posts_per_page');
			}

			$cats_array = $this->get_related_terms( $this_id, 'portfolio_categories' );

			if ( !empty($cats_array) ) {
				$tax_query = array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'portfolio_categories',
						'field' => 'id',
						'terms' => $cats_array
					)
				);
			}

			$args = apply_filters( 'gatsby_related_portfolio_args', array(
				'post_type' => 'portfolio',
				'post_status' => 'publish',
				'ignore_sticky_posts' => 1,
				'no_found_rows' => 1,
				'orderby' => $orderby,
				'posts_per_page' => $posts_per_page,
				'post__not_in' => array( $this_id ),
				'tax_query' => $tax_query
			) );

			$this->entries = new WP_Query( $args );
			$this->prepare_entries();
		}

		public function prepare_entries() {
			$this->loop = array();

			if ( empty($this->entries) || empty($this->entries->posts) ) return;

			foreach ($this->entries->posts as $key => $entry) {
				$this->loop[$key]['id'] = $id = $entry->ID;
				$this->loop[$key]['link'] = get_permalink($id);
				$this->loop[$key]['post_title'] = get_the_title($id);
				$this->loop[$key]['cur_terms'] = get_the_terms( $id, 'portfolio_categories' );
				$this->loop[$key]['image_size'] = '370*280';
			}

		}

		public function output() {

			if ( empty($this->loop) ) return;

			$atts = $this->atts;

			$css_classes = array(
				'gt-portfolio-holder',
				'owl-carousel',
				'owl-large-nav',
				'gt-type-2',
				'gt-cols-' . absint($atts['columns'])
			);

			$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );

			ob_start(); ?>

			<?php if ( $atts['title'] ): ?>
				<h3 class="gt-title-underline"><?php echo esc_html($atts['title']) ?></h3>
			<?php endif; ?>

			<!-- - - - - - - - - - - - - - Related Portfolio Projects - - - - - - - - - - - - - - - - -->

			<div class="<?php echo esc_attr( trim( $css_class ) ) ?>">

				<?php foreach ( $this->loop as $entry ): extract(array_merge($atts, $entry)); ?>

					<div class="gt-col">

						<div class="gt-project">

							<!-- - - - - - - - - - - - - - Project Image - - - - - - - - - - - - - - - - -->

							<div class="gt-project-image">

								<?php echo Gatsby_Helper::get_the_post_thumbnail( $id, $image_size, true, array(), array( 'alt' => esc_attr($post_title) ) ); ?>
								<a href="<?php echo esc_url($link) ?>" class="gt-project-link"></a>

							</div>

							<!-- - - - - - - - - - - - - - End of Project Image - - - - - - - - - - - - - - - - -->

							<!-- - - - - - - - - - - - - - Project Description - - - - - - - - - - - - - - - - -->

							<div class="gt-project-description">

								<div class="gt-description-inner">

									<h6 class="gt-project-title">
										<a href="<?php echo esc_url($link) ?>"><?php echo esc_html($post_title) ?></a>
									</h6>

									<?php if ( !empty($cur_terms) ): ?>
										<ul class="gt-project-cats">
											<?php foreach($cur_terms as $cur_term): ?>
												<li><a href="<?php echo get_term_link( (int) $cur_term->term_id, $cur_term->taxonomy ) ?>"><?php echo esc_html($cur_term->name) ?></a></li>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>

								</div><!--/ .gt-description-inner -->

							</div>

							<!-- - - - - - - - - - - - - - End of Project Description - - - - - - - - - - - - - - - - -->

						</div>

					</div>

				<?php endforeach; ?>

			</div>

			<!-- - - - - - - - - - - - - - End of Related Portfolio Projects - - - - - - - - - - - - - - - - -->

			<?php wp_reset_postdata(); echo ob_get_clean();

		}

	}

}
