<?php

class WPBakeryShortCode_VC_mad_instagram extends WPBakeryShortCode {

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'title' => '',
			'username' => '',
			'number' => 6,
			'target' => '_self',
			'link' => ''
		), $atts, 'vc_mad_instagram');

		$html = $this->html();

		return $html;
	}

	function html() {

		$output = '';

		$atts = vc_map_get_attributes( $this->getShortcode(), $this->atts );

		extract($this->atts);

		$output = '<div class="gatsby_widget_instagram">';
		$type = 'gatsby_instagram_widget';
		$args = array();
		global $wp_widget_factory;

		if ( is_object( $wp_widget_factory ) && isset( $wp_widget_factory->widgets, $wp_widget_factory->widgets[ $type ] ) ) {
			ob_start();
			the_widget( $type, $atts, $args );
			$output .= ob_get_clean();

			$output .= '</div>';

			echo $output;
		} else {
			echo $this->debugComment( 'Widget ' . esc_attr( $type ) . 'Not found' );
		}

	}

}