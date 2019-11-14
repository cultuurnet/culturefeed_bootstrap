(function ($) {

  Drupal.behaviors.culturefeed_ui_synchronization = {

    attach: function (context, settings) {

      if ($.cookie('profile-synchronization') === null) {

        var url = Drupal.settings.culturefeed_ui_synchronization.url;
        var title = Drupal.settings.culturefeed_ui_synchronization.title;

        $.ajax({
          url: url,
          type: 'GET',
          success: function(data) {

            $.cookie('profile-synchronization', 1, { expires: 365, path: '/' });

            var new_content = "<div class=\"modal-header\">";
            new_content += "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">";
            new_content += "<span aria-hidden=\"true\">&times;</span></button>";
            new_content += "<h4 class=\"modal-title\">" + title + "</h4></div>";
            new_content += "<div class=\"modal-body\">" + data + "</div>";

            var modal_container = $('#bootstrap-modal-container');
            modal_container.find('.modal-content').html(new_content);
            modal_container.modal({show : true});

          }

        });

      };

    }

  };

})(jQuery);
