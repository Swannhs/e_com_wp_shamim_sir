<?php

/**
 * Gatsby Theme Options
 */
require_once( get_template_directory() . '/admin/framework/functions.php' );

// Gatsby Theme Settings Options
require_once( get_template_directory() . '/admin/framework/theme-options/settings.php' );

require_once( get_template_directory() . '/admin/framework/theme-options/save-settings.php' );

if ( get_option('gatsby_init_theme', '0') != '1' || !class_exists('ReduxFramework') ) { gatsby_check_theme_options(); }
