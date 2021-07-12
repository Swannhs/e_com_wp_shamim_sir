<?php

// add custom menu fields to menu
add_filter( 'wp_setup_nav_menu_item', 'gatsby_add_custom_nav_fields' );

function gatsby_add_custom_nav_fields( $menu_item ) {
	$menu_item->icon = get_post_meta( $menu_item->ID, '_menu_item_icon', true );
	$menu_item->nolink = get_post_meta( $menu_item->ID, '_menu_item_nolink', true );
	$menu_item->hide = get_post_meta( $menu_item->ID, '_menu_item_hide', true );
	$menu_item->submenu_type = get_post_meta( $menu_item->ID, '_menu_item_submenu_type', true );
	$menu_item->submenu_pos = get_post_meta( $menu_item->ID, '_menu_item_submenu_pos', true );
	$menu_item->bg_image = get_post_meta( $menu_item->ID, '_menu_item_bg_image', true );
	$menu_item->bg_pos = get_post_meta( $menu_item->ID, '_menu_item_bg_pos', true );
	$menu_item->bg_repeat = get_post_meta( $menu_item->ID, '_menu_item_bg_repeat', true );
	$menu_item->bg_size = get_post_meta( $menu_item->ID, '_menu_item_bg_size', true );
	$menu_item->bg_style = get_post_meta( $menu_item->ID, '_menu_item_bg_style', true );
	$menu_item->tip_label = get_post_meta( $menu_item->ID, '_menu_item_tip_label', true );
	$menu_item->tip_bg = get_post_meta( $menu_item->ID, '_menu_item_tip_bg', true );
	return $menu_item;
}

// save menu custom fields
add_action( 'wp_update_nav_menu_item', 'gatsby_update_custom_nav_fields', 10, 3 );

function gatsby_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {
	$check = array('icon', 'nolink', 'hide', 'submenu_type', 'submenu_pos', 'bg_image', 'bg_pos', 'bg_repeat', 'bg_size', 'bg_style', 'tip_label', 'tip_bg');

	foreach ( $check as $key ) {

		if ( !isset($_POST['menu-item-' . $key][$menu_item_db_id]) ) {
			if ( !isset($args['menu-item-' . $key]) ) {
				$value = "";
			} else {
				$value = $args['menu-item-' . $key];
			}
		} else {
			$value = $_POST['menu-item-' . $key][$menu_item_db_id];
		}

		if ( $value ) {
			update_post_meta( $menu_item_db_id, '_menu_item_' . $key, $value );
		} else {
			delete_post_meta( $menu_item_db_id, '_menu_item_' . $key );
		}

	}
}

// edit menu walker
add_filter( 'wp_edit_nav_menu_walker', 'gatsby_menu_edit_walker', 10, 2 );

function gatsby_menu_edit_walker($walker = '', $menu_id = '') {
	return 'Gatsby_Walker_Nav_Menu_Edit';
}

// Create HTML list of nav menu input items.
// Extend from Walker_Nav_Menu class
class Gatsby_Walker_Nav_Menu_Edit extends Walker_Nav_Menu {
	/**
	 * @see Walker_Nav_Menu::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 */
	function start_lvl(&$output, $depth = 0, $args = array())
	{
	}

