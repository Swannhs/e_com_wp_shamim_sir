<?php

class WPBakeryShortCode_VC_mad_services_list extends WPBakeryShortCode {

	public $atts = array();

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'values' => ''
		), $atts, 'vc_mad_info_list');

		$html = $this->html();

		return $html;
	}

	public function html() {

		$values = '';
		extract($this->atts);
		$values = (array) vc_param_group_parse_atts( $values );

		ob_start(); ?>

		<!-- - - - - - - - - - - - - - Counter - - - - - - - - - - - - - - - - -->

		<?php if ( !empty($values) ): ?>

			<div class="wpb_content_element">

				<div class="gt-services-holder">

					<?php foreach( $values as $value ): ?>

						<section class="gt-service">

							<?php if ( absint($value['image']) ): ?>
								<img class="gt-service-image" src="<?php echo Gatsby_Helper::get_post_attachment_image($value['image'], '') ?>" alt="">
							<?php endif; ?>

							<h2 class="gt-service-title"><?php echo esc_attr($value['label']) ?></h2>

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

						</section>

					<?php endforeach; ?>

				</div><!--/ .gt-services-holder-->

			</div>

		<?php endif; ?>

		<!-- - - - - - - - - - - - - - End of Counter - - - - - - - - - - - - - - - - -->

		<?php return ob_get_clean();
	}

}