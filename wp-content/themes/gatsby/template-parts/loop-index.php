<?php

global $gatsby_settings;

$style = $gatsby_settings['post-archive-style'];

$this_post = array();
$this_post['id'] = $id = get_the_ID();
$this_post['link'] = $link = get_permalink();
$this_post['title'] = $title = get_the_title();
$this_post['post_format'] = $format = get_post_format() ? get_post_format() : 'standard';

extract($this_post);

$post_content = has_excerpt() ? get_the_excerpt() : get_the_content();
?>

<div id="post-<?php echo (int) $id; ?>" <?php post_class( implode( ' ', array('gt-col') ) ); ?>>

	<article class="gt-entry gt-image-entry-format">

		<!-- - - - - - - - - - - - - - Attachment - - - - - - - - - - - - - - - - -->

		<div class="gt-entry-attachment">

			<?php gatsby_post_thumbnail(); ?>

			<?php if ( $style == 'gt-small-thumbs' ): ?>
				<?php echo gatsby_entry_date( $id ); ?>
			<?php endif; ?>

		</div><!--/ .gt-entry-attachment-->

		<!-- - - - - - - - - - - - - - End of Attachment - - - - - - - - - - - - - - - - -->

		<!-- - - - - - - - - - - - - - Entry body - - - - - - - - - - - - - - - - -->

		<div class="gt-entry-body">

			<h6 class="gt-entry-title">
				<?php if ( is_sticky($id) ): ?>
					<?php printf( '<span class="sticky-post">%s</span>', esc_html__( 'Featured', 'gatsby' ) ); ?>
				<?php endif; ?>

				<a href="<?php echo esc_url($link) ?>"><?php echo esc_html($title) ?></a>
			</h6>

			<!-- - - - - - - - - - - - - - Entry Meta - - - - - - - - - - - - - - - - -->

			<?php if ( $style == 'gt-big-thumbs' ): ?>

				<?php echo gatsby_blog_post_meta($id,
					array(
						'author' => true,
						'date' => true,
						'cats' => false
					)); ?>

			<?php else: ?>

				<?php echo gatsby_blog_post_meta($id); ?>

			<?php endif; ?>

			<!-- - - - - - - - - - - - - - End of Meta - - - - - - - - - - - - - - - - -->

			<!-- - - - - - - - - - - - - - Entry Excerpt - - - - - - - - - - - - - - - - -->

			<div class="gt-entry-excerpt">
				<?php echo apply_filters('the_content', $post_content); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'gatsby' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
			</div>

			<!-- - - - - - - - - - - - - - End of Entry Excerpt - - - - - - - - - - - - - - - - -->

			<a class="gt-continue-reading-link" href="<?php echo esc_url($link) ?>"><?php esc_html_e('Read More', 'gatsby') ?></a>

		</div>

		<!-- - - - - - - - - - - - - - End of Entry body - - - - - - - - - - - - - - - - -->

	</article>

</div><!--/ .gt-col-->