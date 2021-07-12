<?php
	/**
	 * The template for displaying Search Results pages.
	 */
	get_header();
?>

<?php if ( !empty($_GET['s']) || have_posts() ): ?>

	<?php
	$loop_count = 1;
	$page = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
	if ( $page > 1 ) {
		$loop_count = ((int) ($page - 1) * (int) get_query_var('posts_per_page')) + 1;
	}
	?>

	<?php
	global $gatsby_settings;
	$wrapper_attributes = array();

	$css_classes = array(
		'gt-entries-holder',
		'gt-type-4',
		'gt-cols-1',
		'gt-big-thumbs'
	);

	$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );
	$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
	?>

	<div <?php echo implode( ' ', $wrapper_attributes ) ?>>

		<div class="gt-container gt-cols-1">

			<?php if ( have_posts() ): ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php
					$this_post = array();
					$this_post['id'] = $id = get_the_ID();
					$this_post['link'] = $link = get_permalink();
					$this_post['title'] = $title = get_the_title();
					extract($this_post);
					?>

					<div id="post-<?php echo (int) $id; ?>" <?php post_class( implode( ' ', array('gt-col') ) ); ?>>

						<span class="search-result-counter">
							<span class="dropcap-result"><?php echo esc_html($loop_count) ?></span>
						</span>

						<article class="gt-entry gt-image-entry-format">

							<?php gatsby_post_thumbnail(); ?>

							<!-- - - - - - - - - - - - - - Entry body - - - - - - - - - - - - - - - - -->

							<div class="gt-entry-body">

								<h6 class="gt-entry-title">
									<?php if ( is_sticky($id) ): ?>
										<?php printf( '<span class="sticky-post">%s</span>', esc_html__( 'Featured', 'gatsby' ) ); ?>
									<?php endif; ?>

									<a href="<?php echo esc_url($link) ?>"><?php echo esc_html($title) ?></a>
								</h6>

								<!-- - - - - - - - - - - - - - Entry Meta - - - - - - - - - - - - - - - - -->

								<?php echo gatsby_blog_post_meta($id,
									array(
										'author' => true,
										'date' => true,
										'cats' => false
									)); ?>

								<!-- - - - - - - - - - - - - - End of Meta - - - - - - - - - - - - - - - - -->

								<!-- - - - - - - - - - - - - - Entry Excerpt - - - - - - - - - - - - - - - - -->

								<div class="gt-entry-excerpt">
									<?php the_excerpt(); ?>
								</div>

								<!-- - - - - - - - - - - - - - End of Entry Excerpt - - - - - - - - - - - - - - - - -->

								<a class="gt-continue-reading-link" href="<?php echo esc_url($link) ?>"><?php esc_html_e( 'Read More', 'gatsby' ) ?></a>

							</div>

							<!-- - - - - - - - - - - - - - End of Entry body - - - - - - - - - - - - - - - - -->

						</article><!--/ .gt-entry-->

					</div><!--/ .gt-col-->

				<?php $loop_count++; endwhile; ?>

			<?php else: ?>

				<?php
				// If no content, include the "No posts found" template.
				get_template_part( 'template-parts/content', 'none' );
				?>

			<?php endif; ?>

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
