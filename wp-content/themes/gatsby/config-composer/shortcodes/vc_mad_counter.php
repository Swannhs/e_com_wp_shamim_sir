<?php

class WPBakeryShortCode_VC_mad_counter extends WPBakeryShortCode {

	public $atts = array();

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'title' => '',
			'tag_title' => 'h2',
			'description' => '',
			'title_color' => '',
			'description_color' => '',
			'type' => 'gt-type-1',
			'values' => '',
			'css_animation' => ''
		), $atts, 'vc_mad_counter');

		$html = $this->html();

		return $html;
	}

	public function html() {

		$title = $tag_title = $description = $title_color = $description_color = $type = $values = $icon = $css_animation = '';

		extract($this->atts);
		$values = (array) vc_param_group_parse_atts( $values );

		$css_classes = array(
			'gt-counters-holder',
			'gt-cols-4',
			$type
		);
		$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );

		ob_start(); ?>

		<!-- - - - - - - - - - - - - - Counter - - - - - - - - - - - - - - - - -->

		<?php if ( !empty($values) ): ?>

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

				<div class="<?php echo esc_attr(trim($css_class)) ?>">

					<?php $i = 0; ?>

					<?php foreach( $values as $value ): ?>

						<?php if ( isset($value['icon']) ): ?>
							<?php $icon = trim($value['icon']); ?>
						<?php endif; ?>

						<div class="gt-counter <?php if ( !empty($icon)): ?>gt-with-icon<?php endif; ?>" data-value="<?php echo esc_attr($value['value']) ?>" <?php echo ( '' !== $css_animation ) ? Gatsby_Helper::create_data_string_animation( $css_animation, $i, '-80' ) : '' ?>>

							<?php if ( !empty($icon) ): ?>
								<span class="<?php echo trim($value['icon']) ?>"></span>
							<?php endif; ?>

							<div class="gt-counter-label">
								<?php echo esc_html($value['label']) ?>
							</div>

						</div><!--/ .gt-counter-->

						<?php $i = $i + 100; ?>

					<?php endforeach; ?>

				</div>

			</div>

		<?php endif; ?>

		<!-- - - - - - - - - - - - - - End of Counter - - - - - - - - - - - - - - - - -->

		<?php return ob_get_clean();
	}

}