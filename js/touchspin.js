/**
 * Touchspin
 * Spinner
 * https://github.com/istvan-ujjmeszaros/bootstrap-touchspin
 * */
!function(t){"use strict";function o(t,o){return t+".touchspin_"+o}function n(n,s){return t.map(n,function(t){return o(t,s)})}var s=0;t.fn.TouchSpin=function(o){if("destroy"===o)return void this.each(function(){var o=t(this),s=o.data();t(document).off(n(["mouseup","touchend","touchcancel","mousemove","touchmove","scroll","scrollstart"],s.spinnerid).join(" "))});var i={min:0,max:100,initval:"",step:1,decimals:0,stepinterval:100,forcestepdivisibility:"round",stepintervaldelay:500,verticalbuttons:!1,verticalupclass:"glyphicon glyphicon-chevron-up",verticaldownclass:"glyphicon glyphicon-chevron-down",prefix:"",postfix:"",prefix_extraclass:"",postfix_extraclass:"",booster:!0,boostat:10,maxboostedstep:!1,mousewheel:!0,buttondown_class:"btn btn-default",buttonup_class:"btn btn-default"},a={min:"min",max:"max",initval:"init-val",step:"step",decimals:"decimals",stepinterval:"step-interval",verticalbuttons:"vertical-buttons",verticalupclass:"vertical-up-class",verticaldownclass:"vertical-down-class",forcestepdivisibility:"force-step-divisibility",stepintervaldelay:"step-interval-delay",prefix:"prefix",postfix:"postfix",prefix_extraclass:"prefix-extra-class",postfix_extraclass:"postfix-extra-class",booster:"booster",boostat:"boostat",maxboostedstep:"max-boosted-step",mousewheel:"mouse-wheel",buttondown_class:"button-down-class",buttonup_class:"button-up-class"};return this.each(function(){function e(){if(!E.data("alreadyinitialized")){if(E.data("alreadyinitialized",!0),s+=1,E.data("spinnerid",s),!E.is("input"))return void console.log("Must be an input.");r(),u(),w(),d(),b(),v(),m(),g(),P.input.css("display","block")}}function u(){""!==M.initval&&""===E.val()&&E.val(M.initval)}function p(t){l(t),w();var o=P.input.val();""!==o&&(o=Number(P.input.val()),P.input.val(o.toFixed(M.decimals)))}function r(){M=t.extend({},i,z,c(),o)}function c(){var o={};return t.each(a,function(t,n){var s="bts-"+n;E.is("[data-"+s+"]")&&(o[t]=E.data(s))}),o}function l(o){M=t.extend({},M,o)}function d(){var t=E.val(),o=E.parent();""!==t&&(t=Number(t).toFixed(M.decimals)),E.data("initvalue",t).val(t),E.addClass("form-control"),o.hasClass("input-group")?f(o):h()}function f(o){o.addClass("bootstrap-touchspin");var n,s,i=E.prev(),a=E.next(),e='<span class="input-group-addon bootstrap-touchspin-prefix">'+M.prefix+"</span>",u='<span class="input-group-addon bootstrap-touchspin-postfix">'+M.postfix+"</span>";i.hasClass("input-group-btn")?(n='<button class="'+M.buttondown_class+' bootstrap-touchspin-down" type="button">-</button>',i.append(n)):(n='<span class="input-group-btn"><button class="'+M.buttondown_class+' bootstrap-touchspin-down" type="button">-</button></span>',t(n).insertBefore(E)),a.hasClass("input-group-btn")?(s='<button class="'+M.buttonup_class+' bootstrap-touchspin-up" type="button">+</button>',a.prepend(s)):(s='<span class="input-group-btn"><button class="'+M.buttonup_class+' bootstrap-touchspin-up" type="button">+</button></span>',t(s).insertAfter(E)),t(e).insertBefore(E),t(u).insertAfter(E),N=o}function h(){var o;o=M.verticalbuttons?'<div class="input-group bootstrap-touchspin"><span class="input-group-addon bootstrap-touchspin-prefix">'+M.prefix+'</span><span class="input-group-addon bootstrap-touchspin-postfix">'+M.postfix+'</span><span class="input-group-btn-vertical"><button class="'+M.buttondown_class+' bootstrap-touchspin-up" type="button"><i class="'+M.verticalupclass+'"></i></button><button class="'+M.buttonup_class+' bootstrap-touchspin-down" type="button"><i class="'+M.verticaldownclass+'"></i></button></span></div>':'<div class="input-group bootstrap-touchspin"><span class="input-group-btn"><button class="'+M.buttondown_class+' bootstrap-touchspin-down" type="button">-</button></span><span class="input-group-addon bootstrap-touchspin-prefix">'+M.prefix+'</span><span class="input-group-addon bootstrap-touchspin-postfix">'+M.postfix+'</span><span class="input-group-btn"><button class="'+M.buttonup_class+' bootstrap-touchspin-up" type="button">+</button></span></div>',N=t(o).insertBefore(E),t(".bootstrap-touchspin-prefix",N).after(E),E.hasClass("input-sm")?N.addClass("input-group-sm"):E.hasClass("input-lg")&&N.addClass("input-group-lg")}function b(){P={down:t(".bootstrap-touchspin-down",N),up:t(".bootstrap-touchspin-up",N),input:t("input",N),prefix:t(".bootstrap-touchspin-prefix",N).addClass(M.prefix_extraclass),postfix:t(".bootstrap-touchspin-postfix",N).addClass(M.postfix_extraclass)}}function v(){""===M.prefix&&P.prefix.hide(),""===M.postfix&&P.postfix.hide()}function m(){E.on("keydown",function(t){var o=t.keyCode||t.which;38===o?("up"!==O&&(_(),k()),t.preventDefault()):40===o&&("down"!==O&&(C(),D()),t.preventDefault())}),E.on("keyup",function(t){var o=t.keyCode||t.which;38===o?F():40===o&&F()}),E.on("blur",function(){w()}),P.down.on("keydown",function(t){var o=t.keyCode||t.which;(32===o||13===o)&&("down"!==O&&(C(),D()),t.preventDefault())}),P.down.on("keyup",function(t){var o=t.keyCode||t.which;(32===o||13===o)&&F()}),P.up.on("keydown",function(t){var o=t.keyCode||t.which;(32===o||13===o)&&("up"!==O&&(_(),k()),t.preventDefault())}),P.up.on("keyup",function(t){var o=t.keyCode||t.which;(32===o||13===o)&&F()}),P.down.on("mousedown.touchspin",function(t){P.down.off("touchstart.touchspin"),E.is(":disabled")||(C(),D(),t.preventDefault(),t.stopPropagation())}),P.down.on("touchstart.touchspin",function(t){P.down.off("mousedown.touchspin"),E.is(":disabled")||(C(),D(),t.preventDefault(),t.stopPropagation())}),P.up.on("mousedown.touchspin",function(t){P.up.off("touchstart.touchspin"),E.is(":disabled")||(_(),k(),t.preventDefault(),t.stopPropagation())}),P.up.on("touchstart.touchspin",function(t){P.up.off("mousedown.touchspin"),E.is(":disabled")||(_(),k(),t.preventDefault(),t.stopPropagation())}),P.up.on("mouseout touchleave touchend touchcancel",function(t){O&&(t.stopPropagation(),F())}),P.down.on("mouseout touchleave touchend touchcancel",function(t){O&&(t.stopPropagation(),F())}),P.down.on("mousemove touchmove",function(t){O&&(t.stopPropagation(),t.preventDefault())}),P.up.on("mousemove touchmove",function(t){O&&(t.stopPropagation(),t.preventDefault())}),t(document).on(n(["mouseup","touchend","touchcancel"],s).join(" "),function(t){O&&(t.preventDefault(),F())}),t(document).on(n(["mousemove","touchmove","scroll","scrollstart"],s).join(" "),function(t){O&&(t.preventDefault(),F())}),E.on("mousewheel DOMMouseScroll",function(t){if(M.mousewheel&&E.is(":focus")){var o=t.originalEvent.wheelDelta||-t.originalEvent.deltaY||-t.originalEvent.detail;t.stopPropagation(),t.preventDefault(),0>o?C():_()}})}function g(){E.on("touchspin.uponce",function(){F(),_()}),E.on("touchspin.downonce",function(){F(),C()}),E.on("touchspin.startupspin",function(){k()}),E.on("touchspin.startdownspin",function(){D()}),E.on("touchspin.stopspin",function(){F()}),E.on("touchspin.updatesettings",function(t,o){p(o)})}function x(t){switch(M.forcestepdivisibility){case"round":return(Math.round(t/M.step)*M.step).toFixed(M.decimals);case"floor":return(Math.floor(t/M.step)*M.step).toFixed(M.decimals);case"ceil":return(Math.ceil(t/M.step)*M.step).toFixed(M.decimals);default:return t}}function w(){var t,o,n;t=E.val(),""!==t&&(M.decimals>0&&"."===t||(o=parseFloat(t),isNaN(o)&&(o=0),n=o,o.toString()!==t&&(n=o),o<M.min&&(n=M.min),o>M.max&&(n=M.max),n=x(n),Number(t).toString()!==n.toString()&&(E.val(n),E.trigger("change"))))}function y(){if(M.booster){var t=Math.pow(2,Math.floor(A/M.boostat))*M.step;return M.maxboostedstep&&t>M.maxboostedstep&&(t=M.maxboostedstep,S=Math.round(S/t)*t),Math.max(M.step,t)}return M.step}function _(){w(),S=parseFloat(P.input.val()),isNaN(S)&&(S=0);var t=S,o=y();S+=o,S>M.max&&(S=M.max,E.trigger("touchspin.on.max"),F()),P.input.val(Number(S).toFixed(M.decimals)),t!==S&&E.trigger("change")}function C(){w(),S=parseFloat(P.input.val()),isNaN(S)&&(S=0);var t=S,o=y();S-=o,S<M.min&&(S=M.min,E.trigger("touchspin.on.min"),F()),P.input.val(S.toFixed(M.decimals)),t!==S&&E.trigger("change")}function D(){F(),A=0,O="down",E.trigger("touchspin.on.startspin"),E.trigger("touchspin.on.startdownspin"),I=setTimeout(function(){T=setInterval(function(){A++,C()},M.stepinterval)},M.stepintervaldelay)}function k(){F(),A=0,O="up",E.trigger("touchspin.on.startspin"),E.trigger("touchspin.on.startupspin"),B=setTimeout(function(){j=setInterval(function(){A++,_()},M.stepinterval)},M.stepintervaldelay)}function F(){switch(clearTimeout(I),clearTimeout(B),clearInterval(T),clearInterval(j),O){case"up":E.trigger("touchspin.on.stopupspin"),E.trigger("touchspin.on.stopspin");break;case"down":E.trigger("touchspin.on.stopdownspin"),E.trigger("touchspin.on.stopspin")}A=0,O=!1}var M,N,P,S,T,j,I,B,E=t(this),z=E.data(),A=0,O=!1;e()})}}(jQuery);


