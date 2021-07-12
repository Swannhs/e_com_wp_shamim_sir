
function gatsby_fbRowGetAllElementsWithAttribute( attribute ) {
	var matchingElements = [],
		allElements = document.getElementsByTagName( '*' ),
		i,
		n;

	for ( i = 0, n = allElements.length; i < n; i++ ) {
		if ( allElements[i].getAttribute( attribute ) ) {
			matchingElements.push( allElements[i] );
		}
	}
	return matchingElements;
}

function gatsby_fbRowOnPlayerReady( event ) {
	var player   = event.target,
		currTime = 0,
		firstRun = true,
		prevCurrTime,
		timeLastCall;

	//player.playVideo();
	if ( player.isMute ) {
		player.mute();
	}

	prevCurrTime = player.getCurrentTime();
	timeLastCall = +new Date() / 1000;

	player.loopInterval = setInterval( function() {
			if ( 'undefined' !== typeof player.loopTimeout ) {
				clearTimeout( player.loopTimeout );
			}

			if ( prevCurrTime === player.getCurrentTime() ) {
				currTime = prevCurrTime + ( +new Date() / 1000 - timeLastCall );
			} else {
				currTime = player.getCurrentTime();
				timeLastCall = +new Date() / 1000;
			}
			prevCurrTime = player.getCurrentTime();

			if ( currTime + ( firstRun ? 0.45 : 0.21 ) >= player.getDuration() ) {
				player.pauseVideo();
				player.seekTo( 0 );
				player.playVideo();
				firstRun = false;
			}
		}, 150
	);
}

function gatsby_fbRowOnPlayerStateChange( event ) {
	if ( event.data === YT.PlayerState.ENDED ) {
		if ( 'undefined' !== typeof event.target.loopTimeout ) {
			clearTimeout( event.target.loopTimeout );
		}
		event.target.seekTo( 0 );

		// Make the video visible when we start playing
	} else if ( event.data === YT.PlayerState.PLAYING ) {
		jQuery( event.target.getIframe() ).parent().css( 'visibility', 'visible' );
	}
}

function onYouTubeIframeAPIReady() {
	var videos = gatsby_fbRowGetAllElementsWithAttribute( 'data-youtube-video-id' ),
		autoplays = gatsby_fbRowGetAllElementsWithAttribute( 'data-youtube-autoplay' ),
		i,
		videoID,
		elemID,
		k,
		player;

	for ( i = 0; i < videos.length; i++ ) {
		videoID = videos[i].getAttribute( 'data-youtube-video-id' );
		autoplay = autoplays[i].getAttribute( 'data-youtube-autoplay' );

		if ( '' === videos[ i ] ) {
			continue;
		}

		player = new YT.Player(
			videos[ i ], {
				height: 'auto',
				width: 'auto',
				videoId: videoID,
				playerVars: {
					autohide: 1,
					autoplay: autoplay || 0,
					loop: 0,
					fs: 0,
					showinfo: 0,
					modestBranding: 1,
					start: 0,
					controls: 0,
					rel: 0,
					disablekb: 1,
					iv_load_policy: 3,
					wmode: 'transparent'
				},
				events: {
					'onReady': gatsby_fbRowOnPlayerReady,
					'onStateChange': gatsby_fbRowOnPlayerStateChange
				}
			}
		);

		if ( 'yes' === videos[ i ].getAttribute( 'data-mute' ) ) {
			player.isMute = true;
		} else {
			player.isMute = false;
		}

		// Force YT video to load in HD
		if ( 'true' === videos[ i ].getAttribute( 'data-youtube-video-id' ) ) {
			player.setPlaybackQuality( 'hd720' );
		}

		// Videos in Windows 7 IE do not fire onStateChange events so the videos do not play.
		// This is a fallback to make those work.
		setTimeout(
			function() {
				jQuery( '#' + elemID ).css( 'visibility', 'visible' );
			}, 500
		);
	}
}

