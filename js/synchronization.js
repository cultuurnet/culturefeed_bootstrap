(function ($) {

  Drupal.behaviors.culturefeed_ui_synchronization = {

    attach: function (context, settings) {

      $('#profile-edit-synchronization').find('a').click(function (event) {

        var link = $(this);
        var container = $("<div></div>");
        var url = link.attr('href');
        var title = link.attr('title');
        var throbber_html = "&nbsp;<span class=\"ajax-progress ajax-progress-throbber\">";
        throbber_html += "<span class=\"throbber\">&nbsp;</span></span>";
        var throbber = $(throbber_html);

        link.append(throbber);

        $.ajax({
          url: url,
          type: 'GET',
          success: function(data) {

            throbber.remove();

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

        event.preventDefault();

      });

    }

  };

})(jQuery);
