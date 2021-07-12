<div class="wrap mad-wrap">

    <h1><?php esc_html_e( 'Welcome to Gatsby WordPress!', 'gatsby' ); ?></h1>

    <div class="about-text"><?php echo esc_html__( 'Gatsby is now installed and ready to use!', 'gatsby' ); ?></div>

	<div class="mad-logo"></div>

    <h2 class="nav-tab-wrapper">
        <?php
        printf( '<a href="#" class="nav-tab nav-tab-active">%s</a>', esc_html__( "Welcome", 'gatsby' ) );
        printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=gatsby-demos' ), esc_html__( "Install Demos", 'gatsby' ) );

		if ( class_exists('ReduxFramework') ) {
			printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=gatsby_settings' ), esc_html__( "Theme Options", 'gatsby' ) );
		}
        ?>
    </h2>

    <div class="mad-section">

		<div class="mad-notice">

			<p class="about-description">
				<?php printf( __('We would like to thank you for purchasing Gatsby WordPress + eCommerce Theme! We are very pleased you have chosen Gatsby WordPress for your website, you will be never disappointed! Before you get started, please be sure to always check out this documentation. We outline all kinds of good information, and provide you with all the details you need to use Gatsby WordPress Theme. Gatsby WordPress can only be used with WordPress and we assume that you already have WordPress installed and ready to go.', 'gatsby') ); ?>
			</p>
			<p class="about-description">
				<?php printf( __('If you are unable to find your answer here in our documentation, we encourage you to contact us through <a href="%s" target="_blank">support page</a> or themeforest item support page with your site CPanel (or FTP) and WordPress admin details. We\'re very happy to help you and you will get reply from us more faster than you expected.', 'gatsby'), 'https://velikorodnov.ticksy.com') ?>
			</p>

			<?php if ( Gatsby()->registration->is_registered() ): ?>



			<?php else: ?>

				<?php if ( Gatsby()->registration->is_registered() ) : ?>
					<p class="about-description"><?php esc_html_e( 'Congratulations! Your theme is registered now.', 'gatsby' ); ?></p>
				<?php else : ?>
					<p class="about-description"><?php esc_html_e( 'Please enter your Envato token to complete registration.', 'gatsby' ); ?></p>
				<?php endif; ?>

				<div class="mad-registration-form">

					<form id="gatsby_product_registration" method="post" action="options.php">
						<?php
						$invalid_token = false;
						$token = Gatsby()->registration->get_token();
						settings_fields( Gatsby()->registration->get_option_group_slug() );
						?>
						<?php if ( $token && ! empty( $token ) ) : ?>
							<?php if ( Gatsby()->registration->is_registered() ) : ?>
								<span class="dashicons dashicons-yes"></span>
							<?php else : ?>
								<?php $invalid_token = true; ?>
								<span class="dashicons dashicons-no"></span>
							<?php endif; ?>
						<?php else : ?>
							<span class="dashicons dashicons-admin-network"></span>
						<?php endif; ?>
						<input type="text" name="gatsby_registration[token]" value="<?php echo esc_attr( $token ); ?>" />
						<?php submit_button( esc_attr__( 'Submit', 'gatsby' ), array( 'primary', 'large' ) ); ?>
					</form>

					<?php if ( $invalid_token ) : ?>
						<p class="error-invalid-token"><?php esc_attr_e( 'Invalid token, or corresponding Envato account does not have Gatsby purchased.', 'gatsby' ); ?></p>
					<?php endif; ?>

					<?php if ( ! Gatsby()->registration->is_registered() ) : ?>

						<div class="mad-infotext">

							<h3><?php esc_html_e( 'Instructions For Generating A Token', 'gatsby' ); ?></h3>
							<ol>
								<li><?php printf( __( 'Click on this <a href="%s" target="_blank">Generate A Personal Token</a> link. <strong>IMPORTANT:</strong> You must be logged into the same Themeforest account that purchased Gatsby. If you are logged in already, look in the top menu bar to ensure it is the right account. If you are not logged in, you will be directed to login then directed back to the Create A Token Page.', 'gatsby' ), 'https://build.envato.com/create-token/?purchase:download=t&purchase:verify=t&purchase:list=t' ); ?></li>
								<li><?php printf( __( 'Enter a name for your token, then check the boxes for %s and %s from the permissions needed section. Check the box to agree to the terms and conditions, then click the %s', 'gatsby' ), '<strong>View Your Envato Account Username, Download Your Purchased Items, List Purchases You\'ve Made</strong>', '<strong>Verify Purchases You\'ve Made</strong>', '<strong>Create Token button</strong>' ); ?></li>
								<li><?php printf( __( 'A new page will load with a token number in a box. Copy the token number then come back to this registration page and paste it into the field below and click the %s button.', 'gatsby' ), '<strong>Submit</strong>' ); ?></li>
								<li><?php esc_html_e( 'You will see a green check mark for success, or a failure message if something went wrong. If it failed, please make sure you followed the steps above correctly.', 'gatsby' ); ?></li>
							</ol>

						</div>

					<?php endif; ?>

				</div>

			<?php endif; ?>

		</div>

		<div class="mad-thanks">
			<p class="description"><?php esc_html_e( 'Thank you, we hope you to enjoy using Gatsby WordPress Theme!', 'gatsby' ); ?></p>
		</div>

    </div>

</div>