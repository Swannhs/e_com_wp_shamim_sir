<!DOCTYPE html>
<!--[if (gte IE 9)|!(IE)]><!--> <html class="not-ie no-js" <?php language_attributes(); ?>>  <!--<![endif]-->
<head>

	<!-- Basic Page Needs
    ==================================================== -->
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<!-- Mobile Specific Metas
	==================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php wp_head(); ?>

	<?php global $gatsby_settings; ?>

</head>

<body <?php body_class(); ?>>

<div class="gt-fullscreen-layout-type gt-dim-section">

	<div class="gt-fullscreen-overlay" data-gatsby-bg="<?php echo esc_url($gatsby_settings['error-image']['url']) ?>"></div>

	<header id="header" class="gt-header">

		<!-- - - - - - - - - - - - - - Header Section - - - - - - - - - - - - - - - - -->

		<div class="gt-hs-large">

			<div class="align-center">
				<?php echo gatsby_logo(); ?>
			</div><!--/ .align-center -->

		</div>

		<!-- - - - - - - - - - - - - - End of Header Section - - - - - - - - - - - - - - - - -->

	</header>

	<!-- - - - - - - - - - - - - Page Content - - - - - - - - - - - - - -->

	<div class="gt-page-content-wrap gt-no-sidebar">

		<div class="container">

			<div class="row">

				<div class="col-sm-12">
