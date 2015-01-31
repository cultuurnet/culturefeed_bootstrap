(function($) {

  Drupal.FieldGroup = Drupal.FieldGroup || {};

  /**
   * Override fieldgroup function. The display block is not needed for bootstrap.
   */
  Drupal.FieldGroup.setGroupWithfocus = function(element) {
    Drupal.FieldGroup.groupWithfocus = element;
  }

})(jQuery);