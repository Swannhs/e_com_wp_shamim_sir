<?php
/**
 * Gatsby Settings Options
 */

if ( !class_exists('gatsby_redux_settings') ) {

	class gatsby_redux_settings {

		public $args = array();
		public $sections = array();
		public $theme;
		public $version;
		public $ReduxFramework;

		public function __construct() {

			if ( !class_exists('ReduxFramework') ) {
				return;
			}

			$this->initSettings();

		}

		public function initSettings() {

			$this->theme = wp_get_theme();

			// Set the default arguments
			$this->setArguments();

			// Create the sections and fields
			$this->setSections();

			if ( !isset($this->args['opt_name']) ) { return; }

			$this->ReduxFramework = new ReduxFramework($this->sections, $this->args);

		}

		public function arrayNumber($from = 0, $to = 50, $step = 1, $array = array()) {
			for ($i = $from; $i <= $to; $i += $step) {
				$array[$i] = $i;
			}
			return $array;
		}

		public function setSections() {

			$page_wrapper = gatsby_options_wrapper();
			$page_layouts = gatsby_options_layouts();
			$sidebars = gatsby_options_sidebars();
			$header_type = gatsby_options_header_types();
			$portfolio_type = gatsby_options_portfolio_types();
			$team_members_type = gatsby_options_team_members_types();
			$testimonials_type = gatsby_options_testimonials_types();

			$this->sections[] = array(
				'icon' => 'el-icon-dashboard',
				'icon_class' => 'icon',
				'title' => esc_html__('General', 'gatsby'),
				'fields' => array(
					array(
						'id' => 'show-loading-overlay',
						'type' => 'switch',
						'title' => esc_html__( 'Loading Overlay', 'gatsby' ),
						'default' => true,
						'on' => esc_html__('Show', 'gatsby'),
						'off' => esc_html__('Hide', 'gatsby'),
					),
					array(
						'id' => 'wrapper',
						'type' => 'image_select',
						'title' => __('Page Wrapper', 'gatsby'),
						'options' => $page_wrapper,
						'default' => 'gt-wide-layout-type'
					),
					array(
						'id' => 'page-layout',
						'type' => 'image_select',
						'title' => esc_html__('Page Layout', 'gatsby'),
						'options' => $page_layouts,
						'default' => 'gt-right-sidebar'
					),
					array(
						'id' => 'sidebar',
						'type' => 'select',
						'title' => esc_html__('Select Sidebar', 'gatsby'),
						'required' => array( 'page-layout','equals', $sidebars ),
						'data' => 'sidebars',
						'default' => 'general-widget-area'
					)
				)
			);

			// Logo
			$this->sections[] = array(
				'icon_class' => 'icon',
				'subsection' => true,
				'title' => esc_html__('Logo', 'gatsby'),
				'fields' => array(
					array(
						'id' => 'logo',
						'type' => 'media',
						'url'=> true,
						'readonly' => false,
						'title' => esc_html__('Logo', 'gatsby'),
						'default' => array(
							'url' => get_template_directory_uri() . '/images/logo.png'
						)
					),
					array(
						'id' => '12',
						'type' => 'info',
						'title' => esc_html__('If header type is like 2', 'gatsby'),
						'notice' => false
					),
					array(
						'id' => 'logo-dark',
						'type' => 'media',
						'url'=> true,
						'readonly' => false,
						'title' => esc_html__('Logo', 'gatsby'),
						'default' => array(
							'url' => get_template_directory_uri() . '/images/logo_dark.png'
						)
					),
					array(
						'id' => '112',
						'type' => 'info',
						'title' => esc_html__('If header type is like 3,4,5,7', 'gatsby'),
						'notice' => false
					),
					array(
						'id' => 'logo-large-dark',
						'type' => 'media',
						'url'=> true,
						'readonly' => false,
						'title' => esc_html__('Logo', 'gatsby'),
						'default' => array(
							'url' => get_template_directory_uri() . '/images/logo_large_dark.png'
						)
					),
					array(
						'id' => 'favicon',
						'type' => 'media',
						'url'=> true,
						'readonly' => false,
						'title' => esc_html__('Favicon', 'gatsby'),
						'default' => array(
							'url' => get_template_directory_uri() . '/images/favicon.png'
						)
					)
				)
			);

			// Skin Styling
			$this->sections[] = array(
				'icon' => 'el-icon-broom',
				'icon_class' => 'icon',
				'title' => esc_html__('Skin', 'gatsby'),
				'fields' => array(
					array(
						'id' => 'border-radius',
						'type' => 'switch',
						'title' => esc_html__('Border Radius', 'gatsby'),
						'default' => true
					),
					array(
						'id' => 'button-border-radius',
						'type' => 'switch',
						'title' => esc_html__('Button Border Radius', 'gatsby'),
						'default' => true
					),
					array(
						'id' => 'primary-color',
						'type' => 'color',
						'title' => esc_html__('Primary Color', 'gatsby'),
						'desc' => esc_html__('Color for link and other', 'gatsby'),
						'default' => '#2c3035',
						'validate' => 'color',
					),
					array(
						'id' => 'primary-inverse-color',
						'type' => 'color',
						'title' => esc_html__('Primary Inverse Color', 'gatsby'),
						'desc' => esc_html__('Color for link hover and other', 'gatsby'),
						'default' => '#28abe3',
						'validate' => 'color',
					),
					array(
						'id' => 'secondary-color',
						'type' => 'color',
						'title' => esc_html__('Secondary Color', 'gatsby'),
						'default' => '#28abe3',
						'validate' => 'color',
					),
					array(
						'id' => 'secondary-inverse-color',
						'type' => 'color',
						'title' => esc_html__('Secondary Inverse Color', 'gatsby'),
						'default' => '#28abe3',
						'validate' => 'color',
					),
					array(
						'id' => 'overlay-color',
						'type' => 'color_rgba',
						'title' => esc_html__('Overlay Color', 'gatsby'),
						'desc' => esc_html__('Color for portfolio, team, instagram hover overlay and other', 'gatsby'),
						'default'   => array(
							'color'     => '#28abe3',
							'alpha'     => .7
						),
					),
					array(
						'id' => 'selection-color',
						'type' => 'color',
						'desc' => esc_html__('The ::selection selector matches the portion of an element that is selected by a user.', 'gatsby'),
						'title' => esc_html__('Selection Background Color', 'gatsby'),
						'default'   => '#28abe3',
					),
				)
			);

			$this->sections[] = array(
				'icon_class' => 'icon',
				'subsection' => true,
				'title' => esc_html__('Typography', 'gatsby'),
				'fields' => array(
					array(
						'id' => 'select-google-charset',
						'type' => 'switch',
						'title' => esc_html__('Select Google Font Character Sets', 'gatsby'),
						'default' => false,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => 'google-charsets',
						'type' => 'button_set',
						'title' => esc_html__('Google Font Character Sets', 'gatsby'),
						'multi' => true,
						'required' => array('select-google-charset', 'equals', true),
						'options'=> array(
							'cyrillic' => 'Cyrrilic',
							'cyrillic-ext' => 'Cyrrilic Extended',
							'greek' => 'Greek',
							'greek-ext' => 'Greek Extended',
							'khmer' => 'Khmer',
							'latin' => 'Latin',
							'latin-ext' => 'Latin Extneded',
							'vietnamese' => 'Vietnamese'
						),
						'default' => array('latin','greek-ext','cyrillic','latin-ext','greek','cyrillic-ext','vietnamese','khmer')
					),
					array(
						'id' => 'body-font',
						'type' => 'typography',
						'title' => esc_html__('Body Font', 'gatsby'),
						'google' => true,
						'subsets' => false,
						'font-style' => false,
						'text-align' => false,
						'default'=> array(
							'color' => "#5f6366",
							'google' => true,
							'font-weight' => '400',
							'font-family' => 'Crimson Text',
							'font-size' => '22px',
							'line-height' => '36px'
						),
					),
					array(
						'id' => 'rest-font',
						'type' => 'typography',
						'title' => esc_html__('Font for other elements', 'gatsby'),
						'google' => true,
						'subsets' => false,
						'font-style' => false,
						'font-size' => false,
						'font-weight' => false,
						'line-height' => false,
						'color' => false,
						'text-align' => false,
						'default'=> array(
							'google' => true,
							'font-family' => 'Raleway',
						),
					),
					array(
						'id' => 'h1-font',
						'type' => 'typography',
						'title' => esc_html__('H1 Font', 'gatsby'),
						'google' => true,
						'subsets' => false,
						'font-style' => false,
						'text-align' => false,
						'default'=> array(
							'color' => "#2c3035",
							'google' => true,
							'font-weight' => '800',
							'font-family' => 'Raleway',
							'font-size' => '58px',
							'line-height' => '68px'
						),
					),
					array(
						'id' => 'h2-font',
						'type' => 'typography',
						'title' => esc_html__('H2 Font', 'gatsby'),
						'google' => true,
						'subsets' => false,
						'font-style' => false,
						'text-align' => false,
						'default'=> array(
							'color' => "#2c3035",
							'google' => true,
							'font-weight' => '700',
							'font-family' => 'Raleway',
							'font-size' => '50px',
							'line-height' => '54px'
						),
					),
					array(
						'id' => 'h3-font',
						'type' => 'typography',
						'title' => esc_html__('H3 Font', 'gatsby'),
						'google' => true,
						'subsets' => false,
						'font-style' => false,
						'text-align' => false,
						'default'=> array(
							'color' => "#2c3035",
							'google' => true,
							'font-weight' => '700',
							'font-family' => 'Raleway',
							'font-size' => '36px',
							'line-height' => '40px'
						),
					),
					array(
						'id'=>'h4-font',
						'type' => 'typography',
						'title' => esc_html__('H4 Font', 'gatsby'),
						'google' => true,
						'subsets' => false,
						'font-style' => false,
						'text-align' => false,
						'default'=> array(
							'color' => "#2c3035",
							'google' => true,
							'font-weight' => '700',
							'font-family' => 'Raleway',
							'font-size' => '30px',
							'line-height' => '34px'
						),
					),
					array(
						'id' => 'h5-font',
						'type' => 'typography',
						'title' => esc_html__('H5 Font', 'gatsby'),
						'google' => true,
						'subsets' => false,
						'font-style' => false,
						'text-align' => false,
						'default'=> array(
							'color' => "#2c3035",
							'google' => true,
							'font-weight' => '700',
							'font-family' => 'Raleway',
							'font-size' => '24px',
							'line-height' => '28px'
						),
					),
					array(
						'id' => 'h6-font',
						'type' => 'typography',
						'title' => esc_html__('H6 Font', 'gatsby'),
						'google' => true,
						'subsets' => false,
						'font-style' => false,
						'text-align' => false,
						'default'=> array(
							'color' => "#2c3035",
							'google' => true,
							'font-weight' => '700',
							'font-family' => 'Raleway',
							'font-size' => '18px',
							'line-height' => '24px'
						),
					),
				)
			);

			$this->sections[] = array(
				'icon_class' => 'icon',
				'subsection' => true,
				'title' => esc_html__('Backgrounds', 'gatsby'),
				'fields' => array(
					array(
						'id' => '1',
						'type' => 'info',
						'title' => esc_html__('Body Background', 'gatsby'),
						'notice' => false
					),
					array(
						'id' => 'body-bg',
						'type' => 'background',
						'title' => esc_html__('Background', 'gatsby')
					),
					array(
						'id'=>'1',
						'type' => 'info',
						'title' => esc_html__('Page Content Background', 'gatsby'),
						'notice' => false
					),
					array(
						'id' => 'content-bg-color',
						'type' => 'color',
						'title' => esc_html__('Background Color', 'gatsby'),
						'default' => '#ffffff',
						'validate' => 'color',
					),
				)
			);

			$this->sections[] = array(
				'icon_class' => 'icon',
				'subsection' => true,
				'title' => esc_html__('Main Menu', 'gatsby'),
				'fields' => array(
					array(
						'id' => '1',
						'type' => 'info',
						'title' => esc_html__('Sticky Menu', 'gatsby'),
						'notice' => false
					),
					array(
						'id' => 'sticky-menu-bg-color',
						'type' => 'color',
						'title' => esc_html__('Background Color', 'gatsby'),
						'default' => '#17191c',
						'validate' => 'color',
					),
					array(
						'id' => '1',
						'type' => 'info',
						'title' => esc_html__( 'Top Level Menu Item', 'gatsby' ),
						'notice' => false
					),
					array(
						'id' => 'menu-font',
						'type' => 'typography',
						'title' => esc_html__('Menu Font', 'gatsby'),
						'google' => true,
						'subsets' => false,
						'font-style' => false,
						'text-align' => false,
						'color' => false,
						'default'=> array(
							'google' => true,
							'font-weight' => '500',
							'font-family'=> 'Raleway',
							'font-size' => '14px',
							'line-height' => '28px'
						),
					),
					array(
						'id' => '1',
						'type' => 'info',
						'title' => esc_html__('If menu type is like 1', 'gatsby'),
						'notice' => false
					),
					array(
						'id' => 'primary-toplevel-hover-color',
						'type' => 'link_color',
						'regular' => false,
						'active' => false,
						'title' => esc_html__('Link Color', 'gatsby'),
						'default' => array(
							'hover' => '#28abe3'
						)
					),
					array(
						'id' => '1',
						'type' => 'info',
						'title' => esc_html__('If menu type is like 2, 3, 4, 5', 'gatsby'),
						'notice' => false
					),
					array(
						'id' => 'primary-toplevel-grey-type-link-color',
						'type' => 'link_color',
						'active' => false,
						'title' => esc_html__('Link Color', 'gatsby'),
						'default' => array(
							'regular' => '#17191c',
							'hover' => '#28abe3'
						)
					),
					array(
						'id' => 'menu-grey-text-transform',
						'type' => 'button_set',
						'title' => esc_html__('Text Transform', 'gatsby'),
						'options' => array(
							'none' => esc_html__('None', 'gatsby'),
							'capitalize' => esc_html__('Capitalize', 'gatsby'),
							'uppercase' => esc_html__('Uppercase', 'gatsby'),
							'lowercase' => esc_html__('Lowercase', 'gatsby'),
							'initial' => esc_html__('Initial', 'gatsby')
						),
						'default' => 'uppercase'
					),
					array(
						'id' => '1',
						'type' => 'info',
						'title' => esc_html__('If menu type is like 6', 'gatsby'),
						'notice' => false
					),
					array(
						'id' => 'menu-type-6-align',
						'type' => 'button_set',
						'title' => esc_html__('Navigation Alignment', 'gatsby'),
						'options' => array(
							'align-left' => esc_html__('Left', 'gatsby'),
							'align-right' => esc_html__('Right', 'gatsby'),
						),
						'default' => 'align-left'
					),
					array(
						'id' => 'menu-type-6-text-transform',
						'type' => 'button_set',
						'title' => esc_html__('Text Transform', 'gatsby'),
						'options' => array(
							'none' => esc_html__('None', 'gatsby'),
							'capitalize' => esc_html__('Capitalize', 'gatsby'),
							'uppercase' => esc_html__('Uppercase', 'gatsby'),
							'lowercase' => esc_html__('Lowercase', 'gatsby'),
							'initial' => esc_html__('Initial', 'gatsby')
						),
						'default' => 'initial'
					),
					array(
						'id' => 'primary-type-6-toplevel-link-color',
						'type' => 'link_color',
						'active' => false,
						'hover' => false,
						'title' => esc_html__('Link Color', 'gatsby'),
						'default' => array(
							'regular' => '#17191c'
						)
					),
					array(
						'id' => '1',
						'type' => 'info',
						'title' => esc_html__('If menu type is like 6, 7, 9', 'gatsby'),
						'notice' => false
					),
					array(
						'id' => 'primary-toplevel-border-type-link-color',
						'type' => 'link_color',
						'active' => false,
						'hover' => false,
						'title' => esc_html__('Border Active Color', 'gatsby'),
						'default' => array(
							'regular' => '#28abe3'
						)
					),
					array(
						'id' => '1',
						'type' => 'info',
						'title' => esc_html__('If menu type is like 1, 7, 8, 9', 'gatsby'),
						'notice' => false
					),
					array(
						'id' => 'menu-text-transform',
						'type' => 'button_set',
						'title' => esc_html__('Text Transform', 'gatsby'),
						'options' => array(
							'none' => esc_html__('None', 'gatsby'),
							'capitalize' => esc_html__('Capitalize', 'gatsby'),
							'uppercase' => esc_html__('Uppercase', 'gatsby'),
							'lowercase' => esc_html__('Lowercase', 'gatsby'),
							'initial' => esc_html__('Initial', 'gatsby')
						),
						'default' => 'initial'
					),
					array(
						'id' => 'primary-toplevel-link-color',
						'type' => 'link_color',
						'active' => false,
						'hover' => false,
						'title' => esc_html__('Link Color', 'gatsby'),
						'default' => array(
							'regular' => '#fff'
						)
					),
					array(
						'id'=>'1',
						'type' => 'info',
						'title' => esc_html__('Sub Menu', 'gatsby'),
						'notice' => false
					),
					array(
						'id' => 'sub-menu-font',
						'type' => 'typography',
						'title' => esc_html__('Sub Menu Font', 'gatsby'),
						'google' => true,
						'subsets' => false,
						'font-style' => false,
						'text-align' => false,
						'color' => false,
						'default'=> array(
							'google' => true,
							'font-weight' => '500',
							'font-family'=> 'Raleway',
							'font-size' => '15px',
							'line-height' => '20px'
						),
					),
					array(
						'id' => 'sub-menu-bg-color',
						'type' => 'color',
						'title' => esc_html__('Background Color', 'gatsby'),
						'default' => '#fcfcfc',
						'validate' => 'color',
					),
					array(
						'id' => 'sub-menu-heading-color',
						'type' => 'link_color',
						'active' => false,
						'hover' => false,
						'title' => esc_html__('Heading Color', 'gatsby'),
						'default' => array(
							'regular' => '#333',
						)
					),
					array(
						'id' => 'sub-menu-text-color',
						'type' => 'link_color',
						'active' => false,
						'title' => esc_html__('Link Color', 'gatsby'),
						'default' => array(
							'regular' => '#5f6366',
							'hover' => '#28abe3',
						)
					),
				)
			);

			$this->sections[] = array(
				'icon_class' => 'icon',
				'subsection' => true,
				'title' => esc_html__('Footer', 'gatsby'),
				'fields' => array(
					array(
						'id' => 'footer-bg',
						'type' => 'background',
						'title' => esc_html__('Background', 'gatsby'),
						'default' => array(
							'background-color' => '#17191c',
							'background-image' => get_template_directory_uri() . '/images/footer-bg.png'
						)
					),
					array(
						'id' => 'footer-heading-color',
						'type' => 'color',
						'title' => esc_html__('Heading Color', 'gatsby'),
						'default' => '#ffffff',
						'validate' => 'color',
					),
					array(
						'id' => 'footer-text-color',
						'type' => 'color',
						'title' => esc_html__('Text Color', 'gatsby'),
						'default' => '#ffffff',
						'validate' => 'color',
					),
					array(
						'id' => 'footer-link-color',
						'type' => 'link_color',
						'active' => false,
						'title' => esc_html__('Link Color', 'gatsby'),
						'default' => array(
							'regular' => '#c5cdce',
							'hover' => '#28abe3',
						)
					),
					array(
						'id'=>'1',
						'type' => 'info',
						'title' => esc_html__('Footer Bottom', 'gatsby'),
						'notice' => false
					),
					array(
						'id' => 'footer-bottom-link-color',
						'type' => 'link_color',
						'active' => false,
						'title' => esc_html__('Link Color', 'gatsby'),
						'default' => array(
							'regular' => '#ffffff',
							'hover' => '#28abe3',
						)
					),
				)
			);

			$this->sections[] = array(
				'icon_class' => 'icon',
				'subsection' => true,
				'title' => esc_html__('Shop', 'gatsby'),
				'fields' => array(
					array(
						'id' => 'shop-content-color',
						'type' => 'color',
						'title' => esc_html__('Page Content Background Color', 'gatsby'),
						'default' => '#fcfcfc',
						'validate' => 'color'
					),
					array(
						'id' => 'featured-color',
						'type' => 'color',
						'title' => esc_html__('Featured Background Color', 'gatsby'),
						'default' => '#20d76e',
						'validate' => 'color',
					),
					array(
						'id' => 'sale-color',
						'type' => 'color',
						'title' => esc_html__('Sale Background Color', 'gatsby'),
						'default' => '#ce2929',
						'validate' => 'color',
					),
					array(
						'id' => 'out-of-stock-color',
						'type' => 'color',
						'title' => esc_html__('Out of Stock Background Color', 'gatsby'),
						'default' => '#ccc',
						'validate' => 'color',
					),
				)
			);

			$this->sections[] = array(
				'icon_class' => 'icon',
				'subsection' => true,
				'title' => esc_html__('Custom CSS', 'gatsby'),
				'fields' => array(
					array(
						'id' => 'css-code',
						'type' => 'ace_editor',
						'title' => esc_html__('CSS Code', 'gatsby'),
						'subtitle' => esc_html__('Paste your CSS code here.', 'gatsby'),
						'mode' => 'css',
						'theme' => 'monokai',
						'default' => ""
					),
				)
			);

			// Header Settings
			$this->sections[] = array(
				'icon' => 'el-icon-website',
				'icon_class' => 'icon',
				'title' => esc_html__('Header', 'gatsby'),
				'fields' => array(
					array(
						'id' => '1',
						'type' => 'info',
						'title' => esc_html__('If header type is like 1', 'gatsby'),
						'notice' => false
					),
					array(
						'id' => 'header-type-1-search',
						'type' => 'switch',
						'title' => esc_html__('Show Search', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => 'header-type-1-cart',
						'type' => 'switch',
						'title' => esc_html__('Show Cart', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => '1',
						'type' => 'info',
						'title' => esc_html__('If header type is like 2', 'gatsby'),
						'notice' => false
					),
					array(
						'id' => 'header-type-2-search',
						'type' => 'switch',
						'title' => esc_html__('Show Search', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => 'header-type-2-cart',
						'type' => 'switch',
						'title' => esc_html__('Show Cart', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => 'header-type-2-aside-btn',
						'type' => 'switch',
						'title' => esc_html__('Show button for aside Widget Area', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => '1',
						'type' => 'info',
						'title' => esc_html__('If header type is like 4', 'gatsby'),
						'notice' => false
					),
					array(
						'id' => 'header-type-4-search',
						'type' => 'switch',
						'title' => esc_html__('Show Search', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => 'header-type-4-cart',
						'type' => 'switch',
						'title' => esc_html__('Show Cart', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => '1',
						'type' => 'info',
						'title' => esc_html__('If header type is like 7', 'gatsby'),
						'notice' => false
					),
					array(
						'id' => 'header-type-7-search',
						'type' => 'switch',
						'title' => esc_html__('Show Search', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => 'header-type-7-cart',
						'type' => 'switch',
						'title' => esc_html__('Show Cart', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => '1',
						'type' => 'info',
						'title' => esc_html__('If header type is like 8', 'gatsby'),
						'notice' => false
					),
					array(
						'id' => 'header-type-8-search',
						'type' => 'switch',
						'title' => esc_html__('Show Search', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => 'header-type-8-cart',
						'type' => 'switch',
						'title' => esc_html__('Show Cart', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => '1',
						'type' => 'info',
						'title' => esc_html__('If header type is like 9', 'gatsby'),
						'notice' => false
					),
					array(
						'id' => 'header-type-9-search',
						'type' => 'switch',
						'title' => esc_html__('Show Search', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
				)
			);

			$this->sections[] = array(
				'icon_class' => 'icon',
				'subsection' => true,
				'title' => esc_html__('Top Bar', 'gatsby'),
				'fields' => array(
					array(
						'id' => '1',
						'type' => 'info',
						'title' => esc_html__('If header type is like 2', 'gatsby'),
						'notice' => false
					),
					array(
						'id' => 'show-header-top-bar-light',
						'type' => 'switch',
						'title' => __('Show Top Bar', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => '1',
						'type' => 'info',
						'title' => esc_html__('If header type is like 5, 7', 'gatsby'),
						'notice' => false
					),
					array(
						'id' => 'show-header-top-bar',
						'type' => 'switch',
						'title' => __('Show Top Bar', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => "header-social-phone",
						'type' => 'text',
						'title' => esc_html__('Phone', 'gatsby'),
						'required' => array('show-header-top-bar','equals',true),
						'default' => '7 - 345 - 993 - 9455'
					),
					array(
						'id' => "header-social-email",
						'type' => 'text',
						'title' => esc_html__('Email', 'gatsby'),
						'required' => array('show-header-top-bar','equals',true),
						'default' => 'mail@gatsby.com'
					),
					array(
						'id' => "header-top-bar-hours",
						'type' => 'text',
						'title' => esc_html__('Opening Hours', 'gatsby'),
						'required' => array('show-header-top-bar','equals',true),
						'default' => 'Mon - Sat 8.00 - 18.00. Sunday CLOSED'
					),
					array(
						'id' => "header-top-bar-address",
						'type' => 'text',
						'title' => esc_html__('Opening Hours', 'gatsby'),
						'required' => array('show-header-top-bar','equals',true),
						'default' => '257 Fifth Avenue, 34th floor New York, NY 1018-3299 USA '
					),
					array(
						'id' => '1',
						'type' => 'info',
						'title' => esc_html__('Social Links', 'gatsby'),
						'notice' => false
					),
					array(
						'id' => "header-social-linkedin",
						'type' => 'text',
						'title' => esc_html__('LinkedIn', 'gatsby'),
						'required' => array('show-header-top-bar','equals',true),
						'default' => '#'
					),
					array(
						'id' => "header-social-tumblr",
						'type' => 'text',
						'title' => esc_html__('Tumblr', 'gatsby'),
						'required' => array('show-header-top-bar','equals',true),
						'default' => '#'
					),
					array(
						'id' => "header-social-vimeo",
						'type' => 'text',
						'title' => esc_html__('Vimeo', 'gatsby'),
						'required' => array('show-header-top-bar','equals',true),
						'default' => '#'
					),
					array(
						'id' => "header-social-youtube",
						'type' => 'text',
						'title' => esc_html__('Youtube', 'gatsby'),
						'required' => array('show-header-top-bar','equals',true),
						'default' => '#'
					),
					array(
						'id' => "header-social-facebook",
						'type' => 'text',
						'title' => esc_html__('Facebook', 'gatsby'),
						'required' => array('show-header-top-bar','equals',true),
						'default' => '#'
					),
					array(
						'id' => "header-social-twitter",
						'type' => 'text',
						'title' => esc_html__('Twitter', 'gatsby'),
						'required' => array('show-header-top-bar','equals',true),
						'default' => '#'
					),
					array(
						'id' => "header-social-instagram",
						'type' => 'text',
						'title' => esc_html__('Instagram', 'gatsby'),
						'required' => array('show-header-top-bar','equals',true),
						'default' => '#'
					),
					array(
						'id' => "header-social-flickr",
						'type' => 'text',
						'title' => esc_html__('Flickr', 'gatsby'),
						'required' => array('show-header-top-bar','equals',true),
						'default' => '#'
					)
				)
			);

			$this->sections[] = array(
				'icon_class' => 'icon',
				'subsection' => true,
				'title' => esc_html__('Page Header Type', 'gatsby'),
				'fields' => array(
					array(
						'id' => 'header-type',
						'type' => 'image_select',
						'full_width' => true,
						'title' => esc_html__('Header Type', 'gatsby'),
						'options' => $header_type,
						'default' => 'gt-type-1'
					),
				)
			);

			$this->sections[] = array(
				'icon_class' => 'icon',
				'subsection' => true,
				'title' => esc_html__('Shop Header Type', 'gatsby'),
				'fields' => array(
					array(
						'id' => 'shop-header-type',
						'type' => 'image_select',
						'full_width' => true,
						'title' => esc_html__('Shop Header Type', 'gatsby'),
						'options' => $header_type,
						'default' => 'gt-type-4'
					),
				)
			);

			// Breadcrumbs
			$this->sections[] = array(
				'icon' => 'el-icon-website',
				'icon_class' => 'icon',
				'title' => esc_html__('Breadcrumbs', 'gatsby'),
				'fields' => array(

				)
			);

			$this->sections[] = array(
				'icon_class' => 'icon',
				'subsection' => true,
				'title' => esc_html__('Pages & Posts', 'gatsby'),
				'fields' => array(
					array(
						'id' => 'show-pagetitle',
						'type' => 'switch',
						'title' => esc_html__('Show Page Title', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => 'show-breadcrumbs',
						'type' => 'switch',
						'title' => esc_html__('Show Breadcrumbs', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => 'page-title-upload',
						'type' => 'media',
						'url'=> true,
						'readonly' => false,
						'title' => esc_html__('Upload Background Image', 'gatsby'),
						'default' => array(
							'url' => get_template_directory_uri() . '/images/breadcrumbs_img_2.jpg'
						)
					),
				)
			);

			$this->sections[] = array(
				'icon_class' => 'icon',
				'subsection' => true,
				'title' => esc_html__('Portfolio', 'gatsby'),
				'fields' => array(
					array(
						'id' => 'portfolio-show-pagetitle',
						'type' => 'switch',
						'title' => esc_html__('Show Page Title', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => 'portfolio-show-breadcrumbs',
						'type' => 'switch',
						'title' => esc_html__('Show Breadcrumbs', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => 'portfolio-title-upload',
						'type' => 'media',
						'url'=> true,
						'readonly' => false,
						'title' => esc_html__('Upload Background Image', 'gatsby'),
						'desc' => esc_html__('Image for page title', 'gatsby'),
						'default' => array(
							'url' => get_template_directory_uri() . '/images/breadcrumbs_img_2.jpg'
						)
					),
				)
			);

			$this->sections[] = array(
				'icon_class' => 'icon',
				'subsection' => true,
				'title' => esc_html__('Testimonials', 'gatsby'),
				'fields' => array(
					array(
						'id' => 'testimonials-show-pagetitle',
						'type' => 'switch',
						'title' => esc_html__('Show Page Title', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => 'testimonials-show-breadcrumbs',
						'type' => 'switch',
						'title' => esc_html__('Show Breadcrumbs', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => 'testimonials-title-upload',
						'type' => 'media',
						'url'=> true,
						'readonly' => false,
						'title' => esc_html__('Upload Background Image', 'gatsby'),
						'desc' => esc_html__('Image for page title', 'gatsby'),
						'default' => array(
							'url' => get_template_directory_uri() . '/images/breadcrumbs_img_2.jpg'
						)
					),
				)
			);

			$this->sections[] = array(
				'icon_class' => 'icon',
				'subsection' => true,
				'title' => esc_html__('Team Members', 'gatsby'),
				'fields' => array(
					array(
						'id' => 'team-members-show-pagetitle',
						'type' => 'switch',
						'title' => esc_html__('Show Page Title', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => 'team-members-show-breadcrumbs',
						'type' => 'switch',
						'title' => esc_html__('Show Breadcrumbs', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => 'team-members-title-upload',
						'type' => 'media',
						'url'=> true,
						'readonly' => false,
						'title' => esc_html__('Upload Background Image', 'gatsby'),
						'desc' => esc_html__('Image for page title', 'gatsby'),
						'default' => array(
							'url' => get_template_directory_uri() . '/images/breadcrumbs_img_2.jpg'
						)
					),
				)
			);

			$this->sections[] = array(
				'icon_class' => 'icon',
				'subsection' => true,
				'title' => esc_html__('Shop', 'gatsby'),
				'fields' => array(
					array(
						'id' => 'product-show-pagetitle',
						'type' => 'switch',
						'title' => esc_html__('Show Page Title', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => 'product-show-breadcrumbs',
						'type' => 'switch',
						'title' => esc_html__('Show Breadcrumbs', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => 'product-title-upload',
						'type' => 'media',
						'url'=> true,
						'readonly' => false,
						'title' => esc_html__('Upload Background Image', 'gatsby'),
						'desc' => esc_html__('Image for page title', 'gatsby'),
						'default' => array(
							'url' => get_template_directory_uri() . '/images/breadcrumbs_img_2.jpg'
						)
					),
					array(
						'id' => 'product-overlay',
						'type' => 'slider',
						'title' => esc_html__('Opacity Overlay', 'gatsby'),
						'subtitle' => esc_html__('This displays float values for overlay', 'gatsby'),
						'desc' => esc_html__('Min: 0, max: 1, step: .1, default value: .5', 'gatsby'),
						'min' => 0,
						'max' => 1,
						'step' => 0.1,
						'resolution' => 0.1,
						'default' => .5,
						'display_value' => 'text'
					),
					array(
						'id' => 'product-color-overlay',
						'type' => 'color',
						'title' => esc_html__('Color Overlay', 'gatsby'),
						'default' => '#000',
						'validate' => 'color',
					),
				)
			);

			// Blog
			$this->sections[] = array(
				'icon' => 'el-icon-file',
				'icon_class' => 'icon',
				'title' => esc_html__('Blog', 'gatsby'),
				'fields' => array(
					array(
						'id' => 'post-metas',
						'type' => 'button_set',
						'title' => esc_html__('Post Meta', 'gatsby'),
						'multi' => true,
						'options'=> array(
							'date' => esc_html__('Date', 'gatsby'),
							'author' => esc_html__('Author', 'gatsby'),
							'cats' => esc_html__('Categories', 'gatsby'),
							'tags' => esc_html__('Tags', 'gatsby'),
							'comments' => esc_html__('Comments', 'gatsby'),
							'-' => esc_html__('None', 'gatsby')
						),
						'default' => array( 'date','author','cats','tags','comments', '-' )
					),
				)
			);

			$this->sections[] = array(
				'icon_class' => 'icon',
				'subsection' => true,
				'title' => esc_html__('Blog Post', 'gatsby'),
				'fields' => array(
					array(
						'id' => 'excerpt-count-big-thumbs',
						'type' => 'text',
						'title' => esc_html__( 'Excerpt Length', 'gatsby' ),
						'desc' => esc_html__( 'The number of words for style Count Big Thumbs ', 'gatsby' ),
						'default' => '300'
					),
					array(
						'id' => 'excerpt-count-small-thumbs',
						'type' => 'text',
						'title' => esc_html__( 'Excerpt Length', 'gatsby' ),
						'desc' => esc_html__( 'The number of words for style Count Small Thumbs ', 'gatsby' ),
						'default' => '300'
					),
				)
			);

			$this->sections[] = array(
				'icon_class' => 'icon',
				'subsection' => true,
				'title' => esc_html__('Post Archive', 'gatsby'),
				'fields' => array(
					array(
						'id' => 'post-archive-layout',
						'type' => 'image_select',
						'title' => esc_html__('Page Layout', 'gatsby'),
						'options' => $page_layouts,
						'default' => 'gt-no-sidebar'
					),
					array(
						'id' => 'post-archive-style',
						'type' => 'button_set',
						'title' => esc_html__('Blog Style', 'gatsby'),
						'options' => array(
							'gt-big-thumbs' => esc_html__('Big Thumbs', 'gatsby'),
							'gt-small-thumbs' => esc_html__('Small Thumbs', 'gatsby')
						),
						'default' => 'gt-big-thumbs'
					)
				)
			);

			$this->sections[] = array(
				'icon_class' => 'icon',
				'subsection' => true,
				'title' => esc_html__('Single Post', 'gatsby'),
				'fields' => array(
					array(
						'id' => 'post-single-layout',
						'type' => 'image_select',
						'title' => esc_html__('Page Layout', 'gatsby'),
						'options' => $page_layouts,
						'default' => 'gt-right-sidebar'
					),
					array(
						'id' => 'single-post-metas',
						'type' => 'button_set',
						'title' => esc_html__('Post Meta', 'gatsby'),
						'multi' => true,
						'options'=> array(
							'categories' => esc_html__('Categories', 'gatsby'),
							'breadcrumb' => esc_html__('Breadcrumbs', 'gatsby'),
							'date' => esc_html__('Date', 'gatsby'),
							'likes' => esc_html__('Likes', 'gatsby'),
							'comments' => esc_html__('Comments', 'gatsby'),
							'-' => esc_html__('None', 'gatsby')
						),
						'desc' => esc_html__('Located at the top of the post', 'gatsby'),
						'default' => array( 'categories', 'date','likes','comments', '-' )
					),
					array(
						'id' => 'post-tag',
						'type' => 'switch',
						'title' => esc_html__('Show Tags', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => 'post-share',
						'type' => 'switch',
						'title' => esc_html__('Show Social Links', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => 'post-nav',
						'type' => 'switch',
						'title' => esc_html__('Prev/Next Navigation', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => 'post-author',
						'type' => 'switch',
						'title' => esc_html__('Show Author Info Box', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => 'post-comments',
						'type' => 'switch',
						'title' => esc_html__('Show Comments', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
				)
			);

			// Portfolio
			$this->sections[] = array(
				'icon' => 'el-icon-picture',
				'icon_class' => 'icon',
				'title' => esc_html__('Portfolio', 'gatsby'),
				'fields' => array(

				)
			);

			$this->sections[] = array(
				'icon_class' => 'icon',
				'subsection' => true,
				'title' => __('Portfolio Archives', 'gatsby'),
				'fields' => array(
					array(
						'id' => 'portfolio-title',
						'type' => 'text',
						'title' => esc_html__('Page Title', 'gatsby'),
						'default' => esc_html__('Our Projects', 'gatsby')
					),
					array(
						'id' => 'portfolio-archive-layout',
						'type' => 'image_select',
						'title' => esc_html__('Layout', 'gatsby'),
						'options' => $portfolio_type,
						'default' => 'gt-type-1'
					),
					array(
						'id' => 'portfolio-archive-columns',
						'type' => 'button_set',
						'title' => esc_html__('Columns Layout', 'gatsby'),
						'options' => array(
							"2" => "2",
							"3" => "3",
							"4" => "4",
							"5" => "5"
						),
						'default' => '4'
					),
					array(
						'id' => 'portfolio-archive-count',
						'type' => 'text',
						'title' => esc_html__('Posts Per Page', 'gatsby'),
						'default' => '10'
					),

				)
			);

			$this->sections[] = array(
				'icon_class' => 'icon',
				'subsection' => true,
				'title' => esc_html__('Single Portfolio', 'gatsby'),
				'fields' => array(
					array(
						'id' => 'portfolio-excerpt',
						'type' => 'switch',
						'title' => esc_html__('Show Excerpt', 'gatsby'),
						'desc' => esc_html__('If yes, will be show the excerpt.', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => 'portfolio-share',
						'type' => 'switch',
						'title' => esc_html__('Show Social Links', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => '1',
						'type' => 'info',
						'title' => esc_html__('Portfolio Related Options', 'gatsby'),
						'notice' => false
					),
					array(
						'id' => 'portfolio-related',
						'type' => 'switch',
						'title' => esc_html__('Show Related Portfolio', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => 'portfolio-related-title',
						'type' => 'text',
						'required' => array( 'portfolio-related','equals', true ),
						'title' => esc_html__('Related Portfolio Title', 'gatsby'),
						'default' => esc_html__('You may also like', 'gatsby')
					),
					array(
						'id' => 'portfolio-related-count',
						'type' => 'text',
						'required' => array( 'portfolio-related','equals', true ),
						'title' => esc_html__('Related Portfolio Count', 'gatsby'),
						'default' => '10'
					),
					array(
						'id' => 'portfolio-related-orderby',
						'type' => 'button_set',
						'required' => array( 'portfolio-related','equals', true ),
						'title' => esc_html__('Related Portfolio Order by', 'gatsby'),
						'options' => array(
							'none' => esc_html__('None', 'gatsby'),
							'rand' => esc_html__('Random', 'gatsby'),
							'date' => esc_html__('Date', 'gatsby'),
							'ID' => esc_html__('ID', 'gatsby'),
							'modified' => esc_html__('Modified Date', 'gatsby'),
							'comment_count' => esc_html__('Comment Count', 'gatsby')
						),
						'default' => 'rand'
					),
				)
			);

			// Member
			$this->sections[] = array(
				'icon' => 'el-icon-user',
				'icon_class' => 'icon',
				'title' => esc_html__('Team Members', 'gatsby'),
				'fields' => array(
					array(
						'id' => 'team-member-excerpt-count',
						'type' => 'text',
						'title' => esc_html__( 'Excerpt Length', 'gatsby' ),
						'desc' => esc_html__( 'The number of words', 'gatsby' ),
						'default' => '100'
					),
				)
			);

			$this->sections[] = array(
				'icon_class' => 'icon',
				'subsection' => true,
				'title' => esc_html__('Archive Team Members', 'gatsby'),
				'fields' => array(
					array(
						'id' => 'team-members-title',
						'type' => 'text',
						'title' => esc_html__('Page Title', 'gatsby'),
						'default' => esc_html__('Our Team Members', 'gatsby')
					),
					array(
						'id' => 'team-members-archive-layout',
						'type' => 'image_select',
						'title' => esc_html__('Layout', 'gatsby'),
						'options' => $team_members_type,
						'default' => 'gt-type-1'
					),
					array(
						'id' => 'team-members-archive-position-desc',
						'type' => 'button_set',
						'title' => esc_html__('Position description', 'gatsby'),
						'options'=> array(
							'hover' => esc_html__('On hover', 'gatsby'),
							'bottom' => esc_html__('Bottom', 'gatsby'),
							'none' => esc_html__('None', 'gatsby')
						),
						'default' => 'hover'
					),
					array(
						'id' => 'team-members-archive-columns',
						'type' => 'button_set',
						'title' => esc_html__('Columns Layout', 'gatsby'),
						'options' => array(
							"3" => "3",
							"4" => "4",
						),
						'default' => '3'
					),
					array(
						'id' => 'team-members-archive-count',
						'type' => 'text',
						'title' => esc_html__('Posts Per Page', 'gatsby'),
						'default' => '10'
					),
				)
			);

			// Testimonials
			$this->sections[] = array(
				'icon' => 'el-icon-quotes',
				'icon_class' => 'icon',
				'title' => esc_html__('Testimonials', 'gatsby'),
				'fields' => array(

				)
			);

			$this->sections[] = array(
				'icon_class' => 'icon',
				'subsection' => true,
				'title' => esc_html__('Archive Testimonials', 'gatsby'),
				'fields' => array(
					array(
						'id' => 'testimonials-title',
						'type' => 'text',
						'title' => esc_html__('Page Title', 'gatsby'),
						'default' => esc_html__('Our Testimonials', 'gatsby')
					),
					array(
						'id' => 'testimonials-archive-layout',
						'type' => 'image_select',
						'title' => esc_html__('Layout', 'gatsby'),
						'options' => $testimonials_type,
						'default' => 'gt-type-3'
					),
					array(
						'id' => 'testimonials-archive-columns',
						'type' => 'button_set',
						'title' => esc_html__('Columns Layout', 'gatsby'),
						'options' => array(
							"2" => "2",
							"3" => "3",
						),
						'default' => '2'
					),
					array(
						'id' => 'testimonials-archive-count',
						'type' => 'text',
						'title' => esc_html__('Posts Per Page', 'gatsby'),
						'default' => '10'
					),
				)
			);

			// Javascript Code
			$this->sections[] = array(
				'icon_class' => 'el-icon-edit',
				'title' => esc_html__('Javascript Code', 'gatsby'),
				'fields' => array(
					array(
						'id' => 'js-code-head',
						'type' => 'ace_editor',
						'title' => esc_html__('Javascript Code Before &lt;/head&gt;', 'gatsby'),
						'subtitle' => esc_html__('Paste your JS code here.', 'gatsby'),
						'mode' => 'javascript',
						'theme' => 'monokai',
						'default' => "jQuery(document).ready(function(){});"
					)
				)
			);

			// Footer Settings
			$this->sections[] = array(
				'icon' => 'el-icon-website',
				'icon_class' => 'icon',
				'title' => esc_html__('Footer', 'gatsby'),
				'fields' => array(
					array(
						'id' => "footer-copyright",
						'type' => 'textarea',
						'title' => esc_html__('Copyright', 'gatsby'),
						'default' => sprintf( __('&copy; Copyright %s. All Rights Reserved.', 'gatsby'), date('Y') )
					),
					array(
						'id' => 'show-footer-menu',
						'type' => 'switch',
						'title' => esc_html__('Show Menu', 'gatsby'),
						'default' => false,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
				)
			);

			$this->sections[] = array(
				'icon_class' => 'icon',
				'subsection' => true,
				'title' => esc_html__('Social Links', 'gatsby'),
				'fields' => array(
					array(
						'id' => 'show-footer-socials',
						'type' => 'switch',
						'title' => esc_html__('Show Social Links', 'gatsby'),
						'default' => false,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => "footer-social-linkedin",
						'type' => 'text',
						'title' => esc_html__('LinkedIn', 'gatsby'),
						'required' => array('show-footer-socials','equals',true)
					),
					array(
						'id' => "footer-social-tumblr",
						'type' => 'text',
						'title' => esc_html__('Tumblr', 'gatsby'),
						'required' => array('show-footer-socials','equals',true)
					),
					array(
						'id' => "footer-social-vimeo",
						'type' => 'text',
						'title' => esc_html__('Vimeo', 'gatsby'),
						'required' => array('show-footer-socials','equals',true)
					),
					array(
						'id' => "footer-social-facebook",
						'type' => 'text',
						'title' => esc_html__('Facebook', 'gatsby'),
						'required' => array('show-footer-socials','equals',true)
					),
					array(
						'id' => "footer-social-flickr",
						'type' => 'text',
						'title' => esc_html__('Flickr', 'gatsby'),
						'required' => array('show-footer-socials','equals',true)
					)
				)
			);

			// 404 Page
			$this->sections[] = array(
				'icon' => 'el-icon-error',
				'icon_class' => 'icon',
				'title' => esc_html__('404 Page', 'gatsby'),
				'fields' => array(
					array(
						'id' => 'error-type',
						'type' => 'select',
						'title' => esc_html__('Select Type', 'gatsby'),
						'options' => array(
							'type-1' => esc_html__('Type 1', 'gatsby'),
							'type-2' => esc_html__('Type 2', 'gatsby'),
							'type-3' => esc_html__('Type 3', 'gatsby')
						),
						'default' => 'type-1'
					),
					array(
						'id' => 'error-content',
						'type' => 'textarea',
						'title' => esc_html__('Error text', 'gatsby'),
						'validate' => 'html_custom',
						'default' => 'You may have mistyped the URL.<br>Or the page has been removed.',
						'allowed_html' => array(
							'a' => array(
								'href' => array(),
								'title' => array()
							),
							'br' => array(),
							'em' => array(),
							'strong' => array()
						)
					),
					array(
						'id' => 'error-image',
						'type' => 'media',
						'url'=> true,
						'readonly' => false,
						'title' => esc_html__('Error Background Image', 'gatsby'),
						'default' => array(
							'url' => get_template_directory_uri() . '/images/fullscreen_bg_4.jpg'
						)
					),
					array(
						'id' => '1',
						'type' => 'info',
						'title' => esc_html__('If 404 type is like 2', 'gatsby'),
						'required' => array( 'error-type','equals', 'type-2' ),
						'notice' => false
					),
					array(
						'id' => 'error-image-text',
						'type' => 'media',
						'url'=> true,
						'readonly' => false,
						'title' => esc_html__('Error 404 image', 'gatsby'),
						'default' => array(
							'url' => get_template_directory_uri() . '/images/404.png'
						)
					),
				)
			);

			// Shop
			$this->sections[] = array(
				'icon' => 'el-icon-shopping-cart',
				'icon_class' => 'icon',
				'title' => esc_html__('Shop', 'gatsby'),
				'fields' => array(
					array(
						'id' => '1',
						'type' => 'info',
						'title' => esc_html__('Product Item Settings', 'gatsby'),
						'notice' => false
					),
					array(
						'id' => 'product-quick-view',
						'type' => 'switch',
						'title' => esc_html__('Show Quick View', 'gatsby'),
						'desc' => esc_html__('If you choose Yes, you will see quick view on the product box', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => 'product-wishlist-view',
						'type' => 'switch',
						'title' => esc_html__('Show Wishlist', 'gatsby'),
						'desc' => esc_html__('If you choose Yes, you will see wishlist on the product box', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => 'product-compare-view',
						'type' => 'switch',
						'title' => esc_html__('Show Compare', 'gatsby'),
						'desc' => esc_html__('If you choose Yes, you will see compare on the product box', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => '1',
						'type' => 'info',
						'title' => esc_html__('Label Status', 'gatsby'),
						'notice' => false
					),
					array(
						'id' => 'product-stock',
						'type' => 'switch',
						'title' => esc_html__('Show "Out of stock" Status', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => 'product-featured',
						'type' => 'switch',
						'title' => esc_html__('Show "Featured" Status', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => 'product-sale',
						'type' => 'switch',
						'title' => esc_html__('Show "Sale" Status', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => 'product-new',
						'type' => 'switch',
						'title' => esc_html__('Show "New" Status', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),

				)
			);

			$this->sections[] = array(
				'icon_class' => 'icon',
				'subsection' => true,
				'title' => esc_html__('Product Archives', 'gatsby'),
				'fields' => array(
					array(
						'id' => 'product-archive-layout',
						'type' => 'image_select',
						'title' => esc_html__('Page Layout', 'gatsby'),
						'options' => $page_layouts,
						'default' => 'gt-right-sidebar'
					),
					array(
						'id' => 'product-sidebar',
						'type' => 'select',
						'title' => esc_html__('Select Sidebar', 'gatsby'),
						'required' => array( 'product-archive-layout','equals', $sidebars ),
						'data' => 'sidebars',
						'default' => 'shop-widget-area'
					),
					array(
						'id' => 'product-type-layout',
						'type' => 'button_set',
						'title' => esc_html__('Layout', 'gatsby'),
						'options' => gatsby_category_layout_mode(),
						'default' => 'gt-type-1',
					),
					array(
						'id' => 'category-view-mode',
						'type' => 'button_set',
						'title' => esc_html__('View Mode', 'gatsby'),
						'options' => gatsby_category_view_mode(),
						'default' => 'gt-view-grid',
					),
					array(
						'id' => 'category-item',
						'type' => 'text',
						'title' => esc_html__('Products per Page', 'gatsby'),
						'desc' => esc_html__('Comma separated list of product counts.', 'gatsby'),
						'default' => '24,16,8'
					),
					array(
						'id' => 'shop-product-cols',
						'type' => 'button_set',
						'title' => esc_html__('Shop Page Product Columns', 'gatsby'),
						'options' => gatsby_product_columns(),
						'default' => '3',
					),
					array(
						'id' => 'category-product-cols',
						'type' => 'button_set',
						'title' => esc_html__('Category Product Columns', 'gatsby'),
						'options' => gatsby_product_columns(),
						'default' => '3',
					),
				)
			);

			$this->sections[] = array(
				'icon_class' => 'icon',
				'subsection' => true,
				'title' => esc_html__('Single Product', 'gatsby'),
				'fields' => array(
					array(
						'id' => 'product-single-layout',
						'type' => 'image_select',
						'title' => esc_html__('Single Layout', 'gatsby'),
						'options' => $page_layouts,
						'default' => 'gt-no-sidebar'
					),
					array(
						'id' => 'product-single-sidebar',
						'type' => 'select',
						'title' => esc_html__('Select Sidebar', 'gatsby'),
						'required' => array( 'product-single-layout','equals', $sidebars ),
						'data' => 'sidebars',
						'default' => 'shop-widget-area'
					),
					array(
						'id' => 'product-zoom',
						'type' => 'switch',
						'title' => esc_html__('Show Zoom', 'gatsby'),
						'default' => true,
						'desc' 	=> esc_html__('If you choose Yes, you will see zoom in the product image', 'gatsby'),
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => 'product-lightbox',
						'type' => 'switch',
						'title' => esc_html__('Show Lightbox', 'gatsby'),
						'default' => true,
						'desc' 	=> esc_html__('If you choose Yes, you will see lightbox in the product image', 'gatsby'),
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => 'product-short-description',
						'type' => 'switch',
						'title' => esc_html__('Show Short Description', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => 'product-metas',
						'type' => 'button_set',
						'title' => esc_html__('Product Meta', 'gatsby'),
						'multi' => true,
						'options'=> array(
							'sku' => esc_html__('SKU', 'gatsby'),
							'cats' => esc_html__('Categories', 'gatsby'),
							'tags' => esc_html__('Tags', 'gatsby'),
							'-' => esc_html__('None', 'gatsby'),
						),
						'default' => array( 'sku','cats','tags', '-' )
					),
					array(
						'id' => 'product-related',
						'type' => 'switch',
						'title' => esc_html__('Show Related Products', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => 'product-related-count',
						'type' => 'text',
						'required' => array( 'product-related','equals',true ),
						'title' => esc_html__('Related Count items', 'gatsby'),
						'default' => '4'
					),
					array(
						'id' => 'product-related-cols',
						'type' => 'button_set',
						'required' => array( 'product-related','equals',true ),
						'title' => esc_html__('Related Product Columns', 'gatsby'),
						'options' => gatsby_related_product_columns(),
						'default' => '4',
					),
					array(
						'id' => 'product-upsells',
						'type' => 'switch',
						'title' => esc_html__('Show Up-Sells', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => 'product-upsells-count',
						'type' => 'text',
						'required' => array('product-upsells','equals',true),
						'title' => esc_html__('Up-Sells Count items', 'gatsby'),
						'default' => '4'
					),
					array(
						'id' => 'product-upsells-cols',
						'type' => 'button_set',
						'required' => array( 'product-upsells','equals',true ),
						'title' => esc_html__('Up-Sells Product Columns', 'gatsby'),
						'options' => gatsby_related_product_columns(),
						'default' => '4',
					),
					array(
						'id' => '1',
						'type' => 'info',
						'title' => esc_html__('Label Status', 'gatsby'),
						'notice' => false
					),
					array(
						'id' => 'product-single-stock',
						'type' => 'switch',
						'title' => esc_html__('Show "Out of stock" Status', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => 'product-single-featured',
						'type' => 'switch',
						'title' => esc_html__('Show "Featured" Status', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => 'product-single-sale',
						'type' => 'switch',
						'title' => esc_html__('Show "Sale" Status', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => 'product-single-new',
						'type' => 'switch',
						'title' => esc_html__('Show "New" Status', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => '1',
						'type' => 'info',
						'title' => esc_html__('Social Links', 'gatsby'),
						'notice' => false
					),
					array(
						'id' => 'product-single-share',
						'type' => 'switch',
						'title' => esc_html__('Show Social Links', 'gatsby'),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => 'product-share-linkedin',
						'type' => 'switch',
						'title' => esc_html__('Enable LinkedIn Share', 'gatsby'),
						'required' => array('product-single-share','equals',true),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => 'product-share-tumblr',
						'type' => 'switch',
						'title' => esc_html__('Enable Tumblr Share', 'gatsby'),
						'required' => array('product-single-share','equals',true),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => 'product-share-twitter',
						'type' => 'switch',
						'title' => esc_html__('Enable Twitter Share', 'gatsby'),
						'required' => array('product-single-share','equals',true),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => 'product-share-facebook',
						'type' => 'switch',
						'title' => esc_html__('Enable Facebook Share', 'gatsby'),
						'required' => array('product-single-share','equals',true),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
					array(
						'id' => 'product-share-googleplus',
						'type' => 'switch',
						'title' => esc_html__('Enable Google Plus Share', 'gatsby'),
						'required' => array('product-single-share','equals',true),
						'default' => true,
						'on' => esc_html__('Yes', 'gatsby'),
						'off' => esc_html__('No', 'gatsby'),
					),
				)
			);

			$this->sections[] = array(
				'icon_class' => 'icon',
				'subsection' => true,
				'title' => esc_html__('Cart', 'gatsby'),
				'fields' => array(
					array(
						'id' => 'product-crosssell',
						'type' => 'switch',
						'title' => esc_html__('Show Cross-Sells', 'gatsby'),
						'default' => true,
						'on' => __('Yes', 'gatsby'),
						'off' => __('No', 'gatsby'),
					),
					array(
						'id' => 'product-crosssell-count',
						'type' => 'text',
						'required' => array( 'product-crosssell','equals',true ),
						'title' => esc_html__('Cross Sells Count', 'gatsby'),
						'default' => '4'
					),
				)
			);

			// Google
			$this->sections[] = array(
				'icon' => 'el-googleplus',
				'icon_class' => 'el',
				'title' => esc_html__('Google', 'gatsby'),
				'fields' => array(
					array(
						'id' => '1',
						'type' => 'info',
						'style' => 'normal',
						'title' => esc_html__('Google recently changed the way their map service works. New pages which want to use Google Maps need to register an API key for their website. Older pages should  work fine without this API key. If the google map elements of this theme do not work properly you need to register a new API key.', 'gatsby'),
						'notice' => false
					),
					array(
						'id' => 'gmap-api',
						'type' => 'textarea',
						'title' => esc_html__('Google Maps API Key', 'gatsby'),
						'desc' => esc_html__('Enter a valid Google Maps API Key to use all map related theme functions.', 'gatsby'),
						'default' => ''
					),
				)
			);

		}

		public function setArguments() {

			$theme = $this->theme;

			$this->args = array(
				'opt_name'          => 'gatsby_settings',
				'display_name'      => $theme->get('Name') . ' ' . esc_html__('Theme Options', 'gatsby'),
				'display_version'   => esc_html__('Theme Version: ', 'gatsby') . strtolower($theme->get('Version')),
				'menu_type'         => 'submenu',
				'allow_sub_menu'    => true,
				'menu_title'        => esc_html__('Theme Options', 'gatsby'),
				'page_title'        => esc_html__('Theme Options', 'gatsby'),
				'footer_credit'     => esc_html__('Theme Options', 'gatsby'),

				'google_api_key' => 'AIzaSyBQft4vTUGW75YPU6c0xOMwLKhxCEJDPwg',
				'disable_google_fonts_link' => true,

				'async_typography'  => false,
				'admin_bar'         => false,
				'admin_bar_icon'       => 'dashicons-admin-generic',
				'admin_bar_priority'   => 50,
				'global_variable'   => '',
				'dev_mode'          => false,
				'customizer'        => false,
				'compiler'          => false,

				'page_priority'     => null,
				'page_parent'       => 'themes.php',
				'page_permissions'  => 'manage_options',
				'menu_icon'         => '',
				'last_tab'          => '',
				'page_icon'         => 'icon-themes',
				'page_slug'         => 'gatsby_settings',
				'save_defaults'     => true,
				'default_show'      => false,
				'default_mark'      => '',
				'show_import_export' => true,
				'show_options_object' => false,

				'transient_time'    => 60 * MINUTE_IN_SECONDS,
				'output'            => false,
				'output_tag'        => false,

				'database'              => '',
				'system_info'           => false,

				'hints' => array(
					'icon'          => 'icon-question-sign',
					'icon_position' => 'right',
					'icon_color'    => 'lightgray',
					'icon_size'     => 'normal',
					'tip_style'     => array(
						'color'         => 'light',
						'shadow'        => true,
						'rounded'       => false,
						'style'         => '',
					),
					'tip_position'  => array(
						'my' => 'top left',
						'at' => 'bottom right',
					),
					'tip_effect'    => array(
						'show'          => array(
							'effect'        => 'slide',
							'duration'      => '500',
							'event'         => 'mouseover',
						),
						'hide'      => array(
							'effect'    => 'slide',
							'duration'  => '500',
							'event'     => 'click mouseleave',
						),
					),
				),
				'ajax_save'                 => false,
				'use_cdn'                   => true,
			);

		}

	}

	global $gatsby_redux_settings;
	$gatsby_redux_settings = new gatsby_redux_settings();

}