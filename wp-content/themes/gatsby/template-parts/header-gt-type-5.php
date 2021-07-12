<!-- - - - - - - - - - - - - - Header Top Bar - - - - - - - - - - - - - - - - -->

<?php echo gatsby_header_top_bar(); ?>


<!-- - - - - - - - - - - - - - End of Header Top Bar - - - - - - - - - - - - - - - - -->

<!-- - - - - - - - - - - - - - Header Section - - - - - - - - - - - - - - - - -->

<div class="gt-hs-medium">

	<div class="container">

		<div class="gt-t-row">

			<div class="col-sm-2">

				<!-- - - - - - - - - - - - - - Logo - - - - - - - - - - - - - - - - -->

				<?php echo gatsby_logo(); ?>

				<!-- - - - - - - - - - - - - - End of Logo - - - - - - - - - - - - - - - - -->

			</div>

			<div class="col-lg-5 col-sm-3">

				<!-- - - - - - - - - - - - - - Searchform - - - - - - - - - - - - - - - - -->

				<form role="search" method="get" class="gt-lineform" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
					<input type="search" placeholder="<?php echo esc_html_e( 'Search for products', 'gatsby' ); ?>" value="<?php echo get_search_query(); ?>" name="s">
					<button class="gt-lineform-btn" type="submit"><span class="lnr lnr-magnifier"></span></button>
					<input type="hidden" name="post_type" value="product" />
				</form>

				<!-- - - - - - - - - - - - - - End of Searchform - - - - - - - - - - - - - - - - -->

			</div>

			<div class="col-lg-5 col-sm-7">

				<div class="gt-h-elements align-right">

					<nav>
						<ul class="gt-hr-list">

							<?php if ( gatsby_is_shop_installed() ): ?>

								<li><a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>"><span class="lnr lnr-user"></span> <?php esc_html_e('My Account', 'gatsby') ?></a></li>

							<?php else: ?>

								<?php if ( is_user_logged_in() ): ?>

									<li><a href="<?php echo get_edit_user_link(); ?>"><span class="lnr lnr-user"></span> <?php esc_html_e('My Account', 'gatsby') ?></a></li>

								<?php else: ?>

									<li><a href="<?php echo esc_url(wp_login_url()); ?>"><span class="lnr lnr-user"></span> <?php esc_html_e('My Account', 'gatsby') ?></a></li>

								<?php endif; ?>

							<?php endif; ?>

						</ul>
					</nav>

					<?php if ( defined('Gatsby_Woo_Config') ): ?>

						<!-- - - - - - - - - - - - - - Shopping Cart - - - - - - - - - - - - - - - - -->

						<div class="gt-sc-widget">

							<button class="gt-sc-invoker gt-dropdown-invoker"><span class="lnr lnr-cart" data-amount="<?php echo absint(count( WC()->cart->get_cart() )); ?>"></span></button>

							<div class="gt-shopping-cart gt-dropdown">
								<div class="widget_shopping_cart_content"></div>
							</div><!--/ .gt-shopping-cart -->

						</div>

						<!-- - - - - - - - - - - - - - End of Shopping Cart - - - - - - - - - - - - - - - - -->

					<?php endif; ?>

				</div><!--/ .h-elements.align-right -->

			</div>

		</div><!--/ .t-row -->

	</div><!--/ .container -->

</div>

<!-- - - - - - - - - - - - - - End of Header Section - - - - - - - - - - - - - - - - -->

<!-- - - - - - - - - - - - - - Header Section - - - - - - - - - - - - - - - - -->

<div class="gt-hs-small gt-sticky">

	<div class="container">

		<!-- - - - - - - - - - - - - - Navigation - - - - - - - - - - - - - - - - -->

		<nav class="gt-nav-wrap">

			<?php echo Gatsby_Helper::main_navigation(array(
				'gt-navigation', 'gt-overlined'
			)); ?>

		</nav>

		<!-- - - - - - - - - - - - - - End of Navigation - - - - - - - - - - - - - - - - -->

	</div><!--/ .container -->

</div><!--/ .gt-sticky -->

<!-- - - - - - - - - - - - - - End of Header Section - - - - - - - - - - - - - - - - -->