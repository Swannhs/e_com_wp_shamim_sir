<?php

if ( !function_exists('gatsby_logo') ) {

	function gatsby_logo() {
		global $gatsby_settings, $gatsby_config;

		if ( is_404()) {
			$logo = $gatsby_settings['logo']['url'];

		} elseif ( $gatsby_config['header_type'] == 'gt-type-2' ||
				   $gatsby_config['header_type'] == 'gt-type-3' ||
				   $gatsby_config['header_type'] == 'gt-type-6' ) {
			$logo = $gatsby_settings['logo-dark']['url'];
		} elseif (  $gatsby_config['header_type'] == 'gt-type-4' ||
					$gatsby_config['header_type'] == 'gt-type-5' ) {
			$logo = $gatsby_settings['logo-large-dark']['url'];
		} else {
			$logo = $gatsby_settings['logo']['url'];
		}

		ob_start();

		if ( !$logo ): ?>

			<h1 class="gt-logo"><?php else : ?><?php endif; ?>

				<a class="gt-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" rel="home">
					<?php if ( $logo ) {
						echo '<img class="gt-standard-logo" src="' . esc_url(str_replace( array( 'http:', 'https:' ), '', $logo)) . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" />';
					} else {
						bloginfo( 'name' );
					} ?>
				</a>

		<?php if ( !$logo ) : ?></h1><?php else : ?><?php endif;

		return apply_filters( 'gatsby_logo', ob_get_clean() );
	}

}


if ( !function_exists('gatsby_footer_logo') ) {

	function gatsby_footer_logo() {
		global $gatsby_settings;

		$logo = $gatsby_settings['logo']['url'];

		ob_start();

		if ( !$logo ): ?>

			<h1 class="gt-logo"><?php else : ?><?php endif; ?>

		<a class="gt-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" rel="home">
			<?php if ( $logo ) {
				echo '<img class="gt-standard-logo" src="' . esc_url(str_replace( array( 'http:', 'https:' ), '', $logo)) . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" />';
			} else {
				bloginfo( 'name' );
			} ?>
		</a>

		<?php if ( !$logo ) : ?></h1><?php else : ?><?php endif;

		return apply_filters( 'gatsby_footer_logo', ob_get_clean() );
	}

}


if ( !function_exists('gatsby_header_top_bar_light') ) {

	function gatsby_header_top_bar_light() {

		global $gatsby_settings;

		if ( !$gatsby_settings['show-header-top-bar-light'] )
			return;

		ob_start(); ?>

		<div class="gt-top-bar-light">

			<div class="gt-t-row">

				<div class="col-sm-7">

					<nav class="gt-nav-topbar">
						<?php echo Gatsby_Helper::main_navigation(array(
							'gt-topbar-navigation'
						), 'topbar'); ?>
					</nav>

				</div>

				<div class="col-sm-5">

					<ul class="gt-top-bar-list">

						<?php if ( gatsby_is_shop_installed() ): ?>

							<li>

								<?php $accountPage = get_permalink(get_option('woocommerce_myaccount_page_id')); ?>

								<?php if ( is_user_logged_in() ): ?>

									<a href="<?php echo wp_logout_url(esc_url(home_url('/'))) ?>">
										<?php esc_html_e('Logout', 'gatsby') ?>
									</a>

								<?php else: ?>

									<a href="<?php echo esc_url($accountPage); ?>">
										<?php esc_html_e('Login', 'gatsby'); ?>
									</a>

								<?php endif; ?>

							</li>

						<?php else: ?>

							<li>

								<?php if ( is_user_logged_in() ): ?>

									<a href="<?php echo wp_logout_url(esc_url(home_url('/'))) ?>">
										<?php esc_html_e('Logout', 'gatsby') ?>
									</a>

								<?php else: ?>

									<a href="<?php echo esc_url(wp_login_url()); ?>">
										<?php esc_html_e('Login', 'gatsby'); ?>
									</a>

								<?php endif; ?>

							</li>

						<?php endif; ?>

						<?php if ( defined('ICL_LANGUAGE_CODE') ): ?>
							<?php echo Gatsby_WC_WPML_Config::wpml_header_languages_list(); ?>
						<?php endif; ?>

						<?php if ( defined('Gatsby_Woo_Config') ): ?>
							<?php echo Gatsby_WC_Current_Switcher::output_switcher_html(); ?>
						<?php endif; ?>

					</ul>

				</div>

			</div><!--/ .gt-t-row -->

		</div>

		<?php return ob_get_clean();

	}

}

