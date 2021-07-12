<?php

/*  Register Widget Areas
/* ----------------------------------------------------------------- */

if (!function_exists('gatsby_widgets_register')) {

	function gatsby_widgets_register () {

		$before_widget = '<div id="%1$s" class="widget %2$s">';

		$widget_args = array(
			'before_widget' => $before_widget,
			'after_widget' => '</div>',
			'before_title' => '<h5 class="gt-widget-title">',
			'after_title' => '</h5>'
		);

		// General Widget Area
		register_sidebar(array(
			'name' => 'General Widget Area',
			'id' => 'general-widget-area',
			'description'   => esc_html__('For all pages and posts.', 'gatsby'),
			'before_widget' => $widget_args['before_widget'],
			'after_widget' => $widget_args['after_widget'],
			'before_title' => $widget_args['before_title'],
			'after_title' => $widget_args['after_title']
		));

		// Shop Widget Area
		register_sidebar(array(
			'name' => 'Shop Widget Area',
			'id' => 'shop-widget-area',
			'description'   => esc_html__('For WooCommerce pages.', 'gatsby'),
			'before_widget' => $widget_args['before_widget'],
			'after_widget' => $widget_args['after_widget'],
			'before_title' => $widget_args['before_title'],
			'after_title' => $widget_args['after_title']
		));

		// Aside Panel Widget Area
		register_sidebar(array(
			'name' => 'Aside Panel Widget Area',
			'id' => 'aside-panel-widget-area',
			'description'   => esc_html__('For aside panel.', 'gatsby'),
			'before_widget' => $widget_args['before_widget'],
			'after_widget' => $widget_args['after_widget'],
			'before_title' => $widget_args['before_title'],
			'after_title' => $widget_args['after_title']
		));

		for ($i = 1; $i <= 10; $i++) {
			register_sidebar(array(
				'name' => 'Footer Row - widget ' . $i,
				'id' => 'footer-row-' . $i,
				'before_widget' => $widget_args['before_widget'],
				'after_widget' => $widget_args['after_widget'],
				'before_title' => $widget_args['before_title'],
				'after_title' => $widget_args['after_title']
			));
		}
	}

	add_action( 'widgets_init', 'gatsby_widgets_register' );

}

/*	Include Widgets
/* ----------------------------------------------------------------- */

if (!function_exists('gatsby_unregistered_widgets')) {
	function gatsby_unregistered_widgets () {
		unregister_widget( 'LayerSlider_Widget' );
	}
	add_action('widgets_init', 'gatsby_unregistered_widgets', 1);
}

/*	Widget Facebook Like Box
/* ----------------------------------------------------------------- */

