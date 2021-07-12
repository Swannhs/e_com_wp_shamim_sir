<?php
/**
 * The template for displaying single testimonials.
 *
 * @package WordPress
 * @subpackage Gatsby
 * @since Gatsby 1.0
 */
get_header(); ?>

<?php if ( have_posts() ): ?>

	<?php
	$position = mad_meta( 'gatsby_tm_position', '' );
	$company = mad_meta( 'gatsby_tm_company', '' );
	?>

	<div class="template-single">

		<?php while ( have_posts() ) : the_post(); ?>

			<div class="row">

				<!-- - - - - - - - - - - - - - Employee's Photo - - - - - - - - - - - - - - - - -->

				<div class="col-sm-1">

					<div class="post-thumbnail">
						<?php the_post_thumbnail( array(360, 360) ); ?>
					</div><!-- .post-thumbnail -->

				</div>

				<!-- - - - - - - - - - - - - - End of Employee's Photo - - - - - - - - - - - - - - - - -->

				<!-- - - - - - - - - - - - - - Employee's Information - - - - - - - - - - - - - - - - -->

				<div class="col-sm-11">

					<h4 class="single-title"><?php the_title() ?></h4>

					<?php if ( isset($position) && !empty($position) ): ?>
						<span class="gt-author-position"><?php echo esc_html( mad_meta( 'gatsby_tm_position', '' )) ?></span>
					<?php endif; ?>

					<?php if ( isset($company) && !empty($company) ): ?>
						<span class="gt-author-company"><?php echo esc_html( mad_meta( 'gatsby_tm_company', '' )) ?></span>
					<?php endif; ?>

					<?php gatsby_excerpt(); ?>

				</div>

				<!-- - - - - - - - - - - - - - End of Employee's Information - - - - - - - - - - - - - - - - -->

			</div><!--/ .row -->

			<div class="entry-content">
				<?php echo the_content(); ?>
			</div>

		<?php endwhile ?>

	</div><!--/ .template-single-->

<?php else:

	// If no content, include the "No posts found" template.
	get_template_part( 'template-parts/content', 'none' );

endif; ?>

<?php get_footer(); ?>