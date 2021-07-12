<?php

add_action( 'redux/options/gatsby_settings/saved', 'gatsby_save_theme_settings', 10, 2 );
add_action( 'redux/options/gatsby_settings/import', 'gatsby_save_theme_settings', 10, 2 );
add_action( 'redux/options/gatsby_settings/reset', 'gatsby_save_theme_settings' );
add_action( 'redux/options/gatsby_settings/section/reset', 'gatsby_save_theme_settings' );

if ( !function_exists('gatsby_save_theme_settings') ) {

	function gatsby_save_theme_settings() {
		global $gatsby_settings, $gatsby_redux_settings;

		update_option('gatsby_init_theme', '1');

		$reduxFramework = $gatsby_redux_settings->ReduxFramework;
		$template_dir = get_template_directory();

		// Compile LESS Files
		if ( !class_exists('lessc') ) {
			require_once( $template_dir . '/admin/framework/lessphp/lessc.inc.php' );
		}

		// config file
		ob_start();
		include $template_dir . '/admin/framework/theme-options/config-less.php';
		$_config_css = ob_get_clean();

		$filename = $template_dir . '/less/config.less';

		if ( file_exists($filename) ) {
			@unlink($filename);
		}
		$reduxFramework->filesystem->execute('put_contents', $filename, array('content' => $_config_css));

		try {

			ob_start();
			$less = new lessc;
			echo $less->compileFile( $template_dir . '/less/skin.less' );

			if ( isset($gatsby_settings['css-code']) ) {
				echo sprintf('%s', $gatsby_settings['css-code']);
			}

			$_config_css = ob_get_clean();

			$prefix_name = 'skin_' . get_current_blog_id() . '.css';
			$wp_upload_dir  = wp_upload_dir();
			$stylesheet_dynamic_dir = $wp_upload_dir['basedir'] . '/dynamic_gatsby_dir';
			$stylesheet_dynamic_dir = str_replace('\\', '/', $stylesheet_dynamic_dir);
			gatsby_backend_create_folder($stylesheet_dynamic_dir);

			$filename = trailingslashit($stylesheet_dynamic_dir) . $prefix_name;
			$create = $reduxFramework->filesystem->execute( 'put_contents', $filename, array( 'content' => $_config_css) );

			if ( $create === true ) {
				update_option( 'gatsby_stylesheet_version' . $prefix_name, uniqid() );
			}

		} catch (Exception $e) {}

	}

}


/*  Create folder
/* ---------------------------------------------------------------------- */

if ( !function_exists('gatsby_backend_create_folder') ) {
	function gatsby_backend_create_folder(&$folder, $addindex = true) {
		if ( is_dir($folder) && $addindex == false ) {
			return true;
		}
		$created = wp_mkdir_p(trailingslashit($folder));

		if ( $addindex == false ) return $created;

		return $created;
	}
}

