<?php

if (!class_exists('Gatsby_Hooks')) {

	class Gatsby_Hooks {

		function __construct() {
			add_action('init', array($this, 'init'));
		}

		public function init() {
			$this->add_hooks();
		}

		public function add_hooks() {

			global $gatsby_settings;

			add_action('gatsby_header_layout', array(&$this, 'template_header_layout_hook'));

			if ( $gatsby_settings['show-loading-overlay'] ) {
				add_action('gatsby_body_append', array( &$this, 'preloader' ));
			}

			add_action( 'gatsby_header_prepend', array( &$this, 'header_prepend' ) );
			add_action( 'gatsby_header_after', array( &$this, 'header_after_hook' ) );
			add_action( 'gatsby_footer_in_top_part', array( &$this, 'template_footer' ) );
		}

		public function template_header_layout_hook($type) {
			get_template_part( 'template-parts/header', $type );
		}

		public function template_footer() {
			get_template_part( 'template-parts/footer', 'widgets' );
		}

		public function header_prepend() {
			$coming_soon = absint( mad_meta( 'gatsby_coming_soon' ) );

			?>
			<?php if ( $coming_soon ): ?>
				<div class="gt-fullscreen-overlay"></div>
			<?php endif;
		}

		public function header_after_hook() {
			$this->float_aside();
			$this->page_title_and_breadcrumbs();
		}

		public function preloader() { ?><div id="preloader" class="gt-preloader"></div><?php }

		public function page_title_and_breadcrumbs() {

			global $gatsby_settings;
			$mode = gatsby_page_title_get_value('mode');

			switch ( $mode ) {
				case 'default':
					$breadcrumb = $gatsby_settings['show-breadcrumbs'];
				break;
				case 'custom':
					$breadcrumb = gatsby_page_title_get_value('breadcrumb');
				break;
				default:
					$breadcrumb = $gatsby_settings['show-breadcrumbs'];
					break;
			}

			$coming_soon = absint( mad_meta( 'gatsby_coming_soon' ) );

			if ( $coming_soon || $mode == 'none' || is_front_page() || gatsby_is_product() || gatsby_is_shop() || gatsby_is_product_tag() || gastby_is_realy_woocommerce_page(false) || is_404() ) return; ?>

			<div <?php echo Gatsby_Page_Title_Config::output_attributes(); ?>>

				<?php if ( is_page() ): ?>

					<?php if ( $gatsby_settings['show-pagetitle'] ): ?>
						<?php echo gatsby_title(); ?>
					<?php endif; ?>

					<?php if ( $breadcrumb ): ?>

						<nav class="gt-breadcrumbs">
							<?php echo gatsby_breadcrumbs(array(
								'separator' => ' '
							)); ?>
						</nav>

					<?php endif; ?>

				<?php elseif ( gastby_is_realy_woocommerce_page() ): ?>

					<?php if ( $gatsby_settings['product-show-pagetitle'] ) : ?>

						<?php echo gatsby_title( array( 'title' => woocommerce_page_title(false) ) ); ?>

					<?php endif; ?>

					<?php if ( $gatsby_settings['product-show-breadcrumbs'] ): ?>

						<?php woocommerce_breadcrumb(array(
							'wrap_before' => '<nav class="gt-breadcrumbs" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>',
							'wrap_after'  => '</nav>',
						)); ?>

					<?php endif; ?>

				<?php elseif ( is_singular('portfolio') ): ?>

					<?php if ( $gatsby_settings['portfolio-show-pagetitle'] ) : ?>

						<?php echo gatsby_title(array( 'heading' => 'h1' )); ?>

					<?php endif; ?>

					<?php if ( $gatsby_settings['portfolio-show-breadcrumbs'] ): ?>

						<nav class="gt-breadcrumbs">
							<?php echo gatsby_breadcrumbs(array(
								'separator' => ' '
							)); ?>
						</nav>

					<?php endif; ?>

				<?php elseif ( is_singular('testimonials') ): ?>

					<?php if ( $gatsby_settings['testimonials-show-pagetitle'] ) : ?>
						<?php echo gatsby_title(array( 'heading' => 'h1' )); ?>
					<?php endif; ?>

					<?php if ( $gatsby_settings['testimonials-show-breadcrumbs'] ): ?>

						<nav class="gt-breadcrumbs">
							<?php echo gatsby_breadcrumbs(array(
								'separator' => ' '
							)); ?>
						</nav>

					<?php endif; ?>

				<?php elseif ( is_singular('team-members') ): ?>

					<?php if ( $gatsby_settings['team-members-show-pagetitle'] ) : ?>
						<?php echo gatsby_title(array( 'heading' => 'h1' )); ?>
					<?php endif; ?>

					<?php if ( $gatsby_settings['team-members-show-breadcrumbs'] ) : ?>

						<nav class="gt-breadcrumbs">
							<?php echo gatsby_breadcrumbs(array(
								'separator' => ' '
							)); ?>
						</nav>

					<?php endif; ?>

				<?php elseif ( is_single() ): ?>

					<?php if ( in_array('categories', $gatsby_settings['single-post-metas']) ): ?>

						<?php $categories = get_the_category_list('', ''); ?>
						<?php if ( !empty($categories) ): ?>
							<?php echo get_the_category_list('', '') ?>
						<?php endif; ?>

					<?php endif; ?>

					<?php echo gatsby_title(array( 'heading' => 'h1' )); ?>

					<?php if ( in_array('breadcrumb', $gatsby_settings['single-post-metas']) ): ?>

						<?php if ( $breadcrumb ): ?>

							<nav class="gt-breadcrumbs">
								<?php echo gatsby_breadcrumbs(array(
									'separator' => ' '
								)); ?>
							</nav>

						<?php endif; ?>

					<?php endif; ?>

					<div class="gt-entry-meta">

						<?php if ( in_array('date', $gatsby_settings['single-post-metas']) ): ?>
							<?php
							printf( '<time class="gt-entry-date" datetime="%1$s">%2$s</time>',
								esc_attr( get_the_date( 'c' ) ),
								esc_attr( get_the_date( 'F j, Y g:s' ) )
							);
							?>
						<?php endif; ?>

						<?php if ( in_array('likes', $gatsby_settings['single-post-metas']) ): ?>
							<?php echo gatsby_get_simple_likes_button(get_the_ID()); ?>
						<?php endif; ?>

						<?php if ( in_array('comments', $gatsby_settings['single-post-metas']) ): ?>
							<?php if ( comments_open() ): ?>
								<a href="<?php echo esc_url(get_the_permalink()) ?>" class="gt-entry-comments-link"><?php echo absint(get_comments_number()) ?></a>
							<?php endif; ?>
						<?php endif; ?>

					</div><!--/ .gt-entry-meta-->

				<?php elseif ( is_search() ): global $wp_query; ?>

					<?php if ( !empty($wp_query->found_posts) ): ?>

						<?php if ($wp_query->found_posts > 1): ?>

							<?php
							echo gatsby_title(
								array(
									'title' => esc_html__('Search results for:', 'gatsby')." " . esc_attr(get_search_query()) . " (". $wp_query->found_posts .")"
								)
							); ?>

						<?php else: ?>

							<?php
							echo gatsby_title(
								array(
									'title' => esc_html__('Search result for:', 'gatsby')." " . get_search_query() . " (". $wp_query->found_posts .")"
								)
							); ?>

						<?php endif; ?>

					<?php else: ?>

						<?php if ( !empty($_GET['s']) ): ?>

							<?php
							echo gatsby_title(
								array(
									'title' => esc_html__('Search results for:', 'gatsby') . " " . get_search_query()
								)
							); ?>

						<?php else: ?>

							<?php
							echo gatsby_title(
								array(
									'title' => esc_html__('To search the site please enter a valid term', 'gatsby')
								)
							); ?>

						<?php endif; ?>

					<?php endif; ?>

				<?php else: ?>

					<?php if ( is_archive() || is_front_page() ): ?>

						<?php if ( is_post_type_archive('portfolio') ): ?>

							<?php if ( !empty($gatsby_settings['portfolio-title']) ): ?>

								<?php
								echo gatsby_title(
									array(
										'title' => wp_kses($gatsby_settings['portfolio-title'], '')
									)
								); ?>

							<?php else: ?>

								<?php
								echo gatsby_title(
									array(
										'title' => get_the_archive_title(),
										'subtitle' => get_the_archive_description()
									)
								); ?>

							<?php endif; ?>

						<?php elseif ( is_post_type_archive('testimonials') ): ?>

							<?php if ( !empty($gatsby_settings['testimonials-title']) ): ?>

								<?php
								echo gatsby_title(
									array(
										'title' => wp_kses($gatsby_settings['testimonials-title'], '')
									)
								); ?>

							<?php else: ?>

								<?php
								echo gatsby_title(
									array(
										'title' => get_the_archive_title(),
										'subtitle' => get_the_archive_description()
									)
								); ?>

							<?php endif; ?>

						<?php elseif( is_post_type_archive('team-members') ): ?>

							<?php if ( !empty($gatsby_settings['team-members-title']) ): ?>

								<?php
								echo gatsby_title(
									array(
										'title' => wp_kses($gatsby_settings['team-members-title'], '')
									)
								); ?>

							<?php else: ?>

								<?php
								echo gatsby_title(
									array(
										'title' => get_the_archive_title(),
										'subtitle' => get_the_archive_description()
									)
								); ?>

							<?php endif; ?>

						<?php else: ?>

							<?php
							echo gatsby_title(
								array(
									'title' => get_the_archive_title(),
									'subtitle' => get_the_archive_description()
								)
							); ?>

						<?php endif; ?>

						<?php if ( $breadcrumb ): ?>

							<nav class="gt-breadcrumbs">
								<?php echo gatsby_breadcrumbs(array(
									'separator' => ' '
								)); ?>
							</nav>

						<?php endif; ?>

					<?php else: ?>

						<?php
						echo gatsby_title(
							array(
								'title' => get_the_archive_title(),
								'subtitle' => get_the_archive_description()
							)
						); ?>

					<?php endif; ?>

				<?php endif; ?>

			</div><!--/ .gt-breadcrumbs-wrap-->
			<?php
		}

		public function float_aside() {
			global $gatsby_config, $gatsby_settings;

			$header_type = $gatsby_config['header_type'];

			if ( empty($header_type) ) {
				$header_type = $gatsby_settings['header-type'];
			}

			if ( $header_type == 'gt-type-1' ||
				 $header_type == 'gt-type-3' ||
				 $header_type == 'gt-type-4' ||
				 $header_type == 'gt-type-5' ||
				 $header_type == 'gt-type-6' ||
				 $header_type == 'gt-type-7' ||
				 $header_type == 'gt-type-8'
			) return;

			?>

			<?php if ( is_active_sidebar('aside-panel-widget-area') ): ?>

				<div class="float-aside-overlay">
					<div class="float-aside">
						<?php dynamic_sidebar('Aside Panel Widget Area'); ?>
					</div>
				</div>

			<?php endif;
		}

		/* 	Get Cookie
		/* ---------------------------------------------------------------------- */

		public static function getcookie( $name ) {
			if ( isset( $_COOKIE[$name] ) )
				return maybe_unserialize( stripslashes( $_COOKIE[$name] ) );

			return array();
		}

	}

	new Gatsby_Hooks();
}
