<?php

// -----------------------  Single Format ------------------------- //

add_filter( 'gatsby-entry-format-single', 'gatsby_single_post_filter', 11, 1 );

// ----------------------- Standard Post Format ------------------------- //

add_filter( 'gatsby-entry-format-standard', 'gatsby_standard_post_filter', 11, 1 );

// ------------------------ Gallery Post Format ------------------------- //

add_filter( 'gatsby-entry-format-gallery', 'gatsby_gallery_post_filter', 11, 1 );

// ------------------------- Video Post Format -------------------------- //

add_filter( 'gatsby-entry-format-video', 'gatsby_video_post_filter', 11, 1 );

// ------------------------- Audio Post Format -------------------------- //

add_filter( 'gatsby-entry-format-audio', 'gatsby_audio_post_filter', 11, 1 );

// ------------------------- Quote Post Format -------------------------- //

add_filter( 'gatsby-entry-format-quote', 'gatsby_quote_post_filter', 11, 1 );

// ------------------------- Link Post Format -------------------------- //

add_filter( 'gatsby-entry-format-link', 'gatsby_link_post_filter', 11, 1 );

//  Single Post Filter									//
// ==================================================== //

if (!function_exists('gatsby_single_post_filter')) {

	function gatsby_single_post_filter ($this_post) {

		$format = $this_post['post_format'];

		switch ( $format ) {

			case 'gallery':

				preg_match("!\[(?:)?gallery.+?\]|\[gallery]!", $this_post['content'], $match_gallery);

				if ( !empty($match_gallery) ) {

					$gallery = $match_gallery[0];

					if ( strpos($gallery, 'vc_') === false ) {

						if ( defined('Gatsby_Content_Type_Version') ) {

							if ( has_shortcode($this_post['content'], 'gallery') ) {
								$gallery = str_replace( "gallery", 'gatsby_post_gallery image_size="'. esc_attr($this_post['image_size']) .'" post_id="'. esc_attr($this_post['id']) .'"', $gallery );
							}

						} else {

							if ( has_shortcode($this_post['content'], 'gallery') ) {
								$gallery = str_replace( "gallery", 'gallery size="post-thumbnail" columns="2" link="none" itemtag="div" icontag="div" captiontag="false" id="'. esc_attr($this_post['id']) .'"', $gallery );
							}

						}

					}

					$this_post['content'] = str_replace($match_gallery[0], $gallery, $this_post['content']);
				}

				break;

			case 'audio':

				preg_match("!\[audio.+?\]\[\/audio\]!", $this_post['content'], $match_audio);
				preg_match("!\[embed.+?\]!", $this_post['content'], $match_embed);

				if ( !empty($match_embed) && strpos($match_embed[0], 'soundcloud.com') !== false ) {
					global $wp_embed;
					$embed = $match_embed[0];
					$embed = str_replace("[embed", '[embed height="120"', $embed);

					$this_post['content'] = str_replace($match_embed[0], do_shortcode($wp_embed->run_shortcode($embed)), $this_post['content']);
				} else if ( !empty($match_audio) ) {
					$this_post['content'] = str_replace($match_audio[0], do_shortcode($match_audio[0]), $this_post['content']);
				}

				break;
			case 'video':

				preg_match("!\[embed.+?\]|\[video.+?\]!", $this_post['content'], $match_video);

				if ( !empty($match_video) ) {
					global $wp_embed;
					$video = $match_video[0];
					$content = "<div class='iframe_wrap'>";
					$content .= do_shortcode($wp_embed->run_shortcode($video));
					$content .= "</div>";
					$this_post['content'] = str_replace($match_video[0], $content, $this_post['content']);
				} else {

					preg_match("!\[(?:)?vc_video.+?\]!", $this_post['content'], $match_video);

					if ( !empty($match_video) ) {
						$video = $match_video[0];
						$this_post['content'] = str_replace($match_video[0], do_shortcode($video), $this_post['content']);
					}

				}

				break;

			case 'quote':

				preg_match('~<blockquote\b[^>]*>(?:[^<]+|(?R)|<(?!/(?:blockquote|p)>))*</blockquote>~', $this_post['content'], $match_quote);

				if ( !empty($match_quote) ) {
					$quote = $match_quote[0];
					$this_post['content'] = str_replace($match_quote[0], '<div class="post-quote">'. do_shortcode($quote) .'</div>', $this_post['content']);
				}

				break;
			case 'link':

				$link 		= "";

				$pattern1 	= '$^\b(https?|ftp|file)://[-A-Z0-9+&@#/%?=~_|!:,.;]*[-A-Z0-9+&@#/%=~_|]$i';
				$pattern2 	= "!^\<a.+?<\/a>!";
				$pattern3 	= "!\<a.+?<\/a>!";

				preg_match($pattern1, $this_post['content'] , $link);

				if ( !empty($link[0]) ) {
					$link = $link[0];
					$this_post['content'] = preg_replace("!".str_replace("?", "\?", $link)."!", "", $this_post['content'], 1);
				} else {

					preg_match($pattern2, $this_post['content'] , $link);

					if ( !empty($link[0]) ) {
						$link = $link[0];
						$this_post['content'] = preg_replace("!".str_replace("?", "\?", $link)."!", "", $this_post['content'], 1);
					} else {

						preg_match($pattern3,  $this_post['content'] , $link);

						if ( !empty($link[0]) ) {
							$link = $link[0];
						}
					}

				}

				if ( $link ) {
					if ( is_array($link) ) $link = $link[0];

					$this_post['content'] = str_replace($link, "<div class='link_container'><span class='si-icon si-icon-link'></span>{$link}</div>", $this_post['content']);
				}

				break;
			default:
				$this_post['content'] = apply_filters('the_content', $this_post['content']);
				break;
		}


		return $this_post;
	}
}

