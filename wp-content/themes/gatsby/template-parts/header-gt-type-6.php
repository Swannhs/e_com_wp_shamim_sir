<!-- - - - - - - - - - - - - - Header Section - - - - - - - - - - - - - - - - -->

<?php

global $gatsby_settings;

$menu_align = $gatsby_settings['menu-type-6-align'];
$menu_align_meta = mad_meta('gatsby_header_type_6_alignment');

if ( !empty($menu_align_meta) ) {
	$menu_align = $menu_align_meta;
}

?>

<div class="gt-hs-medium gt-sticky">

	<div class="gt-t-row">

		<div class="col-sm-1">

			<!-- - - - - - - - - - - - - - Logo - - - - - - - - - - - - - - - - -->

			<?php echo gatsby_logo(); ?>

			<!-- - - - - - - - - - - - - - End of Logo - - - - - - - - - - - - - - - - -->

		</div>

		<div class="col-md-9 col-sm-6">

			<div class="gt-h-elements <?php echo sanitize_html_class($menu_align) ?>">

				<!-- - - - - - - - - - - - - - Navigation - - - - - - - - - - - - - - - - -->

				<nav class="gt-nav-wrap">
					<?php echo Gatsby_Helper::main_navigation(); ?>
				</nav>

				<!-- - - - - - - - - - - - - - End of Navigation - - - - - - - - - - - - - - - - -->

			</div><!--/ .gt-h-elements.align-right -->

		</div>

		<div class="col-md-2 col-sm-5">

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

</div>

<!-- - - - - - - - - - - - - - End of Header Section - - - - - - - - - - - - - - - - -->