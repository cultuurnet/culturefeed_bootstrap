/**
 * @file
 * Js functionality for the search ui.
 */

Drupal.CulturefeedSearch = Drupal.CulturefeedSearch || {};

(function ($) {

  Drupal.behaviors.culturefeedSearchUi = {
    attach: function (context, settings) {

      if ($('#edit-sort').length > 0) {
        Drupal.CulturefeedSearch.bindSortDropdown();
      }
      if ($('#specific-dates-range').length > 0) {
        Drupal.CulturefeedSearch.bindDatePicker();
      }

      $('input.auto-submit').click(Drupal.CulturefeedSearch.autoSubmit);

    }
  };

  /**
   * Bind the datepicker functionality.
   */
  Drupal.CulturefeedSearch.bindDatePicker = function() {
    var field = $('#edit-date-range');
    var link_content = $('#specific-dates-range span');
    var submit = $('#culturefeed-search-ui-date-facet-form .form-submit');

    field.hide();
    submit.hide();

    var format = 'D/M/YYYY';

    var range = field.val();
    var rangeValid = false;

    var from = null;
    var to = null;

    if (range.length > 0) {
      var dates = range.split(' - ');
      var fromValid = false;
      var toValid = false;

      if (moment(dates[0], format, true).isValid()) {
        from = dates[0];
        fromValid = true;
      }

      if (dates[1] != undefined) {
        if (moment(dates[1], format, true).isValid()) {
          to = dates[1];
          toValid = true;
        }
      }

      rangeValid = fromValid && (toValid || dates[1] == undefined);
    }

    // $('#submit-specific-dates').hide();

    if (rangeValid) {
      link_content.html(range);
    }

    $('#specific-dates-range').daterangepicker({
      format: format,
      startDate: from ? from : moment(),
      endDate: to ? to : moment(),
      opens: 'right',
      showWeekNumbers: false,
      applyClass: "btn-primary",
      cancelClass: "btn-link",
      locale: {
        cancelLabel: Drupal.t('Cancel'),
        applyLabel: Drupal.t('Apply'),
        fromLabel: Drupal.t('Between'),
        toLabel: Drupal.t('And'),
        monthNames: [
          Drupal.t('January'),
          Drupal.t('February'),
          Drupal.t('March'),
          Drupal.t('April'),
          Drupal.t('May'),
          Drupal.t('June'),
          Drupal.t('July'),
          Drupal.t('August'),
          Drupal.t('September'),
          Drupal.t('October'),
          Drupal.t('November'),
          Drupal.t('December')
        ],
        daysOfWeek: [
          Drupal.t('Sun'),
          Drupal.t('Mon'),
          Drupal.t('Tue'),
          Drupal.t('Wed'),
          Drupal.t('Thu'),
          Drupal.t('Fri'),
          Drupal.t('Sat')
        ],
        firstDay: 1
      }
    }, function (start, end) {
      var range;
      var from = start.format(format);
      var to = end.format(format);

      if (from == to) {
        range = from;
      }
      else {
        range = from + ' - ' + to;
      }

      field.val(range);
      link_content.html(range);

      field.closest('form').submit();
    }).click(function (e) {
      e.preventDefault();
    });
  };

})(jQuery);
