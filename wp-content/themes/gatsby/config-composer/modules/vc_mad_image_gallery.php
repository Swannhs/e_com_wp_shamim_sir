<?php
if (!class_exists('gatsby_image_video_gallery')) {

	class gatsby_image_video_gallery {

		function __construct() {
			add_action('vc_before_init', array($this, 'add_map_image_video_gallery'));
		}
		
		function add_map_image_video_gallery() {

			$target_arr = array(
				esc_html__( 'Same window', 'gatsby' ) => '_self',
				esc_html__( 'New window', 'gatsby' ) => "_blank"
			);

			if ( function_exists('vc_map') ) {

				vc_map(
					array(
					   "name" => esc_html__("Image Gallery", 'gatsby' ),
					   "base" => "vc_mad_image_gallery",
					   "class" => "vc_mad_image_gallery",
					   "icon" => "icon-wpb-mad-image-gallery",
					   "category"  => esc_html__('Gatsby', 'gatsby'),
					   "description" => esc_html__('Responsive image gallery', 'gatsby'),
					   "as_parent" => array('only' => 'vc_mad_image_gallery_item'),
					   "content_element" => true,
					   "show_settings_on_create" => false,
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
						),
						"js_view" => 'VcColumnView'
					));

				vc_map(
					array(
					   "name" => esc_html__("Image Gallery Item", 'gatsby'),
					   "base" => "vc_mad_image_gallery_item",
					   "class" => "vc_mad_image_gallery_item",
					   "icon" => "icon-wpb-images-stack",
					   "category" => esc_html__('Image Gallery', 'gatsby'),
					   "content_element" => true,
					   "as_child" => array('only' => 'vc_mad_image_gallery'),
					   "is_container" => false,
					   "params" => array(
							array(
								'type' => 'attach_image',
								'heading' => esc_html__( 'Image', 'gatsby' ),
								'param_name' => 'image',
								'value' => '',
								'description' => esc_html__( 'Select image from media library.', 'gatsby' )
							),
						   array(
							   'type' => 'textfield',
							   'heading' => esc_html__( 'Dimensions', 'gatsby' ),
							   'param_name' => 'dimensions',
							   "value" => '970*405',
							   'description' => esc_html__('Enter image size in pixels: 970*405 (Width * Height). Leave empty to use full size.', 'gatsby' )
						   ),
						   array(
							   'type' => 'dropdown',
							   'heading' => esc_html__( 'On click', 'gatsby' ),
							   'param_name' => 'onclick',
							   'value' => array(
								   esc_html__( 'Open Lightbox', 'gatsby' ) => 'link_image',
								   esc_html__( 'Do nothing', 'gatsby' ) => 'link_no',
								   esc_html__( 'Open custom link', 'gatsby' ) => 'custom_link'
							   ),
							   'description' => esc_html__( 'Define action for onclick event if needed.', 'gatsby' )
						   ),
						   array(
							   'type' => 'exploded_textarea',
							   'heading' => esc_html__( 'Custom link', 'gatsby' ),
							   'param_name' => 'custom_link',
							   'description' => esc_html__('Enter link.', 'gatsby' ),
							   'dependency' => array(
								   'element' => 'onclick',
								   'value' => array( 'custom_link' )
							   )
						   ),
						   array(
							   'type' => 'dropdown',
							   'heading' => esc_html__( 'Custom link target', 'gatsby' ),
							   'param_name' => 'custom_link_target',
							   'description' => esc_html__( 'Select where to open custom link.', 'gatsby' ),
							   'dependency' => array(
								   'element' => 'onclick',
								   'value' => array( 'custom_link' )
							   ),
							   'value' => $target_arr
						   )
					    )
					)
				);

			}
		}

	}

	if (class_exists('WPBakeryShortCodesContainer')) {

		class WPBakeryShortCode_vc_mad_image_gallery extends WPBakeryShortCodesContainer {

			protected function content($atts, $content = null) {

				$title = $tag_title = $description = $title_color = $description_color = '';

				extract(shortcode_atts(array(
					'title' => '',
					'tag_title' => 'h2',
					'description' => '',
					'title_color' => '',
					'description_color' => ''
				), $atts));

				$css_classes = array(
					'owl-carousel',
					'gt-simple-carousel'
				);

				if ( empty($content) ) return;

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

					<div class="<?php echo esc_attr( implode(' ', $css_classes) ); ?>"><?php echo wpb_js_remove_wpautop($content, false) ?></div>

				</div>

				<?php return ob_get_clean() ;
			}

		}

		class WPBakeryShortCode_vc_mad_image_gallery_item extends WPBakeryShortCode {

			protected function content($atts, $content = null) {

				$image = $dimensions = $onclick = $custom_link = $custom_link_target = $alt = '';

				extract(shortcode_atts(array(
					'image' => '',
					'dimensions' => '970*405',
					'onclick' => 'link_image',
					'custom_link' => '',
					'custom_link_target' => ''
				),$atts));

				ob_start(); ?>

				<?php if (isset($image) && $image > 0):
					$post_thumbnail = array();
					$alt = trim(strip_tags(get_post_meta($image, '_wp_attachment_image_alt', true)));
					$full_image = Gatsby_Helper::get_post_attachment_image($image, '');
					$post_thumbnail['p_img_large'] = Gatsby_Helper::get_post_attachment_image($image, $dimensions);
					$p_img_large = $post_thumbnail['p_img_large'];
					?>

					<div class="slide-item">

						<?php if ( $onclick == 'link_image' ): ?>

							<a data-fancybox-group="group" class="fancybox" href="<?php echo esc_url($full_image) ?>"><img src="<?php echo esc_attr($p_img_large) ?>" alt="<?php echo esc_attr($alt) ?>"></a>

						<?php elseif( $onclick == 'link_no' ): ?>

							<img src="<?php echo esc_attr($p_img_large) ?>" alt="<?php echo esc_attr($alt) ?>">

						<?php elseif ( $onclick == 'custom_link' && isset($custom_link) && $custom_link != '' ): ?>

							<a href="<?php echo esc_url($custom_link); ?>" <?php echo !empty($custom_link_target) ? ' target="' . $custom_link_target . '"' : '' ?>><img src="<?php echo esc_attr($p_img_large) ?>" alt="<?php echo esc_attr($alt) ?>"></a>

						<?php endif; ?>

					</div>

				<?php endif; ?>

				<?php return ob_get_clean() ;

			}

		}

	}

	$gatsby_image_video_gallery = new gatsby_image_video_gallery();
}