<?php

$target_arr = array(
	esc_html__( 'Same window', 'gatsby' ) => '_self',
	esc_html__( 'New window', 'gatsby' ) => '_blank',
);

function gatsby_vc_map_add_css_animation( $label = true ) {
	$data = array(
		'type' => 'dropdown',
		'heading' => esc_html__( 'CSS Animation', 'gatsby' ),
		'param_name' => 'css_animation',
		'admin_label' => $label,
		'value' => array(
			esc_html__( 'No', 'gatsby' ) => '',
			esc_html__( 'Fade In Up', 'gatsby' ) => 'fadeInUp',
			esc_html__( 'Zoom In Down', 'gatsby' ) => 'zoomInDown',
			esc_html__( 'Bounce In Down', 'gatsby' ) => 'bounceInDown',
			esc_html__( 'Bounce In Up', 'gatsby' ) => 'bounceInUp',
			esc_html__( 'Flip In Y', 'gatsby' ) => 'flipInY',
		),
		'group' => esc_html__( 'Animations', 'gatsby' ),
		'description' => esc_html__( 'Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'gatsby' )
	);

	return apply_filters( 'gatsby_vc_map_add_css_animation', $data, $label );
}

function gatsby_vc_map_add_animation_delay( $label = true ) {
	$data = array(
		'type' => 'number',
		'heading' => esc_html__( 'Animation delay', 'gatsby' ),
		'param_name' => 'animation_delay',
		'admin_label' => $label,
		'description' => '',
		'value' => 0,
		'dependency' => array(
			'element' => 'css_animation',
			'not_empty' => true
		),
		'group' => esc_html__( 'Animations', 'gatsby' )
	);

	return apply_filters( 'gatsby_vc_map_add_animation_delay', $data, $label );
}

function gatsby_vc_map_add_scroll_factor( $label = true ) {
	$data = array(
		'type' => 'number',
		'heading' => esc_html__( 'Scroll factor', 'gatsby' ),
		'param_name' => 'scroll_factor',
		'admin_label' => $label,
		'description' => esc_html__( 'Scroll factor', 'gatsby' ),
		'value' => '-80',
		'dependency' => array(
			'element' => 'css_animation',
			'not_empty' => true
		),
		'group' => esc_html__( 'Animations', 'gatsby' )
	);

	return apply_filters( 'gatsby_vc_map_add_scroll_factor', $data, $label );
}

function gatsby_vc_map_add_short_css_animation( $label = true ) {
	$data = array(
		'type' => 'dropdown',
		'heading' => esc_html__( 'CSS Animation', 'gatsby' ),
		'param_name' => 'css_animation',
		'admin_label' => $label,
		'value' => array(
			esc_html__( 'No', 'gatsby' ) => '',
			esc_html__( 'Yes', 'gatsby' ) => 'yes'
		),
		'group' => esc_html__( 'Animations', 'gatsby' ),
		'description' => esc_html__( 'Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'gatsby' )
	);

	return apply_filters( 'gatsby_vc_map_add_short_css_animation', $data, $label );
}

/* Default Custom Shortcodes
/* --------------------------------------------------------------------- */

/* Row
----------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Row' , 'gatsby' ),
	'base' => 'vc_row',
	'is_container' => true,
	'icon' => 'icon-wpb-row',
	'show_settings_on_create' => false,
	'category' => esc_html__( 'Content', 'gatsby' ),
	'description' => esc_html__( 'Place content elements inside the row', 'gatsby' ),
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Row stretch', 'gatsby' ),
			'param_name' => 'full_width',
			'value' => array(
				esc_html__( 'Default', 'gatsby' ) => '',
				esc_html__( 'Stretch row', 'gatsby' ) => 'stretch_row',
				esc_html__( 'Stretch row and content', 'gatsby' ) => 'stretch_row_content',
				esc_html__( 'Stretch row and content (no paddings)', 'gatsby' ) => 'stretch_row_content_no_spaces',
			),
			'description' => esc_html__( 'Select stretching options for row and content (Note: stretched may not work properly if parent container has "overflow: hidden" CSS property).', 'gatsby' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Columns gap', 'gatsby' ),
			'param_name' => 'gap',
			'value' => array(
				'0px' => '0',
				'1px' => '1',
				'2px' => '2',
				'3px' => '3',
				'4px' => '4',
				'5px' => '5',
				'10px' => '10',
				'15px' => '15',
				'20px' => '20',
				'25px' => '25',
				'30px' => '30',
				'35px' => '35',
			),
			'std' => '0',
			'description' => esc_html__( 'Select gap between columns in row.', 'gatsby' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Full height row?', 'gatsby' ),
			'param_name' => 'full_height',
			'description' => esc_html__( 'If checked row will be set to full height.', 'gatsby' ),
			'value' => array( esc_html__( 'Yes', 'gatsby' ) => 'yes' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Columns position', 'gatsby' ),
			'param_name' => 'columns_placement',
			'value' => array(
				esc_html__( 'Middle', 'gatsby' ) => 'middle',
				esc_html__( 'Top', 'gatsby' ) => 'top',
				esc_html__( 'Bottom', 'gatsby' ) => 'bottom',
				esc_html__( 'Stretch', 'gatsby' ) => 'stretch',
			),
			'description' => esc_html__( 'Select columns position within row.', 'gatsby' ),
			'dependency' => array(
				'element' => 'full_height',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Equal height', 'gatsby' ),
			'param_name' => 'equal_height',
			'description' => esc_html__( 'If checked columns will be set to equal height.', 'gatsby' ),
			'value' => array( esc_html__( 'Yes', 'gatsby' ) => 'yes' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Content position', 'gatsby' ),
			'param_name' => 'content_placement',
			'value' => array(
				esc_html__( 'Default', 'gatsby' ) => '',
				esc_html__( 'Top', 'gatsby' ) => 'top',
				esc_html__( 'Middle', 'gatsby' ) => 'middle',
				esc_html__( 'Bottom', 'gatsby' ) => 'bottom',
			),
			'description' => esc_html__( 'Select content position within columns.', 'gatsby' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Use video background?', 'gatsby' ),
			'param_name' => 'video_bg',
			'description' => esc_html__( 'If checked, video will be used as row background.', 'gatsby' ),
			'value' => array( esc_html__( 'Yes', 'gatsby' ) => 'yes' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Use scrolldown icon?', 'gatsby' ),
			'param_name' => 'scrolldown_icon',
			'description' => esc_html__( 'If checked, scrolldown icon will be used as icon in bottom.', 'gatsby' ),
			'value' => array( esc_html__( 'Yes', 'gatsby' ) => 'yes' ),
			'dependency' => array(
				'element' => 'full_height',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'YouTube link', 'gatsby' ),
			'param_name' => 'video_bg_url',
			'value' => 'https://www.youtube.com/watch?v=lMJXxhRFO1k',
			'description' => esc_html__( 'Add YouTube link.', 'gatsby' ),
			'dependency' => array(
				'element' => 'video_bg',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Parallax', 'gatsby' ),
			'param_name' => 'video_bg_parallax',
			'value' => array(
				esc_html__( 'None', 'gatsby' ) => '',
				esc_html__( 'Simple', 'gatsby' ) => 'content-moving'
			),
			'description' => esc_html__( 'Add parallax type background for row.', 'gatsby' ),
			'dependency' => array(
				'element' => 'video_bg',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Parallax', 'gatsby' ),
			'param_name' => 'parallax',
			'value' => array(
				esc_html__( 'None', 'gatsby' ) => '',
				esc_html__( 'Simple', 'gatsby' ) => 'content-moving',
			),
			'description' => esc_html__( 'Add parallax type background for row (Note: If no image is specified, parallax will use background image from Design Options).', 'gatsby' ),
			'dependency' => array(
				'element' => 'video_bg',
				'is_empty' => true,
			)
		),
		array(
			'type' => 'attach_image',
			'heading' => esc_html__( 'Image', 'gatsby' ),
			'param_name' => 'parallax_image',
			'value' => '',
			'description' => esc_html__( 'Select image from media library.', 'gatsby' ),
			'dependency' => array(
				'element' => 'parallax',
				'not_empty' => true,
			),
			'group' => esc_html__( 'Parallax', 'gatsby' )
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Overlay background color', 'gatsby' ),
			'param_name' => 'overlay_color',
			'description' => esc_html__( 'Select custom overlay color for background.', 'gatsby' ),
			'dependency' => array(
				'element' => 'parallax',
				'not_empty' => true,
			),
			'group' => esc_html__( 'Parallax', 'gatsby' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Parallax opacity', 'gatsby' ),
			'param_name' => 'parallax_opacity',
			'value' => '1',
			'description' => esc_html__( 'The opacity property can take a value from 0.0 - 1.0. The lower value, the more transparent. (Note: Default value is 0.5, min value 0 max value is 1)', 'gatsby' ),
			'dependency' => array(
				'element' => 'parallax',
				'not_empty' => true
			),
			'group' => esc_html__( 'Parallax', 'gatsby' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Parallax speed', 'gatsby' ),
			'param_name' => 'parallax_speed_video',
			'value' => '1.5',
			'description' => esc_html__( 'Enter parallax speed ratio (Note: Default value is 1.5, min value is 1)', 'gatsby' ),
			'dependency' => array(
				'element' => 'video_bg_parallax',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Parallax speed', 'gatsby' ),
			'param_name' => 'parallax_speed_bg',
			'value' => '1.5',
			'description' => esc_html__( 'Enter parallax speed ratio (Note: Default value is 1.5, min value is 1)', 'gatsby' ),
			'dependency' => array(
				'element' => 'parallax',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'el_id',
			'heading' => esc_html__( 'Row ID', 'gatsby' ),
			'param_name' => 'el_id',
			'description' => sprintf( __( 'Enter row ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'gatsby' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Disable row', 'gatsby' ),
			'param_name' => 'disable_element', // Inner param name.
			'description' => esc_html__( 'If checked the row won\'t be visible on the public side of your website. You can switch it back any time.', 'gatsby' ),
			'value' => array( esc_html__( 'Yes', 'gatsby' ) => 'yes' ),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'gatsby' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'gatsby' ),
		),
		array(
			'type' => 'css_editor',
			'heading' => esc_html__( 'CSS box', 'gatsby' ),
			'param_name' => 'css',
			'group' => esc_html__( 'Design Options', 'gatsby' ),
		),
	),
	'js_view' => 'VcRowView',
) );

vc_map(
	array(
		'name' => esc_html__( 'Text Block', 'gatsby' ),
		'base' => 'vc_column_text',
		'icon' => 'icon-wpb-layer-shape-text',
		'wrapper_class' => 'clearfix',
		'category' => esc_html__( 'Content', 'gatsby' ),
		'description' => esc_html__( 'A block of text with WYSIWYG editor', 'gatsby' ),
		'params' => array(
			array(
				'type' => 'textarea_html',
				'holder' => 'div',
				'heading' => esc_html__( 'Text', 'gatsby' ),
				'param_name' => 'content',
				'value' => esc_html__( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'gatsby' ),
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Extra class name', 'gatsby' ),
				'param_name' => 'el_class',
				'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'gatsby' ),
			),
			array(
				'type' => 'css_editor',
				'heading' => esc_html__( 'CSS box', 'gatsby' ),
				'param_name' => 'css',
				'group' => esc_html__( 'Design Options', 'gatsby' ),
			),
			gatsby_vc_map_add_css_animation(),
			gatsby_vc_map_add_animation_delay(),
			gatsby_vc_map_add_scroll_factor(),
		),
	)
);

/* Custom Heading element
----------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Custom Heading', 'gatsby' ),
	'base' => 'vc_custom_heading',
	'icon' => 'icon-wpb-ui-custom_heading',
	'show_settings_on_create' => true,
	'category' => esc_html__( 'Content', 'gatsby' ),
	'description' => esc_html__( 'Text with Google fonts', 'gatsby' ),
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Text source', 'gatsby' ),
			'param_name' => 'source',
			'value' => array(
				esc_html__( 'Custom text', 'gatsby' ) => '',
				esc_html__( 'Post or Page Title', 'gatsby' ) => 'post_title',
			),
			'std' => '',
			'description' => esc_html__( 'Select text source.', 'gatsby' ),
		),
		array(
			'type' => 'textarea',
			'heading' => esc_html__( 'Text', 'gatsby' ),
			'param_name' => 'text',
			'admin_label' => true,
			'value' => esc_html__( 'This is custom heading element', 'gatsby' ),
			'description' => esc_html__( 'Note: If you are using non-latin characters be sure to activate them under Settings/Visual Composer/General Settings.', 'gatsby' ),
			'dependency' => array(
				'element' => 'source',
				'is_empty' => true,
			),
		),
		array(
			'type' => 'vc_link',
			'heading' => esc_html__( 'URL (Link)', 'gatsby' ),
			'param_name' => 'link',
			'description' => esc_html__( 'Add link to custom heading.', 'gatsby' ),
		),
		array(
			'type' => 'font_container',
			'param_name' => 'font_container',
			'value' => 'tag:h2|text_align:left',
			'settings' => array(
				'fields' => array(
					'tag' => 'h2', // default value h2
					'text_align',
					'font_size',
					'line_height',
					'color',
					'tag_description' => esc_html__( 'Select element tag.', 'gatsby' ),
					'text_align_description' => esc_html__( 'Select text alignment.', 'gatsby' ),
					'font_size_description' => esc_html__( 'Enter font size.', 'gatsby' ),
					'line_height_description' => esc_html__( 'Enter line height.', 'gatsby' ),
					'color_description' => esc_html__( 'Select heading color.', 'gatsby' ),
				),
			),
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Use theme default font family?', 'gatsby' ),
			'param_name' => 'use_theme_fonts',
			'value' => array( esc_html__( 'Yes', 'gatsby' ) => 'yes' ),
			'description' => esc_html__( 'Use font family from the theme.', 'gatsby' ),
			'std' => 'yes'
		),
		array(
			'type' => 'google_fonts',
			'param_name' => 'google_fonts',
			'value' => 'font_family:Droid Serif:regular,italic,700,700italic',
			'settings' => array(
				'fields' => array(
					'font_family_description' => esc_html__( 'Select font family.', 'gatsby' ),
					'font_style_description' => esc_html__( 'Select font styling.', 'gatsby' ),
				),
			),
			'dependency' => array(
				'element' => 'use_theme_fonts',
				'value_not_equal_to' => 'yes',
			),
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'With border?', 'gatsby' ),
			'param_name' => 'with_border',
			'value' => array( esc_html__( 'Yes', 'gatsby' ) => true ),
			'description' => esc_html__( 'Use border bottom.', 'gatsby' ),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'gatsby' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'gatsby' ),
		),
		array(
			'type' => 'css_editor',
			'heading' => esc_html__( 'CSS box', 'gatsby' ),
			'param_name' => 'css',
			'group' => esc_html__( 'Design Options', 'gatsby' ),
		),
		gatsby_vc_map_add_css_animation(),
		gatsby_vc_map_add_animation_delay(),
		gatsby_vc_map_add_scroll_factor()
	),
) );

/* Theme Shortcodes
/* ---------------------------------------------------------------- */

/* Gallery/Slideshow
---------------------------------------------------------- */
vc_map( array(
	'name' => esc_html__( 'Image Gallery', 'gatsby' ),
	'base' => 'vc_gallery',
	'icon' => 'icon-wpb-images-stack',
	'category' => esc_html__( 'Content', 'gatsby' ),
	'description' => esc_html__( 'Responsive image gallery', 'gatsby' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Widget title', 'gatsby' ),
			'param_name' => 'title',
			'description' => esc_html__( 'Enter text used as widget title (Note: located above content element).', 'gatsby' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Image source', 'gatsby' ),
			'param_name' => 'source',
			'value' => array(
				esc_html__( 'Media library', 'gatsby' ) => 'media_library',
				esc_html__( 'External links', 'gatsby' ) => 'external_link',
			),
			'std' => 'media_library',
			'description' => esc_html__( 'Select image source.', 'gatsby' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Columns', 'gatsby' ),
			'param_name' => 'columns',
			'value' => array(
				esc_html__( '2 Columns', 'gatsby' ) => 2,
				esc_html__( '3 Columns', 'gatsby' ) => 3,
				esc_html__( '4 Columns', 'gatsby' ) => 4,
				esc_html__( '5 Columns', 'gatsby' ) => 5,
				esc_html__( '6 Columns', 'gatsby' ) => 6
			),
			'std' => 4,
			'description' => esc_html__( 'How many columns should be displayed?', 'gatsby' )
		),
		array(
			'type' => 'attach_images',
			'heading' => esc_html__( 'Images', 'gatsby' ),
			'param_name' => 'images',
			'value' => '',
			'description' => esc_html__( 'Select images from media library.', 'gatsby' ),
			'dependency' => array(
				'element' => 'source',
				'value' => 'media_library',
			),
		),
		array(
			'type' => 'exploded_textarea',
			'heading' => esc_html__( 'External links', 'gatsby' ),
			'param_name' => 'custom_srcs',
			'description' => esc_html__( 'Enter external link for each gallery image (Note: divide links with linebreaks (Enter)).', 'gatsby' ),
			'dependency' => array(
				'element' => 'source',
				'value' => 'external_link',
			),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Image size', 'gatsby' ),
			'param_name' => 'img_size',
			'value' => 'thumbnail',
			'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'gatsby' ),
			'dependency' => array(
				'element' => 'source',
				'value' => 'media_library',
			),
			'std' => '275x275'
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Image size', 'gatsby' ),
			'param_name' => 'external_img_size',
			'value' => '',
			'description' => esc_html__( 'Enter image size in pixels. Example: 200x100 (Width x Height).', 'gatsby' ),
			'dependency' => array(
				'element' => 'source',
				'value' => 'external_link',
			),
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Enable carousel', 'gatsby' ),
			'param_name' => 'carousel',
			'description' => esc_html__( 'Enable carousel.', 'gatsby' ),
			'value' => array( esc_html__( 'Yes, please', 'gatsby' ) => true )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'On click action', 'gatsby' ),
			'param_name' => 'onclick',
			'value' => array(
				esc_html__( 'Open lightbox', 'gatsby' ) => 'link_image',
				esc_html__( 'Open custom link', 'gatsby' ) => 'custom_link',
			),
			'description' => esc_html__( 'Select action for click action.', 'gatsby' ),
			'std' => 'link_image',
		),
		array(
			'type' => 'exploded_textarea',
			'heading' => esc_html__( 'Custom links', 'gatsby' ),
			'param_name' => 'custom_links',
			'description' => esc_html__( 'Enter links for each slide (Note: divide links with linebreaks (Enter)).', 'gatsby' ),
			'dependency' => array(
				'element' => 'onclick',
				'value' => array( 'custom_link' ),
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Custom link target', 'gatsby' ),
			'param_name' => 'custom_links_target',
			'description' => esc_html__( 'Select where to open  custom links.', 'gatsby' ),
			'dependency' => array(
				'element' => 'onclick',
				'value' => array( 'custom_link', 'img_link_large' ),
			),
			'value' => $target_arr,
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'gatsby' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'gatsby' ),
		),
		array(
			'type' => 'css_editor',
			'heading' => esc_html__( 'CSS box', 'gatsby' ),
			'param_name' => 'css',
			'group' => esc_html__( 'Design Options', 'gatsby' ),
		),
	),
) );

/* Button
---------------------------------------------------------- */

vc_map(array(
	'name' => esc_html__( 'Button', 'gatsby' ),
	'base' => 'vc_mad_btn',
	'icon' => 'icon-wpb-mad-button',
	'category' => array( esc_html__( 'Gatsby', 'gatsby' ) ),
	'description' => esc_html__( 'Eye catching button', 'gatsby' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Text', 'gatsby' ),
			'param_name' => 'title',
			'value' => esc_html__( 'Text on the button', 'gatsby' ),
		),
		array(
			'type' => 'vc_link',
			'heading' => esc_html__( 'URL (Link)', 'gatsby' ),
			'param_name' => 'link',
			'description' => esc_html__( 'Add link to button.', 'gatsby' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Shape', 'gatsby' ),
			'description' => esc_html__( 'Select button shape.', 'gatsby' ),
			'param_name' => 'shape',
			// need to be converted
			'value' => array(
				esc_html__( 'Rounded', 'gatsby' ) => 'gt-rounded',
				esc_html__( 'Square', 'gatsby' ) => 'gt-square',
				esc_html__( 'Round', 'gatsby' ) => 'gt-round',
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Size', 'gatsby' ),
			'param_name' => 'size',
			'description' => esc_html__( 'Select button display size.', 'gatsby' ),
			'std' => 'gt-small',
			'value' => array(
				esc_html__('Small', 'gatsby') => 'gt-small',
				esc_html__('Standard', 'gatsby') => 'gt-standard',
				esc_html__('Large', 'gatsby') => 'gt-large',
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Alignment', 'gatsby' ),
			'param_name' => 'align',
			'description' => esc_html__( 'Select button alignment.', 'gatsby' ),
			'value' => array(
				esc_html__( 'Inline', 'gatsby' ) => 'gt-inline',
				esc_html__( 'Left', 'gatsby' ) => 'gt-left',
				esc_html__( 'Right', 'gatsby' ) => 'gt-right',
				esc_html__( 'Center', 'gatsby' ) => 'gt-center',
			),
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Enable reverse', 'gatsby' ),
			'param_name' => 'reverse',
			'description' => esc_html__( 'Enable reverse.', 'gatsby' ),
			'value' => array( esc_html__( 'Yes, please', 'gatsby' ) => true )
		),
		gatsby_vc_map_add_css_animation(),
		gatsby_vc_map_add_animation_delay(),
		gatsby_vc_map_add_scroll_factor()
	),
));

/* Message
---------------------------------------------------------- */

vc_map(array(
	'name' => esc_html__( 'Message Box', 'gatsby' ),
	'base' => 'vc_mad_message',
	'icon' => 'icon-wpb-mad-message-box',
	'category' => esc_html__( 'Gatsby', 'gatsby' ),
	'description' => esc_html__( 'Notification boxes', 'gatsby' ),
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Style', 'gatsby' ),
			'param_name' => 'message_box_style',
			'value' => array(
				esc_html__('Success', 'gatsby') => 'alert-success',
				esc_html__('Warning', 'gatsby') => 'alert-warning',
				esc_html__('Info', 'gatsby') => 'alert-info',
				esc_html__('Fail', 'gatsby') => 'alert-fail',
			),
			'description' => esc_html__( 'Select message box style.', 'gatsby' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Type', 'gatsby' ),
			'param_name' => 'message_box_type',
			'value' => array(
				esc_html__('Type 1', 'gatsby') => 'gt-type-1',
				esc_html__('Type 2', 'gatsby') => 'gt-type-2',
			),
			'description' => esc_html__( 'Select message box type design.', 'gatsby' ),
		),
		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'class' => 'messagebox_text',
			'heading' => __( 'Message text', 'gatsby' ),
			'param_name' => 'content',
			'value' => __( '<p>I am message box. Click edit button to change this text.</p>', 'gatsby' ),
		)
	),
));


/* List Styles
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'List Styles', 'gatsby' ),
	'base' => 'vc_mad_list_styles',
	'icon' => 'icon-wpb-mad-list-styles',
	'category' => esc_html__( 'Gatsby', 'gatsby' ),
	'description' => esc_html__( 'List styles', 'gatsby' ),
	'params' => array(
		array(
			"type" => "choose_icons",
			"heading" => esc_html__("Icon", 'gatsby'),
			"param_name" => "icon",
			"value" => 'none',
			"description" => esc_html__( 'Select icon from library for you list styles. If you do not select an icon get a numbered list', 'gatsby')
		),
		array(
			'type' => 'exploded_textarea',
			'heading' => esc_html__( 'List Items', 'gatsby' ),
			'param_name' => 'values',
			'description' => esc_html__( 'Input list items values. Divide values with (|). Example: Development|Design', 'gatsby' ),
			'value' => ''
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Layout', 'gatsby' ),
			'param_name' => 'layout',
			'value' => array(
				esc_html__('Type 1', 'gatsby') => 'gt-type-1',
				esc_html__('Type 2', 'gatsby') => 'gt-type-2',
				esc_html__('Type 3', 'gatsby') => 'gt-type-3',
				esc_html__('Type 4', 'gatsby') => 'gt-type-4',
			),
			'std' => '',
			'description' => esc_html__('Choose layout style.', 'gatsby')
		),
	)
) );

/* Team Members
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Team Members', 'gatsby' ),
	'base' => 'vc_mad_team_members',
	'icon' => 'icon-wpb-mad-team-members',
	'category' => esc_html__( 'Gatsby', 'gatsby' ),
	'description' => esc_html__( 'Team Members post type', 'gatsby' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Title', 'gatsby' ),
			'param_name' => 'title',
			'description' => esc_html__( 'Enter text which will be used as title. Leave blank if no title is needed.', 'gatsby' ),
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
				esc_html__('Type 1', 'gatsby') => 'gt-type-1',
				esc_html__('Type 2', 'gatsby') => 'gt-type-2'
			),
			'std' => 'gt-type-1',
			'description' => esc_html__('Choose layout style.', 'gatsby')
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Position description', 'gatsby' ),
			'param_name' => 'desc_pos',
			'value' => array(
				esc_html__('On Hover', 'gatsby') => 'hover',
				esc_html__('Bottom', 'gatsby') => 'bottom',
				esc_html__('None', 'gatsby') => 'none'
			),
			'std' => 'hover',
			'description' => esc_html__('Choose position description.', 'gatsby')
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Columns', 'gatsby' ),
			'param_name' => 'columns',
			'value' => array(
				esc_html__( '3 Columns', 'gatsby' ) => 3,
				esc_html__( '4 Columns', 'gatsby' ) => 4
			),
			'description' => esc_html__( 'How many columns should be displayed?', 'gatsby' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Count Items', 'gatsby' ),
			'param_name' => 'items',
			'value' => Gatsby_Vc_Config::array_number(1, 30, 1, array('All' => '-1')),
			'std' => -1,
			'description' => esc_html__( 'How many items should be displayed per page?', 'gatsby' )
		),
		array(
			"type" => "get_terms",
			"term" => "team_category",
			'heading' => esc_html__( 'Which categories should be used for the team?', 'gatsby' ),
			"param_name" => "categories",
			"holder" => "div",
			'description' => esc_html__('The Page will then show team from only those categories.', 'gatsby'),
			'group' => esc_html__( 'Data Settings', 'gatsby' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Order By', 'gatsby' ),
			'param_name' => 'orderby',
			'value' => array(
				esc_html__( 'Date', 'gatsby' ) => 'date',
				esc_html__( 'ID', 'gatsby' ) => 'ID',
				esc_html__( 'Author', 'gatsby' ) => 'author',
				esc_html__( 'Title', 'gatsby' ) => 'title',
				esc_html__( 'Modified', 'gatsby' ) => 'modified',
				esc_html__( 'Random', 'gatsby' ) => 'rand',
				esc_html__( 'Comment count', 'gatsby' ) => 'comment_count',
				esc_html__( 'Menu order', 'gatsby' ) => 'menu_order'
			),
			'description' => ''
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Order', 'gatsby' ),
			'param_name' => 'order',
			'value' => array(
				esc_html__( 'DESC', 'gatsby' ) => 'DESC',
				esc_html__( 'ASC', 'gatsby' ) => 'ASC',
			),
			'description' => esc_html__( 'Direction Order', 'gatsby' )
		),
		gatsby_vc_map_add_css_animation()
	)
) );

/* Testimonials
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Testimonials', 'gatsby' ),
	'base' => 'vc_mad_testimonials',
	'icon' => 'icon-wpb-mad-testimonials',
	'category' => esc_html__( 'Gatsby', 'gatsby' ),
	'description' => esc_html__( 'Testimonials post type', 'gatsby' ),
	'params' => array(
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
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Color for content', 'gatsby' ),
			'param_name' => 'text_color',
			'group' => esc_html__( 'Styling', 'gatsby' ),
			'edit_field_class' => 'vc_col-sm-6',
			'description' => esc_html__( 'Select custom color for content.', 'gatsby' ),
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Color for author company', 'gatsby' ),
			'param_name' => 'company_color',
			'group' => esc_html__( 'Styling', 'gatsby' ),
			'edit_field_class' => 'vc_col-sm-6',
			'description' => esc_html__( 'Select custom color for author company.', 'gatsby' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Layout', 'gatsby' ),
			'param_name' => 'layout',
			'value' => array(
				esc_html__( 'Layout 1', 'gatsby' ) => 'gt-type-1',
				esc_html__( 'Layout 2', 'gatsby' ) => 'gt-type-2',
				esc_html__( 'Layout 3', 'gatsby' ) => 'gt-type-3',
			),
			'std' => 'gt-type-1',
			'description' => esc_html__( 'Choose the default blog layout here.', 'gatsby' )
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Enable carousel', 'gatsby' ),
			'param_name' => 'carousel',
			'description' => esc_html__( 'Enable carousel.', 'gatsby' ),
			'dependency' => array(
				'element' => 'layout',
				'value' => array( 'gt-type-1', 'gt-type-2' )
			),
			'value' => array( esc_html__( 'Yes, please', 'gatsby' ) => true )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Columns', 'gatsby' ),
			'param_name' => 'columns',
			'value' => array(
				esc_html__( '2 Columns', 'gatsby' ) => 2,
				esc_html__( '3 Columns', 'gatsby' ) => 3
			),
			'description' => esc_html__( 'How many columns should be displayed?', 'gatsby' ),
			'dependency' => array(
				'element' => 'layout',
				'value' => array( 'gt-type-2', 'gt-type-3' )
			)
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Count Items', 'gatsby' ),
			'param_name' => 'items',
			'value' => Gatsby_Vc_Config::array_number(1, 30, 1, array('All' => '-1')),
			'std' => -1,
			'description' => esc_html__( 'How many items should be displayed per page?', 'gatsby' )
		),
		array(
			"type" => "get_terms",
			"term" => "testimonials_category",
			'heading' => esc_html__( 'Which categories should be used for the testimonials?', 'gatsby' ),
			"param_name" => "categories",
			"holder" => "div",
			'description' => esc_html__('The Page will then show testimonials from only those categories.', 'gatsby'),
			'group' => esc_html__( 'Data Settings', 'gatsby' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Order By', 'gatsby' ),
			'param_name' => 'orderby',
			'value' => array(
				esc_html__( 'Date', 'gatsby' ) => 'date',
				esc_html__( 'ID', 'gatsby' ) => 'ID',
				esc_html__( 'Author', 'gatsby' ) => 'author',
				esc_html__( 'Title', 'gatsby' ) => 'title',
				esc_html__( 'Modified', 'gatsby' ) => 'modified',
				esc_html__( 'Random', 'gatsby' ) => 'rand',
				esc_html__( 'Comment count', 'gatsby' ) => 'comment_count',
				esc_html__( 'Menu order', 'gatsby' ) => 'menu_order'
			),
			'description' => esc_html__( 'Sort retrieved items by parameter', 'gatsby' ),
			'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( 'Data Settings', 'gatsby' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Order', 'gatsby' ),
			'param_name' => 'order',
			'value' => array(
				esc_html__( 'DESC', 'gatsby' ) => 'DESC',
				esc_html__( 'ASC', 'gatsby' ) => 'ASC',
			),
			'description' => esc_html__( 'Direction Order', 'gatsby' ),
			'edit_field_class' => 'vc_col-sm-6',
			'group' => esc_html__( 'Data Settings', 'gatsby' )
		),
		gatsby_vc_map_add_css_animation()
	)
) );

/* Countdown
---------------------------------------------------------- */

vc_map( array(
	"name" => esc_html__( "Countdown", 'gatsby' ),
	"base" => "vc_mad_countdown",
	"icon" => "icon-wpb-mad-countdown",
	'category' => esc_html__( 'Gatsby', 'gatsby' ),
	'description' => esc_html__( 'Countdown', 'gatsby' ),
	"params" => array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => esc_html__( "Title", 'gatsby' ),
			"param_name" => "title",
			"value" => '',
		),
		array(
			"type" => "datetimepicker",
			"class" => "",
			"heading" => esc_html__("Target Time For Countdown", 'gatsby'),
			"param_name" => "datetime",
			"value" => "",
			"description" => esc_html__("Date and time format (yyyy/mm/dd hh:mm:ss).", 'gatsby'),
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => esc_html__("Text align", 'gatsby'),
			"param_name" => "text_align",
			"value" => array(
				esc_html__("Left",'gatsby') => "left",
				esc_html__("Right",'gatsby') => "right",
				esc_html__("Center",'gatsby') => "center"
			)
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'gatsby' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'gatsby' )
		)
	)
) );

