<!-- - - - - - - - - - - - - - Header Section - - - - - - - - - - - - - - - - -->

<?php global $gatsby_settings; ?>

<div class="gt-hs-medium">

	<div class="container">

		<div class="gt-t-row">

			<div class="col-sm-4">

				<div class="align-left">

					<?php if ( $gatsby_settings['header-type-4-search'] ): ?>

						<form role="search" method="get" class="gt-lineform gt-small" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
							<input type="search" placeholder="<?php echo esc_html_e( 'Search for products', 'gatsby' ); ?>" value="<?php echo get_search_query(); ?>" name="s">
							<button class="gt-lineform-btn" type="submit"><span class="lnr lnr-magnifier"></span></button>
							<input type="hidden" name="post_type" value="product" />
						</form>

					<?php endif; ?>

				</div><!--/ .align-left -->

			</div>

			<div class="col-sm-4">

				<div class="align-center">

					<!-- - - - - - - - - - - - - - Logo - - - - - - - - - - - - - - - - -->

					<?php echo gatsby_logo(); ?>

					<!-- - - - - - - - - - - - - - End of Logo - - - - - - - - - - - - - - - - -->

				</div><!--/ .align-center -->

			</div>

			<div class="col-sm-4">

				<div class="gt-h-elements align-right">

					<?php if ( $gatsby_settings['header-type-4-cart'] ): ?>

						<?php if ( defined('Gatsby_Woo_Config') ): ?>

							<div class="gt-sc-widget">
								<button class="gt-sc-invoker gt-dropdown-invoker">
									<span class="lnr lnr-cart" data-amount="<?php echo esc_attr(count( WC()->cart->get_cart() )); ?>"></span>
									<span class="gt-price"><?php wc_cart_totals_subtotal_html(); ?></span>
								</button>
								<div class="gt-shopping-cart gt-dropdown">
									<div class="widget_shopping_cart_content"></div>
								</div><!--/ .gt-shopping-cart -->
							</div>

						<?php endif; ?>

					<?php endif; ?>

				</div><!--/ .h-elements.align-right -->

			</div>

		</div><!--/ .t-row -->

	</div><!--/ .container -->

</div>

<!-- - - - - - - - - - - - - - End of Header Section - - - - - - - - - - - - - - - - -->

<!-- - - - - - - - - - - - - - Header Section - - - - - - - - - - - - - - - - -->

<div class="gt-hs-small gt-sticky">

	<!-- - - - - - - - - - - - - - Navigation - - - - - - - - - - - - - - - - -->

	<nav class="gt-nav-wrap align-center">

		<?php echo Gatsby_Helper::main_navigation(array(
			'gt-navigation', 'gt-underlined'
		)); ?>

	</nav>

	<!-- - - - - - - - - - - - - - End of Navigation - - - - - - - - - - - - - - - - -->

</div><!--/ .gt-sticky -->

<!-- - - - - - - - - - - - - - End of Header Section - - - - - - - - - - - - - - - - -->