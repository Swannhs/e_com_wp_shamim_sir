<?php
global $gatsby_settings;
$result = Gatsby_Widgets_Meta_Box::get_page_settings(gatsby_post_id());
extract($result);
?>

<div class="container">

<?php if ( $footer_row_top_show ): ?>

	<div class="gt-fs-top">

		<div class="row">

			<?php if ( !empty($footer_row_top_columns_variations) ):
				$number_of_top_columns = key( json_decode( html_entity_decode ( $footer_row_top_columns_variations ), true ) );
				$columns_top_array = json_decode( html_entity_decode ( $footer_row_top_columns_variations ), true );
				?>

				<?php for ( $i = 1; $i <= $number_of_top_columns; $i++ ): ?>

				<div class="col-sm-<?php echo esc_attr($columns_top_array[$number_of_top_columns][0][$i-1]); ?>">
					<?php if ( !dynamic_sidebar($get_sidebars_top_widgets[$i-1]) ) : endif; ?>
				</div>

			<?php endfor; ?>

			<?php endif; ?>

		</div><!--/ .row-->

	</div><!--/ .gt-fs-top-->

<?php endif; ?>

<?php if ( $footer_row_middle_show ): ?>

	<div class="gt-fs-medium">

		<div class="row">

			<?php if ( !empty($footer_row_middle_columns_variations) ):
				$number_of_middle_columns = key( json_decode( html_entity_decode ( $footer_row_middle_columns_variations ), true ) );
				$columns_middle_array = json_decode( html_entity_decode ( $footer_row_middle_columns_variations ), true );
				?>

				<?php for ( $i = 1; $i <= $number_of_middle_columns; $i++ ): ?>

					<div class="col-sm-<?php echo esc_attr($columns_middle_array[$number_of_middle_columns][0][$i-1]); ?>">
						<?php if ( !dynamic_sidebar($get_sidebars_middle_widgets[$i-1]) ) : endif; ?>
					</div>

				<?php endfor; ?>

			<?php endif; ?>

		</div><!--/ .row-->

	</div><!--/ .gt-fs-medium-->

	<div class="gt-fs-small gt-copyright">

		<div class="gt-t-row">

			<div class="col-sm-9">

				<?php if ( $gatsby_settings['show-footer-menu'] ): ?>
					<?php echo Gatsby_Helper::main_navigation( 'gt-hr-list', 'footer' ); ?>
				<?php endif; ?>

			</div>

			<div class="col-sm-3">

				<ul class="gt-social-icons align-right">

					<?php if ( $gatsby_settings['show-footer-socials'] ): ?>

						<?php if ( $gatsby_settings['footer-social-linkedin'] ): ?>
							<li><a target="_blank" href="<?php echo esc_url($gatsby_settings['footer-social-linkedin']) ?>"><i class="fa fa-linkedin"></i></a></li>
						<?php endif; ?>

						<?php if ( $gatsby_settings['footer-social-tumblr'] ): ?>
							<li><a href="<?php echo esc_url($gatsby_settings['footer-social-tumblr']) ?>"><i class="fa fa-tumblr"></i></a></li>
						<?php endif; ?>

						<?php if ( $gatsby_settings['footer-social-vimeo'] ): ?>
							<li><a target="_blank" href="<?php echo esc_url($gatsby_settings['footer-social-vimeo']) ?>"><i class="fa fa-vimeo"></i></a></li>
						<?php endif; ?>

						<?php if ( $gatsby_settings['footer-social-facebook'] ): ?>
							<li><a target="_blank" href="<?php echo esc_url($gatsby_settings['footer-social-facebook']) ?>"><i class="fa fa-facebook"></i></a></li>
						<?php endif; ?>

						<?php if ( $gatsby_settings['footer-social-flickr'] ): ?>
							<li><a target="_blank" href="<?php echo esc_url($gatsby_settings['footer-social-flickr']) ?>"><i class="fa fa-flickr"></i></a></li>
						<?php endif; ?>

					<?php endif; ?>

				</ul>

			</div>

		</div><!--/ .gt-t-row -->

	</div>

<?php endif; ?>

<?php $hide_footer = absint(mad_meta('gatsby_hide_footer')); ?>

