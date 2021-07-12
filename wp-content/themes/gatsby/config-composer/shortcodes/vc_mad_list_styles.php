<?php

class WPBakeryShortCode_VC_mad_list_styles extends WPBakeryShortCode {

	public $atts = array();

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'icon' => '',
			'values' => '',
			'layout' => 'gt-type-1',
			'icon_color' => ''
		), $atts, 'vc_mad_list_styles');

		return $this->html();
	}

	public function html() {

	 	$icon = $list_items = $layout = $list_styles = $values = $style = '';

		extract($this->atts);

		ob_start(); ?>

		<?php if ( !empty($values) ): ?>

			<?php $values = explode('|', $values); ?>

			<?php if ( is_array($values) ): ?>

				<?php $icon = trim($icon); ?>

				<?php if ( $icon !== '' ): ?>

					<?php
						if ( !empty( $icon_color ) ) {
							$color = vc_get_css_color( 'color', $icon_color );
							$style = 'style="' . $color . '"';
						}

						$icon = '<i '. $style .' class="lnr '. $icon .'"></i>';
					?>

				<?php endif; ?>

				<?php foreach( $values as $value ) {
					$value = trim($value);
					$list_items .= "<li>{$icon}{$value}</li>";
				} ?>

			<?php endif; ?>

			<div class="wpb_content_element">
				<?php if ( $icon !== '' ): ?>
					<ul class="gt-list <?php echo esc_attr($layout) ?>"><?php echo wp_kses( $list_items,
							array(
								'a' => array(
									'href' => true,
									'title' => true,
								),
								'li' => array(),
								'i' => array(
									'class' => true,
									'style' => true
								),
								'strong' => array()
							)
						) ?></ul>
				<?php else: ?>
					<ol class="gt-list <?php echo esc_attr($layout) ?>"><?php echo wp_kses( $list_items,
							array(
								'a' => array(
									'href' => true,
									'title' => true,
								),
								'li' => array(),
								'i' => array(
									'class' => true,
									'style' => true
								),
								'strong' => array()
							)
						) ?></ol>
				<?php endif; ?>
			</div><!--/ .wpb_content_element-->

		<?php endif; ?>

		<?php return ob_get_clean();
	}

}