	/**
	 * @see Walker_Nav_Menu::end_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {
	}

	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param object $args
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 )
	{
		global $_wp_nav_menu_max_depth;
		$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

		ob_start();
		$item_id = esc_attr( $item->ID );
		$removed_args = array(
			'action',
			'customlink-tab',
			'edit-menu-item',
			'menu-item',
			'page-tab',
			'_wpnonce',
		);

		$original_title = false;
		if ( 'taxonomy' == $item->type ) {
			$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
			if ( is_wp_error( $original_title ) )
				$original_title = false;
		} elseif ( 'post_type' == $item->type ) {
			$original_object = get_post( $item->object_id );
			$original_title = get_the_title( $original_object->ID );
		} elseif ( 'post_type_archive' == $item->type ) {
			$original_object = get_post_type_object( $item->object );
			if ( $original_object ) {
				$original_title = $original_object->labels->archives;
			}
		}

		$classes = array(
			'menu-item menu-item-depth-' . $depth,
			'menu-item-' . esc_attr( $item->object ),
			'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
		);

		$title = $item->title;

		if ( ! empty( $item->_invalid ) ) {
			$classes[] = 'menu-item-invalid';
			/* translators: %s: title of menu item which is invalid */
			$title = sprintf( __( '%s (Invalid)', 'gatsby'), $item->title );
		} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
			$classes[] = 'pending';
			/* translators: %s: title of menu item in draft status */
			$title = sprintf( __('%s (Pending)', 'gatsby'), $item->title );
		}

		$title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;

		$submenu_text = '';
		if ( 0 == $depth )
			$submenu_text = 'style="display: none;"';

		?>
	<li id="menu-item-<?php echo esc_attr($item_id); ?>" class="<?php echo implode(' ', $classes ); ?>">
		<div class="menu-item-bar">
			<div class="menu-item-handle">
				<span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu" <?php echo sprintf('%s', $submenu_text); ?>><?php esc_html_e( 'sub item', 'gatsby' ); ?></span></span>
					<span class="item-controls">
						<span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
						<span class="item-order hide-if-js">
							<a href="<?php
							echo wp_nonce_url(
								add_query_arg(
									array(
										'action' => 'move-up-menu-item',
										'menu-item' => $item_id,
									),
									remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
								),
								'move-menu_item'
							);
							?>" class="item-move-up" aria-label="<?php esc_attr_e( 'Move up', 'gatsby' ) ?>">&#8593;</a>
							|
							<a href="<?php
							echo wp_nonce_url(
								add_query_arg(
									array(
										'action' => 'move-down-menu-item',
										'menu-item' => $item_id,
									),
									remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
								),
								'move-menu_item'
							);
							?>" class="item-move-down" aria-label="<?php esc_attr_e( 'Move down', 'gatsby' ) ?>">&#8595;</a>
						</span>
						<a class="item-edit" id="edit-<?php echo esc_attr($item_id); ?>" href="<?php
						echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
						?>" aria-label="<?php esc_attr_e( 'Edit menu item', 'gatsby' ); ?>"><?php esc_html_e( 'Edit', 'gatsby' ); ?></a>
					</span>
			</div>
		</div>

		<div class="menu-item-settings wp-clearfix" id="menu-item-settings-<?php echo esc_attr($item_id); ?>">
			<?php if ( 'custom' == $item->type ) : ?>
				<p class="field-url description description-wide">
					<label for="edit-menu-item-url-<?php echo esc_attr($item_id); ?>">
						<?php echo esc_html__( 'URL', 'gatsby' ); ?><br />
						<input type="text" id="edit-menu-item-url-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
					</label>
				</p>
			<?php endif; ?>
			<p class="description description-wide">
				<label for="edit-menu-item-title-<?php echo esc_attr($item_id); ?>">
					<?php echo esc_html__('Navigation Label', 'gatsby') ?><br />
					<input type="text" id="edit-menu-item-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
				</label>
			</p>
			<p class="description description-wide">
				<label for="edit-menu-item-icon-<?php echo esc_attr($item_id); ?>">
					<?php echo esc_html__('Icon Class', 'gatsby') ?><br />
					<input type="text" id="edit-menu-item-icon-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-icon"
							name="menu-item-icon[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->icon ); ?>" />
					<span><?php echo sprintf(__('Input font linearicons icon or icon class. You can see %s. For example: icon-home', 'gatsby'), '<a target="_blank" href="http://velikorodnov.com/wordpress/sample-data/gatsby/font/Reference.html">Linearicons in here</a>') ?></span>
				</label>
			</p>
			<p class="description">
				<label for="edit-menu-item-target-<?php echo esc_attr($item_id); ?>">
					<input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr($item_id); ?>" value="_blank" name="menu-item-target[<?php echo esc_attr($item_id); ?>]"<?php checked( $item->target, '_blank' ); ?> />
					<?php echo esc_html__('Open link in a new tab', 'gatsby') ?>
				</label>
			</p>
			<p class="description">
				<label for="edit-menu-item-nolink-<?php echo esc_attr($item_id); ?>">
					<input type="checkbox" id="edit-menu-item-nolink-<?php echo esc_attr($item_id); ?>" value="nolink" name="menu-item-nolink[<?php echo esc_attr($item_id); ?>]" <?php checked( $item->nolink, 'nolink' ); ?> />
					<?php echo esc_html__('Don\'t link', 'gatsby') ?>
				</label>
			</p>
			<p class="description">
				<label for="edit-menu-item-hide-<?php echo esc_attr($item_id); ?>">
					<input type="checkbox" id="edit-menu-item-hide-<?php echo esc_attr($item_id); ?>" class="code edit-menu-item-custom" value="hide" name="menu-item-hide[<?php echo esc_attr($item_id); ?>]" <?php checked( $item->hide, 'hide' ); ?> />
					<?php echo esc_html__('Don\'t show a link', 'gatsby') ?>
				</label>
			</p>

			<?php if ( $depth == 0 ): ?>

				<p class="description description-wide">
					<label for="edit-menu-item-submenu_type-<?php echo esc_attr($item_id); ?>">
						<?php echo esc_html__('Submenu Type', 'gatsby') ?><br/>
						<select id="edit-menu-item-submenu_type-<?php echo esc_attr($item_id); ?>" name="menu-item-submenu_type[<?php echo esc_attr($item_id); ?>]" >
							<option value="default-dropdown" <?php selected( $item->submenu_type, 'default-dropdown' ); ?>><?php echo esc_html__('Standard Submenu', 'gatsby') ?></option>
							<option value="multicolumn" <?php selected( $item->submenu_type, 'multicolumn' ); ?>><?php echo esc_html__('Multicolumn Submenu', 'gatsby') ?></option>
						</select>
					</label>
				</p>

				<p class="description description-wide">
					<label for="edit-menu-item-submenu_pos-<?php echo esc_attr($item_id); ?>">
						<?php echo esc_html__('Submenu Position', 'gatsby') ?><br />
						<select id="edit-menu-item-submenu_pos-<?php echo esc_attr($item_id); ?>" name="menu-item-submenu_pos[<?php echo esc_attr($item_id); ?>]" >
							<option value="" <?php selected( $item->submenu_pos, '' ); ?>><?php echo esc_html__('Auto', 'gatsby') ?></option>
							<option value="pos-left" <?php selected( $item->submenu_pos, 'pos-left' ); ?>><?php echo esc_html__('Left', 'gatsby') ?></option>
							<option value="pos-right" <?php selected( $item->submenu_pos, 'pos-right' ); ?>><?php echo esc_html__('Right', 'gatsby') ?></option>
							<option value="pos-center" <?php selected( $item->submenu_pos, 'pos-center' ); ?>><?php echo esc_html__('Center', 'gatsby') ?></option>
						</select>
					</label>
				</p>

			<?php endif; ?>

			<?php if ( $depth == 0 || $depth == 1 ): ?>

				<p class="description description-wide">
					<label for="edit-menu-item-bg_image-<?php echo esc_attr($item_id); ?>">
						<?php echo esc_html__('Background Image', 'gatsby') ?><br />
						<input type="text" id="edit-menu-item-bg_image-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-bg_image"
							   name="menu-item-bg_image[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->bg_image ); ?>" />
						<br/>
						<input class="button_upload_image button" id="edit-menu-item-bg_image-<?php echo esc_attr($item_id); ?>" type="button" value="<?php esc_html_e('Upload Image', 'gatsby') ?>" />&nbsp;
						<input class="button_remove_image button" id="edit-menu-item-bg_image-<?php echo esc_attr($item_id); ?>" type="button" value="<?php esc_html_e('Remove Image', 'gatsby') ?>" />
					</label>
				</p>

				<p class="description description-wide">
					<label for="edit-menu-item-bg_pos-<?php echo esc_attr($item_id); ?>">
						<?php echo esc_html__('Background Position', 'gatsby') ?><br />
						<select id="edit-menu-item-bg_pos-<?php echo esc_attr($item_id); ?>" name="menu-item-bg_pos[<?php echo esc_attr($item_id); ?>]" >
							<option value="" <?php selected( $item->bg_pos, '' ); ?>><?php echo esc_html__('Select', 'gatsby') ?></option>
							<option value="left top" <?php selected( $item->bg_pos, 'left top' ); ?>><?php echo esc_html__('Left Top', 'gatsby') ?></option>
							<option value="left center" <?php selected( $item->bg_pos, 'left center' ); ?>><?php echo esc_html__('Left Center', 'gatsby') ?></option>
							<option value="left bottom" <?php selected( $item->bg_pos, 'left bottom' ); ?>><?php echo esc_html__('Left Bottom', 'gatsby') ?></option>
							<option value="center top" <?php selected( $item->bg_pos, 'center top' ); ?>><?php echo esc_html__('Center Top', 'gatsby') ?></option>
							<option value="center center" <?php selected( $item->bg_pos, 'center center' ); ?>><?php echo esc_html__('Center Center', 'gatsby') ?></option>
							<option value="center bottom" <?php selected( $item->bg_pos, 'center bottom' ); ?>><?php echo esc_html__('Center Bottom', 'gatsby') ?></option>
							<option value="right top" <?php selected( $item->bg_pos, 'right top' ); ?>><?php echo esc_html__('Right Top', 'gatsby') ?></option>
							<option value="right center" <?php selected( $item->bg_pos, 'right center' ); ?>><?php echo esc_html__('Right Center', 'gatsby') ?></option>
							<option value="right bottom" <?php selected( $item->bg_pos, 'right bottom' ); ?>><?php echo esc_html__('Right Bottom', 'gatsby') ?></option>
						</select>
					</label>
				</p>

				<p class="description description-wide">
					<label for="edit-menu-item-bg_repeat-<?php echo esc_attr($item_id); ?>">
						<?php echo esc_html__('Background Repeat', 'gatsby') ?><br />
						<select id="edit-menu-item-bg_repeat-<?php echo esc_attr($item_id); ?>" name="menu-item-bg_repeat[<?php echo esc_attr($item_id); ?>]" >
							<option value="" <?php selected( $item->bg_repeat, '' ) ?>><?php echo esc_html__('Select', 'gatsby') ?></option>
							<option value="no-repeat" <?php selected( $item->bg_repeat, 'no-repeat' ) ?>><?php echo esc_html__('No Repeat', 'gatsby') ?></option>
							<option value="repeat" <?php selected( $item->bg_repeat, 'repeat' ) ?>><?php echo esc_html__('Repeat All', 'gatsby') ?></option>
							<option value="repeat-x" <?php selected( $item->bg_repeat, 'repeat-x' ) ?>><?php echo esc_html__('Repeat Horizontally', 'gatsby') ?></option>
							<option value="repeat-y" <?php selected( $item->bg_repeat, 'repeat-y' ) ?>><?php echo esc_html__('Repeat Vertically', 'gatsby') ?></option>
							<option value="inherit" <?php selected( $item->bg_repeat, 'inherit' ) ?>><?php echo esc_html__('Inherit', 'gatsby') ?></option>
						</select>
					</label>
				</p>

				<p class="description description-wide">
					<label for="edit-menu-item-bg_size-<?php echo esc_attr($item_id); ?>">
						<?php echo esc_html__('Background Size', 'gatsby') ?><br />
						<select id="edit-menu-item-bg_size-<?php echo esc_attr($item_id); ?>" name="menu-item-bg_size[<?php echo esc_attr($item_id); ?>]" >
							<option value="" <?php selected( $item->bg_size, '' ) ?>><?php echo esc_html__('Select', 'gatsby') ?></option>
							<option value="inherit" <?php selected( $item->bg_size, 'inherit' ) ?>><?php echo esc_html__('Inherit', 'gatsby') ?></option>
							<option value="cover" <?php selected( $item->bg_size, 'cover' ) ?>><?php echo esc_html__('Cover', 'gatsby') ?></option>
							<option value="contain" <?php selected( $item->bg_size, 'contain' ) ?>><?php echo esc_html__('Contain', 'gatsby') ?></option>
						</select>
					</label>
				</p>

				<p class="description description-wide">
					<label for="edit-menu-item-bg_style-<?php echo esc_attr($item_id); ?>">
						<?php echo esc_html__('Custom Styles', 'gatsby') ?><br />
                		<textarea id="edit-menu-item-bg_style-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-bg_style" rows="3" cols="20"
								  name="menu-item-bg_style[<?php echo esc_attr($item_id); ?>]"><?php echo esc_html( $item->bg_style ); ?></textarea>
					</label>
				</p>

			<?php endif; ?>

			<p class="description description-thin">
				<label for="edit-menu-item-tip_label-<?php echo esc_attr($item_id); ?>">
					<?php echo esc_html__('Tip Label', 'gatsby'); ?><br />
					<input type="text" id="edit-menu-item-tip_label-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-tip_label"
							name="menu-item-tip_label[<?php echo esc_attr($item_id); ?>]"  value="<?php echo esc_attr( $item->tip_label ); ?>" />
				</label>
			</p>

			<p class="description description-thin">
				<label for="edit-menu-item-tip_bg-<?php echo esc_attr($item_id); ?>">
					<?php echo esc_html__('Tip Background Color', 'gatsby'); ?><br />
					<input type="text" id="edit-menu-item-tip_bg-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-tip_bg"
							name="menu-item-tip_bg[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->tip_bg ); ?>" />
				</label>
			</p><br/>

			<div class="menu-item-actions description-wide submitbox">
				<?php if ( 'custom' != $item->type && $original_title !== false ) : ?>
					<p class="link-to-original">
						<?php printf( __('Original: %s', 'gatsby'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
					</p>
				<?php endif; ?>
				<a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr($item_id); ?>" href="<?php
				echo wp_nonce_url(
					add_query_arg(
						array(
							'action' => 'delete-menu-item',
							'menu-item' => $item_id,
						),
						admin_url( 'nav-menus.php' )
					),
					'delete-menu_item_' . $item_id
				); ?>"><?php esc_html_e( 'Remove', 'gatsby' ); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo esc_attr($item_id); ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );
				?>#menu-item-settings-<?php echo esc_attr($item_id); ?>"><?php esc_html_e('Cancel', 'gatsby'); ?></a>
			</div>

			<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr($item_id); ?>" />
			<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
			<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
			<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
			<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
			<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
		</div><!-- .menu-item-settings-->
		<ul class="menu-item-transport"></ul>
		<?php
		$output .= ob_get_clean();
	}

}

