<?php

/*  Base Function Class
/* ---------------------------------------------------------------------- */

if (!class_exists('Gatsby_Base')) {

	class Gatsby_Base {

		public $action_search = 'gatsby_action_search';
		public $action_post_share = 'gatsby_action_post_share';
		public $paths = array();
		public $directory_uri;
		private static $_instance;
		protected $used_fonts = array();
		protected $fontlist = array();

		/* 	Instance
		/* ---------------------------------------------------------------------- */

		public static function getInstance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		function __construct() {

			$this->directory_uri = get_template_directory_uri() . '/css';

			add_action( 'template_redirect', array($this, 'predefined_config') );
			add_action( 'wp_enqueue_scripts', array( &$this, 'enqueue_styles_scripts' ) );
			add_action( 'admin_enqueue_scripts', array( &$this, 'admin_enqueue_styles_scripts' ), 100 );
			add_filter( 'body_class', array(&$this, 'body_class'), 5 );

			new gatsby_admin_user_profile();

			/*  Init Classes
			/* --------------------------------------------- */
			new gatsby_post_type();

			/*  Load Textdomain
			/* --------------------------------------------- */
			$this->load_textdomain();
		}

		/* 	Initialization
		/* ---------------------------------------------------------------------- */

		function body_class($classes) {
			global $gatsby_config;

			if ( isset($gatsby_config['header_type']) ) {
				$classes[] = 'gt-header-' . str_replace('gt-', '', $gatsby_config['header_type']);
			}

			return $classes;
		}

		public function admin_enqueue_styles_scripts() {
			$this->admin_enqueue_styles();
			$this->admin_enqueue_scripts();
		}

		public function enqueue_styles_scripts() {

			global $gatsby_settings;
			$scripts_deps = array( 'jquery' );

			/* Include Libs & Plugins */

			wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/libs/modernizr.min.js', null, GATSBY_THEME_VERSION, false );
			wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/js/plugins/fancybox/jquery.fancybox.pack.js', $scripts_deps, GATSBY_THEME_VERSION, true);
			wp_enqueue_script( 'fancybox_thumbs', get_template_directory_uri() . '/js/plugins/fancybox/helpers/jquery.fancybox-thumbs.js', $scripts_deps, GATSBY_THEME_VERSION, true);
			wp_enqueue_script( 'fancybox_buttons', get_template_directory_uri() . '/js/plugins/fancybox/helpers/jquery.fancybox-buttons.js', $scripts_deps, GATSBY_THEME_VERSION, true);
			wp_enqueue_script( 'fancybox_media', get_template_directory_uri() . '/js/plugins/fancybox/helpers/jquery.fancybox-media.js', $scripts_deps, GATSBY_THEME_VERSION, true);
			wp_enqueue_script( 'arcticmodal', get_template_directory_uri() . '/js/plugins/arcticmodal/jquery.arcticmodal-0.3.min.js', $scripts_deps, GATSBY_THEME_VERSION, true);

			wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/plugins/isotope.pkgd.min.js', $scripts_deps, '', true);
			wp_enqueue_script( 'packery', get_template_directory_uri() . '/js/plugins/packery-mode.pkgd.min.js', array('jquery', 'isotope'), GATSBY_THEME_VERSION, true);

			/* Theme files */
			wp_enqueue_script( 'gatsby_plugins', get_template_directory_uri() . '/js/gatsby.plugins' . ( WP_DEBUG ? '' : '.min' ) .'.js', $scripts_deps, GATSBY_THEME_VERSION, true );
			wp_enqueue_script( 'gatsby_core', get_template_directory_uri() . '/js/gatsby.core.js', array('jquery', 'modernizr'), GATSBY_THEME_VERSION, true );

			wp_localize_script('gatsby_core', 'gatsby_global_vars', array(
				'template_base_uri' => get_template_directory_uri() . '/',
				'site_url' => esc_url(get_home_url('/')),
				'ajax_nonce' => wp_create_nonce('ajax-nonce'),
				'ajaxurl' => admin_url('admin-ajax.php'),
				'ajax_loader_url' => get_template_directory_uri() . '/images/ajax-loader.gif',
				'rtl' => is_rtl() ? 1 : 0,
				'button_border_small' => $gatsby_settings['button-border-radius'] ? '22px' : '0',
				'like' => esc_html__( 'Like', 'gatsby' ),
				'unlike' => esc_html__( 'Unlike', 'gatsby' )
			));

			if ( isset($gatsby_settings['js-code-head']) && $gatsby_settings['js-code-head']) {
				wp_add_inline_script( 'gatsby_core', $gatsby_settings['js-code-head'] );
			}

			/* Vendor CSS */
			wp_enqueue_style( 'fancybox-buttons', get_template_directory_uri() . '/js/plugins/fancybox/helpers/jquery.fancybox-buttons.css' );
			wp_enqueue_style( 'fancybox-thumbs', get_template_directory_uri() . '/js/plugins/fancybox/helpers/jquery.fancybox-thumbs.css' );
			wp_enqueue_style( 'fancybox', get_template_directory_uri() . '/js/plugins/fancybox/jquery.fancybox.css' );
			wp_enqueue_style( 'arcticmodal', get_template_directory_uri() . '/js/plugins/arcticmodal/jquery.arcticmodal-0.3.css' );

			/* Theme CSS */
			wp_enqueue_style( 'gatsby-linearicons', get_template_directory_uri() . '/css/icon-font.min.css', array(), null );
			wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.css', array(), null );
			wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), null );
			wp_enqueue_style( 'linear', get_template_directory_uri() . '/css/linear.css', array(), null );
			wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), null );

			wp_enqueue_style( 'gatsby-style', get_stylesheet_uri(), array(), null );

			if ( class_exists('WooCommerce') ) {
				wp_enqueue_style( 'gatsby-woocommerce-mod', get_template_directory_uri() . '/config-woocommerce/assets/css/woocommerce-mod' . (WP_DEBUG ? '' : '.min') . '.css' );
			}

			// Skin Styles
			wp_deregister_style( 'gatsby-skin' );
			$prefix_name = 'skin_' . gastby_get_blog_id() . '.css';
			$wp_upload_dir = wp_upload_dir();
			$stylesheet_dynamic_dir = $wp_upload_dir['basedir'] . '/dynamic_gatsby_dir';
			$stylesheet_dynamic_dir = str_replace('\\', '/', $stylesheet_dynamic_dir);
			$filename = trailingslashit($stylesheet_dynamic_dir) . $prefix_name;

			$version = get_option( 'gatsby_stylesheet_version' . $prefix_name );
			if ( empty($version) ) $version = '1';

			if ( file_exists($filename) ) {
				if ( is_ssl() ) {
					$wp_upload_dir['baseurl'] = str_replace("http://", "https://", $wp_upload_dir['baseurl']);
				}
				wp_register_style( 'gatsby-skin', $wp_upload_dir['baseurl'] . '/dynamic_gatsby_dir/' . $prefix_name, null, $version );
			} else {
				wp_register_style( 'gatsby-skin', get_template_directory_uri() . '/css/skin.css', null, $version );
			}
			wp_enqueue_style( 'gatsby-skin' );

			if ( is_rtl() ) {
				wp_enqueue_style( 'gatsby-rtl',  get_template_directory_uri() . "/css/rtl.css", array( 'gatsby-style', 'gatsby-woocommerce-mod' ), '1', 'all' );
			}

			wp_enqueue_style( 'gatsby-layout', get_template_directory_uri() . '/css/layout.css', array(), null );

			// Load Google Fonts
			$google_fonts = array();
			$fonts = array( 'body', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'menu', 'sub-menu' );
			foreach ( $fonts as $option ) {
				if ( isset($gatsby_settings[$option.'-font']['google']) && $gatsby_settings[$option.'-font']['google'] !== 'false' ) {
					$font = $gatsby_settings[$option.'-font']['font-family'];
					if ( !in_array($font, $google_fonts) ) {
						$google_fonts[] = $font;
					}
				}
			}

			$font_family = array();
			foreach ( $google_fonts as $font ) {
				$font_family[] .= $font . ':300,300italic,400,400italic,500,600,600italic,700,700italic,800,800italic%7C';
			}

			if ( $font_family ) {
				$charsets = '';

				if ( isset($gatsby_settings['select-google-charset']) && $gatsby_settings['select-google-charset'] && isset($gatsby_settings['google-charsets']) && $gatsby_settings['google-charsets']) {
					$i = 0;
					foreach ( $gatsby_settings['google-charsets'] as $charset ) {
						if ( $i == 0 ) {
							$charsets .= $charset;
						} else {
							$charsets .= ",".$charset;
						}
						$i++;
					}
				}

				$fonts_url = add_query_arg( array(
					'family' => urlencode( implode('|', $font_family) ),
					'subset' => urlencode( $charsets )
				), '//fonts.googleapis.com/css' );

				wp_enqueue_style( 'gatsby-google-fonts', esc_url_raw($fonts_url) . $charsets );
			}

			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}

		}

		/* 	Enqueue Admin Styles
		/* ---------------------------------------------------------------------- */

		public function admin_enqueue_styles() {
			wp_enqueue_style( 'gatsby_admin', $this->directory_uri . '/admin.css', false);
		}

		/*  Enqueue Admin Scripts
		/* ---------------------------------------------------------------------- */

		public function admin_enqueue_scripts() {
			if ( function_exists('add_thickbox') )
				add_thickbox();

			wp_enqueue_media();
			wp_enqueue_script( 'gatsby_admin', get_template_directory_uri() . '/js/admin.js' );
		}

		/* 	Load Textdomain
		/* ---------------------------------------------------------------------- */

		public function load_textdomain () {
			load_theme_textdomain( 'gatsby', get_template_directory()  . '/lang' );
		}

		/*	Check page wrapper
		/* ---------------------------------------------------------------------- */

		public function check_page_wrapper() {
			global $gatsby_config, $gatsby_settings;

			$post_id = gatsby_post_id();

			$page_wrapper = $gatsby_settings['wrapper'];
			$post_meta_page_wrapper = trim(mad_meta( 'gatsby_wrapper', '', $post_id ));

			if ( $post_meta_page_wrapper ) {
				$page_wrapper = $post_meta_page_wrapper;
			}

			if ( !$page_wrapper ) {
				$page_wrapper = 'gt-wide-layout-type';
			}

			$coming_soon = absint( mad_meta( 'gatsby_coming_soon', '', $post_id ) );
			$type_coming_soon = mad_meta( 'gatsby_type_coming_soon', '', $post_id );

			if ( $coming_soon ) {
				$page_wrapper = "gt-fullscreen-layout-type gt-dim-section {$type_coming_soon}";
			}

			$gatsby_config['page_wrapper'] = $page_wrapper;

		}

		/*	Check page layout
		/* ---------------------------------------------------------------------- */

		public function check_page_layout () {
			global $gatsby_config, $gatsby_settings;

			$result = false;
			$sidebar_position = 'page-layout';

			$post_id = gatsby_post_id();

			if ( is_page() || is_search() || is_attachment() ) { $sidebar_position = 'page-layout'; }

			if ( is_archive() ) { $sidebar_position = 'post-archive-layout'; }

			if ( is_single() ) { $sidebar_position = 'post-single-layout'; }

			if ( is_singular() ) {
				$result = trim(mad_meta( 'gatsby_page_sidebar_position', '', $post_id ));
			}

			if ( is_singular('portfolio') ) { $result = 'gt-no-sidebar'; }

			if ( is_404() ) { $result = 'gt-no-sidebar'; }

			$coming_soon = absint( mad_meta( 'gatsby_coming_soon', '', $post_id ) );

			if ( $coming_soon ) { $result = 'gt-no-sidebar'; }

			if ( is_post_type_archive('testimonials') || is_singular('testimonials') || is_tax('testimonials_category') ) {
				$result = 'gt-no-sidebar';
			}
			if ( is_post_type_archive('team-members') || is_singular('team-members') || is_tax('team_category') ) {
				$result = 'gt-no-sidebar';
			}

			if ( gatsby_is_shop_installed() ) {

				if ( gastby_is_realy_woocommerce_page(false) || gatsby_is_shop() || gatsby_is_product_category() || gatsby_is_product_tax() || gatsby_is_product_tax() ) {

					if ( gastby_is_realy_woocommerce_page(false) ) {

						$result = 'gt-no-sidebar';

					} elseif ( gatsby_is_product_category() ) {

						$result = gatsby_get_meta_value('sidebar_position');

						if ( empty($result) ) {
							$result = $gatsby_settings['product-archive-layout'];
						}

					} else {
						$result = $gatsby_settings['product-archive-layout'];
					}
				}

				if ( gatsby_is_product() ) {
					$result_sidebar_position = trim(mad_meta( 'gatsby_page_sidebar_position', '', $post_id ));

					if ( empty($result_sidebar_position) ) {
						$result = $gatsby_settings['product-single-layout'];
					} else {
						$result = $result_sidebar_position;
					}
				}

			}

			if ( !$result ) {
				$result = $gatsby_settings[$sidebar_position];
			}

			if ( !$result ) {
				$result = 'gt-right-sidebar';
			}

			if ( $result ) {
				$gatsby_config['sidebar_position'] = $result;
			}

		}

		public function check_header_classes() {
			global $gatsby_config, $gatsby_settings;

			$result = array();
			$post_id = gatsby_post_id();

			if ( gastby_is_realy_woocommerce_page() ) {
				$header_type = $gatsby_settings['shop-header-type'];
			} else {
				$header_type = $gatsby_settings['header-type'];
			}

			$post_meta_header_type = trim(mad_meta( 'gatsby_header_type', '', $post_id ));
			$coming_soon = absint( mad_meta( 'gatsby_coming_soon', '', $post_id ) );

			if ( $post_meta_header_type ) {
				$header_type = $post_meta_header_type;
			}

			if ( $coming_soon ) { $header_type = 'gt-coming-soon'; }

			if ( !$header_type ) $header_type = 'gt-type-1';

			$result['header_type'] = $header_type;

			if ( $header_type ) {

				switch( $result['header_type'] ) {
					case 'gt-type-1':
						$result[] = 'gt-dark';
						break;
					case 'gt-type-2':
						$result[] = 'gt-fixed';
						$result[] = 'gt-grey';
						break;
					case 'gt-type-3':
						$result[] = 'gt-transparent';
						break;
					case 'gt-type-4':
					case 'gt-type-5':
						$result[] = 'gt-light';
						break;
					case 'gt-type-6':
						$result[] = 'gt-light';
						break;
					case 'gt-type-7':
					case 'gt-type-8':
					case 'gt-type-9':
						$result[] = 'gt-transparent';
						break;
				}
			}

			$gatsby_config['header_classes'] = implode( ' ', array_values($result) );
			$gatsby_config['header_type'] = $result['header_type'];
		}

		public function check_footer_classes() {
			global $gatsby_config;
			$classes = array();

			$result = Gatsby_Widgets_Meta_Box::get_page_settings(gatsby_post_id());

			if ( $result['footer_row_middle_show'] ) {
				$classes[] = 'gt-type-1';
			} else {
				$classes[] = 'gt-type-3';
			}

			$footer_bg_color = mad_meta('gatsby_footer_bg_color', '', gatsby_post_id());

			if ( !empty($footer_bg_color) ) {
				$classes[] = 'gt-has-bg-color';
			}

			$gatsby_config['footer_classes'] = implode( ' ', array_values($classes) );
		}

		public function check_page_content_classes() {
			global $gatsby_config;

			$result = array();
			$result[] = 'gt-page-content-wrap';
			$result[] = $gatsby_config['sidebar_position'];

			$coming_soon = absint( mad_meta( 'gatsby_coming_soon' ) );

			if ( $coming_soon ) {
				$result[] = 'gt-coming-soon-section';
			}

			$gatsby_config['page_content_classes'] = implode( ' ', array_filter(array_values($result)) );
		}

		public function predefined_config() {
			$this->check_page_wrapper();
			$this->check_header_classes();
			$this->check_page_layout();
			$this->check_page_content_classes();
			$this->check_footer_classes();
		}

		/* 	Instance
		/* ---------------------------------------------------------------------- */

		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

	}

	if ( ! function_exists('gatsby_base') ) {

		function gatsby_base() {
			// Load required classes and functions
			return Gatsby_Base::getInstance();
		}

		gatsby_base();

	}

}