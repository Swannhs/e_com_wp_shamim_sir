<?php

class WPBakeryShortCode_VC_mad_dropcap extends WPBakeryShortCode {

	public $atts = array();
	public $content = '';

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'type' => 'gt-type-1',
			'letter' => '',
			'image' => '',
			'dropcap_color' => '',
			'css_animation' => '',
			'animation_delay' => 0,
			'scroll_factor' => ''
		), $atts, 'vc_mad_dropcap');

		$this->content = $content;
		$html = $this->html();

		return $html;
	}

	public function html() {

		$type = $style = $letter = $output = $class = $dropcap = $color = $dropcap_color = $image = $bg = $css_animation = $animation = $animation_delay = $scroll_factor = "";

		extract($this->atts);

		if ( '' !== $letter ) {

			if ( !empty($dropcap_color) ) {

				switch ($type) {
					case 'gt-type-1':
					case 'gt-type-2':
						$color = vc_get_css_color( 'color', $dropcap_color );
					break;
				}

				if ( !empty($color) ) {
					$style = 'style="' . $color . '"';
				}

			}

			if ( $type == 'gt-type-3' ) {
				if ( absint($image) ) {
					$bg = 'data-dropcap-bg="'. Gatsby_Helper::get_post_attachment_image($image, '') .'"';
				}
			}

			$dropcap .= '<span '. $style .' class="gt-dropcap '. esc_attr($type) .'" '. $bg .' >'. esc_html($letter) .'</span>';

			if ( '' !== $css_animation  ) {
				$animation = Gatsby_Helper::create_data_string_animation( $css_animation, $animation_delay, $scroll_factor );
			}

			$output .= "<div class='wpb_content_element' ". $animation .">";
			$output .= $dropcap;
			$output .= wpb_js_remove_wpautop($this->content, true);
			$output .= '</div>';

		}

		return $output;
	}

}