/* Mobile Navigation Menu */
if ( !class_exists('gatsby_mobile_navwalker') ) {

	class gatsby_mobile_navwalker extends Walker_Nav_Menu
	{

		function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
			$id_field = $this->db_fields['id'];
			if ( is_object( $args[0] ) ) {
				$args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
			}
			return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}

		function start_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat("\t", $depth);
			$output .= "\n$indent<span class=\"arrow\"></span><ul class=\"sub-menu\">\n";
		}

		function end_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat("\t", $depth);
			$output .= "$indent</ul>\n";
		}


		// add main/sub classes to li's and links
		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			global $wp_query;

			$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' );

			$active = "";

			// depth dependent classes
			if ( $item->current || $item->current_item_ancestor || $item->current_item_parent )
				$active = 'active';

			// passed classes
			$classes = empty( $item->classes ) ? array() : (array)$item->classes;

			$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

			$output .= $indent . '<li id="mobile-menu-item-'. $item->ID . '" class="' . $class_names . ' ' . $active . '">';
			$current_a = "";

			// link attributes
			$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
			$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
			$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
			$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

			if ( ( $item->current && $depth == 0 ) ||  ( $item->current_item_ancestor && $depth == 0 ) )
				$current_a .= ' current';

			$attributes .= ' class="'. $current_a . '"';
			$item_output = $args->before;
			if ( $item->hide == "" ) {

				if ( $item->nolink == "" ) {
					$item_output .= '<a'. $attributes .'>';
				} else{
					$item_output .= '<a>';
				}

				$item_output .= $args->link_before . ( $item->icon ? '<i class="icon-' . str_replace( 'icon-', '', $item->icon ) . '"></i>' : '' ) . apply_filters( 'the_title', $item->title, $item->ID );
				$item_output .= $args->link_after;
				if ( $item->tip_label ) {
					$item_style = '';

					if ( $item->tip_bg ) {
						$item_style .= 'background-color: ' . $item->tip_bg . ';';
					}
					$item_output .= '<span class="tip" style="' . $item_style . '">' . $item->tip_label . '</span>';
				}

				$item_output .= '</a>';
			}

			$item_output .= $args->after;

			// build html
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}


	}

}

