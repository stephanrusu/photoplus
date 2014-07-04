/**
 * bootstrap-notify.js v1.0
 * --
  * Copyright 2012 Goodybag, Inc.
 * --
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

(function ($) {
  var Notification = function (element, options) {
    // Element collection
    this.$element = $(element);
    this.$note    = $('<div class="alert"></div>');
    this.options  = $.extend(true, {}, $.fn.notify.defaults, options);

    // Setup from options
    if(this.options.transition)
      if(this.options.transition == 'fade')
        this.$note.addClass('in').addClass(this.options.transition);
      else this.$note.addClass(this.options.transition);
    else this.$note.addClass('fade').addClass('in');

    if(this.options.type)
      this.$note.addClass('alert-' + this.options.type);
    else this.$note.addClass('alert-success');

    if(!this.options.message && this.$element.data("message") !== '') // dom text
      this.$note.html(this.$element.data("message"));
    else
      if(typeof this.options.message === 'object')
        if(this.options.message.html)
          this.$note.html(this.options.message.html);
        else if(this.options.message.text)
          this.$note.text(this.options.message.text);
      else
        this.$note.html(this.options.message);

    if(this.options.closable)
      var link = $('<a class="close pull-right" href="#">&times;</a>');
      $(link).on('click', $.proxy(onClose, this));
      this.$note.prepend(link);

    return this;
  };

  var onClose = function() {
    this.options.onClose();
    $(this.$note).remove();
    this.options.onClosed();
    return false;
  };

  Notification.prototype.show = function () {
    if(this.options.fadeOut.enabled)
      this.$note.delay(this.options.fadeOut.delay || 3000).fadeOut('slow', $.proxy(onClose, this));

    this.$element.append(this.$note);
    this.$note.alert();
  };

  Notification.prototype.hide = function () {
    if(this.options.fadeOut.enabled)
      this.$note.delay(this.options.fadeOut.delay || 3000).fadeOut('slow', $.proxy(onClose, this));
    else onClose.call(this);
  };

  $.fn.notify = function (options) {
    return new Notification(this, options);
  };

  $.fn.notify.defaults = {
    type: 'success',
    closable: true,
    transition: 'fade',
    fadeOut: {
      enabled: true,
      delay: 3000
    },
    message: null,
    onClose: function () {},
    onClosed: function () {}
  }
})(window.jQuery);
/* ========================================================================
 * Bootstrap: bootstrap-iconpicker.js v1.0.0 by @recktoner
 * https://victor-valencia.github.com/bootstrap-iconpicker
 * ========================================================================
 * Copyright 2013 Victor Valencia Rico.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ======================================================================== */


