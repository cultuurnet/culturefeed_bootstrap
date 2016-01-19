(function ($) {

  Drupal.behaviors.culturefeed_ui_privacy_tooltip = {

    attach: function (context, settings) {

      $("label[for='edit-setting-anonymous']").tooltip({
        title: Drupal.settings.culturefeed_ui_privacy_settings_anonymous_tooltip,
        placement: 'right'
      });

    }

  };

})(jQuery);
