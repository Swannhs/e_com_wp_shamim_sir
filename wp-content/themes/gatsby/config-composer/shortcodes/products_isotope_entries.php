<?php

class gatsby_products_isotope_masonry_entries {

	public $atts = array();
	public $products = '';

	public function __construct( $atts = array() ) {

		$this->atts = shortcode_atts(array(
			'title' 	 => '',
			'tag_title' 	 => 'h2',
			'description' 	 => '',
			'title_color' => '',
			'description_color' => '',
			'type' 		 => 'gt-view-grid',
			'layout' 	 => 'gt-type-1',
			'carousel' => 0,
			'columns' 	 => 4,
			'items' 	 => 8,
			'items_per_page' => 5,
			'show' => '',
			'orderby' => 'menu_order',
			'order' => '',
			'by_id' => '',
			'sort' => '',
			'type_sort' => 'gt-type-1',
			'align_sort' => 'align-left',
			'categories' => '',
			'paginate' => 'none',
			'link' => '',
			'taxonomy' => 'product_cat',
			'css_animation' => '',
			'offset' => 0,
			'action' => 'gatsby_products_ajax_items_more'
		), $atts, 'vc_mad_products');

		$this->query_entries();
	}

	public function query_entries() {

		global $woocommerce;

		$params = $this->atts;
		$number = $params['items'];
		$orderby = sanitize_title( $params['orderby'] );
		$order = sanitize_title( $params['order'] );
		$show = $params['show'];

		// Meta query
		$meta_query = $tax_query = array();
		$meta_query[] = $woocommerce->query->visibility_meta_query();
		$meta_query[] = $woocommerce->query->stock_status_meta_query();
		$meta_query = array_filter($meta_query);

		if ( !empty($params['categories']) ) {

			$categories = explode(',', $params['categories']);

			if ( is_array($categories) ) {
				$categories = $categories;
			} else {
				$categories = array($categories);
			}

			$tax_query = array(
				'relation' => 'AND',
					array(
						'taxonomy' => 'product_cat',
						'field' => 'id',
						'terms' => $categories
					)
			);
		}

		$query = array(
			'post_type' 	 => 'product',
			'post_status' 	 => 'publish',
			'ignore_sticky_posts'	=> 1,
			'ordeby' 	 	 => $orderby,
			'order'   		 => $order == 'asc' ? 'asc' : 'desc',
			'meta_query' 	 => $meta_query,
			'tax_query' 	 => $tax_query,
			'posts_per_page' => $number,
			'offset' => $params['offset']
		);

//		if ( !empty($params['by_id']) ) {
//			$in = $not_in = array();
//			$by_ids = $params['by_id'];
//			$ids = $this->stringToArray( $by_ids );
//
//			foreach ( $ids as $id ) {
//				$id = (int) $id;
//				if ( $id < 0 ) {
//					$not_in[] = abs( $id );
//				} else {
//					$in[] = $id;
//				}
//			}
//			$query['post__in'] = $in;
//			$query['post__not_in'] = $not_in;
//		}
//
//		if ( $params['paginate'] == 'pagination' ) {
//			$paged = get_query_var( 'page' ) ? get_query_var( 'page' ) : ( get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1 );
//			$query['paged'] = $paged;
//		}
//
		if ( $orderby != '' ) {
			switch ( $orderby ) {
				case 'rand' :
					$query['orderby']  = 'rand';
					break;
				case 'date' :
					$query['orderby']  = 'date ID';
					$query['order']    = $order == 'ASC' ? 'ASC' : 'DESC';
					break;
				case 'price' :
					$query['orderby']  = "meta_value_num ID";
					$query['order']    = $order == 'DESC' ? 'DESC' : 'ASC';
					$query['meta_key'] = '_price';
					break;
				case 'popularity' :
					$query['meta_key'] = 'total_sales';
					add_filter( 'posts_clauses', array( $this, 'order_by_popularity_post_clauses' ) );
					break;
				case 'rating' :
					add_filter( 'posts_clauses', array( $this, 'order_by_rating_post_clauses' ) );
					break;
				case 'title' :
					$query['orderby']  = 'title';
					$query['order']    = $order == 'DESC' ? 'DESC' : 'ASC';
					break;
				default :
					$query['orderby']  = $params['orderby'];
					break;
			}
		} else {
			$query['orderby'] = get_option('woocommerce_default_catalog_orderby');
		}

		switch ( $show ) {
			case 'featured' :
				$query['meta_query'][] = array(
					'key'   => '_featured',
					'value' => 'yes'
				);
				break;
			case 'onsale' :
				$product_ids_on_sale    = wc_get_product_ids_on_sale();
				$product_ids_on_sale[]  = 0;
				$query['post__in'] = $product_ids_on_sale;
				break;
			case 'bestselling':
				$query['ignore_sticky_posts'] = 1;
				$query['meta_key'] = 'total_sales';
				$query['orderby'] = 'meta_value_num';
				break;
			case 'toprated' :
				$query['ignore_sticky_posts'] = 1;
				$query['no_found_rows'] = 1;
				break;
			case 'new':
				add_filter( 'posts_where', array(&$this, 'filter_where') );
				break;
		}

		if ( $show == 'toprated' ) {
			add_filter( 'posts_clauses', array( WC()->query , 'order_by_rating_post_clauses' ) );
		}

		$this->products = new WP_Query( $query );

		if ( $show == 'new' ) {
			remove_filter( 'posts_where', array(&$this, 'filter_where') );
		}

		global $woocommerce_loop;
		$woocommerce_loop['loop'] = 0;

		if ( $show == 'toprated' ) {
			remove_filter( 'posts_clauses', array( WC()->query , 'order_by_rating_post_clauses' ) );
		}

	}

