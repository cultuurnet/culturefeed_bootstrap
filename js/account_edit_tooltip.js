(function ($) {

  Drupal.behaviors.culturefeed_ui_privacy_tooltip = {

    attach: function (context, settings) {

      $("#edit-mbox").tooltip({
        title: Drupal.settings.culturefeed_ui_account_edit_email_description_tooltip,
        placement: 'right'
      });

    }

  };

})(jQuery);