if (!class_exists('gatsby_like_box_facebook')) {

	class gatsby_like_box_facebook extends WP_Widget {

		private static $id_of_like_box = 0;

		function __construct() {
			$widget_ops = array( 'classname' => 'like_box_facebook', 'description' => 'Like box Facebook' ); // Widget Settings
			$control_ops = array( 'id_base' => 'like_box_facebook' ); // Widget Control Settings

			parent::__construct( 'like_box_facebook', 'Like box Facebook', $widget_ops, $control_ops ); // Create the widget
		}

		function widget($args, $instance) {
			self::$id_of_like_box++;
			extract( $args );
			$title = $instance['title'];
			$profile_id = $instance['profile_id'];
			$facebook_likebox_theme = $instance['facebook_likebox_theme'];
			$width = $instance['width'];
			$height = $instance['height'];
			$connections = $instance['connections'];
			$header = ($instance['header'] == 'yes') ? 'true' : 'false';

			// Before widget //
			echo $before_widget;

			// Title of widget //
			if ( $title ) { echo $before_title . $title . $after_title; }

			// Widget output //
			echo '<iframe id="like_box_widget_'. self::$id_of_like_box .'" src="http://www.facebook.com/plugins/likebox.php?href='. $profile_id .'&amp;colorscheme='. $facebook_likebox_theme .'&amp;width='. $width .'&amp;height='. $height .'&amp;connections='. $connections .'&amp;stream=false&amp;show_border=false&amp;header='. $header .'&amp;" scrolling="no" frameborder="0" allowTransparency="true" style="width:'. $width .'px; height:'. $height .'px;"></iframe>';

			echo $after_widget;
		}

		// Update Settings //
		function update ($new_instance, $old_instance) {
			$instance = $old_instance;

			$instance['title'] = strip_tags($new_instance['title']);
			$instance['profile_id'] = $new_instance['profile_id'];
			$instance['facebook_likebox_theme'] = $new_instance['facebook_likebox_theme'];
			$instance['width'] = $new_instance['width'];
			$instance['height'] = $new_instance['height'];
			$instance['connections'] = $new_instance['connections'];
			$instance['header'] =  $new_instance['header'];
			return $instance;
		}

		/* admin page opions */
		function form($instance) {

			$defaults = array(
				'title' => esc_html__('Like Us on Facebook', 'gatsby'),
				'profile_id' => '',
				'facebook_likebox_theme' => 'light',
				'width' => '235',
				'height' => '345',
				'connections' => 10,
				'header' => 'yes'
			);
			$instance = wp_parse_args( (array) $instance, $defaults );
			?>

			<p class="flb_field">
				<label for="title"><?php esc_html_e('Title', 'gatsby') ?>:</label><br>
				<input id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" class="widefat">
			</p>

			<p class="flb_field">
				<label for="<?php echo esc_attr($this->get_field_id('profile_id')); ?>"><?php esc_html_e('Page ID', 'gatsby') ?>:</label><br>
				<input id="<?php echo esc_attr($this->get_field_id('profile_id')); ?>" name="<?php echo esc_attr($this->get_field_name('profile_id')); ?>" type="text" value="<?php echo esc_attr($instance['profile_id']); ?>" class="widefat">
			</p>

			<p>
				<label><?php esc_html_e('Facebook Like box Theme', 'gatsby'); ?>:</label><br>
				<select name="<?php echo esc_attr($this->get_field_name('facebook_likebox_theme')); ?>">
					<option selected="selected" value="light"><?php esc_html_e('Light', 'gatsby') ?></option>
					<option value="dark"><?php esc_html_e('Dark', 'gatsby') ?></option>
				</select>
			</p>

			<p class="flb_field">
				<label for="<?php echo esc_attr($this->get_field_id('width')); ?>"><?php esc_html_e('Like box Width', 'gatsby') ?>:</label>
				<br>
				<input id="<?php echo esc_attr($this->get_field_id('width')); ?>" name="<?php echo esc_attr($this->get_field_name('width')); ?>" type="text" value="<?php echo esc_attr($instance['width']); ?>" class="" size="3">
				<small>(<?php esc_html_e('px', 'gatsby') ?>)</small>
			</p>

			<p class="flb_field">
				<label for="<?php echo esc_attr($this->get_field_id('height')); ?>"><?php esc_html_e("Like box Height", 'gatsby') ?>:</label>
				<br>
				<input id="<?php echo esc_attr($this->get_field_id('height')); ?>" name="<?php echo esc_attr($this->get_field_name('height')); ?>" type="text" value="<?php echo esc_attr($instance['height']); ?>" class="" size="3">
				<small>(<?php esc_html_e('px', 'gatsby') ?>)</small>
			</p>

			<p class="flb_field">
				<label for="<?php echo esc_attr($this->get_field_id('connections')); ?>"><?php esc_html_e('Number of connections', 'gatsby') ?>:</label>
				<br>
				<input id="<?php echo esc_attr($this->get_field_id('connections')); ?>" name="<?php echo esc_attr($this->get_field_name('connections')); ?>" type="text" value="<?php echo esc_attr($instance['connections']); ?>" class="" size="3">
				<small>(<?php esc_html_e("Max. 100", 'gatsby') ?>)</small>
			</p>

			<p class="flb_field">
				<label><?php esc_html_e('Show Header', 'gatsby') ?>:</label><br>
				<input name="<?php echo esc_attr($this->get_field_name('header')); ?>" type="radio" value="yes" <?php checked( $instance[ 'header' ], 'yes' ); ?>><?php esc_html_e("Yes", 'gatsby') ?>
				<input name="<?php echo esc_attr($this->get_field_name('header')); ?>" type="radio" value="no" <?php checked( $instance[ 'header' ], 'no'); ?>><?php esc_html_e("No", 'gatsby') ?>
			</p>

			<?php
		}
	}

}

