<div class="settings-box">

	<div class="group-radio">
		<label><input type="radio" <?php checked( $mode, 'default' ) ?> name="gatsby_page_title[mode]" value="default"><?php esc_html_e('Default', 'gatsby') ?></label>
		<label><input type="radio" <?php checked( $mode, 'custom' ) ?> name="gatsby_page_title[mode]" value="custom"><?php esc_html_e('Custom', 'gatsby') ?></label>
		<label><input type="radio" <?php checked( $mode, 'none' ) ?> name="gatsby_page_title[mode]" value="none"><?php esc_html_e('None', 'gatsby') ?></label>
	</div>

	<div class="settings-box-content <?php if ( $mode !== 'custom' ): ?>gatsby-hidden<?php endif; ?>">
		<?php
			foreach( $options as $option ) {
				gatsby_page_title_meta_html( $page_title, $option );
			}
		?>
	</div><!--/ .settings-box-content-->

</div><!--/ .settings-box-->

