<?php
/**
 * The template for displaying Portfolio Archive area.
 */

get_header(); ?>

<?php if ( have_posts() ): ?>

	<?php
	global $gatsby_settings, $gatsby_config;
	$attributes = array();

	$layout = $gatsby_settings['portfolio-archive-layout'];
	$columns = $gatsby_settings['portfolio-archive-columns'];

	$css_classes = array(
		'gt-portfolio-holder',
		'gt-isotope', $layout,
		'gt-paginate-pagination'
	);

	$params = array(
		'masonry' => '',
		'layout' => $layout,
		'columns' => $columns,
		'img_size' => ''
	);

	switch ( $layout ) {
		case 'gt-type-3':

			if ( empty($params['img_size'] ) ) {
				$attributes['masonry'] = 'true';
			}

			break;
	}

	$data_rel = 'rel=portfolio-'. rand() .'';

	$defaults = array(
		'id' => '',
		'link' => '',
		'title' => '',
		'sort_classes' => '',
		'cur_terms' => '',
		'item_size' => '',
		'image_size' => ''
	);

	$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
	?>

	<div class="<?php echo esc_attr( trim($css_class) ) ?>" <?php echo gatsby_create_data_string($attributes) ?>>

		<?php $i = 1; ?>

		<div class="gt-isotope-container <?php echo 'gt-cols-' . absint($columns) ?>">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				$sizes = gatsby_portfolio_get_image_sizes( $params, get_the_ID() );

				$entry = array(
					'id' => get_the_ID(),
					'link' => get_the_permalink(),
					'title' => get_the_title(),
					'sort_classes' => gatsby_get_sort_classes(),
					'img_size' => '',
					'cur_terms' => get_the_terms( get_the_ID(), 'portfolio_categories' ),
					'post_content' => has_excerpt() ? get_the_excerpt() : '',
					'size_class' => ''
				);

				$entry = array_merge($entry, $sizes);

				extract(array_merge($defaults, $entry));

				?>

				<?php if ( $i == 1 && ( $layout == 'gt-type-3' ) ): ?>
					<div class="gt-grid-sizer"></div>
				<?php endif; ?>

				<!-- - - - - - - - - - - - - - Project - - - - - - - - - - - - - - - - -->

				<div class="gt-col <?php echo esc_attr($item_size) ?> <?php echo esc_attr($sort_classes) ?> <?php echo esc_attr($size_class) ?>">

					<div class="gt-project">

						<figure class="gt-tilter-figure">

							<!-- - - - - - - - - - - - - - Project Image - - - - - - - - - - - - - - - - -->

							<div class="gt-project-image">

								<a class="fancybox" <?php echo esc_attr($data_rel) ?> href="<?php echo Gatsby_Helper::get_post_featured_image( $id, '' ) ?>">
									<?php echo Gatsby_Helper::get_the_post_thumbnail( $id, $image_size, true, array(), array( 'alt' => esc_attr($title) ) ); ?>
								</a>

							</div>

							<!-- - - - - - - - - - - - - - End of Project Image - - - - - - - - - - - - - - - - -->

							<!-- - - - - - - - - - - - - - Project Description - - - - - - - - - - - - - - - - -->

							<div class="gt-project-description" <?php echo esc_attr($data_rel) ?> data-src="<?php echo Gatsby_Helper::get_post_featured_image( $id, '' ) ?>">

								<div class="gt-description-inner">

									<div class="gt-description-content">

										<div class="gt-tilter-caption">

											<h6 class="gt-project-title">
												<a href="<?php echo esc_url($link) ?>"><?php echo esc_html($title) ?></a>
											</h6>

											<?php if ( !empty($cur_terms) ): ?>
												<ul class="gt-project-cats">
													<?php foreach($cur_terms as $cur_term): ?>
														<li><a href="<?php echo get_term_link( (int) $cur_term->term_id, $cur_term->taxonomy ) ?>"><?php echo esc_html($cur_term->name) ?></a></li>
													<?php endforeach; ?>
												</ul>
											<?php endif; ?>

										</div><!--/ .gt-tilter-caption-->

									</div><!--/ .gt-description-content-->

									<?php if ( $layout == 'gt-type-2' ): ?>
										<div class="gt-tilter-deco-lines"></div>
									<?php endif; ?>

								</div><!--/ .gt-description-inner -->

							</div><!--/ .gt-project-description-->

							<!-- - - - - - - - - - - - - - End of Project Description - - - - - - - - - - - - - - - - -->

						</figure>

					</div><!--/ .gt-project-->

				</div><!--/ .gt-col-->

				<!-- - - - - - - - - - - - - - End of Project - - - - - - - - - - - - - - - - -->

				<?php $i++; ?>

			<?php endwhile; ?>

		</div><!--/ .gt-isotope-container-->

		<?php
		// Previous/next page navigation.
		the_posts_pagination( array(
			'prev_text'          => '',
			'next_text'          => '',
			'before_page_number' => '',
			'screen_reader_text' => ''
		) );
		?>

	</div><!--/ .gt-portfolio-holder-->

	<?php wp_reset_postdata(); ?>

<?php else:

	// If no content, include the "No posts found" template.
	get_template_part( 'template-parts/content', 'none' );

endif; ?>

<?php get_footer(); ?>