/* Brands Logo
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Brands Logo', 'gatsby' ),
	'base' => 'vc_mad_brands_logo',
	'icon' => 'icon-wpb-mad-brands-logo',
	'category' => esc_html__( 'Gatsby', 'gatsby' ),
	'description' => esc_html__( 'Brands logo', 'gatsby' ),
	'params' => array(
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
			'type' => 'attach_images',
			'heading' => esc_html__( 'Images', 'gatsby' ),
			'param_name' => 'images',
			'value' => '',
			'description' => esc_html__( 'Select images from media library.', 'gatsby' )
		),
		array(
			"type" => "textarea",
			"heading" => esc_html__( 'Links', 'gatsby' ),
			"param_name" => "links",
			"holder" => "span",
			"description" => esc_html__( 'Input links values. Divide values with linebreaks (|). Example: http://brand.com | http://brand2.com', 'gatsby' )
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Enable carousel', 'gatsby' ),
			'param_name' => 'carousel',
			'description' => esc_html__( 'Enable carousel.', 'gatsby' ),
			'value' => array( esc_html__( 'Yes, please', 'gatsby' ) => true )
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Autoplay', 'gatsby' ),
			'param_name' => 'autoplay',
			'description' => esc_html__( 'Enables autoplay mode.', 'gatsby' ),
			'value' => array( esc_html__( 'Yes, please', 'gatsby' ) => 'yes' )
		),
		array(
			'type' => 'number',
			'heading' => esc_html__( 'Autoplay timeout', 'gatsby' ),
			'param_name' => 'autoplaytimeout',
			'description' => esc_html__( 'Autoplay interval timeout', 'gatsby' ),
			'value' => 5000,
			'dependency' => array(
				'element' => 'autoplay',
				'value' => array( 'yes' )
			)
		),
		gatsby_vc_map_add_css_animation()
	)
) );

/* Blockquotes
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Blockquotes', 'gatsby' ),
	'base' => 'vc_mad_blockquotes',
	'icon' => 'icon-wpb-mad-testimonials',
	'category' => esc_html__( 'Gatsby', 'gatsby' ),
	'description' => esc_html__( 'Blockquotes styles', 'gatsby' ),
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Style', 'gatsby' ),
			'param_name' => 'style',
			'value' => array(
				esc_html__( 'Style 1', 'gatsby' ) => 'gt-type-1',
				esc_html__( 'Style 2', 'gatsby' ) => 'gt-type-2',
				esc_html__( 'Style 3', 'gatsby' ) => 'gt-type-3',
			),
			'std' => 'gt-type-1',
			'description' => esc_html__( 'Choose the default style for blockquote.', 'gatsby' )
		),
		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'heading' => esc_html__( 'Text', 'gatsby' ),
			'param_name' => 'content',
			'value' => esc_html__( '<p>I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>', 'gatsby' ),
		)

	)
));

/* Call to Action
---------------------------------------------------------- */

