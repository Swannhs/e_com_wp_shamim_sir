<?php

class WPBakeryShortCode_VC_mad_cta extends WPBakeryShortCode {

	protected $template_vars = array();

	public function buildTemplate( $atts, $content ) {
		$output = array();

		$container_classes = $column_left_clases = $columns_right_classes = array();

		if ( ! empty( $atts['add'] ) ) {

			switch( $atts['add'] ) {
				case 'button_bottom':

					$output[ 'gt-actions-button' ] = $this->getOneButton( $atts );
					$column_left_clases[] = '';
					$columns_right_classes[] = '';

					break;
				case 'button':
					$output[ 'gt-actions-button' ] = $this->getOneButton( $atts );
					$column_left_clases[] = 'col-md-8 col-sm-7';
					$columns_right_classes[] = 'col-md-4 col-sm-5';

					if ( $atts['add_second_button'] ) {
						$column_left_clases = $columns_right_classes = '';
						$output[ 'gt-actions-button' ] = $this->getButtons( $atts );
						$column_left_clases[] = 'col-lg-5 col-md-7';
						$columns_right_classes[] = 'col-lg-7 col-md-5';
					}

					break;
				case 'form':
					$output[ 'gt-actions-form' ] = $this->getForm( $atts );

					if ( $atts['position_form'] == 'bottom' ) {
						$column_left_clases[] = '';
						$columns_right_classes[] = '';
					} else {
						$column_left_clases[] = 'col-lg-6 col-sm-5';
						$columns_right_classes[] = 'col-lg-6 col-sm-7';
					}

					break;
			}

		}

		$container_classes[] = $atts['type'];

		if ( $atts['position_form'] == 'bottom' ) {
			$container_classes[] = 'align-center';
		}

		if ( $atts['add'] == 'button_bottom' ) {
			$container_classes[] = 'align-center gt-has-button-bottom';
		}

		$output['heading'] = $this->getHeading( 'h3', $atts );
		$output['subheading'] = $this->getHeading( 'p', $atts );

		$output['container-class'] = $container_classes;
		$output['column-left-class'] = $column_left_clases;
		$output['column-right-class'] = $columns_right_classes;
		$this->template_vars = $output;
	}

	public function getHeading( $tag, $atts ) {
		$inline_css = $css_animation  = '';
		if ( isset( $atts[ $tag ] ) && '' !== trim( $atts[ $tag ] ) ) {

			if ( ! empty( $atts['custom_text'] ) && $tag == 'h3' ) {
				$inline_css[] = vc_get_css_color( 'color', $atts['custom_text'] );
			}

			if ( ! empty( $atts['custom_text'] ) && $tag == 'p' ) {
				$inline_css[] = vc_get_css_color( 'color', $atts['subheading_text'] );
			}

			if ( ! empty( $inline_css ) ) {
				$inline_css = ' style="' . implode( '', $inline_css ) . '"';
			}

			if ( ! empty( $atts['css_animation'] ) ) {
				$css_animation = Gatsby_Helper::create_data_string_animation( $atts['css_animation'], 0, '' );
			}

			if ( $tag == 'p' ) {
				return '<div' . $inline_css . ' ' . $css_animation . '>' . wpb_js_remove_wpautop($atts[$tag], true) . '</div>';
			} else {
				return '<' . $tag . $inline_css . ' ' . $css_animation . '>' . $atts[$tag] . '</' . $tag . '>';
			}
		}

		return '';
	}

	public function getForm( $atts ) {

		$form = $data = $css_animation = '';

		if ( defined('WYSIJA') ) {

			if ( absint($atts['select_form']) ) {

				$form_id_real = 'form-' . absint($atts['select_form']);
				$model_forms = WYSIJA::get('forms', 'model');
				$form = $model_forms->getOne(array('form_id' => (int)$atts['select_form']));

				if ( !empty($form) ) {
					$helper_form_engine = WYSIJA::get('form_engine', 'helper');
					$helper_form_engine->set_data( $form['data'], true );

					// get html rendering of form
					$form_html = $helper_form_engine->render_web();
					remove_shortcode('user'); remove_shortcode('user_list'); remove_shortcode('list_ids'); remove_shortcode('list_id'); remove_shortcode('firstname');
					remove_shortcode('lastname'); remove_shortcode('email'); remove_shortcode('custom'); remove_shortcode('required'); remove_shortcode('field');

					// interpret shortcodes
					$form_html = do_shortcode($form_html);

					if ( '' !== $atts['css_form_animation'] ) {
						$css_animation = Gatsby_Helper::create_data_string_animation( $atts['css_form_animation'], 0, 0 );
					}

					$data .= '<form '. $css_animation .' id="'. $form_id_real .'" method="post" action="#wysija" class="widget_wysija">';
					$data .= $form_html;
					$data .= '</form>';

					$form = $data;
				}

			}

		} else {
			$form = '<h6>'. esc_html__('Please install required plugin - MailPoet Newsletters', 'gatsby') .'</h6>';
		}

		return $form;
	}

	public function getOneButton( $atts ) {
		$output = '';

		if ( $atts['add'] == 'button_bottom' ) {
			$output .= '<div class="align-center">';
			$output .= $this->getButton($atts);
			$output .= '</div>';
		} else {
			$output .= '<div class="align-right">';
			$output .= $this->getButton($atts);
			$output .= '</div>';
		}

		return $output;
	}

	public function getButtons( $atts ) {
		$output = '';

		$output .= '<div class="align-right">';
			$output .= '<div class="gt-hr-btns-set">';
				$output .= $this->getButton($atts);
				$output .= $this->getSecondButton($atts);
			$output .= '</div>';
		$output .= '</div>';

		return $output;
	}

	public function getButton( $atts ) {
		$link = $atts['link'];

		if ( empty($link) ) return '';

		$css_animation = '';
		$inline_css = '';

		$url = vc_build_link( $link );
		$buttonClasses = 'gt-cta-button';

		if ( '' !== $atts['css_button_animation'] ) {
			$css_animation = Gatsby_Helper::create_data_string_animation( $atts['css_button_animation'], '130', 0);
		}

		if ( '' !== $atts['custom_button_color'] ) {
			$inline_css[] = vc_get_css_color( 'color', $atts['custom_button_color'] );
		}

		if ( ! empty( $inline_css ) ) {
			$inline_css = ' style="' . implode( '', $inline_css ) . '"';
		}

		if ( strlen( $link ) > 0 && strlen( $url['url'] ) > 0 ) {
			return '<a '. $inline_css . ' class="' . esc_attr($buttonClasses) .'"
			' . $css_animation . '
			href="' . esc_attr( $url['url'] ) . '"
			target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_html( $url['title'] ) . '</a>';
		}

		return '';
	}

	public function getSecondButton ( $atts ) {

		$link = $atts['second_link'];

		if ( empty($link) ) return '';

		$css_animation = '';
		$url = vc_build_link( $link );

		if ( '' !== $atts['css_button_animation'] ) {
			$css_animation = Gatsby_Helper::create_data_string_animation( $atts['css_button_animation'], '130', 0);
		}

		if ( strlen( $link ) > 0 && strlen( $url['url'] ) > 0 ) {
			return '<a class="gt-btn-3 gt-white gt-reverse gt-large gt-shadow"
			' . $css_animation . '
			href="' . esc_attr( $url['url'] ) . '"
			target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_html( $url['title'] ) . '</a>';
		}

		return '';
	}

	public function getTemplateVariable( $string ) {
		if ( is_array( $this->template_vars ) && isset( $this->template_vars[ $string ] ) ) {
			return $this->template_vars[ $string ];
		}
		return '';
	}

}