/* Primary Navigation Menu */
if ( !class_exists('gatsby_primary_navwalker') ) {

	class gatsby_primary_navwalker extends Walker_Nav_Menu {

		// add classes to ul sub menus
		function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
			$id_field = $this->db_fields['id'];
			if (is_object($args[0])) {
				$args[0]->has_children = !empty($children_elements[$element->$id_field]);
			}
			return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
		}

		function start_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat("\t", $depth);

			if ( $depth == 0 ) {
				$out_div = '<div class="gt-dropdown" style="' . $args->bg_style . '">';
			} else {
				$out_div = '';
			}
			$output .= "\n$indent$out_div<ul class=\"sub-menu\">\n";
		}

		function end_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat("\t", $depth);
			if ( $depth == 0 ) {
				$out_div = '</div>';
			} else {
				$out_div = '';
			}
			$output .= "$indent</ul>$out_div\n";
		}

		// add main/sub classes to li's and links
		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			global $wp_query;

			$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' );

			$sub = $bg_style = $active = "";

			// depth dependent classes
			if ( $item->current || $item->current_item_ancestor || $item->current_item_parent )
				$active = 'active';

			// passed classes
			$classes = empty( $item->classes ) ? array() : (array)$item->classes;

			$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

			$submenu_type = $submenu_pos = '';

			if ( $depth == 0 ) {
				$submenu_type = " " . $item->submenu_type;
				$submenu_pos = " ". $item->submenu_pos;

				$bg_image = $item->bg_image ? 'background-image:url(' . str_replace(array('http://', 'https://'), array('//', '//'), $item->bg_image).')' : '';
				$bg_pos = $item->bg_pos ? '; background-position:' . $item->bg_pos : '';
				$bg_repeat = $item->bg_repeat ? '; background-repeat:' . $item->bg_repeat : '';
				$bg_size = $item->bg_size ? '; background-size:' . $item->bg_size : '';

				$bg_style = str_replace( '"', '\'', $item->bg_style . $bg_image . $bg_pos . $bg_repeat . $bg_size );
			}

			if ( $depth == 1 ) {

				$sub_bg_style = '';

				if ( $item->bg_style || $item->bg_image || $item->bg_pos || $item->bg_repeat || $item->bg_size ) {
					$sub_bg_image = $item->bg_image ? 'background-image:url('. str_replace(array('http://', 'https://'), array('//', '//'), $item->popup_bg_image).')' : '';
					$sub_bg_pos = $item->bg_pos ? '; background-position:'. $item->bg_pos : '';;
					$sub_bg_repeat = $item->bg_repeat ? '; background-repeat:'. $item->bg_repeat : '';;
					$sub_bg_size = $item->bg_size ? '; background-size:'. $item->bg_size : '';;
					$sub_bg_style = ' style="'. str_replace('"', '\'', $item->bg_style) . $sub_bg_image . $sub_bg_pos . $sub_bg_repeat . $sub_bg_size . '"';
				}

				$output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $class_names . ' ' . $active . $sub . $submenu_pos . '" '. $sub_bg_style .'>';
			} else {
				$output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $class_names . ' ' . $active . $sub . $submenu_type . $submenu_pos . '">';
			}

			$current_a = "";

			// link attributes
			$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
			$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
			$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
			$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

			if ( ( $item->current && $depth == 0 ) ||  ( $item->current_item_ancestor && $depth == 0 ) )
				$current_a .= ' current';

			$attributes .= ' class="'. $current_a . '"';
			$item_output = $args->before;
			if ( $item->hide == "" ) {

				if ( $item->nolink == "" ) {
					$item_output .= '<a'. $attributes .'>';
				} else{
					$item_output .= '<a>';
				}

				$item_output .= $args->link_before . ( $item->icon ? '<i class="icon-' . str_replace( 'icon-', '', $item->icon ) . '"></i>' : '' ) . apply_filters( 'the_title', $item->title, $item->ID );
				$item_output .= $args->link_after;
				if ( $item->tip_label ) {
					$item_style = '';

					if ( $item->tip_bg ) {
						$item_style .= 'background-color: ' . $item->tip_bg . ';';
					}
					$item_output .= '<span class="tip" style="' . $item_style . '">' . $item->tip_label . '</span>';
				}

				$item_output .= '</a>';
			}

			$item_output .= $args->after;
			$args->bg_style = $bg_style;

			// build html
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}

	}
}
