<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme Gatsby for publication on ThemeForest
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */

require_once get_template_directory() . '/admin/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'gatsby_register_required_plugins' );

if (!function_exists('gatsby_added_admin_action')) {

	function gatsby_added_admin_action() {
		add_action( 'admin_enqueue_scripts', 'gatsby_added_plugin_style' );
	}

	function gatsby_added_plugin_style() {
		wp_enqueue_style( 'gatsby_admin_plugins', get_theme_file_uri('css/admin-plugin.css'), array() );
	}

	add_action( 'load-plugins.php', 'gatsby_added_admin_action', 1 );

}
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function gatsby_register_required_plugins() {

	// disable visual composer automatic update
	global $vc_manager;
	if ( $vc_manager ) {

		$vc_updater = $vc_manager->updater();

		if ( $vc_updater ) {
			remove_filter('upgrader_pre_download', array(&$vc_updater, 'upgradeFilterFromEnvato'));
			remove_filter('upgrader_pre_download', array(&$vc_updater, 'preUpgradeFilter'));
			remove_action('wp_ajax_nopriv_vc_check_license_key', array(&$vc_updater, 'checkLicenseKeyFromRemote'));
		}
	}

	$is_plugins_page = false;
	if ( ( isset( $_GET['page'] ) && 'gatsby-plugins' === $_GET['page'] ) ||
		( isset( $_GET['page'] ) && 'install-required-plugins' === $_GET['page'] ) ||
		( isset( $_SERVER['HTTP_REFERER'] ) && false !== strpos( $_SERVER['HTTP_REFERER'], 'HTTP_REFERER' ) )
	) {
		$is_plugins_page = true;
	}

	$bundled_plugins = Gatsby()->get_bundled_plugins();

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		array(
			'name'     => esc_html__('Redux Framework', 'gatsby'),
			'slug'     => 'redux-framework',
			'required' => true,
			'image_url' => get_theme_file_uri('images/plugins/redux-framework.png')
		),

		array(
			'name'     => esc_html__('WooCommerce', 'gatsby'),
			'slug'     => 'woocommerce',
			'required' => false,
			'image_url' => get_theme_file_uri('images/plugins/woocommerce.png')
		),
		array(
			'name'     => esc_html__('Smash Balloon Instagram Feed', 'gatsby' ),
			'slug'     => 'instagram-feed',
			'required' => false
		),

		array(
			'name'     => esc_html__('Yith WooCommerce Compare', 'gatsby'),
			'slug'     => 'yith-woocommerce-compare',
			'required' => false,
			'image_url' => get_theme_file_uri('images/plugins/yith_compare.png')
		),

		array(
			'name'     => esc_html__('Yith WooCommerce Wishlist', 'gatsby'),
			'slug'     => 'yith-woocommerce-wishlist',
			'required' => false,
			'image_url' => get_theme_file_uri('images/plugins/yith_wishlist.png')
		),

		array(
			'name'     => esc_html__('Contact Form 7', 'gatsby'),
			'slug'     => 'contact-form-7',
			'required' => false,
			'image_url' => get_theme_file_uri('images/plugins/contact_form_7.png')
		),

//		array(
//			'name' => esc_html__('MailPoet Newsletters', 'gatsby'),
//			'slug' => 'wysija-newsletters',
//			'required' => false,
//			'image_url' => get_theme_file_uri('images/plugins/mailpoet_newsletter.png')
//		),

		array(
			'name' => esc_html__('Latest Tweets Widget', 'gatsby'),
			'slug' => 'latest-tweets-widget',
			'required' => false,
			'image_url' => get_theme_file_uri('images/plugins/latest_tweets.png')
		),

		// This is an example of how to include a plugin from the WordPress Plugin Repository.

		array(
			'name'               => $bundled_plugins['revolution']['name'],
			'slug'               => $bundled_plugins['revolution']['slug'],
			'source'             => ( $is_plugins_page ) ? 'http://velikorodnov.com/wordpress/sample-data/gatsby/pluginus15/revslider.zip' : '',
			'required'           => false,
			'version'            => $bundled_plugins['revolution']['version'],
			'force_activation'   => false,
			'force_deactivation' => false,
			'image_url' 		 => get_theme_file_uri('images/plugins/revolution_slider.png')
		),

		array(
			'name'               => $bundled_plugins['content_types']['name'],
			'slug'               => $bundled_plugins['content_types']['slug'],
			'source'             => 'http://velikorodnov.com/wordpress/sample-data/gatsby/pluginus15/gatsby-content-types.zip',
			'required'           => true,
			'version'            => $bundled_plugins['content_types']['version'],
			'force_activation'   => false,
			'force_deactivation' => false,
			'image_url'			 => get_theme_file_uri('images/plugins/content_types.png')
		),

		array(
			'name'               => $bundled_plugins['easy_tables']['name'],
			'slug'               => $bundled_plugins['easy_tables']['slug'],
			'source'             => ( $is_plugins_page ) ? 'http://velikorodnov.com/wordpress/sample-data/pluginus/easy-tables-vc.zip' : '',
			'required'           => false,
			'version'            => $bundled_plugins['easy_tables']['version'],
			'force_activation'   => false,
			'force_deactivation' => false,
			'image_url' 		 => get_theme_file_uri('images/plugins/easy_tables.png')
		),


		array(
			'name'               => $bundled_plugins['composer']['name'],
			'slug'               => $bundled_plugins['composer']['slug'],
			'source'             => ( $is_plugins_page ) ? 'http://velikorodnov.com/wordpress/sample-data/pluginusan/js_composer.zip' : '',
			'required'           => true,
			'version'            => $bundled_plugins['composer']['version'],
			'force_activation'   => false,
			'force_deactivation' => false,
			'image_url' 		 => get_theme_file_uri('images/plugins/visual_composer.png')
		),

// 		array(
//			'name'               => $bundled_plugins['wpml']['name'],
//			'slug'               => $bundled_plugins['wpml']['slug'],
//			'source'             => 'http://velikorodnov.com/wordpress/sample-data/pluginus/sitepress-multilingual-cms.zip',
//			'required'           => false,
//			'version'            => $bundled_plugins['wpml']['version'],
//			'force_activation'   => false,
//			'force_deactivation' => false,
//			'external_url'       => ''
//		)

	);

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'id'           => 'gatsby',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'install-required-plugins',
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                   // Automatically activate plugins after installation or not.
		'message'      => ''
	);

	tgmpa( $plugins, $config );

}