$wysija_forms = array();

if ( defined('WYSIJA') ) {
	$model_forms = WYSIJA::get( 'forms', 'model' );
	$model_forms->reset();
	$forms = $model_forms->getRows( array( 'form_id', 'name' ) );
	if ( $forms ) {
		foreach( $forms as $form ) {
			if ( isset($form) )
				$wysija_forms[$form['name']] = $form['form_id'];
		}
	}
}

vc_map( array(
	'name' => esc_html__( 'Call to Action', 'gatsby' ),
	'base' => 'vc_mad_cta',
	'icon' => 'icon-wpb-mad-cta',
	'category' => array( esc_html__( 'Gatsby', 'gatsby' ) ),
	'description' => esc_html__( 'Catch visitors attention with CTA block', 'gatsby' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Heading', 'gatsby' ),
			'admin_label' => true,
			'param_name' => 'h3',
			'value' => esc_html__( 'Hey! I am first heading line feel free to change me', 'gatsby' ),
			'description' => esc_html__( 'Enter text for heading line. \n = LF (Line Feed) - Used as a new line character', 'gatsby' ),
			'edit_field_class' => 'vc_col-sm-9',
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Text color', 'gatsby' ),
			'param_name' => 'custom_text',
			'description' => esc_html__( 'Select custom text color.', 'gatsby' ),
			'edit_field_class' => 'vc_col-sm-3',
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Subheading', 'gatsby' ),
			'param_name' => 'p',
			'value' => '',
			'description' => esc_html__( 'Enter text for subheading line.', 'gatsby' ),
			'edit_field_class' => 'vc_col-sm-9',
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Subheading Text color', 'gatsby' ),
			'param_name' => 'subheading_text',
			'description' => esc_html__( 'Select custom text color.', 'gatsby' ),
			'edit_field_class' => 'vc_col-sm-3',
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Type Style', 'gatsby' ),
			'param_name' => 'type',
			'value' => array(
				esc_html__( 'Default Style', 'gatsby' ) => '',
				esc_html__( 'White Style', 'gatsby' ) => 'gt-type-3',
				esc_html__( 'Black Style', 'gatsby' ) => 'gt-type-4',
			),
			'description' => esc_html__( 'Choose the style here', 'gatsby' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Add button or form?', 'gatsby' ),
			'param_name' => 'add',
			'value' => array(
				esc_html__( 'No', 'gatsby' ) => '',
				esc_html__( 'Button Right', 'gatsby' ) => 'button',
				esc_html__( 'Button Bottom', 'gatsby' ) => 'button_bottom',
				esc_html__( 'Subscribe Form', 'gatsby' ) => 'form',
			),
			'description' => esc_html__( 'Add button or form for call to action.', 'gatsby' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Select a form', 'gatsby' ),
			'param_name' => 'select_form',
			'value' => $wysija_forms,
			'group' => esc_html__( 'Form', 'gatsby' ),
			'description' => esc_html__( 'Select a form.', 'gatsby' ),
			'dependency' => array(
				'element' => 'add',
				'value' => array( 'form' )
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Form alignment', 'gatsby' ),
			'param_name' => 'position_form',
			'value' => array(
				esc_html__( 'Right', 'gatsby' ) => '',
				esc_html__( 'Bottom', 'gatsby' ) => 'bottom'
			),
			'group' => esc_html__( 'Form', 'gatsby' ),
			'description' => esc_html__( 'Select form alignment.', 'gatsby' ),
			'dependency' => array(
				'element' => 'add',
				'value' => array( 'form' )
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'CSS Animation', 'gatsby' ),
			'param_name' => 'css_form_animation',
			'admin_label' => true,
			'value' => array(
				esc_html__( 'No', 'gatsby' ) => '',
				esc_html__( 'Fade In Up', 'gatsby' ) => 'fadeInUp',
				esc_html__( 'Zoom In Down', 'gatsby' ) => 'zoomInDown',
				esc_html__( 'Bounce In Down', 'gatsby' ) => 'bounceInDown',
				esc_html__( 'Bounce In Up', 'gatsby' ) => 'bounceInUp',
				esc_html__( 'Flip In Y', 'gatsby' ) => 'flipInY',
			),
			'group' => esc_html__( 'Form', 'gatsby' ),
			'dependency' => array(
				'element' => 'add',
				'value' => array( 'form' )
			),
			'description' => esc_html__( 'Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'gatsby' )
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Add second button', 'gatsby' ),
			'param_name' => 'add_second_button',
			'value' => array( esc_html__( 'Yes, please', 'gatsby' ) => true ),
			'dependency' => array(
				'element' => 'add',
				'value' => array( 'button' )
			)
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'CSS Animation', 'gatsby' ),
			'param_name' => 'css_animation',
			'admin_label' => true,
			'value' => array(
				esc_html__( 'No', 'gatsby' ) => '',
				esc_html__( 'Fade In Up', 'gatsby' ) => 'fadeInUp',
				esc_html__( 'Zoom In Down', 'gatsby' ) => 'zoomInDown',
				esc_html__( 'Bounce In Down', 'gatsby' ) => 'bounceInDown',
				esc_html__( 'Bounce In Up', 'gatsby' ) => 'bounceInUp',
				esc_html__( 'Flip In Y', 'gatsby' ) => 'flipInY',
			),
			'description' => esc_html__( 'Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'gatsby' )
		),
		array(
			'type' => 'vc_link',
			'heading' => esc_html__( 'URL (Link)', 'gatsby' ),
			'param_name' => 'link',
			'description' => esc_html__( 'Add link to button.', 'gatsby' ),
			'group' => esc_html__( 'Button', 'gatsby' ),
			'dependency' => array(
				'element' => 'add',
				'value' => array( 'button', 'button_bottom' )
			),
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Text', 'gatsby' ),
			'param_name' => 'custom_button_color',
			'description' => esc_html__( 'Select custom text color for button.', 'gatsby' ),
			'group' => esc_html__( 'Button', 'gatsby' ),
			'dependency' => array(
				'element' => 'add',
				'value' => array( 'button', 'button_bottom' )
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'CSS Animation', 'gatsby' ),
			'param_name' => 'css_button_animation',
			'admin_label' => true,
			'value' => array(
				esc_html__( 'No', 'gatsby' ) => '',
				esc_html__( 'Fade In Up', 'gatsby' ) => 'fadeInUp',
				esc_html__( 'Zoom In Down', 'gatsby' ) => 'zoomInDown',
				esc_html__( 'Bounce In Down', 'gatsby' ) => 'bounceInDown',
				esc_html__( 'Bounce In Up', 'gatsby' ) => 'bounceInUp',
				esc_html__( 'Flip In Y', 'gatsby' ) => 'flipInY',
			),
			'group' => esc_html__( 'Button', 'gatsby' ),
			'dependency' => array(
				'element' => 'add',
				'value' => array( 'button', 'button_bottom' )
			),
			'description' => esc_html__( 'Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'gatsby' )
		),
		array(
			'type' => 'vc_link',
			'heading' => esc_html__( 'URL (Link)', 'gatsby' ),
			'param_name' => 'second_link',
			'description' => esc_html__( 'Add link to second button.', 'gatsby' ),
			'group' => esc_html__( 'Second Button', 'gatsby' ),
			'dependency' => array(
				'element' => 'add_second_button',
				'not_empty' => true
			),
		)
	),
	'js_view' => 'VcCallToActionView3',
));


/* Blog Posts
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Blog Posts', 'gatsby' ),
	'base' => 'vc_mad_blog_posts',
	'icon' => 'icon-wpb-mad-blog-posts',
	'category' => esc_html__( 'Gatsby', 'gatsby' ),
	'description' => esc_html__( 'Blog posts', 'gatsby' ),
	'params' => array(
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
			'heading' => esc_html__( 'Blog Layout', 'gatsby' ),
			'param_name' => 'layout',
			'value' => array(
				esc_html__( 'Masonry v1', 'gatsby' ) => 'gt-type-1',
				esc_html__( 'Masonry v2', 'gatsby' ) => 'gt-type-3',
				esc_html__( 'Small or Big thumbs', 'gatsby' ) => 'gt-type-4',
			),
			'std' => 'gt-type-4',
			'description' => esc_html__( 'Choose the default blog layout here.', 'gatsby' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Blog Style', 'gatsby' ),
			'param_name' => 'style',
			'value' => array(
				esc_html__( 'Big Thumbs', 'gatsby' ) => 'gt-big-thumbs',
				esc_html__( 'Small Thumbs', 'gatsby' ) => 'gt-small-thumbs',
			),
			'dependency' => array(
				'element' => 'layout',
				'value' => array( 'gt-type-4' )
			),
			'std' => 'gt-small-thumbs',
			'description' => esc_html__( 'Choose the default blog layout here.', 'gatsby' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Columns', 'gatsby' ),
			'param_name' => 'columns',
			'value' => array(
				esc_html__( '2 Columns', 'gatsby' ) => 2,
				esc_html__( '3 Columns', 'gatsby' ) => 3,
				esc_html__( '4 Columns', 'gatsby' ) => 4,
			),
			'description' => esc_html__( 'How many columns should be displayed?', 'gatsby' ),
			'dependency' => array(
				'element' => 'layout',
				'value' => array( 'gt-type-1', 'gt-type-3' )
			),
			'std' => 3,
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Enable carousel', 'gatsby' ),
			'param_name' => 'carousel',
			'description' => esc_html__( 'Enable carousel.', 'gatsby' ),
			'value' => array( esc_html__( 'Yes, please', 'gatsby' ) => true ),
			'dependency' => array(
				'element' => 'layout',
				'value' => array( 'gt-type-1' )
			)
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Filter', 'gatsby' ),
			'param_name' => 'sort',
			'value' => array(
				esc_html__( 'No', 'gatsby' ) => '',
				esc_html__( 'Yes', 'gatsby' ) => 'yes'
			),
			'dependency' => array(
				'element' => 'layout',
				'value' => array( 'gt-type-1', 'gt-type-3' )
			),
			'description' => esc_html__( 'Should the sorting options based on categories be displayed?', 'gatsby' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Type Filter', 'gatsby' ),
			'param_name' => 'type_sort',
			'value' => array(
				esc_html__( 'Rounded Outline', 'gatsby' ) => 'gt-type-1',
				esc_html__( 'Border Bottom', 'gatsby' ) => 'gt-type-2',
				esc_html__( 'Rounded', 'gatsby' ) => 'gt-type-3'
			),
			'group' => esc_html__( 'Filter', 'gatsby' ),
			'dependency' => array(
				'element' => 'sort',
				'not_empty' => true
			),
			'description' => esc_html__( 'Layout for filter be displayed?', 'gatsby' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Alignment', 'gatsby' ),
			'param_name' => 'align_sort',
			'description' => esc_html__( 'Select video button alignment.', 'gatsby' ),
			'group' => esc_html__( 'Filter', 'gatsby' ),
			'value' => array(
				esc_html__( 'Left', 'gatsby' ) => 'align-left',
				esc_html__( 'Right', 'gatsby' ) => 'align-right',
				esc_html__( 'Center', 'gatsby' ) => 'align-center',
			),
			'dependency' => array(
				'element' => 'sort',
				'not_empty' => true
			)
		),
		array(
			"type" => "get_terms",
			"term" => "category",
			'heading' => esc_html__( 'Which categories should be used for the blog?', 'gatsby' ),
			"param_name" => "categories",
			"holder" => "div",
			'description' => esc_html__('The Page will then show entries from only those categories.', 'gatsby'),
			'group' => esc_html__( 'Data Settings', 'gatsby' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Order By', 'gatsby' ),
			'param_name' => 'orderby',
			'value' => array(
				esc_html__( 'Date', 'gatsby' ) => 'date',
				esc_html__( 'ID', 'gatsby' ) => 'ID',
				esc_html__( 'Author', 'gatsby' ) => 'author',
				esc_html__( 'Title', 'gatsby' ) => 'title',
				esc_html__( 'Modified', 'gatsby' ) => 'modified',
				esc_html__( 'Random', 'gatsby' ) => 'rand',
				esc_html__( 'Comment count', 'gatsby' ) => 'comment_count',
				esc_html__( 'Menu order', 'gatsby' ) => 'menu_order'
			),
			'std' => 'date',
			'description' => esc_html__( 'Sort retrieved posts by parameter', 'gatsby' ),
			'group' => esc_html__( 'Data Settings', 'gatsby' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Order', 'gatsby' ),
			'param_name' => 'order',
			'value' => array(
				esc_html__( 'DESC', 'gatsby' ) => 'DESC',
				esc_html__( 'ASC', 'gatsby' ) => 'ASC'
			),
			'description' => esc_html__( 'In what direction order?', 'gatsby' ),
			'group' => esc_html__( 'Data Settings', 'gatsby' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Posts Count', 'gatsby' ),
			'param_name' => 'items',
			'value' => Gatsby_Vc_Config::array_number(1, 50, 1, array('-1' => 'All')),
			'std' => 10,
			'description' => esc_html__( 'How many items should be displayed per page?', 'gatsby' ),
			'edit_field_class' => 'vc_col-sm-6 vc_column'
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Pagination', 'gatsby' ),
			'param_name' => 'paginate',
			'value' => array(
				esc_html__( 'Display Pagination', 'gatsby' ) => 'pagination',
				esc_html__( 'Load more button', 'gatsby' ) => 'load-more',
				esc_html__( 'No option to view additional entries', 'gatsby' ) => 'none'
			),
			'std' => 'none',
			'description' => esc_html__( 'Should a pagination be displayed?', 'gatsby' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Items per page', 'gatsby' ),
			'param_name' => 'items_per_page',
			'description' => esc_html__( 'Number of items to show per page.', 'gatsby' ),
			'value' => 3,
			'dependency' => array(
				'element' => 'paginate',
				'value' => array('load-more')
			),
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'group' => esc_html__( 'Pagination', 'gatsby' )
		),
		gatsby_vc_map_add_css_animation()
	)
) );

/* Progress Bar
---------------------------------------------------------- */

vc_map(array(
	'name' => esc_html__( 'Progress Bar', 'gatsby' ),
	'base' => 'vc_mad_progress_bar',
	'icon' => 'icon-wpb-mad-progress-bar',
	'category' => esc_html__( 'Gatsby', 'gatsby' ),
	'description' => esc_html__( 'Animated progress bar', 'gatsby' ),
	'params' => array(
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
			'param_name' => 'type',
			'value' => array(
				esc_html__( 'Type 1', 'gatsby' ) => 'type-1',
				esc_html__( 'Type 2', 'gatsby' ) => 'type-2',
				esc_html__( 'Type 3', 'gatsby' ) => 'type-3',
			),
			'description' => esc_html__( 'Type layout will be displayed?', 'gatsby' )
		),
		array(
			'type' => 'param_group',
			'heading' => esc_html__( 'Values', 'gatsby' ),
			'param_name' => 'values',
			'description' => esc_html__( 'Enter values for graph - value, title and color.', 'gatsby' ),
			'value' => urlencode( json_encode( array(
				array(
					'label' => esc_html__( 'Development', 'gatsby' ),
					'value' => '90',
				),
				array(
					'label' => esc_html__( 'Design', 'gatsby' ),
					'value' => '80',
				),
				array(
					'label' => esc_html__( 'Marketing', 'gatsby' ),
					'value' => '70',
				),
			) ) ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Label', 'gatsby' ),
					'param_name' => 'label',
					'description' => esc_html__( 'Enter text used as title of bar.', 'gatsby' ),
					'admin_label' => true,
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Value', 'gatsby' ),
					'param_name' => 'value',
					'description' => esc_html__( 'Enter value of bar.', 'gatsby' ),
					'admin_label' => true,
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Color', 'gatsby' ),
					'param_name' => 'color',
					'value' => array(
							esc_html__( 'Default', 'gatsby' ) => '',
						) + array(
							esc_html__( 'Blue', 'gatsby' ) => 'bar_blue',
							esc_html__( 'Green', 'gatsby' ) => 'bar_green',
							esc_html__( 'Orange', 'gatsby' ) => 'bar_orange'
						),
					'description' => esc_html__( 'Select single bar background color.', 'gatsby' ),
					'admin_label' => true,
					'param_holder_class' => 'vc_colored-dropdown',
				),
			),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Units', 'gatsby' ),
			'param_name' => 'units',
			'description' => esc_html__( 'Enter measurement units (Example: %, px, points, etc. Note: graph value and units will be appended to graph title).', 'gatsby' ),
		),
		gatsby_vc_map_add_css_animation(),
	),
));

/* Photography
---------------------------------------------------------- */

$list_photography = array();
$photography = new WP_Query( array(
	'post_type' => 'photography',
	'post_status'  => 'publish',
	'posts_per_page' => -1
) );

foreach ( $photography->posts as $key => $photo ) {
	$list_photography[$photo->post_title] = $photo->ID;
}

vc_map( array(
	'name' => esc_html__( 'Photography', 'gatsby' ),
	'base' => 'vc_mad_photography',
	'icon' => 'icon-wpb-mad-photography',
	'category' => esc_html__( 'Gatsby', 'gatsby' ),
	'description' => esc_html__( 'Displayed for photography items', 'gatsby' ),
	'params' => array(
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
			'heading' => esc_html__('Choose photography', 'gatsby'),
			'param_name' => 'photography_id',
			'value' => $list_photography,
			'std' => '',
			'description' => esc_html__('Choose the photography.', 'gatsby')
		),
		gatsby_vc_map_add_css_animation()

	)
) );

/* Portfolio
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Portfolio', 'gatsby' ),
	'base' => 'vc_mad_portfolio',
	'icon' => 'icon-wpb-mad-portfolio',
	'category' => esc_html__( 'Gatsby', 'gatsby' ),
	'description' => esc_html__( 'Displayed for portfolio items', 'gatsby' ),
	'params' => array(
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
				esc_html__( 'Classic', 'gatsby' ) => 'gt-type-1',
				esc_html__( 'Tilt', 'gatsby' ) => 'gt-type-2',
				esc_html__( 'Grid', 'gatsby' ) => 'gt-type-3',
			),
			'description' => esc_html__( 'Layout be displayed?', 'gatsby' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Masonry?', 'gatsby' ),
			'param_name' => 'masonry',
			'value' => array(
				esc_html__( 'No', 'gatsby' ) => false,
				esc_html__( 'Yes', 'gatsby' ) => true
			),
			'description' => ' '
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Spacing between items', 'gatsby' ),
			'param_name' => 'spacing',
			'value' => array(
				esc_html__( 'With Spacing', 'gatsby' ) => 'gt-with-spacing',
				esc_html__( 'Without Spacing', 'gatsby' ) => 'gt-without-spacing'
			),
			'description' => esc_html__( 'Select spacing mode', 'gatsby' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Filter', 'gatsby' ),
			'param_name' => 'sort',
			'value' => array(
				esc_html__( 'No', 'gatsby' ) => '',
				esc_html__( 'Yes', 'gatsby' ) => 'yes'
			),
			'description' => esc_html__( 'Should the sorting options based on categories be displayed?', 'gatsby' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Type Filter', 'gatsby' ),
			'param_name' => 'type_sort',
			'value' => array(
				esc_html__( 'Rounded Outline', 'gatsby' ) => 'gt-type-1',
				esc_html__( 'Border Bottom', 'gatsby' ) => 'gt-type-2',
				esc_html__( 'Rounded', 'gatsby' ) => 'gt-type-3'
			),
			'group' => esc_html__( 'Filter', 'gatsby' ),
			'dependency' => array(
				'element' => 'sort',
				'not_empty' => true
			),
			'description' => esc_html__( 'Layout for filter be displayed?', 'gatsby' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Alignment', 'gatsby' ),
			'param_name' => 'align_sort',
			'description' => esc_html__( 'Select video button alignment.', 'gatsby' ),
			'group' => esc_html__( 'Filter', 'gatsby' ),
			'value' => array(
				esc_html__( 'Left', 'gatsby' ) => 'align-left',
				esc_html__( 'Right', 'gatsby' ) => 'align-right',
				esc_html__( 'Center', 'gatsby' ) => 'align-center',
			),
			'dependency' => array(
				'element' => 'sort',
				'not_empty' => true
			)
		),
		array(
			"type" => "get_terms",
			"term" => "portfolio_categories",
			'heading' => esc_html__( 'Which categories should be used for the portfolio?', 'gatsby' ),
			"param_name" => "categories",
			'description' => esc_html__('The Page will then show portfolio from only those categories.', 'gatsby'),
			'group' => esc_html__( 'Data Settings', 'gatsby' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Order By', 'gatsby' ),
			'param_name' => 'orderby',
			'value' => array(
				esc_html__( 'Date', 'gatsby' ) => 'date',
				esc_html__( 'ID', 'gatsby' ) => 'ID',
				esc_html__( 'Author', 'gatsby' ) => 'author',
				esc_html__( 'Title', 'gatsby' ) => 'title',
				esc_html__( 'Modified', 'gatsby' ) => 'modified',
				esc_html__( 'Random', 'gatsby' ) => 'rand',
				esc_html__( 'Comment count', 'gatsby' ) => 'comment_count',
				esc_html__( 'Menu order', 'gatsby' ) => 'menu_order'
			),
			'description' => esc_html__( 'Sort retrieved items by parameter', 'gatsby' ),
			'group' => esc_html__( 'Data Settings', 'gatsby' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Order', 'gatsby' ),
			'param_name' => 'order',
			'value' => array(
				esc_html__( 'DESC', 'gatsby' ) => 'DESC',
				esc_html__( 'ASC', 'gatsby' ) => 'ASC',
			),
			'description' => esc_html__( 'Direction Order', 'gatsby' ),
			'group' => esc_html__( 'Data Settings', 'gatsby' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Columns', 'gatsby' ),
			'param_name' => 'columns',
			'value' => array(
				esc_html__( '2 Columns', 'gatsby' ) => 2,
				esc_html__( '3 Columns', 'gatsby' ) => 3,
				esc_html__( '4 Columns', 'gatsby' ) => 4,
				esc_html__( '5 Columns', 'gatsby' ) => 5,
			),
			'std' => 4,
			'description' => esc_html__( 'How many columns should be displayed?', 'gatsby' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Image size', 'gatsby' ),
			'param_name' => 'img_size',
			'value' => '',
			'description' => esc_html__( 'Enter image size. Example: Enter image size in pixels: 480*480 (Width x Height). Leave empty to use default size.', 'gatsby' ),
			'std' => ''
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Count Items', 'gatsby' ),
			'param_name' => 'items',
			'value' => Gatsby_Vc_Config::array_number(1, 60, 1, array('All' => '-1')),
			'std' => -1,
			'description' => esc_html__( 'How many items should be displayed per page?', 'gatsby' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Pagination', 'gatsby' ),
			'param_name' => 'paginate',
			'value' => array(
				esc_html__( 'Display Pagination', 'gatsby' ) => 'pagination',
				esc_html__( 'Load more button', 'gatsby' ) => 'load-more',
				esc_html__( 'No option to view additional entries', 'gatsby' ) => 'none'
			),
			'std' => 'none',
			'description' => esc_html__( 'Should a pagination be displayed?', 'gatsby' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Items per page', 'gatsby' ),
			'param_name' => 'items_per_page',
			'description' => esc_html__( 'Number of items to show per page.', 'gatsby' ),
			'value' => 10,
			'dependency' => array(
				'element' => 'paginate',
				'value' => array('load-more')
			),
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'group' => esc_html__( 'Pagination', 'gatsby' )
		),
		gatsby_vc_map_add_css_animation(),
	)
) );

/* Instagram
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Instagram', 'gatsby' ),
	'base' => 'vc_mad_instagram',
	'icon' => 'icon-wpb-mad-instagram',
	'category' => esc_html__( 'Gatsby', 'gatsby' ),
	'description' => esc_html__( 'Instagram', 'gatsby' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Title', 'gatsby' ),
			'param_name' => 'title',
			'description' => esc_html__( 'Enter text which will be used as title. Leave blank if no title is needed.', 'gatsby' ),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Username', 'gatsby' ),
			'param_name' => 'username',
		),
		array(
			'type' => 'number',
			'heading' => esc_html__( 'Number', 'gatsby' ),
			'param_name' => 'number',
			'description' => esc_html__( 'Number of photos', 'gatsby' ),
			'value' => 6,
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Open links in', 'gatsby' ),
			'param_name' => 'target',
			'value' => array(
				esc_html__( 'Current window (_self)', 'gatsby' ) => '_self',
				esc_html__( 'New window (_blank)', 'gatsby' ) => '_blank'
			)
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Link text', 'gatsby' ),
			'param_name' => 'link',
			'std' => ''
		),
	)
) );

/* Banners
---------------------------------------------------------- */

vc_map( array(
	'name' => esc_html__( 'Banners', 'gatsby' ),
	'base' => 'vc_mad_banners',
	'icon' => 'icon-wpb-mad-banners',
	'category' => esc_html__( 'Gatsby', 'gatsby' ),
	'description' => esc_html__( 'banners', 'gatsby' ),
	'params' => array(
		array(
			'type' => 'attach_image',
			'heading' => esc_html__( 'Image', 'gatsby' ),
			'param_name' => 'image',
			'value' => '',
			'description' => esc_html__( 'Select image from media library.', 'gatsby' )
		),
		array(
			"type" => "vc_link",
			"heading" => esc_html__( 'Add URL to the button', 'gatsby' ),
			"param_name" => "link"
		),
		gatsby_vc_map_add_css_animation()
	)
) );

if ( class_exists('WooCommerce') ) {

	/* Product Grid
	---------------------------------------------------------- */

	vc_map( array(
		'name' => esc_html__( 'Products', 'gatsby' ),
		'base' => 'vc_mad_products',
		'icon' => 'icon-wpb-mad-woocommerce',
		'category' => esc_html__( 'Gatsby', 'gatsby' ),
		'description' => esc_html__( 'Displayed for product grid', 'gatsby' ),
		'params' => array(
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
				'heading' => esc_html__( 'Type View', 'gatsby' ),
				'param_name' => 'type',
				'value' => array(
					esc_html__('Grid', 'gatsby') => 'gt-view-grid',
					esc_html__('List', 'gatsby') => 'gt-view-list'
				),
				'std' => 'gt-view-grid',
				'description' => esc_html__('Choose the type style.', 'gatsby')
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Layout', 'gatsby' ),
				'param_name' => 'layout',
				'value' => array(
					esc_html__('Type 1', 'gatsby') => 'gt-type-1',
					esc_html__('Type 2', 'gatsby') => 'gt-type-2',
				),
				'std' => 'gt-type-1',
				'description' => esc_html__('Choose layout style.', 'gatsby')
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Enable carousel', 'gatsby' ),
				'param_name' => 'carousel',
				'description' => esc_html__( 'Enable carousel.', 'gatsby' ),
				'dependency' => array(
					'element' => 'type',
					'value' => array('gt-view-grid')
				),
				'value' => array( esc_html__( 'Yes, please', 'gatsby' ) => true )
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Columns', 'gatsby' ),
				'param_name' => 'columns',
				'value' => array(
					esc_html__( '2 Columns', 'gatsby' ) => 2,
					esc_html__( '3 Columns', 'gatsby' ) => 3,
					esc_html__( '4 Columns', 'gatsby' ) => 4,
				),
				'std' => 4,
				'description' => esc_html__( 'How many columns should be displayed?', 'gatsby' ),
				'param_holder_class' => ''
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Count Items', 'gatsby' ),
				'param_name' => 'items',
				'value' => Gatsby_Vc_Config::array_number(1, 50, 1, array('All' => -1)),
				'std' => 8,
				'description' => esc_html__( 'How many items should be displayed per page?', 'gatsby' )
			),
			array(
				"type" => "get_terms",
				"term" => "product_cat",
				'heading' => esc_html__( 'Which categories should be used for the products?', 'gatsby' ),
				"param_name" => "categories",
				'admin_label' => true,
				'group' => esc_html__( 'Data Settings', 'gatsby' ),
				'description' => esc_html__('The Page will then show products from only those categories.', 'gatsby')
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Show', 'gatsby' ),
				'param_name' => 'show',
				'value' => array(
					esc_html__( 'All Products', 'gatsby' ) => '',
					esc_html__( 'Featured Products', 'gatsby' ) => 'featured',
					esc_html__( 'On-sale Products', 'gatsby' ) => 'onsale',
					esc_html__( 'Best Selling Products', 'gatsby' ) => 'bestselling',
					esc_html__( 'Top Rated Products', 'gatsby' ) => 'toprated',
					esc_html__( 'New', 'gatsby' ) => 'new'
				),
				'description' => '',
				'std' => '',
				'group' => esc_html__( 'Data Settings', 'gatsby' )
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Order by', 'gatsby' ),
				'param_name' => 'orderby',
				'value' => array(
					esc_html__('Default sorting', 'gatsby' ) => 'menu_order',
					esc_html__('Sort by popularity', 'gatsby' ) => 'popularity',
					esc_html__('Sort by average rating', 'gatsby' ) => 'rating',
					esc_html__('Sort by newness', 'gatsby' ) => 'date',
					esc_html__('Sort by price: low to high', 'gatsby' ) => 'price',
					esc_html__('Sort by price: high to low', 'gatsby' ) => 'price-desc'
				),
				'description' => esc_html__( 'Here you can choose how to display the products', 'gatsby' ),
				'group' => esc_html__( 'Data Settings', 'gatsby' )
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Sorting Order', 'gatsby' ),
				'param_name' => 'order',
				'value' => array(
					esc_html__( 'ASC', 'gatsby' ) => 'asc',
					esc_html__( 'DESC', 'gatsby' ) => 'desc'
				),
				'description' => esc_html__( 'Here you can choose how to display the products', 'gatsby' ),
				'std' => 'desc',
				'group' => esc_html__( 'Data Settings', 'gatsby' )
			),
			array(
				'type' => 'autocomplete',
				'settings' => array(
					'multiple' => true,
					// is multiple values allowed? default false
					// 'sortable' => true, // is values are sortable? default false
					'min_length' => 2,
					// min length to start search -> default 2
					// 'no_hide' => true, // In UI after select doesn't hide an select list, default false
					'groups' => true,
					// In UI show results grouped by groups, default false
					'unique_values' => true,
					// In UI show results except selected. NB! You should manually check values in backend, default false
					'display_inline' => true,
					// In UI show results inline view, default false (each value in own line)
					'delay' => 500,
					// delay for search. default 500
					'auto_focus' => true,
					// auto focus input, default true
					// 'values' => $taxonomies_list,
				),
				'heading' => esc_html__( 'Select identificators', 'gatsby' ),
				'param_name' => 'by_id',
				'admin_label' => true,
				'group' => esc_html__( 'Data Settings', 'gatsby' ),
				'description' => esc_html__('Input product ID or product SKU or product title to see suggestions', 'gatsby')
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Filter', 'gatsby' ),
				'param_name' => 'sort',
				'value' => array(
					esc_html__( 'No', 'gatsby' ) => '',
					esc_html__( 'Filter by Category', 'gatsby') => 'filter_cat',
					esc_html__( 'Choose how to filter', 'gatsby' ) => 'filter_choose'
				),
				'description' => esc_html__( 'Should the sorting options based be displayed?', 'gatsby' )
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Add new filter?', 'gatsby' ),
				'param_name' => 'add_new',
				'description' => esc_html__( 'Sort by newness', 'gatsby' ),
				'group' => esc_html__( 'Filter', 'gatsby' ),
				'value' => array( esc_html__( 'Yes', 'gatsby' ) => true ),
				'dependency' => array(
					'element' => 'sort',
					'value' => array('filter_choose'),
				),
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Add featured filter?', 'gatsby' ),
				'param_name' => 'add_featured',
				'description' => esc_html__( 'Sort by featured', 'gatsby' ),
				'group' => esc_html__( 'Filter', 'gatsby' ),
				'value' => array( esc_html__( 'Yes', 'gatsby' ) => true ),
				'dependency' => array(
					'element' => 'sort',
					'value' => array('filter_choose'),
				),
			),
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Add sale filter?', 'gatsby' ),
				'param_name' => 'add_sale',
				'description' => esc_html__( 'Sort by price sale', 'gatsby' ),
				'group' => esc_html__( 'Filter', 'gatsby' ),
				'value' => array( esc_html__( 'Yes', 'gatsby' ) => true ),
				'dependency' => array(
					'element' => 'sort',
					'value' => array('filter_choose'),
				),
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Type Filter', 'gatsby' ),
				'param_name' => 'type_sort',
				'value' => array(
					esc_html__( 'Rounded Outline', 'gatsby' ) => 'gt-type-1',
					esc_html__( 'Border Bottom', 'gatsby' ) => 'gt-type-2',
					esc_html__( 'Rounded', 'gatsby' ) => 'gt-type-3'
				),
				'group' => esc_html__( 'Filter', 'gatsby' ),
				'dependency' => array(
					'element' => 'sort',
					'not_empty' => true
				),
				'description' => esc_html__( 'Layout for filter be displayed?', 'gatsby' )
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Alignment', 'gatsby' ),
				'param_name' => 'align_sort',
				'description' => esc_html__( 'Select video button alignment.', 'gatsby' ),
				'group' => esc_html__( 'Filter', 'gatsby' ),
				'value' => array(
					esc_html__( 'Left', 'gatsby' ) => 'align-left',
					esc_html__( 'Right', 'gatsby' ) => 'align-right',
					esc_html__( 'Center', 'gatsby' ) => 'align-center',
				),
				'dependency' => array(
					'element' => 'sort',
					'not_empty' => true
				)
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Pagination', 'gatsby' ),
				'param_name' => 'paginate',
				'value' => array(
					esc_html__( 'Display Pagination', 'gatsby' ) => 'pagination',
					esc_html__( 'Load more button', 'gatsby' ) => 'load-more',
					esc_html__( 'No option to view additional entries', 'gatsby' ) => 'none'
				),
				'std' => 'none',
				'description' => esc_html__( 'Should a pagination be displayed?', 'gatsby' )
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__( 'Items per page', 'gatsby' ),
				'param_name' => 'items_per_page',
				'description' => esc_html__( 'Number of items to show per page.', 'gatsby' ),
				'value' => 10,
				'dependency' => array(
					'element' => 'paginate',
					'value' => array('load-more')
				),
				'edit_field_class' => 'vc_col-sm-6 vc_column',
				'group' => esc_html__( 'Pagination', 'gatsby' )
			),
			gatsby_vc_map_add_css_animation()
		)
	) );

	$Vc_Vendor_Woocommerce = new Vc_Vendor_Woocommerce();

	//Filters For autocomplete param:
	//For suggestion: vc_autocomplete_[shortcode_name]_[param_name]_callback
	add_filter( 'vc_autocomplete_vc_mad_products_by_id_callback', array($Vc_Vendor_Woocommerce, 'productIdAutocompleteSuggester' ), 10, 1 );
	// Get suggestion(find). Must return an array
	add_filter( 'vc_autocomplete_vc_mad_products_by_id_render', array($Vc_Vendor_Woocommerce, 'productIdAutocompleteRender' ), 10, 1 );
	// Render exact product. Must return an array (label,value)
	//For param: ID default value filter
	add_filter( 'vc_form_fields_render_field_vc_mad_products_by_id_param_value', array($Vc_Vendor_Woocommerce, 'productIdDefaultValue' ), 10, 4 );
	// Defines default value for param if not provided. Takes from other param value.

}