	public function order_by_popularity_post_clauses( $args ) {
		global $wpdb;
		$args['orderby'] = "$wpdb->postmeta.meta_value+0 DESC, $wpdb->posts.post_date DESC";
		return $args;
	}

	public function order_by_rating_post_clauses( $args ) {
		global $wpdb;

		$args['fields'] .= ", AVG( $wpdb->commentmeta.meta_value ) as average_rating ";
		$args['where']  .= " AND ( $wpdb->commentmeta.meta_key = 'rating' OR $wpdb->commentmeta.meta_key IS null ) ";
		$args['join']   .= "
			LEFT OUTER JOIN $wpdb->comments ON($wpdb->posts.ID = $wpdb->comments.comment_post_ID)
			LEFT JOIN $wpdb->commentmeta ON($wpdb->comments.comment_ID = $wpdb->commentmeta.comment_id)
		";
		$args['orderby'] = "average_rating DESC, $wpdb->posts.post_date DESC";
		$args['groupby'] = "$wpdb->posts.ID";

		return $args;
	}

	public function filter_where( $where = '' ) {
		$newness = get_option( 'wc_nb_newness' );
		$where .= " AND post_date > '" . date(wc_date_format(), strtotime('-'. $newness .' days')) . "'";
		return $where;
	}

	public function html() {

		if ( empty($this->products) || empty($this->products->posts) ) return;

		$products = $this->products;
		$params = $this->atts;

		extract($params);

		ob_start(); ?>

			<?php if ( $products->have_posts() ) : ?>

				<?php while ( $products->have_posts() ) : $products->the_post(); ?>

					<div <?php post_class( array( 'gt-col', 'appended' ) ); ?>>

						<div class="gt-product">

							<?php
							/**
							 * woocommerce_before_shop_loop_item hook.
							 *
							 * @hooked woocommerce_template_loop_product_link_open - 10
							 */
							do_action( 'woocommerce_before_shop_loop_item' );

							/**
							 * woocommerce_before_shop_loop_item_title hook.
							 *
							 * @hooked woocommerce_show_product_loop_sale_flash - 10
							 * @hooked woocommerce_template_loop_product_thumbnail - 10
							 */
							do_action( 'woocommerce_before_shop_loop_item_title' ); ?>

							<div class="gt-product-description">

								<?php
								/**
								 * woocommerce_shop_loop_item_title hook.
								 *
								 * @hooked woocommerce_template_loop_product_title - 10
								 */
								do_action( 'woocommerce_shop_loop_item_title' );

								/**
								 * woocommerce_after_shop_loop_item_title hook.
								 *
								 * @hooked woocommerce_template_loop_rating - 5
								 * @hooked woocommerce_template_loop_price - 10
								 */
								do_action( 'woocommerce_after_shop_loop_item_title' );

								/**
								 * woocommerce_after_shop_loop_item hook.
								 *
								 * @hooked woocommerce_template_loop_product_link_close - 5
								 * @hooked woocommerce_template_loop_add_to_cart - 10
								 */
								do_action( 'woocommerce_after_shop_loop_item' );
								?>

							</div><!--/ .gt-product-description-->

						</div><!--/ .gt-product-->

					</div><!--/ .gt-col-->

				<?php endwhile; ?>

			<?php endif; ?>

		<?php return ob_get_clean();
	}

}