if ( !function_exists('gatsby_header_top_bar') ) {

	function gatsby_header_top_bar() {

		global $gatsby_settings, $gatsby_config;

		if ( !$gatsby_settings['show-header-top-bar'] )
			return;

		ob_start(); ?>

		<div class="gt-top-bar">

			<?php if ( $gatsby_config['header_type'] == 'gt-type-5' ): ?>
				<div class="container">
			<?php endif; ?>

			<div class="gt-t-row">

				<?php if ( $gatsby_config['header_type'] == 'gt-type-5' ): ?>
					<div class="col-sm-6">
				<?php else: ?>
					<div class="col-sm-10">
				<?php endif; ?>

						<!-- - - - - - - - - - - - - - Contact Info - - - - - - - - - - - - - - - - -->

						<ul class="gt-contact-info">

							<?php if ( $gatsby_settings['header-social-phone']): ?>
								<li><span class="lnr lnr-phone-handset"></span><?php echo esc_html($gatsby_settings['header-social-phone']) ?></li>
							<?php endif; ?>

							<?php if ( $gatsby_settings['header-social-email']): ?>
								<li><span class="lnr lnr-envelope"></span> <a href="mailto:<?php echo antispambot($gatsby_settings['header-social-email'], 1) ?>"><?php echo esc_html($gatsby_settings['header-social-email']) ?></a></li>
							<?php endif; ?>

							<?php if ( $gatsby_config['header_type'] == 'gt-type-7' ): ?>
								<?php if ( $gatsby_settings['header-top-bar-hours']): ?>
									<li><span class="icon-clock3"></span> <?php echo esc_html($gatsby_settings['header-top-bar-hours']) ?></li>
								<?php endif; ?>
							<?php endif; ?>

							<?php if ( $gatsby_config['header_type'] == 'gt-type-7' ): ?>
								<?php if ( $gatsby_settings['header-top-bar-address']): ?>
									<li><span class="icon-map-marker"></span> <?php echo esc_html($gatsby_settings['header-top-bar-address']) ?></li>
								<?php endif; ?>
							<?php endif; ?>

						</ul>

						<!-- - - - - - - - - - - - - - End of Contact Info - - - - - - - - - - - - - - - - -->

					</div>

					<?php if ( $gatsby_config['header_type'] == 'gt-type-5' ): ?>
						<div class="col-sm-6">
					<?php else: ?>
						<div class="col-sm-2">
					<?php endif; ?>

						<!-- - - - - - - - - - - - - - Social Links - - - - - - - - - - - - - - - - -->

						<ul class="gt-social-icons align-right">

							<?php if ( $gatsby_settings['header-social-linkedin']): ?>
								<li><a title="<?php echo esc_html__('LinkedIn', 'gatsby') ?>" href="<?php echo esc_url($gatsby_settings['header-social-linkedin']) ?>"><i class="fa fa-linkedin"></i></a></li>
							<?php endif; ?>

							<?php if ( $gatsby_settings['header-social-tumblr']): ?>
								<li><a title="<?php echo esc_html__('Tumblr', 'gatsby') ?>" href="<?php echo esc_url($gatsby_settings['header-social-tumblr']) ?>"><i class="fa fa-tumblr"></i></a></li>
							<?php endif; ?>

							<?php if ( $gatsby_settings['header-social-vimeo']): ?>
								<li><a title="<?php echo esc_html__('Vimeo', 'gatsby') ?>" href="<?php echo esc_url($gatsby_settings['header-social-vimeo']) ?>"><i class="fa fa-vimeo"></i></a></li>
							<?php endif; ?>

							<?php if ( $gatsby_settings['header-social-youtube']): ?>
								<li><a title="<?php echo esc_html__('Youtube', 'gatsby') ?>" href="<?php echo esc_url($gatsby_settings['header-social-youtube']) ?>"><i class="fa fa-youtube"></i></a></li>
							<?php endif; ?>

							<?php if ( $gatsby_settings['header-social-facebook']): ?>
								<li><a title="<?php echo esc_html__('Facebook', 'gatsby') ?>" href="<?php echo esc_url($gatsby_settings['header-social-facebook']) ?>"><i class="fa fa-facebook"></i></a></li>
							<?php endif; ?>

							<?php if ( $gatsby_settings['header-social-twitter']): ?>
								<li><a title="<?php echo esc_html__('Twitter', 'gatsby') ?>" href="<?php echo esc_url($gatsby_settings['header-social-twitter']) ?>"><i class="fa fa-twitter"></i></a></li>
							<?php endif; ?>

							<?php if ( $gatsby_settings['header-social-instagram']): ?>
								<li><a title="<?php echo esc_html__('Instagram', 'gatsby') ?>" href="<?php echo esc_url($gatsby_settings['header-social-instagram']) ?>"><i class="fa fa-instagram"></i></a></li>
							<?php endif; ?>

							<?php if ( $gatsby_settings['header-social-flickr']): ?>
								<li><a title="<?php echo esc_html__('Flickr', 'gatsby') ?>" href="<?php echo esc_url($gatsby_settings['header-social-flickr']) ?>"><i class="fa fa-flickr"></i></a></li>
							<?php endif; ?>

						</ul>

						<!-- - - - - - - - - - - - - - End of Social Links - - - - - - - - - - - - - - - - -->

					</div>

			</div><!--/ .gt-t-row -->

			<?php if ( $gatsby_config['header_type'] == 'gt-type-5' ): ?>
				</div>
			<?php endif; ?>

		</div>

		<?php return ob_get_clean();


	}

}

if ( !function_exists('gatsby_mobile_menu') ) {

	function gatsby_mobile_menu() {
		ob_start();

		$defaults = array(
			'container' => 'ul',
			'menu_class' => 'mobile-advanced',
			'theme_location' => 'primary',
			'fallback_cb' => false,
			'before' => '',
			'after' => '',
			'link_before' => '',
			'link_after' => '',
			'walker' => new gatsby_mobile_navwalker
		);

		if ( has_nav_menu('primary') ) {
			wp_nav_menu( $defaults );
		} else {
			echo '<ul class="mobile-advanced">';
			wp_list_pages('title_li=');
			echo '</ul>';
		}

		$output = str_replace( '&nbsp;', '', ob_get_clean() );
		return apply_filters( 'gatsby_mobile_menu', $output );
	}
}