if (!class_exists('gatsby_widget_popular_widget')) {

	class gatsby_widget_popular_widget extends WP_Widget {

		public $defaults = array();
		public $version = "1.0.1";

		function __construct() {

			parent::__construct( 'popular-widget', esc_html__('Gatsby Popular and Latest Posts', 'gatsby'),
				array(
					'classname' => 'widget_popular_posts',
					'description' => esc_html__("Display most popular and latest posts", 'gatsby')
				)
			);

			define('GATSBY_POPWIDGET_URL', get_template_directory_uri() . '/includes/widgets/popular-widget/');
			define('GATSBY_POPWIDGET_ABSPATH', str_replace("\\", "/", get_template_directory() . '/includes/widgets/popular-widget'));

			$this->defaults = array(
				'title' => '',
				'counter' => false,
				'excerptlength' => 5,
				'meta_key' => '_popular_views',
				'calculate' => 'visits',
				'limit' => 3,
				'thumb' => false,
				'excerpt' => false,
				'type' => 'popular'
			);

			add_action('admin_enqueue_scripts', array(&$this, 'load_admin_styles'));
			add_action('wp_enqueue_scripts', array(&$this, 'load_scripts_styles'), 1);
			add_action('wp_ajax_popwid_page_view_count', array(&$this, 'set_post_view'));
			add_action('wp_ajax_nopriv_popwid_page_view_count', array(&$this, 'set_post_view'));

		}

		function widget($args, $instance) {
			if (file_exists(GATSBY_POPWIDGET_ABSPATH . '/inc/widget.php')) {
				include(GATSBY_POPWIDGET_ABSPATH . '/inc/widget.php');
			}
		}

		function form($instance) {
			if (file_exists(GATSBY_POPWIDGET_ABSPATH . '/inc/form.php')) {
				include(GATSBY_POPWIDGET_ABSPATH . '/inc/form.php');
			}
		}

		function update($new_instance, $old_instance) {
			foreach ($new_instance as $key => $val) {
				if (is_array($val)) {
					$new_instance[$key] = $val;
				} elseif (in_array($key, array('limit', 'excerptlength'))) {
					$new_instance[$key] = intval($val);
				} elseif (in_array($key, array('calculate'))) {
					$new_instance[$key] = trim($val, ',');
				}
			}
			if (empty($new_instance['meta_key'])) {
				$new_instance['meta_key'] = $this->defaults['meta_key'];
			}
			return $new_instance;
		}

		function load_admin_styles() {
			global $pagenow;
			if ($pagenow != 'widgets.php' ) return;

			wp_enqueue_style( 'gatsby_popular-admin', GATSBY_POPWIDGET_URL . 'css/admin.css', NULL, $this->version );
			wp_enqueue_script( 'gatsby_popular-admin', GATSBY_POPWIDGET_URL . 'js/admin.js', array('jquery',), $this->version, true );
		}

		function load_scripts_styles(){

			if (! is_admin() || is_active_widget( false, false, $this->id_base, true )) {
				wp_enqueue_script( 'gatsby_popular-widget', GATSBY_POPWIDGET_URL . 'js/pop-widget.js', array('gatsby_core'), $this->version, true);
			}

			if (! is_singular() && ! apply_filters( 'pop_allow_page_view', false )) return;

			global $post;
			wp_localize_script ( 'gatsby_popular-widget', 'popwid', apply_filters( 'pop_localize_script_variables', array(
				'postid' => $post->ID
			), $post ));
		}

		function field_id($field) {
			echo $this->get_field_id($field);
		}

		function field_name($field) {
			echo $this->get_field_name($field);
		}

		function limit_words($string, $word_limit) {
			$words = explode(" ", wp_strip_all_tags(strip_shortcodes($string)));

			if ($word_limit && (str_word_count($string) > $word_limit)) {
				return $output = implode(" ",array_splice( $words, 0, $word_limit )) ."...";
			} else if( $word_limit ) {
				return $output = implode(" ", array_splice( $words, 0, $word_limit ));
			} else {
				return $string;
			}
		}

		function get_post_image($post_id, $size) {

			if (has_post_thumbnail($post_id) && function_exists('has_post_thumbnail')) {
				return get_the_post_thumbnail($post_id, $size);
			}

			$images = get_children(array(
				'order' => 'ASC',
				'numberposts' => 1,
				'orderby' => 'menu_order',
				'post_parent' => $post_id,
				'post_type' => 'attachment',
				'post_mime_type' => 'image',
			), $post_id, $size);

			if (empty($images)) return false;

			foreach($images as $image) {
				return wp_get_attachment_image($image->ID, $size);
			}
		}

		function set_post_view() {

			$post_id = absint($_POST['postid']);

			if (empty($post_id)) return;
			if (!apply_filters('pop_set_post_view', true)) return;

			global $wp_registered_widgets;

			$meta_key_old = false;
			$postid = $post_id;
			$widgets = get_option($this->option_name);

			foreach ((array) $widgets as $number => $widget) {
				if (!isset($wp_registered_widgets["popular-widget-{$number}"])) continue;

				$instance = $wp_registered_widgets["popular-widget-{$number}"];
				$meta_key = isset( $instance['meta_key'] ) ? $instance['meta_key'] : '_popular_views';

				if ($meta_key_old == $meta_key) continue;

				do_action( 'pop_before_set_pos_view', $instance, $number );

				if (isset($instance['calculate']) && $instance['calculate'] == 'visits') {
					if (!isset( $_COOKIE['popular_views_'.COOKIEHASH])) {
						setcookie( 'popular_views_' . COOKIEHASH, "$postid|", 0, COOKIEPATH );
						update_post_meta( $postid, $meta_key, get_post_meta( $postid, $meta_key, true ) +1 );
					} else {
						$views = explode("|", $_COOKIE['popular_views_' . COOKIEHASH]);
						foreach( $views as $post_id ){
							if( $postid == $post_id ) {
								$exist = true;  break;
							}
						}
					}
					if (empty($exist)) {
						$views[] = $postid;
						setcookie( 'popular_views_' . COOKIEHASH, implode( "|", $views ), 0 , COOKIEPATH );
						update_post_meta( $postid, $meta_key, get_post_meta( $postid, $meta_key, true ) +1 );
					}
				} else {
					update_post_meta( $postid, $meta_key, get_post_meta( $postid, $meta_key, true ) +1 );
				}
				$meta_key_old = $meta_key;
				do_action( 'pop_after_set_pos_view', $instance, $number );
			}
			die();
		}

		function get_latest_posts() {
			extract($this->instance);
			$posts = wp_cache_get("pop_latest_{$number}", 'pop_cache');

			if ($posts == false) {
				$args = array(
					'suppress_fun' => true,
					'post_type' => 'post',
					'posts_per_page' => $limit
				);
				$posts = get_posts(apply_filters('pop_get_latest_posts_args', $args));
				wp_cache_set("pop_latest_{$number}", $posts, 'pop_cache');

			}
			return $this->display_posts($posts);
		}

		function get_most_viewed() {
			extract($this->instance);
			$viewed = wp_cache_get("pop_viewed_{$number}", 'pop_cache');

			if ($viewed == false) {
				global $wpdb;  $join = $where = '';
				$viewed = $wpdb->get_results( $wpdb->prepare( "SELECT SQL_CALC_FOUND_ROWS p.*, meta_value as views FROM $wpdb->posts p " .
					"JOIN $wpdb->postmeta pm ON p.ID = pm.post_id AND meta_key = %s AND meta_value != '' " .
					"WHERE 1=1 AND p.post_status = 'publish' AND post_date >= '{$this->time}' AND p.post_type IN ( 'post' )" .
					"GROUP BY p.ID ORDER BY ( meta_value+0 ) DESC LIMIT $limit", $meta_key));
				wp_cache_set( "pop_viewed_{$number}", $viewed, 'pop_cache');
			}
			return $this->display_posts($viewed);
		}

		function display_posts($posts) {

			if (empty ($posts) && !is_array($posts)) return;

			extract( $this->instance );

			ob_start(); ?>

			<?php foreach ($posts as $key => $post) :
				$commentCount = get_comments_number($post->ID);
				$link = get_permalink($post->ID);
			?>

			<article class="gt-entry">

				<?php if ( !empty($thumb) ): ?>

					<?php if ( has_post_thumbnail($post->ID) ): ?>

						<?php $image = Gatsby_Helper::get_the_post_thumbnail($post->ID, '100*100', true, array('title' => esc_attr( $post->post_title ), 'alt' => esc_attr( $post->post_title ))); ?>

						<?php if (isset($image)): ?>
							<a class="gt-entry-image" href="<?php echo esc_url( get_permalink( $post->ID ) ) ?>" title="<?php echo esc_attr( $post->post_title ); ?>">
								<?php echo $image; ?>
							</a>
						<?php endif; ?>

					<?php endif; ?>

				<?php endif; ?>

					<h6 class="gt-entry-title">
						<a href="<?php echo esc_url(get_permalink($post->ID)) ?>"><?php echo esc_html($post->post_title) ?></a>
						<?php if ( !empty($counter) && isset($post->views) ): ?>
							<span class="gt-widget-counter">(<?php echo preg_replace( "/(?<=\d)(?=(\d{3})+(?!\d))/", ",", $post->views) ?>)</span>
						<?php endif; ?>
					</h6>

					<div class="gt-entry-meta">

						<?php
						$time_string = '<time class="gt-entry-date published updated" datetime="%1$s">%2$s</time>';
						$time_string = sprintf( $time_string,
							esc_attr( get_the_date( get_the_date( 'c' ), $post->ID ) ),
							get_the_date('j F, Y', $post->ID)
						);

						printf( '%1$s', $time_string );
						?>

					</div>

				<?php if (!empty($excerpt)): ?>
					<?php if ($post->post_excerpt): ?>
						<p class="gt-entry-post-summary"><?php echo $this->limit_words( ( $post->post_excerpt ), $excerptlength ); ?></p>
					<?php else: ?>
						<p class="gt-entry-post-summary"><?php echo $this->limit_words( ( $post->post_content ), $excerptlength ); ?></p>
					<?php endif; ?>
				<?php endif; ?>

			</article>

			<?php endforeach; return ob_get_clean();
		}

	}
}

