
(function ($) {

	$.gatsby_demo = function () {
		return {
			init: function () {
				var base = this;

				base.demosContainer = $('.mad-install-demos');
				base.demosOptionsContainer = $('#mad-install-options', base.demosContainer);
				base.demoType = $('#gatsby-install-demo-type', base.demosContainer);
				base.buttonInstallDemo = $('.button-install-demo', base.demosContainer);
				base.events();
			},
			events: function () {

				var base = this;

				base.demosContainer.on( 'click', '.button-install-demo', function( e ) {
					e.preventDefault();

					var $this = $(this),
						selected = $this.data('demo-id'),
						disabled = $this.attr('disabled');

					if ( disabled ) { return; }

					base.add_alert_leave_page();

					base.demoType.val(selected);
					$('.theme-name', base.demosOptionsContainer).html($this.closest('.theme-wrapper').find('.theme-name').html());
					base.demosOptionsContainer.slideDown();

					$('html, body').stop().animate({
						scrollTop: base.demosOptionsContainer.offset().top - 60
					}, 600);

				});

				$('#gatsby-import-no').on( 'click', function( e ) {
					e.preventDefault();
					base.demosOptionsContainer.slideUp();
					base.remove_alert_leave_page.call(base);
				});

				// import
				$('#gatsby-import-yes').on( 'click', function( e ) {
					e.preventDefault();

					var button = $(this),
						demo = base.demoType.val(),
						path = button.data('path'),
						options = {
							parent: $('#gatsby-demo-' + demo),
							demo: demo,
							path: path,
							reset_menus: $('#gatsby-reset-menus').is(':checked'),
							import_dummy: $('#gatsby-import-dummy').is(':checked'),
							import_widgets: $('#gatsby-import-widgets').is(':checked'),
							import_options: $('#gatsby-import-options').is(':checked')
						};

					base.demosOptionsContainer.slideUp();

					if ( options.demo ) {
						base.import_process.call( base, options );
					}

				});

			},
			add_alert_leave_page : function() {
				this.buttonInstallDemo.attr('disabled', 'disabled');
			},
			remove_alert_leave_page : function() {
				var base = this;
				base.buttonInstallDemo.removeAttr('disabled');
			},
			//demo_install : function(options) {
			//	if ( options.reset_menus ) {
			//		this.import_process.call( this, options, 'gatsby_reset_menus' );
			//	}
			//	if ( options.import_dummy ) {
			//		this.import_process.call( this, options, 'gatsby_import_dummy' );
			//	}
			//	if ( options.import_widgets ) {
			//		this.import_process.call( this, options, 'gatsby_import_widgets' );
			//	}
			//	if ( options.import_options ) {
			//		this.import_process.call( this, options, 'gatsby_import_options' );
			//	}
			//},
			import_process: function ( options ) {
				var base = this,
					data = {
						'action': 'gatsby_import_dummy',
						'demo': options.demo,
						'path': options.path,
						'reset_menus': options.reset_menus,
						'import_dummy': options.import_dummy,
						'import_widgets': options.import_widgets,
						'import_options': options.import_options
					};

				$.ajax({
					type: "POST",
					url: ajaxurl,
					data: data,
					beforeSend: function () {
						options.parent.addClass('demo-install-process');
					},
					error: function () {
						base.import_finished.call(base, options);
					},
					success: function (response) {
						base.import_finished.call(base, options);
					},
					complete: function (response) {
						base.import_finished.call(base, options);
					}
				});

			},
			import_finished: function (options) {
				var base = this;
				setTimeout(function() {
					setTimeout( base.remove_alert_leave_page(), 1300 );
					options.parent.removeClass('demo-install-process');
				}, 1200 );
			}

		}.init();

	}

	var file_frame;
	var clickedID;

	$(document).on( 'click', '.button_upload_image', function( e ) {

		e.preventDefault();

		// If the media frame already exists, reopen it.
		if ( !file_frame ) {
			// Create the media frame.
			file_frame = wp.media.frames.downloadable_file = wp.media({
				title: 'Choose an image',
				button: {
					text: 'Use image'
				},
				multiple: false
			});
		}

		file_frame.open();

		clickedID = $(this).attr('id');

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			attachment = file_frame.state().get('selection').first().toJSON();

			$('#' + clickedID).val( attachment.url );
			if ($('#' + clickedID).attr('data-name'))
				$('#' + clickedID).attr('name', $('#' + clickedID).attr('data-name'));

			file_frame.close();
		});
	}).on( 'click', '.button_remove_image', function( e ){

		var clickedID = jQuery(this).attr('id');
		$('#' + clickedID).val( '' );

		return false;
	});


	$(function() {
		// new $.gatsby_demo();
	});

})(jQuery);
