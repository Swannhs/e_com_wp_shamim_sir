/* money.js 0.1.3, MIT license, josscrowcroft.github.com/money.js */
(function(g,j){var b=function(a){return new i(a)};b.version="0.1.3";var c=g.fxSetup||{rates:{},base:""};b.rates=c.rates;b.base=c.base;b.settings={from:c.from||b.base,to:c.to||b.base};var h=b.convert=function(a,e){if("object"===typeof a&&a.length){for(var d=0;d<a.length;d++)a[d]=h(a[d],e);return a}e=e||{};if(!e.from)e.from=b.settings.from;if(!e.to)e.to=b.settings.to;var d=e.to,c=e.from,f=b.rates;f[b.base]=1;if(!f[d]||!f[c])throw"fx error";d=c===b.base?f[d]:d===b.base?1/f[c]:f[d]*(1/f[c]);return a*d},i=function(a){"string"===typeof a?(this._v=parseFloat(a.replace(/[^0-9-.]/g,"")),this._fx=a.replace(/([^A-Za-z])/g,"")):this._v=a},c=b.prototype=i.prototype;c.convert=function(){var a=Array.prototype.slice.call(arguments);a.unshift(this._v);return h.apply(b,a)};c.from=function(a){a=b(h(this._v,{from:a,to:b.base}));a._fx=b.base;return a};c.to=function(a){return h(this._v,{from:this._fx?this._fx:b.settings.from,to:a})};if("undefined"!==typeof exports){if("undefined"!==typeof module&&module.exports)exports=module.exports=b;exports.fx=fx}else"function"===typeof define&&define.amd?define([],function(){return b}):(b.noConflict=function(a){return function(){g.fx=a;b.noConflict=j;return b}}(g.fx),g.fx=b)})(this);

/*!
 * accounting.js v0.3.2, copyright 2011 Joss Crowcroft, MIT license, http://josscrowcroft.github.com/accounting.js
 */
(function(p,z){function q(a){return!!(""===a||a&&a.charCodeAt&&a.substr)}function m(a){return u?u(a):"[object Array]"===v.call(a)}function r(a){return"[object Object]"===v.call(a)}function s(a,b){var d,a=a||{},b=b||{};for(d in b)b.hasOwnProperty(d)&&null==a[d]&&(a[d]=b[d]);return a}function j(a,b,d){var c=[],e,h;if(!a)return c;if(w&&a.map===w)return a.map(b,d);for(e=0,h=a.length;e<h;e++)c[e]=b.call(d,a[e],e,a);return c}function n(a,b){a=Math.round(Math.abs(a));return isNaN(a)?b:a}function x(a){var b=c.settings.currency.format;"function"===typeof a&&(a=a());return q(a)&&a.match("%v")?{pos:a,neg:a.replace("-","").replace("%v","-%v"),zero:a}:!a||!a.pos||!a.pos.match("%v")?!q(b)?b:c.settings.currency.format={pos:b,neg:b.replace("%v","-%v"),zero:b}:a}var c={version:"0.3.2",settings:{currency:{symbol:"$",format:"%s%v",decimal:".",thousand:",",precision:2,grouping:3},number:{precision:0,grouping:3,thousand:",",decimal:"."}}},w=Array.prototype.map,u=Array.isArray,v=Object.prototype.toString,o=c.unformat=c.parse=function(a,b){if(m(a))return j(a,function(a){return o(a,b)});a=a||0;if("number"===typeof a)return a;var b=b||".",c=RegExp("[^0-9-"+b+"]",["g"]),c=parseFloat((""+a).replace(/\((.*)\)/,"-$1").replace(c,"").replace(b,"."));return!isNaN(c)?c:0},y=c.toFixed=function(a,b){var b=n(b,c.settings.number.precision),d=Math.pow(10,b);return(Math.round(c.unformat(a)*d)/d).toFixed(b)},t=c.formatNumber=function(a,b,d,i){if(m(a))return j(a,function(a){return t(a,b,d,i)});var a=o(a),e=s(r(b)?b:{precision:b,thousand:d,decimal:i},c.settings.number),h=n(e.precision),f=0>a?"-":"",g=parseInt(y(Math.abs(a||0),h),10)+"",l=3<g.length?g.length%3:0;return f+(l?g.substr(0,l)+e.thousand:"")+g.substr(l).replace(/(\d{3})(?=\d)/g,"$1"+e.thousand)+(h?e.decimal+y(Math.abs(a),h).split(".")[1]:"")},A=c.formatMoney=function(a,b,d,i,e,h){if(m(a))return j(a,function(a){return A(a,b,d,i,e,h)});var a=o(a),f=s(r(b)?b:{symbol:b,precision:d,thousand:i,decimal:e,format:h},c.settings.currency),g=x(f.format);return(0<a?g.pos:0>a?g.neg:g.zero).replace("%s",f.symbol).replace("%v",t(Math.abs(a),n(f.precision),f.thousand,f.decimal))};c.formatColumn=function(a,b,d,i,e,h){if(!a)return[];var f=s(r(b)?b:{symbol:b,precision:d,thousand:i,decimal:e,format:h},c.settings.currency),g=x(f.format),l=g.pos.indexOf("%s")<g.pos.indexOf("%v")?!0:!1,k=0,a=j(a,function(a){if(m(a))return c.formatColumn(a,f);a=o(a);a=(0<a?g.pos:0>a?g.neg:g.zero).replace("%s",f.symbol).replace("%v",t(Math.abs(a),n(f.precision),f.thousand,f.decimal));if(a.length>k)k=a.length;return a});return j(a,function(a){return q(a)&&a.length<k?l?a.replace(f.symbol,f.symbol+Array(k-a.length+1).join(" ")):Array(k-a.length+1).join(" ")+a:a})};if("undefined"!==typeof exports){if("undefined"!==typeof module&&module.exports)exports=module.exports=c;exports.accounting=c}else"function"===typeof define&&define.amd?define([],function(){return c}):(c.noConflict=function(a){return function(){p.accounting=a;c.noConflict=z;return c}}(p.accounting),p.accounting=c)})(this);

