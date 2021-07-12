<!-- - - - - - - - - - - - - - Header Section - - - - - - - - - - - - - - - - -->

<div class="gt-hs-medium gt-sticky">

	<div class="gt-t-row-md">

		<div class="col-lg-3 col-md-2">

			<!-- - - - - - - - - - - - - - Logo - - - - - - - - - - - - - - - - -->

			<?php echo gatsby_logo(); ?>

			<!-- - - - - - - - - - - - - - End of Logo - - - - - - - - - - - - - - - - -->

		</div>

		<div class="col-lg-6 col-md-8">

			<div class="align-center">

				<!-- - - - - - - - - - - - - - Navigation - - - - - - - - - - - - - - - - -->

				<nav class="gt-nav-wrap">
					<?php echo Gatsby_Helper::main_navigation(array(
						'gt-navigation', 'gt-animated-nav', 'gt-nav-hidden'
					)); ?>
				</nav>

				<!-- - - - - - - - - - - - - - End of Navigation - - - - - - - - - - - - - - - - -->

			</div><!--/ .align-center -->

		</div>

		<div class="col-md-2">

			<div class="gt-h-elements align-right">

				<nav>
					<ul class="gt-sub-nav">

						<?php if ( gatsby_is_shop_installed() ): ?>

							<?php $accountPage = get_permalink(get_option('woocommerce_myaccount_page_id')); ?>

							<?php if ( is_user_logged_in() ): ?>

								<li><a href="<?php echo esc_url($accountPage); ?>"><?php echo esc_html(gatsby_get_user_name(wp_get_current_user())) ?></a></li>

							<?php else: ?>

								<li><a href="<?php echo esc_url($accountPage); ?>"><?php esc_html_e('Sign In', 'gatsby') ?></a></li>
								<li><a href="<?php echo esc_url($accountPage); ?>"><?php esc_html_e('Sign Up', 'gatsby') ?></a></li>

							<?php endif; ?>

						<?php else: ?>

							<?php if ( is_user_logged_in() ): ?>

								<li><a href="<?php echo get_edit_user_link(); ?>"><?php echo esc_html(gatsby_get_user_name(wp_get_current_user())) ?></a></li>

							<?php else: ?>

								<li><a href="<?php echo esc_url(wp_login_url()); ?>"><?php esc_html_e('Sign In', 'gatsby') ?></a></li>

								<?php if ( get_option('users_can_register') ) : ?>
									<li><a href="<?php echo esc_url( wp_registration_url() ); ?>"><?php esc_html_e('Sign Up', 'gatsby') ?></a></li>
								<?php endif; ?>

							<?php endif; ?>

						<?php endif; ?>

					</ul>
				</nav>

				<a href="javascript:void(0)" class="gt-toggle-nav"><span class="lnr lnr-menu"></span></a>

			</div><!--/ .gt-h-elements.align-right -->

		</div>

	</div><!--/ .gt-t-row-md -->

</div><!--/ .gt-sticky -->

<!-- - - - - - - - - - - - - - End of Header Section - - - - - - - - - - - - - - - - -->