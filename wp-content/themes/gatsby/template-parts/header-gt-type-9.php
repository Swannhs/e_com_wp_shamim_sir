
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

				<nav class="gt-nav-wrap"><?php echo Gatsby_Helper::main_navigation( array('gt-navigation', 'gt-onepage-navigation'), 'onepage' ); ?></nav>

				<!-- - - - - - - - - - - - - - End of Navigation - - - - - - - - - - - - - - - - -->

				<div class="gt-h-elements">

					<?php if ( $gatsby_settings['header-type-9-search'] ): ?>

						<div class="gt-compressed-wrap">

							<form class="gt-lineform gt-compressed" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
								<input type="text" autocomplete="off" name="s" id="s" placeholder="<?php esc_attr_e( 'Search for something', 'gatsby' ) ?>" value="<?php echo get_search_query(); ?>">
								<button class="gt-lineform-btn" type="submit"><span class="lnr lnr-magnifier"></span></button>
							</form>

						</div>

					<?php endif; ?>

				</div><!--/ .gt-h-elements -->

			</div><!--/ .align-right -->

		</div>

	</div><!--/ .gt-t-row -->

</div>

<!-- - - - - - - - - - - - - - End of Header Section - - - - - - - - - - - - - - - - -->