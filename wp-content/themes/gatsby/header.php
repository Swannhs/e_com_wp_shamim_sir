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

</head>

<?php
global $gatsby_config;
$page_wrapper = $gatsby_config['page_wrapper'];
$header_classes = $gatsby_config['header_classes'];
$header_type = $gatsby_config['header_type'];
$sidebar_position = $gatsby_config['sidebar_position'];
$page_content_classes = $gatsby_config['page_content_classes'];
?>

<body <?php body_class(); ?>>

<?php do_action('gatsby_body_append'); ?>

<div class="<?php echo esc_attr($page_wrapper) ?>">

	<div class="gt-header-wrap">

		<?php do_action('gatsby_header_prepend') ?>

		<!-- - - - - - - - - - - - - - Header - - - - - - - - - - - - - - - - -->

		<header id="header" class="gt-header <?php echo esc_attr($header_classes); ?>">
			<?php do_action( 'gatsby_header_layout', $header_type ); ?>
		</header><!--/ #header -->

		<!-- - - - - - - - - - - - - - / Header - - - - - - - - - - - - - - -->

		<?php do_action('gatsby_header_append') ?>

	</div><!--/ .gt-header-wrap-->

	<?php
		/**
		 * gatsby_header_after hook
		 *
		 * @hooked page_title_and_breadcrumbs
		 */

		do_action('gatsby_header_after');
	?>

	<!-- - - - - - - - - - - - - Page Content - - - - - - - - - - - - - -->

	<div class="<?php echo esc_attr($page_content_classes) ?>">

		<?php if ( $sidebar_position != 'gt-no-sidebar' ): ?>

			<div class="container">

				<div class="row">

					<main id="main" class="col-md-9 col-sm-8">

		<?php else: ?>

			<div class="container">

				<div class="row">

					<div class="col-sm-12">

		<?php endif; ?>