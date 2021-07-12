!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):a("object"==typeof exports?require("jquery"):jQuery)}(function(a){function b(a){return h.raw?a:encodeURIComponent(a)}function c(a){return h.raw?a:decodeURIComponent(a)}function d(a){return b(h.json?JSON.stringify(a):String(a))}function e(a){0===a.indexOf('"')&&(a=a.slice(1,-1).replace(/\\"/g,'"').replace(/\\\\/g,"\\"));try{return a=decodeURIComponent(a.replace(g," ")),h.json?JSON.parse(a):a}catch(a){}}function f(b,c){var d=h.raw?b:e(b);return a.isFunction(c)?c(d):d}var g=/\+/g,h=a.cookie=function(e,g,i){if(void 0!==g&&!a.isFunction(g)){if(i=a.extend({},h.defaults,i),"number"==typeof i.expires){var j=i.expires,k=i.expires=new Date;k.setTime(+k+864e5*j)}return document.cookie=[b(e),"=",d(g),i.expires?"; expires="+i.expires.toUTCString():"",i.path?"; path="+i.path:"",i.domain?"; domain="+i.domain:"",i.secure?"; secure":""].join("")}for(var l=e?void 0:{},m=document.cookie?document.cookie.split("; "):[],n=0,o=m.length;n<o;n++){var p=m[n].split("="),q=c(p.shift()),r=p.join("=");if(e&&e===q){l=f(r,g);break}e||void 0===(r=f(r))||(l[q]=r)}return l};h.defaults={},a.removeCookie=function(b,c){return void 0!==a.cookie(b)&&(a.cookie(b,"",a.extend({},c,{expires:-1})),!a.cookie(b))}});


!function(l,e){"function"==typeof define&&define.amd?define(["jquery"],e):e(l.jQuery)}(this,function(l){"use strict";function e(e){if(t.webkit&&!e)return{height:0,width:0};if(!t.data.outer){var o={border:"none","box-sizing":"content-box",height:"200px",margin:"0",padding:"0",width:"200px"};t.data.inner=l("<div>").css(l.extend({},o)),t.data.outer=l("<div>").css(l.extend({left:"-1000px",overflow:"scroll",position:"absolute",top:"-1000px"},o)).append(t.data.inner).appendTo("body")}return t.data.outer.scrollLeft(1e3).scrollTop(1e3),{height:Math.ceil(t.data.outer.offset().top-t.data.inner.offset().top||0),width:Math.ceil(t.data.outer.offset().left-t.data.inner.offset().left||0)}}function o(){var l=e(!0);return!(l.height||l.width)}function s(l){var e=l.originalEvent;return e.axis&&e.axis===e.HORIZONTAL_AXIS?!1:e.wheelDeltaX?!1:!0}var r=!1,t={data:{index:0,name:"scrollbar"},macosx:/mac/i.test(navigator.platform),mobile:/android|webos|iphone|ipad|ipod|blackberry/i.test(navigator.userAgent),overlay:null,scroll:null,scrolls:[],webkit:/webkit/i.test(navigator.userAgent)&&!/edge\/\d+/i.test(navigator.userAgent)};t.scrolls.add=function(l){this.remove(l).push(l)},t.scrolls.remove=function(e){for(;l.inArray(e,this)>=0;)this.splice(l.inArray(e,this),1);return this};var i={autoScrollSize:!0,autoUpdate:!0,debug:!1,disableBodyScroll:!1,duration:200,ignoreMobile:!1,ignoreOverlay:!1,scrollStep:30,showArrows:!1,stepScrolling:!0,scrollx:null,scrolly:null,onDestroy:null,onInit:null,onScroll:null,onUpdate:null},n=function(s){t.scroll||(t.overlay=o(),t.scroll=e(),a(),l(window).resize(function(){var l=!1;if(t.scroll&&(t.scroll.height||t.scroll.width)){var o=e();(o.height!==t.scroll.height||o.width!==t.scroll.width)&&(t.scroll=o,l=!0)}a(l)})),this.container=s,this.namespace=".scrollbar_"+t.data.index++,this.options=l.extend({},i,window.jQueryScrollbarOptions||{}),this.scrollTo=null,this.scrollx={},this.scrolly={},s.data(t.data.name,this),t.scrolls.add(this)};n.prototype={destroy:function(){if(this.wrapper){this.container.removeData(t.data.name),t.scrolls.remove(this);var e=this.container.scrollLeft(),o=this.container.scrollTop();this.container.insertBefore(this.wrapper).css({height:"",margin:"","max-height":""}).removeClass("scroll-content scroll-scrollx_visible scroll-scrolly_visible").off(this.namespace).scrollLeft(e).scrollTop(o),this.scrollx.scroll.removeClass("scroll-scrollx_visible").find("div").andSelf().off(this.namespace),this.scrolly.scroll.removeClass("scroll-scrolly_visible").find("div").andSelf().off(this.namespace),this.wrapper.remove(),l(document).add("body").off(this.namespace),l.isFunction(this.options.onDestroy)&&this.options.onDestroy.apply(this,[this.container])}},init:function(e){var o=this,r=this.container,i=this.containerWrapper||r,n=this.namespace,c=l.extend(this.options,e||{}),a={x:this.scrollx,y:this.scrolly},d=this.wrapper,h={scrollLeft:r.scrollLeft(),scrollTop:r.scrollTop()};if(t.mobile&&c.ignoreMobile||t.overlay&&c.ignoreOverlay||t.macosx&&!t.webkit)return!1;if(d)i.css({height:"auto","margin-bottom":-1*t.scroll.height+"px","margin-right":-1*t.scroll.width+"px","max-height":""});else{if(this.wrapper=d=l("<div>").addClass("scroll-wrapper").addClass(r.attr("class")).css("position","absolute"==r.css("position")?"absolute":"relative").insertBefore(r).append(r),r.is("textarea")&&(this.containerWrapper=i=l("<div>").insertBefore(r).append(r),d.addClass("scroll-textarea")),i.addClass("scroll-content").css({height:"auto","margin-bottom":-1*t.scroll.height+"px","margin-right":-1*t.scroll.width+"px","max-height":""}),r.on("scroll"+n,function(){l.isFunction(c.onScroll)&&c.onScroll.call(o,{maxScroll:a.y.maxScrollOffset,scroll:r.scrollTop(),size:a.y.size,visible:a.y.visible},{maxScroll:a.x.maxScrollOffset,scroll:r.scrollLeft(),size:a.x.size,visible:a.x.visible}),a.x.isVisible&&a.x.scroll.bar.css("left",r.scrollLeft()*a.x.kx+"px"),a.y.isVisible&&a.y.scroll.bar.css("top",r.scrollTop()*a.y.kx+"px")}),d.on("scroll"+n,function(){d.scrollTop(0).scrollLeft(0)}),c.disableBodyScroll){var p=function(l){s(l)?a.y.isVisible&&a.y.mousewheel(l):a.x.isVisible&&a.x.mousewheel(l)};d.on("MozMousePixelScroll"+n,p),d.on("mousewheel"+n,p),t.mobile&&d.on("touchstart"+n,function(e){var o=e.originalEvent.touches&&e.originalEvent.touches[0]||e,s={pageX:o.pageX,pageY:o.pageY},t={left:r.scrollLeft(),top:r.scrollTop()};l(document).on("touchmove"+n,function(l){var e=l.originalEvent.targetTouches&&l.originalEvent.targetTouches[0]||l;r.scrollLeft(t.left+s.pageX-e.pageX),r.scrollTop(t.top+s.pageY-e.pageY),l.preventDefault()}),l(document).on("touchend"+n,function(){l(document).off(n)})})}l.isFunction(c.onInit)&&c.onInit.apply(this,[r])}l.each(a,function(e,t){var i=null,d=1,h="x"===e?"scrollLeft":"scrollTop",p=c.scrollStep,u=function(){var l=r[h]();r[h](l+p),1==d&&l+p>=f&&(l=r[h]()),-1==d&&f>=l+p&&(l=r[h]()),r[h]()==l&&i&&i()},f=0;t.scroll||(t.scroll=o._getScroll(c["scroll"+e]).addClass("scroll-"+e),c.showArrows&&t.scroll.addClass("scroll-element_arrows_visible"),t.mousewheel=function(l){if(!t.isVisible||"x"===e&&s(l))return!0;if("y"===e&&!s(l))return a.x.mousewheel(l),!0;var i=-1*l.originalEvent.wheelDelta||l.originalEvent.detail,n=t.size-t.visible-t.offset;return(i>0&&n>f||0>i&&f>0)&&(f+=i,0>f&&(f=0),f>n&&(f=n),o.scrollTo=o.scrollTo||{},o.scrollTo[h]=f,setTimeout(function(){o.scrollTo&&(r.stop().animate(o.scrollTo,240,"linear",function(){f=r[h]()}),o.scrollTo=null)},1)),l.preventDefault(),!1},t.scroll.on("MozMousePixelScroll"+n,t.mousewheel).on("mousewheel"+n,t.mousewheel).on("mouseenter"+n,function(){f=r[h]()}),t.scroll.find(".scroll-arrow, .scroll-element_track").on("mousedown"+n,function(s){if(1!=s.which)return!0;d=1;var n={eventOffset:s["x"===e?"pageX":"pageY"],maxScrollValue:t.size-t.visible-t.offset,scrollbarOffset:t.scroll.bar.offset()["x"===e?"left":"top"],scrollbarSize:t.scroll.bar["x"===e?"outerWidth":"outerHeight"]()},a=0,v=0;return l(this).hasClass("scroll-arrow")?(d=l(this).hasClass("scroll-arrow_more")?1:-1,p=c.scrollStep*d,f=d>0?n.maxScrollValue:0):(d=n.eventOffset>n.scrollbarOffset+n.scrollbarSize?1:n.eventOffset<n.scrollbarOffset?-1:0,p=Math.round(.75*t.visible)*d,f=n.eventOffset-n.scrollbarOffset-(c.stepScrolling?1==d?n.scrollbarSize:0:Math.round(n.scrollbarSize/2)),f=r[h]()+f/t.kx),o.scrollTo=o.scrollTo||{},o.scrollTo[h]=c.stepScrolling?r[h]()+p:f,c.stepScrolling&&(i=function(){f=r[h](),clearInterval(v),clearTimeout(a),a=0,v=0},a=setTimeout(function(){v=setInterval(u,40)},c.duration+100)),setTimeout(function(){o.scrollTo&&(r.animate(o.scrollTo,c.duration),o.scrollTo=null)},1),o._handleMouseDown(i,s)}),t.scroll.bar.on("mousedown"+n,function(s){if(1!=s.which)return!0;var i=s["x"===e?"pageX":"pageY"],c=r[h]();return t.scroll.addClass("scroll-draggable"),l(document).on("mousemove"+n,function(l){var o=parseInt((l["x"===e?"pageX":"pageY"]-i)/t.kx,10);r[h](c+o)}),o._handleMouseDown(function(){t.scroll.removeClass("scroll-draggable"),f=r[h]()},s)}))}),l.each(a,function(l,e){var o="scroll-scroll"+l+"_visible",s="x"==l?a.y:a.x;e.scroll.removeClass(o),s.scroll.removeClass(o),i.removeClass(o)}),l.each(a,function(e,o){l.extend(o,"x"==e?{offset:parseInt(r.css("left"),10)||0,size:r.prop("scrollWidth"),visible:d.width()}:{offset:parseInt(r.css("top"),10)||0,size:r.prop("scrollHeight"),visible:d.height()})}),this._updateScroll("x",this.scrollx),this._updateScroll("y",this.scrolly),l.isFunction(c.onUpdate)&&c.onUpdate.apply(this,[r]),l.each(a,function(l,e){var o="x"===l?"left":"top",s="x"===l?"outerWidth":"outerHeight",t="x"===l?"width":"height",i=parseInt(r.css(o),10)||0,n=e.size,a=e.visible+i,d=e.scroll.size[s]()+(parseInt(e.scroll.size.css(o),10)||0);c.autoScrollSize&&(e.scrollbarSize=parseInt(d*a/n,10),e.scroll.bar.css(t,e.scrollbarSize+"px")),e.scrollbarSize=e.scroll.bar[s](),e.kx=(d-e.scrollbarSize)/(n-a)||1,e.maxScrollOffset=n-a}),r.scrollLeft(h.scrollLeft).scrollTop(h.scrollTop).trigger("scroll")},_getScroll:function(e){var o={advanced:['<div class="scroll-element">','<div class="scroll-element_corner"></div>','<div class="scroll-arrow scroll-arrow_less"></div>','<div class="scroll-arrow scroll-arrow_more"></div>','<div class="scroll-element_outer">','<div class="scroll-element_size"></div>','<div class="scroll-element_inner-wrapper">','<div class="scroll-element_inner scroll-element_track">','<div class="scroll-element_inner-bottom"></div>',"</div>","</div>",'<div class="scroll-bar">','<div class="scroll-bar_body">','<div class="scroll-bar_body-inner"></div>',"</div>",'<div class="scroll-bar_bottom"></div>','<div class="scroll-bar_center"></div>',"</div>","</div>","</div>"].join(""),simple:['<div class="scroll-element">','<div class="scroll-element_outer">','<div class="scroll-element_size"></div>','<div class="scroll-element_track"></div>','<div class="scroll-bar"></div>',"</div>","</div>"].join("")};return o[e]&&(e=o[e]),e||(e=o.simple),e="string"==typeof e?l(e).appendTo(this.wrapper):l(e),l.extend(e,{bar:e.find(".scroll-bar"),size:e.find(".scroll-element_size"),track:e.find(".scroll-element_track")}),e},_handleMouseDown:function(e,o){var s=this.namespace;return l(document).on("blur"+s,function(){l(document).add("body").off(s),e&&e()}),l(document).on("dragstart"+s,function(l){return l.preventDefault(),!1}),l(document).on("mouseup"+s,function(){l(document).add("body").off(s),e&&e()}),l("body").on("selectstart"+s,function(l){return l.preventDefault(),!1}),o&&o.preventDefault(),!1},_updateScroll:function(e,o){var s=this.container,r=this.containerWrapper||s,i="scroll-scroll"+e+"_visible",n="x"===e?this.scrolly:this.scrollx,c=parseInt(this.container.css("x"===e?"left":"top"),10)||0,a=this.wrapper,d=o.size,h=o.visible+c;o.isVisible=d-h>1,o.isVisible?(o.scroll.addClass(i),n.scroll.addClass(i),r.addClass(i)):(o.scroll.removeClass(i),n.scroll.removeClass(i),r.removeClass(i)),"y"===e&&r.css(s.is("textarea")||h>d?{height:h+t.scroll.height+"px","max-height":"none"}:{"max-height":h+t.scroll.height+"px"}),(o.size!=s.prop("scrollWidth")||n.size!=s.prop("scrollHeight")||o.visible!=a.width()||n.visible!=a.height()||o.offset!=(parseInt(s.css("left"),10)||0)||n.offset!=(parseInt(s.css("top"),10)||0))&&(l.extend(this.scrollx,{offset:parseInt(s.css("left"),10)||0,size:s.prop("scrollWidth"),visible:a.width()}),l.extend(this.scrolly,{offset:parseInt(s.css("top"),10)||0,size:this.container.prop("scrollHeight"),visible:a.height()}),this._updateScroll("x"===e?"y":"x",n))}};var c=n;l.fn.scrollbar=function(e,o){return"string"!=typeof e&&(o=e,e="init"),"undefined"==typeof o&&(o=[]),l.isArray(o)||(o=[o]),this.not("body, .scroll-wrapper").each(function(){var s=l(this),r=s.data(t.data.name);(r||"init"===e)&&(r||(r=new c(s)),r[e]&&r[e].apply(r,o))}),this},l.fn.scrollbar.options=i;var a=function(){var l=0,e=0;return function(o){var s,i,n,c,d,h,p;for(s=0;s<t.scrolls.length;s++)c=t.scrolls[s],i=c.container,n=c.options,d=c.wrapper,h=c.scrollx,p=c.scrolly,(o||n.autoUpdate&&d&&d.is(":visible")&&(i.prop("scrollWidth")!=h.size||i.prop("scrollHeight")!=p.size||d.width()!=h.visible||d.height()!=p.visible))&&(c.init(),n.debug&&(window.console&&console.log({scrollHeight:i.prop("scrollHeight")+":"+c.scrolly.size,scrollWidth:i.prop("scrollWidth")+":"+c.scrollx.size,visibleHeight:d.height()+":"+c.scrolly.visible,visibleWidth:d.width()+":"+c.scrollx.visible},!0),e++));r&&e>10?(window.console&&console.log("Scroll updates exceed 10"),a=function(){}):(clearTimeout(l),l=setTimeout(a,300))}}();window.angular&&!function(l){l.module("jQueryScrollbar",[]).provider("jQueryScrollbar",function(){var e=i;return{setOptions:function(o){l.extend(e,o)},$get:function(){return{options:l.copy(e)}}}}).directive("jqueryScrollbar",function(l,e){return{restrict:"AC",link:function(o,s,r){var t=e(r.jqueryScrollbar),i=t(o);s.scrollbar(i||l.options).on("$destroy",function(){s.scrollbar("destroy")})}}})}(window.angular)});


(function ($, window) {

	$.gatsby_woocommerce_mod = $.gatsby_woocommerce_mod || {};

	$.gatsby_woocommerce_mod.viewTypes = function () {

		var collection = $('[data-view]', $('.gt-view-type'));
		if ( !collection.length ) return;

		collection.on('click', function(e) {

			e.preventDefault();
			var $this = $(this),
				target = $($this.parents('.gt-products-holder'));

			$this
				.addClass('gt-active')
				.siblings()
				.removeClass('gt-active');

			target
				.removeClass('gt-view-list gt-view-grid')
				.addClass('gt-view-' + $this.data('view'));

		});

	}

	/*	Quick View
	/* --------------------------------------------- */

	$.gatsby_woocommerce_mod.quick_view = function () {

		$('body').on('click.quickView', '.quick-view', function (e) {

			e.preventDefault();

			var $this = $(this),
				data = {};

			data.action = $this.data('modal-action');
			data.id = $this.data('id');
			data._wpnonce = $this.data('modal-nonce');

			if ( data.action == 'undefined' ) return;

			$.arcticmodal({
				type: 'ajax',
				url: gatsby_global_vars.ajaxurl,
				ajax: {
					type: 'POST',
					data: data,
					cache: false,
					success: function (data, el, response) {
						data.body.html(response);
					}
				},
				afterLoadingOnShow: function () {

					if ( $( '.woocommerce-product-gallery' ).length ) {
						$( '.woocommerce-product-gallery' ).each( function() {
							$( this ).wc_product_gallery();
						} );
					}

					$.gatsby_woocommerce_mod.thumbs_carousel();

				},
				overlay: {
					css: {
						backgroundColor: "#000",
						opacity: '.7'
					}
				},
				afterClose: function () {

					if ( $('.zoomContainer').length ) {
						var zoomContainer = $('.zoomContainer');
						zoomContainer.remove();

						$('body').removeClass('popup_with_zoomed_image').css({'overflow' : 'auto'});

						$.gatsby_woocommerce_mod.zoom();

					}

				}
			});

		});

	}

	/*	Elevate Zoom
	/* --------------------------------------------- */

	$.gatsby_woocommerce_mod.zoom = function () {

		if ( $('.gt-image-preview-container').length ) {

			$.gatsby_woocommerce_mod.getGalleryList = function () {

				var gallerylist = [],
					gallery = 'gt-product-thumbs';

				$('.' + gallery + ' a').each(function () {

					var img_src = '';

					if ($(this).data("zoom-image")) {
						img_src = $(this).data("zoom-image");
					} else if ($(this).data("image")) {
						img_src = $(this).data("image");
					}

					if ( img_src ) {
						gallerylist.push({
							href: '' + img_src + '',
							title: $(this).find('img').attr("title")
						});
					}

				});

				return gallerylist;
			}

			var $image_preview_container = $('.gt-image-preview-container');

			$image_preview_container.each(function () {

				var $el = $(this),
					unique_id = $el.data('id');

				if ( $('#img-zoom', $el).length ) {

					$('#img-zoom', $el).elevateZoom({
						zoomType: "inner",
						gallery: 'thumbnails_' + unique_id,
						galleryActiveClass: 'active',
						cursor: "crosshair",
						responsive: true,
						easing: true,
						zoomWindowFadeIn: 500,
						zoomWindowFadeOut: 500,
						lensFadeIn: 500,
						lensFadeOut: 500
					});
				}

				if ( $('.gt-open-modal', $el).length ) {

					$('.gt-open-modal', $el).on("click", function (e) {
						e.preventDefault();

						var galleryList;

						if ( $('#img-zoom', $el).length ) {

							var $this = $(this),
								ez = $this.siblings('img').data('elevateZoom');

							galleryList = ez.getGalleryList();


						} else {
							galleryList = $.gatsby_woocommerce_mod.getGalleryList();
						}

						$.fancybox(galleryList);

					});

				}

			});

		}

	}

	/*	Product Carousel
	/* --------------------------------------------- */

	$.gatsby_woocommerce_mod.product_filter_styles = function () {

		var $products_container = $('.gt-products-holder.gt-products-carousel, .gt-products-holder.gt-with-sort');

		if ( $products_container.length ) {

			$products_container.each(function () {

				var $this = $(this),
					$products = $('div.products', $this),
					length = $products.children().length,
					col = $this.data('columns') ? $this.data('columns') : $this.data('sidebar') == 'gt-no-sidebar' ? 4 : 3;

				var filter = $('.gt-filter', $this);

				if ( $this.hasClass('gt-products-carousel') ) {

					var config = {
						responsive: {
							0:    { items: 1 },
							420:  { items: 2 },
							650:  { items: 3 },
							992:  { items: col }
						},
						loop: true,
						smartSpeed: 500,
						autoHeight: true,
						autoplay: false,
						autoplayTimeout: 4000,
						autoplayHoverPause: true,
						navText: ['', ''],
						margin: 30,
						dots: false,
						nav: true,
						stagePadding: 0,
						rtl: $.gatsbyCore.ISRTL ? true : false,
						onInitialized: function () {

							var $owl = $(this.$element.context);
							var base = this,
								$element = base.$element,
								items = {};

							$.each(base._items, function (idx, value) {
								items[idx] = value.children();
							});

							filter.on('click', '[data-filter]', function (e) {
								e.preventDefault();

								var $this = $(this),
									dataFilter = $this.data('filter');

								if ( $this.is('.gt-active') ) return;

								$element.addClass('changed').animate({
									opacity: 0
								}, 200, function () {

									var dataHTML = '';

									if ( dataFilter == "*" ) {
										$.each(items, function (i, v) {
											dataHTML += v.parent().html();
										});
									} else {
										$.each(items, function (i, v) {
											var element = $(v);
											if ( element.hasClass(dataFilter) ) {
												dataHTML += v.parent().html();
											}
										});
									}

									if ( dataHTML.length == '' ) { return; }

									$element.trigger('replace.owl.carousel', dataHTML);
									$element.trigger('refresh.owl.carousel').removeClass('changed').animate({ opacity: 1 }, 200);

								});

								$this
									.addClass('gt-active')
									.parent()
									.siblings()
									.children()
									.removeClass('gt-active');

							});


						}

					}

					if ( length > 1 ) {
						$products.owlCarousel( config );
					}

				} else {

					var $element = $products,
						items = {};

					$.each($element.children(), function (idx, value) {
						items[idx] = $(value);
					});

					filter.on('click', '[data-filter]', function (e) {
						e.preventDefault();

						var $this = $(this),
							dataFilter = $this.data('filter');

						if ( $this.is('.gt-active') ) return;

						$element.addClass('changed').animate({
							opacity: 0
						}, 200, function () {

							var dataHTML = '';

							if ( dataFilter == "*" ) {

								$.each(items, function (i, v) {
									var element = $(v), wrap = element.wrap('<div></div>');
									dataHTML += wrap.parent().html();
								});

							} else {
								$.each(items, function (i, v) {
									var element = $(v);

									if ( element.hasClass(dataFilter) ) {

										var wrap = element.wrap('<div></div>');

										dataHTML += wrap.parent().html();
									}
								});
							}

							if ( dataHTML.length == '' ) { return; }

							$element.html(dataHTML).removeClass('changed').animate({opacity: 1}, 200);

						});

						$this
							.addClass('gt-active')
							.parent()
							.siblings()
							.children()
							.removeClass('gt-active');

					}).find('a').first().trigger('click');

				}

			});

		}

	}

	/*	Product Thumbs Carousel
	/* --------------------------------------------- */

	$.gatsby_woocommerce_mod.product_thumbs_carousel = function () {

		var productThumbs = $('.owl-carousel.gt-product-thumbs');

		if ( productThumbs.length ) {

			var ptItemsConfig = {};

			if ( $('.gt-page-content-wrap.gt-no-sidebar').length ) {
				ptItemsConfig = {
					0: { items: 4 }, 490: { items: 4 }
				}
			} else {
				ptItemsConfig = {
					0: { items: 3 }, 767: { items: 4 }, 992: { items: 3 }
				}
			}

			productThumbs.owlCarousel($.extend({}, $.gatsbyCore.baseOwlConfig, {
				responsive: ptItemsConfig,
				autoHeight: false,
				dots: false,
				nav: true,
				margin: 14,
				loop: false,
				autoplay: false,
				rtl: $.gatsbyCore.ISRTL ? true : false
			}));

		}

	}

	/*	Qty
	/* --------------------------------------------- */

	$.gatsby_woocommerce_mod.qty = function () {

		$(document).on('click', '.gt-qty-btn-up, .gt-qty-btn-down', function () {

			// Get values
			var $qty = $(this).closest('.gt-qty').find('.input-text'),
				currentVal = parseFloat($qty.val()),
				max = parseFloat($qty.attr('max')),
				min = parseFloat($qty.attr('min')),
				step = $qty.attr('step');

			// Format values
			if (!currentVal || currentVal === '' || currentVal === 'NaN') currentVal = 0;
			if (max === '' || max === 'NaN') max = '';
			if (min === '' || min === 'NaN') min = 0;
			if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN') step = 1;

			// Change the value
			if ($(this).is('.gt-qty-btn-up')) {
				if (max && ( max == currentVal || currentVal > max )) {
					$qty.val(max);
				} else {
					$qty.val(currentVal + parseFloat(step));
				}
			} else {
				if (min && ( min == currentVal || currentVal < min )) {
					$qty.val(min);
				} else if (currentVal > 0) {
					$qty.val(currentVal - parseFloat(step));
				}
			}

			// Trigger change event
			$qty.trigger('change');
		});

	}

	/*	Cart
	/* --------------------------------------------- */

	$.gatsby_woocommerce_mod.cart = function () {
		({
			init: function () {
				var base = this;

				base.support = {
					touchevents: Modernizr.touchevents,
					transitions: Modernizr.csstransitions
				};

				base.eventtype = base.support.touchevents ? 'touchstart' : 'click';
				base.listeners();
			},
			listeners: function () {
				var base = this;

				base.track_ajax_refresh_cart(base);
				base.track_ajax_adding_to_cart();
				base.track_ajax_added_to_cart(base);
			},
			track_ajax_refresh_cart: function (base) {

				$.ajax({
					type: 'POST',
					dataType: 'json',
					url: gatsby_global_vars.ajaxurl,
					data: {
						action: "gatsby_refresh_cart_fragment"
					},
					success: function (response) {
						base.update_cart_fragment(response.fragments);
						$('body').trigger('wc_fragments_loaded');
					}
				});

				$('body').on('wc_fragments_refreshed wc_fragments_loaded', function (e) {
					base.update_cart_dropdown(base);
				});

			},
			track_ajax_adding_to_cart: function () {

				$('body').on('adding_to_cart', function (e, $thisbutton, $data) {
					e.preventDefault();

					$thisbutton.block({
							message: null,
							overlayCSS: {
								background: '#fff url(' + gatsby_global_vars.ajax_loader_url + ') no-repeat center',
								backgroundSize: '16px 16px',
								borderRadius: gatsby_global_vars.button_border_small,
								opacity: 0.6
							}
						}
					);

				});

			},
			track_ajax_added_to_cart: function (base) {

				$('body').on('added_to_cart', function (e, fragments, cart_hash, $thisbutton) {

					$thisbutton.unblock().hide();

					base.update_count_and_subtotal(fragments);
					base.update_cart_dropdown.call(base, e);
				});

			},
			update_count_and_subtotal: function (fragments) {
				var invoker = $('.gt-sc-invoker');

				invoker.find('[data-amount]').attr('data-amount', fragments.count);
				invoker.find('.gt-price').html(fragments.subtotal);
			},
			update_cart_dropdown: function (e) {
				this.ajax_remove_cart_item(this);
			},
			update_cart_fragment: function (fragments) {
				if ( fragments ) {
					$.each(fragments, function (key, value) {
						$(key).replaceWith(value);
					});
				}
			},
			ajax_remove_cart_item: function (base) {

				if ( $('.gt-shopping-cart.gt-dropdown').length ) {
					$('.gt-shopping-cart.gt-dropdown').scrollbar();
				}

				$('.gt-shopping-cart .remove-product').on(base.eventtype, function (e) {

					e.preventDefault();

					var $this = $(this),
						cart_id = $this.data("cart_id"),
						product_id = $this.data("product_id");

					$.ajax({
						type: 'POST',
						dataType: 'json',
						url: gatsby_global_vars.ajaxurl,
						data: {
							action: "gatsby_cart_item_remove",
							_wpnonce: gatsby_woocommerce_mod.nonce_cart_item_remove,
							cart_id: cart_id
						},
						success: function (response) {

							var fragments = response.fragments;

							if ( fragments ) {

								$this.parent().animate({
									opacity: 0
								}, function () {
									var $this = $(this);

									$this.slideUp(350, function () {

										$this.remove();

										base.update_count_and_subtotal(fragments);
										base.update_cart_fragment(fragments);

										$('body').trigger('wc_fragments_refreshed');
									});

								});

							}

						}
					});

				});

			}

		}.init());
	}

	/*	Products Load More
	/* --------------------------------------------- */

	$.gatsby_woocommerce_mod.products_load_more = function () {
		({
			initLoadMore: function () {

				var self = this;

				$('.gt-products-holder.gt-paginate-load-more').each(function (id, element) {

					var dataBtn = $('.gt-load-more', element),
						container = $('.products', element);

					if ( !dataBtn ) return;

					dataBtn.on('click', function (e) {

						e.preventDefault();

						var $this = $(this),
							data = $this.data();

						if ( $.isEmptyObject(data) ) return;

						if ( !data.offset ) { data.offset = 0; }

						data.offset += data.items;
						data.items = data.items_per_page;

						self.showLoader($this);

						$.ajax({
							url: gatsby_global_vars.ajaxurl,
							type: "POST",
							data: data,
							cache: false
						}).done(function (response) {

							self.hideLoader($this);

							if ( response.indexOf("{gatsby-products-loaded}") !== -1 ) {

								var response = response.split('{gatsby-products-loaded}'),
									items = $(response.pop()).filter('.gt-col');

								if ( items.length > 0 ) {
									self.insertNewItems(items, container);
								} else {
									self.hideLoadMoreBtnFor(element)
								}

							} else {
								self.hideLoadMoreBtnFor(element)
							}

						}).fail(function (response) {

							self.hideLoader($this);
							$.gatsbyCore.templateHelpers.showAlertBox({
								type: 1,
								status: 'fail',
								message: response.status + ' ' + response.statusText,
								relativeElement: $this,
								icon: 'warning',
								delay: 4000
							});

						});

					});

				});

			},
			insertNewItems: function( items, container ) {

				items.each(function (i, item) {
					var item = $(item);
					i = i - 10 + container.find('.gt-col').length;
					item.children().css( 'transition-delay', ( i + 10 ) / 20 + 's' );
				});

				container
					.append(items)
					.gatsbyImagesLoaded()
					.then(function() {

						var appended = container.find('.gt-col.appended');

						container.addClass('loaded');

						if ( $.gatsbyCore.TRANSITIONSUPPORTED ) {
							appended.on($.gatsbyCore.TRANSITIONEND, function(){
								appended.addClass('loaded');
							});
						} else {
							appended.addClass('loaded');
						}

					});

			},

			showLoader: function(relativeElement) {

				if ( relativeElement === undefined || !relativeElement.length ) return false;
				relativeElement.addClass('gt-isotope-loading');

			},

			hideLoader: function(relativeElement) {

				if ( relativeElement === undefined || !relativeElement.length ) return false;
				relativeElement.removeClass('gt-isotope-loading');

			},

			hideLoadMoreBtnFor: function(holder) {

				$('.gt-load-more', holder).slideUp(function() {
					$(this).remove();
				});

			}

		}.initLoadMore());
	}

	/*	Product Thumbs Carousel
	/* --------------------------------------------- */

	$.gatsby_woocommerce_mod.thumbs_carousel = function () {

		if ( $('.flex-control-nav').length ) {

			var $thumbs_carousel = $('.flex-control-nav');

			var $owl = $thumbs_carousel.owlCarousel({
				items : 4,
				URLhashListener : false,
				navSpeed : 800,
				nav : true,
				loop : true,
				dots: false,
				margin: 10,
				rtl: $.gatsbyCore.ISRTL ? true : false,
				navText:false,
				responsive : {
					0 :   { items : 2 },
					480 : { items : 2 },
					992 : { items : 3 }
				}
			});

			$owl.off('change.owl.carousel');

		}

	}

	/*	LOAD READY
	/* --------------------------------------------- */

	$(window).load(function () {
		$.gatsby_woocommerce_mod.product_filter_styles();
		$.gatsby_woocommerce_mod.quick_view();
		$.gatsby_woocommerce_mod.product_thumbs_carousel();
		$.gatsby_woocommerce_mod.products_load_more();
		$.gatsby_woocommerce_mod.thumbs_carousel();
	});

	/*	DOM READY
	 /* --------------------------------------------- */

	$(function () {
		$.gatsby_woocommerce_mod.viewTypes();
		$.gatsby_woocommerce_mod.cart();
		$.gatsby_woocommerce_mod.qty();
		$.gatsby_woocommerce_mod.zoom();
	});

})(jQuery, window);

