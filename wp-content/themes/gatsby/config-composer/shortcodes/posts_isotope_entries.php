<?php

if ( !class_exists('gatsby_posts_isotope_masonry_entries') ) {

	class gatsby_posts_isotope_masonry_entries {

		public $atts = array();
		public $entries = '';
		public $loop = array();

		function __construct( $atts = array() ) {

			$this->atts = shortcode_atts(array(
				'title' => '',
				'description' => '',
				'title_color' => '',
				'description_color' => '',
				'layout' => 'gt-type-4',
				'style' => 'gt-small-thumbs',
				'carousel' => '',
				'sort' => '',
				'type_sort' => 'gt-type-1',
				'align_sort' => 'align-left',
				'categories' => array(),
				'orderby' => 'date',
				'order' => 'DESC',
				'columns' => 4,
				'items' => 10,
				'items_per_page' => 3,
				'paginate' => 'pagination',
				'css_animation' => '',
				'offset' => 0,
				'action' => 'gatsby_posts_ajax_isotope_items_more'
			), $atts);

			$this->query_entries($this->atts);
		}

		public function get_sort_class( $id ) {
			$classes = "";
			$item_categories = get_the_terms( $id, 'category' );
			if ( is_object($item_categories) || is_array($item_categories) ) {
				foreach ( $item_categories as $cat ) {
					$classes .= $cat->slug . ' ';
				}
			}
			return str_replace( '%', '', $classes );
		}

		public function query_entries($params = array()) {

			if ( empty($params) ) $params = $this->atts;

			$query = array(
				'post_type' => 'post',
				'post_status' => array('publish'),
				'posts_per_page' => $params['items'],
				'orderby' => $params['orderby'],
				'order' => $params['order'],
				'offset' => $params['offset'],
				'ignore_sticky_posts'=> 1
			);

			if ( !empty($params['categories']) ) {
				$categories = explode(',', $params['categories']);
				$query['category__in'] = $categories;
			}

			$paged = get_query_var( 'page' ) ? get_query_var( 'page' ) : ( get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1 );
			$query['paged'] = $paged;

			$this->entries = new WP_Query($query);
			$this->prepare_entries($params);
		}

		public function html() {

			if ( empty($this->loop) ) return;

			$params = $this->atts;

			$defaults = array(
				'id' => '', 'link' => '', 'title' => 10, 'sort_classes' => '', 'post_format' => '',
				'item_size' => '', 'content' => '', 'image_size' => '', 'post_content' => '', 'before_content' => ''
			);

			$style = !empty($params['style']) ? $params['style'] : 'gt-big-thumbs';
			$layout = !empty($params['layout']) ? $params['layout'] : 'gt-type-1';

			ob_start(); ?>

			<?php foreach ( $this->loop as $entry ): extract( array_merge($defaults, $entry) ); ?>

				<?php switch ( $layout ):

					case 'gt-type-1': ?>

						<div id="post-<?php echo (int) $id; ?>" class="gt-col <?php echo esc_attr($sort_classes) ?>">

							<article class="gt-entry <?php echo esc_attr($format_class) ?>">

								<!-- - - - - - - - - - - - - - Attachment - - - - - - - - - - - - - - - - -->

								<div class="gt-entry-attachment">
									<?php echo ( !empty($before_content) ) ? $before_content : ''; ?>
								</div>

								<!-- - - - - - - - - - - - - - End of Attachment - - - - - - - - - - - - - - - - -->

								<!-- - - - - - - - - - - - - - Entry body - - - - - - - - - - - - - - - - -->

								<div class="gt-entry-body">

									<!-- - - - - - - - - - - - - - Entry Meta - - - - - - - - - - - - - - - - -->

									<?php echo gatsby_blog_post_meta($id,
										array(
											'container' => '',
											'like' => false,
											'comment' => false
										)); ?>

									<!-- - - - - - - - - - - - - - End of Meta - - - - - - - - - - - - - - - - -->

									<h6 class="gt-entry-title">
										<?php if ( is_sticky($id) ): ?>
											<?php printf( '<span class="sticky-post">%s</span>', esc_html__( 'Featured', 'gatsby' ) ); ?>
										<?php endif; ?>

										<a href="<?php echo esc_url($link) ?>"><?php echo esc_html($title) ?></a>
									</h6>

									<!-- - - - - - - - - - - - - - Entry Meta - - - - - - - - - - - - - - - - -->

									<div class="gt-entry-meta">
										<?php echo gatsby_entry_date( $id, true, true ); ?>
									</div>

									<!-- - - - - - - - - - - - - - End of Meta - - - - - - - - - - - - - - - - -->

								</div>

								<!-- - - - - - - - - - - - - - End of Entry body - - - - - - - - - - - - - - - - -->

							</article>

						</div>

						<?php break; ?>

					<?php case 'gt-type-3': ?>

						<div id="post-<?php echo (int) $id; ?>" class="gt-col <?php echo esc_attr($sort_classes) ?>">

							<article class="gt-entry gt-image-entry-format">

								<!-- - - - - - - - - - - - - - Attachment - - - - - - - - - - - - - - - - -->

								<?php if ( !empty($before_content) ): ?>

									<div class="gt-entry-attachment">
										<?php echo sprintf( '%s', $before_content ) ?>
									</div>

								<?php endif; ?>

								<!-- - - - - - - - - - - - - - End of Attachment - - - - - - - - - - - - - - - - -->

								<!-- - - - - - - - - - - - - - Entry body - - - - - - - - - - - - - - - - -->

								<div class="gt-entry-body">

									<h6 class="gt-entry-title">
										<?php if ( is_sticky($id) ): ?>
											<?php printf( '<span class="sticky-post">%s</span>', esc_html__( 'Featured', 'gatsby' ) ); ?>
										<?php endif; ?>

										<a href="<?php echo esc_url($link) ?>"><?php echo esc_html($title) ?></a>
									</h6>

									<!-- - - - - - - - - - - - - - Entry Excerpt - - - - - - - - - - - - - - - - -->

									<div class="gt-entry-excerpt">
										<?php
										if ( has_excerpt($id) ) {
											echo gatsby_get_excerpt( $post_content, $excerpt_count_blog, false );
										} else {
											echo apply_filters( 'the_content', $content );
											wp_link_pages(array(
												'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages', 'gatsby' ) . ':</span>',
												'after'       => '</div>',
												'link_before' => '<span>',
												'link_after'  => '</span>',
												'pagelink'    => '%',
												'separator'   => ''
											));
										}
										?>
									</div>

									<!-- - - - - - - - - - - - - - End of Entry Excerpt - - - - - - - - - - - - - - - - -->

									<!-- - - - - - - - - - - - - - Entry Meta - - - - - - - - - - - - - - - - -->

									<div class="gt-entry-meta">
										<?php echo gatsby_entry_date( $id, true ); ?>
									</div>

									<!-- - - - - - - - - - - - - - End of Meta - - - - - - - - - - - - - - - - -->

								</div>

								<!-- - - - - - - - - - - - - - End of Entry body - - - - - - - - - - - - - - - - -->

							</article>

						</div>

						<?php break; ?>

					<?php case 'gt-type-4': ?>

						<div id="post-<?php echo (int) $id; ?>" class="gt-col">

							<article class="gt-entry gt-image-entry-format">

								<!-- - - - - - - - - - - - - - Attachment - - - - - - - - - - - - - - - - -->

								<?php if ( !empty($before_content) ): ?>

									<div class="gt-entry-attachment">

										<?php echo sprintf( '%s', $before_content ) ?>

										<?php if ( $style == 'gt-small-thumbs' ): ?>
											<?php echo gatsby_entry_date( $id ); ?>
										<?php endif; ?>

									</div>

								<?php endif; ?>

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

									<?php echo gatsby_blog_post_meta($id,
										array(
											'author' => true,
											'date' => true,
											'cats' => false
										)); ?>

									<!-- - - - - - - - - - - - - - End of Meta - - - - - - - - - - - - - - - - -->

									<!-- - - - - - - - - - - - - - Entry Excerpt - - - - - - - - - - - - - - - - -->

									<div class="gt-entry-excerpt">
										<?php
										if ( has_excerpt($id) ) {
											echo gatsby_get_excerpt( $post_content, $excerpt_count_blog, false );
										} else {
											echo apply_filters( 'the_content', $content );
											wp_link_pages(array(
												'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages', 'gatsby' ) . ':</span>',
												'after'       => '</div>',
												'link_before' => '<span>',
												'link_after'  => '</span>',
												'pagelink'    => '%',
												'separator'   => ''
											));
										}
										?>
									</div>

									<!-- - - - - - - - - - - - - - End of Entry Excerpt - - - - - - - - - - - - - - - - -->

								</div>

								<!-- - - - - - - - - - - - - - End of Entry body - - - - - - - - - - - - - - - - -->

							</article>

						</div>

						<?php break; ?>

					<?php endswitch; ?>

			<?php endforeach;

			wp_reset_postdata();

			return ob_get_clean();
		}

		public function prepare_entries($params) {

			if ( empty($params )) $params = $this->atts;
			if ( empty($this->entries) || empty($this->entries->posts) ) return;

			$style = $params['style'];
			$layout = $params['layout'];
			$columns = $params['columns'];

			foreach ( $this->entries->posts as $key => $entry ) {
				$this->loop[$key]['id'] = $id = $entry->ID;
				$this->loop[$key]['link'] = get_permalink($id);
				$this->loop[$key]['title'] = get_the_title($id);
				$this->loop[$key]['sort_classes'] = $this->get_sort_class($id);
				$this->loop[$key]['post_format'] = $format = get_post_format($id) ? get_post_format($id) : 'standard';

				$this->loop[$key]['image_size'] = gatsby_blog_alias( $format, '', $style, $layout, $columns );
				$this->loop[$key]['content'] = $entry->post_content;

				switch ( $format ) {
					case 'standard': $format_class = 'gt-image-entry-format'; break;
					case 'gallery':  $format_class = 'gt-slideshow-entry-format'; break;
					case 'video': $format_class = 'gt-video-entry-format'; break;
					case 'link': $format_class = 'gt-link-entry-format'; break;
					case 'audio': $format_class = 'gt-audio-entry-format'; break;
					case 'quote': $format_class = 'gt-quote-entry-format'; break;
					default: $format_class = 'gt-image-entry-format'; break;
				}

				$this->loop[$key]['format_class'] = $format_class;

				$this_post = apply_filters( 'gatsby-entry-format-'. $format, $this->loop[$key] );

				$this->loop[$key]['post_content'] = has_excerpt( $id ) ? $entry->post_excerpt : $this_post['content'];

				if ( isset($this_post['before_content']) && !empty($this_post['before_content']) ) {
					$this->loop[$key]['before_content'] = $this_post['before_content'];
				}

			}

		}

	}

}
