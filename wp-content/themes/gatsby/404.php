<?php get_header('404'); ?>

<?php global $gatsby_settings;
$error_type = $gatsby_settings['error-type'];
$error_content = $gatsby_settings['error-content'];
?>

<div class="gt-404-section">

	<?php if ( $error_type == 'type-1' ): ?>

		<h1><?php esc_html_e('Error 404', 'gatsby') ?><br><?php esc_html_e('Page Not Found', 'gatsby') ?></h1>

		<p><?php echo html_entity_decode($error_content); ?></p>

		<a href="javascript:history.go(-1)" class="gt-btn gt-large"><?php esc_html_e('Go to Previous Page', 'gatsby') ?></a>

	<?php elseif ( $error_type == 'type-2' ): ?>

		<p><?php esc_html_e('Oooops! Page not found!', 'gatsby') ?></p>

		<img class="gt-404" src="<?php echo esc_url($gatsby_settings['error-image-text']['url']) ?>" alt="">

		<p><?php echo html_entity_decode($error_content); ?></p>

		<a href="javascript:history.go(-1)" class="gt-link-underline"><?php esc_html_e('Go to Previous Page', 'gatsby') ?></a>

	<?php elseif ( $error_type == 'type-3' ): ?>

		<h1><?php esc_html_e('Sir, there\'s nothing here.', 'gatsby') ?></h1>

		<p><?php echo html_entity_decode($error_content); ?></p>

		<!-- - - - - - - - - - - - - - Searchform - - - - - - - - - - - - - - - - -->

		<form novalidate class="gt-lineform gt-searchform" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<input type="search" autocomplete="off" name="s" id="s" placeholder="<?php esc_attr_e( 'Search for it', 'gatsby' ) ?>" value="<?php echo get_search_query(); ?>">
			<button class="gt-lineform-btn" type="submit"><span class="lnr lnr-magnifier"></span></button>
		</form>

		<!-- - - - - - - - - - - - - - End of Searchform - - - - - - - - - - - - - - - - -->

	<?php endif; ?>

</div>

<?php get_footer('404'); ?>