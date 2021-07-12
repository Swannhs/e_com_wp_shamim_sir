<?php

if ( !function_exists('gatsby_check_theme_options') ) {

	function gatsby_check_theme_options() {
		// check default options
		global $gatsby_settings;

		ob_start();
		include( get_template_directory() . '/admin/framework/theme-options/default-options.php' );
		$options = ob_get_clean();
		$default_settings = json_decode($options, true);

		foreach ( $default_settings as $key => $value ) {

			if ( is_array($value) ) {
				foreach ( $value as $key1 => $value1 ) {
					if ((!isset($gatsby_settings[$key][$key1]) || !$gatsby_settings[$key][$key1])) {
						$gatsby_settings[$key][$key1] = $default_settings[$key][$key1];
					}
				}
			} else {
				if ( !isset($gatsby_settings[$key]) ) {
					$gatsby_settings[$key] = $default_settings[$key];
				}
			}
		}

		return $gatsby_settings;
	}

}

if ( !function_exists('gatsby_options_header_types') ) {
	function gatsby_options_header_types() {
		return array(
			'gt-type-1' => array('alt' => esc_html__('Header Type 1', 'gatsby'), 'img' => get_theme_file_uri('admin/framework/theme-options/headers/header_1.jpg')),
			'gt-type-2' => array('alt' => esc_html__('Header Type 2', 'gatsby'), 'img' => get_theme_file_uri('admin/framework/theme-options/headers/header_2.jpg')),
			'gt-type-3' => array('alt' => esc_html__('Header Type 3', 'gatsby'), 'img' => get_theme_file_uri('admin/framework/theme-options/headers/header_3.jpg')),
			'gt-type-4' => array('alt' => esc_html__('Header Type 4', 'gatsby'), 'img' => get_theme_file_uri('admin/framework/theme-options/headers/header_4.jpg')),
			'gt-type-5' => array('alt' => esc_html__('Header Type 5', 'gatsby'), 'img' => get_theme_file_uri('admin/framework/theme-options/headers/header_5.jpg')),
			'gt-type-6' => array('alt' => esc_html__('Header Type 6', 'gatsby'), 'img' => get_theme_file_uri('admin/framework/theme-options/headers/header_6.jpg')),
			'gt-type-7' => array('alt' => esc_html__('Header Type 7', 'gatsby'), 'img' => get_theme_file_uri('admin/framework/theme-options/headers/header_7.jpg')),
			'gt-type-8' => array('alt' => esc_html__('Header Type 8', 'gatsby'), 'img' => get_theme_file_uri('admin/framework/theme-options/headers/header_8.jpg')),
			'gt-type-9' => array('alt' => esc_html__('Header Type 9', 'gatsby'), 'img' => get_theme_file_uri('admin/framework/theme-options/headers/header_9.jpg')),
		);
	}
}

if ( !function_exists('gatsby_options_portfolio_types') ) {
	function gatsby_options_portfolio_types() {
		return array(
			'gt-type-1' => array('alt' => esc_html__('Portfolio Classic', 'gatsby'), 'img' => get_theme_file_uri('admin/framework/theme-options/portfolio/portfolio_1.jpg')),
			'gt-type-2' => array('alt' => esc_html__('Portfolio Masonry', 'gatsby'), 'img' => get_theme_file_uri('admin/framework/theme-options/portfolio/portfolio_2.jpg')),
			'gt-type-3' => array('alt' => esc_html__('Portfolio Grid', 'gatsby'), 'img' => get_theme_file_uri('admin/framework/theme-options/portfolio/portfolio_3.jpg')),
		);
	}
}


if ( !function_exists('gatsby_options_team_members_types') ) {
	function gatsby_options_team_members_types() {
		return array(
			'gt-type-1' => array('alt' => esc_html__('Team Members Type 1', 'gatsby'), 'img' => get_theme_file_uri('admin/framework/theme-options/team-members/team_member_1.jpg')),
			'gt-type-2' => array('alt' => esc_html__('Team Members Type 2', 'gatsby'), 'img' => get_theme_file_uri('admin/framework/theme-options/team-members/team_member_2.jpg')),
		);
	}
}

