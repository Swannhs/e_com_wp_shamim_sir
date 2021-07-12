<?php
if (!class_exists('gatsby_vc_advanced_tabs')) {

	class gatsby_vc_advanced_tabs {

		function __construct() {
			add_action( 'admin_print_scripts', array( $this, 'enqueue_admin_scripts' ), 999 );
			add_action( 'vc_before_init', array(&$this, 'add_map'), 5 );
		}

		public function enqueue_admin_scripts() {
			$screen = get_current_screen();
			$screen_id = $screen->base;

			if ( $screen_id !== 'post' )
				return false;

			wp_enqueue_script( 'gatsby-vc-tab-admin', get_template_directory_uri() . '/config-composer/assets/js/js_tab_admin_enqueue.js', array( 'jquery' ), true );
			wp_enqueue_script( 'gatsby-vc-tab-single', get_template_directory_uri() . '/config-composer/assets/js/js_tab_single_element.js', array( 'jquery' ), true );
		}

		function add_map() {

			if ( function_exists('vc_map') ) {

				$tab_id_1 = time() . '-1-' . rand( 0, 100 );
				$tab_id_2 = time() . '-2-' . rand( 0, 100 );

				vc_map( array(
					"name"    => esc_html__('Advanced Tabs', 'gatsby') ,
					"base"    => 'vc_mad_tab_element',
					"category"  => esc_html__('Gatsby', 'gatsby'),
					"description" => esc_html__("Create nice looking tabs.", "gatsby"),
					'is_container' => true,
					'weight' => - 5,
					'admin_enqueue_css' => get_template_directory_uri() . '/config-composer/assets/css/sub-tab.css',
					'js_view' => 'GatsbyTabView',
					'icon' => 'icon-wpb-mad-advanced-tabs',
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
							'heading' => esc_html__( 'Type', 'gatsby' ),
							'param_name' => 'type',
							'value' => array(
								esc_html__( 'Type 1', 'gatsby' ) => 'gt-type-1',
								esc_html__( 'Type 2', 'gatsby' ) => 'gt-type-2',
								esc_html__( 'Type 3', 'gatsby' ) => 'gt-type-3',
								esc_html__( 'Type 4', 'gatsby' ) => 'gt-type-4',
							),
							'description' => esc_html__('Choose the type style.', 'gatsby')
						),
						gatsby_vc_map_add_css_animation(false)
					),
					'custom_markup' => '<div class="wpb_tabs_holder wpb_holder vc_container_for_children">
									<ul class="tabs_controls">
									</ul>
									%content%
									</div>'	,

					'default_content' => '[vc_mad_single_tab title="' . esc_html__( 'Tab 1', 'gatsby' ) . '" tab_id="' . $tab_id_1 . ' ][/vc_mad_single_tab]
					  [vc_mad_single_tab title="' . esc_html__( 'Tab 2', 'gatsby' ) . '" tab_id="' . $tab_id_2 . ' ][/vc_mad_single_tab]'
				));

				vc_map( array(
					'name' => esc_html__( 'SubTab', 'gatsby' ),
					'base' => 'vc_mad_single_tab',
					'allowed_container_element' => 'vc_row',
					'is_container' => true,
					'content_element' => true,
					"as_child" => array( 'only' => 'vc_mad_tab_element, vc_mad_tour_element' ),
					'js_view' => 'GatsbySubTabView',
					'params' => array(
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Title', 'gatsby' ),
							'param_name' => 'title'
						),
						array(
							'type' => 'checkbox',
							'param_name' => 'add_icon',
							'heading' => esc_html__( 'Add icon?', 'gatsby' ),
							'description' => esc_html__( 'Add icon next to section title.', 'gatsby' ),
						),
						array(
							"type" => "choose_icons",
							"heading" => esc_html__("Icon", 'gatsby'),
							"param_name" => "icon",
							"value" => 'none',
							'dependency' => array(
								'element' => 'add_icon',
								'value' => 'true',
							),
							"description" => esc_html__( 'Select icon from library', 'gatsby')
						),
						array(
							'type' => 'tab_id',
							"edit_field_class" => " vc_col-sm-12 vc_column wpb_el_type_textfield vc_shortcode-param",
							'heading' => esc_html__( 'Tab ID', 'gatsby' ),
							'param_name' => "tab_id"
						),
					)

				) );

			}
		}

	}

	new gatsby_vc_advanced_tabs();

	if ( class_exists('WPBakeryShortCode') ) {

		class WPBakeryShortCode_VC_mad_tab_element extends WPBakeryShortCode {

			static $filter_added = false;
			protected $controls_css_settings = 'out-tc vc_controls-content-widget';
			protected $controls_list = array( 'edit', 'clone', 'delete' );
			public function __construct( $settings ) {
				parent::__construct( $settings ); // !Important to call parent constructor to active all logic for shortcode.
				if ( ! self::$filter_added ) {
					$this->addFilter( 'vc_inline_template_content', 'setCustomTabId' );
					self::$filter_added = true;
				}
			}

			public function contentAdmin( $atts, $content = null ) {
				$width = $custom_markup = '';
				$shortcode_attributes = array( 'width' => '1/1' );
				foreach ( $this->settings['params'] as $param ) {
					if ( $param['param_name'] != 'content' ) {
						if ( isset( $param['value'] ) && is_string( $param['value'] ) ) {
							$shortcode_attributes[$param['param_name']] = sprintf(esc_html__( '%s', "gatsby" ), $param['value']);
						} elseif ( isset( $param['value'] ) ) {
							$shortcode_attributes[$param['param_name']] = $param['value'];
						}
					} else if ( $param['param_name'] == 'content' && $content == NULL ) {
						$content = sprintf(esc_html__( '%s', "gatsby" ), $param['value']);
					}
				}
				extract( shortcode_atts(
					$shortcode_attributes
					, $atts ) );

				// Extract tab titles
				preg_match_all( '/vc_tab title="([^\"]+)"(\stab_id\=\"([^\"]+)\"){0,1}/i', $content, $matches, PREG_OFFSET_CAPTURE );

				$output = '';
				$tab_titles = array();

				if ( isset( $matches[0] ) ) {
					$tab_titles = $matches[0];
				}
				$tmp = '';
				if ( count( $tab_titles ) ) {
					$tmp .= '<ul class="clearfix tabs_controls">';
					foreach ( $tab_titles as $tab ) {
						preg_match( '/title="([^\"]+)"(\stab_id\=\"([^\"]+)\"){0,1}/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE );
						if ( isset( $tab_matches[1][0] ) ) {
							$tmp .= '<li><a href="#tab-' . ( isset( $tab_matches[3][0] ) ? $tab_matches[3][0] : sanitize_title( $tab_matches[1][0] ) ) . '">' . $tab_matches[1][0]. '</a></li>';

						}
					}
					$tmp .= '</ul>' . "\n";
				} else {
					$output .= do_shortcode( $content );
				}

				$elem = $this->getElementHolder( $width );

				$iner = '';
				foreach ( $this->settings['params'] as $param ) {
					$custom_markup = '';
					$param_value = isset( $param['param_name'] ) ? $param['param_name'] : '';
					if ( is_array( $param_value ) ) {
						// Get first element from the array
						reset( $param_value );
						$first_key = key( $param_value );
						$param_value = $param_value[$first_key];
					}
					$iner .= $this->singleParamHtmlHolder( $param, $param_value );
				}
				//$elem = str_ireplace('%wpb_element_content%', $iner, $elem);

				if ( isset( $this->settings["custom_markup"] ) && $this->settings["custom_markup"] != '' ) {
					if ( $content != '' ) {
						$custom_markup = str_ireplace( "%content%", $tmp . $content, $this->settings["custom_markup"] );
					} else if ( $content == '' && isset( $this->settings["default_content_in_template"] ) && $this->settings["default_content_in_template"] != '' ) {
						$custom_markup = str_ireplace( "%content%", $this->settings["default_content_in_template"], $this->settings["custom_markup"] );
					} else {
						$custom_markup = str_ireplace( "%content%", '', $this->settings["custom_markup"] );
					}
					$iner .= do_shortcode( $custom_markup );
				}
				$elem = str_ireplace( '%wpb_element_content%', $iner, $elem );
				$output = $elem;

				return $output;
			}

			public function getTabTemplate() {
				return '<div class="wpb_template">' . do_shortcode( '[vc_mad_single_tab title="Tab" tab_id="" icon_type="" icon=""][/vc_mad_single_tab]' ) . '</div>';
			}

			public function setCustomTabId( $content ) {
				return preg_replace( '/tab\_id\=\"([^\"]+)\"/', 'tab_id="$1-' . time() . '"', $content );
			}

		}

	}

	if ( function_exists('vc_path_dir') ) {
		require_once vc_path_dir('SHORTCODES_DIR', 'vc-column.php');
	}

	if ( class_exists('WPBakeryShortCode_VC_Column') ) {

		class WPBakeryShortCode_vc_mad_single_tab extends WPBakeryShortCode_VC_Column {

			protected $controls_css_settings = 'tc vc_control-container';
			protected $controls_list = array('add', 'edit', 'clone', 'delete');

			public function __construct( $settings ) {
				parent::__construct( $settings );

			}
			public function customAdminBlockParams() {
				return ' id="tab-' . $this->atts['tab_id'] . '"';
			}
			public function mainHtmlBlockParams( $width, $i ) {
				return 'data-element_type="' . $this->settings["base"] . '" class="wpb_' . $this->settings['base'] . ' wpb_sortable wpb_content_holder"' . $this->customAdminBlockParams();
			}
			public function containerHtmlBlockParams( $width, $i ) {
				return 'class="wpb_column_container vc_container_for_children"';
			}
			public function getColumnControls( $controls, $extended_css = '' ) {
				return $this->getColumnControlsModular($extended_css);
			}

		}
	}

}