/*	Widget Social Links
/* ----------------------------------------------------------------- */

if (!class_exists('gatsby_widget_social_links')) {

	class gatsby_widget_social_links extends Gatsby_Widget {

		function __construct() {
			$this->widget_cssclass    = 'widget_social_links';
			$this->widget_description =  esc_html__('Displays website social links', 'gatsby');
			$this->widget_id          = 'widget-social-links';
			$this->widget_name        = esc_html__('Gatsby Social Links', 'gatsby');
			$this->settings           = array(
				'title'  => array(
					'type'  => 'text',
					'label' => esc_html__( 'Title', 'gatsby' ),
					'std'   => esc_html__( 'Follow Us', 'gatsby' )
				),
				'linkedin_links'  => array(
					'type'  => 'text',
					'label' => esc_html__('LinkedIn Link', 'gatsby'),
					'std'   => ''
				),
				'tumblr_links'  => array(
					'type'  => 'text',
					'label' => esc_html__('Tumblr Link', 'gatsby'),
					'std'   =>''
				),
				'vimeo_links'  => array(
					'type'  => 'text',
					'label' => esc_html__('Vimeo Link', 'gatsby'),
					'std'   => ''
				),
				'facebook_links'  => array(
					'type'  => 'text',
					'label' => esc_html__('Facebook Link', 'gatsby'),
					'std'   => ''
				),
				'flickr_links'  => array(
					'type'  => 'text',
					'label' => esc_html__('Flickr Link', 'gatsby'),
					'std'   => ''
				),
				'twitter_links'  => array(
					'type'  => 'text',
					'label' => esc_html__('Twitter Link', 'gatsby'),
					'std'   => ''
				),
				'gplus_links'  => array(
					'type'  => 'text',
					'label' => esc_html__('Google Plus Link', 'gatsby'),
					'std'   => ''
				),
				'pinterest_links'  => array(
					'type'  => 'text',
					'label' => esc_html__('Pinterest Link', 'gatsby'),
					'std'   => ''
				),
				'instagram_links'  => array(
					'type'  => 'text',
					'label' => esc_html__('Instagram Link', 'gatsby'),
					'std'   => ''
				),
				'youtube_links'  => array(
					'type'  => 'text',
					'label' => esc_html__('Youtube Link', 'gatsby'),
					'std'   => ''
				)
			);
			parent::__construct();
		}

		function widget($args, $instance) {
			$data = array();
			$data['linkedin_links'] = isset( $instance['linkedin_links'] ) ? $instance['linkedin_links'] : $this->settings['linkedin_links']['std'];
			$data['tumblr_links'] = isset( $instance['tumblr_links'] ) ? $instance['tumblr_links'] : $this->settings['tumblr_links']['std'];
			$data['vimeo_links'] = isset( $instance['vimeo_links'] ) ? $instance['vimeo_links'] : $this->settings['vimeo_links']['std'];
			$data['facebook_links'] = isset( $instance['facebook_links'] ) ? $instance['facebook_links'] : $this->settings['facebook_links']['std'];
			$data['flickr_links'] = isset( $instance['flickr_links'] ) ? $instance['flickr_links'] : $this->settings['flickr_links']['std'];
			$data['youtube_links'] = isset( $instance['youtube_links'] ) ? $instance['youtube_links'] : $this->settings['youtube_links']['std'];
			$data['twitter_links'] = isset( $instance['twitter_links'] ) ? $instance['twitter_links'] : $this->settings['twitter_links']['std'];
			$data['gplus_links'] = isset( $instance['gplus_links'] ) ? $instance['gplus_links'] : $this->settings['gplus_links']['std'];
			$data['pinterest_links'] = isset( $instance['pinterest_links'] ) ? $instance['pinterest_links'] : $this->settings['pinterest_links']['std'];
			$data['instagram_links'] = isset( $instance['instagram_links'] ) ? $instance['instagram_links'] : $this->settings['instagram_links']['std'];

			$this->widget_start( $args, $instance );
				echo Gatsby_Helper::output_widgets_html('social_links', $data);
			$this->widget_end($args);
		}

	}
}