//  Standard Filter										//
// ==================================================== //

if (!function_exists('gatsby_standard_post_filter')) {

	function gatsby_standard_post_filter($this_post) {
		$before = '';
		$this_id = $this_post['id'];
		$image_size = $this_post['image_size'];

		$thumbnail_atts = array(
			'alt'	=> trim(strip_tags(get_the_excerpt($this_id))),
			'title'	=> trim(strip_tags(get_the_title($this_id)))
		);

		if ( is_single() ) {
			$link = Gatsby_Helper::get_post_featured_image($this_id, '');
		} else {
			$link = $this_post['link'];
		}

		$link = esc_url($link);

		if ( has_post_thumbnail($this_id) ) {
			$thumbnail = Gatsby_Helper::get_the_post_thumbnail( $this_id, $image_size, true, '', $thumbnail_atts );
			$before = "<a href='{$link}' title='". sprintf(esc_attr__('%s', 'gatsby'), get_the_title($this_id)) ."' class='gt-thumbnail-attachment'>{$thumbnail}</a>";
		}

		if ( is_string($before) && !empty($before) ) {
			$this_post['before_content'] = $before;
		}

		return $this_post;
	}
}

//  Gallery Post Filter									//
// ==================================================== //

if (!function_exists('gatsby_gallery_post_filter')) {

	function gatsby_gallery_post_filter ($this_post) {
		preg_match("!\[(?:)?gallery.+?\]|\[gallery]!", $this_post['content'], $match_gallery);

		if ( !empty($match_gallery) ) {
			$gallery = $match_gallery[0];

			if ( strpos($gallery, 'vc_') === false ) {

				if ( defined('Gatsby_Content_Type_Version') ) {

					if ( has_shortcode($this_post['content'], 'gallery') ) {
						$gallery = str_replace( "gallery", 'gatsby_post_gallery image_size="'. esc_attr($this_post['image_size']) .'" post_id="'. esc_attr($this_post['id']) .'"', $gallery );
					}

				} else {

					if ( has_shortcode($this_post['content'], 'gallery') ) {
						$gallery = str_replace( "gallery", 'gallery size="post-thumbnail" columns="2" link="none" itemtag="div" icontag="div" captiontag="false" id="'. esc_attr($this_post['id']) .'"', $gallery );
					}

				}

			}

            $this_post['before_content'] = do_shortcode($gallery);
			$this_post['content'] = str_replace( $match_gallery[0], '', $this_post['content'] );
			$this_post['content'] = apply_filters( 'the_content', $this_post['content'] );
		}
		return $this_post;
	}
}

