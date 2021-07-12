<?php

class WPBakeryShortCode_VC_mad_info_list extends WPBakeryShortCode {

	public $atts = array();

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'values' => ''
		), $atts, 'vc_mad_info_list');

		$html = $this->html();

		return $html;
	}

	public function html() {

		extract($this->atts);
		$values = (array) vc_param_group_parse_atts( $values );

		ob_start(); ?>

		<!-- - - - - - - - - - - - - - Counter - - - - - - - - - - - - - - - - -->

		<?php if ( !empty($values) ): ?>

			<div class="wpb_content_element">

				<ul class="gt-info-list">

					<?php foreach( $values as $value ): ?>

						<li>
							<?php if ( isset($value['label']) ): ?>
								<div class="gt-item-name"><?php echo esc_attr($value['label']) ?></div>
							<?php endif; ?>

							<?php if ( isset($value['value']) ): ?>
								<?php echo wp_kses( $value['value'], array(
									'ul' => array(),
									'li' => array(),
									'a' => array(
										'href' => array(),
										'title' => array()
									),
									'br' => array(),
									'em' => array(),
									'strong' => array(),
									'p' => array()
								)) ?>
							<?php endif; ?>

						</li>

					<?php endforeach; ?>

				</ul><!--/ .gt-info-list-->

			</div>

		<?php endif; ?>

		<!-- - - - - - - - - - - - - - End of Counter - - - - - - - - - - - - - - - - -->

		<?php return ob_get_clean();
	}

}