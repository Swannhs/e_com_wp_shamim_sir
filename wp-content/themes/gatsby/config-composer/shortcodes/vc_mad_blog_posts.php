<?php

class WPBakeryShortCode_VC_mad_blog_posts extends WPBakeryShortCode {

	public $atts = array();
	public $entries = '';

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'title' => '',
			'tag_title' => 'h2',
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
			'paginate' => 'none',
			'css_animation' => '',
			'action' => 'gatsby_posts_ajax_isotope_items_more'
		), $atts, 'vc_mad_blog_posts');

		$this->query_entries();
		$html = $this->html();

		return $html;
	}

	protected function sort_links( $entries, $params ) {

		$categories = get_categories(array(
			'taxonomy'	=> 'category',
			'hide_empty'=> 0
		));
		$current_cats = array();
		$display_cats = is_array($params['categories']) ? $params['categories'] : array_filter(explode(',', $params['categories']));
		$type_sort = !empty($params['type_sort']) ? $params['type_sort'] : 'gt-type-1';
		$align_sort = !empty($params['align_sort']) ? $params['align_sort'] : 'align-left';

		foreach ( $entries as $entry ) {
			if ( $current_item_cats = get_the_terms( $entry->ID, 'category' ) ) {
				if ( !empty($current_item_cats) ) {
					foreach ($current_item_cats as $current_item_cat) {
						if (empty($display_cats) || in_array($current_item_cat->term_id, $display_cats)) {
							$current_cats[$current_item_cat->term_id] = $current_item_cat->term_id;
						}
					}
				}
			}
		}

		$css_classes = array(
			'gt-filter',
			$type_sort,
			$align_sort
		);

		$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );

		ob_start(); ?>

		<!-- - - - - - - - - - - - - - Filter - - - - - - - - - - - - - - - - -->

		<nav class="<?php echo esc_attr( trim($css_class) ) ?>">
			<ul>

				<li><a href="javascript:void(0)" class="gt-active" data-filter="*"><?php esc_html_e('All', 'gatsby') ?></a></li>

				<?php $delay = 0; ?>

				<?php foreach ( $categories as $category ): ?>
					<?php if ( in_array($category->term_id, $current_cats) ): ?>
						<?php $nicename = str_replace('%', '', $category->category_nicename); ?>
						<li><a href="javascript:void(0)" data-filter=".<?php echo esc_attr($nicename) ?>"><?php echo esc_html(trim($category->cat_name)); ?></a></li>
						<?php $delay += 100 ?>
					<?php endif; ?>

				<?php endforeach ?>

			</ul>
		</nav><!--/ .gt-filter-->

		<!-- - - - - - - - - - - - - - End of Filter - - - - - - - - - - - - - - - - -->

		<?php return ob_get_clean();
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

	public function query_entries() {

		$params = $this->atts;

		$query = array(
			'post_type' => 'post',
			'posts_per_page' => $params['items'],
			'orderby' => $params['orderby'],
			'order' => $params['order'],
			'ignore_sticky_posts'=> 1,
			'post_status' => array('publish')
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

		global $gatsby_settings;
		$entries = $this->entries;
		$params = $this->atts;

		$post_loop = 1;
		$wrapper_attributes = array();
		$title = !empty($params['title']) ? $params['title'] : '';
		$tag_title = !empty($params['tag_title']) ? $params['tag_title'] : 'h2';
		$description = !empty($params['description']) ? $params['description'] : '';
		$title_color = !empty($params['title_color']) ? $params['title_color'] : '';
		$description_color = !empty($params['description_color']) ? $params['description_color'] : '';
		$css_animation = !empty($params['css_animation']) ? $params['css_animation'] : '';
		$sort = $params['sort'] == 'yes' ? true : false;

		$layout = $style = $columns = $carousel = $paginate = $before_content = $content = '';

		extract($params);
		$atts = array();
		$class_container = '-isotope-';

		$defaults = array(
			'id' => '', 'link' => '', 'title' => 10, 'sort_classes' => '', 'post_format' => '',
			'item_size' => '', 'content' => '', 'image_size' => '', 'post_content' => '', 'before_content' => ''
		);

		$css_classes = array(
			'gt-entries-holder',
			$layout,
			'gt-paginate-' . $paginate
		);

		switch ( $layout ) {
			case 'gt-type-1':
				$css_classes[] = 'gt-isotope';
				$atts['masonry'] = 'true';
				$excerpt_count_blog = '';

				if ( $carousel ) {
					$css_classes[] = 'owl-carousel';
					$css_classes[] = 'owl-large-nav';
					$css_classes[] = 'gt-cols-' . absint($columns);
				}

				break;
			case 'gt-type-3':
				$css_classes[] = 'gt-isotope';
				$excerpt_count_blog = 70;
				$atts['masonry'] = 'true';
				break;
			case 'gt-type-4':
				$css_classes[] = $style;
				$css_classes[] = 'gt-cols-1';
				$class_container = '-';
				$columns = 1;

				switch ( $style ) {
					case 'gt-big-thumbs':
						$excerpt_count_blog = $gatsby_settings['excerpt-count-big-thumbs'];
						break;
					case 'gt-small-thumbs':
						$excerpt_count_blog = $gatsby_settings['excerpt-count-small-thumbs'];
						break;
				}

				break;
		}

		$css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );

		$wrapper_attributes[] = gatsby_create_data_string($atts);
		$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

		ob_start(); ?>

		<div class="wpb_content_element">

			<?php
			echo Gatsby_Vc_Config::getParamTitle(
				array(
					'title' => $title,
					'tag_title' => $tag_title,
					'description' => $description,
					'title_color' => $title_color,
					'description_color' => $description_color,
				)
			);
			?>

			<?php $delay = 0; $i = 1; ?>

			<div <?php echo implode( ' ', $wrapper_attributes ) ?>>

				<?php echo ( $sort ) ? $this->sort_links( $this->entries->posts, $params ) : ""; ?>

				<?php if ( !$carousel ): ?>
					<div class="gt<?php echo esc_attr($class_container) ?>container <?php echo 'gt-cols-' . absint($columns) ?>">
				<?php endif; ?>

					<?php foreach ( $this->loop as $entry ): extract( array_merge($defaults, $entry) ); ?>

						<?php switch ( $layout ):

							case 'gt-type-1': ?>

								<?php if ( !$carousel ): ?>
									<?php if ( $i == 1 ): ?>
										<div class="gt-grid-sizer"></div>
									<?php endif; ?>
								<?php endif; ?>

								<div id="post-<?php echo (int) $id; ?>" class="gt-col <?php echo esc_attr($sort_classes) ?>" <?php echo ( '' !== $css_animation ) ? Gatsby_Helper::create_data_string_animation( $css_animation, 0, '' ) : '' ?>>

									<article class="gt-entry <?php echo esc_attr($format_class) ?>">

										<!-- - - - - - - - - - - - - - Attachment - - - - - - - - - - - - - - - - -->

										<div class="gt-entry-attachment">

											<?php if ( $carousel ): ?>
												<?php
													if ( has_post_thumbnail($id) ) {
														echo "<a href='{$link}' title='". sprintf(esc_attr__('%s', 'gatsby'), get_the_title($id)) ."' class='gt-thumbnail-attachment'>" . Gatsby_Helper::get_the_post_thumbnail( $id, $image_size, true, '', array( 'alt' => trim(strip_tags(get_the_title($id))) ) ) . "</a>";
													}
												?>
											<?php else: ?>
												<?php echo ( !empty($before_content) ) ? $before_content : ''; ?>
											<?php endif; ?>

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

								<?php $i++; ?>

							<?php break; ?>

							<?php case 'gt-type-3': ?>

								<?php if ( $i == 1 ): ?>
									<div class="gt-grid-sizer"></div>
								<?php endif; ?>

								<div id="post-<?php echo (int) $id; ?>" class="gt-col <?php echo esc_attr($sort_classes) ?>"  <?php echo ( '' !== $css_animation ) ? Gatsby_Helper::create_data_string_animation( $css_animation, 0, '' ) : '' ?>>

									<article class="gt-entry <?php echo esc_attr($format_class) ?>">

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
													echo gatsby_get_excerpt( $post_content, $excerpt_count_blog );
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
												<?php echo gatsby_entry_date( $id, true, true, true ); ?>
											</div>

											<!-- - - - - - - - - - - - - - End of Meta - - - - - - - - - - - - - - - - -->

										</div>

										<!-- - - - - - - - - - - - - - End of Entry body - - - - - - - - - - - - - - - - -->

									</article>

								</div>

								<?php $i++; ?>

							<?php break; ?>

							<?php case 'gt-type-4': ?>

								<div id="post-<?php echo (int) $id; ?>" class="gt-col" <?php echo ( '' !== $css_animation ) ? Gatsby_Helper::create_data_string_animation( $css_animation, 0, '' ) : '' ?>>

									<article class="gt-entry <?php echo esc_attr($format_class) ?>">

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

											<a class="gt-continue-reading-link" href="<?php echo esc_url($link) ?>"><?php esc_html_e('Read More', 'gatsby') ?></a>

										</div>

										<!-- - - - - - - - - - - - - - End of Entry body - - - - - - - - - - - - - - - - -->

									</article>

								</div>

								<?php $i++; ?>

							<?php break; ?>

						<?php endswitch; ?>

						<?php $delay += 100; $post_loop ++; ?>

					<?php endforeach; ?>

					<?php wp_reset_postdata(); ?>

				<?php if ( !$carousel ): ?></div><?php endif; ?>

				<?php if ( $paginate == 'load-more' ): ?>
					<?php echo $this->load_more_button(); ?>
				<?php elseif ( $paginate == "pagination" && $gatsby_pagination = gatsby_pagination($entries) ) : ?>
					<?php echo $gatsby_pagination; ?>
				<?php endif; ?>

			</div>

		</div>

		<?php return ob_get_clean();
	}

	public function load_more_button() {
		?>
		<div class="aligncenter">
			<a href="javasript:void(0)" class="gt-btn-3 gt-large gt-shadow gt-load-more" <?php echo gatsby_create_data_string($this->atts); ?>><?php esc_html_e('Show Me More', 'gatsby') ?></a>
		</div>
		<?php
	}

	public function prepare_entries($params) {
		$this->loop = array();

		if ( empty($params )) $params = $this->atts;
		if ( empty($this->entries) || empty($this->entries->posts) ) return;

		$style = $params['style'];
		$layout = $params['layout'];
		$columns = $params['columns'];
		$carousel = $params['carousel'];

		foreach ( $this->entries->posts as $key => $entry ) {
			$this->loop[$key]['id'] = $id = $entry->ID;
			$this->loop[$key]['link'] = get_permalink($id);
			$this->loop[$key]['title'] = get_the_title($id);
			$this->loop[$key]['sort_classes'] = $this->get_sort_class($id);
			$this->loop[$key]['post_format'] = $format = get_post_format($id) ? get_post_format($id) : 'standard';

			if ( $carousel ) {
				$format = 'standard';
			}

			$this->loop[$key]['image_size'] = gatsby_blog_alias( $format, '', $style, $layout, $columns );
			$this->loop[$key]['content'] = $entry->post_content;

			switch ( $format ) {
				case 'standard': $format_class = 'gt-image-entry-format'; break;
				case 'gallery':  $format_class = 'gt-slideshow-entry-format'; break;
				case 'video': 	 $format_class = 'gt-video-entry-format'; break;
				case 'link': 	 $format_class = 'gt-link-entry-format'; break;
				case 'audio': 	 $format_class = 'gt-audio-entry-format'; break;
				case 'quote': 	 $format_class = 'gt-quote-entry-format'; break;
				default: 		 $format_class = 'gt-image-entry-format'; break;
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