<div class="wrap mad-wrap">

	<h1><?php esc_html_e( 'Welcome to Gatsby!', 'gatsby' ); ?></h1>

	<div class="about-text"><?php echo esc_html__( 'Installing a demo content.', 'gatsby' ); ?></div>

	<div class="mad-logo"></div>

	<h2 class="nav-tab-wrapper">
		<?php
		printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'themes.php?page=gatsby' ), esc_html__( "Welcome", 'gatsby' ) );
		printf( '<a href="#" class="nav-tab nav-tab-active">%s</a>', esc_html__( "Install Demos", 'gatsby' ) );

		if ( class_exists('ReduxFramework') ) {
			printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=gatsby_settings' ), esc_html__( "Theme Options", 'gatsby' ) );
		}
		?>
	</h2>

	<div class="mad-section">

		<?php if ( Gatsby()->registration->is_registered() ) : ?>

			<p class="about-description"><?php esc_html_e( 'Installing a demo provides pages, posts, menus, images, theme options, widgets and more. IMPORTANT: The included plugins need to be installed and activated before you install a demo.', 'gatsby' ); ?></p>

			<div class="mad-install-demos">

				<div id="mad-install-options" style="display: none;">
					<h3><span class="theme-name"></span> <?php esc_html_e('Install Options', 'gatsby') ?></h3>
					<input type="hidden" id="gatsby-install-demo-type" value="default"/>
					<label for="gatsby-reset-menus"><input type="checkbox" id="gatsby-reset-menus" value="1" checked="checked"/> <?php esc_html_e('Reset menus', 'gatsby') ?></label>
					<label for="gatsby-import-dummy"><input type="checkbox" id="gatsby-import-dummy" value="1" checked="checked" /> <?php esc_html_e('Import dummy content', 'gatsby') ?></label>
					<label for="gatsby-import-widgets"><input type="checkbox" id="gatsby-import-widgets" value="1" checked="checked" /> <?php esc_html_e('Import widgets', 'gatsby') ?></label>
					<label for="gatsby-import-options"><input type="checkbox" id="gatsby-import-options" value="1" checked="checked" /> <?php esc_html_e('Import theme options', 'gatsby') ?></label>
					<p><?php esc_html_e('Do you want to install demo? It can also take a minute to complete.', 'gatsby') ?></p>
					<button class="button button-primary" id="gatsby-import-yes"><?php esc_html_e('Yes', 'gatsby') ?></button>
					<button class="button" id="gatsby-import-no"><?php esc_html_e('No', 'gatsby') ?></button>
				</div>

				<div class="feature-section theme-browser rendered">

					<?php $demos = gatsby_demo_types(); ?>
					<?php $preview_link = 'http://velikorodnov.com/wordpress/gatsby/' ?>

					<?php foreach ( $demos as $demo => $details ): ?>

						<div class="theme" id="<?php echo 'gatsby-demo-' . esc_attr($demo) ?>">

							<div class="theme-wrapper">
								<div class="theme-screenshot">
									<img src="<?php echo esc_url($details['img']); ?>" />
								</div>
								<h3 class="theme-name" id="<?php echo esc_attr($demo); ?>"><?php echo esc_html($details['alt']); ?></h3>
								<div class="theme-actions">
									<?php printf( '<a class="button button-secondary button-install-demo" data-demo-id="%s" data-path="%s" href="javascript:void(0)">%s</a>', strtolower( $demo ), esc_attr( $details['path'] ), esc_html__( 'Install', 'gatsby' ) ); ?>
									<?php printf( '<a class="button button-primary load-customize hide-if-no-customize" target="_blank" href="%s">%s</a>', esc_url( $preview_link . strtolower( $demo ) ), esc_html__( 'Preview', 'gatsby' ) ); ?>
								</div>
							</div>

							<div class="gatsby-import-started">
								<span class="gatsby-import-loading"></span>
								<strong><?php esc_html_e('Starting import.', 'gatsby') ?></strong><br>
								<?php esc_html_e('Please dont reload the page. It may take a few minutes...', 'gatsby') ?>
							</div><!--/ .gatsby-import-started-->

						</div><!--/ .theme-->

					<?php endforeach; ?>
				</div>
			</div>

		<?php else: ?>

			<div class="gatsby-important-notice">
				<h3><?php esc_attr_e( 'Gatsby Demos Can Only Be Installed With A Valid Token Registration', 'gatsby' ); ?></h3>
				<p><?php printf( esc_attr__( 'Please visit the %s page and enter a valid token to install the full Gatsby Demos.', 'gatsby' ), '<a href="' . admin_url( 'admin.php?page=gatsby' ) . '">' . esc_attr__( 'Product Registration', 'gatsby' ) . '</a>' ); ?></p>
			</div>

		<?php endif; ?>

	</div>

</div>