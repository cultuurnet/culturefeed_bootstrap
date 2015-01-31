
(function ($) {

  /**
   * This script transforms a set of fieldsets into a stack of vertical
   * tabs. Another tab pane can be selected by clicking on the respective
   * tab.
   *
   * Each tab may have a summary which can be updated by another
   * script. For that to work, each fieldset has an associated
   * 'verticalTabCallback' (with jQuery.data() attached to the fieldset),
   * which is called every time the user performs an update to a form
   * element inside the tab pane.
   */
  Drupal.behaviors.verticalTabs = {
    attach: function (context) {
      $('.vertical-tabs-panes', context).once('vertical-tabs', function () {
        $(this).addClass('tab-content');
        var focusID = $(':hidden.vertical-tabs-active-tab', this).val();
        var tab_focus;

        // Check if there are some fieldsets that can be converted to vertical-tabs
        var $fieldsets = $('> fieldset', this);
        if ($fieldsets.length == 0) {
          return;
        }

        // Create the tab column.
        var tab_list = $('<ul class="nav nav-tabs vertical-tabs-list"></ul>');
        $(this).wrap('<div class="tabbable tabs-left vertical-tabs clearfix"></div>').before(tab_list);

        // Transform each fieldset into a tab.
        $fieldsets.each(function () {
          var vertical_tab = new Drupal.verticalTab({
            title: $('> legend', this).text(),
            fieldset: $(this)
          });
          tab_list.append(vertical_tab.item);
          $(this)
            .removeClass('collapsible collapsed panel panel-default')
            .addClass('tab-pane vertical-tabs-pane')
            .data('verticalTab', vertical_tab);
          if (this.id == focusID) {
            tab_focus = $(this);
          }
        });

        $('> li:first', tab_list).addClass('first');
        $('> li:last', tab_list).addClass('last');

        if (!tab_focus) {
          // If the current URL has a fragment and one of the tabs contains an
          // element that matches the URL fragment, activate that tab.
          if (window.location.hash && $(this).find(window.location.hash).length) {
            tab_focus = $(this).find(window.location.hash).closest('.vertical-tabs-pane');
          }
          else {
            tab_focus = $('> .vertical-tabs-pane:first', this);
          }
        }
        if (tab_focus.length) {
          tab_focus.data('verticalTab').focus();
        }
      });
    }
  };

})(jQuery);