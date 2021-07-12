<!-- - - - - - - - - - - - - - Header Top Bar - - - - - - - - - - - - - - - - -->

<?php echo gatsby_header_top_bar_light(); ?>

<!-- - - - - - - - - - - - - - End of Header Top Bar - - - - - - - - - - - - - - - - -->

<!-- - - - - - - - - - - - - - Header Section - - - - - - - - - - - - - - - - -->

<?php global $gatsby_settings; ?>

<div class="gt-hs-medium">

	<div class="gt-t-row-md">

		<div class="col-md-2">

			<!-- - - - - - - - - - - - - - Logo - - - - - - - - - - - - - - - - -->

			<?php echo gatsby_logo(); ?>

			<!-- - - - - - - - - - - - - - End of Logo - - - - - - - - - - - - - - - - -->

		</div>

		<div class="col-md-8">

			<!-- - - - - - - - - - - - - - Navigation - - - - - - - - - - - - - - - - -->

			<nav class="gt-nav-wrap align-center">
				<?php echo Gatsby_Helper::main_navigation(array(
					'gt-navigation', 'gt-underlined'
				)); ?>
			</nav>

			<!-- - - - - - - - - - - - - - End of Navigation - - - - - - - - - - - - - - - - -->

		</div>

		<div class="col-md-2">

			<div class="gt-h-elements align-right">

				<?php if ( $gatsby_settings['header-type-2-search'] ): ?>

					<div class="gt-compressed-wrap gt-over">

						<form class="gt-lineform gt-compressed" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
							<input type="text" autocomplete="off" name="s" id="s" placeholder="<?php esc_attr_e( 'Search for something', 'gatsby' ) ?>" value="<?php echo get_search_query(); ?>">
							<button class="gt-lineform-btn" type="submit"><span class="lnr lnr-magnifier"></span></button>
						</form>

					</div>

				<?php endif; ?>

				<?php if ( $gatsby_settings['header-type-2-cart'] ): ?>

					<?php if ( defined('Gatsby_Woo_Config') ): ?>

						<div class="gt-sc-widget">
							<button class="gt-sc-invoker gt-dropdown-invoker"><span class="lnr lnr-cart" data-amount="<?php echo esc_attr(count( WC()->cart->get_cart() )); ?>"></span></button>
							<div class="gt-shopping-cart gt-dropdown">
								<div class="widget_shopping_cart_content"></div>
							</div><!--/ .gt-shopping-cart -->
						</div>

					<?php endif; ?>

				<?php endif; ?>

				<?php if ( $gatsby_settings['header-type-2-aside-btn'] ): ?>
					<a class="float-aside-btn" href="javascript:void(0)"></a>
				<?php endif; ?>

			</div><!--/ .gt-h-elements.align-right -->

		</div>

	</div><!--/ .gt-t-row-md -->

</div><!--/ .gt-stikcy -->

<!-- - - - - - - - - - - - - - End of Header Section - - - - - - - - - - - - - - - - -->