/* Video Button
---------------------------------------------------------- */

vc_map( array(
	"name" => esc_html__("Video Button", 'gatsby' ),
	"base"=> 'vc_mad_video_button',
	"icon" => 'icon-wpb-mad-video-button',
	'category' => esc_html__( 'Gatsby', 'gatsby' ),
	"description" => esc_html__( 'Video Button', 'gatsby' ),
	"params" => array(
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Video link', 'gatsby' ),
			'param_name' => 'link',
			'value' => 'https://vimeo.com/51589652',
			'admin_label' => true,
			'description' => sprintf( __( 'Enter link to video (Note: read more about available formats at WordPress <a href="%s" target="_blank">codex page</a>).', 'gatsby' ), 'http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F' ),
		),
		array(
			'type' => 'attach_image',
			'heading' => esc_html__( 'Image', 'gatsby' ),
			'param_name' => 'image',
			'value' => '',
			'description' => esc_html__( 'Select image from media library.', 'gatsby' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Alignment', 'gatsby' ),
			'param_name' => 'align',
			'description' => esc_html__( 'Select video button alignment.', 'gatsby' ),
			'value' => array(
				esc_html__( 'Left', 'gatsby' ) => 'left',
				esc_html__( 'Right', 'gatsby' ) => 'right',
				esc_html__( 'Center', 'gatsby' ) => 'center',
			),
		),
	)
));

