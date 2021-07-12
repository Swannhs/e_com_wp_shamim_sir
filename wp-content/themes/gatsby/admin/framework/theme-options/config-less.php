<?php $settings = gatsby_check_theme_options(); ?>

// Border radius
<?php if ($settings['border-radius']) : ?>
	@border_base: 5px;
	@border_for_elements: 8px;
	@border_middle: 10px;
	@border_second: 15px;
	@border_large: 20px;
	@border_medium: 22px;
	@border_big: 29px;
	@border_pricing_table: 34px;
<?php else : ?>
	@border_base: 0;
	@border_for_elements: 0;
	@border_middle: 0;
	@border_second: 0;
	@border_large: 0;
	@border_medium: 0;
	@border_big: 0;
	@border_pricing_table: 0;
<?php endif ?>

<?php if ($settings['button-border-radius']): ?>
	@button_border_little: 8px;
	@button_border_small: 22px;
	@button_border_middle: 25px;
	@button_border_base: 29px;
<?php else: ?>
	@button_border_little: 0;
	@button_border_small: 0;
	@button_border_middle: 0;
	@button_border_base: 0;
<?php endif; ?>

// Selection Color
@selection_color: <?php echo esc_attr($settings['selection-color']) ?>;

// Primary Color
@primary_color: <?php echo esc_attr($settings['primary-color']) ?>;
@primary_inverse_color: <?php echo esc_attr($settings['primary-inverse-color']) ?>;

// Secondary Color
@secondary_color: <?php echo esc_attr($settings['secondary-color']) ?>;
@secondary_inverse_color: <?php echo esc_attr($settings['secondary-inverse-color']) ?>;

// Overlay Color
@overlay_color: <?php echo esc_attr($settings['overlay-color']['rgba']) ?>;

// Typography
@rest_font_family: <?php echo esc_attr($settings['rest-font']['font-family']) ?>;
@body_font_family: <?php echo esc_attr($settings['body-font']['font-family']) ?>;
@body_font_weight: <?php echo esc_attr($settings['body-font']['font-weight']) ?>;
@body_font_size: <?php echo esc_attr($settings['body-font']['font-size']) ?>;
@body_line_height: <?php echo esc_attr($settings['body-font']['line-height']) ?>;
@body_color: <?php echo esc_attr($settings['body-font']['color']) ?>;

// Headings
@h1_font_family: <?php echo esc_attr($settings['h1-font']['font-family']) ?>;
@h1_font_weight: <?php echo esc_attr($settings['h1-font']['font-weight']) ?>;
@h1_font_size: <?php echo esc_attr($settings['h1-font']['font-size']) ?>;
@h1_line_height: <?php echo esc_attr($settings['h1-font']['line-height']) ?>;
@h1_color: <?php echo esc_attr($settings['h1-font']['color']) ?>;

@h2_font_family: <?php echo esc_attr($settings['h2-font']['font-family']) ?>;
@h2_font_weight: <?php echo esc_attr($settings['h2-font']['font-weight']) ?>;
@h2_font_size: <?php echo esc_attr($settings['h2-font']['font-size']) ?>;
@h2_line_height: <?php echo esc_attr($settings['h2-font']['line-height']) ?>;
@h2_color: <?php echo esc_attr($settings['h2-font']['color']) ?>;

@h3_font_family: <?php echo esc_attr($settings['h3-font']['font-family']) ?>;
@h3_font_weight: <?php echo esc_attr($settings['h3-font']['font-weight']) ?>;
@h3_font_size: <?php echo esc_attr($settings['h3-font']['font-size']) ?>;
@h3_line_height: <?php echo esc_attr($settings['h3-font']['line-height']) ?>;
@h3_color: <?php echo esc_attr($settings['h3-font']['color']) ?>;

@h4_font_family: <?php echo esc_attr($settings['h4-font']['font-family']) ?>;
@h4_font_weight: <?php echo esc_attr($settings['h4-font']['font-weight']) ?>;
@h4_font_size: <?php echo esc_attr($settings['h4-font']['font-size']) ?>;
@h4_line_height: <?php echo esc_attr($settings['h4-font']['line-height'])?>;
@h4_color: <?php echo esc_attr($settings['h4-font']['color']) ?>;

@h5_font_family: <?php echo esc_attr($settings['h5-font']['font-family']) ?>;
@h5_font_weight: <?php echo esc_attr($settings['h5-font']['font-weight']) ?>;
@h5_font_size: <?php echo esc_attr($settings['h5-font']['font-size']) ?>;
@h5_line_height: <?php echo esc_attr($settings['h5-font']['line-height']) ?>;
@h5_color: <?php echo esc_attr($settings['h5-font']['color']) ?>;

@h6_font_family: <?php echo esc_attr($settings['h6-font']['font-family']) ?>;
@h6_font_weight: <?php echo esc_attr($settings['h6-font']['font-weight']) ?>;
@h6_font_size: <?php echo esc_attr($settings['h6-font']['font-size']) ?>;
@h6_line_height: <?php echo esc_attr($settings['h6-font']['line-height']) ?>;
@h6_color: <?php echo esc_attr($settings['h6-font']['color']) ?>;