/*	Widget Advertising Area
/* ----------------------------------------------------------------- */

if (!class_exists('gatsby_widget_advertising_area')) {

	class gatsby_widget_advertising_area extends Gatsby_Widget {

		function __construct() {
			$this->widget_cssclass    = 'widget_advertising_area';
			$this->widget_description = esc_html__('An advertising widget that displays image', 'gatsby');
			$this->widget_id          = __CLASS__;
			$this->widget_name        = esc_html__('Gatsby Advertising Area', 'gatsby');
			$this->settings           = array(
				'title'  => array(
					'type'  => 'text',
					'std'   => '',
					'label' => esc_html__( 'Title', 'gatsby' )
				),
				'image_url'  => array(
					'type'  => 'text',
					'std'   => '',
					'label' => esc_html__( 'Image URL', 'gatsby' )
				),
				'ref_url'  => array(
					'type'  => 'text',
					'std'   => '#',
					'label' => esc_html__( 'Referal URL', 'gatsby' )
				),
			);

			parent::__construct();
		}

		function widget($args, $instance) {
			$title = isset( $instance['title'] ) ? $instance['title'] : $this->settings['title']['std'];
			$image_url = isset( $instance['image_url'] ) ? $instance['image_url'] : $this->settings['image_url']['std'];
			$ref_url = isset( $instance['ref_url'] ) ? $instance['ref_url'] : $this->settings['ref_url']['std'];

			if (empty($image_url)) {
				$image_url = '<span>'.esc_html__('Advertise here', 'gatsby').'</span>';
			} else {
				$image_url = '<img class="advertise-image" src="' . esc_url($image_url) . '" title="" alt=""/>';
			}

			ob_start(); ?>

			<?php $this->widget_start( $args, $instance ); ?>
				<a target="_blank" href="<?php echo esc_url($ref_url); ?>"><?php echo sprintf('%s', $image_url); ?></a>
			<?php $this->widget_end($args);

			echo ob_get_clean();
		}

	}
}