/* Counter Bar
---------------------------------------------------------- */

vc_map( array(
	"name" => esc_html__("Counter", 'gatsby' ),
	"base"=> 'vc_mad_counter',
	"icon" => 'icon-wpb-mad-counter',
	'category' => esc_html__( 'Gatsby', 'gatsby' ),
	"description" => esc_html__( 'Animated counter', 'gatsby' ),
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
			'type' => 'param_group',
			'heading' => esc_html__( 'Values', 'gatsby' ),
			'param_name' => 'values',
			'description' => esc_html__( 'Enter values - value and title.', 'gatsby' ),
			'value' => urlencode( json_encode( array(
				array(
					'label' => esc_html__( 'Successful projects', 'gatsby' ),
					'value' => '135',
					'icon'  => ''
				),
				array(
					'label' => esc_html__( 'Talanted Professionals', 'gatsby' ),
					'value' => '12',
				),
				array(
					'label' => esc_html__( 'Awards Winned', 'gatsby' ),
					'value' => '42',
					'icon'  => ''
				),
				array(
					'label' => esc_html__( 'Years of Hardwork', 'gatsby' ),
					'value' => '9',
					'icon'  => ''
				),
			) ) ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Label', 'gatsby' ),
					'param_name' => 'label',
					'description' => esc_html__( 'Enter text used as title.', 'gatsby' ),
					'admin_label' => true,
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Value', 'gatsby' ),
					'param_name' => 'value',
					'description' => esc_html__( 'Enter value.', 'gatsby' ),
					'admin_label' => true,
				),
				array(
					"type" => "choose_icons",
					"heading" => esc_html__("Icon", 'gatsby'),
					"param_name" => "icon",
					"value" => 'none',
					"description" => esc_html__( 'Select icon from library.', 'gatsby')
				)
			)
		),
		gatsby_vc_map_add_css_animation()
	)
));

