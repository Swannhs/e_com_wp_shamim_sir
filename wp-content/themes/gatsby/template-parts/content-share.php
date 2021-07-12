
<?php
global $gatsby_settings;
$image = esc_url(wp_get_attachment_url( get_post_thumbnail_id() ));
$permalink = esc_url( apply_filters('the_permalink', get_the_permalink()) );
$title = esc_attr(get_the_title());
$extra_attr = 'target="_blank"';
?>

<span class="gt-title"><?php esc_html_e('Share', 'gatsby') ?>:</span>

<ul class="gt-social-icons">

	<?php if ($gatsby_settings['product-share-linkedin']): ?>
		<li><a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $permalink ?>&amp;title=<?php echo $title ?>" <?php echo $extra_attr ?> title="<?php echo esc_html__('LinkedIn', 'gatsby') ?>"><i class="fa fa-linkedin"></i></a></li>
	<?php endif; ?>

	<?php if ($gatsby_settings['product-share-tumblr']): ?>
		<li><a href="http://www.tumblr.com/share/link?url=<?php echo $permalink ?>&amp;name=<?php echo urlencode($title) ?>&amp;description=<?php echo urlencode(get_the_excerpt()) ?>" <?php echo $extra_attr ?> title="<?php echo esc_html__('Tumblr', 'gatsby') ?>"><i class="fa fa-tumblr"></i></a></li>
	<?php endif; ?>

	<?php if ($gatsby_settings['product-share-twitter']): ?>
		<li><a href="https://twitter.com/intent/tweet?text=<?php echo $title ?>&amp;url=<?php echo $permalink ?>" <?php echo $extra_attr ?> title="<?php echo esc_html__('Twitter', 'gatsby') ?>"><i class="fa fa-twitter"></i></a></li>
	<?php endif; ?>

	<?php if ($gatsby_settings['product-share-facebook']): ?>
		<li><a href="http://www.facebook.com/sharer.php?m2w&amp;s=100&amp;p&#091;url&#093;=<?php echo $permalink ?>&amp;p&#091;images&#093;&#091;0&#093;=<?php echo $image ?>&amp;p&#091;title&#093;=<?php echo $title ?>" <?php echo $extra_attr ?> title="<?php echo esc_html__('Facebook', 'gatsby') ?>"><i class="fa fa-facebook"></i></a></li>
	<?php endif; ?>

	<?php if ($gatsby_settings['product-share-googleplus']): ?>
		<li><a href="https://plus.google.com/share?url=<?php echo $permalink ?>" <?php echo $extra_attr ?> title="<?php echo esc_html__('Google +', 'gatsby') ?>"><i class="fa fa-google-plus"></i></a></li>
	<?php endif; ?>

</ul>