// Body
@body_bg_color: <?php echo esc_attr($settings['body-bg']['background-color']) ?>;
@body_bg_repeat: <?php echo esc_attr($settings['body-bg']['background-repeat']) ?>;
@body_bg_size: <?php echo esc_attr($settings['body-bg']['background-size']) ?>;
@body_bg_attachment: <?php echo esc_attr($settings['body-bg']['background-attachment']) ?>;
@body_bg_position: <?php esc_attr($settings['body-bg']['background-position']) ?>;
<?php
$image = str_replace(array('http://', 'https://'), array('//', '//'), esc_attr($settings['body-bg']['background-image']))
?>
@body_bg_image: <?php echo esc_url($image) != 'none'?'url('.esc_url($image).')': $image ?>;

// Page Content
@content_bg_color: <?php echo esc_attr($settings['content-bg-color']) ?>;

// Menu
@sticky_menu_bg_color: <?php echo esc_attr($settings['sticky-menu-bg-color']) ?>;
@menu_font_family: <?php echo esc_attr($settings['menu-font']['font-family']) ?>;
@menu_font_weight: <?php echo esc_attr($settings['menu-font']['font-weight']) ?>;
@menu_font_size: <?php echo esc_attr($settings['menu-font']['font-size']) ?>;
@menu_line_height: <?php echo esc_attr($settings['menu-font']['line-height']) ?>;
@menu_text_transform: <?php echo esc_attr($settings['menu-text-transform']) ?>;
@main_menu_type_6_top_level_link_color: <?php echo esc_attr($settings['primary-type-6-toplevel-link-color']['regular']) ?>;
@menu_type_6_text_transform: <?php echo esc_attr($settings['menu-type-6-text-transform']) ?>;
@main_menu_top_level_link_color: <?php echo esc_attr($settings['primary-toplevel-link-color']['regular']) ?>;
@main_menu_top_level_hover_color: <?php echo esc_attr($settings['primary-toplevel-hover-color']['hover']) ?>;
@main_menu_grey_top_level_link_color: <?php echo esc_attr($settings['primary-toplevel-grey-type-link-color']['regular']) ?>;
@main_menu_grey_top_level_hover_color: <?php echo esc_attr($settings['primary-toplevel-grey-type-link-color']['hover']) ?>;
@menu_grey_text_transform: <?php echo esc_attr($settings['menu-grey-text-transform']) ?>;
@menu_top_level_border_link_color: <?php echo esc_attr($settings['primary-toplevel-border-type-link-color']['regular']) ?>;

// Sub Menu
@sub_menu_font_family: <?php echo esc_attr($settings['sub-menu-font']['font-family']) ?>;
@sub_menu_weight: <?php echo esc_attr($settings['sub-menu-font']['font-weight']) ?>;
@sub_menu_size: <?php echo esc_attr($settings['sub-menu-font']['font-size']) ?>;
@sub_menu_line_height: <?php echo esc_attr($settings['sub-menu-font']['line-height']) ?>;
@sub_menu_bg_color: <?php echo esc_attr($settings['sub-menu-bg-color']) ?>;
@sub_menu_heading_color: <?php echo esc_attr($settings['sub-menu-heading-color']['regular']) ?>;
@sub_menu_link_color: <?php echo esc_attr($settings['sub-menu-text-color']['regular']) ?>;
@sub_menu_hover_color: <?php echo esc_attr($settings['sub-menu-text-color']['hover']) ?>;

// Footer
@footer_bg_color: <?php echo esc_attr($settings['footer-bg']['background-color']) ?>;
@footer_bg_repeat: <?php echo esc_attr($settings['footer-bg']['background-repeat']) ?>;
@footer_bg_size: <?php echo esc_attr($settings['footer-bg']['background-size']) ?>;
@footer_bg_attachment: <?php echo esc_attr($settings['footer-bg']['background-attachment']) ?>;
@footer_bg_position: <?php echo esc_attr($settings['footer-bg']['background-position']) ?>;
<?php
$image = str_replace(array('http://', 'https://'), array('//', '//'), esc_attr($settings['footer-bg']['background-image']))
?>
@footer_bg_image: <?php echo esc_url($image) != 'none'?'url('.esc_url($image).')':$image ?>;

@footer_heading_color: <?php echo esc_attr($settings['footer-heading-color']) ?>;
@footer_text_color: <?php echo esc_attr($settings['footer-text-color']) ?>;
@footer_link_color: <?php echo esc_attr($settings['footer-link-color']['regular']) ?>;
@footer_hover_color: <?php echo esc_attr($settings['footer-link-color']['hover']) ?>;

@footer_bottom_link_color: <?php echo esc_attr($settings['footer-bottom-link-color']['regular']) ?>;
@footer_bottom_hover_color: <?php echo esc_attr($settings['footer-bottom-link-color']['hover']) ?>;

// Shop
@shop_content_color: <?php echo esc_attr($settings['shop-content-color']) ?>;
@shop_featured_bg_color: <?php echo esc_attr($settings['featured-color']) ?>;
@shop_sale_bg_color: <?php echo esc_attr($settings['sale-color']) ?>;
@shop_out_of_stock_bg_color: <?php echo esc_attr($settings['out-of-stock-color']) ?>;