//  Audio Post Filter									//
// ==================================================== //

if (!function_exists('gatsby_audio_post_filter')) {

	function gatsby_audio_post_filter($this_post) {
		$this_post['content'] = preg_replace( '|^\s*(http?://[^\s"]+)\s*$|im', "[audio src='$1']", strip_tags($this_post['content']) );

		$before = $bg_img = '';
		preg_match("!\[audio.+?\]\[\/audio\]!", $this_post['content'], $match_audio);
		preg_match("!\[embed.+?\]!", $this_post['content'], $match_embed);

		if ( !empty($match_embed) && strpos($match_embed[0], 'soundcloud.com') !== false ) {
			global $wp_embed;
			$alias = $this_post['image_size'];
			$embed = $match_embed[0];
			$embed = str_replace('[embed]', '[embed width="'. $alias[0] .'" height="120"]', $embed);

			if ( has_post_thumbnail( $this_post['id'] ) ) {
				$bg_img = 'style="background-image: url(' . Gatsby_Helper::get_post_featured_image( $this_post['id'], $this_post['image_size'], true ) . ')"';
			}

			$before .= '<div class="gt-audio-poster" ' . $bg_img . '></div>';
			$before .= $wp_embed->run_shortcode($embed);

			if ( is_string( $before ) ) {
				$this_post['before_content'] = $before;
			}

			$this_post['content'] = str_replace($match_embed[0], "", $this_post['content']);
			return $this_post;
		} else if ( !empty($match_audio) ) {

			$patterns = array();
			$patterns[0] = '/\[audio/';
			$patterns[1] = '/audio\]/';

			$audio = preg_replace( $patterns, array( '[gatsby_audio', 'gatsby_audio]' ), $match_audio[0] );

			if ( !empty($audio) ) {

				if ( has_post_thumbnail( $this_post['id'] ) ) {
					$bg_img = 'style="background-image: url(' . Gatsby_Helper::get_post_featured_image( $this_post['id'], $this_post['image_size'], true ) . ')"';
				}

				$before .= '<div class="gt-audio-poster" ' . $bg_img . '></div>';
				$before .= do_shortcode($audio);

				if ( is_string( $before ) ) {
					$this_post['before_content'] = $before;
				}

			}
			$this_post['content'] = str_replace($match_audio[0], "", $this_post['content']);

		}
		$this_post['content'] = apply_filters('the_content', $this_post['content']);
		return $this_post;
	}
}

//  Video Post Filter									//
// ==================================================== //

if (!function_exists('gatsby_video_post_filter')) {

	function gatsby_video_post_filter($this_post) {
		$this_post['content'] = preg_replace( '|^\s*(https?://[^\s"]+)\s*$|im', "[embed]$1[/embed]", strip_tags($this_post['content']));
		preg_match("!\[embed.+?\]|\[video.+?\]!", $this_post['content'], $match_video);

		if ( !empty($match_video) ) {
			global $wp_embed;

			$video = $match_video[0];

			$this_post['before_content'] = "<div class='gt-responsive-iframe'>";
				$this_post['before_content'] .= do_shortcode($wp_embed->run_shortcode($video));
			$this_post['before_content'] .= "</div>";
			$this_post['content'] = str_replace($match_video[0], "", $this_post['content']);
			$this_post['content'] = apply_filters('the_content', $this_post['content']);
		} else {

			preg_match("!\[(?:)?vc_video.+?\]!", $this_post['content'], $match_video);

			if (!empty($match_video)) {
				$video = $match_video[0];
				$this_post['before_content'] = do_shortcode($video);
				$this_post['content'] = str_replace($match_video[0], "", $this_post['content']);
				$this_post['content'] = apply_filters('the_content', $this_post['content']);
			}

		}
		return $this_post;
	}
}