/* Services List
---------------------------------------------------------- */

vc_map( array(
	"name" => esc_html__("Services List", 'gatsby' ),
	"base"=> 'vc_mad_services_list',
	"icon" => 'icon-mad-info-list',
	'category' => esc_html__( 'Gatsby', 'gatsby' ),
	"description" => esc_html__( 'Info list', 'gatsby' ),
	"params" => array(
		array(
			'type' => 'param_group',
			'heading' => esc_html__( 'Values', 'gatsby' ),
			'param_name' => 'values',
			'description' => esc_html__( 'Enter values - value and title.', 'gatsby' ),
			'value' => urlencode( json_encode( array(
				array(
					'image' => '',
					'label' => '',
					'value' => '',
				),
				array(
					'image' => '',
					'label' => '',
					'value' => '',
				)
			) ) ),
			'params' => array(
				array(
					'type' => 'attach_image',
					'heading' => esc_html__( 'Image', 'gatsby' ),
					'param_name' => 'image',
					'value' => '',
					'description' => esc_html__( 'Select image from media library.', 'gatsby' )
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Label', 'gatsby' ),
					'param_name' => 'label',
					'description' => esc_html__( 'Enter text used as label.', 'gatsby' ),
					'admin_label' => true,
				),
				array(
					'type' => 'textarea',
					'heading' => esc_html__( 'Description', 'gatsby' ),
					'param_name' => 'value',
					'description' => esc_html__( 'Enter description.', 'gatsby' ),
					'admin_label' => true,
				)
			)
		)
	)
));