+function ($) { "use strict";


    // ICONPICKER PUBLIC CLASS DEFINITION
    // ==============================
    var Iconpicker = function (element, options) {
      this.$element = $(element);
      this.options  = $.extend({}, Iconpicker.DEFAULTS, this.$element.data());      
      this.options  = $.extend({}, this.options, options);      
    };

    Iconpicker.ICONSET = {        
        fa : [
            'adjust','adn','ambulance','anchor','android','apple','archive', 'arrow-circle-o-down','arrow-circle-o-left','arrow-circle-o-right','arrow-circle-o-up','arrow-down','arrow-left','arrow-right','arrow-up','arrows','arrows-alt','arrows-h','arrows-v','asterisk',
            'ban','bar-chart-o','bars','beer','behance','behance-square','bell','bell-o','bitbucket','bitbucket-square','bolt','bomb','book','bookmark','bookmark-o','briefcase','bug','building','building-o','bullhorn','bullseye',
            'calendar','calendar-o','camera','camera-retro','car','certificate','chain-broken','check','check-circle','check-circle-o','check-square','check-square-o','chevron-down','chevron-left','chevron-right','chevron-up','child','circle','circle-o','circle-o-notch','circle-thin','clipboard','clock-o','cloud','cloud-download','cloud-upload','code','code-fork','codepen','coffee','cog','cogs','columns','comment','comment-o','comments','comments-o','compass','compress','credit-card','crop','crosshairs','css3','cube','cubes','cutlery',
            'database','delicious','desktop','deviantart','digg','dot-circle-o','download','dribbble','dropbox','drupal',
            'eject','ellipsis-h','ellipsis-v','empire','envelope','envelope-o','envelope-square','eraser','eur','exchange','exclamation','exclamation-circle','exclamation-triangle','expand','external-link','external-link-square','eye','eye-slash',
            'facebook','facebook-square','fast-backward','fast-forward','fax','female','fighter-jet','file','file-archive-o','file-audio-o','file-code-o','file-excel-o','file-image-o','file-o','file-pdf-o','file-powerpoint-o','file-text','file-text-o','file-video-o','file-word-o','files-o','film','filter','fire','fire-extinguisher','flag','flag-checkered','flag-o','flask','flickr','floppy-o','folder','folder-o','folder-open','folder-open-o','font','foursquare','frown-o',
            'gamepad','gavel','gbp','gift','git','git-square','github','github-alt','github-square','gittip','glass','globe','google','google-plus','google-plus-square','graduation-cap',
            'h-square','hacker-news','hand-o-down','hand-o-left','hand-o-right','hand-o-up','hdd-o','header','headphones','heart','heart-o','history','home','hospital-o','html5',
            'inbox','indent','info','info-circle','inr','instagram','italic',
            'joomla','jpy','jsfiddle',
            'key','keyboard-o','krw',
            'language','laptop','leaf','lemon-o','level-down','level-up','life-ring','lightbulb-o','link','linkedin','linkedin-square','linux','list','list-alt','list-ol','list-ul','location-arrow','lock','long-arrow-down','long-arrow-left','long-arrow-right','long-arrow-up',
            'magic','magnet','male','map-marker','maxcdn','medkit','meh-o','microphone','microphone-slash','minus','minus-circle','minus-square','minus-square-o','mobile','money','moon-o','music',
            'openid','outdent',
            'pagelines','paper-plane','paper-plane-o','paperclip','paragraph','pause','paw','pencil','pencil-square','pencil-square-o','phone','phone-square','picture-o','pied-piper','pied-piper-alt','pinterest','pinterest-square','plane','play','play-circle','play-circle-o','plus','plus-circle','plus-square','plus-square-o','power-off','print','puzzle-piece',
            'qq','qrcode','question','question-circle','quote-left','quote-right',
            'random','rebel','recycle','reddit','reddit-square','refresh','renren','repeat','reply','reply-all','retweet','road','rocket','rss','rss-square','rub',
            'scissors','search','search-minus','search-plus','share','share-alt','share-alt-square','share-square','share-square-o','shield','shopping-cart','sign-in','sign-out','signal','sitemap','skype','slack','sliders','smile-o','sort','sort-alpha-asc','sort-alpha-desc','sort-amount-asc','sort-amount-desc','sort-numeric-asc','sort-numeric-desc','soundcloud','space-shuttle','spinner','spoon','spotify','square','square-o','stack-exchange','stack-overflow','star','star-half','star-half-o','star-o','steam','steam-square','step-backward','step-forward','stethoscope','stop','strikethrough','stumbleupon','stumbleupon-circle','subscript','suitcase','sun-o','superscript',
            'table','tablet','tachometer','tag','tags','tasks','taxi','tencent-weibo','terminal','text-height','text-width','th','th-large','th-list','thumb-tack','thumbs-down','thumbs-o-down','thumbs-o-up','thumbs-up','ticket','times','times-circle','times-circle-o','tint','trash-o','tree','trello','trophy','truck','try','tumblr','tumblr-square','twitter','twitter-square',
            'umbrella','underline','undo','university','unlock','unlock-alt','upload','usd','user','user-md','users',
            'video-camera','vimeo-square','vine','vk','volume-down','volume-off','volume-up',
            'weibo','weixin','wheelchair','windows','wordpress','wrench',
            'xing','xing-square',
            'yahoo','youtube','youtube-play','youtube-square'
        ]
    };  

    Iconpicker.DEFAULTS = {
        iconset: 'fa',
        icon: '',
		iconname: '',
        rows: 4,
        cols: 4,
        placement: 'right',
    };   
    
    Iconpicker.prototype.createButtonBar = function(){    
        var op = this.options;
        var tr = $('<tr></tr>');
        for(var i = 0; i < op.cols; i++){
            var btn = $('<button class="btn btn-primary"><span class="fa"></span></button>');        
            var td = $('<td class="text-center"></td>');
            if(i == 0 || i == op.cols - 1){            
                btn.val((i==0) ? -1: 1);
                btn.addClass((i==0) ? 'btn-previous': 'btn-next');
                btn.find('span').addClass( (i == 0) ? 'fa-arrow-left': 'fa-arrow-right');            
                td.append(btn);
                tr.append(td);
            }
            else if(tr.find('.page-count').length == 0){
                td.attr('colspan', op.cols - 2).append('<span class="page-count"></span>');
                tr.append(td);            
            }            
        }
        op.table.find('thead').append(tr); 
    };
  
    Iconpicker.prototype.updateButtonBar = function(page){
        var op = this.options;
        var total_pages = Math.ceil( op.icons.length / (op.cols * op.rows) );
        op.table.find('.page-count').html(page + ' / ' + total_pages);
        var btn_prev = op.table.find('.btn-previous');
        var btn_next = op.table.find('.btn-next');
        (page == 1) ? btn_prev.addClass('disabled'): btn_prev.removeClass('disabled');
        (page == total_pages) ? btn_next.addClass('disabled'): btn_next.removeClass('disabled');
    };
  
    Iconpicker.prototype.bindEvents = function(){
        var op = this.options;
        var el = this;
        op.table.find('.btn-previous, .btn-next').off('click').on('click', function(){        
            var inc = parseInt($(this).val());
            el.changeList(op.page + inc);
        });
        op.table.find('.btn-icon').off('click').on('click', function(){          
            el.select($(this).val());
            el.$element.popover('destroy');
        });  
    };
  
    Iconpicker.prototype.select = function(icon){    
        var op = this.options;
        var el = this.$element;
        op.selected = $.inArray(icon.replace(op.iconClassFix, ''), op.icons);
        if(op.selected == -1){
            op.selected = 0;
            icon = op.iconClassFix + op.icons[op.selected];
        }
        if(icon != '' && op.selected >= 0){
            op.icon = icon;			
            el.find('input').val(icon);
            el.find('i').attr('class', '').addClass(op.iconClass).addClass(icon);
            el.trigger({ type: "change", icon: icon });
            op.table.find('button.btn-warning').removeClass('btn-warning');
        }    
    };
  
    Iconpicker.prototype.switchPage = function(icon){
        var op = this.options;        
        op.selected = $.inArray(icon.replace(op.iconClassFix, ''), op.icons);
        if(icon != '' && op.selected >= 0){
            var page = Math.ceil( (op.selected + 1) / (op.cols * op.rows) );
            this.changeList(page);
        }    
        op.table.find('.'+icon).parent().addClass('btn-warning');
    };
          
    Iconpicker.prototype.changeList = function(page){
        var op = this.options;
        this.updateButtonBar(page);
        var tbody = op.table.find('tbody').empty();
        var offset = (page - 1) * op.rows * op.cols;
        for(var i = 0; i < op.rows; i++){
            var tr = $('<tr></tr>');            
            for(var j = 0; j < op.cols; j++){
                var pos = offset + (i * op.cols) + j;
                var btn = $('<button class="btn btn-default btn-icon"></button>').hide();
                if(pos < op.icons.length){
                    var v = op.iconClassFix + op.icons[pos];
                    btn = $('<button class="btn btn-default btn-icon" value="' + v + '" title="' + v + '"><i class="' + op.iconClass + ' ' + v + '"></i></button>');                            
                }                
                var td = $('<td></td>').append(btn);
                tr.append(td);
            }
            tbody.append(tr);
        }
        op.page = page;
        this.bindEvents();
    }  
  
    Iconpicker.prototype.setIcon = function (icon) {        
        this.select(icon);
    }
  
    // ICONPICKER PLUGIN DEFINITION
    // ========================
    var old = $.fn.iconpicker;
    $.fn.iconpicker = function (option, params) {
        return this.each(function () {
            var $this   = $(this);
            var data    = $this.data('bs.iconpicker');
            var options = typeof option == 'object' && option;
            if (!data) $this.data('bs.iconpicker', (data = new Iconpicker(this, options)));
            if (typeof option == 'string') data[option](params)
            else{
                var op = data.options;
                var ic = (op.iconset == 'fontawesome') ? 'fa' : 'am';
                op = $.extend(op, {
                    icons: Iconpicker.ICONSET[ic],
                    iconClass: ic,
                    iconClassFix: ic + '-',
                    page: 1,
                    selected: -1,
                    table: $('<table class="table-icons"><thead></thead><tbody></tbody></table>')
                });
                var name = ( typeof $this.attr('name') != 'undefined' ) ? 'name="' + $this.attr('name') + '"' : '';
                if (ic === "fa") {
                    $this.empty()
                        .append('<i></i>')
                        .append('<input id="iconType" type="hidden" ' + name + '></input>');
                        //.append('<span class="caret"></span>');
                    }
                else { $this.empty()
                        .append('<i></i>')
                        .append('<input id="markerType" type="hidden" ' + name + '></input>');
                        //.append('<span class="caret"></span>');
                    }
                $this.addClass('iconpicker');
                data.createButtonBar();
                data.changeList(1);
                $this.on('click', function(e){
                    e.preventDefault();
                    $this.popover({
                        animation: false,
                        trigger: 'manual',
                        html: true,
                        content: data.options.table,
                        container: 'body',
                        placement: data.options.placement
                    }).on('shown.bs.popover', function () {
                        data.switchPage(op.icon);
                        data.bindEvents();
                    });  
                    $this.popover('show');
                });
                data.select(op.icon);      
            }
        });
    };

    $.fn.iconpicker.Constructor = Iconpicker;


    // ICONPICKER NO CONFLICT
    // ==================
    $.fn.iconpicker.noConflict = function () {
        $.fn.iconpicker = old;
        return this;
    };


    // ICONPICKER DATA-API
    // ===============
    $('body').on('click', function (e) {
        $('.iconpicker').each(function () {
            //the 'is' for buttons that trigger popups
            //the 'has' for icons within a button that triggers a popup
            if ( ! $(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                $(this).popover('destroy');
            }
        });
    });
  
    $('button[role="iconpicker"]').iconpicker();
    
  
}(window.jQuery);

/* =========================================================
 * bootstrap-slider.js v3.0.0
 * =========================================================
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================= */

(function( $ ) {

	var ErrorMsgs = {
		formatInvalidInputErrorMsg : function(input) {
			return "Invalid input value '" + input + "' passed in";
		},
		callingContextNotSliderInstance : "Calling context element does not have instance of Slider bound to it. Check your code to make sure the JQuery object returned from the call to the slider() initializer is calling the method"
	};

	var Slider = function(element, options) {
		var el = this.element = $(element).hide();
		var origWidth =  $(element)[0].style.width;

		var updateSlider = false;
		var parent = this.element.parent();


		if (parent.hasClass('slider') === true) {
			updateSlider = true;
			this.picker = parent;
		} else {
			this.picker = $('<div class="slider">'+
								'<div class="slider-track">'+
									'<div class="slider-selection"></div>'+
									'<div class="slider-handle"></div>'+
									'<div class="slider-handle"></div>'+
								'</div>'+
								'<div id="tooltip" class="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'+
								'<div id="tooltip_min" class="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'+
								'<div id="tooltip_max" class="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'+
							'</div>')
								.insertBefore(this.element)
								.append(this.element);
		}

		this.id = this.element.data('slider-id')||options.id;
		if (this.id) {
			this.picker[0].id = this.id;
		}

		if (('ontouchstart' in window) || window.DocumentTouch && document instanceof window.DocumentTouch) {
			this.touchCapable = true;
		}

		var tooltip = this.element.data('slider-tooltip')||options.tooltip;

		this.tooltip = this.picker.find('#tooltip');
		this.tooltipInner = this.tooltip.find('div.tooltip-inner');

		this.tooltip_min = this.picker.find('#tooltip_min');
		this.tooltipInner_min = this.tooltip_min.find('div.tooltip-inner');

		this.tooltip_max = this.picker.find('#tooltip_max');
		this.tooltipInner_max= this.tooltip_max.find('div.tooltip-inner');

		if (updateSlider === true) {
			// Reset classes
			this.picker.removeClass('slider-horizontal');
			this.picker.removeClass('slider-vertical');
			this.tooltip.removeClass('hide');
			this.tooltip_min.removeClass('hide');
			this.tooltip_max.removeClass('hide');

		}

		this.orientation = this.element.data('slider-orientation')||options.orientation;
		switch(this.orientation) {
			case 'vertical':
				this.picker.addClass('slider-vertical');
				this.stylePos = 'top';
				this.mousePos = 'pageY';
				this.sizePos = 'offsetHeight';
				this.tooltip.addClass('right')[0].style.left = '100%';
				this.tooltip_min.addClass('right')[0].style.left = '100%';
				this.tooltip_max.addClass('right')[0].style.left = '100%';
				break;
			default:
				this.picker
					.addClass('slider-horizontal')
					.css('width', origWidth);
				this.orientation = 'horizontal';
				this.stylePos = 'left';
				this.mousePos = 'pageX';
				this.sizePos = 'offsetWidth';
				this.tooltip.addClass('top')[0].style.top = -this.tooltip.outerHeight() - 14 + 'px';
				this.tooltip_min.addClass('top')[0].style.top = -this.tooltip_min.outerHeight() - 14 + 'px';
				this.tooltip_max.addClass('top')[0].style.top = -this.tooltip_max.outerHeight() - 14 + 'px';
				break;
		}

		var self = this;
		$.each(['min',
				'max',
				'step',
				'precision',
				'value',
				'reversed',
				'handle'
			], function(i, attr) {
				if (typeof el.data('slider-' + attr) !== 'undefined') {
					self[attr] = el.data('slider-' + attr);
				} else if (typeof options[attr] !== 'undefined') {
					self[attr] = options[attr];
				} else if (typeof el.prop(attr) !== 'undefined') {
					self[attr] = el.prop(attr);
				} else {
					self[attr] = 0; // to prevent empty string issues in calculations in IE
				}
		});

		if (this.value instanceof Array) {
			if (updateSlider && !this.range) {
				this.value = this.value[0];
			} else {
				this.range = true;
			}
		} else if (this.range) {
			// User wants a range, but value is not an array
			this.value = [this.value, this.max];
		}

		this.selection = this.element.data('slider-selection')||options.selection;
		this.selectionEl = this.picker.find('.slider-selection');
		if (this.selection === 'none') {
			this.selectionEl.addClass('hide');
		}

		this.selectionElStyle = this.selectionEl[0].style;

		this.handle1 = this.picker.find('.slider-handle:first');
		this.handle1Stype = this.handle1[0].style;

		this.handle2 = this.picker.find('.slider-handle:last');
		this.handle2Stype = this.handle2[0].style;

		if (updateSlider === true) {
			// Reset classes
			this.handle1.removeClass('round triangle');
			this.handle2.removeClass('round triangle hide');
		}

		switch(this.handle) {
			case 'round':
				this.handle1.addClass('round');
				this.handle2.addClass('round');
				break;
			case 'triangle':
				this.handle1.addClass('triangle');
				this.handle2.addClass('triangle');
				break;
		}

		this.offset = this.picker.offset();
		this.size = this.picker[0][this.sizePos];
		this.formater = options.formater;
		
		this.tooltip_separator = options.tooltip_separator;
		this.tooltip_split = options.tooltip_split;

		this.setValue(this.value);

		this.handle1.on({
			keydown: $.proxy(this.keydown, this, 0)
		});
		this.handle2.on({
			keydown: $.proxy(this.keydown, this, 1)
		});

		if (this.touchCapable) {
			// Touch: Bind touch events:
			this.picker.on({
				touchstart: $.proxy(this.mousedown, this)
			});
		}
		// Bind mouse events:
		this.picker.on({
			mousedown: $.proxy(this.mousedown, this)
		});

		if(tooltip === 'hide') {
			this.tooltip.addClass('hide');
			this.tooltip_min.addClass('hide');
			this.tooltip_max.addClass('hide');
		} else if(tooltip === 'always') {
			this.showTooltip();
			this.alwaysShowTooltip = true;
		} else {
			this.picker.on({
				mouseenter: $.proxy(this.showTooltip, this),
				mouseleave: $.proxy(this.hideTooltip, this)
			});
			this.handle1.on({
				focus: $.proxy(this.showTooltip, this),
				blur: $.proxy(this.hideTooltip, this)
			});
			this.handle2.on({
				focus: $.proxy(this.showTooltip, this),
				blur: $.proxy(this.hideTooltip, this)
			});
		}

		this.enabled = options.enabled &&
						(this.element.data('slider-enabled') === undefined || this.element.data('slider-enabled') === true);
		if(this.enabled) {
			this.enable();
		} else {
			this.disable();
		}
		this.natural_arrow_keys = this.element.data('slider-natural_arrow_keys') || options.natural_arrow_keys;
	};

	Slider.prototype = {
		constructor: Slider,

		over: false,
		inDrag: false,

		showTooltip: function(){
            if (this.tooltip_split === false ){
                this.tooltip.addClass('in');
            } else {
                this.tooltip_min.addClass('in');
                this.tooltip_max.addClass('in');
            }

			this.over = true;
		},

		hideTooltip: function(){
			if (this.inDrag === false && this.alwaysShowTooltip !== true) {
				this.tooltip.removeClass('in');
				this.tooltip_min.removeClass('in');
				this.tooltip_max.removeClass('in');
			}
			this.over = false;
		},

		layout: function(){
			var positionPercentages;

			if(this.reversed) {
				positionPercentages = [ 100 - this.percentage[0], this.percentage[1] ];
			} else {
				positionPercentages = [ this.percentage[0], this.percentage[1] ];
			}

			this.handle1Stype[this.stylePos] = positionPercentages[0]+'%';
			this.handle2Stype[this.stylePos] = positionPercentages[1]+'%';

			if (this.orientation === 'vertical') {
				this.selectionElStyle.top = Math.min(positionPercentages[0], positionPercentages[1]) +'%';
				this.selectionElStyle.height = Math.abs(positionPercentages[0] - positionPercentages[1]) +'%';
			} else {
				this.selectionElStyle.left = Math.min(positionPercentages[0], positionPercentages[1]) +'%';
				this.selectionElStyle.width = Math.abs(positionPercentages[0] - positionPercentages[1]) +'%';

                var offset_min = this.tooltip_min[0].getBoundingClientRect();
                var offset_max = this.tooltip_max[0].getBoundingClientRect();

                if (offset_min.right > offset_max.left) {
                    this.tooltip_max.removeClass('top');
                    this.tooltip_max.addClass('bottom')[0].style.top = 18 + 'px';
                } else {
                    this.tooltip_max.removeClass('bottom');
                    this.tooltip_max.addClass('top')[0].style.top = -30 + 'px';
                }
			}

			if (this.range) {
				this.tooltipInner.text(
					this.formater(this.value[0]) + this.tooltip_separator + this.formater(this.value[1])
				);
				this.tooltip[0].style[this.stylePos] = this.size * (positionPercentages[0] + (positionPercentages[1] - positionPercentages[0])/2)/100 - (this.orientation === 'vertical' ? this.tooltip.outerHeight()/2 : this.tooltip.outerWidth()/2) +'px';

                this.tooltipInner_min.text(
					this.formater(this.value[0])
				);
                this.tooltipInner_max.text(
					this.formater(this.value[1])
				);

				this.tooltip_min[0].style[this.stylePos] = this.size * ( (positionPercentages[0])/100) - (this.orientation === 'vertical' ? this.tooltip_min.outerHeight()/2 : this.tooltip_min.outerWidth()/2) +'px';
				this.tooltip_max[0].style[this.stylePos] = this.size * ( (positionPercentages[1])/100) - (this.orientation === 'vertical' ? this.tooltip_max.outerHeight()/2 : this.tooltip_max.outerWidth()/2) +'px';

			} else {
				this.tooltipInner.text(
					this.formater(this.value[0])
				);
				this.tooltip[0].style[this.stylePos] = this.size * positionPercentages[0]/100 - (this.orientation === 'vertical' ? this.tooltip.outerHeight()/2 : this.tooltip.outerWidth()/2) +'px';
			}
		},

		mousedown: function(ev) {
			if(!this.isEnabled()) {
				return false;
			}
			// Touch: Get the original event:
			if (this.touchCapable && ev.type === 'touchstart') {
				ev = ev.originalEvent;
			}

			this.triggerFocusOnHandle();

			this.offset = this.picker.offset();
			this.size = this.picker[0][this.sizePos];

			var percentage = this.getPercentage(ev);

			if (this.range) {
				var diff1 = Math.abs(this.percentage[0] - percentage);
				var diff2 = Math.abs(this.percentage[1] - percentage);
				this.dragged = (diff1 < diff2) ? 0 : 1;
			} else {
				this.dragged = 0;
			}

			this.percentage[this.dragged] = this.reversed ? 100 - percentage : percentage;
			this.layout();

			if (this.touchCapable) {
				// Touch: Bind touch events:
				$(document).on({
					touchmove: $.proxy(this.mousemove, this),
					touchend: $.proxy(this.mouseup, this)
				});
			}
			// Bind mouse events:
			$(document).on({
				mousemove: $.proxy(this.mousemove, this),
				mouseup: $.proxy(this.mouseup, this)
			});

			this.inDrag = true;
			var val = this.calculateValue();
			this.element.trigger({
					type: 'slideStart',
					value: val
				})
				.data('value', val)
				.prop('value', val);
			this.setValue(val);
			return true;
		},

		triggerFocusOnHandle: function(handleIdx) {
			if(handleIdx === 0) {
				this.handle1.focus();
			}
			if(handleIdx === 1) {
				this.handle2.focus();
			}
		},

		keydown: function(handleIdx, ev) {
			if(!this.isEnabled()) {
				return false;
			}

			var dir;
			switch (ev.which) {
				case 37: // left
				case 40: // down
					dir = -1;
					break;
				case 39: // right
				case 38: // up
					dir = 1;
					break;
			}
			if (!dir) {
				return;
			}

			// use natural arrow keys instead of from min to max
			if (this.natural_arrow_keys) {
				if ((this.orientation === 'vertical' && !this.reversed) || (this.orientation === 'horizontal' && this.reversed)) {
					dir = dir * -1;
				}
			}

			var oneStepValuePercentageChange = dir * this.percentage[2];
			var percentage = this.percentage[handleIdx] + oneStepValuePercentageChange;

			if (percentage > 100) {
				percentage = 100;
			} else if (percentage < 0) {
				percentage = 0;
			}

			this.dragged = handleIdx;
			this.adjustPercentageForRangeSliders(percentage);
			this.percentage[this.dragged] = percentage;
			this.layout();

			var val = this.calculateValue();
			
			this.element.trigger({
					type: 'slideStart',
					value: val
				})
				.data('value', val)
				.prop('value', val);

			this.setValue(val, true);

			this.element
				.trigger({
					type: 'slideStop',
					value: val
				})
				.data('value', val)
				.prop('value', val);
			return false;
		},

		mousemove: function(ev) {
			if(!this.isEnabled()) {
				return false;
			}
			// Touch: Get the original event:
			if (this.touchCapable && ev.type === 'touchmove') {
				ev = ev.originalEvent;
			}

			var percentage = this.getPercentage(ev);
			this.adjustPercentageForRangeSliders(percentage);
			this.percentage[this.dragged] = this.reversed ? 100 - percentage : percentage;
			this.layout();

			var val = this.calculateValue();
			this.setValue(val, true);

			return false;
		},
		adjustPercentageForRangeSliders: function(percentage) {
			if (this.range) {
				if (this.dragged === 0 && this.percentage[1] < percentage) {
					this.percentage[0] = this.percentage[1];
					this.dragged = 1;
				} else if (this.dragged === 1 && this.percentage[0] > percentage) {
					this.percentage[1] = this.percentage[0];
					this.dragged = 0;
				}
			}
		},

		mouseup: function() {
			if(!this.isEnabled()) {
				return false;
			}
			if (this.touchCapable) {
				// Touch: Unbind touch event handlers:
				$(document).off({
					touchmove: this.mousemove,
					touchend: this.mouseup
				});
			}
			// Unbind mouse event handlers:
			$(document).off({
				mousemove: this.mousemove,
				mouseup: this.mouseup
			});

			this.inDrag = false;
			if (this.over === false) {
				this.hideTooltip();
			}
			var val = this.calculateValue();
			this.layout();
			this.element
				.data('value', val)
				.prop('value', val)
				.trigger({
					type: 'slideStop',
					value: val
				});
			return false;
		},

		calculateValue: function() {
			var val;
			if (this.range) {
				val = [this.min,this.max];
                if (this.percentage[0] !== 0){
                    val[0] = (Math.max(this.min, this.min + Math.round((this.diff * this.percentage[0]/100)/this.step)*this.step));
                    val[0] = this.applyPrecision(val[0]);
                }
                if (this.percentage[1] !== 100){
                    val[1] = (Math.min(this.max, this.min + Math.round((this.diff * this.percentage[1]/100)/this.step)*this.step));
                    val[1] = this.applyPrecision(val[1]);
                }
				this.value = val;
			} else {
				val = (this.min + Math.round((this.diff * this.percentage[0]/100)/this.step)*this.step);
				if (val < this.min) {
					val = this.min;
				}
				else if (val > this.max) {
					val = this.max;
				}
				val = parseFloat(val);
				val = this.applyPrecision(val);
				this.value = [val, this.value[1]];
			}
			return val;
		},
		applyPrecision: function(val) {
			var precision = this.precision || this.getNumDigitsAfterDecimalPlace(this.step);
			return this.applyToFixedAndParseFloat(val, precision);
		},
		/*
			Credits to Mike Samuel for the following method!
			Source: http://stackoverflow.com/questions/10454518/javascript-how-to-retrieve-the-number-of-decimals-of-a-string-number
		*/
		getNumDigitsAfterDecimalPlace: function(num) {
			var match = (''+num).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
			if (!match) { return 0; }
			return Math.max(0, (match[1] ? match[1].length : 0) - (match[2] ? +match[2] : 0));
		},

		applyToFixedAndParseFloat: function(num, toFixedInput) {
			var truncatedNum = num.toFixed(toFixedInput);
			return parseFloat(truncatedNum);
		},

		getPercentage: function(ev) {
			if (this.touchCapable && (ev.type === 'touchstart' || ev.type === 'touchmove')) {
				ev = ev.touches[0];
			}
			var percentage = (ev[this.mousePos] - this.offset[this.stylePos])*100/this.size;
			percentage = Math.round(percentage/this.percentage[2])*this.percentage[2];
			return Math.max(0, Math.min(100, percentage));
		},

		getValue: function() {
			if (this.range) {
				return this.value;
			}
			return this.value[0];
		},

		setValue: function(val, triggerSlideEvent) {
			if (!val) {
				val = 0;
			}
			this.value = this.validateInputValue(val);

			if (this.range) {
				this.value[0] = this.applyPrecision(this.value[0]);
				this.value[1] = this.applyPrecision(this.value[1]); 

				this.value[0] = Math.max(this.min, Math.min(this.max, this.value[0]));
				this.value[1] = Math.max(this.min, Math.min(this.max, this.value[1]));
			} else {
				this.value = this.applyPrecision(this.value);
				this.value = [ Math.max(this.min, Math.min(this.max, this.value))];
				this.handle2.addClass('hide');
				if (this.selection === 'after') {
					this.value[1] = this.max;
				} else {
					this.value[1] = this.min;
				}
			}

			this.diff = this.max - this.min;
			if (this.diff > 0) {
				this.percentage = [
					(this.value[0] - this.min) * 100 / this.diff,
					(this.value[1] - this.min) * 100 / this.diff,
					this.step * 100 / this.diff
				];
			} else {
				this.percentage = [0, 0, 100];
			}

			this.layout();


			if(triggerSlideEvent === true) {
				var slideEventValue = this.range ? this.value : this.value[0];
				this.element
					.trigger({
						'type': 'slide',
						'value': slideEventValue
					})
					.data('value', slideEventValue)
					.prop('value', slideEventValue);
			}
		},

		validateInputValue : function(val) {
			if(typeof val === 'number') {
				return val;
			} else if(val instanceof Array) {
				$.each(val, function(i, input) { if (typeof input !== 'number') { throw new Error( ErrorMsgs.formatInvalidInputErrorMsg(input) ); }});
				return val;
			} else {
				throw new Error( ErrorMsgs.formatInvalidInputErrorMsg(val) );
			}
		},

		destroy: function(){
			this.handle1.off();
			this.handle2.off();
			this.element.off().show().insertBefore(this.picker);
			this.picker.off().remove();
			$(this.element).removeData('slider');
		},

		disable: function() {
			this.enabled = false;
			this.handle1.removeAttr("tabindex");
			this.handle2.removeAttr("tabindex");
			this.picker.addClass('slider-disabled');
			this.element.trigger('slideDisabled');
		},

		enable: function() {
			this.enabled = true;
			this.handle1.attr("tabindex", 0);
			this.handle2.attr("tabindex", 0);
			this.picker.removeClass('slider-disabled');
			this.element.trigger('slideEnabled');
		},

		toggle: function() {
			if(this.enabled) {
				this.disable();
			} else {
				this.enable();
			}
		},

		isEnabled: function() {
			return this.enabled;
		},

		setAttribute: function(attribute, value) {
			this[attribute] = value;
		},

		getAttribute: function(attribute) {
			return this[attribute];
		}

	};

	var publicMethods = {
		getValue : Slider.prototype.getValue,
		setValue : Slider.prototype.setValue,
		setAttribute : Slider.prototype.setAttribute,
		getAttribute : Slider.prototype.getAttribute,
		destroy : Slider.prototype.destroy,
		disable : Slider.prototype.disable,
		enable : Slider.prototype.enable,
		toggle : Slider.prototype.toggle,
		isEnabled: Slider.prototype.isEnabled
	};

	$.fn.slider = function (option) {
		if (typeof option === 'string' && option !== 'refresh') {
			var args = Array.prototype.slice.call(arguments, 1);
			return invokePublicMethod.call(this, option, args);
		} else {
			return createNewSliderInstance.call(this, option);
		}
	};

	function invokePublicMethod(methodName, args) {
		if(publicMethods[methodName]) {
			var sliderObject = retrieveSliderObjectFromElement(this);
			var result = publicMethods[methodName].apply(sliderObject, args);

			if (typeof result === "undefined") {
				return $(this);
			} else {
				return result;
			}
		} else {
			throw new Error("method '" + methodName + "()' does not exist for slider.");
		}
	}

	function retrieveSliderObjectFromElement(element) {
		var sliderObject = $(element).data('slider');
		if(sliderObject && sliderObject instanceof Slider) {
			return sliderObject;
		} else {
			throw new Error(ErrorMsgs.callingContextNotSliderInstance);
		}
	}

	function createNewSliderInstance(opts) {
		var $this = $(this);
		$this.each(function() {
			var $this = $(this),
				slider = $this.data('slider'),
				options = typeof opts === 'object' && opts;

			// If slider already exists, use its attributes
			// as options so slider refreshes properly
			if (slider && !options) {
				options = {};

				$.each($.fn.slider.defaults, function(key) {
					options[key] = slider[key];
				});
			}

			$this.data('slider', (new Slider(this, $.extend({}, $.fn.slider.defaults, options))));
		});
		return $this;
	}

	$.fn.slider.defaults = {
		min: 0,
		max: 10,
		step: 1,
		precision: 0,
		orientation: 'horizontal',
		value: 5,
		range: false,
		selection: 'before',
		tooltip: 'show',
		tooltip_separator: ':',
		tooltip_split: false,
		natural_arrow_keys: false,
		handle: 'round',
		reversed : false,
		enabled: true,
		formater: function(value) {
			return value;
		}
	};

	$.fn.slider.Constructor = Slider;

})( window.jQuery );

/* vim: set noexpandtab tabstop=4 shiftwidth=4 autoindent: */
/*!
 * Bootstrap Colorpicker
 * http://mjolnic.github.io/bootstrap-colorpicker/
 *
 * Originally written by (c) 2012 Stefan Petre
 * Licensed under the Apache License v2.0
 * http://www.apache.org/licenses/LICENSE-2.0.txt
 *
 * @todo Update DOCS
 */

(function(factory) {
        "use strict";
        if (typeof define === 'function' && define.amd) {
            define(['jquery'], factory);
        } else if (window.jQuery && !window.jQuery.fn.colorpicker) {
            factory(window.jQuery);
        }
    }
    (function($) {
        'use strict';

        // Color object
        var Color = function(val) {
            this.value = {
                h: 0,
                s: 0,
                b: 0,
                a: 1
            };
            this.origFormat = null; // original string format
            if (val) {
                if (val.toLowerCase !== undefined) {
                    this.setColor(val);
                } else if (val.h !== undefined) {
                    this.value = val;
                }
            }
        };

        Color.prototype = {
            constructor: Color,
            // 140 predefined colors from the HTML Colors spec
            colors: {
                "aliceblue": "#f0f8ff",
                "antiquewhite": "#faebd7",
                "aqua": "#00ffff",
                "aquamarine": "#7fffd4",
                "azure": "#f0ffff",
                "beige": "#f5f5dc",
                "bisque": "#ffe4c4",
                "black": "#000000",
                "blanchedalmond": "#ffebcd",
                "blue": "#0000ff",
                "blueviolet": "#8a2be2",
                "brown": "#a52a2a",
                "burlywood": "#deb887",
                "cadetblue": "#5f9ea0",
                "chartreuse": "#7fff00",
                "chocolate": "#d2691e",
                "coral": "#ff7f50",
                "cornflowerblue": "#6495ed",
                "cornsilk": "#fff8dc",
                "crimson": "#dc143c",
                "cyan": "#00ffff",
                "darkblue": "#00008b",
                "darkcyan": "#008b8b",
                "darkgoldenrod": "#b8860b",
                "darkgray": "#a9a9a9",
                "darkgreen": "#006400",
                "darkkhaki": "#bdb76b",
                "darkmagenta": "#8b008b",
                "darkolivegreen": "#556b2f",
                "darkorange": "#ff8c00",
                "darkorchid": "#9932cc",
                "darkred": "#8b0000",
                "darksalmon": "#e9967a",
                "darkseagreen": "#8fbc8f",
                "darkslateblue": "#483d8b",
                "darkslategray": "#2f4f4f",
                "darkturquoise": "#00ced1",
                "darkviolet": "#9400d3",
                "deeppink": "#ff1493",
                "deepskyblue": "#00bfff",
                "dimgray": "#696969",
                "dodgerblue": "#1e90ff",
                "firebrick": "#b22222",
                "floralwhite": "#fffaf0",
                "forestgreen": "#228b22",
                "fuchsia": "#ff00ff",
                "gainsboro": "#dcdcdc",
                "ghostwhite": "#f8f8ff",
                "gold": "#ffd700",
                "goldenrod": "#daa520",
                "gray": "#808080",
                "green": "#008000",
                "greenyellow": "#adff2f",
                "honeydew": "#f0fff0",
                "hotpink": "#ff69b4",
                "indianred ": "#cd5c5c",
                "indigo ": "#4b0082",
                "ivory": "#fffff0",
                "khaki": "#f0e68c",
                "lavender": "#e6e6fa",
                "lavenderblush": "#fff0f5",
                "lawngreen": "#7cfc00",
                "lemonchiffon": "#fffacd",
                "lightblue": "#add8e6",
                "lightcoral": "#f08080",
                "lightcyan": "#e0ffff",
                "lightgoldenrodyellow": "#fafad2",
                "lightgrey": "#d3d3d3",
                "lightgreen": "#90ee90",
                "lightpink": "#ffb6c1",
                "lightsalmon": "#ffa07a",
                "lightseagreen": "#20b2aa",
                "lightskyblue": "#87cefa",
                "lightslategray": "#778899",
                "lightsteelblue": "#b0c4de",
                "lightyellow": "#ffffe0",
                "lime": "#00ff00",
                "limegreen": "#32cd32",
                "linen": "#faf0e6",
                "magenta": "#ff00ff",
                "maroon": "#800000",
                "mediumaquamarine": "#66cdaa",
                "mediumblue": "#0000cd",
                "mediumorchid": "#ba55d3",
                "mediumpurple": "#9370d8",
                "mediumseagreen": "#3cb371",
                "mediumslateblue": "#7b68ee",
                "mediumspringgreen": "#00fa9a",
                "mediumturquoise": "#48d1cc",
                "mediumvioletred": "#c71585",
                "midnightblue": "#191970",
                "mintcream": "#f5fffa",
                "mistyrose": "#ffe4e1",
                "moccasin": "#ffe4b5",
                "navajowhite": "#ffdead",
                "navy": "#000080",
                "oldlace": "#fdf5e6",
                "olive": "#808000",
                "olivedrab": "#6b8e23",
                "orange": "#ffa500",
                "orangered": "#ff4500",
                "orchid": "#da70d6",
                "palegoldenrod": "#eee8aa",
                "palegreen": "#98fb98",
                "paleturquoise": "#afeeee",
                "palevioletred": "#d87093",
                "papayawhip": "#ffefd5",
                "peachpuff": "#ffdab9",
                "peru": "#cd853f",
                "pink": "#ffc0cb",
                "plum": "#dda0dd",
                "powderblue": "#b0e0e6",
                "purple": "#800080",
                "red": "#ff0000",
                "rosybrown": "#bc8f8f",
                "royalblue": "#4169e1",
                "saddlebrown": "#8b4513",
                "salmon": "#fa8072",
                "sandybrown": "#f4a460",
                "seagreen": "#2e8b57",
                "seashell": "#fff5ee",
                "sienna": "#a0522d",
                "silver": "#c0c0c0",
                "skyblue": "#87ceeb",
                "slateblue": "#6a5acd",
                "slategray": "#708090",
                "snow": "#fffafa",
                "springgreen": "#00ff7f",
                "steelblue": "#4682b4",
                "tan": "#d2b48c",
                "teal": "#008080",
                "thistle": "#d8bfd8",
                "tomato": "#ff6347",
                "turquoise": "#40e0d0",
                "violet": "#ee82ee",
                "wheat": "#f5deb3",
                "white": "#ffffff",
                "whitesmoke": "#f5f5f5",
                "yellow": "#ffff00",
                "yellowgreen": "#9acd32"
            },
            _sanitizeNumber: function(val) {
                if (typeof val === 'number') {
                    return val;
                }
                if (isNaN(val) || (val === null) || (val === '') || (val === undefined)) {
                    return 1;
                }
                if (val.toLowerCase !== undefined) {
                    return parseFloat(val);
                }
                return 1;
            },
            //parse a string to HSB
            setColor: function(strVal) {
                strVal = strVal.toLowerCase();
                this.value = this.stringToHSB(strVal) || {
                    h: 0,
                    s: 0,
                    b: 0,
                    a: 1
                };
            },
            stringToHSB: function(strVal) {
                strVal = strVal.toLowerCase();
                var that = this,
                    result = false;
                $.each(this.stringParsers, function(i, parser) {
                    var match = parser.re.exec(strVal),
                        values = match && parser.parse.apply(that, [match]),
                        format = parser.format || 'rgba';
                    if (values) {
                        if (format.match(/hsla?/)) {
                            result = that.RGBtoHSB.apply(that, that.HSLtoRGB.apply(that, values));
                        } else {
                            result = that.RGBtoHSB.apply(that, values);
                        }
                        that.origFormat = format;
                        return false;
                    }
                    return true;
                });
                return result;
            },
            setHue: function(h) {
                this.value.h = 1 - h;
            },
            setSaturation: function(s) {
                this.value.s = s;
            },
            setBrightness: function(b) {
                this.value.b = 1 - b;
            },
            setAlpha: function(a) {
                this.value.a = parseInt((1 - a) * 100, 10) / 100;
            },
            toRGB: function(h, s, b, a) {
                if (!h) {
                    h = this.value.h;
                    s = this.value.s;
                    b = this.value.b;
                }
                h *= 360;
                var R, G, B, X, C;
                h = (h % 360) / 60;
                C = b * s;
                X = C * (1 - Math.abs(h % 2 - 1));
                R = G = B = b - C;

                h = ~~h;
                R += [C, X, 0, 0, X, C][h];
                G += [X, C, C, X, 0, 0][h];
                B += [0, 0, X, C, C, X][h];
                return {
                    r: Math.round(R * 255),
                    g: Math.round(G * 255),
                    b: Math.round(B * 255),
                    a: a || this.value.a
                };
            },
            toHex: function(h, s, b, a) {
                var rgb = this.toRGB(h, s, b, a);
                return '#' + ((1 << 24) | (parseInt(rgb.r) << 16) | (parseInt(rgb.g) << 8) | parseInt(rgb.b)).toString(16).substr(1);
            },
            toHSL: function(h, s, b, a) {
                h = h || this.value.h;
                s = s || this.value.s;
                b = b || this.value.b;
                a = a || this.value.a;

                var H = h,
                    L = (2 - s) * b,
                    S = s * b;
                if (L > 0 && L <= 1) {
                    S /= L;
                } else {
                    S /= 2 - L;
                }
                L /= 2;
                if (S > 1) {
                    S = 1;
                }
                return {
                    h: isNaN(H) ? 0 : H,
                    s: isNaN(S) ? 0 : S,
                    l: isNaN(L) ? 0 : L,
                    a: isNaN(a) ? 0 : a,
                };
            },
            toAlias: function(r, g, b, a) {
                var rgb = this.toHex(r, g, b, a);
                for (var alias in this.colors) {
                    if (this.colors[alias] == rgb) {
                        return alias;
                    }
                }
                return false;
            },
            RGBtoHSB: function(r, g, b, a) {
                r /= 255;
                g /= 255;
                b /= 255;

                var H, S, V, C;
                V = Math.max(r, g, b);
                C = V - Math.min(r, g, b);
                H = (C === 0 ? null :
                    V === r ? (g - b) / C :
                    V === g ? (b - r) / C + 2 :
                    (r - g) / C + 4
                );
                H = ((H + 360) % 6) * 60 / 360;
                S = C === 0 ? 0 : C / V;
                return {
                    h: this._sanitizeNumber(H),
                    s: S,
                    b: V,
                    a: this._sanitizeNumber(a)
                };
            },
            HueToRGB: function(p, q, h) {
                if (h < 0) {
                    h += 1;
                } else if (h > 1) {
                    h -= 1;
                }
                if ((h * 6) < 1) {
                    return p + (q - p) * h * 6;
                } else if ((h * 2) < 1) {
                    return q;
                } else if ((h * 3) < 2) {
                    return p + (q - p) * ((2 / 3) - h) * 6;
                } else {
                    return p;
                }
            },
            HSLtoRGB: function(h, s, l, a) {
                if (s < 0) {
                    s = 0;
                }
                var q;
                if (l <= 0.5) {
                    q = l * (1 + s);
                } else {
                    q = l + s - (l * s);
                }

                var p = 2 * l - q;

                var tr = h + (1 / 3);
                var tg = h;
                var tb = h - (1 / 3);

                var r = Math.round(this.HueToRGB(p, q, tr) * 255);
                var g = Math.round(this.HueToRGB(p, q, tg) * 255);
                var b = Math.round(this.HueToRGB(p, q, tb) * 255);
                return [r, g, b, this._sanitizeNumber(a)];
            },
            toString: function(format) {
                format = format || 'rgba';
                switch (format) {
                    case 'rgb':
                        {
                            var rgb = this.toRGB();
                            return 'rgb(' + rgb.r + ',' + rgb.g + ',' + rgb.b + ')';
                        }
                        break;
                    case 'rgba':
                        {
                            var rgb = this.toRGB();
                            return 'rgba(' + rgb.r + ',' + rgb.g + ',' + rgb.b + ',' + rgb.a + ')';
                        }
                        break;
                    case 'hsl':
                        {
                            var hsl = this.toHSL();
                            return 'hsl(' + Math.round(hsl.h * 360) + ',' + Math.round(hsl.s * 100) + '%,' + Math.round(hsl.l * 100) + '%)';
                        }
                        break;
                    case 'hsla':
                        {
                            var hsl = this.toHSL();
                            return 'hsla(' + Math.round(hsl.h * 360) + ',' + Math.round(hsl.s * 100) + '%,' + Math.round(hsl.l * 100) + '%,' + hsl.a + ')';
                        }
                        break;
                    case 'hex':
                        {
                            return this.toHex();
                        }
                        break;
                    case 'alias':
                        return this.toAlias() || this.toHex();
                    default:
                        {
                            return false;
                        }
                        break;
                }
            },
            // a set of RE's that can match strings and generate color tuples.
            // from John Resig color plugin
            // https://github.com/jquery/jquery-color/
            stringParsers: [{
                re: /#([a-fA-F0-9]{2})([a-fA-F0-9]{2})([a-fA-F0-9]{2})/,
                format: 'hex',
                parse: function(execResult) {
                    return [
                        parseInt(execResult[1], 16),
                        parseInt(execResult[2], 16),
                        parseInt(execResult[3], 16),
                        1
                    ];
                }
            }, {
                re: /#([a-fA-F0-9])([a-fA-F0-9])([a-fA-F0-9])/,
                format: 'hex',
                parse: function(execResult) {
                    return [
                        parseInt(execResult[1] + execResult[1], 16),
                        parseInt(execResult[2] + execResult[2], 16),
                        parseInt(execResult[3] + execResult[3], 16),
                        1
                    ];
                }
            }, {
                re: /rgb\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*?\)/,
                format: 'rgb',
                parse: function(execResult) {
                    return [
                        execResult[1],
                        execResult[2],
                        execResult[3],
                        1
                    ];
                }
            }, {
                re: /rgb\(\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*?\)/,
                format: 'rgb',
                parse: function(execResult) {
                    return [
                        2.55 * execResult[1],
                        2.55 * execResult[2],
                        2.55 * execResult[3],
                        1
                    ];
                }
            }, {
                re: /rgba\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*(?:,\s*(\d+(?:\.\d+)?)\s*)?\)/,
                format: 'rgba',
                parse: function(execResult) {
                    return [
                        execResult[1],
                        execResult[2],
                        execResult[3],
                        execResult[4]
                    ];
                }
            }, {
                re: /rgba\(\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d+(?:\.\d+)?)\s*)?\)/,
                format: 'rgba',
                parse: function(execResult) {
                    return [
                        2.55 * execResult[1],
                        2.55 * execResult[2],
                        2.55 * execResult[3],
                        execResult[4]
                    ];
                }
            }, {
                re: /hsl\(\s*(\d+(?:\.\d+)?)\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*?\)/,
                format: 'hsl',
                parse: function(execResult) {
                    return [
                        execResult[1] / 360,
                        execResult[2] / 100,
                        execResult[3] / 100,
                        execResult[4]
                    ];
                }
            }, {
                re: /hsla\(\s*(\d+(?:\.\d+)?)\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d+(?:\.\d+)?)\s*)?\)/,
                format: 'hsla',
                parse: function(execResult) {
                    return [
                        execResult[1] / 360,
                        execResult[2] / 100,
                        execResult[3] / 100,
                        execResult[4]
                    ];
                }
            }, {
                //predefined color name
                re: /^([a-z]{3,})$/,
                format: 'alias',
                parse: function(execResult) {
                    var hexval = this.colorNameToHex(execResult[0]) || '#000000';
                    var match = this.stringParsers[0].re.exec(hexval),
                        values = match && this.stringParsers[0].parse.apply(this, [match]);
                    return values;
                }
            }],
            colorNameToHex: function(name) {
                if (typeof this.colors[name.toLowerCase()] !== 'undefined') {
                    return this.colors[name.toLowerCase()];
                }
                return false;
            }
        };


        var defaults = {
            horizontal: false, // horizontal mode layout ?
            inline: false, //forces to show the colorpicker as an inline element
            color: false, //forces a color
            format: false, //forces a format
            input: 'input', // children input selector
            container: false, // container selector
            component: '.add-on, .input-group-addon', // children component selector
            sliders: {
                saturation: {
                    maxLeft: 100,
                    maxTop: 100,
                    callLeft: 'setSaturation',
                    callTop: 'setBrightness'
                },
                hue: {
                    maxLeft: 0,
                    maxTop: 100,
                    callLeft: false,
                    callTop: 'setHue'
                },
                alpha: {
                    maxLeft: 0,
                    maxTop: 100,
                    callLeft: false,
                    callTop: 'setAlpha'
                }
            },
            slidersHorz: {
                saturation: {
                    maxLeft: 100,
                    maxTop: 100,
                    callLeft: 'setSaturation',
                    callTop: 'setBrightness'
                },
                hue: {
                    maxLeft: 100,
                    maxTop: 0,
                    callLeft: 'setHue',
                    callTop: false
                },
                alpha: {
                    maxLeft: 100,
                    maxTop: 0,
                    callLeft: 'setAlpha',
                    callTop: false
                }
            },
            template: '<div class="colorpicker dropdown-menu">' +
                '<div class="colorpicker-saturation"><i><b></b></i></div>' +
                '<div class="colorpicker-hue"><i></i></div>' +
                '<div class="colorpicker-alpha"><i></i></div>' +
                '<div class="colorpicker-color"><div /></div>' +
                '</div>'
        };

        var Colorpicker = function(element, options) {
            this.element = $(element).addClass('colorpicker-element');
            this.options = $.extend({}, defaults, this.element.data(), options);
            this.component = this.options.component;
            this.component = (this.component !== false) ? this.element.find(this.component) : false;
            if (this.component && (this.component.length === 0)) {
                this.component = false;
            }
            this.container = (this.options.container === true) ? this.element : this.options.container;
            this.container = (this.container !== false) ? $(this.container) : false;

            // Is the element an input? Should we search inside for any input?
            this.input = this.element.is('input') ? this.element : (this.options.input ?
                this.element.find(this.options.input) : false);
            if (this.input && (this.input.length === 0)) {
                this.input = false;
            }
            // Set HSB color
            this.color = new Color(this.options.color !== false ? this.options.color : this.getValue());
            this.format = this.options.format !== false ? this.options.format : this.color.origFormat;

            // Setup picker
            this.picker = $(this.options.template);
            if (this.options.inline) {
                this.picker.addClass('colorpicker-inline colorpicker-visible');
            } else {
                this.picker.addClass('colorpicker-hidden');
            }
            if (this.options.horizontal) {
                this.picker.addClass('colorpicker-horizontal');
            }
            if (this.format === 'rgba' || this.format === 'hsla') {
                this.picker.addClass('colorpicker-with-alpha');
            }
            this.picker.on('mousedown.colorpicker', $.proxy(this.mousedown, this));
            this.picker.appendTo(this.container ? this.container : $('body'));

            // Bind events
            if (this.input !== false) {
                this.input.on({
                    'keyup.colorpicker': $.proxy(this.keyup, this)
                });
                if (this.component === false) {
                    this.element.on({
                        'focus.colorpicker': $.proxy(this.show, this)
                    });
                }
                if (this.options.inline === false) {
                    this.element.on({
                        'focusout.colorpicker': $.proxy(this.hide, this)
                    });
                }
            }

            if (this.component !== false) {
                this.component.on({
                    'click.colorpicker': $.proxy(this.show, this)
                });
            }

            if ((this.input === false) && (this.component === false)) {
                this.element.on({
                    'click.colorpicker': $.proxy(this.show, this)
                });
            }
            this.update();

            $($.proxy(function() {
                this.element.trigger('create');
            }, this));
        };

        Colorpicker.version = '2.0.0-beta';

        Colorpicker.Color = Color;

        Colorpicker.prototype = {
            constructor: Colorpicker,
            destroy: function() {
                this.picker.remove();
                this.element.removeData('colorpicker').off('.colorpicker');
                if (this.input !== false) {
                    this.input.off('.colorpicker');
                }
                if (this.component !== false) {
                    this.component.off('.colorpicker');
                }
                this.element.removeClass('colorpicker-element');
                this.element.trigger({
                    type: 'destroy'
                });
            },
            reposition: function() {
                if (this.options.inline !== false) {
                    return false;
                }
                var type = this.container && this.container[0] !== document.body ? 'position' : 'offset';
                var offset = this.component ? this.component[type]() : this.element[type]();
                this.picker.css({
                    top: offset.top + (this.component ? this.component.outerHeight() : this.element.outerHeight()),
                    left: offset.left
                });
            },
            show: function(e) {
                if (this.isDisabled()) {
                    return false;
                }
                this.picker.addClass('colorpicker-visible').removeClass('colorpicker-hidden');
                this.reposition();
                $(window).on('resize.colorpicker', $.proxy(this.reposition, this));
                if (!this.hasInput() && e) {
                    if (e.stopPropagation && e.preventDefault) {
                        e.stopPropagation();
                        e.preventDefault();
                    }
                }
                if (this.options.inline === false) {
                    $(window.document).on({
                        'mousedown.colorpicker': $.proxy(this.hide, this)
                    });
                }
                this.element.trigger({
                    type: 'showPicker',
                    color: this.color
                });
            },
            hide: function() {
                this.picker.addClass('colorpicker-hidden').removeClass('colorpicker-visible');
                $(window).off('resize.colorpicker', this.reposition);
                $(document).off({
                    'mousedown.colorpicker': this.hide
                });
                this.update();
                this.element.trigger({
                    type: 'hidePicker',
                    color: this.color
                });
            },
            updateData: function(val) {
                val = val || this.color.toString(this.format);
                this.element.data('color', val);
                return val;
            },
            updateInput: function(val) {
                val = val || this.color.toString(this.format);
                if (this.input !== false) {
                    this.input.prop('value', val);
                }
                return val;
            },
            updatePicker: function(val) {
                if (val !== undefined) {
                    this.color = new Color(val);
                }
                var sl = (this.options.horizontal === false) ? this.options.sliders : this.options.slidersHorz;
                var icns = this.picker.find('i');
                if (icns.length === 0) {
                    return;
                }
                if (this.options.horizontal === false) {
                    sl = this.options.sliders;
                    icns.eq(1).css('top', sl.hue.maxTop * (1 - this.color.value.h)).end()
                        .eq(2).css('top', sl.alpha.maxTop * (1 - this.color.value.a));
                } else {
                    sl = this.options.slidersHorz;
                    icns.eq(1).css('left', sl.hue.maxLeft * (1 - this.color.value.h)).end()
                        .eq(2).css('left', sl.alpha.maxLeft * (1 - this.color.value.a));
                }
                icns.eq(0).css({
                    'top': sl.saturation.maxTop - this.color.value.b * sl.saturation.maxTop,
                    'left': this.color.value.s * sl.saturation.maxLeft
                });
                this.picker.find('.colorpicker-saturation').css('backgroundColor', this.color.toHex(this.color.value.h, 1, 1, 1));
                this.picker.find('.colorpicker-alpha').css('backgroundColor', this.color.toHex());
                this.picker.find('.colorpicker-color, .colorpicker-color div').css('backgroundColor', this.color.toString(this.format));
                return val;
            },
            updateComponent: function(val) {
                val = val || this.color.toString(this.format);
                if (this.component !== false) {
                    var icn = this.component.find('i').eq(0);
                    if (icn.length > 0) {
                        icn.css({
                            'backgroundColor': val
                        });
                    } else {
                        this.component.css({
                            'backgroundColor': val
                        });
                    }
                }
                return val;
            },
            update: function(force) {
                var val = this.updateComponent();
                if ((this.getValue(false) !== false) || (force === true)) {
                    // Update input/data only if the current value is not blank
                    this.updateInput(val);
                    this.updateData(val);
                }
                this.updatePicker();
                return val;

            },
            setValue: function(val) { // set color manually
                this.color = new Color(val);
                this.update();
                this.element.trigger({
                    type: 'changeColor',
                    color: this.color,
                    value: val
                });
            },
            getValue: function(defaultValue) {
                defaultValue = (defaultValue === undefined) ? '#000000' : defaultValue;
                var val;
                if (this.hasInput()) {
                    val = this.input.val();
                } else {
                    val = this.element.data('color');
                }
                if ((val === undefined) || (val === '') || (val === null)) {
                    // if not defined or empty, return default
                    val = defaultValue;
                }
                return val;
            },
            hasInput: function() {
                return (this.input !== false);
            },
            isDisabled: function() {
                if (this.hasInput()) {
                    return (this.input.prop('disabled') === true);
                }
                return false;
            },
            disable: function() {
                if (this.hasInput()) {
                    this.input.prop('disabled', true);
                    return true;
                }
                return false;
            },
            enable: function() {
                if (this.hasInput()) {
                    this.input.prop('disabled', false);
                    return true;
                }
                return false;
            },
            currentSlider: null,
            mousePointer: {
                left: 0,
                top: 0
            },
            mousedown: function(e) {
                e.stopPropagation();
                e.preventDefault();

                var target = $(e.target);

                //detect the slider and set the limits and callbacks
                var zone = target.closest('div');
                var sl = this.options.horizontal ? this.options.slidersHorz : this.options.sliders;
                if (!zone.is('.colorpicker')) {
                    if (zone.is('.colorpicker-saturation')) {
                        this.currentSlider = $.extend({}, sl.saturation);
                    } else if (zone.is('.colorpicker-hue')) {
                        this.currentSlider = $.extend({}, sl.hue);
                    } else if (zone.is('.colorpicker-alpha')) {
                        this.currentSlider = $.extend({}, sl.alpha);
                    } else {
                        return false;
                    }
                    var offset = zone.offset();
                    //reference to guide's style
                    this.currentSlider.guide = zone.find('i')[0].style;
                    this.currentSlider.left = e.pageX - offset.left;
                    this.currentSlider.top = e.pageY - offset.top;
                    this.mousePointer = {
                        left: e.pageX,
                        top: e.pageY
                    };
                    //trigger mousemove to move the guide to the current position
                    $(document).on({
                        'mousemove.colorpicker': $.proxy(this.mousemove, this),
                        'mouseup.colorpicker': $.proxy(this.mouseup, this)
                    }).trigger('mousemove');
                }
                return false;
            },
            mousemove: function(e) {
                e.stopPropagation();
                e.preventDefault();
                var left = Math.max(
                    0,
                    Math.min(
                        this.currentSlider.maxLeft,
                        this.currentSlider.left + ((e.pageX || this.mousePointer.left) - this.mousePointer.left)
                    )
                );
                var top = Math.max(
                    0,
                    Math.min(
                        this.currentSlider.maxTop,
                        this.currentSlider.top + ((e.pageY || this.mousePointer.top) - this.mousePointer.top)
                    )
                );
                this.currentSlider.guide.left = left + 'px';
                this.currentSlider.guide.top = top + 'px';
                if (this.currentSlider.callLeft) {
                    this.color[this.currentSlider.callLeft].call(this.color, left / 100);
                }
                if (this.currentSlider.callTop) {
                    this.color[this.currentSlider.callTop].call(this.color, top / 100);
                }
                this.update(true);

                this.element.trigger({
                    type: 'changeColor',
                    color: this.color
                });
                return false;
            },
            mouseup: function(e) {
                e.stopPropagation();
                e.preventDefault();
                $(document).off({
                    'mousemove.colorpicker': this.mousemove,
                    'mouseup.colorpicker': this.mouseup
                });
                return false;
            },
            keyup: function(e) {
                if ((e.keyCode === 38)) {
                    if (this.color.value.a < 1) {
                        this.color.value.a = Math.round((this.color.value.a + 0.01) * 100) / 100;
                    }
                    this.update(true);
                } else if ((e.keyCode === 40)) {
                    if (this.color.value.a > 0) {
                        this.color.value.a = Math.round((this.color.value.a - 0.01) * 100) / 100;
                    }
                    this.update(true);
                } else {
                    var val = this.input.val();
                    this.color = new Color(val);
                    if (this.getValue(false) !== false) {
                        this.updateData();
                        this.updateComponent();
                        this.updatePicker();
                    }
                }
                this.element.trigger({
                    type: 'changeColor',
                    color: this.color,
                    value: val
                });
            }
        };

        $.colorpicker = Colorpicker;

        $.fn.colorpicker = function(option) {
            var pickerArgs = arguments;

            return this.each(function() {
                var $this = $(this),
                    inst = $this.data('colorpicker'),
                    options = ((typeof option === 'object') ? option : {});
                if ((!inst) && (typeof option !== 'string')) {
                    $this.data('colorpicker', new Colorpicker(this, options));
                } else {
                    if (typeof option === 'string') {
                        inst[option].apply(inst, Array.prototype.slice.call(pickerArgs, 1));
                    }
                }
            });
        };

        $.fn.colorpicker.constructor = Colorpicker;

    }));
