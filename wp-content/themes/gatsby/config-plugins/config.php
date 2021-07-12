<?php

if (!class_exists('Gatsby_Plugins_Config')) {

	class Gatsby_Plugins_Config {

		public $plugin_classes = array(
			'Gatsby_VC_Table',
			'Gatsby_Wishlist_Mod',
			'Gatsby_Compare_Mod',
		);

		public $options;
		public $paths = array();
		public static $pathes = array();

		protected function path($name, $file = '') {
			return $this->paths[$name] . (strlen($file) > 0 ? '/' . preg_replace('/^\//', '', $file) : '');
		}

		function __construct() {

			add_action('init', array($this, 'init'));

		}

		public function init() {

			$dir = get_template_directory() . '/config-plugins';

			$this->paths = array(
				'BASE_URI' => get_template_directory_uri() . '/config-plugins/plugins/',
				'PLUGINS' => $dir . '/plugins/',
				'WIDGETS_DIR' => $dir . '/widgets/'
			);

			self::$pathes = $this->paths;

			require($this->paths['PLUGINS'] . 'compare/config.php');
			require($this->paths['PLUGINS'] . 'wishlist/config.php');
			require($this->paths['PLUGINS'] . 'table/config.php');

			foreach ( $this->plugin_classes as $plugin ) {
				if ( class_exists($plugin) ) {
					new $plugin;
				}
			}

			$this->other_vendors_plugins();

		}

		public function other_vendors_plugins() {

			if ( defined('wcv_plugin_dir') ) {
				remove_action( 'woocommerce_after_shop_loop_item', array('WCV_Vendor_Shop', 'template_loop_sold_by'), 9 );
				add_action( 'woocommerce_after_shop_loop_item_title', array('WCV_Vendor_Shop', 'template_loop_sold_by'), 9);
			}

		}


	}

	new Gatsby_Plugins_Config();
}