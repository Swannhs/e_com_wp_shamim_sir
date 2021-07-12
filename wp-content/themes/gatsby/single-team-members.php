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

	<div class="gt-team-member gt-single">

		<?php while ( have_posts() ) : the_post(); ?>

			<div class="gt-member-photo">
				<?php the_post_thumbnail( array(470, 350) ); ?>
			</div><!--/ .gt-member-photo-->

			<div class="gt-member-holder">

				<h4 class="gt-member-name"><?php the_title() ?></h4>
				<div class="gt-member-position"><?php echo mad_meta( 'gatsby_tm_position', '', get_the_ID() ) ?></div>

				<?php echo gatsby_team_members_social_links(); ?>

				<p class="gt-member-about">
					<?php gatsby_excerpt(); ?>
				</p>

			</div><!--/ .gt-member-holder-->

			<?php echo apply_filters('the_content', get_the_content()); ?>

		<?php endwhile ?>

	</div><!--/ .gt-single-->

<?php else:

	// If no content, include the "No posts found" template.
	get_template_part( 'template-parts/content', 'none' );

endif; ?>

<?php get_footer(); ?>