<?php

class WPBakeryShortCode_VC_mad_portfolio extends WPBakeryShortCode {

	public $atts = array();
	public $entries = '';
	public $settings = array();

	protected function content($atts, $content = null) {

		global $gatsby_config;
		$sidebar_position = isset($gatsby_config['sidebar_position']) ? $gatsby_config['sidebar_position'] : 'gt-no-sidebar';

		$this->atts = shortcode_atts(array(
			'title' => '',
			'tag_title' => 'h2',
			'description' => '',
			'title_color' => '',
			'description_color' => '',
			'layout' => 'gt-type-1',
			'masonry' => '',
			'spacing' => 'gt-with-spacing',
			'sort' => '',
			'type_sort' => 'gt-type-1',
			'align_sort' => 'align-left',
			'categories' => array(),
			'orderby' => 'date',
			'order' => 'DESC',
			'columns' 	=> 4,
			'img_size' => '',
			'items' 	=> 6,
			'paginate' => 'none',
			'items_per_page' => 10,
			'css_animation' => '',
			'animation_delay' => 0,
			'offset' => 0,
			'sidebar_position' => $sidebar_position,
			'action' => 'gatsby_portfolio_ajax_isotope_items_more'
		), $atts, 'vc_mad_portfolio');

		$this->query_entries();
		$html = $this->html();

		return $html;
	}

	protected function sort_links( $entries, $params ) {

		$categories = get_categories(array(
			'taxonomy'	=> 'portfolio_categories',
			'hide_empty'=> 0
		));
		$current_cats = array();
		$display_cats = is_array($params['categories']) ? $params['categories'] : array_filter(explode(',', $params['categories']));
		$type_sort = !empty($params['type_sort']) ? $params['type_sort'] : 'gt-type-1';
		$align_sort = !empty($params['align_sort']) ? $params['align_sort'] : 'align-left';

		foreach ( $entries as $entry ) {
			if ( $current_item_cats = get_the_terms( $entry->ID, 'portfolio_categories' ) ) {
				if ( !empty($current_item_cats) ) {
					foreach ($current_item_cats as $current_item_cat) {
						if (empty($display_cats) || in_array($current_item_cat->term_id, $display_cats)) {
							$current_cats[$current_item_cat->term_id] = $current_item_cat->term_id;
						}
					}
				}
			}
		}

		$css_classes = array(
			'gt-filter', $type_sort, $align_sort
		);

		$wrapper_attributes = array();
		if ( '' !== $params['css_animation'] ) {
			$wrapper_attributes[] = Gatsby_Helper::create_data_string_animation( $params['css_animation'], 0, '-80' );
		}

		$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );

		ob_start(); ?>

		<!-- - - - - - - - - - - - - - Filter - - - - - - - - - - - - - - - - -->

		<nav class="<?php echo esc_attr( trim($css_class) ) ?>" <?php echo implode( ' ', $wrapper_attributes ) ?>>
			<ul>

				<li><a href="javascript:void(0)" class="gt-active" data-filter="*"><?php esc_html_e('All', 'gatsby') ?></a></li>

				<?php foreach ( $categories as $category ): ?>
					<?php if ( in_array($category->term_id, $current_cats) ): ?>
						<?php $nicename = str_replace('%', '', $category->category_nicename); ?>
						<li><a href="javascript:void(0)" data-filter=".<?php echo esc_attr($nicename) ?>"><?php echo esc_html(trim($category->cat_name)); ?></a></li>
					<?php endif; ?>

				<?php endforeach ?>

			</ul>
		</nav><!--/ .gt-filter-->

		<!-- - - - - - - - - - - - - - End of Filter - - - - - - - - - - - - - - - - -->

