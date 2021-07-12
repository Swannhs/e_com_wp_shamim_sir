<?php
    $next_post = get_next_post();
    $prev_post = get_previous_post();
    $next_post_url = $prev_post_url = "";
	$next_post_title = $prev_post_title = "";

    if ( is_object($next_post) ) {
        $next_post_url = get_permalink($next_post->ID);
        $next_post_title = $next_post->post_title;
    }
    if ( is_object($prev_post) ) {
        $prev_post_url = get_permalink($prev_post->ID);
		$prev_post_title = $prev_post->post_title;
    }
?>

<?php if ( !empty($prev_post_url) || !empty($next_post_url) ): ?>

	<!-- - - - - - - - - - - - - - Entries Navigation - - - - - - - - - - - - - - - - -->

	<div class="gt-entries-nav">

		<?php if ( !empty($prev_post_url) ): ?>

			<?php if ( empty($prev_post_title) ): ?>
				<?php $prev_post_title = esc_html__('No Title', 'gatsby') ?>
			<?php endif; ?>

			<a class="gt-previous-entry" href="<?php echo esc_url($prev_post_url) ?>"><?php echo esc_html($prev_post_title); ?></a>
		<?php endif; ?>

		<?php if (!empty($next_post_url)): ?>

			<?php if ( empty($next_post_title) ): ?>
				<?php $next_post_title = esc_html__('No Title', 'gatsby') ?>
			<?php endif; ?>

			<a class="gt-next-entry" href="<?php echo esc_url($next_post_url) ?>"><?php echo esc_html($next_post_title); ?></a>
		<?php endif; ?>

	</div>

	<!-- - - - - - - - - - - - - - End of Entries Navigation - - - - - - - - - - - - - - - - -->

<?php endif; ?>