/*	Widget Contact Us
/* ----------------------------------------------------------------- */

if (!class_exists('gatsby_widget_contact_us')) {

	class gatsby_widget_contact_us extends WP_Widget {

		function __construct() {
			$settings = array('classname' => 'widget_contact_us', 'description' => esc_html__('Displays contact us', 'gatsby'));

			parent::__construct(__CLASS__, esc_html__('Gatsby Contact Us', 'gatsby'), $settings);
		}

		function widget($args, $instance) {
			extract($args, EXTR_SKIP);

			$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
			$address = empty($instance['address']) ? '' : $instance['address'];
			$phone = empty($instance['phone']) ? '' : $instance['phone'];
			$email = empty($instance['email']) ? '' : $instance['email'];
			$skype = empty($instance['skype']) ? '' : $instance['skype'];

			ob_start(); ?>

			<?php echo $before_widget; ?>

			<?php if ($title !== ''): ?>
				<?php echo $before_title . $title . $after_title; ?>
			<?php endif; ?>

			<ul class="contact_info">

				<?php if (!empty($address)): ?>
					<li>
						<i class="icon-location-1"></i><?php echo sprintf('%s', $address) ?>
					</li>
				<?php endif; ?>

				<?php if (!empty($phone)): ?>
					<li>
						<i class="icon-phone"></i><?php echo sprintf('%s', $phone) ?>
					</li>
				<?php endif; ?>

				<?php if (!empty($email)): ?>
					<li>
						<i class="icon-mail"></i><a target="_blank" class="over" href="mailto:<?php echo antispambot($email, 1) ?>"><?php echo sprintf('%', $email) ?></a>
					</li>
				<?php endif; ?>

				<?php if (!empty($skype)): ?>
					<li>
						<i class="icon-skype"></i><?php echo sprintf('%s', $skype) ?>
					</li>
				<?php endif; ?>

			</ul><!--/ .c_info_list-->

			<?php echo $after_widget; ?>

			<?php echo ob_get_clean();
		}

		function update($new_instance, $old_instance) {
			$instance = $old_instance;
			foreach($new_instance as $key => $value) {
				$instance[$key]	= strip_tags($new_instance[$key]);
			}
			return $instance;
		}

		function form($instance) {
			$defaults = array(
				'title' => esc_html__('Contact Us', 'gatsby'),
				'address' => esc_html__('9870 St Vincent Place, Glasgow, DC 45 Fr 45', 'gatsby'),
				'phone' => '+1 800 559 6580',
				'email' => 'info@companyname.com',
				'skype' => 'companyname'
			);
			$instance = wp_parse_args( (array) $instance, $defaults );
			?>

			<p>
				<label><?php esc_html_e('Title', 'gatsby');?>:
					<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" class="widefat" type="text" />
				</label>
			</p>

			<p>
				<label><?php esc_html_e('Address', 'gatsby');?>:
					<input id="<?php echo esc_attr($this->get_field_id( 'address' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'address' )); ?>" value="<?php echo esc_attr($instance['address']); ?>" class="widefat" type="text"/>
				</label>
			</p>

			<p>
				<label><?php esc_html_e('Phone', 'gatsby');?>:
					<input id="<?php echo esc_attr($this->get_field_id( 'phone' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'phone' )); ?>" value="<?php echo esc_attr($instance['phone']); ?>" class="widefat" type="text"/>
				</label>
			</p>

			<p>
				<label><?php esc_html_e('E-mail', 'gatsby');?>:
					<input id="<?php echo esc_attr($this->get_field_id( 'email' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'email' )); ?>" value="<?php echo esc_attr($instance['email']); ?>" class="widefat" type="text"/>
				</label>
			</p>

			<p>
				<label><?php esc_html_e('Skype', 'gatsby');?>:
					<input id="<?php echo esc_attr($this->get_field_id( 'skype' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'skype' )); ?>" value="<?php echo $instance['skype']; ?>" class="widefat" type="text"/>
				</label>
			</p>

		<?php
		}

	}
}


