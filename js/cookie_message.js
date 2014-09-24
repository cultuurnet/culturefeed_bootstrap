(function ($) {
  Drupal.behaviors.culturefeed_ui = {
    attach: function(context, settings) {

      // Prepend a close button to each message.
      $('.alert:not(.cookie_close-processed):contains("' + Drupal.settings.culturefeed_ui.path + '")').each( function() {
        $(this).addClass('cookie_close-processed');
        $(this).append('<button class="btn btn-sm btn-default cookie_close" id="button-0">' + Drupal.t('OK, I understand') + '</button>');
        //$(this).prepend('<a href="#" class="cookie_close" title="' + Drupal.t('close') + '">' + Drupal.t('OK, I understand') + '</a>');
        $(this).find('.close').remove();
      });

      // When a close button is clicked hide this message.
      $(".alert button.cookie_close").click( function(event) {
      //$(".alert a.cookie_close").click( function(event) {
        event.preventDefault();
        $.cookie('culturefeed_ui_cookies', 'hidden', { expires: 1095 });
        $(this).parent().fadeOut("slow", function() {
          $(this).remove();
        });
      });

    }
  }
}(jQuery));