(function ($) {

	$.gatsby_woocommerce_mod = $.gatsby_woocommerce_mod || {};

	$.gatsby_woocommerce_mod.currencySwitcher = function () {
		var money             = fx.noConflict();
		var current_currency  = wc_currency_converter_params.current_currency;
		var currency_codes    = $.parseJSON( wc_currency_converter_params.currencies );
		var currency_position = wc_currency_converter_params.currency_pos;
		var currency_decimals = wc_currency_converter_params.num_decimals;
		var remove_zeros      = wc_currency_converter_params.trim_zeros;

		money.rates           = wc_currency_converter_params.rates;
		money.base            = wc_currency_converter_params.base;
		money.settings.from   = wc_currency_converter_params.currency;

		if ( money.settings.from == 'RMB' ) {
			money.settings.from = 'CNY';
		}

		({
			init: function() {
				var base = this;

				if ( current_currency ) {
					base.currencySwitch( current_currency );
					$('ul.currency-switcher li a[data-currency-code="' + current_currency + '"]').addClass('active');
				} else {
					$('ul.currency-switcher li a.default').addClass('active');
				}
				base.listeners();
			},
			listeners: function () {
				var base = this;

				$('ul.currency-switcher').on('click', 'a', function () {
					var $this = $(this),
						toCurrency = $this.data('currency-code');
					base.currencySwitch(toCurrency);
					$.cookie('woocommerce_current_currency', toCurrency, { expires: 10, path: '/' });
					current_currency = toCurrency;
					location.reload();
					return false;
				});

				base.price_filter_update( current_currency );

				$('body').on( "price_slider_create price_slider_slide price_slider_change", function () {
					base.price_filter_update( current_currency );
				}).on('wc_fragments_refreshed wc_fragments_loaded show_variation updated_checkout updated_shipping_method added_to_cart cart_page_refreshed cart_widget_refreshed updated_addons', function() {
					if ( current_currency ) {
						base.currencySwitch( current_currency );
					}
				});

			},
			currencySwitch: function (to_currency) {

				var base = this;

				// Span.amount
				$('span.amount').each(function(){

					// Original markup
					var original_code = $(this).attr("data-original");

					if (typeof original_code == 'undefined' || original_code == false) {
						$(this).attr("data-original", $(this).html());
					}

					// Original price
					var original_price = $(this).attr("data-price");

					if (typeof original_price == 'undefined' || original_price == false) {

						// Get original price
						var original_price = $(this).html();

						// Small hack to prevent errors with $ symbols
						$( '<del></del>' + original_price ).find('del').remove();

						// Remove formatting
						original_price = original_price.replace( wc_currency_converter_params.thousand_sep, '' );
						original_price = original_price.replace( wc_currency_converter_params.decimal_sep, '.' );
						original_price = original_price.replace(/[^0-9\.]/g, '');
						original_price = parseFloat( original_price );

						// Store original price
						$(this).attr("data-price", original_price);
					}

					price = money( original_price ).to( to_currency );
					price = price.toFixed( currency_decimals );
					price = accounting.formatNumber( price, currency_decimals, wc_currency_converter_params.thousand_sep, wc_currency_converter_params.decimal_sep );

					if ( remove_zeros ) {
						price = price.replace( wc_currency_converter_params.zero_replace, '' );
					}

					if ( currency_codes[ to_currency ] ) {
						if ( currency_position == 'left' ) {
							$(this).html( currency_codes[ to_currency ] + price );
						} else if ( currency_position == 'right' ) {
							$(this).html( price + " " + currency_codes[ to_currency ] );
						} else if ( currency_position == 'left_space' ) {
							$(this).html( currency_codes[ to_currency ] + " " + price );
						} else if ( currency_position == 'right_space' ) {
							$(this).html( price + " " + currency_codes[ to_currency ] );
						}
					} else {
						$(this).html( price + " " + to_currency );
					}

					$(this).attr( 'title', wc_currency_converter_params.i18n_oprice + original_price );
				});

				// #shipping_method prices
				$('#shipping_method option').each(function() {

					// Original markup
					var original_code = $(this).attr("data-original");

					if (typeof original_code == 'undefined' || original_code == false) {
						original_code = $(this).text();
						$(this).attr("data-original", original_code);
					}

					var current_option = original_code;
					current_option = current_option.split(":");
					if (!current_option[1] || current_option[1] == '') return;
					price = current_option[1];

					if (!price) return;

					// Remove formatting
					price = price.replace( wc_currency_converter_params.thousand_sep, '' );
					price = price.replace( wc_currency_converter_params.decimal_sep, '.' );
					price = price.replace(/[^0-9\.]/g, '');
					price = parseFloat( price );

					price = money(price).to(to_currency);
					price = price.toFixed( currency_decimals );
					price = accounting.formatNumber( price, currency_decimals, wc_currency_converter_params.thousand_sep, wc_currency_converter_params.decimal_sep );

					if ( remove_zeros ) {
						price = price.replace( wc_currency_converter_params.zero_replace, '' );
					}

					$(this).html( current_option[0] + ": " + price  + " " + to_currency );

				});

				base.price_filter_update( to_currency );

				$('body').trigger( 'currency_converter_switch', [to_currency] );

			},
			price_filter_update: function ( to_currency ) {
				if ( to_currency ) {
					$('.ui-slider').each(function() {
						theslider = $( this );
						values    = theslider.slider("values");

						original_price = "" + values[1];
						original_price = original_price.replace( wc_currency_converter_params.thousand_sep, '' );
						original_price = original_price.replace( wc_currency_converter_params.decimal_sep, '.' );
						original_price = original_price.replace(/[^0-9\.]/g, '');
						original_price = parseFloat( original_price );

						price_max = money(original_price).to(to_currency);

						original_price = "" + values[0];
						original_price = original_price.replace( wc_currency_converter_params.thousand_sep, '' );
						original_price = original_price.replace( wc_currency_converter_params.decimal_sep, '.' );
						original_price = original_price.replace(/[^0-9\.]/g, '');
						original_price = parseFloat( original_price );

						price_min = money(original_price).to(to_currency);

						$('.price_slider_amount').find('span.from').html( price_min.toFixed(2) + " " + to_currency );
						$('.price_slider_amount').find('span.to').html( price_max.toFixed(2) + " " + to_currency );
					});
				}
			}

		}).init();

	}

	$(function () {

		$.gatsby_woocommerce_mod.currencySwitcher();

	});

})(jQuery);