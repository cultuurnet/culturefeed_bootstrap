jQuery(function($) {

  // Init popovers
  $("a[data-toggle=popover]")
    .popover()
    .click(function(e) {
      e.preventDefault()
    })

  // popover - authentication required
  if (!Drupal.settings.culturefeed || !Drupal.settings.culturefeed.isCultureFeedUser) {

    var isVisible = false;
    var clickedAway = false;

    $popoverLogin = $(".do-link");

    // show popover
    $popoverLogin.popover({
      html: true,
      placement: 'top',
      trigger: 'manual',
      content: function() {
        // see custom culturefeed-ui-connect-hover.tpl.php
        return $(".popover-login").html();
      }
    }).click(function(e) {
      $(this).popover('show');
      clickedAway = false
      isVisible = true
      e.preventDefault()
    });


    // hide popover
    $(document).click(function(e) {
      if (isVisible && clickedAway)
      {
        $popoverLogin.popover('hide')
        isVisible = clickedAway = false
      }
      else
      {
        clickedAway = true
      }
    });

  }

  // Init tooltips
  $("a[data-toggle=tooltip]").tooltip();
  $("span[data-toggle=tooltip]").tooltip();

  // Init the map if this toggles a map.
  $(".map-toggle").click(function() {
    Drupal.CultureFeed.Agenda.initializeMap();
  });

  // Count characters input field - limit - general
  function limitChars(textid, limit, infodiv)
  {
  	var text = $('#'+textid).val();
  	text=text.replace(/[\n\r\n]+/g, '  ');
  	var textlength = text.length;
  	if(textlength > limit)
  	{
  		$('#' + infodiv).html('Maximum '+limit+' karakters!');
  		$('#'+textid).val(text.substr(0,limit));
  		return false;
  	}
  	else
  	{
  		$('#' + infodiv).html('Nog '+ (limit - textlength) +' resterende karakters');
  		return true;
  	}
  }

  // Count characters input field - limit 400 characters
  $(function(){
   	$('#limit-400').keyup(function(){
   		limitChars('limit-400', 400, 'charlimitinfo');
   	})
  });

  // Remove agenda tab from page timeline block if agenda block is not available
  if ($("#block-culturefeed-pages-page-agenda").length == 0) {
    $(".tab-agenda").remove();
  }

  /**
   * Attach behaviors to managed file element upload fields.
   */
  Drupal.behaviors.fileValidateAutoAttach = {
    attach: function (context, settings) {
      if (settings.file && settings.file.elements) {
        $.each(settings.file.elements, function(selector) {
          var extensions = settings.file.elements[selector];
          $(selector, context).once('validate', function () {
            $(this).bind('change', {extensions: extensions}, Drupal.file.validateExtension);
          });
        });
      }
    },
    detach: function (context, settings) {
      if (settings.file && settings.file.elements) {
        $.each(settings.file.elements, function(selector) {
          $(selector, context).unbind('change', Drupal.file.validateExtension);
        });
      }
    }
  };

  /**
   * Client-side file input validation of file extensions.
   */
  Drupal.file.validateExtension = function (event) {

    // Remove any previous errors.
    $('.file-upload-js-error').remove();

    // Add client side validation for the input[type=file].
    var extensionPattern = event.data.extensions.replace(/,\s*/g, '|');
    if (extensionPattern.length > 1 && this.value.length > 0) {
      var acceptableMatch = new RegExp('\\.(' + extensionPattern + ')$', 'gi');
      if (!acceptableMatch.test(this.value)) {
        var error = Drupal.t("The selected file %filename cannot be uploaded. Only files with the following extensions are allowed: %extensions.", {
          // According to the specifications of HTML5, a file upload control
          // should not reveal the real local path to the file that a user
          // has selected. Some web browsers implement this restriction by
          // replacing the local path with "C:\fakepath\", which can cause
          // confusion by leaving the user thinking perhaps Drupal could not
          // find the file because it messed up the file path. To avoid this
          // confusion, therefore, we strip out the bogus fakepath string.
          '%filename': this.value.replace('C:\\fakepath\\', ''),
          '%extensions': extensionPattern.replace(/\|/g, ', ')
        });
        $(this).closest('div.form-type-managed-file').append('<div class="messages error file-upload-js-error">' + error + '</div>');
        this.value = '';
        return false;
      }
    }
  }

});
