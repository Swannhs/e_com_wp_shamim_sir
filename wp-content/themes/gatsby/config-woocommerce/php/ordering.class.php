<?php

if ( !class_exists('Gatsby_Catalog_Ordering') ) {

	class Gatsby_Catalog_Ordering {

		function __construct() {

		}

		public function woo_build_query_string ($params = array(), $key, $value) {
			$params[$key] = $value;
			return "?" . http_build_query($params);
		}

		public function woo_active_class($key1, $key2) {
			if ( $key1 == $key2 ) return " class='gt-active'";
		}

		public function output() {

			global $gatsby_config, $gatsby_settings;
			parse_str($_SERVER['QUERY_STRING'], $params);

			$product_order = array();
			$product_order['default'] 	= esc_html__("Default",'gatsby');
			$product_order['title'] 	= esc_html__("Name",'gatsby');
			$product_order['price'] 	= esc_html__("Price",'gatsby');
			$product_order['date'] 		= esc_html__("Date",'gatsby');
			$product_order['popularity'] = esc_html__("Popularity",'gatsby');

			if ( $gatsby_settings['category-item'] ) {
				$per_page = explode(',', $gatsby_settings['category-item']);
			} else {
				$per_page = explode(',', '24,16,8');
			}
			$page_count = gatsby_woocommerce_product_count();

			$product_order_key = !empty($gatsby_config['woocommerce']['product_order']) ? $gatsby_config['woocommerce']['product_order'] : 'default';
			$product_count_key = !empty($gatsby_config['woocommerce']['product_count']) ? $gatsby_config['woocommerce']['product_count'] : $per_page[0];
			?>

			<header class="gt-settings-view-products">

				<div class="gt-sort-criteria">

					<div class="gt-sort-item">

						<span class="gt-title"><?php esc_html_e('Sort by', 'gatsby') ?>:</span>

						<div class="gt-custom-select">

							<div class="gt-selected-option"><?php echo sprintf('%s', $product_order[$product_order_key]) ?></div>

							<ul class="gt-options-list">
								<li><a <?php echo $this->woo_active_class($product_order_key, 'default'); ?> href="<?php echo $this->woo_build_query_string($params, 'product_order', 'default') ?>"><?php echo $product_order['default'] ?></a></li>
								<li><a <?php echo $this->woo_active_class($product_order_key, 'title'); ?> href="<?php echo $this->woo_build_query_string($params, 'product_order', 'title') ?>"><?php echo $product_order['title'] ?></a></li>
								<li><a <?php echo $this->woo_active_class($product_order_key, 'price'); ?> href="<?php echo $this->woo_build_query_string($params, 'product_order', 'price') ?>"><?php echo $product_order['price'] ?></a></li>
								<li><a <?php echo $this->woo_active_class($product_order_key, 'date'); ?> href="<?php echo $this->woo_build_query_string($params, 'product_order', 'date') ?>"><?php echo $product_order['date'] ?></a></li>
								<li><a <?php echo $this->woo_active_class($product_order_key, 'popularity'); ?> href="<?php echo $this->woo_build_query_string($params, 'product_order', 'popularity') ?>"><?php echo $product_order['popularity'] ?></a></li>
							</ul>

						</div>

					</div><!--/ .gt-sort-item -->

					<div class="gt-sort-item">

						<span class="gt-title"><?php esc_html_e('Show items per page', 'gatsby') ?>:</span>

						<div class="gt-custom-select">

							<div class="gt-selected-option"><?php echo esc_html($product_count_key) ?></div>

							<ul class="gt-options-list">

								<?php foreach ( $per_page as $count ) : ?>
									<li><a <?php echo $this->woo_active_class($page_count, $count); ?> href="<?php echo $this->woo_build_query_string($params, 'product_count', $count) ?>"><?php echo esc_attr( $count ); ?></a></li>
								<?php endforeach; ?>

							</ul>

						</div>

					</div><!--/ .gt-sort-item -->

				</div><!--/ .gt-sort-criteria -->

				<div class="gt-view-type">

					<?php
					$shop_view = gatsby_get_meta_value('shop_view');
					if ( !isset($shop_view) || empty($shop_view) ) {
						$shop_view = $gatsby_settings['category-view-mode'];
					}
					?>

					<a href="javascript:void(0)" title="<?php esc_html_e('List View', 'gatsby') ?>" data-view="list" class="<?php if ( $shop_view == 'gt-view-list' ): ?>gt-active<?php endif ?>"><i class="lnr icon-list4"></i></a>
					<a href="javascript:void(0)" title="<?php esc_html_e('Grid View', 'gatsby') ?>" data-view="grid" class="<?php if ( $shop_view == 'gt-view-grid' ): ?>gt-active<?php endif ?>"><i class="lnr icon-icons"></i></a>

				</div><!--/ .gt-view-type-->

			</header>

			<?php
		}

	}
}

?>