/* Info List
---------------------------------------------------------- */

vc_map( array(
	"name" => esc_html__("Info List", 'gatsby' ),
	"base"=> 'vc_mad_info_list',
	"icon" => 'icon-mad-info-list',
	'category' => esc_html__( 'Gatsby', 'gatsby' ),
	"description" => esc_html__( 'Info list', 'gatsby' ),
	"params" => array(
		array(
			'type' => 'param_group',
			'heading' => esc_html__( 'Values', 'gatsby' ),
			'param_name' => 'values',
			'description' => esc_html__( 'Enter values - value and title.', 'gatsby' ),
			'value' => urlencode( json_encode( array(
				array(
					'label' => '',
					'value' => '',
				),
				array(
					'label' => '',
					'value' => '',
				)
			) ) ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Label', 'gatsby' ),
					'param_name' => 'label',
					'description' => esc_html__( 'Enter text used as name.', 'gatsby' ),
					'admin_label' => true,
				),
				array(
					'type' => 'textarea',
					'heading' => esc_html__( 'Value', 'gatsby' ),
					'param_name' => 'value',
					'description' => esc_html__( 'Enter value.', 'gatsby' ),
					'admin_label' => true,
				)
			)
		)
	)
));

/* Dropcap
---------------------------------------------------------- */
vc_map( array(
	'name' => esc_html__( 'Dropcap', 'gatsby' ),
	'base' => 'vc_mad_dropcap',
	'icon' => 'icon-wpb-mad-dropcap',
	'category' => esc_html__( 'Gatsby', 'gatsby' ),
	'description' => esc_html__( 'Dropcap', 'gatsby' ),
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Type', 'gatsby' ),
			'param_name' => 'type',
			'value' => array(
				esc_html__( 'Type 1', 'gatsby' ) => 'gt-type-1',
				esc_html__( 'Type 2', 'gatsby' ) => 'gt-type-2',
				esc_html__( 'Type 3', 'gatsby' ) => 'gt-type-3'
			),
			'description' => esc_html__('Choose the first letter style.', 'gatsby')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Letter', 'gatsby' ),
			'param_name' => 'letter',
			'admin_label' => true,
			'description' => ''
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Color for dropcap', 'gatsby' ),
			'param_name' => 'dropcap_color',
			'dependency' => array(
				'element' => 'type',
				'value' => array('gt-type-1', 'gt-type-2'),
			),
			'description' => esc_html__( 'Select custom color for dropcap.', 'gatsby' ),
		),
		array(
			'type' => 'attach_image',
			'heading' => esc_html__( 'Image', 'gatsby' ),
			'param_name' => 'image',
			'value' => '',
			'description' => esc_html__( 'Select image from media library.', 'gatsby' ),
			'dependency' => array(
				'element' => 'type',
				'value' => 'gt-type-3',
			)
		),
		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'heading' => esc_html__( 'Text', 'gatsby' ),
			'param_name' => 'content',
			'value' => ''
		),
		gatsby_vc_map_add_css_animation(),
		gatsby_vc_map_add_animation_delay(),
		gatsby_vc_map_add_scroll_factor()
	)
));