//  Quote Post Filter									//
// ==================================================== //

if (!function_exists('gatsby_quote_post_filter')) {

	function gatsby_quote_post_filter($this_post) {

		preg_match('~<blockquote\b[^>]*>(?:[^<]+|(?R)|<(?!/(?:blockquote|p)>))*</blockquote>~', $this_post['content'], $match_quote);

		$before = $bg_img = '';

		if ( !empty($match_quote) ) {
			$quote = $match_quote[0];

			if ( has_post_thumbnail( $this_post['id'] ) ) {
				$bg_img = 'style="background-image: url(' . Gatsby_Helper::get_post_featured_image( $this_post['id'], $this_post['image_size'], true ) . ')"';
			}

			$before .= '<a href="'. esc_url($this_post['link']) .'" class="gt-entry-link"></a>';
			$before .= "<div class='gt-blockquote-attachment' {$bg_img}>";
				$before .= '<div class="gt-blockquote-attachment-inner">';
					$before .= do_shortcode($quote);
				$before .= '</div>';
			$before .= '</div>';

			if ( is_string($before) && !empty($before) ) {
				$this_post['before_content'] = $before;
			}

			$this_post['content'] = str_replace( $match_quote[0], "", $this_post['content'] );
		}

		$this_post['content'] = apply_filters('the_content', $this_post['content']);
		return $this_post;
	}
}

//  Link Post Filter									//
// ==================================================== //

if(!function_exists('gatsby_link_post_filter')) {
	function gatsby_link_post_filter($this_post) {
		$link = $before = $bg_img = "";

		$pattern1 	= '$^\b(https?|ftp|file)://[-A-Z0-9+&@#/%?=~_|!:,.;]*[-A-Z0-9+&@#/%=~_|]$i';
		$pattern2 	= "!^\<a.+?<\/a>!";
		$pattern3 	= "!\<a.+?<\/a>!";

		preg_match( $pattern1, $this_post['content'] , $link );

		if ( !empty($link[0]) ) {
			$link = $link[0];
			$this_post['content'] = preg_replace("!".str_replace("?", "\?", $link)."!", "", $this_post['content'], 1);
		} else {

			preg_match( $pattern2, $this_post['content'] , $link );

			if ( !empty($link[0]) ) {
				$link = $link[0];
				$this_post['content'] = preg_replace("!".str_replace("?", "\?", $link)."!", "", $this_post['content'], 1);
			} else {

				preg_match( $pattern3,  $this_post['content'] , $link );

				if ( !empty($link[0]) ) {
					$link = $link[0];
				}
			}

		}

		if ( $link ) {

			if ( is_array($link) ) $link = $link[0];

			$permalink = $link_text = '';
			$regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>(.*)<\/a>";
			if ( preg_match_all("/$regexp/siU", $link, $matches) ) {
				if ( isset($matches[2][0]) && !empty($matches[2][0]) ) {
					$permalink = $matches[2][0];
				}
				if ( isset($matches[3][0]) && !empty($matches[3][0]) ) {
					$link_text = $matches[3][0];
				}

				if ( has_post_thumbnail( $this_post['id'] ) ) {
					$bg_img = 'style="background-image: url(' . Gatsby_Helper::get_post_featured_image( $this_post['id'], $this_post['image_size'], true ) . ')"';
				}

				$before .= "<a href='{$permalink}' class='gt-link-attachment' {$bg_img}>";
				$before .= "<span class='gt-link-attachment-inner'>";
				$before .= "<span class='lnr lnr-link'></span><span class='gt-link-inner'>{$link_text}</span>";
				$before .= "</span>";
				$before .= "</a>";
			}

			if ( is_string($before) && !empty($before) ) {
				$this_post['before_content'] = $before;
			}

		}

		return $this_post;
	}
}