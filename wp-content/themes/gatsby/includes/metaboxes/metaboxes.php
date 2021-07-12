<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

/**
 * The Metaboxes class.
 */
class Gatsby_Theme_Metaboxes {

	/**
	 * The settings.
	 *
	 * @access public
	 * @var array
	 */
	public $data;

	/**
	 * The class constructor.
	 *
	 * @access public
	 */
	public function __construct() {
		require_once get_template_directory() . '/includes/metaboxes/inc/loader.php';
		$loader = new MAD_Loader;
		$loader->init();

		add_filter( 'mad_meta_boxes', array(&$this, 'meta_boxes_array') );
	}

	public function meta_boxes_array($meta_boxes) {

		/*	Meta Box Definitions
		/* ---------------------------------------------------------------------- */

		$prefix = 'gatsby_';

		/*	Layout Settings
		/* ---------------------------------------------------------------------- */

		$pages = get_pages('title_li=&orderby=name');
		$list_pages = array('' => 'None');
		foreach ( $pages as $key => $entry ) {
			$list_pages[$entry->ID] = $entry->post_title;
		}

		$registered_sidebars = Gatsby_Helper::get_registered_sidebars(array(' ' => 'Default Sidebar'), array('General Widget Area'));
		$registered_custom_sidebars = array();

		foreach( $registered_sidebars as $key => $value ) {
			if ( strpos($key, 'Footer Row') === false ) {
				$registered_custom_sidebars[$key] = $value;
			}
		}

		$meta_boxes[] = array(
			'id'       => 'layout-settings',
			'title'    => esc_html__('Gatsby Page Options', 'gatsby'),
			'pages'    => array( 'post', 'page', 'product' ),
			'context'  => 'normal',
			'priority' => 'low',
			'fields'   => array(
				array(
					'name'    => esc_html__('Header Type', 'gatsby'),
					'id'      => $prefix . 'header_type',
					'type'    => 'select_advanced',
					'std'     => '',
					'js_options' => array(
						'width' => '100%',
						'minimumResultsForSearch' => '-1',
						'placeholder' => esc_html__('Default Header Type', 'gatsby')
					),
					'desc'    => esc_html__('Choose your header type', 'gatsby'),
					'options' => array(
						' ' => esc_html__('Default Header Type', 'gatsby'),
						'gt-type-1' => esc_html__('Type 1', 'gatsby'),
						'gt-type-2' => esc_html__('Type 2', 'gatsby'),
						'gt-type-3' => esc_html__('Type 3', 'gatsby'),
						'gt-type-4' => esc_html__('Type 4', 'gatsby'),
						'gt-type-5' => esc_html__('Type 5', 'gatsby'),
						'gt-type-6' => esc_html__('Type 6', 'gatsby'),
						'gt-type-7' => esc_html__('Type 7', 'gatsby'),
						'gt-type-8' => esc_html__('Type 8', 'gatsby'),
						'gt-type-9' => esc_html__('Type 9', 'gatsby'),
					)
				),
				array(
					'name'    => esc_html__('Menu Alignment', 'gatsby'),
					'id'      => $prefix . 'header_type_6_alignment',
					'type'    => 'select',
					'std'     => ' ',
//					'js_options' => array(
//						'width' => '100%',
//						'minimumResultsForSearch' => '-1',
//						'placeholder' => esc_html__('Default Menu Alignment', 'gatsby')
//					),
					'desc'    => esc_html__('Choose menu alignment', 'gatsby'),
					'required' => true,
					'options' => array(
						' ' => esc_html__('Default Menu Alignment', 'gatsby'),
						'align-left' => esc_html__('Left', 'gatsby'),
						'align-right' => esc_html__('Right', 'gatsby'),
					),
					'visible' => [ $prefix . 'header_type', '=', 'gt-type-6' ]
				),
				array(
					'name'    => esc_html__('Page Wrapper', 'gatsby'),
					'id'      => $prefix . 'wrapper',
					'type'    => 'select_advanced',
					'std'     => '',
					'js_options' => array(
						'width' => '100%',
						'minimumResultsForSearch' => '-1',
						'placeholder' => esc_html__('Default Page Wrapper', 'gatsby')
					),
					'desc'    => esc_html__('Choose page wrapper', 'gatsby'),
					'options' => array(
						' ' => esc_html__('Default Page Wrapper', 'gatsby'),
						'gt-wide-layout-type' => esc_html__('Wide', 'gatsby'),
						'gt-boxed-layout-type' => esc_html__('Boxed', 'gatsby')
					)
				),
				array(
					'name'    => esc_html__('Sidebar Position', 'gatsby'),
					'id'      => $prefix . 'page_sidebar_position',
					'type'    => 'select_advanced',
					'std'     => '',
					'js_options' => array(
						'width' => '100%',
						'minimumResultsForSearch' => '-1',
						'placeholder' => esc_html__('Default Sidebar Position', 'gatsby')
					),
					'desc'    => esc_html__('Choose page sidebar position', 'gatsby'),
					'options' => array(
						' ' => esc_html__('Default Sidebar Position', 'gatsby'),
						'gt-no-sidebar' => esc_html__('Without Sidebar', 'gatsby'),
						'gt-left-sidebar' => esc_html__('Left Sidebar', 'gatsby'),
						'gt-right-sidebar' => esc_html__('Right Sidebar', 'gatsby')
					)
				),
				array(
					'name'    => esc_html__('Sidebar Setting', 'gatsby'),
					'id'      => $prefix . 'page_sidebar',
					'type'    => 'select_advanced',
					'std'     => '',
					'js_options' => array(
						'width' => '100%',
						'minimumResultsForSearch' => '-1',
						'placeholder' => esc_html__('Choose a custom sidebar', 'gatsby')
					),
					'desc'    => esc_html__('Choose a custom sidebar', 'gatsby'),
					'options' => $registered_custom_sidebars
				),
				array(
					'name'    => esc_html__('Page Content Padding', 'gatsby'),
					'id'      => $prefix . 'page_content_padding',
					'type'    => 'dimension',
					'std'     => '',
					'desc'    => esc_html__('In pixels ex: 50px. Leave empty for default value of 120, 120px.', 'gatsby'),
					'options' => array(
						'top', 'bottom'
					),
				),
				array(
					'name'    => esc_html__('Hide Footer', 'gatsby'),
					'id'      => $prefix . 'hide_footer',
					'type'    => 'checkbox',
					'std'     => 0,
					'desc'    => esc_html__('Boolean: Hide footer', 'gatsby'),
				),
				array(
					'name'    => esc_html__('Coming Soon', 'gatsby'),
					'id'      => $prefix . 'coming_soon',
					'type'    => 'checkbox',
					'std'     => 0,
					'desc'    => esc_html__('Boolean: page coming soon', 'gatsby'),
				),
				array(
					'name'    => esc_html__('Type Coming Soon', 'gatsby'),
					'id'      => $prefix . 'type_coming_soon',
					'type'    => 'select',
					'std'     => ' ',
					'desc'    => esc_html__('Choose type coming soon', 'gatsby'),
					'required' => true,
					'options' => array(
						'gt-coming-soon-type-1' => esc_html__('Type 1', 'gatsby'),
						'gt-coming-soon-type-2' => esc_html__('Type 2', 'gatsby'),
					),
					'visible' => [ $prefix . 'coming_soon', '=', 1 ]
				),
			)
		);

		/*	Team Settings
		/* ---------------------------------------------------------------------- */

		$meta_boxes[] = array(
			'id'       => 'team-settings',
			'title'    => esc_html__('Team Settings', 'gatsby'),
			'pages'    => array( 'team-members' ),
			'context'  => 'normal',
			'priority' => 'low',
			'fields'   => array(
				array(
					'name' => esc_html__('Position', 'gatsby'),
					'id'   => $prefix . 'tm_position',
					'type' => 'text',
					'std'  => '',
					'desc' => ''
				),
				array(
					'name' => esc_html__('LinkedIn', 'gatsby'),
					'id'   => $prefix . 'tm_linkedin',
					'type' => 'text',
					'std'  => '',
					'desc' => ''
				),
				array(
					'name' => esc_html__('Tumblr', 'gatsby'),
					'id'   => $prefix . 'tm_tumblr',
					'type' => 'text',
					'std'  => '',
					'desc' => ''
				),
				array(
					'name' => esc_html__('Facebook', 'gatsby'),
					'id'   => $prefix . 'tm_facebook',
					'type' => 'text',
					'std'  => '',
					'desc' => ''
				),
				array(
					'name'    => esc_html__('Page Content Padding', 'gatsby'),
					'id'      => $prefix . 'page_content_padding',
					'type'    => 'dimension',
					'std'     => '',
					'desc'    => esc_html__('In pixels ex: 50px. Leave empty for default value of 120, 120px.', 'gatsby'),
					'options' => array(
						'top', 'bottom'
					),
				)
			)
		);

		/*	Testimonials Settings
		/* ---------------------------------------------------------------------- */

		$meta_boxes[] = array(
			'id'       => 'testimonials-settings',
			'title'    => esc_html__('Testimonials Settings', 'gatsby'),
			'pages'    => array('testimonials'),
			'context'  => 'normal',
			'priority' => 'low',
			'fields'   => array(
				array(
					'name' => esc_html__('Position', 'gatsby'),
					'id'   => $prefix . 'tm_position',
					'type' => 'text',
					'std'  => '',
					'desc' => ''
				),
				array(
					'name' => esc_html__('Company', 'gatsby'),
					'id'   => $prefix . 'tm_company',
					'type' => 'text',
					'std'  => '',
					'desc' => ''
				),
			)
		);

		/*	Portfolio Settings
		/* ---------------------------------------------------------------------- */

		$meta_boxes[] = array(
			'id'       => 'portfolio-settings',
			'title'    => esc_html__('Portfolio Settings', 'gatsby'),
			'pages'    => array('portfolio'),
			'context'  => 'normal',
			'priority' => 'low',
			'fields'   => array(
				array(
					'name'    => esc_html__('Image Size', 'gatsby'),
					'id'      => $prefix . 'image_size',
					'type'    => 'select_advanced',
					'js_options' => array(
						'width' => '100%',
						'minimumResultsForSearch' => '-1',
						'placeholder' => esc_html__('Default Page Wrapper', 'gatsby')
					),
					'options' => array(
						"small" => esc_html__('Small', 'gatsby'),
						"medium" => esc_html__('Medium', 'gatsby'),
						"large" => esc_html__('Large', 'gatsby'),
						"extra-large" => esc_html__('Extra-Large', 'gatsby')
					),
					'std'  => 'small',
					'desc' => esc_html__('Preset image size for the masonry cover image', 'gatsby')
				),
				array(
					'name'    => esc_html__('Portfolio Link', 'gatsby'),
					'id'      => $prefix . 'visit_to_website',
					'type'    => 'url',
					'std'     => '',
					'desc'    => esc_html__('External Link for the Portfolio', 'gatsby'),
				),
				array(
					'name'    => esc_html__('Related Items', 'gatsby'),
					'id'      => $prefix . 'related_items',
					'type'    => 'checkbox',
					'std'     => '0',
					'desc'    => esc_html__('Boolean: Hide related items', 'gatsby'),
				)

			)
		);

		/*	Backgrounds
		/* ---------------------------------------------------------------------- */

		$meta_boxes[] = array(
			'id'       => 'page-backgrounds',
			'title'    => esc_html__('Backgrounds', 'gatsby'),
			'pages'    => array('page'),
			'context'  => 'normal',
			'priority' => 'default',
			'fields'   => array(
				array(
					'name'    => esc_html__('Body Background color', 'gatsby'),
					'id'      => $prefix . 'body_bg_color',
					'type'    => 'color',
					'std'     => '',
					'desc'    => esc_html__('Select the background color of the body', 'gatsby')
				),
				array(
					'name'    => esc_html__('Background image', 'gatsby'),
					'id'      => $prefix . 'bg_image',
					'type'    => 'thickbox_image',
					'std'     => '',
					'desc'    => esc_html__('Select the background image', 'gatsby')
				),
				array(
					'name'    => esc_html__('Background repeat', 'gatsby'),
					'id'      => $prefix . 'bg_image_repeat',
					'type'    => 'select',
					'std'     => '',
					'desc'    => esc_html__('Select the repeat mode for the background image', 'gatsby'),
					'options' => array(
						'' => esc_html__('Default', 'gatsby'),
						'repeat' => esc_html__('Repeat', 'gatsby'),
						'no-repeat' => esc_html__('No Repeat', 'gatsby'),
						'repeat-x' => esc_html__('Repeat Horizontally', 'gatsby'),
						'repeat-y' => esc_html__('Repeat Vertically', 'gatsby')
					)
				),
				array(
					'name'    => esc_html__('Background position', 'gatsby'),
					'id'      => $prefix . 'bg_image_position',
					'type'    => 'select',
					'std'     => '',
					'desc'    => esc_html__('Select the position for the background image', 'gatsby'),
					'options' => array(
						'' => esc_html__('Default', 'gatsby'),
						'top left' => esc_html__('Top left', 'gatsby'),
						'top center' => esc_html__('Top center', 'gatsby'),
						'top right' => esc_html__('Top right', 'gatsby'),
						'bottom left' => esc_html__('Bottom left', 'gatsby'),
						'bottom center' => esc_html__('Bottom center', 'gatsby'),
						'bottom right' => esc_html__('Bottom right', 'gatsby')
					)
				),
				array(
					'name'    => esc_html__('Background attachment', 'gatsby'),
					'id'      => $prefix . 'bg_image_attachment',
					'type'    => 'select',
					'std'     => '',
					'desc'    => esc_html__('Select the attachment for the background image ', 'gatsby'),
					'options' => array(
						'' => esc_html__('Default', 'gatsby'),
						'scroll' => esc_html__('Scroll', 'gatsby'),
						'fixed' => esc_html__('Fixed', 'gatsby')
					)
				),
				array(
					'name'    => esc_html__('Footer Background color', 'gatsby'),
					'id'      => $prefix . 'footer_bg_color',
					'type'    => 'color',
					'std'     => '',
					'desc'    => esc_html__('Select the background color of the footer', 'gatsby')
				),
			)
		);

		return $meta_boxes;
	}

}

new Gatsby_Theme_Metaboxes;
