<?php


if (!function_exists('gatsby_cat_sidebars')) {

	function gatsby_cat_sidebars() {

		$registered_sidebars = Gatsby_Helper::get_registered_sidebars(array());
		$registered_custom_sidebars = array(
			'' => esc_html__('Default', 'gatsby')
		);

		if (!empty($registered_sidebars)) {
			foreach($registered_sidebars as $key => $value) {
				if (strpos($key, 'Footer Row') === false) {
					$registered_custom_sidebars[$key] = $value;
				}
			}
		}

		return $registered_custom_sidebars;

	}

}


if (!function_exists('gatsby_cat_meta_view')) {

	function gatsby_cat_meta_view() {

		$sidebar_options = gatsby_cat_sidebars();

		return array(
			'sidebar_position' => array(
				'name' => 'sidebar_position',
				'title' => esc_html__('Sidebar Position', 'gatsby'),
				'desc' => esc_html__('Choose sidebar position', 'gatsby'),
				'type' => 'select',
				'default' => '',
				'options' => array(
					'' => esc_html__('Default Sidebar Position', 'gatsby'),
					'gt-no-sidebar' => esc_html__('No Sidebar', 'gatsby'),
					'gt-left-sidebar' => esc_html__('Left Sidebar', 'gatsby'),
					'gt-right-sidebar' => esc_html__('Right Sidebar', 'gatsby')
				)
			),
			'sidebar' => array(
				'name' => 'sidebar',
				'title' => esc_html__('Sidebar Setting', 'gatsby'),
				'desc' => esc_html__('Select the sidebar you would like to display.', 'gatsby'),
				'type' => 'select',
				'default' => '',
				'options' => $sidebar_options
			),
			'shop_layout' => array(
				'name' => 'shop_layout',
				'title' => esc_html__('Shop Layout', 'gatsby'),
				'desc' => esc_html__('Choose shop type layout', 'gatsby'),
				'type' => 'select',
				'default' => 'view-grid',
				'options' => array(
					'' => esc_html__('Default', 'gatsby'),
					'gt-type-1' => esc_html__('Type 1', 'gatsby'),
					'gt-type-2' => esc_html__('Type 2', 'gatsby')
				)
			),
			'shop_view' => array(
				'name' => 'shop_view',
				'title' => esc_html__('Shop View', 'gatsby'),
				'desc' => esc_html__('Choose shop view layout - grid or list', 'gatsby'),
				'type' => 'select',
				'default' => 'view-grid',
				'options' => array(
					'' => esc_html__('Default', 'gatsby'),
					'gt-view-grid' => esc_html__('Grid View', 'gatsby'),
					'gt-view-list' => esc_html__('List View', 'gatsby')
				)
			),
			'overview_column_count' => array(
				'name' => 'overview_column_count',
				'title' => esc_html__('Column Count', 'gatsby'),
				'desc' => esc_html__('This controls how many columns should be appeared on overview pages.', 'gatsby'),
				'type' => 'select',
				'default' => '',
				'options' => array(
					'' => esc_html__('Default', 'gatsby'),
					2 => 2,
					3 => 3,
					4 => 4
				)
			)
		);

	}

}