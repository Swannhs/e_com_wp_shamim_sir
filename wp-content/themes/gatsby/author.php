<?php
/**
 * The template for displaying Author archive pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Gatsby
 * @since Gatsby 1.0
 */
get_header(); ?>

<?php if ( have_posts() ) : ?>

	<div class="gt-content-element">
		<?php get_template_part( 'template-parts/single', 'author-box' ); ?>
	</div>

	<?php
	global $gatsby_settings;
	$wrapper_attributes = array();

	$css_classes = array(
		'gt-entries-holder', 'gt-type-4', 'gt-cols-1'
	);

	$css_classes[] = $gatsby_settings['post-archive-style'];

	$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
	$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
	?>

	<div <?php echo implode( ' ', $wrapper_attributes ) ?>>

		<div class="gt-container gt-cols-1">

			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/loop', 'index' );
			endwhile;
			?>

		</div><!--/ .gt-container-->

		<?php
		// Previous/next page navigation.
		the_posts_pagination( array(
			'prev_text'          => '',
			'next_text'          => '',
			'before_page_number' => '',
			'screen_reader_text' => ''
		) );
		?>

	</div><!--/ .gt-entries-holder-->

<?php else:

	// If no content, include the "No posts found" template.
	get_template_part( 'template-parts/content', 'none' );

endif; ?>

<?php get_footer(); ?>