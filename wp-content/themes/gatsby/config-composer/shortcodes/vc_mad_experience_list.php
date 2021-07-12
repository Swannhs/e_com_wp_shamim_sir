<?php

class WPBakeryShortCode_VC_mad_experience_list extends WPBakeryShortCode {

	public $atts = array();

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'title' => '',
			'tag_title' => 'h2',
			'description' => '',
			'title_color' => '',
			'description_color' => '',
			'values' => ''
		), $atts, 'vc_mad_experience_list');

		$html = $this->html();

		return $html;
	}

	public function html() {

		$title = $tag_title = $description = $title_color = $description_color = $values = '';

		extract($this->atts);
		$values = (array) vc_param_group_parse_atts( $values );
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

				<ul class="experience_list">

					<?php foreach( $values as $value ): ?>

						<li>
							<div class="alignleft">

								<?php if ( !empty($value['name']) ): ?>
									<div class="company_name"><?php echo esc_html($value['name']) ?></div>
								<?php endif; ?>

								<?php if ( !empty($value['position']) ): ?>
									<div class="position"><?php echo esc_html($value['position']) ?></div>
								<?php endif; ?>

							</div>

							<?php if ( !empty($value['time']) ): ?>
								<div class="work_time"><?php echo esc_html($value['time']) ?></div>
							<?php endif; ?>

						</li>

					<?php endforeach; ?>

				</ul><!--/ .experience_list-->

			</div>

		<?php endif; ?>

		<!-- - - - - - - - - - - - - - End of Counter - - - - - - - - - - - - - - - - -->

		<?php return ob_get_clean();
	}

}