;(function($){

	'use strict';

	$.gatsbyCore = {

		NOSIDEBAR: $('.gt-page-content-wrap.gt-no-sidebar').length,
		ISRTL: gatsby_global_vars.rtl == 1 ? true : false,
		TRANSITIONDURATION: 500, // base jQuery animation duration
		TRANSITIONSUPPORTED : Modernizr.csstransitions,

		FLEXBOXSUPPORTED: Modernizr.flexbox,
		ISTOUCH: Modernizr.touchevents,
		EVENT: Modernizr.touchevents ? 'touchstart' : 'click',
		ANIMATIONSUPPORTED: Modernizr.cssanimations,

		TRANSITIONEND : "webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend",
		ANIMATIONEND: "webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",

		/**
		 *
		 * @return undefined;
		 **/
		DOMLoaded: function(){

			var base = this;

			base.refresh_elements();

			// set base jQuery animation duration
			$.fx.speed = base.TRANSITIONDURATION;

			// background images init
			if($('[data-gatsby-bg]').length) base.templateHelpers.bg();

			// owl adaptives
			if ( $('.owl-carousel').length ) {
				this.templateHelpers.owlAdaptive();
				this.initCarousels();
			}

			// compressed form init
			if($('.gt-compressed').length) base.modules.compressedForm.init();

			// main menu init
			if($('.gt-navigation').length) base.modules.navigation.init(base);

			// sticky section init
			if($('.gt-sticky').length) base.modules.stickySection.init();

			// dropdown elements init
			if($('.gt-dropdown-invoker').length) base.modules.dropdown();

			// close btn init
			if($('.gt-close').length) base.modules.closeBtn();

			// header 3 toggle nav
			if($('.gt-toggle-nav').length) base.modules.showHideNav();

			// display settings for percentage element
			if($('.gt-progress-bars-holder.type-3').length) base.templateHelpers.nowrapProgressBars.check();

			// back to top button init
			this.modules.backToTop({
				easing: 'easeOutQuint',
				speed: 550,
				cssPrefix: 'gt-'
			});

			// prealoader init
			if($('#preloader').length) base.modules.preloader();

			if ( $('.float-aside-btn').length ) {
				this.modules.sideMenu();
			}

			if ( $('.gt-navigation.gt-onepage-navigation').length ) {
				this.modules.onePageNavigation.init();
			}

		},

		elements: {
			'html' : 'html',
			'body' : 'body',
			'#theme-wrapper' : 'wrapper',
			'#nav-panel' : 'navPanel',
			'.mobile-advanced': 'navMobile',
			'.gt-navigation': 'navMain'
		},
		$: function (selector) { return $(selector); },
		refresh_elements: function() {
			for (var key in this.elements) {
				this[this.elements[key]] = this.$(key);
			}
		},

		initCarousels: function () {

			var tc1 = $('.owl-carousel.gt-testimonials-holder.gt-type-1');

			if ( tc1.length ) {

				tc1.owlCarousel($.extend({}, $.gatsbyCore.baseOwlConfig, {
					items: 1,
					nav: true,
					dots: false,
					autoplay: false,
					mouseDrag: false,
					rtl: $.gatsbyCore.ISRTL ? true : false
				}));

			}

			var pagsCarousel = $('.owl-carousel.gt-authors-holder');

			if ( pagsCarousel.length ) {

				var pagsItemsConfig = {};

				if ( $.gatsbyCore.NOSIDEBAR ) {

					pagsItemsConfig = {
						0: { items: 1 }, 768: { items: 2 }, 991: { items: 3 }
					}

				} else {

					pagsItemsConfig = {
						0: { items: 1 }, 768: { items: 2 }, 1200: { items: 3 }
					}

				}

				pagsCarousel.owlCarousel($.extend({}, $.gatsbyCore.baseOwlConfig, {
					responsive: pagsItemsConfig,
					nav: false,
					margin: 30,
					center: $.gatsbyCore.ISRTL ? false : true,
					dots: false,
					mouseDrag: false,
					autoplay: false,
					rtl: $.gatsbyCore.ISRTL ? true : false
				}));

			}

			var tc2 = $('.owl-carousel.gt-testimonials-holder.gt-type-2');

			if ( tc2.length ) {

				var tcItemsConfig = {};

				if ( $.gatsbyCore.NOSIDEBAR ) {

					if ( tc2.hasClass('gt-cols-3') ) {

						tcItemsConfig = {
							0: { items: 1 }, 767: { items: 2 }, 991: { items: 3 }
						}

					} else if ( tc2.hasClass('gt-cols-2') ) {

						tcItemsConfig = {
							0: { items: 1 }, 767: { items: 2 }
						}

					}

				} else {

					if ( tc2.hasClass('gt-cols-3') ) {

						tcItemsConfig = {
							0: { items: 1 }, 767: { items: 2 }, 1201: { items: 3 }
						}

					}
					else if(tc2.hasClass('gt-cols-2')){

						tcItemsConfig = {
							0: { items: 1 }, 767: { items: 2 }
						}

					}

				}

				tc2.owlCarousel($.extend({}, $.gatsbyCore.baseOwlConfig, {
					responsive: tcItemsConfig,
					nav: false,
					dots: true,
					rtl: $.gatsbyCore.ISRTL ? true : false
				}));

			}

			var simpleCarousel = $('.owl-carousel.gt-simple-carousel');

			if ( simpleCarousel.length) {

				simpleCarousel.owlCarousel($.extend({}, $.gatsbyCore.baseOwlConfig, {
					items: 1,
					dots: false,
					nav: true,
					autoplay: false,
					rtl: $.gatsbyCore.ISRTL ? true : false
				}));

			}

			var entriesCarousel = $('.owl-carousel.gt-entries-holder, .owl-carousel.gt-portfolio-holder');

			if ( entriesCarousel.length ) {

				entriesCarousel.each(function () {

					var $this = $(this),
						length = $this.children().length,
						ecItemsConfig = {};

					if ( $.gatsbyCore.NOSIDEBAR ) {

						if ( $this.hasClass('gt-cols-3') ) {
							ecItemsConfig = {
								0:   { items: 1 }, 600: { items: 2 }, 991: { items: 3 }
							}
						} else if ( $this.hasClass('gt-cols-2') ) {
							ecItemsConfig = {
								0:   { items: 1 }, 600: { items: 2 }
							}
						}

					} else {

						if ( $this.hasClass('gt-cols-3') ) {
							ecItemsConfig = {
								0: { items: 1 }, 600: { items: 2 }, 1200: { items: 3 }
							}
						} else if ( $this.hasClass('gt-cols-2') ) {
							ecItemsConfig = {
								0: { items: 1 }, 600: { items: 2 }
							}
						}

					}

					if ( length > 1 ) {
						$this.owlCarousel($.extend({}, $.gatsbyCore.baseOwlConfig, {
							responsive: ecItemsConfig,
							margin: 30,
							nav: true,
							dots: false,
							rtl: $.gatsbyCore.ISRTL ? true : false
						}));
					}

				});

			}

			var $brands = $('.brands-carousel');

			if ( $brands.length ) {

				$brands.each(function () {

					var $this = $(this),
						length = $this.children().length,
						config = {
							responsive: {
								0:    { items: 2 },
								540:  { items: 3 },
								767:  { items: 4 },
								970:  { items: 5 }
							},
							dots: false,
							nav: true,
							margin: 20,
							rtl: $.gatsbyCore.ISRTL ? true : false
						};

					if ( length > 1 ) {
						$this.owlCarousel($.extend({}, $.gatsbyCore.baseOwlConfig, config));
					}

				});

			}

			var $app = $('.gt-app-carousel');

			if ( $app.length ) {

				$app.each(function () {

					var $this = $(this),
						length = $this.children().length,
						config = {
							items: 3,
							center: true,
							dots: true,
							nav: false,
							autoplay: false,
							margin: 0,
							rtl: $.gatsbyCore.ISRTL ? true : false
						};

					if ( length > 1 ) {
						$this.owlCarousel($.extend({}, $.gatsbyCore.baseOwlConfig, config));
					}

				});

			}

		},

		/**
		 *
		 * @return undefined;
		 **/
		outerResourcesLoaded: function(){

			// breadcrumbs outer offset init
			if ( $('#header.gt-fixed').length ) this.templateHelpers.breadCrumbsOffset();

			// dropcap style 3 init
			if ( $('.gt-dropcap.gt-type-3').length ) this.templateHelpers.canvasDropcap();

			// init animation for progress bars
			if ( $('.gt-progress-bars-holder').length ) this.modules.animatedProgressBars.init({
				speed: 800,
				easing: 'easeOutQuart'
			});

			// init animation for counters
			if ( $('.gt-counters-holder').length ) this.modules.animatedCounters.init();

			// synchronizes owl carousel
			if ( $('.owl-carousel[data-sync]').length ) this.modules.syncOwlCarousel.init();

			// isotope
			if ( $('.gt-isotope-container').length ) this.modules.isotope.init();

			// likes
			if ( $('.gt-entry-likes').length ) this.modules.postLike();

			if ( $('.gt-info-title-button').length ) this.modules.infoPopup();

			// animated content
			if ( $('[data-animation]').length ) this.modules.animatedContent(200);

			if ( $('.error404 .gt-fullscreen-layout-type' ).length ) this.templateHelpers.fullScreenLayout.init();
			if ( $('.gt-media-holder.gt-fullscreen' ).length ) this.templateHelpers.fullScreenMediaHolder.init();

			// dim header init
			if ( $('#header.gt-dim.gt-fixed, #header.gt-transparent').length ) this.modules.fixedDimHeader();

			var entryCarousel = $('.owl-carousel.gt-entry-carousel');

			if ( entryCarousel.length) {

				entryCarousel.owlCarousel($.extend({}, $.gatsbyCore.baseOwlConfig, {
					dots: false,
					items: 1,
					nav: true,
					autoplay: false,
					rtl: $.gatsbyCore.ISRTL ? true : false
				}));

			}

		},

		jQueryExtend: function(){

			$.fn.extend({

				gatsbyImagesLoaded : function () {

				    var $imgs = this.find('img[src!=""]');

				    if (!$imgs.length) {return $.Deferred().resolve().promise();}

				    var dfds = [];

				    $imgs.each(function(){
				        var dfd = $.Deferred();
				        dfds.push(dfd);
				        var img = new Image();
				        img.onload = function(){dfd.resolve();}
				        img.onerror = function(){dfd.resolve();}
				        img.src = this.src;
				    });

				    return $.when.apply($,dfds);

				}

			});

		},

		modules: {

			/**
			 * Initialize main navigation
			 * @return undefined;
			 **/
			navigation: {

				init: function(base){

					this.navigation = $('.gt-navigation');
					this.bindEvents();

					this.createResponsiveButtons(base);
					this.navProcess(base);

					if ( $.gatsbyCore.ISTOUCH ) {
						this.touchNavMobileNavigation(base);
						this.touchNavHeaderNavigation(base);
					}

				},

				navProcess: function (base) {

					var self = this;

					base.navButton.on($.gatsbyCore.EVENT, function (e) {
						e.preventDefault();

						if ( base.html.hasClass('panel-opened') ) {
							base.html.removeClass('panel-opened');
							base.panelOverlay.removeClass('active');
						} else {
							base.html.addClass('panel-opened');
							base.panelOverlay.addClass('active');
						}

					});

					base.panelOverlay.click(function(e) {
						e.preventDefault();
						base.html.removeClass('panel-opened');
						$(this).removeClass('active');
					});

					base.navHide.on($.gatsbyCore.EVENT, function (e) {
						e.preventDefault();
						base.panelOverlay.trigger('click');
					});

					$(window).on('resize', function() {
						if ( $(window).width() > 991 - self.getScrollbarWidth() ) {
							base.panelOverlay.trigger('click');
						}
					});

				},

				touchNavMobileNavigation: function (base) {

					base.navMobile.on($.gatsbyCore.EVENT, '.arrow', function (e) {
						e.preventDefault();
						var $this = $(this),
							$parent = $this.closest('li');

						$this.next().stop().slideToggle();
						if ( $parent.hasClass('open-menu') ) {
							$parent.removeClass('open-menu');
						} else {
							$parent.addClass('open-menu');
						}

					});

				},

				touchNavHeaderNavigation: function (base) {
					var clicked = false;

					$("#header li.menu-item-has-children > a, li.cat-parent > a, #header li.page_item_has_children > a").on($.gatsbyCore.EVENT, function (e) {
						if ( clicked != this ) {
							e.preventDefault();
							clicked = this;
						}
					});

				},

				createResponsiveButtons : function (base) {

					var buttonData = {
						'class' : 'gt-nav-btn'
					}

					if ( !base.navMobile.length ) return;

					base.navButton = $('<span></span>', buttonData).insertBefore(base.navMain);

					base.navHide = $('<a></a>', {
						id: 'advanced-menu-hide',
						'class': 'advanced-menu-hide',
						'href' : 'javascript:void(0)'
					}).insertAfter(base.navPanel);

					base.panelOverlay = $('<div></div>', {
						'class': 'panel-overlay'
					}).insertBefore(base.navPanel);

				},

				bindEvents: function(){
					var base = this;

					this.navigation.on('mouseenter.smart touchstart.mobilenav', 'li[class*="menu-item-has-children"], li[class*="page_item_has_children"]', this.smartPosition);
					//this.navigation.on('mouseleave.smart', '.gt-dropdown, ul.sub-menu, ul.children', this.resetSmartPosition);
				},

				getScrollbarWidth: function() {
					// thx David
					if (this.scrollbarSize === undefined) {
						var scrollDiv = document.createElement("div");
						scrollDiv.style.cssText = 'width: 99px; height: 99px; overflow: scroll; position: absolute; top: -9999px;';
						document.body.appendChild(scrollDiv);
						this.scrollbarSize = scrollDiv.offsetWidth - scrollDiv.clientWidth;
						document.body.removeChild(scrollDiv);
					}
					return this.scrollbarSize;
				},

				smartPosition: function(e){

					var $this = $(this),
						$wW = $(window).width();

					if ( $this.hasClass('pos-left') || $this.hasClass('pos-right') || $this.hasClass('pos-center') ) return;

					var child = $this.children('.gt-dropdown, ul.sub-menu, ul.children'),
						transformCoeficient = child.outerWidth() - child.outerWidth() * .85;

					if ( $.gatsbyCore.ISRTL ) {

						if ( child.offset().left - transformCoeficient < 0 ) child.addClass('gt-reverse');

					} else {
						var posX = child.offset().left,
							oW = child.outerWidth();

						if ( posX + oW > $wW ) child.addClass('gt-reverse');
					}

				},

				resetSmartPosition: function(e){
					var $this = $(this);

					setTimeout(function() {
						$this.find('.gt-reverse').removeClass('gt-reverse');
					}, 15);
				}

			},

			sideMenu: function(){

				var body = $('body'),
					container = $('.float-aside-overlay'),
					nav = $('.float-aside');

				if ( !container.length ) return;

				body.on('click.side_menu', '.float-aside-btn', function(event){
					container.toggleClass('opened');
				});

				body.on('click.sideMenuFocusOut touchstart.sideMenuFocusOut', '.float-aside-overlay', function(event) {
					if ( !$(event.target ).closest(nav).length) container.removeClass('opened');
				});

			},

			onePageNavigation: {

				init: function(){

					var self = this;

					self.navigation = $('.gt-navigation.gt-onepage-navigation');
					if ( !self.navigation.length ) return;

					self.page = $('html, body');
					self.sticky = $('.gt-over');
					self.sections = $('.gt-section');
					self.stickyHeight = self.sticky.length && ($(window).width() > 767 && $(window).height() > 500) ? self.sticky.outerHeight() : 0;
					self.isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);

					self.navigation.on('click', 'a[href^="#"]', {self: self}, self.linkHandler);
					$(window).on('scroll.onePage', {self: self}, self.checkCurrentSection);

					self.checkHash();

				},

				checkHash: function(){

					var self = this,
						section = $(window.location.hash);

					if(!section.length) return;

					self.scrollTo(section);

				},

				scrollTo: function(section, hash){

					var self = this,
						offset = section.offset().top - self.stickyHeight;

					self.page.stop().animate({
						scrollTop: offset
					}, {
						easing: "easeInOutQuart",
						duration: 1250,
						complete: function(){

							if(!self.isChrome || !hash) return;

							window.location.hash = hash;

						},
						step: function(){

							if(self.isChrome || window.location.hash === hash || !hash) return;

							window.location.hash = hash;

						}
					});

				},

				linkHandler: function(e){

					e.preventDefault();

					var self = e.data.self,
						$this = $(this),
						hash = $this.attr('href'),
						section = $(hash);

					if (section.length) {
						self.scrollTo(section, hash);
					}

				},

				checkCurrentSection: function(event){

					var self = event.data.self,
						scrollPos = $(this).scrollTop(),
						wH = $(window).height();

					if(scrollPos + wH == $(document).height()){

						var section = '#' + self.sections.last().attr('id');

						self.addCurrentClass(section);

						return false;

					}

					self.sections.each(function(i, el){

						var $this = $(el),
							offset = el.offsetTop - self.stickyHeight - 1,
							section;

						if(scrollPos >= offset && scrollPos < offset + el.offsetHeight){

							section = '#' + $this.attr('id');

							self.addCurrentClass(section);

							return false;

						}

					});

				},

				addCurrentClass: function(section){

					var self = this;

					self.navigation.find('a[href="'+section+'"]')
						.parent()
						.addClass('current')
						.siblings()
						.removeClass('current');

				}

			},

			showHideNav: function(){

				var btn = $('.gt-toggle-nav');
				if(!btn.length) return;

				btn.on('click', function(e){

					e.preventDefault();

					var navigation = $('.gt-navigation.gt-animated-nav');

					if(navigation.length){
						$(this).toggleClass('gt-active');
						navigation.toggleClass('gt-nav-hidden');
					}

				});

			},

			/**
			 * Initialize compressed forms
			 **/
			compressedForm: {

				init: function(collection){

					this.collection = collection ? collection : $('form.gt-compressed');

					if ( !this.collection.length ) return;

					this.bindEvents();

				},

				bindEvents: function(){

					this.collection.on('mouseenter', function(e){
						$(this).addClass('gt-f-hide').focus();
					});

					this.collection.on('mouseleave', function(e) {

						var $this = $(this);

						if ( $this.hasClass('gt-focused') || $.gatsbyCore.ISTOUCH ) return false;

						$this.removeClass('gt-f-hide');

					});

					this.collection.on('focus', 'input', function(e){

						$(this).closest('.gt-compressed').addClass('gt-focused');

					});

					this.collection.on('blur', 'input', function(e){

						var form = $(this).closest('.gt-compressed');

						form.removeClass('gt-f-hide').removeClass('gt-focused');

						if ( !$(e.relatedTarget).closest('.gt-compressed').length ) form.removeClass('gt-prevented');

					});

					if ( $.gatsbyCore.ISTOUCH ){

						this.collection.on('submit', function(e) {

							var $this = $(this);

							if ( !$this.hasClass('gt-prevented') ) {

								e.preventDefault();
								$this.addClass('gt-f-hide').addClass('gt-prevented');

							}

						});

					}

				}

			},

			/**
			 * Initializes dropdown module
			 * @return Object Core;
			 **/
			dropdown: function(){

				var dropdown = {

					init: function(){

						this.bindEvents();

					},

					bindEvents: function(){

						var self = this;

						$('body').on('click', '.gt-dropdown-invoker', function(e){

							e.preventDefault();
							e.stopPropagation();

							var invoker = $(this),
								dropdown = invoker.next('.gt-dropdown');

							self.smartPosition(dropdown);

							invoker.add(dropdown).toggleClass('gt-opened');
							dropdown.parent().toggleClass('gt-dropdown-over');

						});

						$(document).on('click', function(e){

							var dropdown = $('.gt-dropdown');

							if(!$(e.target).closest(dropdown).length){

								dropdown.add(dropdown.prev('.gt-dropdown-invoker')).removeClass('gt-opened');
								dropdown.parent().removeClass('gt-dropdown-over');

							}

						});

					},

					smartPosition: function(dropdown){

						var dWidth = dropdown.outerWidth(),
							dOfsset = dropdown.offset().left,
							$wW = $(window).width();

						if (dOfsset + dWidth > $wW) dropdown.addClass('gt-reverse');

					}

				}

				dropdown.init();

				return this;

			},

			/**
			 * Initialize global close event
			 * @return Object Core;
			 **/
			closeBtn: function(){

				$('body').on('click.globalclose', '.gt-close:not(.gt-shopping-cart-full .gt-close)', function(e){

					e.preventDefault();

					$(this).parent().stop().animate({
						opacity: 0
					}, function(){

						$(this).stop().slideUp(function(){

							$(this).remove();

						});

					});

				});

				return this;

			},

			/**
			 * Page preloader
			 * @return Object modules;
			 **/
			preloader: function(options){

				var config = {
						waitAfterLoad: 0,
						duration: 150
					},
					loader = $('#preloader');

				$.extend(config, options);

				$('body').gatsbyImagesLoaded().then(function(){

					setTimeout(function(){

						loader.fadeOut(config.duration, function(){
							$(this).remove();
						});

					}, config.waitAfterLoad);

				});

				return this;

			},

			/**
			 * Generates back to top button
			 * @return Object Core;
			 **/
			backToTop: function(config){

				var backToTop = {

					init: function(config){

						var self = this;

						if(config) this.config = $.extend(this.config, config);

						this.btn = $('<button></button>', {
							class: self.config.cssPrefix + 'btn ' + self.config.cssPrefix +'icon '+self.config.cssPrefix+'back-to-top animated stealthy',
							html: '<span class="lnr lnr-chevron-up"></span>'
						});

						this.bindEvents();

						$('body').append(this.btn);

					},

					config: {
						breakpoint: 700,
						showClass: 'zoomIn',
						hideClass: 'zoomOut',
						easing: 'linear',
						speed: 500,
						cssPrefix: ''
					},

					bindEvents: function(){

						var page = $('html, body'),
							self = this;

						this.btn.on('click', function(e){

							page.stop().animate({

								scrollTop: 0

							}, {
								easing: self.config.easing,
								duration: self.config.speed
							});

						});

						this.btn.on($.gatsbyCore.ANIMATIONEND, function(e){

							e.preventDefault();

							var $this = $(this);

							if($this.hasClass(self.config.hideClass)){

								$this
									.addClass('stealthy')
									.removeClass(self.config.hideClass + " " + self.config.cssPrefix + "inview");

							}

						});

						$(window).on('scroll.backtotop', { self: this}, this.toggleBtn);

					},

					toggleBtn: function(e){

						var $this = $(this),
							self = e.data.self;

						if($this.scrollTop() > self.config.breakpoint && !self.btn.hasClass(self.config.cssPrefix + 'inview')){

							self.btn
									.addClass(self.config.cssPrefix + 'inview')
									.removeClass('stealthy');

							if($.gatsbyCore.ANIMATIONSUPPORTED){
								self.btn.addClass(self.config.showClass);
							}

						}
						else if($this.scrollTop() < self.config.breakpoint && self.btn.hasClass(self.config.cssPrefix + 'inview')){

							self.btn.removeClass(self.config.cssPrefix + 'inview');

							if(!$.gatsbyCore.ANIMATIONSUPPORTED){
								self.btn.addClass('stealthy')
							}
							else{
								self.btn.removeClass(self.config.showClass)
										.addClass(self.config.hideClass);
							}

						}

					}

				}

				backToTop.init(config);

				return this;

			},

			/**
			 * Sticky header section
			 **/
			stickySection: {

				STICKYPADDING: 10,
				MAXSTICKYHEIGHT: 90,

				init: function(){

					this.body = $('body');
					this.sticky = $('#header').find('.gt-sticky');

					if (!this.sticky.length) return;

					this.bindEvents();
					this.updateDocumentState();

				},

				updateDocumentState: function(){

					this.reset();

					if($(window).width() < 768) return;

					this.sticky.removeAttr('style');

					this.stickyHeight = this.sticky.outerHeight();

					if(this.stickyHeight > this.MAXSTICKYHEIGHT){

						this.needScale = true;

						this.defPaddingTop = parseInt(this.sticky.css('padding-top'));
						this.defPaddingBottom = parseInt(this.sticky.css('padding-bottom'));

						this.stickyOffset = this.sticky.offset().top + this.defPaddingTop - this.STICKYPADDING;

					}
					else{

						this.needScale = false;
						this.stickyOffset = this.sticky.offset().top;

					}

					$(window).trigger('scroll.sticky');

				},

				reset: function(){

					var $w = $(window);

					this.sticky.removeClass('gt-sticked');
					this.freeSpace();

					if($w.width() < 768 && this.hasEvents){

						var spacer = this.sticky.siblings('.gt-sticky-spacer');
						if(spacer.length) spacer.remove();

						$w.off('scroll.sticky');
						this.hasEvents = false;

						return;

					}
					else if($w.width() >= 768 && !this.hasEvents){

						$w.on('scroll.sticky', {self: this}, this.scrollHandler);
						this.hasEvents = true;

					}

				},

				bindEvents: function(){

					var $w = $(window),
						self = this;

					$w.on('scroll.sticky', {self: this}, this.scrollHandler);
					$w.on('resize.sticky', function(){

						if(self.resizeTimeoutId) clearTimeout(self.resizeTimeoutId);

						self.resizeTimeoutId = setTimeout(function(){

							self.updateDocumentState();

						}, 100);

					});
					self.hasEvents = true;

				},

				scrollHandler: function(e){

					var $w = $(this),
						self = e.data.self;

					if($w.scrollTop() > self.stickyOffset && !self.sticky.hasClass('gt-sticked')){

						self.sticky.addClass('gt-sticked');

						if(self.needScale){

							self.sticky.css({
								'padding-top': self.STICKYPADDING,
								'padding-bottom': self.STICKYPADDING
							});

						}

						self.fillSpace();

					}
					else if($w.scrollTop() <= self.stickyOffset && self.sticky.hasClass('gt-sticked')){

						self.sticky.removeClass('gt-sticked');

						if(self.needScale){

							self.sticky.css({
								'padding-top': self.defPaddingTop,
								'padding-bottom': self.defPaddingBottom
							});

						}

						self.freeSpace();

					}

				},

				fillSpace: function(){

					var self = this,
						parent = self.sticky.parent(),
						spacer = parent.children('.gt-sticky-spacer');

					if(spacer.length){
						spacer.show().css('height', self.stickyHeight);
						return false;
					}
					else{

						spacer = $('<div></div>', {
							class: 'gt-sticky-spacer',
							style: 'height:' + self.stickyHeight + 'px'
						});

						parent.prepend(spacer);

					}

				},

				freeSpace: function(){

					var self = this,
						parent = self.sticky.parent(),
						spacer = parent.children('.gt-sticky-spacer');

					if(spacer.length) spacer.hide();

				}

			},

			/**
			 * Changes header background when scrolling
			 * @return Object Core;
			 **/
			fixedDimHeader: function(){

				var dH = {

					init: function(){

						this.header = $('#header.gt-dim.gt-fixed, #header.gt-transparent');
						this.pageContentWrap = $('.gt-page-content-wrap');

						this.breakpoint = 50;

						if(!this.pageContentWrap.length) return false;

						this.bindEvents();
						// this.updateDocumentState();

						$(window).trigger('scroll.fixedDimHeader');

					},

					updateDocumentState: function(){

						// this.breakpoint = this.pageContentWrap.offset().top - this.header.outerHeight();

					},

					bindEvents: function(){

						var $w = $(window),
							self = this;

						$w.on('scroll.fixedDimHeader', {self: this}, this.scrollHandler);
						 //$w.on('resize.fixedDimHeader', function(){ self.updateDocumentState(); });

					},

					reset: function(){

						this.header.removeClass('gt-over');

					},

					scrollHandler: function(e){

						var $this = $(this),
							self = e.data.self;

						if($this.width() < 768){
							self.reset();
							return false;
						}

						if($this.scrollTop() > self.breakpoint && !self.header.hasClass('gt-over')){
							self.header.addClass('gt-over');
						}
						else if($this.scrollTop() <= self.breakpoint && self.header.hasClass('gt-over')){
							self.header.removeClass('gt-over');
						}

					}

				}

				dH.init();

				return this;

			},

			animatedProgressBars: {

				init: function(config) {

					this.collection = $('.gt-pbar');
					if(!this.collection.length) return;

					this.holdersCollection = $('.gt-progress-bars-holder');
					this.w = $(window);

					this.preparePBars();

					$.extend(this.config, config);

					this.updateDocumentState();

					this.w.on('resize.animatedprogressbars', this.updateDocumentState.bind(this));
					this.w.on('scroll.animatedprogressbars', {self: this}, this.scrollHandler);
					this.w.trigger('scroll.animatedprogressbars');

				},

				config: {
					speed: $.fx.speed,
					easing: 'linear'
				},

				updateDocumentState: function(){

					this.breakpoint = this.w.height() / 1.4;

				},

				preparePBars: function(){

					this.collection.each(function(i, el){

						var $this = $(el),
							indicator = $this.children('.gt-pbar-inner'),
							value = $this.data('value');

						$this.add(indicator).data('r-value', value);
						$this.add(indicator).attr('data-value', 0);

						indicator.css('width', 0);

					});

				},

				scrollHandler: function(e){

					var self = e.data.self;

					self.holdersCollection.each(function(i, el){

						var holder = $(el);

						if(self.w.scrollTop() + self.breakpoint >= holder.offset().top && !holder.hasClass('gt-animated')){

							self.animateAllBarsIn(holder);
							holder.addClass('gt-animated');

							if(i === self.holdersCollection.length - 1) self.destroy();

						}

					});


				},

				animateAllBarsIn: function(holder){

					var self = this,
						pbarsCollection = holder.find('.gt-pbar');

					pbarsCollection.each(function(i, el){

						var pbar = $(el),
							indicator = pbar.children('.gt-pbar-inner'),
							value = pbar.data('r-value'),
							unit = pbar.data('unit'),
							pbarWidth = pbar.outerWidth();

						indicator.stop().animate({
							width: value + '%'
						}, {
							duration: self.config.speed,
							easing: self.config.easing,
							step: function(now){
								pbar.add(indicator).attr('data-value', Math.round(now) + unit);
							},
							complete: function(){
								setTimeout(function(){
									$.gatsbyCore.templateHelpers.nowrapProgressBars.check();
								}, 0);
							}
						});

					});

				},

				destroy: function(){

					this.w.off('scroll.animatedprogressbars');

				}

			},

			animatedCounters: {

				init: function(){

					this.collection = $('.gt-counter');
					if(!this.collection.length) return;

					this.w = $(window);

					this.prepareCounters();
					this.updateDocumentState();

					this.w.on('scroll.animatedcounter', {self: this}, this.scrollHandler);
					this.w.on('resize.animatedcounter', this.updateDocumentState.bind(this));

					this.w.trigger('scroll.animatedcounter');

				},

				updateDocumentState: function(){

					this.breakpoint = this.w.height() / 1.4;

				},

				prepareCounters: function(){

					this.collection.each(function(i, el){

						var $this = $(el),
							value = $this.data('value');

						$this.data('r-value', value);
						$this.attr('data-value', 0);

					});

				},

				scrollHandler: function(e){

					var self = e.data.self;

					self.collection.each(function(i, el){

						var counter = $(el);

						if(self.w.scrollTop() + self.breakpoint > counter.offset().top && !counter.hasClass('gt-animated')){

							counter.addClass('gt-animated');
							self.animateCounter(counter);

							if(i === self.collection.length - 1) self.destroy();

						}

					});

				},

				animateCounter: function(counter){

					var value = counter.data('r-value'),
						intId, currentValue = 0;

					intId = setInterval(function(){

						counter.attr('data-value', ++currentValue);

						if(currentValue === value) clearInterval(intId);

					}, 4);

				},

				destroy: function(){

					this.w.off('scroll.animatedcounter');
					this.w.off('resize.animatedcounter');

				}

			},

			syncOwlCarousel: {

				init: function(){

					this.collection = $('.owl-carousel[data-sync]');
					if(!this.collection.length) return false;

					this.bindEvents();

				},

				bindEvents: function(){

					var self = this;

					this.collection.each(function(i, el){

						var $this = $(el),
							sync = $($this.data('sync'));

						if(!sync.length){
							console.log('Not found carousel with selector ' + $this.data('sync'));
							return;
						}

						// nav
						$this.on('click', '.owl-prev', function(e){
							sync.trigger('prev.owl.carousel');
						});
						$this.on('click', '.owl-next', function(e){
							sync.trigger('next.owl.carousel');
						});

						sync.on('click', '.owl-prev', function(e){
							$this.trigger('prev.owl.carousel');
						});
						sync.on('click', '.owl-next', function(e){
							$this.trigger('next.owl.carousel');
						});

						// // drag
						$this.on('dragged.owl.carousel', function(e){

					        if(e.relatedTarget.state.direction == 'left'){
					            sync.trigger('next.owl.carousel');
					        }
					        else{
					            sync.trigger('prev.owl.carousel');
					        }

						});

						sync.on('dragged.owl.carousel', function(e){

							if(e.relatedTarget.state.direction == 'left'){
					            $this.trigger('next.owl.carousel');
					        }
					        else{
					            $this.trigger('prev.owl.carousel');
					        }

						});

					});

				}

			},

			infoPopup: function () {

				$('.gt-info-title-button').on('click', function(e) {
					e.preventDefault();

					$(this).prev().toggleClass('active');
				});

			},

			postLike: function () {

				$('body').on('click', '.sl-button', function (e) {

					e.preventDefault();

					var button = $(this),
						post_id = button.attr('data-post-id'),
						security = button.attr('data-nonce'), allbuttons;

					allbuttons = $('.sl-button-' + post_id);

					if ( post_id !== '' ) {

						$.ajax({
							type: 'POST',
							url: gatsby_global_vars.ajaxurl,
							data: {
								action : 'gatsby_process_simple_like',
								post_id : post_id,
								nonce : security
							},
							beforeSend:function () { },
							success: function (response) {

								allbuttons.children('span').html(response.count);

								if ( response.status === 'unliked' ) {
									var like_text = gatsby_global_vars.like;
									allbuttons.prop('title', like_text);
									allbuttons.removeClass('liked');
								} else {
									var unlike_text = gatsby_global_vars.unlike;
									allbuttons.prop('title', unlike_text);
									allbuttons.addClass('liked');
								}

							}
						});

					}

				});

			},

			isotope: {

				baseInitConfig: {
					itemSelector: '.gt-col',
					transitionDuration: '0.5s'
				},

				init: function() {
					this.portfolioInit();
					this.photographyInit();
				},

				portfolioInit: function () {

					var self = this;
					var collection = $('.gt-portfolio-holder, .gt-entries-holder');
					if ( !collection.length ) return false;

					this.baseInitConfig.isOriginLeft = !$.gatsbyCore.ISRTL;

					collection.each(function(i, el) {

						var $this = $(el),
							layout = $this.data('m') ? 'masonry' : 'fitRows',
							container = $('.gt-isotope-container', $this);

						container.gatsbyImagesLoaded().then(function(){

							self.initFilter($this);
							self.initLoadMore($this);


							container.isotope($.extend({}, self.baseInitConfig, {
								layoutMode: layout,
								itemSelector: '.gt-col',
								percentPosition: layout === 'masonry',
								masonry: {
									columnWidth: '.gt-grid-sizer'
								}
							}));

							container.addClass('gt-initialized');

						});

					});

				},

				photographyInit: function () {

					Packery.prototype.initShiftLayout = function( positions, attr ) {
						if ( !positions ) {
							// if no initial positions, run packery layout
							this.layout();
							return;
						}
						// parse string to JSON
						if ( typeof positions == 'string' ) {
							try {
								positions = JSON.parse( positions );
							} catch( error ) {
								console.error( 'JSON parse error: ' + error );
								this.layout();
								return;
							}
						}

						attr = attr || 'id'; // default to id attribute
						this._resetLayout();
						// set item order and horizontal position from saved positions
						this.items = positions.map( function( itemPosition ) {
							var selector = '[' + attr + '="' + itemPosition.attr  + '"]';
							var itemElem = this.element.querySelector( selector );
							var item = this.getItem( itemElem );
							item.rect.x = itemPosition.x * this.packer.width;
							return item;
						}, this );
						this.shiftLayout();
					};

					var self = this;
					var collection = $('.gt-photography-holder');

					if ( !collection.length ) return false;

					this.baseInitConfig.isOriginLeft = !$.gatsbyCore.ISRTL;

					if ($(window).width() > 767) {

						collection.each(function(i, el) {

							var $this = $(el),
								container = $('.gt-isotope-container', $this);

							container.gatsbyImagesLoaded().then(function() {

								var $grid = container.packery({
									itemSelector: '.gt-photo-col',
									transitionDuration: '0.5s',
									gutter: 0
									//percentPosition: true
								});

								// get saved dragged positions
								var initPositions = $this.data('positions');

								if ( initPositions ) {
									// init layout with saved positions
									$grid.packery( 'initShiftLayout', initPositions, 'data-item-id' );
								}

								container.addClass('gt-initialized');

							});

						});

					}
				},

				initFilter: function(holder) {

					var filter = $('.gt-filter', holder),
						container = $('.gt-isotope-container', holder);

					if ( !filter ) return;

					filter.on('click', '[data-filter]', function(e) {

						var $this = $(this),
							category = $this.data('filter');

						$this
							.addClass('gt-active')
							.parent()
							.siblings()
							.children()
							.removeClass('gt-active');

						e.preventDefault();

						container.isotope({ filter: category });

					});

				},

				initLoadMore: function(holder) {

					var self = this,
						dataBtn = $('.gt-load-more', holder),
						container = $('.gt-isotope-container', holder);

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
						}).done(function(response) {

							self.hideLoader($this);

							if ( response.indexOf("{gatsby-isotope-loaded}") !== -1 ) {

								var response = response.split('{gatsby-isotope-loaded}'),
									items = $(response.pop()).filter('.gt-col');

								if ( items.length > 0 ) {
									self.insertNewItems(items, container);
								} else {
									self.hideLoadMoreBtnFor(holder)
								}

							} else {
								self.hideLoadMoreBtnFor(holder)
							}

						}).fail(function(response) {

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

				},

				insertNewItems: function(items, container) {

					container
						.append(items)
						.isotope('appended', items)
						.gatsbyImagesLoaded()
						.then(function(){

						items.each(function(idx, el) {
							new gatsby_tiltfx(el);
						});

						var audio = container.find('audio:not([style*="display:none"])');
						if ( audio.length ) audio.WTAudio();

						container.isotope('layout');

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

					var btn = $('.gt-load-more', holder);

					btn.slideUp(function() {

						var $this = $(this),
							parent = $this.parent('.aligncenter');

						$this.add(parent).remove();

					});

				}

			},

			/**
			 * Handling animation when page has been scrolled
			 * @return jQuery collection;
			 **/
			animatedContent : function(delay){

				var collection = $('.gt-no-touchevents [data-animation]');
				if(!collection.length) return;

				setTimeout(function(){

					collection.addClass('gt-invisible animated');

					$("[data-animation]").each(function(){

						var self = $(this),
							scrollFactor = self.data('scroll-factor') ? self.data('scroll-factor') : -240;

						if($(window).width() > 767) {

							self.appear(function() {

								var delay = (self.attr("data-animation-delay") ? self.attr("data-animation-delay") : 1);

								if(delay > 1) self.css("animation-delay", delay + "ms");
								self.removeClass('gt-invisible').addClass("gt-visible " + self.attr("data-animation"));
								self.on($.gatsbyCore.ANIMATIONEND, function(){
									self.addClass('gt-animation-end');
								});

							}, {accX: 0, accY: scrollFactor});

						}
						else {

							self.removeClass("gt-invisible").addClass("gt-visible");

						}

					});

				}, delay ? delay : 0);

				return collection;

			},

		},

		templateHelpers: {

			showAlertBox: function(data){

				var template = '<div style="display:none" class="gt-alert-box gt-type-{{type}} gt-{{status}}">\
									<div class="gt-alert-box-inner">\
										{{#if icon}}\
											<span class="gt-icon">\
												<span class="lnr lnr-{{icon}}"></span>\
											</span>\
										{{/if}}\
										{{message}}\
									</div>\
								</div>';

				var ready = $(Handlebars.compile(template)(data));

				data.relativeElement.after(ready);

				ready.slideDown({
					duration: $.gatsbyCore.TRANSITIONDURATION,
					easing: 'easeOutQuint',
					complete: function(){

						if(data.delay){

							$(this).delay(data.delay).slideUp({
								duration: $.gatsbyCore.TRANSITIONDURATION,
								easing: 'easeOutQuint',
								complete: function(){

									$(this).remove();

								}
							});

						}

					}
				});

			},

			/**
			 * Adds background image
			 * @return undefined;
			 **/
			bg: function(collection) {

				var collection = collection ? collection : $('[data-gatsby-bg]');

				collection.each(function() {
					var $this = $(this),
						bg = $this.data( 'gatsby-bg' );

					if ( bg ) $this.css( 'background-image', 'url(' + bg + ')' );
				});

			},

			/**
			 * Sets correct inner offsets in breadcrumbs (only for fixed header types)
			 * @return undefined;
			 **/
			breadCrumbsOffset: function(){

				var header = $('#header.gt-fixed, #header.gt-transparent'),
					breadcrumbs = $('.gt-breadcrumbs-wrap'),
					contentWrap = $('.gt-page-content-wrap'),
					$w = $(window);

					breadcrumbs.css({
						'border-style': 'solid',
						'border-color': 'transparent'
					});

				function correctPosition() {

					if ( $w.width() < 768 ) return false;

					var hHeight = header.outerHeight();
					breadcrumbs.css('border-top-width', hHeight);

					if ( !breadcrumbs.length ) {
						contentWrap.css('padding-top', hHeight + 80);
					}

				}

				correctPosition();
				$(window).on('resize.breadcrumbs', correctPosition);

			},

			/**
			 * Generates drop cap
			 * @return Object Core;
			 **/
			canvasDropcap: function(){

				var canvasDropcap = {

					init: function(config){

						config = config || {};

						this.collection = $('.gt-dropcap.gt-type-3');
						this.config = $.extend(this.config, config);

						this.generateCanvas();

					},

					config: {
						font: 'Raleway',
						fontSize: '60px',
						lineHeight: '32px',
						fontWeight: 800
					},

					generateCanvas: function(){

						var self = this;

						this.collection.each(function(i, el){

							var canvas = document.createElement("canvas"),
								firstLetter = $(el).text().slice(0, 1),
								imageSrc = $(el).data('dropcap-bg');

							canvas.setAttribute('width', self.config.fontSize);
							canvas.setAttribute('height', self.config.fontSize);

							$(el).text($(el).text().slice(1));

							$(el).prepend(canvas);

							self.drowLetter(firstLetter, canvas, imageSrc);

						});

					},

					drowLetter: function(letter, canvas, imageSrc){

						var self = this,
							ctx = canvas.getContext('2d'),
							font = self.config.fontWeight + " " + self.config.fontSize + " " + self.config.font,
							img = document.createElement("img");

						img.src = imageSrc;

						img.onload = function(){
							ctx.font = font;
							ctx.fillStyle = ctx.createPattern(img, 'repeat');
							ctx.fillText(letter, 10, (parseInt(self.config.fontSize) - 10));
						}

						ctx.font = font;
						ctx.fillStyle = ctx.createPattern(img, 'repeat');
						ctx.fillText(letter, 10, (parseInt(self.config.fontSize) - 10));

					}

				}

				canvasDropcap.init();

				return this;

			},

			/**
			 * Calculates display settings for percentage element (only for progress bars type-4)
			 **/
			nowrapProgressBars: {

				PERCENTAGEELEMENTWIDTH: 40,

				check: function(){

					this.collection = $('.gt-progress-bars-holder.type-3 .gt-pbar-wrap');
					if(!this.collection.length) return;

					this.checkOverlay();

					this.w = $(window);

					this.w.off('resize.nowrapprogressbars').on('resize.nowrapprogressbars', this.checkOverlay.bind(this));

				},

				checkOverlay: function(){

					var self = this;

					this.collection.each(function(i, el){

						var $this = $(el),
							titleWidth = $this.find('.gt-pbar-title').outerWidth(),
							indicatorWidth = $this.find('.gt-pbar-inner').outerWidth();

						if(indicatorWidth < titleWidth + self.PERCENTAGEELEMENTWIDTH && !$this.hasClass('gt-percentage-hidden')){
							$this.addClass('gt-percentage-hidden');
						}
						else if(indicatorWidth >= titleWidth + self.PERCENTAGEELEMENTWIDTH && $this.hasClass('gt-percentage-hidden')){
							$this.removeClass('gt-percentage-hidden');
						}

					});

				}

			},

			owlAdaptive: function(collection){

				var collection = collection ? collection : $('.owl-carousel');

				if ( !collection.length ) return;

				collection.each(function(i, el){

					var $this = $(el);

					$this.on('changed.owl.carousel', function(e) {
						//$.gatsbyCore.templateHelpers.owlSameHeight($this, true);
						$.gatsbyCore.templateHelpers.owlNav($this);
					});

					$this.on('resized.owl.carousel', function(e) {
						//$.gatsbyCore.templateHelpers.owlSameHeight($this, true);
					});

					$this.on('initialized.owl.carousel', function(e) {

						setTimeout(function() {
							if( $this.data('owlCarousel').settings.dots ) {
								$this.addClass('owl-dots');
							}
						}, 100 );

						//$.gatsbyCore.templateHelpers.owlSameHeight($this);
						$.gatsbyCore.templateHelpers.owlNav($this);

					});

				});

			},

			owlSameHeight: function(owl, animateContainer) {

				var max = 0;

				setTimeout(function(){

					var activeItems = owl.find('.owl-item.active').children();

					owl.find('.owl-item').children().css('height', 'auto');

					activeItems.each(function(i, el) {

						var $this = $(el),
							height = $this.outerHeight();

						if ( height > max ) max = height;

					});

					if ( animateContainer ) {
						owl.find('.owl-stage-outer').stop().animate({
							height: max
						}, {
							duration: 150,
							complete: function() {

								setTimeout(function() {

									var isotopeParent = owl.closest('.gt-isotope-container.gt-initialized');
									if ( isotopeParent.length ) isotopeParent.isotope('layout');

								}, 700);

							}
						});
					}

					activeItems.css('height', max);

				}, 20);

			},

			owlNav: function(owl){

				setTimeout(function(){

					var settings = owl.data('owlCarousel').settings;
					if (settings.autoplay) return;

					var prev = owl.find('.owl-prev'),
						next = owl.find('.owl-next');

					if (owl.find('.owl-item').first().hasClass('active')) prev.addClass('gt-disabled');
					else prev.removeClass('gt-disabled');

					if (owl.find('.owl-item').last().hasClass('active')) next.addClass('gt-disabled');
					else next.removeClass('gt-disabled');

				}, 100);

			},

			fullScreenLayout: {

				init: function(){

					var self = this;

					this.layout = $('.error404 .gt-fullscreen-layout-type');
					if(!this.layout.length) return;

					this.header = $('#header');
					this.footer = $('#footer');
					this.pW = $('.gt-page-content-wrap');
					this.w = $(window);
					this.body = $('body');

					this.layout.gatsbyImagesLoaded().then(function(){
						self.updateDocumentState();
					});

					this.w.on('resize.fullscreenlayout', this.updateDocumentState.bind(this));

				},

				updateDocumentState: function(){

					var self = this;

					if(self.timeout) clearTimeout(self.timeout);

					self.timeout = setTimeout(function(){

						self.body.add(self.pW).css({
							'padding-top': 0,
							'padding-bottom': 0
						});

						self.hH = self.header.outerHeight();
						self.fH = self.footer.outerHeight();

						self.body.css({
							'padding-top': (self.hH !== null) ? self.hH : (self.fH !== null ? self.fH : 0),
							'padding-bottom': (self.fH !== null) ? self.fH : (self.hH !== null ? self.hH : 0)
						});

						self.pWH = self.pW.outerHeight();
						self.wH = self.w.height();

						self.run();

					}, 130);

				},

				run: function(){

					var self = this,
						fullPageHeight = self.pWH + self.hH + self.fH,
						paddingTop = 0,
						paddingBottom = 0;

					// if without header
					if(!self.hH && self.fH !== null){
						paddingTop = paddingBottom = (self.wH - self.pWH - (self.fH * 2)) / 2
					}
					// if without footer
					else if(!self.fH && self.hH !== null){
						paddingTop = paddingBottom = (self.wH - self.pWH - (self.hH * 2)) / 2
					}
					else{
						paddingTop = paddingBottom = (self.wH - fullPageHeight) / 2
					}

					if(fullPageHeight < this.wH){

						this.pW.css({
							'padding-top': paddingTop,
							'padding-bottom': paddingBottom
						});

					}

				}

			},

			fullScreenMediaHolder: {

				init: function(){

					var self = this;

					this.collection = $('.gt-media-holder.gt-fullscreen');
					if(!this.collection.length) return;

					this.defPaddingTop = parseInt(this.collection.css('padding-top'));
					this.defPaddingBottom = parseInt(this.collection.css('padding-bottom'));

					this.w = $(window);

					this.run();

					this.w.on('resize.mediaholder', this.run.bind(this));

					return this.collection;

				},

				reset: function(){

					if(!this.collection) return;

					this.run();

				},

				updateDocumentState: function(){

					var self = this;

					this.collection.css({
						'padding-top': self.defPaddingTop,
						'padding-bottom': self.defPaddingBottom
					})

					this.wH = this.w.height();
					this.cH = this.collection.outerHeight();

				},

				run: function(){

					var self = this;

					this.updateDocumentState();

					if(this.timeoutId) clearTimeout(this.timeoutId);

					this.timeoutId = setTimeout(function(){

						if(self.cH < self.wH){

							var diff = (self.wH - self.cH) / 2;

							self.collection.css({
								'padding-top': diff + self.defPaddingTop,
								'padding-bottom': diff + self.defPaddingBottom
							});

						}

					}, 100);

				}

			}

		},

		baseOwlConfig: {
			loop: true,
			smartSpeed: 500,
			autoHeight: true,
			autoplay: true,
			autoplayTimeout: 4000,
			autoplayHoverPause: true,
			navText: ['', '']
		},

		tiltfx_init: function() {

			var idx = 0;

			[].slice.call(document.querySelectorAll('.gt-portfolio-holder.gt-type-2 .gt-project')).forEach(function(el, pos) {
				idx = pos%2 === 0 ? idx+1 : idx;
				new gatsby_tiltfx(el);
			});
		}

	}

	$.gatsbyCore.jQueryExtend();

	$(function() {
		$.gatsbyCore.DOMLoaded();
	});

	$(window).load(function() {
		$.gatsbyCore.outerResourcesLoaded();
		$.gatsbyCore.tiltfx_init();
	});


})(jQuery);