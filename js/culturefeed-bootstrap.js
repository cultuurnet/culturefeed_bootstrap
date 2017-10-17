(function ($) {

  $(document).ready(function() {

    // Init popovers
    $("a[data-toggle=popover]")
      .popover()
      .click(function(e) {
        e.preventDefault()
      })

    // skip-link focus
    $("a[href^='#']").click(function() {
      $("#"+$(this).attr("href").slice(1)+"").focus();
    });

   // Temp adding aria-expanded to dropdown untill base bootstrap is updated
    $('.dropdown-toggle').click(function(){
      var status = $(this).attr('aria-expanded');
      if(status == 'false'){
        $(this).attr('aria-expanded', 'true');
      } else {
        $(this).attr('aria-expanded', 'false');
      }
    });

    // popover - authentication required
    if (!Drupal.settings.culturefeed || !Drupal.settings.culturefeed.isCultureFeedUser) {

      var isVisible = false;
      var clickedAway = false;

      $popoverLogin = $("a[href^='/culturefeed/do']");

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

  })

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
   * Add click events on the read more link.
   */
  Drupal.behaviors.culturefeedPushMoreInfoToUitId = {
    attach: function(context, settings) {
      $('a.moreinfo-link', context).bind('click', function(e) {
        e.preventDefault();
        $.ajax($(this).prop('rel'));
        $('#cf-longdescription').toggle();
      });
    }
  };

  if (Drupal.file) {

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

  }

  if (Drupal.ajax) {

    /**
     * Handler for the form redirection error.
     * Custom override: Don't show an error when people are navigation away of the site.
     */
    Drupal.ajax.prototype.error = function (response, uri) {

      if (!response.status) {
        return;
      }

      alert(Drupal.ajaxError(response, uri));
      // Remove the progress element.
      if (this.progress.element) {
        $(this.progress.element).remove();
      }
      if (this.progress.object) {
        this.progress.object.stopMonitoring();
      }
      // Undo hide.
      $(this.wrapper).show();
      // Re-enable the element.
      $(this.element).removeClass('progress-disabled').removeAttr('disabled');
      // Reattach behaviors, if they were detached in beforeSerialize().
      if (this.form) {
        var settings = response.settings || this.settings || Drupal.settings;
        Drupal.attachBehaviors(this.form, settings);
      }
    };

    /**
     * Command to provide a bootstrap modal with drupal ajax support.
     */
    Drupal.ajax.prototype.commands.bootstrapModal = function (ajax, response, status) {

      // Support for jquery datepicker. See http://stackoverflow.com/questions/21059598/implementing-jquery-datepicker-in-bootstrap-modal
      var enforceModalFocusFn = $.fn.modal.Constructor.prototype.enforceFocus;
      $.fn.modal.Constructor.prototype.enforceFocus = function() {};
      $('#bootstrap-modal-container').on('hidden', function() {
          $.fn.modal.Constructor.prototype.enforceFocus = enforceModalFocusFn;
      });

      var wrapper = $('#bootstrap-modal-container').find('.modal-content');
      var settings = response.settings || ajax.settings || Drupal.settings;
      Drupal.detachBehaviors(wrapper, settings);

      var new_content = $('<div></div>').html(response.data);
      $('#bootstrap-modal-container').find('.modal-content').html(new_content);
      $('#bootstrap-modal-container').modal({show : true});
      Drupal.attachBehaviors(new_content, settings);

    };

    /**
     * Command to reload current page.
     */
    Drupal.ajax.prototype.commands.culturefeedGoto = function (ajax, response, status) {

      if (ajax.progress.element) {
        $(ajax.element).addClass('progress-disabled').attr('disabled', 'disabled');
        $(ajax.element).append(ajax.progress.element);
      }

      window.location.href = response.url;
    }

  }

  if (Drupal.ACDB) {

    /**
     * Performs a cached and delayed search.
     * Custom override: Don't show an error when people are navigation away of the site.
     */
    Drupal.ACDB.prototype.search = function (searchString) {
      var db = this;
      this.searchString = searchString;

      // See if this string needs to be searched for anyway.
      searchString = searchString.replace(/^\s+|\s+$/, '');
      if (searchString.length <= 0 ||
        searchString.charAt(searchString.length - 1) == ',') {
        return;
      }

      // See if this key has been searched for before.
      if (this.cache[searchString]) {
        return this.owner.found(this.cache[searchString]);
      }

      // Initiate delayed search.
      if (this.timer) {
        clearTimeout(this.timer);
      }
      this.timer = setTimeout(function () {
        db.owner.setStatus('begin');

        // Ajax GET request for autocompletion. We use Drupal.encodePath instead of
        // encodeURIComponent to allow autocomplete search terms to contain slashes.
        $.ajax({
          type: 'GET',
          url: db.uri + '/' + Drupal.encodePath(searchString),
          dataType: 'json',
          success: function (matches) {
            if (typeof matches.status == 'undefined' || matches.status != 0) {
              db.cache[searchString] = matches;
              // Verify if these are still the matches the user wants to see.
              if (db.searchString == searchString) {
                db.owner.found(matches);
              }
              db.owner.setStatus('found');
            }
          },
          error: function (xmlhttp) {
            if (xmlhttp.status) {
              alert(Drupal.ajaxError(xmlhttp, db.uri));
            }
          }
        });
      }, this.delay);
    };

  }

  // Create a custom autocomplete widget that supports categorisation of data with bootstrap html.
  if ($.custom && $.custom.categorisedAutocomplete) {

    // Take over the search function.
    $.custom.categorisedAutocomplete.prototype.search = function(value, event) {

      var $throbber = $('.glyphicon-refresh', $(this.element).parent());
      $throbber.addClass('glyphicon-spin');

      value = value != null ? value : this._value();

      // always save the actual value, not the one passed as an argument
      this.term = this._value();

      if ( value.length < this.options.minLength ) {
        return this.close( event );
      }

      if ( this._trigger( "search", event ) === false ) {
        return;
      }

      return this._search(value);

    }

    // Take over the render menu function.
    $.custom.categorisedAutocomplete.prototype._renderMenu = function(ul, items) {

      var $throbber = $('.glyphicon-refresh', $(this.element).parent());
      $throbber.removeClass('glyphicon-spin');

      var that = this,
      currentCategory = "";
      $.each(items, function(index, item) {
        var li;
        if (!item.label) {
          if (item.category != currentCategory) {
            ul.append("<li class='ui-autocomplete-category " + item.type+ "'>" + item.category + "</li>");
            currentCategory = item.category;
          }
        } else {
          if (item.category != currentCategory) {
            ul.append("<li class='ui-autocomplete-category " + item.type+ "'>" + item.category + "</li>");
            currentCategory = item.category;
          }
          li = that._renderItemData(ul, item);
          if (item.category) {
            li.attr("aria-label", item.category + " : " + item.label);
          }
        }
      });

    }

  }

  /**
   * Prevents the form from submitting if the suggestions popup is open
   * and closes the suggestions popup when doing so.
   */
   Drupal.autocompleteSubmit = function () {
     return $('.form-autocomplete > .dropdown').each(function () {
       this.owner.hidePopup();
     }).length == 0;
   };

    /**
     * Add mobile detect helper classes to the body tag.
     */
    Drupal.behaviors.culturefeedMobileDetect = {
      attach: function(context, settings) {
        var bodyClasses = [];
        var md = new MobileDetect(window.navigator.userAgent);

        if (md.mobile() !== null) {
          if (md.tablet() !== null) {
            bodyClasses.push('is-tablet');
          }
          else {
            bodyClasses.push('is-phone');
          }
        }
        else {
          bodyClasses.push('is-computer');
        }

        if (md.os() === 'AndroidOs') {
          bodyClasses.push('is-android');
        }
        if (md.os() === 'iOS') {
          bodyClasses.push('is-ios');
        }

        $.each(bodyClasses, function (key, value) {
          $('body').addClass(value);
        });

        // Format phones for mobile.
        // Contact phone
        if (Drupal.settings.culturefeed_agenda) {
            if (Drupal.settings.culturefeed_agenda.contact) {
                if (Drupal.settings.culturefeed_agenda.contact.phones) {
                    var phones = Drupal.settings.culturefeed_agenda.contact.phones;

                    if (md.mobile()) {
                        var linkPhones = Array();
                        phones = phones.split(', ');

                        $.each(phones, function (key, phone) {
                            linkPhones[key] = '<a href="tel:' + validate_phone(phone) + '">' + phone + '</a>';
                        });
                        phones = linkPhones.join(', ');
                        $('.phone-placeholder').html(phones);
                    }
                }
            }

            // Reservation phone
            if (Drupal.settings.culturefeed_agenda.reservation) {
                if (Drupal.settings.culturefeed_agenda.reservation.phones) {
                    var resPhones = Drupal.settings.culturefeed_agenda.reservation.phones;

                    if (md.mobile()) {
                        var linkResPhones = Array();
                        resPhones = resPhones.split(', ');

                        $.each(resPhones, function (key, phone) {
                            linkResPhones[key] = '<a href="tel:' + validate_phone(phone) + '">' + phone + '</a>';
                        });
                        resPhones = linkResPhones.join(', ');
                        $('.reservation-phone-placeholder').html(resPhones);
                    }
                }
            }
        }
      }
    };

    /**
     * Add the right links for maps and phones depending on the device.
     */
    function validate_phone(rawPhone) {
      var phone = rawPhone.replace(new RegExp(' ', 'g'), '-');
      return phone.replace(new RegExp(/[^0-9+()]/, 'g'), '');
    }

    Drupal.behaviors.culturefeedAddMapLink = {
      attach: function (context, settings) {
        if (Drupal.settings.culturefeed_map) {
            var md = new MobileDetect(window.navigator.userAgent);
            var title = Drupal.settings.culturefeed_map.title;
            // Map
            if (Drupal.settings.culturefeed_map.info.location) {
                var zip = Drupal.settings.culturefeed_map.info.location.zip;
                var city = Drupal.settings.culturefeed_map.info.location.city;
                var street = Drupal.settings.culturefeed_map.info.location.street;
                var lat = (Drupal.settings.culturefeed_map.info.coordinates.lat) ? Drupal.settings.culturefeed_map.info.coordinates.lat : '0';
                var lng = (Drupal.settings.culturefeed_map.info.coordinates.lng) ? Drupal.settings.culturefeed_map.info.coordinates.lng : '0';
                var querystring = title;
                var mapLink = '';

                if (zip) {
                    querystring = querystring + '+' + zip;
                }
                if (city) {
                    querystring = querystring + '+' + city;
                }
                if (street) {
                    querystring = querystring + '+' + street;
                }

                if (md.os() === 'iOS') {
                    mapLink = '<a href="http://maps.apple.com/?q' + querystring + '">' + Drupal.t('Open map') + '</a>';
                }
                else if (md.os() === 'AndroidOS') {
                    mapLink = '<a href="geo:' + lat + ',' + lng + '?q=' + querystring + '&zoom=14" class="btn btn-default btn-sm pull-right">' + Drupal.t('Open map') + '</a>';
                }
                else {
                    mapLink = '<a href="#cf-map" data-toggle="collapse" class="pull-right map-toggle collapsed">' + Drupal.t('Show map') + ' <span class="caret"></span></a>';
                }

                $('.map-js-link').html(mapLink);
            }
        }
      }
    };

})(jQuery);
