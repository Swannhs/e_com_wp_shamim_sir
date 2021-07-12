<?php

if (!class_exists('Gatsby_WooCommerce_Config')) {

	class Gatsby_WooCommerce_Config {

		public $action_quick_view = 'gatsby_action_add_product_popup';
		public $paths = array();
		public static $pathes = array();

		public function path($name, $file = '') {
			return $this->paths[$name] . (strlen($file) > 0 ? '/' . preg_replace('/^\//', '', $file) : '');
		}

		public function assetUrl($file) {
			return $this->paths['BASE_URI'] . $this->path('ASSETS_DIR_NAME', $file);
		}

		function __construct() {

			// Woocommerce support
			add_theme_support('woocommerce');

			add_theme_support('wc-product-gallery-slider');
			add_theme_support('wc-product-gallery-lightbox');
			add_theme_support('wc-product-gallery-zoom');

			$dir = get_template_directory() . '/config-woocommerce';

			define( 'Gatsby_Woo_Config', true );

			$this->paths = array(
				'PHP' => $dir . '/php/',
				'TEMPLATES' => $dir . '/templates/',
				'ASSETS_DIR_NAME' => 'assets',
				'WIDGETS_DIR' => $dir . '/widgets/',
				'BASE_URI' => get_template_directory_uri() . '/config-woocommerce/'
			);

			self::$pathes = $this->paths;

			include( $this->paths['PHP'] . 'functions.php' );
			include( $this->paths['PHP'] . 'ordering.class.php' );
			include( $this->paths['PHP'] . 'new-badge.class.php' );
			include( $this->paths['PHP'] . 'common-tab.class.php' );
			include( $this->paths['PHP'] . 'quick-popups.class.php' );
			include( $this->paths['PHP'] . 'dropdown-shopcart.class.php' );

			add_action('woocommerce_init', array($this, 'init'));

			add_action('admin_init', array(&$this, 'admin_init'));
			add_action('wp_enqueue_scripts', array(&$this, 'add_enqueue_scripts'));

			include( $this->paths['PHP'] . 'currency-switcher.class.php' );
		}

		public function init() {
			$this->global_config();
			$this->remove_actions();
			$this->add_actions();
			$this->add_filters();
		}

		public function admin_init() {
			add_filter( "manage_product_posts_columns", array(&$this, "manage_columns") );
		}

		public function global_config() {

		}

		public function add_filters() {

			if ( defined( 'WOOCOMMERCE_VERSION' ) ) {
				if ( version_compare( WOOCOMMERCE_VERSION, "2.1" ) >= 0 ) {
					add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
				} else {
					define( 'WOOCOMMERCE_USE_CSS', false );
				}
			}

			add_filter('woocommerce_page_title', array($this, 'woocommerce_page_title'));

			add_filter('woocommerce_general_settings', array(&$this, 'woocommerce_general_settings_filter'));
			add_filter('woocommerce_page_settings', array(&$this, 'woocommerce_general_settings_filter'));
			add_filter('woocommerce_catalog_settings', array(&$this, 'woocommerce_general_settings_filter'));
			add_filter('woocommerce_inventory_settings', array(&$this, 'woocommerce_general_settings_filter'));
			add_filter('woocommerce_shipping_settings', array(&$this, 'woocommerce_general_settings_filter'));
			add_filter('woocommerce_tax_settings', array(&$this, 'woocommerce_general_settings_filter'));
			add_filter('woocommerce_product_settings', array(&$this, 'woocommerce_general_settings_filter'));

			add_filter('woocommerce_upsell_display_args', array($this, 'upsell_display_args'));
			add_filter('woocommerce_cross_sells_total', array($this, 'cross_sells_total'));
			add_filter('loop_shop_columns', array(&$this, 'woocommerce_loop_columns'));
			add_filter('loop_shop_per_page', 'gatsby_woocommerce_product_count');
		}

		public function remove_actions() {

			remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
			remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);

			remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

			remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open');
			remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail');
			remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title');
			remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
			remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
			remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
			remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

			remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
			remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );

			remove_action( 'woocommerce_before_subcategory', 'woocommerce_template_loop_category_link_open', 10 );
			remove_action( 'woocommerce_after_subcategory', 'woocommerce_template_loop_category_link_close', 10 );

			global $gatsby_settings;

			if ( !$gatsby_settings['product-short-description'] ) {
				remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
			}


		}

		public function add_actions() {

			/**
			 * @see woocommerce_breadcrumb()
			 */

			add_action('gatsby-after-product-image', array($this, 'quick_view_output'), 9);
			add_action('gatsby-after-product-image', 'woocommerce_template_loop_add_to_cart', 12);

			add_action('woocommerce_before_single_product', array($this, 'woocommerce_breadcrumb'), 20);
			add_action('woocommerce_before_checkout_form', array($this, 'woocommerce_checkout_form'), 1);

			/* Archive Hooks */
			add_action('woocommerce_archive_description', array(&$this, 'woocommerce_ordering_products'));

			/* Content Product Hooks */
			add_action('woocommerce_before_shop_loop_item_title', array(&$this, 'template_loop_product_thumbnail'));
			add_action('woocommerce_shop_loop_item_title', array(&$this, 'template_loop_product_title'));
			add_action('woocommerce_after_shop_loop_item_title', array(&$this, 'template_after_shop_loop_item_title'));

			add_action('woocommerce_before_subcategory', array($this, 'woocommerce_template_loop_category_link_open'), 10 );
			add_action('woocommerce_after_subcategory', 'woocommerce_template_loop_category_link_close', 10 );

			add_action('woocommerce_after_subcategory_title', array(&$this, 'category_excerpt_output'));

			/* Single Product Hooks */
			add_action('woocommerce_share', array($this, 'product_share'));

			add_action('woocommerce_review_order_before_payment', array($this, 'review_order_before_payment'));

			add_action('gatsby_after_main_content', array($this, 'after_main_content'));

			// Ajax
			add_action( 'wp_ajax_' . $this->action_quick_view, array(&$this, 'ajax_product_popup') );
			add_action( 'wp_ajax_nopriv_' . $this->action_quick_view, array(&$this, 'ajax_product_popup') );
		}

		public function after_main_content() { ?>

			<?php if ( is_singular('product') ):

				global $gatsby_settings; ?>

				<?php if ( $gatsby_settings['product-upsells'] ): ?>
					<div class="up-sells upsells products">
						<div class="row">
							<div class="col-xs-12">
								<?php
								$args = array(
									'posts_per_page' => 2,
									'columns'        => 2,
									'orderby'        => 'rand'
								);
								wc_get_template( 'single-product/up-sells-without-sidebar.php', $args );
								?>
							</div>
						</div>
					</div>
				<?php endif; ?>

				<?php if ( $gatsby_settings['product-related'] ): ?>
					<div class="related products">
						<div class="row">
							<div class="col-xs-12">
								<?php
								$args = array(
									'posts_per_page' => 2,
									'columns'        => 2,
									'orderby'        => 'rand'
								);
								wc_get_template( 'single-product/related-without-sidebar.php', $args );
								?>
							</div>
						</div>
					</div>
				<?php endif; ?>

			<?php endif;
		}

		public function review_order_before_payment() {
			echo '<h4>' . esc_html__('Payment Method', 'gatsby') . '</h4>';
		}

		public function woocommerce_page_title($page_title) {

			if ( is_page( get_option('woocommerce_cart_page_id' ) ) ) {
				$page_title = get_the_title(get_option('woocommerce_cart_page_id' ));
			} elseif ( is_page( get_option('woocommerce_checkout_page_id') ) ) {
				$page_title = get_the_title(get_option('woocommerce_checkout_page_id' ));
			}

			return $page_title;
		}

		public function template_loop_product_thumbnail() {
			$this->product_thumbnail();
		}

		public function woocommerce_checkout_form() {
			echo gatsby_title( array( 'heading' => 'h2', 'title' => woocommerce_page_title(false) ) );
		}

		public function woocommerce_breadcrumb() {

			woocommerce_breadcrumb(array(
				'wrap_before' => '<nav class="gt-breadcrumbs" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>',
				'wrap_after'  => '</nav>',
			));

		}

		public function product_thumbnail() { ?>

			<div class="gt-product-image-area">

				<a class="gt-product-image" href="<?php echo esc_url(get_the_permalink()) ?>">
					<?php echo woocommerce_get_product_thumbnail( 'shop_catalog' ); ?>
				</a>

				<div class="gt-product-after-actions">
					<?php do_action( 'gatsby-after-product-image', get_the_ID() ); ?>
				</div>

			</div><!--/ .gt-product-image-area-->

			<?php
		}

		public function product_share($post_id) {
			$image = esc_url(wp_get_attachment_url( get_post_thumbnail_id( $post_id ) ));
			$permalink = esc_url( apply_filters('the_permalink', get_the_permalink( $post_id )) );
			$title = esc_attr(get_the_title( $post_id ));
			$extra_attr = 'target="_blank"';

			global $gatsby_settings;

			if ( !$gatsby_settings['product-single-share'] ) return;
			?>
			<div class="gt-share">

				<span class="gt-title"><?php esc_html_e('Share', 'gatsby') ?>:</span>

				<ul class="gt-social-icons">

					<?php if ($gatsby_settings['product-share-linkedin']): ?>
						<li><a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $permalink ?>&amp;title=<?php echo $title ?>" <?php echo $extra_attr ?> title="<?php echo esc_html__('LinkedIn', 'gatsby') ?>"><i class="fa fa-linkedin"></i></a></li>
					<?php endif; ?>

					<?php if ($gatsby_settings['product-share-tumblr']): ?>
						<li><a href="http://www.tumblr.com/share/link?url=<?php echo $permalink ?>&amp;name=<?php echo urlencode($title) ?>&amp;description=<?php echo urlencode(get_the_excerpt()) ?>" <?php echo $extra_attr ?> title="<?php echo esc_html__('Tumblr', 'gatsby') ?>"><i class="fa fa-tumblr"></i></a></li>
					<?php endif; ?>

					<?php if ($gatsby_settings['product-share-twitter']): ?>
						<li><a href="https://twitter.com/intent/tweet?text=<?php echo $title ?>&amp;url=<?php echo $permalink ?>" <?php echo $extra_attr ?> title="<?php echo esc_html__('Twitter', 'gatsby') ?>"><i class="fa fa-twitter"></i></a></li>
					<?php endif; ?>

					<?php if ($gatsby_settings['product-share-facebook']): ?>
						<li><a href="http://www.facebook.com/sharer.php?m2w&amp;s=100&amp;p&#091;url&#093;=<?php echo $permalink ?>&amp;p&#091;images&#093;&#091;0&#093;=<?php echo $image ?>&amp;p&#091;title&#093;=<?php echo $title ?>" <?php echo $extra_attr ?> title="<?php echo esc_html__('Facebook', 'gatsby') ?>"><i class="fa fa-facebook"></i></a></li>
					<?php endif; ?>

					<?php if ($gatsby_settings['product-share-googleplus']): ?>
						<li><a href="https://plus.google.com/share?url=<?php echo $permalink ?>" <?php echo $extra_attr ?> title="<?php echo esc_html__('Google +', 'gatsby') ?>"><i class="fa fa-google-plus"></i></a></li>
					<?php endif; ?>

				</ul>

			</div><!--/ .gt-share -->
			<?php
		}

		public function template_loop_product_title() {
			global $product;

			echo wc_get_product_category_list( $product->get_id(), ', ', '<div class="gt-product-categories">', '</div>' );

			echo '<h5 class="gt-product-name"><a href="'. esc_url(get_the_permalink()) .'">' . get_the_title() . '</a></h5>';
		}

		public function template_after_shop_loop_item_title() {
			$this->loop_price_output();
			$this->product_excerpt_output();
			woocommerce_template_loop_add_to_cart();
		}

		public function loop_price_output() {
			echo '<div class="gt-product-info">';
				woocommerce_template_loop_price();
				woocommerce_template_loop_rating();
			echo '</div>';
		}

		function product_excerpt_output() {
			global $product;
			$post_content = !empty($product->post_excerpt) ? $product->post_excerpt : '';
			$post_content = apply_filters('the_excerpt', $post_content);
			$post_content = str_replace(']]>', ']]&gt;', $post_content);
			$post_content = gatsby_get_excerpt( $post_content, apply_filters('gatsby_excerpt_limit', 150) );
			?>
			<?php if ( !empty($post_content) ): ?>
				<div class="gt-product-excerpt"><?php echo sprintf('%s', $post_content); ?></div>
			<?php endif; ?>
			<?php
		}

		public function woocommerce_template_loop_category_link_open( $category ) {
			echo '<a class="gt-product-image" href="' . get_term_link( $category, 'product_cat' ) . '">';
		}

		public function category_excerpt_output($category) {
			?>
			<div class="gt-product-excerpt"><?php $description = $category->description; if ( $description ) { echo sprintf('%s', $description); } ?></div>
			<?php
		}

		public function manage_columns($columns) {
			unset($columns['wpseo-title']);
			unset($columns['wpseo-metadesc']);
			unset($columns['wpseo-focuskw']);

			return $columns;
		}

		public function upsell_display_args($args) {
			global $gatsby_settings;

			$args['posts_per_page'] = $gatsby_settings['product-upsells-count'];

			return $args;
		}

		public function cross_sells_total($limit) {
			global $gatsby_settings;

			$count_limit = $gatsby_settings['product-crosssell-count'];

			if ( $count_limit > 0 )
				return $count_limit;

			return $limit;
		}

		public function woocommerce_loop_columns() {
			global $gatsby_settings;

			$woocommerce_columns = $gatsby_settings['shop-product-cols'];
			$overview_column_count = gatsby_get_meta_value('overview_column_count');

			if ( !empty($overview_column_count) ) { $woocommerce_columns = $overview_column_count; }

			return $woocommerce_columns;
		}

		public function ajax_product_popup() {
			check_ajax_referer($this->action_quick_view);

			$popups = new Gatsby_Quick_Popups(absint($_POST['id']));
			echo $popups->output_quick_view_html();
			wp_die();
		}

		public function add_enqueue_scripts() {
			$woo_mod_file = $this->assetUrl('js/woocommerce-mod' . (WP_DEBUG ? '' : '.min') . '.js');
			$woo_zoom_file = $this->assetUrl('js/elevatezoom.min.js');
			$css_scrollbar = $this->assetUrl('css/jquery.scrollbar.css');

			if ( current_theme_supports( 'wc-product-gallery-zoom' ) ) {
				wp_enqueue_script( 'zoom' );
			}
			if ( current_theme_supports( 'wc-product-gallery-slider' ) ) {
				wp_enqueue_script( 'flexslider' );
			}
			if ( current_theme_supports( 'wc-product-gallery-lightbox' ) ) {
				wp_enqueue_script( 'photoswipe-ui-default' );
				wp_enqueue_style( 'photoswipe-default-skin' );
				add_action( 'wp_footer', 'woocommerce_photoswipe' );
			}

			wp_enqueue_style( 'gatsby-scrollbar', $css_scrollbar );
			wp_enqueue_script( 'gatsby-woocommerce-mod', $woo_mod_file, array('jquery', 'gatsby_plugins', 'gatsby_core'), 1, true );
			wp_enqueue_script( 'gatsby-elevate-zoom', $woo_zoom_file, array('jquery', 'gatsby-woocommerce-mod') );
			wp_enqueue_script( 'wc-single-product' );

			wp_localize_script('gatsby-woocommerce-mod', 'gatsby_woocommerce_mod', array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'nonce_cart_item_remove' => wp_create_nonce( 'gatsby_cart_item_remove' )
			));

		}

		public function quick_view_output() {
			global $gatsby_settings; ?>

			<?php if ( $gatsby_settings['product-quick-view'] ): ?>
				<div class="quick-view-button">
					<a href="javascript:void(0)" data-id="<?php echo get_the_ID() ?>" data-modal-action="<?php echo esc_attr($this->action_quick_view); ?>" data-modal-nonce="<?php echo esc_attr(wp_create_nonce($this->action_quick_view)) ?>" class="quick-view"></a>
				</div>
			<?php endif; ?>

			<?php
		}

		public function woocommerce_ordering_products() {
			$ordering = new Gatsby_Catalog_Ordering();
			echo $ordering->output();
		}

		function woocommerce_general_settings_filter($options) {
			$delete = array('woocommerce_enable_lightbox');

			foreach ( $options as $key => $option ) {
				if (isset($option['id']) && in_array($option['id'], $delete)) {
					unset($options[$key]);
				}
			}
			return $options;
		}

		public static function content_truncate($string, $limit, $break = ".", $pad = "...") {
			if (strlen($string) <= $limit) { return $string; }

			if (false !== ($breakpoint = strpos($string, $break, $limit))) {
				if ($breakpoint < strlen($string) - 1) {
					$string = substr($string, 0, $breakpoint) . $pad;
				}
			}
			if (!$breakpoint && strlen(strip_tags($string)) == strlen($string)) {
				$string = substr($string, 0, $limit) . $pad;
			}
			return $string;
		}

		public static function create_data_string($data = array()) {
			$data_string = "";

			foreach($data as $key => $value) {
				if (is_array($value)) $value = implode(", ", $value);
				$data_string .= " data-$key={$value} ";
			}
			return $data_string;
		}

	}

	new Gatsby_WooCommerce_Config();

}