/*	Widget Testimonials
/* ----------------------------------------------------------------- */

if (!class_exists('gatsby_widget_testimonials')) {

	class gatsby_widget_testimonials extends Gatsby_Widget {

		public $entries = '';

		public function __construct() {
			$this->widget_cssclass    = 'widget_testimonials';
			$this->widget_description = esc_html__('Use this widget to add a testimonials to your site.', 'gatsby');
			$this->widget_id          = 'widget-testimonials';
			$this->widget_name        = esc_html__('Gatsby Testimonials', 'gatsby');
			$this->settings           = array(
				'title'  => array(
					'type'  => 'text',
					'std'   => esc_html__( 'Testimonials', 'gatsby' ),
					'label' => esc_html__( 'Title', 'gatsby' )
				),
				'count' => array(
					'type'  => 'select',
					'std'   => '-1',
					'label' => esc_html__( 'Count', 'gatsby' ),
					'options' => $this->array_number(1, 11, 1, array('-1' => 'All')),
					'desc' => esc_html__( 'How many items should be displayed per page?', 'gatsby' )
				),
				'type' => array(
					'type'  => 'select',
					'std'   => 'list',
					'label' => esc_html__( 'Type', 'gatsby' ),
					'options' => array(
						'widgets_list' => esc_html__('List', 'gatsby'),
						'widgets_carousel' => esc_html__('Carousel', 'gatsby')
					),
					'desc' => esc_html__( 'How many items should be displayed per page?', 'gatsby' )
				),
				'orderby' => array(
					'type'  => 'select',
					'std'   => 'date',
					'label' => esc_html__( 'Order by', 'gatsby' ),
					'options' => $this->get_order_sort_array()
				)
			);

			parent::__construct();
		}

		function widget($args, $instance) {
			$count = isset( $instance['count'] ) ? $instance['count'] : $this->settings['count']['std'];
			$type = isset( $instance['type'] ) ? $instance['type'] : $this->settings['type']['std'];
			$orderby = isset( $instance['orderby'] ) ? $instance['orderby'] : $this->settings['orderby']['std'];

			$query = array(
				'post_type' => 'testimonials',
				'orderby' => $orderby,
				'posts_per_page' => $count
			);

			$this->entries = new WP_Query($query);

			if (empty($this->entries) || empty($this->entries->posts)) return;

			$this->widget_start( $args, $instance ); ?>

			<div class="<?php echo esc_attr($type) ?>">

				<?php foreach ($this->entries->posts as $entry):
						$id = $entry->ID;
						$name = get_the_title($id);
						$link  = get_permalink($id);
						$place = mad_meta( 'gatsby_tm_place', '', $id);
					?>
					<blockquote>
						<div class="author_info"><a href="<?php echo esc_url($link); ?>"><b><?php echo esc_html($name) ?>, <?php echo esc_html($place) ?></b></a></div>
						<p><?php echo $entry->post_content; ?></p>
					</blockquote>
				<?php endforeach; ?>

			</div><!--/ .widgets_carousel-->

			<footer class="bottom_box">
				<a href="<?php echo esc_url(get_post_type_archive_link('testimonials')); ?>" class="button_grey middle_btn">
					<?php esc_html_e('View All Testimonials', 'gatsby') ?>
				</a>
			</footer><!--/ .bottom_box-->

			<?php $this->widget_end($args);
		}

		public function array_number($from = 0, $to = 50, $step = 1, $array = array()) {
			for ($i = $from; $i <= $to; $i += $step) {
				$array[$i] = $i;
			}
			return $array;
		}

		public function get_order_sort_array() {
			return array('ID' => 'ID', 'date' => 'date', 'post_date' => 'post_date', 'title' => 'title',
				'post_title' => 'post_title', 'name' => 'name', 'post_name' => 'post_name', 'modified' => 'modified',
				'post_modified' => 'post_modified', 'modified_gmt' => 'modified_gmt', 'post_modified_gmt' => 'post_modified_gmt',
				'menu_order' => 'menu_order', 'parent' => 'parent', 'post_parent' => 'post_parent',
				'rand' => 'rand', 'comment_count' => 'comment_count', 'author' => 'author', 'post_author' => 'post_author');
		}

	}
}

