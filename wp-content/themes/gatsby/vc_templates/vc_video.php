<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $link
 * @var $el_class
 * @var $css
 * @var $css_animation
 * @var $el_width
 * @var $el_aspect
 * @var $align
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Video
 */
$title = $link = $el_class = $css = $css_animation = $el_width = $el_aspect = $align = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if ( '' === $link ) {
	return null;
}
$el_class = $this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation );

$video_w = 500;
$video_h = $video_w / 1.61; //1.61 golden ratio
/** @var WP_Embed $wp_embed */
global $wp_embed;
$embed = '';


$randID = rand(0, 1000);

if ( strpos($link, 'youtube') > 0 ) {

	wp_enqueue_script( 'vc_youtube_iframe_api_js' );

	parse_str( parse_url( $link, PHP_URL_QUERY ), $my_array_of_vars );

	$autoplay = ( $enable_autoplay == 'yes' ) ? '1' : '0';

	$embed .= "<div data-youtube-autoplay=". esc_attr($autoplay) ." data-youtube-video-id=". esc_attr($my_array_of_vars['v']) ." id='gatsby_player-". absint($randID) ."'></div>";

} else {

	if ( is_object( $wp_embed ) ) {
		$embed .= $wp_embed->run_shortcode( '[embed width="' . $video_w . '"' . $video_h . ']' . $link . '[/embed]' );
	}

}


$el_classes = array(
	'wpb_video_widget',
	'wpb_content_element',
	'vc_clearfix',
	$el_class,
	vc_shortcode_custom_css_class( $css, ' ' ),
	'vc_video-aspect-ratio-' . esc_attr( $el_aspect ),
	'vc_video-el-width-' . esc_attr( $el_width ),
	'vc_video-align-' . esc_attr( $align ),
);
$css_class = implode( ' ', $el_classes );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $css_class, $this->getShortcode(), $atts );

$has_video_class = '';

if ( has_shortcode($embed, 'video') ) {
	$embed = wp_video_shortcode(array(
		'src' => $link
	));
	$has_video_class = 'has-video-shortcode';
}

$output = '
	<div class="' . esc_attr( $css_class ) . '">
		<div class="wpb_wrapper">
			' . wpb_widget_title( array(
		'title' => $title,
		'extraclass' => 'wpb_video_heading',
	) ) . '
			<div class="wpb_video_wrapper">' . $embed . '</div>
		</div>
	</div>
';

echo $output;

if ( strpos($link, 'vimeo') > 0 && $enable_autoplay == 'yes' ): ?>

	<script src="https://player.vimeo.com/api/player.js"></script>
	<script>
		var vc_vimeo_iframe = document.querySelector('iframe');
		var vc_vimeo_player = new Vimeo.Player(vc_vimeo_iframe);

		if (vc_vimeo_player)
			vc_vimeo_player.play();

	</script>

<?php endif; ?>