		<?php return ob_get_clean();
	}

	public function get_sort_class( $id ) {
		$classes = "";
		$item_categories = get_the_terms( $id, 'portfolio_categories' );
		if ( is_object($item_categories) || is_array($item_categories) ) {
			foreach ( $item_categories as $cat ) {
				$classes .= $cat->slug . ' ';
			}
		}
		return str_replace( '%', '', $classes );
	}

	public function query_entries($params = array()) {

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
			'tax_query' => $tax_query
		);

		if ( $params['paginate'] == 'load-more' ) {
			$query['offset'] = $params['offset'];
		}

		$this->entries = new WP_Query($query);
		$this->prepare_entries($params);
	}

	public function html() {

		if ( empty($this->loop) ) return;

		$atts = $this->atts;
		$attributes = $wrapper_attributes = array();
		$title = !empty($atts['title']) ? $atts['title'] : '';
		$tag_title = !empty($atts['tag_title']) ? $atts['tag_title'] : 'h2';
		$description = !empty($atts['description']) ? $atts['description'] : '';
		$title_color = !empty($atts['title_color']) ? $atts['title_color'] : '';
		$description_color = !empty($atts['description_color']) ? $atts['description_color'] : '';
		$layout = !empty($atts['layout']) ? $atts['layout'] : 'gt-type-1';
		$spacing = !empty($atts['spacing']) ? $atts['spacing'] : 'gt-with-spacing';
		$columns = !empty($atts['columns']) ? $atts['columns'] : 3;
		$sort = $atts['sort'] == 'yes' ? true : false;
		$css_animation = !empty($atts['css_animation']) ? $atts['css_animation'] : '';
		$paginate = !empty($atts['paginate']) ? $atts['paginate'] : 'pagination';
		$data_rel = 'data-fancybox-group=portfolio-'. rand() .'';

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

		$css_classes = array(
			'gt-portfolio-holder',
			'gt-isotope',
			$layout, $spacing,
			'gt-paginate-' . $paginate
		);

		if ( empty($atts['img_size'] ) ) {
			if ( $atts['masonry'] ) {
				$attributes['m'] = 'true';
				$css_classes[] = 'gt-isotope-masonry';
			}
		}

		$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );

		if ( '' !== $css_animation ) {
			$wrapper_attributes[] = Gatsby_Helper::create_data_string_animation( $css_animation, 0, '20' );
		}

		ob_start(); ?>

		<div class="wpb_content_element">

			<?php
			echo Gatsby_Vc_Config::getParamTitle(
				array(
					'title' => $title,
					'tag_title' => $tag_title,
					'description' => $description,
					'title_color' => $title_color,
					'description_color' => $description_color,
				)
			);
			?>

			<div class="<?php echo esc_attr( trim($css_class) ) ?>" <?php echo gatsby_create_data_string($attributes) ?>>

				<?php echo ( $sort ) ? $this->sort_links( $this->entries->posts, $atts ) : ""; ?>

				<?php $i = 1; ?>

				<div class="gt-isotope-container <?php echo 'gt-cols-' . absint($columns) ?>" <?php echo implode(' ', $wrapper_attributes) ?>>

					<?php foreach ( $this->loop as $entry ): extract(array_merge($defaults, $entry)); ?>

						<?php if ( $i == 1 && $atts['masonry'] ): ?>
							<div class="gt-grid-sizer"></div>
						<?php endif; ?>

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

						<?php $i++; ?>

					<?php endforeach; ?>

					<?php wp_reset_postdata(); ?>

				</div><!--/ .gt-isotope-container-->

			</div>


			<?php if ( $paginate == 'load-more' ): ?>
				<?php echo $this->load_more_button(); ?>
			<?php elseif ( $paginate == "pagination" && $gatsby_pagination = gatsby_pagination($this->entries) ) : ?>
				<?php echo $gatsby_pagination; ?>
			<?php endif; ?>

		</div>

		<?php return ob_get_clean();
	}

	public function load_more_button() {
		?><div class="aligncenter">
				<a href="javasript:void(0)" class="gt-btn-3 gt-large gt-shadow gt-load-more" <?php echo gatsby_create_data_string($this->atts); ?>><?php esc_html_e('Show Me More', 'gatsby') ?></a>
			</div>
		<?php
	}

	public function prepare_entries($params) {
		$this->loop = array();

		if ( empty($params )) $params = $this->atts;
		if ( empty($this->entries) || empty($this->entries->posts) ) return;

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