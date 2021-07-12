<?php

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

/**
 * The main theme class.
 */
class Gatsby {

	/**
	 * The template directory URL.
	 *
	 * @static
	 * @access public
	 * @var string
	 */
	public static $template_dir_url = '';

	/**
	 * The one, true instance of the Gatsby object.
	 *
	 * @static
	 * @access public
	 * @var null|object
	 */
	public static $instance = null;

	/**
	 * The theme version.
	 *
	 * @static
	 * @access public
	 * @var string
	 */
	public static $version = '1.0';

	/**
	 * Determine if we're currently upgrading/migration options.
	 *
	 * @static
	 * @access public
	 * @var bool
	 */
	public static $is_updating  = false;

	/**
	 * Bundled Plugins.
	 *
	 * @static
	 * @access public
	 * @var array
	 */
	public static $bundled_plugins = array();

	/**
	 * Gatsby_Product_registration
	 *
	 * @access public
	 * @var object Gatsby_Product_registration.
	 */
	public $registration;

	/**
	 * Access the single instance of this class.
	 *
	 * @return Gatsby
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new Gatsby();
		}
		return self::$instance;
	}

	/**
	 * The class constructor
	 */
	private function __construct() {

		// Initialize bundled plugins array.
		self::$bundled_plugins = array(
			'revolution' => array( 'slug' => 'revslider', 'name' => esc_html__('Slider Revolution', 'gatsby'), 'version' => '6.2.19' ),
			'content_types' => array( 'slug' => 'gatsby-content-types', 'name' => esc_html__('Gatsby Content Types', 'gatsby'), 'version' => '1.0.1' ),
			'easy_tables' => array( 'slug' => 'easy-tables-vc', 'name' => esc_html__('Easy Tables (vc)', 'gatsby'), 'version' => '1.0.10' ),
			'composer' => array( 'slug' => 'js_composer', 'name' => esc_html__('WPBakery Visual Composer', 'gatsby'), 'version' => '6.2.0' ),
			'wpml' => array( 'slug' => 'sitepress-multilingual-cms', 'name' => esc_html__('WPML Multilingual CMS', 'gatsby'), 'version' => '3.6.3' ),
		);

		// Instantiate secondary classes.
		$this->registration = new Gatsby_Product_Registration();
	}

	/**
	 * Gets the theme version.
	 *
	 * @since 5.0
	 *
	 * @return string
	 */
	public static function get_theme_version() {
		return self::$version;
	}

	/**
	 * Gets the bundled plugins.
	 *
	 * @since 5.0
	 *
	 * @return array Array of bundled plugins.
	 */
	public static function get_bundled_plugins() {
		return self::$bundled_plugins;
	}

}