if ( !function_exists('gatsby_options_testimonials_types') ) {
	function gatsby_options_testimonials_types() {
		return array(
			'gt-type-2' => array('alt' => esc_html__('Testimonials Aligned Center', 'gatsby'), 'img' => get_theme_file_uri('admin/framework/theme-options/testimonials/testimonials_1.jpg')),
			'gt-type-3' => array('alt' => esc_html__('Testimonials Aligned Left', 'gatsby'), 'img' => get_theme_file_uri('admin/framework/theme-options/testimonials/testimonials_2.jpg')),
		);
	}
}

if ( !function_exists('gatsby_options_wrapper') ) {
	function gatsby_options_wrapper() {
		return array(
			"gt-wide-layout-type" => array( 'alt' => esc_html__('Wide', 'gatsby'), 'img' => get_theme_file_uri('admin/framework/theme-options/layouts/layout-wide.jpg')),
			"gt-boxed-layout-type" => array( 'alt' => esc_html__('Boxed', 'gatsby'), 'img' => get_theme_file_uri('admin/framework/theme-options/layouts/layout-boxed.jpg')),
		);
	}
}

if ( !function_exists('gatsby_options_layouts') ) {
	function gatsby_options_layouts() {
		return array(
			"gt-no-sidebar" => array( 'alt' => esc_html__('Without Sidebar', 'gatsby'), 'img' => get_template_directory_uri() . '/admin/framework/theme-options/layouts/layout-full.jpg' ),
			"gt-left-sidebar" => array( 'alt' => esc_html__('Left Sidebar', 'gatsby'), 'img' => get_template_directory_uri() . '/admin/framework/theme-options/layouts/layout-left.jpg' ),
			"gt-right-sidebar" => array( 'alt' => esc_html__('Right Sidebar', 'gatsby'), 'img' => get_template_directory_uri() . '/admin/framework/theme-options/layouts/layout-right.jpg' )
		);
	}
}

if ( !function_exists('gatsby_options_sidebars') ) {
	function gatsby_options_sidebars() {
		return array(
			"gt-left-sidebar",
			"gt-right-sidebar"
		);
	}
}

if ( !function_exists('gatsby_category_layout_mode') ) {
	function gatsby_category_layout_mode() {
		return array(
			"gt-type-1" => esc_html__("Type 1", 'gatsby'),
			"gt-type-2" => esc_html__("Type 2", 'gatsby')
		);
	}
}

if ( !function_exists('gatsby_category_view_mode') ) {
	function gatsby_category_view_mode() {
		return array(
			"gt-view-grid" => esc_html__("Grid", 'gatsby'),
			"gt-view-list" => esc_html__("List", 'gatsby')
		);
	}
}

if ( !function_exists('gatsby_product_columns') ) {
	function gatsby_product_columns() {
		return array(
			"2" => "2",
			"3" => "3"
		);
	}
}

if ( !function_exists('gatsby_related_product_columns') ) {
	function gatsby_related_product_columns() {
		return array(
			"3" => "3",
			"4" => "4"
		);
	}
}

if ( !function_exists('gatsby_categories_orderby') ) {
	function gatsby_categories_orderby() {
		return array(
			"id" => esc_html__("ID", 'gatsby'),
			"name" => esc_html__("Name", 'gatsby'),
			"slug" => esc_html__("Slug", 'gatsby'),
			"count" => esc_html__("Count", 'gatsby')
		);
	}
}

if ( !function_exists('gatsby_demo_types') ) {
	function gatsby_demo_types() {
		return array(
			'default' => array( 'alt' => esc_html__('Default', 'gatsby'), 'img' => get_template_directory_uri() . '/admin/framework/theme-options/demos/default.jpg', 'path' => 'admin/importer/data/default/default' ),
		);
	}
}