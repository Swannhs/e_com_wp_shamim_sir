<?php

class WPBakeryShortCode_VC_mad_photography extends WPBakeryShortCode {

	public $atts = array();
	public $entries = '';
	public $settings = array();

	protected function content( $atts, $content = null ) {

		$this->atts = shortcode_atts(array(
			'title' => '',
			'tag_title' => 'h2',
			'description' => '',
			'title_color' => '',
			'description_color' => '',
			'categories' => array(),
			'orderby' => 'menu_order',
			'order' => 'DESC',
			'columns' 	=> 4,
			'items' 	=> 10,
			'photography_id' => '',
			'css_animation' => ''
		), $atts, 'vc_mad_photography');

		$this->query_entries();
		$html = $this->html();

		return $html;
	}

	public function query_entries($params = array()) {

		if ( empty($params) ) $params = $this->atts;

//		$tax_query = array();
//
//		$page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : get_query_var( 'page' );
//		if ( !$page || $params['paginate'] == 'none' ) $page = 1;

//		if ( !empty($params['categories']) ) {
//			$tax_query = array(
//				'relation' => 'AND',
//				array(
//					'taxonomy' => 'photographycat',
//					'field' => 'id',
//					'terms' => explode(',', $params['categories'])
//				)
//			);
//		}

		$query = array(
			'post_type' => 'photography',
			'post_status'  => 'publish',
			'posts_per_page' => 1,
			'orderby' => $params['orderby'],
			'order' => $params['order'],
			'post__in' => array($params['photography_id'])
		);

//		if ( !empty($tax_query) ) {
//			$query['tax_query'] = $tax_query;
//		}

		$this->entries = new WP_Query($query);
		$this->prepare_entries($params);
	}

	public function html() {

		if ( empty($this->loop) ) return;

		$attributes = $wrapper_attributes = array();

		$params = $this->atts;
		$columns = !empty($params['columns']) ? $params['columns'] : 4;
		$data_rel = 'data-fancybox-group=gt-photography-'. rand() .'';

		$builder = get_post_meta( $params['photography_id'], 'gatsby_photography_builder', true );
		$positions = isset($builder['sliders']['positions']) ? $builder['sliders']['positions'] : '';

		if ( $positions ) {
			$attributes['positions'] = $positions;
		}

		extract($params);

		$defaults = array(
			'id' => '',
			'link' => '',
			'slides' => '',
			'image_size' => '370*370'
		);

		$css_classes = array(
			'gt-photography-holder',
		);

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

				<?php $i = 1; ?>

				<div class="gt-isotope-container <?php echo 'gt-cols-' . absint($columns) ?>" <?php echo implode(' ', $wrapper_attributes) ?>>

					<?php foreach ( $this->loop as $entry ): extract(array_merge($defaults, $entry)); ?>

						<?php if ( empty($slides) ) continue; ?>

						<?php foreach ( $slides as $key => $slide ): ?>

							<?php
								$attach_id = isset($slide['attach_id']) ? absint($slide['attach_id']) : '';
								$size =  isset( $slide['image_size'] ) ? $slide['image_size'] : 'small';
								$title = isset($slide['title']['value']) ? $slide['title']['value'] : '';
								$info = isset($slide['info']) ? $slide['info'] : '';
								$image_size = Gatsby_Custom_Content_Types_and_Taxonomies::get_image_portfolio_sizes( $size );
								$size_class = Gatsby_Custom_Content_Types_and_Taxonomies::get_size_class( $slide['image_size'] );

								$attachment_url = Gatsby_Helper::get_attachment_url($attach_id, $image_size);

								if ( $attachment_url == '' ) continue;

							?>

							<div class="gt-photo-col <?php echo esc_attr($size_class) ?>" data-item-id="<?php echo esc_attr($key) ?>">

								<div class="gt-project">

									<div class="gt-project-image">

										<a <?php echo esc_attr($data_rel) ?> href="<?php echo esc_url(Gatsby_Helper::get_attachment_url($attach_id)); ?>">
											<img src="<?php echo esc_attr($attachment_url); ?>" alt="<?php echo esc_attr($title) ?>">
										</a>

										<div class="gt-project-description" data-src="<?php echo Gatsby_Helper::get_attachment_url( $attach_id ) ?>">

											<div class="gt-description-inner">
												<h6 class="gt-project-title"><?php echo esc_html($title) ?></h6>
											</div><!--/ .gt-description-inner -->

											<?php if ( $info ): ?>

												<div class="gt-info-popup">
													<?php $info_array = explode(PHP_EOL, $info); ?>

													<?php if ( is_array($info_array) ): ?>

														<?php foreach( array_chunk($info_array, 2) as $item ): ?>

															<?php foreach( $item as $i => $in ): ?>
																<?php if ( $i == 0 ): ?>
																	<span class="gt-info-name"><?php echo esc_html($in) ?></span>
																<?php elseif ( $i == 1 ): ?>
																	<span class="gt-info-value"><?php echo esc_html($in) ?></span>
																<?php endif; ?>
															<?php endforeach; ?>

														<?php endforeach; ?>

													<?php endif; ?>

												</div>
												<a href="javascript: void(0)" title="<?php echo esc_attr__('Info', 'gatsby') ?>" class="gt-info-title-button"></a>

											<?php endif; ?>

										</div><!--/ .gt-project-description-->

									</div>

								</div><!--/ .gt-project-->

							</div><!--/ .gt-photo-col-->

							<?php $i++; ?>

						<?php endforeach; ?>

					<?php endforeach; ?>

				</div>

			</div>

		</div>

		<?php return ob_get_clean();
	}

	public function prepare_entries($params) {
		$this->loop = array();

		if ( empty($this->entries) || empty($this->entries->posts) ) return;

		foreach ( $this->entries->posts as $key => $entry ) {
			$this->loop[$key]['id'] = $id = $entry->ID;
			$this->loop[$key]['link'] = get_permalink($id);
			$this->loop[$key]['title'] = get_the_title($id);

			$builder = get_post_meta( $id, 'gatsby_photography_builder', true );
			$slides = $builder['sliders'];

			$this->loop[$key]['slides'] = isset( $slides['slides'] ) ? $slides['slides'] : '';
		}

	}

}