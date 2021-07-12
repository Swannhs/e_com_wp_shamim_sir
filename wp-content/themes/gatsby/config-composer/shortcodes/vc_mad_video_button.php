<?php

class WPBakeryShortCode_VC_mad_video_button extends WPBakeryShortCode {

	public $atts = array();

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'link' => 'https://vimeo.com/51589652',
			'image' => '',
			'align' => 'left'
		), $atts, 'vc_mad_video_button');

		$html = $this->html();

		return $html;
	}

	public function html() {

		$link = $image = $align = '';
		extract($this->atts);

		ob_start(); ?>

		<!-- - - - - - - - - - - - - - Counter - - - - - - - - - - - - - - - - -->

		<?php if ( !empty($link) ): ?>

			<div class="gt-media-content align<?php echo esc_attr($align) ?>">

				<?php if ( !empty($image) && absint($image) ): ?>

					<a href="<?php echo esc_url($link) ?>" class="fancybox-media gt-video-box">
						<?php echo Gatsby_Helper::get_the_thumbnail( $image, '', true, '', array( 'alt' => '' ) ); ?>
					</a>

				<?php else: ?>

					<a href="<?php echo esc_url($link) ?>" class="fancybox-media gt-icon-play"></a>

				<?php endif; ?>

			</div><!--/ .gt-media-content-->

		<?php endif; ?>

		<!-- - - - - - - - - - - - - - End of Counter - - - - - - - - - - - - - - - - -->

		<?php return ob_get_clean();
	}

}