/*** Visual Composer Content elements refresh ***/
class gatsbyVcSharedLibrary {
	// Here we will store plugin wise (shared) settings. Colors, Locations, Sizes, etc...
	/**
	 * @var array
	 */
	private static $colors = array(
		'Blue' => 'blue',
		'Turquoise' => 'turquoise',
		'Pink' => 'pink',
		'Violet' => 'violet',
		'Peacoc' => 'peacoc',
		'Chino' => 'chino',
		'Mulled Wine' => 'mulled_wine',
		'Vista Blue' => 'vista_blue',
		'Black' => 'black',
		'Grey' => 'grey',
		'Orange' => 'orange',
		'Sky' => 'sky',
		'Green' => 'green',
		'Juicy pink' => 'juicy_pink',
		'Sandy brown' => 'sandy_brown',
		'Purple' => 'purple',
		'White' => 'white'
	);

	/**
	 * @var array
	 */
	public static $icons = array(
		'Glass' => 'glass',
		'Music' => 'music',
		'Search' => 'search'
	);

	/**
	 * @var array
	 */
	public static $sizes = array(
		'Mini' => 'xs',
		'Small' => 'sm',
		'Normal' => 'md',
		'Large' => 'lg'
	);

	/**
	 * @var array
	 */
	public static $button_styles = array(
		'Rounded' => 'rounded',
		'Square' => 'square',
		'Round' => 'round',
		'Outlined' => 'outlined',
		'3D' => '3d',
		'Square Outlined' => 'square_outlined'
	);

	/**
	 * @var array
	 */
	public static $message_box_styles = array(
		'Standard' => 'standard',
		'Solid' => 'solid',
		'Solid icon' => 'solid-icon',
		'Outline' => 'outline',
		'3D' => '3d',
	);

	/**
	 * Toggle styles
	 * @var array
	 */
	public static $toggle_styles = array(
		'Default' => 'default',
		'Simple' => 'simple',
		'Round' => 'round',
		'Round Outline' => 'round_outline',
		'Rounded' => 'rounded',
		'Rounded Outline' => 'rounded_outline',
		'Square' => 'square',
		'Square Outline' => 'square_outline',
		'Arrow' => 'arrow',
		'Text Only' => 'text_only',
	);

	/**
	 * Animation styles
	 * @var array
	 */
	public static $animation_styles = array(
		'Bounce' => 'easeOutBounce',
		'Elastic' => 'easeOutElastic',
		'Back' => 'easeOutBack',
		'Cubic' => 'easeinOutCubic',
		'Quint' => 'easeinOutQuint',
		'Quart' => 'easeOutQuart',
		'Quad' => 'easeinQuad',
		'Sine' => 'easeOutSine'
	);

	/**
	 * @var array
	 */
	public static $cta_styles = array(
		'Rounded' => 'rounded',
		'Square' => 'square',
		'Round' => 'round',
		'Outlined' => 'outlined',
		'Square Outlined' => 'square_outlined'
	);

	/**
	 * @var array
	 */
	public static $txt_align = array(
		'Left' => 'left',
		'Right' => 'right',
		'Center' => 'center',
		'Justify' => 'justify'
	);

	/**
	 * @var array
	 */
	public static $el_widths = array(
		'100%' => '',
		'90%' => '90',
		'80%' => '80',
		'70%' => '70',
		'60%' => '60',
		'50%' => '50'
	);

	/**
	 * @var array
	 */
	public static $sep_widths = array(
		'1px' => '',
		'2px' => '2',
		'3px' => '3',
		'4px' => '4',
		'5px' => '5',
		'6px' => '6',
		'7px' => '7',
		'8px' => '8',
		'9px' => '9',
		'10px' => '10'
	);

	/**
	 * @var array
	 */
	public static $sep_styles = array(
		'Border' => '',
		'Dashed' => 'dashed',
		'Dotted' => 'dotted',
		'Double' => 'double'
	);

	/**
	 * @var array
	 */
	public static $box_styles = array(
		'Default' => '',
		'Rounded' => 'vc_box_rounded',
		'Border' => 'vc_box_border',
		'Outline' => 'vc_box_outline',
		'Shadow' => 'vc_box_shadow',
		'Bordered shadow' => 'vc_box_shadow_border',
		'3D Shadow' => 'vc_box_shadow_3d',
		'Round' => 'vc_box_circle', //new
		'Round Border' => 'vc_box_border_circle', //new
		'Round Outline' => 'vc_box_outline_circle', //new
		'Round Shadow' => 'vc_box_shadow_circle', //new
		'Round Border Shadow' => 'vc_box_shadow_border_circle', //new
		'Circle' => 'vc_box_circle_2', //new
		'Circle Border' => 'vc_box_border_circle_2', //new
		'Circle Outline' => 'vc_box_outline_circle_2', //new
		'Circle Shadow' => 'vc_box_shadow_circle_2', //new
		'Circle Border Shadow' => 'vc_box_shadow_border_circle_2' //new
	);

	/**
	 * @return array
	 */
	public static function getColors() {
		return self::$colors;
	}

	/**
	 * @return array
	 */
	public static function getIcons() {
		return self::$icons;
	}

	/**
	 * @return array
	 */
	public static function getSizes() {
		return self::$sizes;
	}

	/**
	 * @return array
	 */
	public static function getButtonStyles() {
		return self::$button_styles;
	}

	/**
	 * @return array
	 */
	public static function getMessageBoxStyles() {
		return self::$message_box_styles;
	}

	/**
	 * @return array
	 */
	public static function getToggleStyles() {
		return self::$toggle_styles;
	}

	/**
	 * @return array
	 */
	public static function getAnimationStyles() {
		return self::$animation_styles;
	}

	/**
	 * @return array
	 */
	public static function getCtaStyles() {
		return self::$cta_styles;
	}

	/**
	 * @return array
	 */
	public static function getTextAlign() {
		return self::$txt_align;
	}

	/**
	 * @return array
	 */
	public static function getBorderWidths() {
		return self::$sep_widths;
	}

	/**
	 * @return array
	 */
	public static function getElementWidths() {
		return self::$el_widths;
	}

	/**
	 * @return array
	 */
	public static function getSeparatorStyles() {
		return self::$sep_styles;
	}

	/**
	 * @return array
	 */
	public static function getBoxStyles() {
		return self::$box_styles;
	}

	public static function getColorsDashed() {
		$colors = array(
			esc_html__( 'Blue', 'gatsby' ) => 'blue',
			esc_html__( 'Turquoise', 'gatsby' ) => 'turquoise',
			esc_html__( 'Pink', 'gatsby' ) => 'pink',
			esc_html__( 'Violet', 'gatsby' ) => 'violet',
			esc_html__( 'Peacoc', 'gatsby' ) => 'peacoc',
			esc_html__( 'Chino', 'gatsby' ) => 'chino',
			esc_html__( 'Mulled Wine', 'gatsby' ) => 'mulled-wine',
			esc_html__( 'Vista Blue', 'gatsby' ) => 'vista-blue',
			esc_html__( 'Black', 'gatsby' ) => 'black',
			esc_html__( 'Grey', 'gatsby' ) => 'grey',
			esc_html__( 'Orange', 'gatsby' ) => 'orange',
			esc_html__( 'Sky', 'gatsby' ) => 'sky',
			esc_html__( 'Green', 'gatsby' ) => 'green',
			esc_html__( 'Juicy pink', 'gatsby' ) => 'juicy-pink',
			esc_html__( 'Sandy brown', 'gatsby' ) => 'sandy-brown',
			esc_html__( 'Purple', 'gatsby' ) => 'purple',
			esc_html__( 'White', 'gatsby' ) => 'white'
		);

		return $colors;
	}
}

/**
 * @param string $asset
 *
 * @return array
 */
function gatsbygetVcShared( $asset = '' ) {
	switch ( $asset ) {
		case 'colors':
			return gatsbyVcSharedLibrary::getColors();
			break;

		case 'colors-dashed':
			return gatsbyVcSharedLibrary::getColorsDashed();
			break;

		case 'icons':
			return gatsbyVcSharedLibrary::getIcons();
			break;

		case 'sizes':
			return gatsbyVcSharedLibrary::getSizes();
			break;

		case 'button styles':
		case 'alert styles':
			return gatsbyVcSharedLibrary::getButtonStyles();
			break;
		case 'message_box_styles':
			return gatsbyVcSharedLibrary::getMessageBoxStyles();
			break;
		case 'cta styles':
			return gatsbyVcSharedLibrary::getCtaStyles();
			break;

		case 'text align':
			return gatsbyVcSharedLibrary::getTextAlign();
			break;

		case 'cta widths':
		case 'separator widths':
			return gatsbyVcSharedLibrary::getElementWidths();
			break;

		case 'separator styles':
			return gatsbyVcSharedLibrary::getSeparatorStyles();
			break;

		case 'separator border widths':
			return gatsbyVcSharedLibrary::getBorderWidths();
			break;

		case 'single image styles':
			return gatsbyVcSharedLibrary::getBoxStyles();
			break;

		case 'toggle styles':
			return gatsbyVcSharedLibrary::getToggleStyles();
			break;

		case 'animation styles':
			return gatsbyVcSharedLibrary::getAnimationStyles();
			break;

		default:
			# code...
			break;
	}

	return '';
}