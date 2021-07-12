
<?php
$id = get_the_author_meta('ID');
$name  = get_the_author_meta('display_name', $id);
$email = get_the_author_meta('email', $id);
$heading = esc_html__("Posted by", 'gatsby') ." ". $name;
$description = get_the_author_meta('description', $id);

if ( empty($description) ) return;

if ( current_user_can('edit_users') || get_current_user_id() == $id ) {
	$description .= " <a href='" . admin_url( 'profile.php?user_id=' . $id ) . "'>". esc_html__( '[ Edit the profile ]', 'gatsby' ) ."</a>";
}
?>

<!-- - - - - - - - - - - - - - Entry Author - - - - - - - - - - - - - - - - -->

<div class="gt-entry-author gt-author-box">

	<a class="gt-avatar">
		<?php echo get_avatar($email, '130', '', esc_html($name)); ?>
	</a>

	<div class="gt-author-info">

		<div class="gt-author-name"><?php echo esc_html($heading); ?></div>

		<?php if ( !empty($description) ): ?>
			<div class="gt-author-about">
				<?php echo sprintf('%s', $description); ?>
			</div>
		<?php endif; ?>

		<?php
		$user_profile = new gatsby_admin_user_profile();
		echo $user_profile->output_social_links();
		?>

	</div><!--/ .gt-author-info -->

</div><!--/ .gt-author-entry.gt-author-box -->

<!-- - - - - - - - - - - - - - End of Entry Author - - - - - - - - - - - - - - - - -->