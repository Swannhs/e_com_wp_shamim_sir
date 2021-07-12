<?php
/**
 * The template for displaying Team Members Archive area.
 */

get_header(); ?>

<?php if ( have_posts() ): ?>

	<?php
	global $gatsby_settings;

	$layout = $gatsby_settings['team-members-archive-layout'];
	$columns = $gatsby_settings['team-members-archive-columns'];
	$excerpt_count = $gatsby_settings['team-member-excerpt-count'];
	$desc_pos = $gatsby_settings['team-members-archive-position-desc'];

	$css_classes = array(
		'gt-team-holder', $layout,
		'gt-cols-' . absint($columns),
		'gt-' . $desc_pos,
		'gt-paginate-pagination'
	);

	switch ( $layout ):
		case 'gt-type-1': $image_size = '330*330'; break;
		case 'gt-type-2': $image_size = '270*330'; break;
		default: 		  $image_size = '330*330'; break;
	endswitch;

	$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
	$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
	?>

	<div <?php echo implode( ' ', $wrapper_attributes ) ?>>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php
				$id = get_the_ID();
				$name = get_the_title();
				$link  = get_permalink();
				$position = mad_meta('gatsby_tm_position', '', $id);
				$content = has_excerpt() ? get_the_excerpt() : get_the_content();
				$thumbnail_atts = array(
					'alt'	=> trim(strip_tags(get_the_title()))
				);
				$content = gatsby_get_excerpt( $content, $excerpt_count );

			?>

			<div class="gt-team-member">

				<!-- - - - - - - - - - - - - - Member Photo - - - - - - - - - - - - - - - - -->

				<?php if ( has_post_thumbnail($id) ): ?>

					<div class="gt-member-photo">
						<a href="<?php echo esc_url($link); ?>" class="gt-member-link">
							<?php echo Gatsby_Helper::get_the_post_thumbnail ($id, $image_size, false, array(), $thumbnail_atts ) ?>
						</a>

						<?php if ( $desc_pos == 'hover' ):  ?>

							<!-- - - - - - - - - - - - - - About Member - - - - - - - - - - - - - - - - -->

							<div class="gt-member-about"><?php echo apply_filters( 'the_content', $content ); ?></div>

							<!-- - - - - - - - - - - - - - End of About Member - - - - - - - - - - - - - - - - -->

						<?php endif; ?>

					</div><!--/ .gt-member-photo-->

				<?php endif; ?>

				<!-- - - - - - - - - - - - - - End of Member Photo - - - - - - - - - - - - - - - - -->

				<div class="gt-member-holder">

					<!-- - - - - - - - - - - - - - Member Info - - - - - - - - - - - - - - - - -->

					<h4 class="gt-member-name">
						<a href="<?php echo esc_url($link); ?>"><?php echo esc_html($name); ?></a>
					</h4>

					<?php if ( !empty($position) ): ?>
						<div class="gt-member-position"><?php echo esc_html($position) ?></div>
					<?php endif; ?>

					<?php echo gatsby_team_members_social_links($id); ?>

					<?php if ( $desc_pos == 'bottom' ):  ?>

						<!-- - - - - - - - - - - - - - About Member - - - - - - - - - - - - - - - - -->

						<div class="gt-member-about"><?php echo apply_filters( 'the_content', $content ); ?></div>

						<!-- - - - - - - - - - - - - - End of About Member - - - - - - - - - - - - - - - - -->

					<?php endif; ?>

					<!-- - - - - - - - - - - - - - End of Member Info - - - - - - - - - - - - - - - - -->

				</div><!--/ .gt-member-holder-->

			</div><!--/ .gt-team-member-->

		<?php endwhile; ?>

	</div>

	<?php
	// Previous/next page navigation.
	the_posts_pagination( array(
		'prev_text'          => '',
		'next_text'          => '',
		'before_page_number' => '',
		'screen_reader_text' => ''
	) );
	?>

	<?php wp_reset_postdata(); ?>

<?php else:

	// If no content, include the "No posts found" template.
	get_template_part( 'template-parts/content', 'none' );

endif; ?>

<?php get_footer(); ?>