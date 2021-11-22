
$(document).on('change','#cal-filter',function(){
   /// $('.fullcalendar-holder').fullCalendar('rerenderEvents');
     $('.fullcalendar-holder').fullCalendar( 'refetchEvents' ); 
})

jQuery(function () {

  initFullcalendar();
});
function initFullcalendar() {
  var win = jQuery(window);
  var resizeTimer; //Initialize FC

  jQuery('.fullcalendar-holder').each(function () {
      console.log('ar');
    var $calendar = jQuery(this);
    $calendar.fullCalendar(getOptions($calendar));
    console.log( $calendar);
    getPopupTemplate($calendar);
    onWindowChange($calendar);
  });
  /**
   * @param $calendar
   */

  function getPopupTemplate($calendar) {
    var popupId = $calendar.data('popup-id');

    if (popupId) {
      var popupHtml = $(popupId).html();
      var $popup = $(popupHtml);
      $calendar.data('popup-element', $popup);
      var $form = $popup.find('form');

      if ($form && $form.attr('action')) {
        $calendar.data('popup-form-action', $form.attr('action'));
      }
    }
  }
  /**
   * @param $calendar
   *
   */


  function getOptions($calendar) {
    console.log('getOptions');
    var options = {
      timezone: 'local', 
      header: {
        left: 'title',
        center: 'agendaDay agendaWeek',
        right: 'prev today next'
      },
      themeSystem: 'bootstrap4',
      defaultView: 'agendaWeek',
      slotLabelFormat: 'HH:mm',
      allDaySlot: false,
      contentHeight: 'auto',
      views: {
        month: {
          titleFormat: 'MMMM YYYY',
          columnFormat: 'dddd'
        },
        week: {
          titleFormat: 'MMMM YYYY [##Week] w',
          slotDuration: '00:60:00' //columnFormat: '[<span class="date-item">]DD/MM[</span>] dddd',

        },
        day: {
          titleFormat: 'DD MMMM YYYY',
          slotDuration: '00:60:00'
        }
      },
      eventStartEditable: false,
      selectable: $calendar.data('selectable') || true,
      unselectCancel: '.popup-select',
      events: function events(start, end, timezone, callback) {
        _events(start, end, timezone, callback, $calendar.data('events-url'), $calendar);
      },
      viewRender: function viewRender(view) {
 
        _viewRender(view);
      },
      eventRender: function eventRender(event, element, view) {
        _eventRender(event, element, view);
      },
      eventAfterAllRender: function eventAfterAllRender(view) {
        _eventAfterAllRender(view);
      },
      eventClick: function eventClick(event, jsEvent, view) {
        _eventClick(event, jsEvent, view);

        $('body').trigger('click_event.fullcalendar', [event, jsEvent, view]);
      },
      selectOverlap: function selectOverlap(event) {
        return event.rendering === 'background';
      },
      select: function select(start, end, jsEvent, view) {
        _select(start, end, jsEvent, view);
      },
      unselect: function unselect(jsEvent, view) {
        _unselect(jsEvent, view);
      },
      selectAllow: function selectAllow(selectInfo) {
        return selectInfo.start >= moment();
      },
      dayClick: function dayClick(date, jsEvent, view) {
        _dayClick(date, jsEvent, view);
      }
    }; //Locale

    if ($calendar.data('locale')) {
      options = jQuery.extend(true, {}, options, {
        locale: $calendar.data('locale')
      });
    } //Header


    if ($calendar.data('time-unit') === 'day') {
      // options = jQuery.extend(true, {}, options, { timezone: 'UTC' });
      options = jQuery.extend(true, {}, options, {
        defaultView: 'month'
      });
      options = jQuery.extend(true, {}, options, {
        header: {
          center: ''
        }
      });
    }

    if ($calendar.data('show-header') === false) {
      options = jQuery.extend(true, {}, options, {
        header: false
      });
      setTimeout(function () {
        $calendar.find('.fc-toolbar').remove();
      }, 10);
    } //Week view


    if ($calendar.data('show-date-on-week-view') === false) {
      options = jQuery.extend(true, {}, options, {
        views: {
          week: {
            columnFormat: 'dddd'
          }
        }
      });
    }

    if (typeof $calendar.data('horizontal-select') !== 'undefined') {
      options = jQuery.extend(true, {}, options, {
        views: {
          week: {
            horizontalSelect: $calendar.data('horizontal-select')
          }
        }
      });
    } //height


    if ($calendar.data('height')) {
      options = jQuery.extend(true, {}, options, {
        contentHeight: $calendar.data('height')
      });
    } else {
      $calendar.addClass('no-scroll');
    }

    if (typeof $calendar.data('selectable') !== 'undefined') {
      options = jQuery.extend(true, {}, options, {
        selectable: $calendar.data('selectable')
      });
    }

    return options;
  }

  function _events(start, end, timezone, callback, eventsUrl, $calendar) {
 
    if (eventsUrl) {
      if ($('#cal-filter').length)  { 
          eventsUrl = eventsUrl.replace('filter-val', $('#cal-filter').val());
       }
       else {
         eventsUrl = eventsUrl.replace('filter-val',''); 
          }
      eventsUrl = eventsUrl.replace('1971-05-29', moment(start).format('YYYY-MM-DD'));
      eventsUrl = eventsUrl.replace('1971-05-30', moment(end).format('YYYY-MM-DD'));
     
      $.ajax({
        url: eventsUrl,
        type: 'GET',
        dataType: 'json',
        success: function success(events) {
          var today = new Date();
          var startToday = moment(today).format('YYYY-MM-DD 00:00');
          var startUTC = moment(today).format('YYYY-MM-DD 00:00'); // var remainder = 60 - (moment(today).minute() % 60) -1;
          //var startUTC = moment(today).tz('UTC').format('YYYY-MM-DD 00:00'); // var remainder = 60 - (moment(today).minute() % 60) -1;

          var endToday = moment(today).format("YYYY-MM-DD HH:59");
          //var endUTC = moment(today).tz('UTC');
          var endUTC = moment(today);
          endUTC = moment(endUTC).format("YYYY-MM-DD HH:59"); 
          /*var view = $calendar.data('fullCalendar').initialView; 
          if (view.type === 'agendaWeek' || view.type === 'agendaDay') {
            var scrollTime = null;
            var _iteratorNormalCompletion = true;
            var _didIteratorError = false;
            var _iteratorError = undefined;

            try {
              for (var _iterator = events[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
                var event = _step.value;

                if (scrollTime === null || moment(event.start).format('HH:mm') < scrollTime) {
                  scrollTime = moment(event.start).format('HH:mm');
                }
              }
            } catch (err) {
              _didIteratorError = true;
              _iteratorError = err;
            } finally {
              try {
                if (!_iteratorNormalCompletion && _iterator.return != null) {
                  _iterator.return();
                }
              } finally {
                if (_didIteratorError) {
                  throw _iteratorError;
                }
              }
            }

            if (scrollTime) {
              view.options.scrollTime = scrollTime;
              view.scroller.setScrollTop(view.computeInitialDateScroll().top);
            }
          }*/
 
          events.unshift({
            allDay: false,
            id: 'pasttimeid',
            start: startToday,
            startUTC: startUTC,
            end: endToday,
            endUTC: endUTC,
            rendering: 'background',
            editable: false,
            title: " ",
            className: "past-hour-event",
            source:''
          });
          callback(events);
        }
      });
    }
  }
  /**
   * @param view
   */


  function _viewRender(view) {
      console.log('view.calendar');
     //console.log(view.el);
    var $calendarHeader =  view.el;

    if ($calendarHeader) {
      var $title = $calendarHeader.find('h2');

      if (view.type === 'agendaWeek') {
        var titleParts = view.title.split('##');
        $title.html(titleParts[0] + ' <span class="week-number text-blue">' + titleParts[1] + '</span>');
        var columnTitles = view.el.find('.fc-day-header span');
        columnTitles.each(function () {
          var item = jQuery(this);
          item.html(item.text());
        });
      } // [data - sticky - nav];


      if ($calendarHeader) {
        $title.addClass('js-header-title');
      }
    }
  }
  /**
   * @param event
   * @param element
   * @param view
   */


  function _eventRender(event, element, view) {
     console.log('eventRender');
    var $calendar = view.el;
    var title = event.title;

    if (view.type === 'month' && $calendar.data('time-unit') === 'hour') {
      title += ' : ' + moment(event.start).format('HH:mm') + '-' + moment(event.end).format('HH:mm');
    }

    element.html(title);
    element.addClass(event.className);
   /* if ($('#cal-filter').length)
        {
         event = ['all', event.className].indexOf($('#cal-filter').val()) >= 0
        }
   */
    $('body').trigger('render.event.fullcalendar', [element, event]);
  }
  /**
   * @param view
   */


  function _eventAfterAllRender(view) {
      console.log('eventAfterAllRender');
    initPopup(view);
  }

  function _eventClick(event, jsEvent, view) {
     console.log('sourcecheck_eventClick'); 
   
      console.log('eventClick');
    // do not show popup form if the event is not editable
    if (!event.editable || !event.form) return;
    var $popup = setPopupFormAction(view, moment(event.startUTC), moment(event.endUTC), event);
    var eventElt = $(jsEvent.target);

    if ($popup) {
      setPopupPosition($popup, view, eventElt);
      win.on('resize.popup-position orientationchange.popup-position', function () {
        setPopupPosition($popup, view, eventElt);
      });
    }
  }
  /**
   * @param start
   * @param end
   * @param jsEvent
   * @param view
   */


  function _select(start, end, jsEvent, view) {
      console.log('select');
    var $calendar = view.el;
    var event = getBackgroundEvent($calendar, start, end);

    if (start.isBefore(moment()) || event && event.editable === false) {
      $calendar.fullCalendar('unselect');
      return;
    }
 
    var $popup = setPopupFormAction(view, moment(start).utc(), moment(end).utc(),event,event.status);
    var eventElt = $(jsEvent.target);
    setPopupPosition($popup, view, eventElt);
    win.on('resize.popup-position orientationchange.popup-position', function () {
      setPopupPosition($popup, view, eventElt);
    });
  }
  /**
   * Get event corresponding to clicked background event
   *
   * @param $calendar
   * @param start
   * @param end
   * @returns {null}
   */


  function getBackgroundEvent($calendar, start, end) {
    var events = $calendar.fullCalendar('clientEvents'); //get all in-memory events

    var startD = moment(start).utc();
    var endD = moment(end).utc();
    var _iteratorNormalCompletion2 = true;
    var _didIteratorError2 = false;
    var _iteratorError2 = undefined;

    try {
      for (var _iterator2 = events[Symbol.iterator](), _step2; !(_iteratorNormalCompletion2 = (_step2 = _iterator2.next()).done); _iteratorNormalCompletion2 = true) {
        var event = _step2.value;

        if (event.rendering !== 'background') {
          continue;
        }

        if (!event.end) {
          if (startD.isSame(event.start)) {
            return event;
          }
        } else if (startD.isSameOrBefore(event.end) && endD.isSameOrAfter(event.start)) {
          return event;
        }
      }
    } catch (err) {
      _didIteratorError2 = true;
      _iteratorError2 = err;
    } finally {
      try {
        if (!_iteratorNormalCompletion2 && _iterator2.return != null) {
          _iterator2.return();
        }
      } finally {
        if (_didIteratorError2) {
          throw _iteratorError2;
        }
      }
    }

    return null;
  }
  /**
   *
   * @param jsEvent
   * @param view
   */


  function _unselect(jsEvent, view) {
    // console.log('unselect');
    var calendarElt = view.el;

    if (calendarElt.data('calendar-mode') === 'status-mode' || calendarElt.data('calendar-mode') === 'price-mode') {
      if (calendarElt.data('popup-element')) {
        if (typeof calendarElt.data('popup-element').data('hide-popup') == 'function') {
          calendarElt.data('popup-element').data('hide-popup')();
        } else {
          calendarElt.data('popup-element').removeClass('popup-active');
          win.off('.popup-position');
        }
      }
    }
  }

  function _dayClick(startDate, jsEvent, view) {

      var sourcecheck =0;
      $('.fullcalendar-holder').fullCalendar('clientEvents', function(event) {
          if (startDate.isSame(event.start)) { 
           sourcecheck =1;
         }
         //console.log('else===');
      });


    if (startDate.isBefore(moment())) {
      return;
    }

    var $calendar = $(view.el);

    if (!$calendar.data('duration')) {
      return;
    }

    var endDate = moment(startDate).add($calendar.data('duration'), 'minutes');
 
  console.log('sourcecheck'); 
  console.log(sourcecheck); 
    var $popup = setPopupFormAction(view, moment(startDate).utc(), moment(endDate).utc(),null,sourcecheck);
    var eventElt = $(jsEvent.target);
    setPopupPosition($popup, view, eventElt, jsEvent);
    win.on('resize.popup-position orientationchange.popup-position', function () {
      setPopupPosition($popup, view, eventElt);
    });
  }
  /**
   * @param view
   */


  function initPopup(view) {
     console.log('initPopup');
     console.log('initPopup');
    var $calendar = view.el;
    var $popup = $calendar.data('popup-element');

    if (!$popup) {
      return;
    }

    var skeleton = view.scroller.el.find('.fc-content-skeleton');
    var simplebarContent = skeleton.closest('.simplebar-content');
    view.skeleton = skeleton;
    view.simplebarContent = simplebarContent;

    if (view.type === 'agendaWeek' || view.type === 'agendaDay') {
      if (simplebarContent.length) {
        simplebarContent.append($popup);
      } else {
        $popup.insertAfter(view.timeGrid.el);
      }
    } else if (view.type === 'month') {
      view.scroller.el.append($popup);
    }

    $popup.find('.btn-select-save').off('.popup-select').on('click.popup-select', function (e) {
      e.preventDefault();
      $popup.find('form').ajaxSubmit({
        success: function success() {
          $calendar.fullCalendar('refetchEvents');
        }
      });
      hidePopup();
    });
    $popup.find('.btn-select-cancel').off('.popup-select').on('click', function (e) {
      e.preventDefault();
      hidePopup();
    });
    Object(_customSelect__WEBPACK_IMPORTED_MODULE_2__["default"])($popup);
    $popup.data('hide-popup', hidePopup);

    function hidePopup() {
      $popup.removeClass('popup-active');
      setTimeout(function () {
        var $selectStatus = $popup.find('[data-select-status]');
        var $inputPrice = $popup.find('[data-input-price]');

        if ($selectStatus.length) {
          $selectStatus[0].selectedIndex = 0;
          $selectStatus.trigger('change');
        }

        if ($inputPrice.length) {
          $inputPrice.val($inputPrice[0].defaultValue);
        }
      }, 20);
      win.off('.popup-position');
    }
  }

  function setPopupFormAction(view, start, end, event,sourcecheck) {
    // console.log('setPopupFormAction');
    var $calendar = view.el;
    var action = $calendar.data('popup-form-action');
    var $popup = $calendar.data('popup-element');

    if (!$popup) {
      return;
    }

    var $form = $popup.find('form');

    if ($form && action) {
      action = action.replace('1970-01-01', start.format('YYYY-MM-DD'));
      action = action.replace('1970-01-02', end.format('YYYY-MM-DD'));
      action = action.replace('00:01', start.format('HH:mm'));
      action = action.replace('00:02', end.format('HH:mm'));
      $form.attr('action', action);
     $("#cal-source").text("");
      if(sourcecheck !=null){
        $("#cal-source").text("although changed in the fairbnb calendar, it is still blocked to  calendar "+sourcecheck);
      }
      
      if (event && event.form) {
        for (var _i = 0, _Object$entries = Object.entries(event.form); _i < _Object$entries.length; _i++) {
          var _Object$entries$_i = _slicedToArray(_Object$entries[_i], 2),
              fieldName = _Object$entries$_i[0],
              fieldValue = _Object$entries$_i[1];

          var $field = $form.find("[name*=\"[".concat(fieldName, "]\"]"));

          if ($field.length) {
            $field.val(fieldValue);
          }
        }
      } else {
        $form[0].reset();
      }

      $form.find('.js-custom-select').trigger('change');
    }

    return $popup;
  }

  function setPopupPosition($popup, view, eventElt, jsEvent) {
    // console.log('setPopupPosition');
    var offsetParent = eventElt.offsetParent();
    var eventHeight = eventElt.height();
    var eventPosition = eventElt.position();
    $popup.addClass('popup-active').removeClass('position-bottom').removeClass('position-left-over').removeClass('position-right-over').css({
      marginTop: '',
      marginLeft: ''
    });

    if (view.type === 'agendaWeek' || view.type === 'agendaDay') {
      var skeletonOffset = view.skeleton.offset();
      $popup.css({
        top: eventPosition.top + eventHeight - (jsEvent ? 0 : view.timeGrid.slatEls.eq(0).outerHeight() / 2) - $popup.outerHeight(),
        left: jsEvent ? jsEvent.pageX - skeletonOffset.left - $popup.outerWidth() / 2 : offsetParent.offset().left - skeletonOffset.left + eventElt.outerWidth() / 2 - $popup.outerWidth() / 2
      });

      if ($popup.offset().left - skeletonOffset.left < 0) {
        $popup.addClass('position-left-over').css({
          marginLeft: $popup.outerWidth() / 2
        });
      }

      if (skeletonOffset.left + view.skeleton.width() - ($popup.offset().left + $popup.width()) < 0) {
        $popup.addClass('position-right-over').css({
          marginLeft: -$popup.outerWidth() / 2
        });
      }
    } else if (view.type === 'month') {
      $popup.css({
        top: eventElt.offset().top - view.scroller.el.offset().top + eventElt.outerHeight() / 2 - $popup.outerHeight(),
        left: eventElt.offset().left - view.scroller.el.offset().left + eventElt.width() - view.dayGrid.cellEls.eq(0).outerWidth() / 2 - $popup.outerWidth() / 2
      });

      if ($popup.offset().left - view.scroller.el.offset().left < 0) {
        $popup.css({
          marginLeft: $popup.outerWidth() / 2
        }).addClass('position-left-over');
      }

      if (view.scroller.el.offset().left + view.scroller.el.width() - ($popup.offset().left + $popup.width()) < 0) {
        $popup.css({
          marginLeft: -$popup.outerWidth() / 2
        }).addClass('position-right-over');
      }
    }

    if ($popup.offset().top - view.scroller.el.offset().top < 0) {
      $popup.css({
        marginTop: $popup.outerHeight()
      }).addClass('position-bottom');
    }
  }
  /**
   * @param container
   */


  function onWindowChange(container) {
    // console.log('onWindowChange');
    win.on('resize orientationchange', function () {
      clearTimeout(resizeTimer);
      if (!container.data('simplebar-api')) return;
      resizeTimer = setTimeout(function () {
        container.data('simplebar-api').recalculate();
      }, 200);
    });
  }
}