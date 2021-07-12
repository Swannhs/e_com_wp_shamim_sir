
<?php global $gatsby_settings; ?>

<!-- - - - - - - - - - - - - - Header Section - - - - - - - - - - - - - - - - -->

<div class="gt-hs-medium">

	<div class="gt-t-row">

		<div class="col-sm-2">

			<!-- - - - - - - - - - - - - - Logo - - - - - - - - - - - - - - - - -->

			<?php echo gatsby_logo(); ?>

			<!-- - - - - - - - - - - - - - End of Logo - - - - - - - - - - - - - - - - -->

		</div>

		<div class="col-sm-10">

			<div class="align-right">

				<!-- - - - - - - - - - - - - - Navigation - - - - - - - - - - - - - - - - -->

				<nav class="gt-nav-wrap"><?php echo Gatsby_Helper::main_navigation(); ?></nav>

				<!-- - - - - - - - - - - - - - End of Navigation - - - - - - - - - - - - - - - - -->

				<div class="gt-h-elements">

					<?php if ( $gatsby_settings['header-type-8-search'] ): ?>

						<div class="gt-compressed-wrap">

							<form class="gt-lineform gt-compressed" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
								<input type="text" autocomplete="off" name="s" id="s" placeholder="<?php esc_attr_e( 'Search for something', 'gatsby' ) ?>" value="<?php echo get_search_query(); ?>">
								<button class="gt-lineform-btn" type="submit"><span class="lnr lnr-magnifier"></span></button>
							</form>

						</div>

					<?php endif; ?>

					<?php if ( $gatsby_settings['header-type-8-cart'] ): ?>

						<?php if ( defined('Gatsby_Woo_Config') ): ?>

							<div class="gt-sc-widget">
								<button class="gt-sc-invoker gt-dropdown-invoker"><span class="lnr lnr-cart" data-amount="<?php echo esc_attr(count( WC()->cart->get_cart() )); ?>"></span></button>
								<div class="gt-shopping-cart gt-dropdown">
									<div class="widget_shopping_cart_content"></div>
								</div><!--/ .gt-shopping-cart -->
							</div>

						<?php endif; ?>

					<?php endif; ?>

				</div><!--/ .gt-h-elements -->

			</div><!--/ .align-right -->

		</div>

	</div><!--/ .gt-t-row -->

</div>

<!-- - - - - - - - - - - - - - End of Header Section - - - - - - - - - - - - - - - - -->