(function(factory) {
  if (typeof define === 'function' && define.amd) {
    define(['jquery'], factory);
  } else if (typeof module === 'object' && module.exports) {
    module.exports = function(root, jQuery) {
      if (jQuery === undefined) {
        if (typeof window !== 'undefined') {
          jQuery = require('jquery');
        }
        else {
          jQuery = require('jquery')(root);
        }
      }
      factory(jQuery);
      return jQuery;
    };
  } else {
    factory(jQuery);
  }
}(function($) {
  'use strict';

  var _currentSpinnerId = 0;

  $.fn.TouchSpin = function(options) {

    var defaults = {
      min: 0, // If null, there is no minimum enforced
      max: 100, // If null, there is no maximum enforced
      initval: '',
      replacementval: '',
      step: 1,
      decimals: 0,
      stepinterval: 100,
      forcestepdivisibility: 'round', // none | floor | round | ceil
      stepintervaldelay: 500,
      verticalbuttons: false,
      verticalup: '+',
      verticaldown: '-',
      verticalupclass: '',
      verticaldownclass: '',
      prefix: '',
      postfix: '',
      prefix_extraclass: '',
      postfix_extraclass: '',
      booster: true,
      boostat: 10,
      maxboostedstep: false,
      mousewheel: true,
      buttondown_class: 'btn btn-primary',
      buttonup_class: 'btn btn-primary',
      buttondown_txt: '-',
      buttonup_txt: '+',
      callback_before_calculation: function(value) {
        return value;
      },
      callback_after_calculation: function(value) {
        return value;
      }
    };

    var attributeMap = {
      min: 'min',
      max: 'max',
      initval: 'init-val',
      replacementval: 'replacement-val',
      step: 'step',
      decimals: 'decimals',
      stepinterval: 'step-interval',
      verticalbuttons: 'vertical-buttons',
      verticalupclass: 'vertical-up-class',
      verticaldownclass: 'vertical-down-class',
      forcestepdivisibility: 'force-step-divisibility',
      stepintervaldelay: 'step-interval-delay',
      prefix: 'prefix',
      postfix: 'postfix',
      prefix_extraclass: 'prefix-extra-class',
      postfix_extraclass: 'postfix-extra-class',
      booster: 'booster',
      boostat: 'boostat',
      maxboostedstep: 'max-boosted-step',
      mousewheel: 'mouse-wheel',
      buttondown_class: 'button-down-class',
      buttonup_class: 'button-up-class',
      buttondown_txt: 'button-down-txt',
      buttonup_txt: 'button-up-txt'
    };

    return this.each(function() {

      var settings,
        originalinput = $(this),
        originalinput_data = originalinput.data(),
        _detached_prefix,
        _detached_postfix,
        container,
        elements,
        value,
        downSpinTimer,
        upSpinTimer,
        downDelayTimeout,
        upDelayTimeout,
        spincount = 0,
        spinning = false;

      init();

      function init() {
        if (originalinput.data('alreadyinitialized')) {
          return;
        }

        originalinput.data('alreadyinitialized', true);
        _currentSpinnerId += 1;
        originalinput.data('spinnerid', _currentSpinnerId);

        if (!originalinput.is('input')) {
          console.log('Must be an input.');
          return;
        }

        _initSettings();
        _setInitval();
        _checkValue();
        _buildHtml();
        _initElements();
        _hideEmptyPrefixPostfix();
        _bindEvents();
        _bindEventsInterface();
      }

      function _setInitval() {
        if (settings.initval !== '' && originalinput.val() === '') {
          originalinput.val(settings.initval);
        }
      }

      function changeSettings(newsettings) {
        _updateSettings(newsettings);
        _checkValue();

        var value = elements.input.val();

        if (value !== '') {
          value = Number(settings.callback_before_calculation(elements.input.val()));
          elements.input.val(settings.callback_after_calculation(Number(value).toFixed(settings.decimals)));
        }
      }

      function _initSettings() {
        settings = $.extend({}, defaults, originalinput_data, _parseAttributes(), options);
      }

      function _parseAttributes() {
        var data = {};
        $.each(attributeMap, function(key, value) {
          var attrName = 'bts-' + value + '';
          if (originalinput.is('[data-' + attrName + ']')) {
            data[key] = originalinput.data(attrName);
          }
        });
        return data;
      }

      function _destroy() {
        var $parent = originalinput.parent();

        stopSpin();

        originalinput.off('.touchspin');

        if ($parent.hasClass('bootstrap-touchspin-injected')) {
          originalinput.siblings().remove();
          originalinput.unwrap();
        }
        else {
          $('.bootstrap-touchspin-injected', $parent).remove();
          $parent.removeClass('bootstrap-touchspin');
        }

        originalinput.data('alreadyinitialized', false);
      }

      function _updateSettings(newsettings) {
        settings = $.extend({}, settings, newsettings);

        // Update postfix and prefix texts if those settings were changed.
        if (newsettings.postfix) {
          var $postfix = originalinput.parent().find('.bootstrap-touchspin-postfix');

          if ($postfix.length === 0) {
            _detached_postfix.insertAfter(originalinput);
          }

          originalinput.parent().find('.bootstrap-touchspin-postfix .input-group-text').text(newsettings.postfix);
        }

        if (newsettings.prefix) {
          var $prefix = originalinput.parent().find('.bootstrap-touchspin-prefix');

          if ($prefix.length === 0) {
            _detached_prefix.insertBefore(originalinput);
          }

          originalinput.parent().find('.bootstrap-touchspin-prefix .input-group-text').text(newsettings.prefix);
        }

        _hideEmptyPrefixPostfix();
      }

      function _buildHtml() {
        var initval = originalinput.val(),
          parentelement = originalinput.parent();

        if (initval !== '') {
          initval = settings.callback_after_calculation(Number(initval).toFixed(settings.decimals));
        }

        originalinput.data('initvalue', initval).val(initval);
        originalinput.addClass('form-control');

        if (parentelement.hasClass('input-group')) {
          _advanceInputGroup(parentelement);
        }
        else {
          _buildInputGroup();
        }
      }

      function _advanceInputGroup(parentelement) {
        parentelement.addClass('bootstrap-touchspin');

        var prev = originalinput.prev(),
          next = originalinput.next();

        var downhtml,
          uphtml,
          prefixhtml = '<span class="input-group-addon input-group-prepend bootstrap-touchspin-prefix input-group-prepend bootstrap-touchspin-injected"><span class="input-group-text">' + settings.prefix + '</span></span>',
          postfixhtml = '<span class="input-group-addon input-group-append bootstrap-touchspin-postfix input-group-append bootstrap-touchspin-injected"><span class="input-group-text">' + settings.postfix + '</span></span>';

        if (prev.hasClass('input-group-btn') || prev.hasClass('input-group-prepend')) {
          downhtml = '<button class="' + settings.buttondown_class + ' bootstrap-touchspin-down bootstrap-touchspin-injected" type="button">' + settings.buttondown_txt + '</button>';
          prev.append(downhtml);
        }
        else {
          downhtml = '<span class="input-group-btn input-group-prepend bootstrap-touchspin-injected"><button class="' + settings.buttondown_class + ' bootstrap-touchspin-down" type="button">' + settings.buttondown_txt + '</button></span>';
          $(downhtml).insertBefore(originalinput);
        }

        if (next.hasClass('input-group-btn') || next.hasClass('input-group-append')) {
          uphtml = '<button class="' + settings.buttonup_class + ' bootstrap-touchspin-up bootstrap-touchspin-injected" type="button">' + settings.buttonup_txt + '</button>';
          next.prepend(uphtml);
        }
        else {
          uphtml = '<span class="input-group-btn input-group-append bootstrap-touchspin-injected"><button class="' + settings.buttonup_class + ' bootstrap-touchspin-up" type="button">' + settings.buttonup_txt + '</button></span>';
          $(uphtml).insertAfter(originalinput);
        }

        $(prefixhtml).insertBefore(originalinput);
        $(postfixhtml).insertAfter(originalinput);

        container = parentelement;
      }

      function _buildInputGroup() {
        var html;

        var inputGroupSize = '';
        if (originalinput.hasClass('input-sm')) {
          inputGroupSize = 'input-group-sm';
        }

        if (originalinput.hasClass('input-lg')) {
          inputGroupSize = 'input-group-lg';
        }

        if (settings.verticalbuttons) {
          html = '<div class="input-group ' + inputGroupSize + ' bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-addon input-group-prepend bootstrap-touchspin-prefix"><span class="input-group-text">' + settings.prefix + '</span></span><span class="input-group-addon bootstrap-touchspin-postfix input-group-append"><span class="input-group-text">' + settings.postfix + '</span></span><span class="input-group-btn-vertical"><button class="' + settings.buttondown_class + ' bootstrap-touchspin-up ' + settings.verticalupclass + '" type="button">' + settings.verticalup + '</button><button class="' + settings.buttonup_class + ' bootstrap-touchspin-down ' + settings.verticaldownclass + '" type="button">' + settings.verticaldown + '</button></span></div>';
        }
        else {
          html = '<div class="input-group bootstrap-touchspin bootstrap-touchspin-injected"><span class="input-group-btn input-group-prepend"><button class="' + settings.buttondown_class + ' bootstrap-touchspin-down" type="button">' + settings.buttondown_txt + '</button></span><span class="input-group-addon bootstrap-touchspin-prefix input-group-prepend"><span class="input-group-text">' + settings.prefix + '</span></span><span class="input-group-addon bootstrap-touchspin-postfix input-group-append"><span class="input-group-text">' + settings.postfix + '</span></span><span class="input-group-btn input-group-append"><button class="' + settings.buttonup_class + ' bootstrap-touchspin-up" type="button">' + settings.buttonup_txt + '</button></span></div>';
        }

        container = $(html).insertBefore(originalinput);

        $('.bootstrap-touchspin-prefix', container).after(originalinput);

        if (originalinput.hasClass('input-sm')) {
          container.addClass('input-group-sm');
        }
        else if (originalinput.hasClass('input-lg')) {
          container.addClass('input-group-lg');
        }
      }

      function _initElements() {
        elements = {
          down: $('.bootstrap-touchspin-down', container),
          up: $('.bootstrap-touchspin-up', container),
          input: $('input', container),
          prefix: $('.bootstrap-touchspin-prefix', container).addClass(settings.prefix_extraclass),
          postfix: $('.bootstrap-touchspin-postfix', container).addClass(settings.postfix_extraclass)
        };
      }

      function _hideEmptyPrefixPostfix() {
        if (settings.prefix === '') {
          _detached_prefix = elements.prefix.detach();
        }

        if (settings.postfix === '') {
          _detached_postfix = elements.postfix.detach();
        }
      }

      function _bindEvents() {
        originalinput.on('keydown.touchspin', function(ev) {
          var code = ev.keyCode || ev.which;

          if (code === 38) {
            if (spinning !== 'up') {
              upOnce();
              startUpSpin();
            }
            ev.preventDefault();
          }
          else if (code === 40) {
            if (spinning !== 'down') {
              downOnce();
              startDownSpin();
            }
            ev.preventDefault();
          }
        });

        originalinput.on('keyup.touchspin', function(ev) {
          var code = ev.keyCode || ev.which;

          if (code === 38) {
            stopSpin();
          }
          else if (code === 40) {
            stopSpin();
          }
        });

        originalinput.on('blur.touchspin', function() {
          _checkValue();
          originalinput.val(settings.callback_after_calculation(originalinput.val()));
        });

        elements.down.on('keydown', function(ev) {
          var code = ev.keyCode || ev.which;

          if (code === 32 || code === 13) {
            if (spinning !== 'down') {
              downOnce();
              startDownSpin();
            }
            ev.preventDefault();
          }
        });

        elements.down.on('keyup.touchspin', function(ev) {
          var code = ev.keyCode || ev.which;

          if (code === 32 || code === 13) {
            stopSpin();
          }
        });

        elements.up.on('keydown.touchspin', function(ev) {
          var code = ev.keyCode || ev.which;

          if (code === 32 || code === 13) {
            if (spinning !== 'up') {
              upOnce();
              startUpSpin();
            }
            ev.preventDefault();
          }
        });

        elements.up.on('keyup.touchspin', function(ev) {
          var code = ev.keyCode || ev.which;

          if (code === 32 || code === 13) {
            stopSpin();
          }
        });

        elements.down.on('mousedown.touchspin', function(ev) {
          elements.down.off('touchstart.touchspin');  // android 4 workaround

          if (originalinput.is(':disabled')) {
            return;
          }

          downOnce();
          startDownSpin();

          ev.preventDefault();
          ev.stopPropagation();
        });

        elements.down.on('touchstart.touchspin', function(ev) {
          elements.down.off('mousedown.touchspin');  // android 4 workaround

          if (originalinput.is(':disabled')) {
            return;
          }

          downOnce();
          startDownSpin();

          ev.preventDefault();
          ev.stopPropagation();
        });

        elements.up.on('mousedown.touchspin', function(ev) {
          elements.up.off('touchstart.touchspin');  // android 4 workaround

          if (originalinput.is(':disabled')) {
            return;
          }

          upOnce();
          startUpSpin();

          ev.preventDefault();
          ev.stopPropagation();
        });

        elements.up.on('touchstart.touchspin', function(ev) {
          elements.up.off('mousedown.touchspin');  // android 4 workaround

          if (originalinput.is(':disabled')) {
            return;
          }

          upOnce();
          startUpSpin();

          ev.preventDefault();
          ev.stopPropagation();
        });

        elements.up.on('mouseup.touchspin mouseout.touchspin touchleave.touchspin touchend.touchspin touchcancel.touchspin', function(ev) {
          if (!spinning) {
            return;
          }

          ev.stopPropagation();
          stopSpin();
        });

        elements.down.on('mouseup.touchspin mouseout.touchspin touchleave.touchspin touchend.touchspin touchcancel.touchspin', function(ev) {
          if (!spinning) {
            return;
          }

          ev.stopPropagation();
          stopSpin();
        });

        elements.down.on('mousemove.touchspin touchmove.touchspin', function(ev) {
          if (!spinning) {
            return;
          }

          ev.stopPropagation();
          ev.preventDefault();
        });

        elements.up.on('mousemove.touchspin touchmove.touchspin', function(ev) {
          if (!spinning) {
            return;
          }

          ev.stopPropagation();
          ev.preventDefault();
        });

        originalinput.on('mousewheel.touchspin DOMMouseScroll.touchspin', function(ev) {
          if (!settings.mousewheel || !originalinput.is(':focus')) {
            return;
          }

          var delta = ev.originalEvent.wheelDelta || -ev.originalEvent.deltaY || -ev.originalEvent.detail;

          ev.stopPropagation();
          ev.preventDefault();

          if (delta < 0) {
            downOnce();
          }
          else {
            upOnce();
          }
        });
      }

      function _bindEventsInterface() {
        originalinput.on('touchspin.destroy', function() {
          _destroy();
        });

        originalinput.on('touchspin.uponce', function() {
          stopSpin();
          upOnce();
        });

        originalinput.on('touchspin.downonce', function() {
          stopSpin();
          downOnce();
        });

        originalinput.on('touchspin.startupspin', function() {
          startUpSpin();
        });

        originalinput.on('touchspin.startdownspin', function() {
          startDownSpin();
        });

        originalinput.on('touchspin.stopspin', function() {
          stopSpin();
        });

        originalinput.on('touchspin.updatesettings', function(e, newsettings) {
          changeSettings(newsettings);
        });
      }

      function _forcestepdivisibility(value) {
        switch (settings.forcestepdivisibility) {
          case 'round':
            return (Math.round(value / settings.step) * settings.step).toFixed(settings.decimals);
          case 'floor':
            return (Math.floor(value / settings.step) * settings.step).toFixed(settings.decimals);
          case 'ceil':
            return (Math.ceil(value / settings.step) * settings.step).toFixed(settings.decimals);
          default:
            return value;
        }
      }

      function _checkValue() {
        var val, parsedval, returnval;

        val = settings.callback_before_calculation(originalinput.val());

        if (val === '') {
          if (settings.replacementval !== '') {
            originalinput.val(settings.replacementval);
            originalinput.trigger('change');
          }
          return;
        }

        if (settings.decimals > 0 && val === '.') {
          return;
        }

        parsedval = parseFloat(val);

        if (isNaN(parsedval)) {
          if (settings.replacementval !== '') {
            parsedval = settings.replacementval;
          }
          else {
            parsedval = 0;
          }
        }

        returnval = parsedval;

        if (parsedval.toString() !== val) {
          returnval = parsedval;
        }

        if ((settings.min !== null) && (parsedval < settings.min)) {
          returnval = settings.min;
        }

        if ((settings.max !== null) && (parsedval > settings.max)) {
          returnval = settings.max;
        }

        returnval = _forcestepdivisibility(returnval);

        if (Number(val).toString() !== returnval.toString()) {
          originalinput.val(returnval);
          originalinput.trigger('change');
        }
      }

      function _getBoostedStep() {
        if (!settings.booster) {
          return settings.step;
        }
        else {
          var boosted = Math.pow(2, Math.floor(spincount / settings.boostat)) * settings.step;

          if (settings.maxboostedstep) {
            if (boosted > settings.maxboostedstep) {
              boosted = settings.maxboostedstep;
              value = Math.round((value / boosted)) * boosted;
            }
          }

          return Math.max(settings.step, boosted);
        }
      }

      function upOnce() {
        _checkValue();

        value = parseFloat(settings.callback_before_calculation(elements.input.val()));
        if (isNaN(value)) {
          value = 0;
        }

        var initvalue = value,
          boostedstep = _getBoostedStep();

        value = value + boostedstep;

        if ((settings.max !== null) && (value > settings.max)) {
          value = settings.max;
          originalinput.trigger('touchspin.on.max');
          stopSpin();
        }

        elements.input.val(settings.callback_after_calculation(Number(value).toFixed(settings.decimals)));

        if (initvalue !== value) {
          originalinput.trigger('change');
        }
      }

      function downOnce() {
        _checkValue();

        value = parseFloat(settings.callback_before_calculation(elements.input.val()));
        if (isNaN(value)) {
          value = 0;
        }

        var initvalue = value,
          boostedstep = _getBoostedStep();

        value = value - boostedstep;

        if ((settings.min !== null) && (value < settings.min)) {
          value = settings.min;
          originalinput.trigger('touchspin.on.min');
          stopSpin();
        }

        elements.input.val(settings.callback_after_calculation(Number(value).toFixed(settings.decimals)));

        if (initvalue !== value) {
          originalinput.trigger('change');
        }
      }

      function startDownSpin() {
        stopSpin();

        spincount = 0;
        spinning = 'down';

        originalinput.trigger('touchspin.on.startspin');
        originalinput.trigger('touchspin.on.startdownspin');

        downDelayTimeout = setTimeout(function() {
          downSpinTimer = setInterval(function() {
            spincount++;
            downOnce();
          }, settings.stepinterval);
        }, settings.stepintervaldelay);
      }

      function startUpSpin() {
        stopSpin();

        spincount = 0;
        spinning = 'up';

        originalinput.trigger('touchspin.on.startspin');
        originalinput.trigger('touchspin.on.startupspin');

        upDelayTimeout = setTimeout(function() {
          upSpinTimer = setInterval(function() {
            spincount++;
            upOnce();
          }, settings.stepinterval);
        }, settings.stepintervaldelay);
      }

      function stopSpin() {
        clearTimeout(downDelayTimeout);
        clearTimeout(upDelayTimeout);
        clearInterval(downSpinTimer);
        clearInterval(upSpinTimer);

        switch (spinning) {
          case 'up':
            originalinput.trigger('touchspin.on.stopupspin');
            originalinput.trigger('touchspin.on.stopspin');
            break;
          case 'down':
            originalinput.trigger('touchspin.on.stopdownspin');
            originalinput.trigger('touchspin.on.stopspin');
            break;
        }

        spincount = 0;
        spinning = false;
      }

    });

  };

}));
