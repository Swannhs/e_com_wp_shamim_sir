<?php
/**
 * The template for displaying Testimonials Archive area.
 */

get_header(); ?>

<?php if ( have_posts() ): ?>

	<?php
	global $gatsby_settings;

	$layout = $gatsby_settings['testimonials-archive-layout'];
	$columns = $gatsby_settings['testimonials-archive-columns'];

	$css_classes = array(
		'gt-testimonials-holder',
		'gt-paginate-pagination',
		$layout
	);

	if ( $layout == 'gt-type-2' || $layout == 'gt-type-3' ) {
		$css_classes[] = 'gt-cols-' . absint($columns);
	}

	$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
	$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
	?>

	<div <?php echo implode( ' ', $wrapper_attributes ) ?>>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php
			$id = get_the_ID();
			$name = get_the_title();
			$link  = get_permalink();
			$company = mad_meta( 'gatsby_tm_company', '' );
			$content = has_excerpt($id) ? apply_filters( 'the_excerpt', get_the_excerpt() ) : '';
			$alt = trim(strip_tags(get_post_meta($id, '_wp_attachment_image_alt', true)));
			if ( empty($alt) ) {
				$attachment = get_post($id);
				$alt = trim(strip_tags($attachment->post_title));
			}
			$thumbnail_atts = array(
				'title'	=> trim(strip_tags(get_the_title())),
				'alt' => $alt
			);
			?>

			<div class="gt-testimonial">

				<!-- - - - - - - - - - - - - - Author Box - - - - - - - - - - - - - - - - -->

				<div class="gt-author-box">

					<?php if ( has_post_thumbnail() ): ?>

						<a href="<?php echo esc_url($link) ?>" class="gt-avatar">
							<?php echo Gatsby_Helper::get_the_post_thumbnail( $id, '70*70', true, $thumbnail_atts ) ?>
						</a>

					<?php endif; ?>

					<div class="gt-author-info">

						<a href="<?php echo esc_url($link) ?>" class="gt-author-name"><?php echo esc_html($name) ?></a>
						<span class="gt-author-company"><?php echo esc_html($company) ?></span>

					</div><!--/ .gt-author-info -->

				</div><!--/ .gt-author-box -->

				<!-- - - - - - - - - - - - - - End of Author Box - - - - - - - - - - - - - - - - -->

				<!-- - - - - - - - - - - - - - Comment - - - - - - - - - - - - - - - - -->

				<blockquote><?php echo do_shortcode($content); ?></blockquote>

				<!-- - - - - - - - - - - - - - End of Comment - - - - - - - - - - - - - - - - -->

			</div>

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