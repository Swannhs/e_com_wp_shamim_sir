<?php

if ( !class_exists('Gatsby_VC_Table') ) {

	class Gatsby_VC_Table extends Gatsby_Plugins_Config {

		function __construct() {

			if ( !defined( 'WPB_VC_TABLE_MANAGER_VERSION' ) ) return;

			$this->add_hooks();
		}

		public function add_hooks() {
			add_action('wp_enqueue_scripts', array(&$this, 'enqueue_styles_scripts'));
		}

		public function enqueue_styles_scripts() {
			$frontend_css = self::$pathes['BASE_URI'] . 'table/css/vc-mod-table.css';
			wp_enqueue_style( 'gatsby-vc-table', $frontend_css );
		}

	}

}