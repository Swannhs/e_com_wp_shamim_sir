<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$title = $tag_title = $description = $title_color = $description_color = '';

extract( shortcode_atts( array(
	'title' => '',
	'tag_title' => 'h2',
	'description' => '',
	'title_color' => '',
	'description_color' => '',
	'type' => 'gt-type-1',
	'css_animation' => ''
), $atts ) );

global $tabarr;
$tabarr = array();

do_shortcode( $content );

ob_start(); ?>

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

		<div class="gt-tabs-holder <?php echo esc_attr($type) ?>">

			<nav class="gt-tabs-nav-wrap" <?php echo ( '' !== $css_animation ) ? Gatsby_Helper::create_data_string_animation( $css_animation, 0, 0 ) : '' ?>>

				<ul class="gt-tabs-nav">

					<?php if ( isset($tabarr) && !empty($tabarr) ): ?>

						<?php foreach( $tabarr as $key => $value ): ?>
							<li><a href="#tab-<?php echo esc_attr($value['tab_id']) ?>">
									<?php if (isset($value['icon']) && $value['icon'] != 'none'): ?>
										<span class="<?php echo esc_attr($value['icon']) ?>"></span>
									<?php endif; ?>
								<?php echo esc_html($value['title']) ?></a>
							</li>
						<?php endforeach; ?>

					<?php endif; ?>

				</ul>

			</nav>

			<div class="gt-tabs-container" <?php echo ( '' !== $css_animation ) ? Gatsby_Helper::create_data_string_animation( $css_animation, 130, '-130' ) : '' ?>>
				<?php echo wpb_js_remove_wpautop( $content ) ?>
			</div>

		</div><!--/ .gt-tabs-holder-->

	</div>

<?php echo ob_get_clean();