<?php if ( !$footer_row_top_show && !$footer_row_middle_show && !$hide_footer ): ?>

	<!-- - - - - - - - - - - - - - Footer Section - - - - - - - - - - - - - - - - -->

	<div class="gt-fs-medium">

		<div class="row gt-t-row-md">

			<div class="col-md-3">
				<?php echo gatsby_footer_logo(); ?>
			</div>

			<div class="col-md-6">

				<nav class="align-center">
					<?php echo Gatsby_Helper::main_navigation( 'gt-sub-nav', 'footer' ); ?>
				</nav>

			</div>

			<div class="col-md-3">

				<ul class="gt-social-icons align-right">

					<?php if ( $gatsby_settings['show-footer-socials'] ): ?>

						<?php if ( $gatsby_settings['footer-social-linkedin'] ): ?>
							<li><a target="_blank" href="<?php echo esc_url($gatsby_settings['footer-social-linkedin']) ?>"><i class="fa fa-linkedin"></i></a></li>
						<?php endif; ?>

						<?php if ( $gatsby_settings['footer-social-tumblr'] ): ?>
							<li><a target="_blank" href="<?php echo esc_url($gatsby_settings['footer-social-tumblr']) ?>"><i class="fa fa-tumblr"></i></a></li>
						<?php endif; ?>

						<?php if ( $gatsby_settings['footer-social-vimeo'] ): ?>
							<li><a target="_blank" href="<?php echo esc_url($gatsby_settings['footer-social-vimeo']) ?>"><i class="fa fa-vimeo"></i></a></li>
						<?php endif; ?>

						<?php if ( $gatsby_settings['footer-social-facebook'] ): ?>
							<li><a target="_blank" href="<?php echo esc_url($gatsby_settings['footer-social-facebook']) ?>"><i class="fa fa-facebook"></i></a></li>
						<?php endif; ?>

						<?php if ( $gatsby_settings['footer-social-flickr'] ): ?>
							<li><a target="_blank" href="<?php echo esc_url($gatsby_settings['footer-social-flickr']) ?>"><i class="fa fa-flickr"></i></a></li>
						<?php endif; ?>

					<?php endif; ?>

				</ul>

			</div>

		</div><!--/ .gt-t-row-lg -->

	</div>

	<!-- - - - - - - - - - - - - - End of Footer Section - - - - - - - - - - - - - - - - -->

	<?php if ( !empty($gatsby_settings['footer-copyright']) ): ?>

		<!-- - - - - - - - - - - - - - Footer Section - - - - - - - - - - - - - - - - -->

		<div class="gt-fs-small gt-copyright align-center">

			<div class="row">

				<div class="col-xs-12">
					<?php echo force_balance_tags($gatsby_settings['footer-copyright']); ?>
				</div>

			</div><!--/ .row -->

		</div>

		<!-- - - - - - - - - - - - - - End of Footer Section - - - - - - - - - - - - - - - - -->

	<?php endif; ?>

<?php endif; ?>

</div><!--/ .container-->

<?php if ( $hide_footer ): ?>

	<div class="gt-fs-bottom">

		<div class="row gt-t-row-md">

			<div class="col-md-9">

				<?php echo force_balance_tags($gatsby_settings['footer-copyright']); ?>

			</div>

			<div class="col-md-3">

				<ul class="gt-social-icons align-right">

					<?php if ( $gatsby_settings['show-footer-socials'] ): ?>

						<?php if ( $gatsby_settings['footer-social-linkedin'] ): ?>
							<li><a target="_blank" href="<?php echo esc_url($gatsby_settings['footer-social-linkedin']) ?>"><i class="fa fa-linkedin"></i></a></li>
						<?php endif; ?>

						<?php if ( $gatsby_settings['footer-social-tumblr'] ): ?>
							<li><a target="_blank" href="<?php echo esc_url($gatsby_settings['footer-social-tumblr']) ?>"><i class="fa fa-tumblr"></i></a></li>
						<?php endif; ?>

						<?php if ( $gatsby_settings['footer-social-vimeo'] ): ?>
							<li><a target="_blank" href="<?php echo esc_url($gatsby_settings['footer-social-vimeo']) ?>"><i class="fa fa-vimeo"></i></a></li>
						<?php endif; ?>

						<?php if ( $gatsby_settings['footer-social-facebook'] ): ?>
							<li><a target="_blank" href="<?php echo esc_url($gatsby_settings['footer-social-facebook']) ?>"><i class="fa fa-facebook"></i></a></li>
						<?php endif; ?>

						<?php if ( $gatsby_settings['footer-social-flickr'] ): ?>
							<li><a target="_blank" href="<?php echo esc_url($gatsby_settings['footer-social-flickr']) ?>"><i class="fa fa-flickr"></i></a></li>
						<?php endif; ?>

					<?php endif; ?>

				</ul>

			</div>

		</div><!--/ .gt-t-row-lg -->

	</div>

<?php endif; ?>
