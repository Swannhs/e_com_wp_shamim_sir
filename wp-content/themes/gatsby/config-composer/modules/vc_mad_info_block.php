<?php
if (!class_exists('gatsby_info_block')) {

	class gatsby_info_block {

		function __construct() {
			add_action('vc_before_init', array($this, 'add_map'));
		}

		function add_map() {

			if ( function_exists('vc_map') ) {

				vc_map(
					array(
					   "name" => esc_html__("Infoblock", 'gatsby' ),
					   "base" => "vc_mad_info_block",
					   "class" => "vc_mad_info_block",
					   "icon" => "icon-wpb-mad-info-block",
					   "category"  => esc_html__('Gatsby', 'gatsby'),
					   "description" => esc_html__('Styled info blocks', 'gatsby'),
					   "as_parent" => array('only' => 'vc_mad_info_block_item'),
					   "content_element" => true,
					   "show_settings_on_create" => false,
					   "params" => array(
						   array(
							   'type' => 'textfield',
							   'heading' => esc_html__( 'Title', 'gatsby' ),
							   'param_name' => 'title',
							   'description' => esc_html__( 'Enter text which will be used as title. Leave blank if no title is needed.', 'gatsby' ),
				 			   'edit_field_class' => 'vc_col-sm-6'
						   ),
						   array(
							   'type' => 'dropdown',
							   'heading' => esc_html__( 'Tag for title', 'gatsby' ),
							   'param_name' => 'tag_title',
							   'value' => array(
								   'h2' => 'h2',
								   'h3' => 'h3'
							   ),
							   'std' => '',
							   'edit_field_class' => 'vc_col-sm-6',
							   'description' => esc_html__( 'Choose tag for title.', 'gatsby' )
						   ),
						   array(
							   'type' => 'textfield',
							   'heading' => esc_html__( 'Description', 'gatsby' ),
							   'param_name' => 'description',
							   'description' => esc_html__( 'Enter text which will be used as description. Leave blank if no description is needed.', 'gatsby' )
						   ),
						   array(
							   'type' => 'colorpicker',
							   'heading' => esc_html__( 'Color for title', 'gatsby' ),
							   'param_name' => 'title_color',
							   'group' => esc_html__( 'Styling', 'gatsby' ),
							   'edit_field_class' => 'vc_col-sm-6',
							   'description' => esc_html__( 'Select custom color for title.', 'gatsby' ),
						   ),
						   array(
							   'type' => 'colorpicker',
							   'heading' => esc_html__( 'Color for description', 'gatsby' ),
							   'param_name' => 'description_color',
							   'group' => esc_html__( 'Styling', 'gatsby' ),
							   'edit_field_class' => 'vc_col-sm-6',
							   'description' => esc_html__( 'Select custom color for description.', 'gatsby' ),
						   ),
						   array(
							   "type" => "dropdown",
							   "heading" => esc_html__( 'Select type', 'gatsby' ),
							   "param_name" => "type",
							   "value" => array(
								   esc_html__('Type 1', 'gatsby') => 'gt-type-1',
								   esc_html__('Type 2', 'gatsby') => 'gt-type-2',
								   esc_html__('Type 3', 'gatsby') => 'gt-type-3',
								   esc_html__('Type 4', 'gatsby') => 'gt-type-4',
								   esc_html__('Type 5', 'gatsby') => 'gt-type-5',
								   esc_html__('Type 6', 'gatsby') => 'gt-type-6',
							   ),
							   "std" => 'gt-type-1',
							   "description" => esc_html__( 'Choose type for this info block.', 'gatsby' )
						   ),
						   array(
							   'type' => 'dropdown',
							   'heading' => esc_html__( 'Columns', 'gatsby' ),
							   'param_name' => 'columns',
							   'value' => array(
								   esc_html__( '1 Columns', 'gatsby' ) => 1,
								   esc_html__( '2 Columns', 'gatsby' ) => 2,
								   esc_html__( '3 Columns', 'gatsby' ) => 3,
								   esc_html__( '4 Columns', 'gatsby' ) => 4
							   ),
							   'std' => 3,
							   'description' => esc_html__( 'How many columns should be displayed?', 'gatsby' )
						   )						),
						"js_view" => 'VcColumnView'
					));

				vc_map(
					array(
					   "name" => esc_html__("Info Block Item", 'gatsby'),
					   "base" => "vc_mad_info_block_item",
					   "class" => "vc_mad_info_block_item",
					   "icon" => "icon-wpb-mad-info-block",
					   "category" => esc_html__('Infoblock', 'gatsby'),
					   "content_element" => true,
					   "as_child" => array('only' => 'vc_mad_info_block'),
					   "is_container" => true,
					   "params" => array(
						   array(
							   "type" => "textfield",
							   "heading" => esc_html__( 'Title', 'gatsby' ),
							   "param_name" => "title",
							   "holder" => "h4",
							   "description" => ''
						   ),
						   array(
							   "type" => "choose_icons",
							   "heading" => esc_html__("Icon", 'gatsby'),
							   "param_name" => "icon",
							   "value" => 'none',
							   "description" => esc_html__( 'Select icon from library.', 'gatsby')
						   ),
						   array(
							   'type' => 'textarea_html',
							   'holder' => 'div',
							   'heading' => esc_html__( 'Text', 'gatsby' ),
							   'param_name' => 'content',
							   'value' => wp_kses(__( '<p>Click edit button to change this text.</p>', 'gatsby' ), array('p' => array()) )
						   ),
						   gatsby_vc_map_add_css_animation(),
						   gatsby_vc_map_add_animation_delay(),
						   gatsby_vc_map_add_scroll_factor()
					    )
					) 
				);							

			}
		}

	}

	if (class_exists('WPBakeryShortCodesContainer')) {

		class WPBakeryShortCode_vc_mad_info_block extends WPBakeryShortCodesContainer {

			protected function content($atts, $content = null) {

				$title = $tag_title = $description = $title_color = $description_color = $type = $columns = '';

				extract(shortcode_atts(array(
					'title' => '',
					'tag_title' => 'h2',
					'description' => '',
					'title_color' => '',
					'description_color' => '',
					'type' => 'gt-type-1',
					'columns' => 4
				), $atts));

				$css_class = array(
					'gt-infoblock', $type,
					'gt-infoblock-columns-' . absint($columns)
				);

				global $vc_mad_info_block_args;

				$vc_mad_info_block_args[] = array (
					'title_color' => $title_color,
					'description_color' => $description_color,
					'content' => $content
				);

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

					<div class="<?php echo esc_attr( implode(' ', $css_class) ); ?>">
						<?php echo wpb_js_remove_wpautop ($content, false ) ?>
					</div><!--/ .infoblock-->

				</div>

				<?php return ob_get_clean() ;

			}

		}

		class WPBakeryShortCode_vc_mad_info_block_item extends WPBakeryShortCode {

			protected function content($atts, $content = null) {

				$wrapper_attributes = array();
				$title = $style = $type = $icon = $css_animation = $animation_delay = $scroll_factor = $link = '';

				extract(shortcode_atts(array(
					'title' => '',
					'icon' => '',
					'css_animation' => '',
					'animation_delay' => '',
					'scroll_factor' => ''
				),$atts));

				$css_classes = array(
					'gt-infoblock-item'
				);

				if ( $content == null )
					$content = ' ';

				$title_color = $description_color = '';

				global $vc_mad_info_block_args;

				if ( isset($vc_mad_info_block_args) && is_array($vc_mad_info_block_args) ) {

					foreach ( $vc_mad_info_block_args as $info_block ) {

						if ( strpos( $info_block['content'], $content ) == true ) {
							if ( isset($info_block['title_color']) && !empty($info_block['title_color']) ) {
								$title_color = 'style="' . vc_get_css_color( 'color', $info_block['title_color'] ) . '"';
							}

							if ( isset($info_block['description_color']) && !empty($info_block['description_color']) ) {
								$description_color = 'style="' . vc_get_css_color( 'color', $info_block['description_color'] ) . '"';
							}
						}

					}

				}

				if ( '' !== $css_animation  ) {
					$wrapper_attributes[] = Gatsby_Helper::create_data_string_animation( $css_animation, $animation_delay, $scroll_factor );
				}

				$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
				$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

				ob_start(); ?>

				<div <?php echo implode( ' ', $wrapper_attributes ) ?>>

					<div class="gt-icon-box">

						<?php if ( $icon != '' ): ?>

							<div class="gt-icon-wrap">
								<span class="lnr <?php echo esc_attr($icon) ?>"></span>
							</div><!--/ .gt-icon-wrap -->

						<?php endif; ?>

						<?php if ( !empty($title) ): ?>
							<h6 <?php echo sprintf('%s', $title_color) ?>><?php echo esc_html($title); ?></h6>
						<?php endif; ?>

						<?php if ( !empty($content) ): ?>
							<div class="gt-icon-content" <?php echo sprintf('%s', $description_color) ?>>
								<?php echo wpb_js_remove_wpautop( $content, true ) ?>
							</div>
						<?php endif; ?>

					</div><!--/ .gt-icon-box -->

				</div>

				<?php return ob_get_clean();
			}

		}

	}

	new gatsby_info_block();
}