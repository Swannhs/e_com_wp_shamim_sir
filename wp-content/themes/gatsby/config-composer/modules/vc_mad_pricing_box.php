<?php
if ( !class_exists('gatsby_pricing_box') ) {

	class gatsby_pricing_box {

		function __construct() {
			add_action('vc_before_init', array($this, 'add_map_pricing_box'));
		}
		
		function add_map_pricing_box() {

			if ( function_exists('vc_map') ) {

				vc_map(
					array(
					   "name" => esc_html__("Pricing Box", 'gatsby' ),
					   "base" => "vc_mad_pricing_box",
					   "class" => "vc_mad_pricing_box",
					   "icon" => "icon-wpb-mad-pricing-box",
					   "category"  => esc_html__('Gatsby', 'gatsby'),
					   "description" => esc_html__('Styled pricing tables', 'gatsby'),
					   "as_parent" => array('only' => 'vc_mad_pricing_box_item'),
					   "content_element" => true,
					   "show_settings_on_create" => true,
					   "params" => array(
						   array(
								'type' => 'textfield',
								'heading' => esc_html__( 'Title', 'gatsby' ),
								'param_name' => 'title',
								'description' => esc_html__( 'Enter text which will be used as title. Leave blank if no title is needed.', 'gatsby' ),
								'edit_field_class' => 'vc_col-sm-6',
						   ),
						   array(
							   'type' => 'dropdown',
							   'heading' => esc_html__( 'Tag for title', 'gatsby' ),
							   'param_name' => 'tag_title',
							   'value' => array(
								   'h2' => 'h2',
								   'h3' => 'h3'
							   ),
							   'std' => 'h2',
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
							   'type' => 'dropdown',
							   'heading' => esc_html__( 'Layout', 'gatsby' ),
							   'param_name' => 'layout',
							   'value' => array(
								   esc_html__( 'Layout 1', 'gatsby' ) => 'gt-type-1',
								   esc_html__( 'Layout 2', 'gatsby' ) => 'gt-type-2',
							   ),
							   'description' => esc_html__( 'Choose the default layout here.', 'gatsby' )
						   ),
						   array(
							   'type' => 'dropdown',
							   'heading' => esc_html__( 'Columns', 'gatsby' ),
							   'param_name' => 'columns',
							   'value' => array(
								   esc_html__( '3 Columns', 'gatsby' ) => 3,
								   esc_html__( '4 Columns', 'gatsby' ) => 4,
							   ),
							   'std' => 3,
							   'description' => esc_html__( 'How many columns should be displayed?', 'gatsby' )
						   )
						),
						"js_view" => 'VcColumnView'
					));

				vc_map(
					array(
					   "name" => esc_html__("Pricing Box Item", 'gatsby'),
					   "base" => "vc_mad_pricing_box_item",
					   "class" => "vc_mad_pricing_box_item",
					   "icon" => "icon-wpb-mad-pricing-box",
					   "category" => esc_html__('Pricing Box', 'gatsby'),
					   "content_element" => true,
					   "as_child" => array('only' => 'vc_mad_pricing_box'),
					   "is_container" => false,
					   "params" => array(
						   array(
							   "type" => "textfield",
							   "heading" => esc_html__( 'Package Name / Title', 'gatsby' ),
							   "param_name" => "title",
							   "holder" => "h4",
							   "description" => esc_html__( 'Enter the package name or table heading.', 'gatsby' ),
							   "value" => '',
						   ),
						   array(
							   "type" => "textfield",
							   "heading" => esc_html__( 'Package Price', 'gatsby' ),
							   "param_name" => "price",
							   "holder" => "span",
							   "description" => esc_html__( 'Enter the price for this package', 'gatsby' ),
							   "value" => ''
						   ),
						   array(
							   "type" => "textarea",
							   "heading" => esc_html__( 'Features', 'gatsby' ),
							   "param_name" => "features",
							   "holder" => "span",
							   "description" => esc_html__( 'Create the features list using un-ordered list elements. Divide values with linebreaks (Enter). Example: Up to 50 users|Limited team members', 'gatsby' ),
							   "value" => esc_html__('1 user | No VPN access | 2 Gb allowed', 'gatsby')
						   ),
						   array(
							   "type" => "vc_link",
							   "heading" => esc_html__( 'Add URL to the whole box (optional)', 'gatsby' ),
							   "param_name" => "link",
						   ),
						   array(
							   'type' => 'checkbox',
							   'heading' => esc_html__( 'Featured', 'gatsby' ),
							   'param_name' => 'add_label',
							   'description' => esc_html__( 'Adds a nice label to your pricing box.', 'gatsby' ),
							   'value' => array( esc_html__( 'Yes, please', 'gatsby' ) => true )
						   ),
						   array(
							   'type' => 'attach_image',
							   'heading' => esc_html__( 'Image', 'gatsby' ),
							   'param_name' => 'image',
							   'value' => '',
							   'description' => esc_html__( 'Select image from media library. ( for only layout 2 )', 'gatsby' ),
						   ),
						   gatsby_vc_map_add_css_animation(false),
						   gatsby_vc_map_add_animation_delay(),
						   gatsby_vc_map_add_scroll_factor()
					    )
					)
				);

			}
		}

	}

	if ( class_exists('WPBakeryShortCodesContainer') ) {

		class WPBakeryShortCode_vc_mad_pricing_box extends WPBakeryShortCodesContainer {

			protected function content($atts, $content = null) {

				$title = $tag_title = $description = $title_color = $description_color = $layout = $columns = '';

				extract(shortcode_atts(array(
					'title' => '',
					'tag_title' => 'h2',
					'description' => '',
					'title_color' => '',
					'description_color' => '',
					'layout' => 'gt-type-1',
					'columns' => 3
				), $atts));

				$css_class = array(
					'gt-pricing-tables-holder',
					$layout,
					'gt-cols-' . absint($columns)
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

					<div class="<?php echo esc_attr(implode(' ', $css_class)); ?>">
						<?php echo wpb_js_remove_wpautop( $content, false ) ?>
					</div>

				</div>

				<?php return ob_get_clean() ;
			}

		}

		class WPBakeryShortCode_vc_mad_pricing_box_item extends WPBakeryShortCode {

			protected function content($atts, $content = null) {
				$title = $price = $features = $add_label = $link = "";

				extract( shortcode_atts(array(
					'title' => esc_html__('Free', 'gatsby'),
					'price' => '',
					'features' => '',
					'link' => '',
					'image' => '',
					'add_label' => false,
					'css_animation' => '',
					'animation_delay' => 0,
					'scroll_factor' => ''
				),$atts) );

				$link = ($link == '||') ? '' : $link;
				$link = vc_build_link($link);
				$a_href = $link['url'];
				$a_title = $link['title'];
				( $link['target'] != '' ) ? $a_target = $link['target'] : $a_target = '_self';

				$wrapper_attributes = array();
				$css_classes = array( 'gt-pricing-table' );

				if ( !empty($image) && absint($image) ) {
					$wrapper_attributes[] = 'data-gatsby-bg="'. Gatsby_Helper::get_post_attachment_image($image, '') .'"';
					$css_classes[] = 'gt-has-image';
				}

				if ( '' !== $css_animation  ) {
					$wrapper_attributes[] = Gatsby_Helper::create_data_string_animation( $css_animation, $animation_delay, $scroll_factor );
				}

				$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
				$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

				ob_start(); ?>

				<div <?php echo implode( ' ', $wrapper_attributes ) ?>>

					<?php if ( $add_label ): ?>
						<div class="gt-label"><?php echo esc_html__('Best Choice', 'gatsby') ?></div>
					<?php endif; ?>

					<header class="gt-pt-header">

						<div class="gt-pt-type"><?php echo esc_html($title); ?></div>
						<div class="gt-pt-price"><?php echo esc_html($price); ?></div>

					</header><!--/ .gt-pt-header -->

					<ul class="gt-pt-features-list">
						<?php
						$features = explode( '|', wp_strip_all_tags($features) );
						$feature_list = '';
						if ( is_array($features) ) {
							foreach ( $features as $feature ) {
								$feature_list .= "<li>{$feature}</li>";
							}
						}
						?>
						<?php echo wp_kses( $feature_list, array(
							'a' => array(
								'href' => true,
								'title' => true,
							),
							'li' => array()
						)); ?>
					</ul><!--/ .gt-features-list -->

					<?php if ( !empty($a_title) ): ?>

						<footer class="gt-pt-footer">
							<a href="<?php echo esc_url($a_href); ?>" title="<?php echo esc_attr($a_title) ?>" target="<?php echo esc_attr($a_target) ?>" class="gt-pricing-button"><?php echo esc_html($a_title); ?></a>
						</footer><!--/ .gt-pt-footer -->

					<?php endif; ?>

				</div><!--/ .gt-pricing-table-->

				<?php return ob_get_clean() ;
			}

		}
	}

	new gatsby_pricing_box();

}