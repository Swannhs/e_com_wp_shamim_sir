<?php

class WPBakeryShortCode_VC_mad_testimonials extends WPBakeryShortCode {

	public $atts = array();
	public $entries = '';

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'title' 	 => '',
			'tag_title'  => 'h2',
			'description' 	 => '',
			'title_color' => '',
			'description_color' => '',
			'text_color' => '',
			'company_color' => '',
			'layout' => 'gt-type-1',
			'carousel' => '',
			'items' => 6,
			'categories' => array(),
			'orderby' => 'date',
			'order' => 'DESC',
			'columns' => 3,
			'link' => '',
			'css_animation' => ''
		), $atts, 'vc_mad_testimonials');

		$this->query_entries();
		return $this->html();
	}

	public function query_entries() {
		$params = $this->atts;
		$page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : get_query_var( 'page' );
		if (!$page || $params['pagination'] == 'no') $page = 1;

		$tax_query = array();

		if ( !empty($params['categories']) ) {
			$categories = explode(',', $params['categories']);
			$tax_query = array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'testimonials_category',
					'field' => 'id',
					'terms' => $categories
				)
			);
		}

		$query = array(
			'post_type' => 'testimonials',
			'orderby' => $params['orderby'],
			'order' => $params['order'],
			'paged' => $page,
			'posts_per_page' => $params['items'],
			'tax_query' 	 => $tax_query
		);

		$this->entries = new WP_Query($query);
	}

	public function html() {

		if ( empty($this->entries) || empty($this->entries->posts) ) return;

		$params = $this->atts;
		$wrapper_attributes = array();
		$layout = $carousel = $columns = $items = $categories = $orderby = $order = $style = $style_for_company = $link = '';

		$title = $tag_title = $type = $columns = $filter = $pagination = '';
		$description = !empty($params['description']) ? $params['description'] : '';
		$title_color = !empty($params['title_color']) ? $params['title_color'] : '';
		$description_color = !empty($params['description_color']) ? $params['description_color'] : '';
		$text_color = !empty($params['text_color']) ? $params['text_color'] : '';
		$company_color = !empty($params['company_color']) ? $params['company_color'] : '';
		$css_animation = !empty($params['css_animation']) ? $params['css_animation'] : '';

		extract($this->atts);

		$css_classes = array(
			'gt-testimonials-holder', $layout
		);

		if ( $carousel ) {
			$css_classes[] = 'owl-carousel';
		}

		if ( $layout == 'gt-type-1' && $carousel ) {
			$css_classes[] = 'owl-large-nav';
		}

		if ( $layout == 'gt-type-2' || $layout == 'gt-type-3' ) {
			$css_classes[] = 'gt-cols-' . absint($columns);
		}

		if ( $text_color ) {
			$style = 'style="' . vc_get_css_color( 'color', $text_color ) . '"';
		}

		if ( $company_color ) {
			$style_for_company = 'style="' . vc_get_css_color( 'color', $company_color ) . '"';
		}

		$random = rand(10, 200);
		$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
		$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

		if ( $carousel ) {
			$wrapper_attributes[] = 'id="sync-carousel-'. absint($random) .'"';
		}

		if ( '' !== $css_animation ) {
			$wrapper_attributes[] = Gatsby_Helper::create_data_string_animation( $css_animation, 0, 0 );
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

			<div <?php echo implode( ' ', $wrapper_attributes ) ?>>

				<?php if ( $layout == 'gt-type-1' ): ?>

					<?php foreach ( $this->entries->posts as $entry ):
						$id = $entry->ID;
						$content = has_excerpt($id) ? apply_filters( 'the_excerpt', $entry->post_excerpt ) : '';
						?>

						<div class="gt-testimonial">
							<blockquote><?php echo do_shortcode($content); ?></blockquote>
						</div>

					<?php endforeach; ?>

				<?php elseif ( $layout == 'gt-type-2' ): ?>

					<?php foreach ( $this->entries->posts as $entry ):
						$id = $entry->ID;
						$name = get_the_title($id);
						$link  = get_permalink($id);
						$company = mad_meta( 'gatsby_tm_company', '', $id );
						$content = has_excerpt($id) ? apply_filters( 'the_excerpt', $entry->post_excerpt ) : '';
						$alt = trim(strip_tags(get_post_meta($id, '_wp_attachment_image_alt', true)));
						if ( empty($alt) ) {
							$attachment = get_post($id);
							$alt = trim(strip_tags($attachment->post_title));
						}
						$thumbnail_atts = array(
							'title'	=> trim(strip_tags($entry->post_title)),
							'alt' => $alt
						);
						?>

						<div class="gt-testimonial">

							<!-- - - - - - - - - - - - - - Author Box - - - - - - - - - - - - - - - - -->

							<div class="gt-author-box">

								<?php if ( has_post_thumbnail($id) ): ?>

									<a href="<?php echo esc_url($link) ?>" class="gt-avatar">
										<?php echo Gatsby_Helper::get_the_post_thumbnail( $id, '70*70', true, '', $thumbnail_atts ) ?>
									</a>

								<?php endif; ?>

								<div class="gt-author-info">

									<a href="<?php echo esc_url($link) ?>" <?php echo sprintf('%s', $style) ?> class="gt-author-name"><?php echo esc_html($name) ?></a>
									<span class="gt-author-company" <?php echo sprintf('%s', $style_for_company) ?>><?php echo esc_html($company) ?></span>

								</div><!--/ .gt-author-info -->

							</div><!--/ .gt-author-box -->

							<!-- - - - - - - - - - - - - - End of Author Box - - - - - - - - - - - - - - - - -->

							<!-- - - - - - - - - - - - - - Comment - - - - - - - - - - - - - - - - -->

							<blockquote <?php echo sprintf('%s', $style) ?>><?php echo do_shortcode($content); ?></blockquote>

							<!-- - - - - - - - - - - - - - End of Comment - - - - - - - - - - - - - - - - -->

						</div>

					<?php endforeach; ?>

				<?php elseif ( $layout == 'gt-type-3' ): ?>

					<?php foreach ( $this->entries->posts as $entry ):
						$id = $entry->ID;
						$name = get_the_title($id);
						$link  = get_permalink($id);
						$company = mad_meta( 'gatsby_tm_company', '', $id );
						$content = has_excerpt($id) ? apply_filters( 'the_excerpt', $entry->post_excerpt ) : '';
						$alt = trim(strip_tags(get_post_meta($id, '_wp_attachment_image_alt', true)));
						if ( empty($alt) ) {
							$attachment = get_post($id);
							$alt = trim(strip_tags($attachment->post_title));
						}
						$thumbnail_atts = array(
							'title'	=> trim(strip_tags($entry->post_title)),
							'alt' => $alt
						);
						?>

						<div class="gt-testimonial">

							<!-- - - - - - - - - - - - - - Author Box - - - - - - - - - - - - - - - - -->

							<div class="gt-author-box">

								<?php if ( has_post_thumbnail($id) ): ?>

									<a href="<?php echo esc_url($link) ?>" class="gt-avatar">
										<?php echo Gatsby_Helper::get_the_post_thumbnail( $id, '70*70', true, '', $thumbnail_atts ) ?>
									</a>

								<?php endif; ?>

								<div class="gt-author-info">

									<a href="<?php echo esc_url($link) ?>" <?php echo sprintf('%s', $style) ?> class="gt-author-name"><?php echo esc_html($name) ?></a>
									<span class="gt-author-company" <?php echo sprintf('%s', $style_for_company) ?>><?php echo esc_html($company) ?></span>

								</div><!--/ .gt-author-info -->

							</div><!--/ .gt-author-box -->

							<!-- - - - - - - - - - - - - - End of Author Box - - - - - - - - - - - - - - - - -->

							<!-- - - - - - - - - - - - - - Comment - - - - - - - - - - - - - - - - -->

							<blockquote <?php echo sprintf('%s', $style) ?>><?php echo do_shortcode($content); ?></blockquote>

							<!-- - - - - - - - - - - - - - End of Comment - - - - - - - - - - - - - - - - -->

						</div>

					<?php endforeach; ?>

				<?php endif; ?>

			</div>

			<?php if ( $layout == 'gt-type-1' && $carousel ): ?>

				<?php
				if ( '' !== $css_animation ) {
					$wrapper_attributes[] = Gatsby_Helper::create_data_string_animation( $css_animation, 0, 0 );
				}
				?>

				<div class="owl-carousel gt-authors-holder" data-sync="#sync-carousel-<?php echo absint($random) ?>" <?php echo ( '' !== $css_animation ) ? Gatsby_Helper::create_data_string_animation( $css_animation, 0, '' ) : '' ?>>

					<?php foreach ( $this->entries->posts as $entry ):
						$id = $entry->ID;
						$name = get_the_title($id);
						$link  = get_permalink($id);
						$position = mad_meta( 'gatsby_tm_position', '', $id );
						$company = mad_meta( 'gatsby_tm_company', '', $id );
						$alt = trim(strip_tags(get_post_meta($id, '_wp_attachment_image_alt', true)));
						if ( empty($alt) ) {
							$attachment = get_post($id);
							$alt = trim(strip_tags($attachment->post_title));
						}
						$thumbnail_atts = array(
							'title'	=> trim(strip_tags($entry->post_title)),
							'alt' => $alt
						);
						?>

						<div class="gt-author-box">

							<?php if ( has_post_thumbnail($id) ): ?>

								<a href="<?php echo esc_url($link) ?>" class="gt-avatar">
									<?php echo Gatsby_Helper::get_the_post_thumbnail($id, '70*70', true, '', $thumbnail_atts) ?>
								</a>

							<?php endif; ?>

							<div class="gt-author-info">

								<a href="<?php echo esc_url($link) ?>" class="gt-author-name"><?php echo esc_html($name) ?></a>
								<span class="gt-author-position"><?php echo esc_html($position) ?></span>
								<span class="gt-author-company"><?php echo esc_html($company) ?></span>

							</div><!--/ .gt-author-info -->

						</div><!--/ .gt-author-box -->

					<?php endforeach; ?>

				</div>

			<?php endif;  ?>

		</div>

		<?php return ob_get_clean();
	}

}