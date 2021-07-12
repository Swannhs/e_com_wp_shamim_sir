<?php
/**
 * Gatsby functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @since Gatsby 1.0
 */

/**
 * Include the product registration
 */
require_once( get_template_directory() . '/includes/class-product-registration.php' );

/**
 * Include the main Gatsby class.
 */
require_once( get_template_directory() . '/includes/class-gatsby.php' );

function Gatsby() {
	return Gatsby::get_instance();
}
Gatsby();

if ( ! defined( 'GATSBY_ENV' ) ) {
	define( 'GATSBY_ENV', 'prod' );
}

if ( ! defined( 'GATSBY_THEME_VERSION' ) ) {
	if ( GATSBY_ENV == 'dev' ) {
		define( 'GATSBY_THEME_VERSION', rand(1, 10e3) );
	} else {
		define( 'GATSBY_THEME_VERSION', wp_get_theme( get_template() )->get('Version') );
	}
}

/* 	Basic Settings
/* ---------------------------------------------------------------------- */

require_once( get_template_directory() . '/includes/functions.php' );

/*  Menu
/* ---------------------------------------------------------------------- */

require_once( get_template_directory() . '/includes/menu.php' );

/*  Add Widgets
/* ---------------------------------------------------------------------- */

require_once( get_template_directory() . '/includes/widgets/abstract-widget.php' );
require_once( get_template_directory() . '/includes/widgets.php' );

/*  Page Title
/* ---------------------------------------------------------------------- */
require_once( get_template_directory() . '/includes/page-title/config.php' );

/*  Metaboxes
/* ---------------------------------------------------------------------- */
require_once( get_template_directory() . '/includes/metaboxes/metaboxes.php' );

/* Load Base Functions
/* ---------------------------------------------------------------------- */
require_once( get_template_directory() . '/includes/helpers/aq_resizer.php' );
require_once( get_template_directory() . '/includes/helpers/theme-helper.php' );
require_once( get_template_directory() . '/includes/helpers/post-format-helper.php' );
require_once( get_template_directory() . '/includes/classes/register-page.class.php' );
require_once( get_template_directory() . '/includes/classes/register-admin-user-profile.class.php' );
require_once( get_template_directory() . '/includes/functions-base.php' );

/*  Load Functions Files
/* ---------------------------------------------------------------------- */
require_once( get_template_directory() . '/includes/functions-core.php' );
require_once( get_template_directory() . '/includes/functions-post-like.php' );

/*  Metadata
/* ---------------------------------------------------------------------- */
require_once( get_template_directory() . '/includes/functions-metadata.php' );

/*  Include Config WooCommerce
/* ---------------------------------------------------------------------- */

if ( class_exists('WooCommerce') ) {
	require_once( get_template_directory() . '/config-woocommerce/config.php' );
}

/*  Include Config Composer
/* ---------------------------------------------------------------------- */

if ( class_exists('Vc_Manager') ) {
	require_once( get_template_directory() . '/config-composer/config.php' );
}

/*  Theme support & Theme setup
/* ---------------------------------------------------------------------- */

if ( ! function_exists( 'gatsby_setup' ) ) :
	function gatsby_setup() {

		$GLOBALS['content_width'] = apply_filters( 'gatsby_content_width', 1140 );

		// Load theme textdomain
		load_theme_textdomain( 'gatsby', get_template_directory()  . '/lang' );
		load_child_theme_textdomain( 'gatsby', get_stylesheet_directory() . '/lang' );

		/**
		 * Gatsby admin options
		 */

		require_once( get_template_directory() . '/admin/framework/admin.php');
		global $pagenow;

		// Post Formats Support
		add_theme_support('post-formats', array( 'gallery', 'quote', 'video', 'audio', 'link' ));

		// Post Thumbnails Support
		add_theme_support('post-thumbnails');
		set_post_thumbnail_size( 570, 315, true );

		// Add default posts and comments RSS feed links to head
		add_theme_support('automatic-feed-links');

		add_theme_support('title-tag');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menu( 'primary', 'Primary Menu' );
		register_nav_menu( 'footer', 'Footer Menu' );
		register_nav_menu( 'topbar', 'Topbar Menu' );
		register_nav_menu( 'onepage', 'Onepage Menu' );

		if ( is_admin() && 'themes.php' == $pagenow && isset($_GET['activated']) ) {
			do_action('gatsby_backend_theme_activation');
			if ( class_exists('ReduxFramework') ) {
				wp_redirect(admin_url('themes.php?page=gatsby_settings'));
			}
		}

		remove_action('wp_head', 'rsd_link');

		// This theme uses its own gallery styles.
		add_filter( 'use_default_gallery_style', '__return_false' );

	}
endif;
add_action( 'after_setup_theme', 'gatsby_setup', 100 );

/*  Layouts
/* ---------------------------------------------------------------------- */
require_once( get_template_directory() . '/includes/layout.php' );

/*  Load hooks
/* ---------------------------------------------------------------------- */
if ( !is_admin() ) {
	require_once( get_template_directory() . '/includes/templates-hooks.php' );
}

/*  Custom template tags for this theme.
/* ---------------------------------------------------------------------- */
require_once( get_template_directory() . '/includes/template-tags.php' );

/*  Include Plugins
/* ---------------------------------------------------------------------- */
require_once( get_template_directory() . '/admin/plugin-bundle.php' );
require_once( get_template_directory() . '/config-plugins/config.php');

/*  Include Config Widget Meta Box
/* ---------------------------------------------------------------------- */
require_once( get_template_directory() . '/config-widget-meta-box/config.php' );

/*  Include Config DHVC Forms
/* ---------------------------------------------------------------------- */

if ( defined('WPCF7_VERSION') ) {
	require_once( get_template_directory() . '/config-contact-form-7/config.php' );
}

/*  Include Config WPML
/* ---------------------------------------------------------------------- */

if ( defined('ICL_SITEPRESS_VERSION') && defined('ICL_LANGUAGE_CODE') ) {
	require_once( get_template_directory() . '/config-wpml/config.php' );
}

/*  Get user name
/* ---------------------------------------------------------------------- */

if ( !function_exists("gatsby_get_user_name") ) {

	function gatsby_get_user_name($current_user) {

		if ( !$current_user->user_firstname && !$current_user->user_lastname ) {

			if ( gatsby_is_shop_installed() ) {

				$firstname_billing = get_user_meta( $current_user->ID, "billing_first_name", true );
				$lastname_billing = get_user_meta( $current_user->ID, "billing_last_name", true );

				if ( !$firstname_billing && !$lastname_billing ) {
					$user_name = $current_user->user_nicename;
				} else {
					$user_name = $firstname_billing . ' ' . $lastname_billing;
				}

			} else {
				$user_name = $current_user->user_nicename;
			}

		} else {
			$user_name = $current_user->user_firstname . ' ' . $current_user->user_lastname;
		}

		return $user_name;
	}

}

function gatsby_wpcodex_add_excerpt_support_for_pages() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'gatsby_wpcodex_add_excerpt_support_for_pages' );