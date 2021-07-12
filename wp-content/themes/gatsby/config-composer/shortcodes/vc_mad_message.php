<?php

class WPBakeryShortCode_VC_mad_message extends WPBakeryShortCode {

	public $atts = array();

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'message_box_style' => 'alert-success',
			'message_box_type' => 'gt-type-1'
		), $atts, 'vc_mad_message');

		$html = $this->html($content);

		return $html;
	}

	public function html($content) {

		$message_box_style = $message_box_type = '';

		extract( $this->atts);

		$css_classes = array(
			'gt-alert-box',
			$message_box_type
		);

		switch ( $message_box_style ) {
			case 'alert-success':
				$css_classes[] = 'gt-success';
				$iconClass = 'lnr-checkmark-circle';
			break;
			case 'alert-warning':
				$css_classes[] = 'gt-warning';
				$iconClass = 'lnr-alarm';
			break;
			case 'alert-info':
				$css_classes[] = 'gt-info';
				$iconClass = 'lnr-bubble';
			break;
			case 'alert-fail':
				$css_classes[] = 'gt-fail';
				$iconClass = 'lnr-warning';
			break;
			default:
				$css_classes[] = 'gt-success';
				$iconClass = 'lnr-checkmark-circle';
				break;
		}

		$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );

		ob_start(); ?>

		<div class="<?php echo esc_attr( trim( $css_class ) ) ?>">

			<div class="gt-alert-box-inner">

				<span class="gt-icon"><span class="lnr <?php echo esc_attr($iconClass) ?>"></span></span>
				<?php echo wpb_js_remove_wpautop( $content, true ); ?>

			</div><!--/ .gt-alert-box-inner -->

			<button class="gt-close"></button>

		</div>

		<?php return ob_get_clean();
	}

}