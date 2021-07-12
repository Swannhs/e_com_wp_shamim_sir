<?php
/**
 * The template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Gatsby
 * @since Gatsby 1.0
 */
get_header(); ?>

<?php if ( have_posts() ): ?>

	<?php global $gatsby_settings; ?>

	<div class="gt-single-entry-holder">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php
			global $post;
			$this_post = array();
			$this_post['id'] = $this_id = get_the_ID();
			$this_post['content'] = get_the_content();
			$this_post['post_format'] = get_post_format() ? get_post_format() : 'standard';
			$this_post['url'] = $link = get_permalink($this_id);
			$this_post['image_size'] = '';
			$this_post = apply_filters( 'gatsby-entry-format-single', $this_post );

			extract($this_post);
			?>

			<div class="gt-content-element">

				<article id="<?php echo get_the_ID() ?>" <?php post_class('gt-entry gt-single'); ?>>

					<?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>
						<div class="gt-post-thumbnail">
							<?php the_post_thumbnail(); ?>
						</div>
					<?php endif; ?>

					<div class="gt-entry-body">
						<?php echo  apply_filters('the_content', $this_post['content']); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'gatsby' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
					</div><!--/ .gt-entry-body-->

					<?php echo gatsby_blog_post_meta($this_id); ?>

				</article><!--/ .gt-entry-->

				<?php if ( $gatsby_settings['post-nav'] ): ?>
					<?php get_template_part( 'template-parts/single', 'link-pages' ) ?>
				<?php endif; ?>

				<?php if ( $gatsby_settings['post-author'] ): ?>
					<?php get_template_part( 'template-parts/single', 'author-box' ); ?>
				<?php endif; ?>

			</div><!--/ .gt-content-element-->

			<?php if ( $gatsby_settings['post-comments'] ): ?>
				<?php if ( comments_open() || '0' != get_comments_number() ): ?>
					<?php comments_template(); ?>
				<?php endif; ?>
			<?php endif; ?>

		<?php endwhile ?>

	</div><!--/ .gt-single-entry-holder-->

<?php endif; ?>

<?php get_footer(); ?>