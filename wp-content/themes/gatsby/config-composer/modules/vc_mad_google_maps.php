<?php
if (!class_exists("gatsby_google_maps")) {

	class gatsby_google_maps {

		function __construct() {
			add_action( 'wp_enqueue_scripts', array($this, 'google_map_script'), 1 );
			add_action( 'vc_before_init', array($this, 'add_map_google_maps') );
		}

		function google_map_script() {
			wp_register_script( "googleapis", "https://maps.googleapis.com/maps/api/js?v=3.23", null, null, false );
		}

		function add_map_google_maps(){

			if ( function_exists('vc_map')) {

				vc_map( array(
					"name" => esc_html__("Google Map", "gatsby"),
					"base" => "vc_mad_google_map",
					"class" => "vc_google_map",
					"controls" => "full",
					"show_settings_on_create" => true,
					"icon" => "icon-wpb-mad-google-map",
					"description" => esc_html__("Display Google Maps to indicate your location.", "gatsby"),
					"category"  => esc_html__('Gatsby', 'gatsby'),
					"params" => array(
						array(
							"type" => "textfield",
							"class" => "",
							"heading" => esc_html__("Width (in %)", "gatsby"),
							"param_name" => "width",
							"admin_label" => true,
							"value" => "100%",
							"group"  => esc_html__('General Settings', 'gatsby')
						),
						array(
							"type" => "textfield",
							"class" => "",
							"heading" => esc_html__("Height (in px)", "gatsby"),
							"param_name" => "height",
							"admin_label" => true,
							"value" => "500px",
							"group"  => esc_html__('General Settings', 'gatsby')
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => esc_html__("Map type", "gatsby"),
							"param_name" => "map_type",
							"admin_label" => true,
							"value" => array(
								esc_html__("Roadmap", "gatsby") => "ROADMAP",
								esc_html__("Satellite", "gatsby") => "SATELLITE",
								esc_html__("Hybrid", "gatsby") => "HYBRID",
								esc_html__("Terrain", "gatsby") => "TERRAIN"),
							"group"  => esc_html__('General Settings', 'gatsby')
						),
						array(
							"type" => "textfield",
							"class" => "",
							"heading" => esc_html__("Latitude", "gatsby"),
							"param_name" => "lat",
							"admin_label" => true,
							"value" => "40.7707307",
							"description" => '<a href="http://universimmedia.pagesperso-orange.fr/geo/loc.htm" target="_blank">'.__('Here is a tool','gatsby').'</a> '. esc_html__('where you can find Latitude & Longitude of your location', 'gatsby'),
							"group"  => esc_html__('General Settings', 'gatsby')
						),
						array(
							"type" => "textfield",
							"class" => "",
							"heading" => esc_html__("Longitude", "gatsby"),
							"param_name" => "lng",
							"admin_label" => true,
							"value" => "-74.0210859",
							"description" => '<a href="http://universimmedia.pagesperso-orange.fr/geo/loc.htm" target="_blank">'.__('Here is a tool','gatsby').'</a> '. esc_html__('where you can find Latitude & Longitude of your location', "gatsby"),
							"group"  => esc_html__('General Settings', 'gatsby')
						),
						array(
							"type" => "dropdown",
							"heading" => esc_html__("Map Zoom", "gatsby"),
							"param_name" => "zoom",
							"value" => array(
								esc_html__("18 - Default", "gatsby") => 18, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 13, 14, 15, 16, 17, 18, 19, 20
							),
							"group" => esc_html__('General Settings', 'gatsby')
						),
						array(
							"type" => "checkbox",
							"heading" => "",
							"param_name" => "scrollwheel",
							"value" => array(
								esc_html__("Disable map zoom on mouse wheel scroll", "gatsby") => "disable",
							),
							"group" => esc_html__('General Settings', 'gatsby')
						),
						array(
							"type" => "textarea_html",
							"class" => "",
							"heading" => esc_html__("Info Window Text", "gatsby"),
							"param_name" => "content",
							"value" => "",
							"group"  => esc_html__('Info Window', 'gatsby')
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => esc_html__("Marker/Point icon", "gatsby"),
							"param_name" => "marker_icon",
							"value" => array(
								esc_html__("Use Google Default", "gatsby") => "default",
								esc_html__('Use Theme Default', "gatsby") => "default_self",
								esc_html__("Upload Custom", "gatsby") => "custom"
							),
							"group"  => esc_html__('Marker', 'gatsby')
						),
						array(
							"type" => "attach_image",
							"class" => "",
							"heading" => esc_html__("Upload Image Icon:", "gatsby"),
							"param_name" => "icon_img",
							"admin_label" => true,
							"value" => "",
							"description" => esc_html__("Upload the custom image icon.", "gatsby"),
							"dependency" => array(
								"element" => "marker_icon",
								"value" => array("custom")
							),
							"group"  => esc_html__('Marker', 'gatsby')
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => esc_html__("Street view control", "gatsby"),
							"param_name" => "streetviewcontrol",
							"value" => array(
								esc_html__("Disable", "gatsby") => "false",
								esc_html__("Enable", "gatsby") => "true"
							),
							"group"  => esc_html__('Advanced', 'gatsby')
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => esc_html__("Map type control", "gatsby"),
							"param_name" => "maptypecontrol",
							"value" => array(
								esc_html__("Disable", "gatsby") => "false",
								esc_html__("Enable", "gatsby") => "true"
							),
							"group"  => esc_html__('Advanced', 'gatsby')
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => esc_html__("Map pan control", "gatsby"),
							"param_name" => "pancontrol",
							"value" => array(
								esc_html__("Disable", "gatsby") => "false",
								esc_html__("Enable", "gatsby") => "true"
							),
							"group" => "Advanced"
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => esc_html__("Zoom control", "gatsby"),
							"param_name" => "zoomcontrol",
							"value" => array(esc_html__("Disable", "gatsby") => "false", esc_html__("Enable", "gatsby") => "true"),
							"group"  => esc_html__('Advanced', 'gatsby')
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => esc_html__("Zoom control size", "gatsby"),
							"param_name" => "zoomcontrolsize",
							"value" => array(esc_html__("Small", "gatsby") => "SMALL", esc_html__("Large", "gatsby") => "LARGE"),
							"dependency" => Array("element" => "zoomControl","value" => array("true")),
							"group"  => esc_html__('Advanced', 'gatsby')
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => esc_html__("Disable dragging on Mobile", "gatsby"),
							"param_name" => "dragging",
							"value" => array( esc_html__("Enable", "gatsby") => "true", esc_html__("Disable", "gatsby") => "false"),
							"group"  => esc_html__('Advanced', 'gatsby')
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => esc_html__("Top margin", "gatsby"),
							"param_name" => "top_margin",
							"value" => array(
								esc_html__("Page (small)", "gatsby") => "page_margin_top",
								esc_html__("Section (large)", "gatsby") => "page_margin_top_section",
								esc_html__("None", "gatsby") => "none"
							),
							"group"  => esc_html__('General Settings', 'gatsby')
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => esc_html__("Map Width Override", "gatsby"),
							"param_name" => "map_override",
							"value" =>array(
								esc_html__("Default Width", 'gatsby')=>"0",
								esc_html__("Apply 1st parent element's width", 'gatsby')=>"1",
								esc_html__("Apply 2nd parent element's width", 'gatsby')=>"2",
								esc_html__("Apply 3rd parent element's width", 'gatsby')=>"3",
								esc_html__("Apply 4th parent element's width", 'gatsby')=>"4",
								esc_html__("Apply 5th parent element's width", 'gatsby')=>"5",
								esc_html__("Apply 6th parent element's width", 'gatsby')=>"6",
								esc_html__("Apply 7th parent element's width", 'gatsby')=>"7",
								esc_html__("Apply 8th parent element's width", 'gatsby')=>"8",
								esc_html__("Apply 9th parent element's width", 'gatsby')=>"9",
								esc_html__('Full Width', 'gatsby')=>"full",
								esc_html__('Maximum Full Width', 'gatsby')=>"ex-full",
							),
							"description" => esc_html__("By default, the map will be given to the Visual Composer row. However, in some cases depending on your theme's CSS - it may not fit well to the container you are wishing it would. In that case you will have to select the appropriate value here that gets you desired output..", "gatsby"),
							"group"  => esc_html__('General Settings', 'gatsby')
						),
						array(
							"type" => "textarea",
							"class" => "",
							"heading" => esc_html__("Google Styled Map JSON", "gatsby"),
							"param_name" => "map_style",
							"value" => "",
							"description" => "<a target='_blank' href='http://googlemaps.github.io/js-samples/styledmaps/wizard/index.html'>".esc_html__("Click here","gatsby")."</a> ".__("to get the style JSON code for styling your map.","gatsby"),
							"group"  => esc_html__('Styling', 'gatsby')
						),
						array(
							"type" => "textfield",
							"heading" => esc_html__("Extra class name", "gatsby"),
							"param_name" => "el_class",
							"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "gatsby"),
							"group"  => esc_html__('General Settings', 'gatsby')
						),
						array(
							"type" => "dropdown",
							"class" => "",
							"heading" => esc_html__("MapBorder Style", "gatsby"),
							"param_name" => "map_border_style",
							"value" => array(
								esc_html__('None', 'gatsby')=> "",
								esc_html__('Solid', 'gatsby')=> "solid",
								esc_html__('Dashed', 'gatsby') => "dashed",
								esc_html__('Dotted', 'gatsby') => "dotted",
								esc_html__('Double', 'gatsby') => "double",
								esc_html__('Inset', 'gatsby') => "inset",
								esc_html__('Outset', 'gatsby') => "outset",
							),
							"description" => "",
							"group"  => esc_html__('Border', 'gatsby')
						),
						array(
							"type" => "colorpicker",
							"class" => "",
							"heading" => esc_html__("Border Color", "gatsby"),
							"param_name" => "map_color_border",
							"value" => "",
							"description" => "",
							"dependency" => array(
								"element" => "map_border_style",
								"not_empty" => true
							),
							"group"  => esc_html__('Border', 'gatsby')
						),
						array(
							"type" => "number",
							"class" => "",
							"heading" => esc_html__("Border Width", "gatsby"),
							"param_name" => "map_border_size",
							"value" => 1,
							"min" => 1,
							"max" => 10,
							"suffix" => "px",
							"description" => "",
							"dependency" => array(
								"element" => "map_border_style",
								"not_empty" => true
							),
							"group"  => esc_html__('Border', 'gatsby')
						),
						array(
							"type" => "number",
							"class" => "",
							"heading" => esc_html__("Border Radius","gatsby"),
							"param_name" => "map_radius",
							"value" => 3,
							"min" => 0,
							"max" => 500,
							"suffix" => "px",
							"description" => "",
							"dependency" => array(
								"element" => "map_border_style",
								"not_empty" => true
							),
							"group"  => esc_html__('Border', 'gatsby')
						)
					)
				));
			}
		}

	}

	if (class_exists('WPBakeryShortCode')) {

		class WPBakeryShortCode_vc_mad_google_map extends WPBakeryShortCode {

			protected function content($atts, $content = null) {

				$width = $height = $map_type = $lat = $lng = $zoom = $streetviewcontrol = $maptypecontrol = $map_style = $top_margin = $pancontrol = $zoomcontrol = $zoomcontrolsize = $dragging = $marker_icon = $icon_img = $map_override = $output = $scrollwheel = $el_class = $map_border_style = $map_color_border = $map_border_size = $map_radius ='';

				extract(shortcode_atts(array(
					"width" => "100%",
					"height" => "300px",
					"map_type" => "ROADMAP",
					"lat" => "40.7707307",
					"lng" => "-74.0210859",
					"zoom" => "16",
					"scrollwheel" => "disable",
					"streetviewcontrol" => "false",
					"maptypecontrol" => "false",
					"pancontrol" => "false",
					"zoomcontrol" => "false",
					"zoomcontrolsize" => "SMALL",
					"dragging" => "true",
					"marker_icon" => "default",
					"icon_img" => "",
					"top_margin" => "page_margin_top",
					"map_override" => "0",
					"map_style" => "",
					"el_class" => "",
					"map_border_style" => "",
					"map_color_border" => "",
					"map_border_size" => "",
					"map_radius" => ""
				), $atts));

				$border_css = $gmap_design_css ='';
				$marker_lat = $lat;
				$marker_lng = $lng;

				if ( $marker_icon == "default_self" ) {
					$icon_url = get_template_directory_uri() . '/config-composer/assets/images/marker.png';
				} elseif ( $marker_icon == "default" ) {
					$icon_url = "";
				} else {
					$icon_url = Gatsby_Helper::get_post_attachment_image($icon_img, '');
				}

				$id = "map_" . uniqid();
				$wrap_id = "wrap_" . $id;
				$map_type = strtoupper($map_type);
				$width = (substr($width, -1)!="%" && substr($width, -2) != "px" ? $width . "px" : $width);
				$map_height = (substr($height, -1)!="%" && substr($height, -2) != "px" ? $height . "px" : $height);

				$margin_css = '';

				if ( $top_margin != 'none' ) {
					$margin_css = $top_margin;
				}

				if ( $map_border_style !='' ) {
					$border_css .= 'border-style:'.$map_border_style.';';
				}

				if ( $map_color_border != '' ) {
					$border_css .= 'border-color:'. $map_color_border .';';
				}

				if ( $map_border_size != '' ) {
					$border_css .= 'border-width:'. $map_border_size .'px;';
				}

				if ( $map_radius !='' ) {
					$border_css .= 'border-radius:'. $map_radius .'px;';
				}

				$output .= "<div class='wpb_content_element'>";

				$output .= "<div id='". $wrap_id ."' class='gatsby-map-wrapper ". $el_class ."' style='".( $map_height != "" ? "height:" . $map_height . ";" : "")."'><div id='" . $id . "' data-map_override='". $map_override ."' class='gt-gmap ". $margin_css. "'" . ($width!="" || $map_height!="" ? " style='".$border_css . ($width!="" ? "width:" . $width . ";" : "") . ($map_height!="" ? "height:" . $map_height . ";" : "") . "'" : "") . "></div></div>";

				if ( $scrollwheel == "disable" ) {
					$scrollwheel = 'false';
				} else {
					$scrollwheel = 'true';
				}

					$output .= "<script type='text/javascript'>

						(function($) {

							'use strict';

							var map_$id = null;
							var coordinate_$id;
							var isDraggable = $(document).width() > 641 ? true : $dragging;
							try {
								var map_$id = null;
								var coordinate_$id;
								coordinate_$id=new google.maps.LatLng($lat, $lng);
								var mapOptions = {
									zoom: $zoom,
									center: coordinate_$id,
									scaleControl: true,
									streetViewControl: $streetviewcontrol,
									mapTypeControl: $maptypecontrol,
									panControl: $pancontrol,
									zoomControl: $zoomcontrol,
									scrollwheel: $scrollwheel,
									draggable: isDraggable,
									zoomControlOptions: {
									  style: google.maps.ZoomControlStyle.$zoomcontrolsize
									},";

								if ( $map_style == "" ) {
									$output .= "mapTypeId: google.maps.MapTypeId.$map_type,";
								} else {
									$output .= " mapTypeControlOptions: {
											mapTypeIds: [google.maps.MapTypeId.$map_type, 'map_style']
										}";
								}

								$output .= "};";

								if ( $map_style !== "" ) {
									$output .= 'var styles = '. rawurldecode(strip_tags($map_style)) .';
										var styledMap = new google.maps.StyledMapType(styles, { name: "'. esc_html__('Styled Map', 'gatsby') .'" });';
								}

								$output .= "var map_$id = new google.maps.Map(document.getElementById('$id'), mapOptions);";

								if ( $map_style !== "" ) {
									$output .= "map_$id.mapTypes.set('map_style', styledMap);
											 map_$id.setMapTypeId('map_style');";
								}

								if ( $marker_lat != "" && $marker_lng != "" ) {

									$output .= "
										var marker_$id = new google.maps.Marker({
										position: new google.maps.LatLng($marker_lat, $marker_lng),
										animation:  google.maps.Animation.DROP,
										map: map_$id,
										icon: '". $icon_url ."'
									});

									google.maps.event.addListener(marker_$id, 'click', Gatsby_VC_ToggleBounce);";

									if ( trim($content) !== "" ) {
										$output .= "var infowindow = new google.maps.InfoWindow();
											infowindow.setContent('<div class=\"map_info_text\" style=\'color:#000;\'>".trim(preg_replace('/\s+/', ' ', do_shortcode($content)))."</div>');";

										$output .= "google.maps.event.addListener(marker_$id, 'click', function() {
												infowindow.open(map_$id,marker_$id);
											});";

									}

								}

								$output .= "}
							catch(e){};

								jQuery(document).ready(function($){
									google.maps.event.trigger(map_$id, 'resize');
									$(window).resize(function(){
										google.maps.event.trigger(map_$id, 'resize');
										if(map_$id!=null)
											map_$id.setCenter(coordinate_$id);
									});
								});

								$(window).load(function(){
									setTimeout(function(){
										$(window).trigger('resize');
									},200);
								});

								function Gatsby_VC_ToggleBounce() {
								  if (marker_$id.getAnimation() != null) {
									marker_$id.setAnimation(null);
								  } else {
									marker_$id.setAnimation(google.maps.Animation.BOUNCE);
								  }
								}

						})(jQuery);
				</script>";

				$output .= '</div>';

				return $output;

			}

		}

	}

	new gatsby_google_maps();

}