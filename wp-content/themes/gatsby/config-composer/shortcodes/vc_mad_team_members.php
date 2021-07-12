<?php

class WPBakeryShortCode_VC_mad_team_members extends WPBakeryShortCode {

	public $atts = array();
	public $entries = '';

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts( array(
			'title' => '',
			'tag_title' => 'h2',
			'description' => '',
			'title_color' => '',
			'description_color' => '',
			'layout' => 'gt-type-1',
			'columns' => 4,
			'items' => 4,
			'desc_pos' => 'hover',
			'categories' => array(),
			'orderby' => 'date',
			'order' => 'DESC',
			'css_animation' => ''
		), $atts, 'vc_mad_team_members' );

		$this->query_entries();
		$html = $this->html();

		return $html;
	}

	public function query_entries() {
		$params = $this->atts;
		$tax_query = array();

		if ( !empty($params['categories']) ) {
			$categories = explode(',', $params['categories']);
			$tax_query = array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'team_category',
					'field' => 'id',
					'terms' => $categories
				)
			);
		}

		$query = array(
			'post_type' => 'team-members',
			'posts_per_page' => $params['items'],
			'orderby' => $params['orderby'],
			'order' => $params['order'],
			'tax_query' => $tax_query
		);

		$this->entries = new WP_Query($query);
	}

	public function html() {

		if ( empty($this->entries) || empty($this->entries->posts) ) return;

		global $gatsby_settings;

		$title = $tag_title = $description = $title_color = $desc_pos = $description_color = $layout = $columns = $css_animation = '';
		$wrapper_attributes = array();
		$excerpt_count = $gatsby_settings['team-member-excerpt-count'];

		extract($this->atts);

		$css_classes = array(
			'gt-team-holder', $layout, 'gt-cols-' . absint($columns), 'gt-' . $desc_pos
		);

		switch ( $layout ):
			case 'gt-type-1': $image_size = '330*330'; break;
			case 'gt-type-2': $image_size = '270*330'; break;
			default: 		  $image_size = '330*330'; break;
		endswitch;

		$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
		$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

		ob_start() ?>

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

				<?php $i = 0; ?>

				<?php foreach ( $this->entries->posts as $entry ): ?>

					<?php
						$id = $entry->ID;
						$name = get_the_title($id);
						$link  = get_permalink($id);
						$position = mad_meta('gatsby_tm_position', '', $id);
						$content = has_excerpt($id) ? $entry->post_excerpt : $entry->post_content;
						$thumbnail_atts = array(
							'alt'	=> trim(strip_tags($entry->post_title))
						);
						$content = gatsby_get_excerpt( $content, $excerpt_count );
					?>

					<div class="gt-team-member" <?php echo ( '' !== $css_animation ) ? Gatsby_Helper::create_data_string_animation( $css_animation, $i, '-130' ) : '' ?>>

						<!-- - - - - - - - - - - - - - Member Photo - - - - - - - - - - - - - - - - -->

						<?php if ( has_post_thumbnail($id) ): ?>

							<div class="gt-member-photo">
								<a href="<?php echo esc_url($link); ?>" class="gt-member-link">
									<?php echo Gatsby_Helper::get_the_post_thumbnail ( $id, $image_size, false, array(), $thumbnail_atts ) ?>
								</a>

								<?php if ( $desc_pos == 'hover' ):  ?>

									<!-- - - - - - - - - - - - - - About Member - - - - - - - - - - - - - - - - -->

									<div class="gt-member-about"><?php echo apply_filters( 'the_content', $content ); ?></div>

									<!-- - - - - - - - - - - - - - End of About Member - - - - - - - - - - - - - - - - -->

								<?php endif; ?>

							</div><!--/ .gt-member-photo-->

						<?php endif; ?>

						<!-- - - - - - - - - - - - - - End of Member Photo - - - - - - - - - - - - - - - - -->

						<div class="gt-member-holder">

							<h4 class="gt-member-name">
								<a href="<?php echo esc_url($link); ?>"><?php echo esc_html($name); ?></a>
							</h4>

							<?php if ( !empty($position) ): ?>
								<div class="gt-member-position"><?php echo esc_html($position) ?></div>
							<?php endif; ?>

							<?php echo gatsby_team_members_social_links($id); ?>

							<?php if ( $desc_pos == 'bottom' ):  ?>

								<!-- - - - - - - - - - - - - - About Member - - - - - - - - - - - - - - - - -->

								<div class="gt-member-about"><?php echo apply_filters( 'the_content', $content ); ?></div>

								<!-- - - - - - - - - - - - - - End of About Member - - - - - - - - - - - - - - - - -->

							<?php endif; ?>

							<!-- - - - - - - - - - - - - - End of Member Info - - - - - - - - - - - - - - - - -->

						</div><!--/ .gt-member-holder-->

						<!-- - - - - - - - - - - - - - Member Info - - - - - - - - - - - - - - - - -->

					</div><!--/ .gt-team-member-->

					<?php $i = $i + 100; ?>

				<?php endforeach; ?>

			</div>

		</div>

		<?php return ob_get_clean();
	}

}