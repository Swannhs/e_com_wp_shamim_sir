<?php

if ( !class_exists('gatsby_portfolio_isotope_masonry_entries') ) {

	class gatsby_portfolio_isotope_masonry_entries {

		public $atts = array();
		public $entries = '';

		function __construct( $atts = array() ) {

			global $gatsby_config;
			$sidebar_position = isset($gatsby_config['sidebar_position']) ? $gatsby_config['sidebar_position'] : 'gt-no-sidebar';

			$this->atts = shortcode_atts(array(
				'title' => '',
				'description' => '',
				'layout' => 'gt-type-1',
				'spacing' => 'gt-with-spacing',
				'actions' => 'gt-with-actions',
				'sort' => '',
				'type_sort' => 'gt-type-1',
				'categories' => array(),
				'orderby' => 'date',
				'order' => 'DESC',
				'columns' 	=> 3,
				'img_size' => '',
				'items' 	=> 6,
				'paginate' => 'none',
				'items_per_page' => 10,
				'css_animation' => '',
				'animation_delay' => 0,
				'offset' => 0,
				'sidebar_position' => $sidebar_position,
				'action' => 'gatsby_portfolio_ajax_isotope_items_more'
			), $atts );

			$this->query_entries($atts);
		}

		public function get_sort_class( $id ) {
			$classes = "";
			$item_categories = get_the_terms( $id, 'portfolio_categories' );
			if ( is_object($item_categories) || is_array($item_categories) ) {
				foreach ($item_categories as $cat) {
					$classes .= $cat->slug . ' ';
				}
			}
			return str_replace( '%', '', $classes );
		}

		public function query_entries( $params = array() ) {

			if ( empty($params) ) $params = $this->atts;

			$tax_query = array();

			$page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : get_query_var( 'page' );
			if ( !$page || $params['paginate'] == 'none' ) $page = 1;

			if ( !empty($params['categories']) ) {
				$categories = explode(',', $params['categories']);
				$tax_query = array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'portfolio_categories',
						'field' => 'id',
						'terms' => $categories
					)
				);
			}

			$query = array(
				'post_type' => 'portfolio',
				'post_status'  => 'publish',
				'posts_per_page' => $params['items'],
				'orderby' => $params['orderby'],
				'order' => $params['order'],
				'paged' => $page,
				'tax_query' => $tax_query,
				'offset' => $params['offset']
			);

			$this->entries = new WP_Query($query);
			$this->prepare_entries($params);
		}

		public function html() {

			if ( empty($this->loop) ) return;

			$atts = $this->atts;
			$id = $link = $title = $items_per_page = $sort_classes = $cur_terms = $image_size = $layout = '';

//			$actions = !empty($atts['actions']) ? $atts['actions'] : 'gt-with-actions';

			$data_rel = 'data-fancybox-group=portfolio-'. rand() .'';

			extract($this->atts);

			$defaults = array(
				'id' => '',
				'link' => '',
				'items_per_page' => 10,
				'sort_classes' => '',
				'cur_terms' => '',
				'item_size' => '',
				'image_size' => '',
				'size_class' => ''
			);

			ob_start(); ?>

			<?php foreach ( $this->loop as $entry ): extract( array_merge($defaults, $entry) ); ?>

				<!-- - - - - - - - - - - - - - Project - - - - - - - - - - - - - - - - -->

				<div class="gt-col <?php echo esc_attr($item_size) ?> <?php echo esc_attr($sort_classes) ?> <?php echo esc_attr($size_class) ?>">

					<div class="gt-project">

						<figure class="gt-tilter-figure">

							<!-- - - - - - - - - - - - - - Project Image - - - - - - - - - - - - - - - - -->

							<div class="gt-project-image">

								<a class="fancybox" <?php echo esc_attr($data_rel) ?> href="<?php echo Gatsby_Helper::get_post_featured_image( $id, '' ) ?>">
									<?php echo Gatsby_Helper::get_the_post_thumbnail( $id, $image_size, true, array(), array( 'alt' => esc_attr($title) ) ); ?>
								</a>

							</div>

							<!-- - - - - - - - - - - - - - End of Project Image - - - - - - - - - - - - - - - - -->

							<!-- - - - - - - - - - - - - - Project Description - - - - - - - - - - - - - - - - -->

							<div class="gt-project-description" <?php echo esc_attr($data_rel) ?> data-src="<?php echo Gatsby_Helper::get_post_featured_image( $id, '' ) ?>">

								<div class="gt-description-inner">

									<div class="gt-description-content">

										<div class="gt-tilter-caption">

											<h6 class="gt-project-title">
												<a href="<?php echo esc_url($link) ?>"><?php echo esc_html($title) ?></a>
											</h6>

											<?php if ( !empty($cur_terms) ): ?>
												<ul class="gt-project-cats">
													<?php foreach($cur_terms as $cur_term): ?>
														<li><a href="<?php echo get_term_link( (int) $cur_term->term_id, $cur_term->taxonomy ) ?>"><?php echo esc_html($cur_term->name) ?></a></li>
													<?php endforeach; ?>
												</ul>
											<?php endif; ?>

										</div><!--/ .gt-tilter-caption-->

									</div><!--/ .gt-description-content-->

									<?php if ( $layout == 'gt-type-2' ): ?>
										<div class="gt-tilter-deco-lines"></div>
									<?php endif; ?>

								</div><!--/ .gt-description-inner -->

							</div><!--/ .gt-project-description-->

							<!-- - - - - - - - - - - - - - End of Project Description - - - - - - - - - - - - - - - - -->

						</figure>

					</div><!--/ .gt-project-->

				</div><!--/ .gt-col-->

				<!-- - - - - - - - - - - - - - End of Project - - - - - - - - - - - - - - - - -->

			<?php endforeach; ?>

			<?php return ob_get_clean();
		}

		public function prepare_entries($params) {
			$this->loop = array();

			if ( empty($params )) $params = $this->atts;
			if ( empty($this->entries) || empty($this->entries->posts) ) return;

//			$sidebar_position = $params['sidebar_position'];

			foreach ($this->entries->posts as $key => $entry) {
				$this->loop[$key]['id'] = $id = $entry->ID;
				$this->loop[$key]['link'] = get_permalink($id);
				$this->loop[$key]['title'] = get_the_title($id);
				$this->loop[$key]['sort_classes'] = $this->get_sort_class($id);
				$this->loop[$key]['cur_terms'] = get_the_terms( $id, 'portfolio_categories' );
				$this->loop[$key]['post_content'] = has_excerpt($id) ? $entry->post_excerpt : '';

				$image_size = mad_meta( 'gatsby_image_size', '', $id );

				if ( empty($params['img_size']) ) {

					if ( $params['masonry'] ) {

						switch ( $image_size ) {
							case 'medium':
							case 'large':
								$this->loop[$key]['item_size'] = 'gt-x2';
								break;
							case 'extra-large':
								$this->loop[$key]['item_size'] = 'gt-x3';
								break;
						}

					}

				}

				$this->loop[$key]['size_class'] = 'gt-' . $image_size;
				$this->loop[$key]['image_size'] = Gatsby_Custom_Content_Types_and_Taxonomies::get_image_sizes( $params, $image_size, $params['img_size'] );

			}

		}

	}

}
