<?php
/**
 * The template for displaying all single portfolios
 *
 * @package WordPress
 * @subpackage Gatsby
 * @since Gatsby 1.0
 */

global $gatsby_settings;
$post_id = gatsby_post_id();
$categories = get_the_term_list( $post_id, 'portfolio_categories', '', ', ','' );
$link_to_website = mad_meta('gatsby_visit_to_website', '', $post_id);
$related_items = mad_meta('gatsby_related_items', '', $post_id);

get_header();  ?>

<?php if ( have_posts() ): ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<div class="gt-content-element">

			<article id="post-<?php the_ID(); ?>" <?php post_class() ?>>

				<div class="gt-project gt-single">

					<div class="gt-project-content">
						<?php the_content(); ?>
					</div>

					<!-- - - - - - - - - - - - - - Project Description - - - - - - - - - - - - - - - - -->

					<div class="gt-project-description">

						<!-- - - - - - - - - - - - - - Project Meta - - - - - - - - - - - - - - - - -->

						<div class="gt-project-meta">

							<?php
							$time_string = '<time class="gt-project-date" datetime="%1$s"><span class="lnr lnr-calendar-full"></span>%2$s</time>';
							$time_string = sprintf( $time_string,
								esc_attr( get_the_date( 'c' ) ),
								get_the_date('F j, Y')
							);

							printf( '%1$s', $time_string );
							?>

							<?php if ( !empty($categories) ): ?>
								<ul class="gt-project-cats">
									<?php echo get_the_term_list($post_id, 'portfolio_categories', '', ', ','') ?>
								</ul>
							<?php endif; ?>

						</div>

						<!-- - - - - - - - - - - - - - End of Project Meta - - - - - - - - - - - - - - - - -->

						<?php if ( $gatsby_settings['portfolio-excerpt'] ): ?>

							<?php if ( has_excerpt($post_id) ): ?>
								<p><?php echo get_the_excerpt() ?></p>
							<?php endif; ?>

						<?php endif; ?>

					</div>

					<!-- - - - - - - - - - - - - - End of Project Description - - - - - - - - - - - - - - - - -->

					<footer class="gt-project-footer">

						<?php if ( isset($link_to_website) && !empty($link_to_website) ): ?>
							<a href="<?php echo esc_url($link_to_website) ?>" target="_blank" class="gt-btn-3 gt-large"><?php esc_html_e('Launch The Project', 'gatsby') ?></a>
						<?php endif; ?>

						<?php if ( $gatsby_settings['portfolio-share'] ): ?>
							<div class="gt-entry-meta-item">
								<?php get_template_part( 'template-parts/content', 'share' ); ?>
							</div><!--/ .gt-entry-meta-item -->
						<?php endif; ?>

					</footer>

				</div>

			</article>

		</div>

		<?php if ( $gatsby_settings['portfolio-related'] && !$related_items ) : ?>

			<div class="gt-content-element">
				<?php
					$related_portfolio = new Gatsby_Portfolio_Related(get_the_ID(), array(
						'title' => $gatsby_settings['portfolio-related-title'],
						'posts_per_page' => $gatsby_settings['portfolio-related-count'],
						'orderby' => $gatsby_settings['portfolio-related-orderby']
					));
					if ( !empty($related_portfolio))
						echo $related_portfolio->output();
				?>
			</div>

		<?php endif ?>

	<?php endwhile ?>

<?php endif;

get_footer();  ?>