/*	Widget Flickr
/* ----------------------------------------------------------------- */

if (!class_exists('gatsby_widget_flickr')) {

	class gatsby_widget_flickr extends WP_Widget {

		function __construct() {
			$settings = array('classname' => 'widget_flickr', 'description' => esc_html__('Flickr feed widget', 'gatsby'));
			parent::__construct(__CLASS__,  esc_html__('Gatsby Flickr feed', 'gatsby'), $settings);
		}

		function widget($args, $instance) {
			extract($args, EXTR_SKIP);

			$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
			$unique_id = rand(0, 300);

			echo $before_widget;

			if ($title !== '') {
				echo $before_title . $title . $after_title;
			}

			?>

			<ul id="flickr_feed_<?php echo absint($unique_id) ?>" class="flickr_feed"></ul>

			<script type="text/javascript">
				jQuery(function () {
					jQuery('#flickr_feed_<?php echo absint($unique_id) ?>').jflickrfeed({
						limit: <?php echo absint($instance['imagescount']) ?>,
						qstrings: { id: '<?php echo $instance['username'] ?>' },
						itemTemplate: '<li><a class="fancybox" target="_blank" href="{{image_b}}"><img width="100" height="100" src="{{image_s}}" alt="{{title}}" /></a></li>'
					}, function() {
						jQuery(this).find('.fancybox').fancybox();
					});
				});
			</script>

			<?php echo $after_widget;
		}

		function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['username'] = $new_instance['username'];
			$instance['imagescount'] = (int) $new_instance['imagescount'];
			return $instance;
		}

		function form($instance) {
			$defaults = array(
				'title' => 'Flickr Feed',
				'username' => '76745153@N04',
				'imagescount' => '8',
			);
			$instance = wp_parse_args((array) $instance, $defaults); ?>

			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title', 'gatsby') ?>:</label>
				<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr($this->get_field_id('username')); ?>"><?php esc_html_e('Flickr Username', 'gatsby') ?>:</label>
				<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('username')); ?>" name="<?php echo esc_attr($this->get_field_name('username')); ?>" value="<?php echo esc_attr($instance['username']); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr($this->get_field_id('imagescount')); ?>"><?php esc_html_e('Number of images', 'gatsby') ?>:</label>
				<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('imagescount')); ?>" name="<?php echo esc_attr($this->get_field_name('imagescount')); ?>" value="<?php echo esc_attr($instance['imagescount']); ?>" />
			</p>

		<?php
		}

	}
}

add_action('widgets_init', function() {
	register_widget("gatsby_widget_popular_widget");
	register_widget("gatsby_widget_social_links");
	register_widget("gatsby_widget_advertising_area");
	register_widget("gatsby_widget_contact_us");
	register_widget("gatsby_widget_testimonials");
	register_widget("gatsby_widget_flickr");
	register_widget("gatsby_like_box_facebook");
});

?>