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

});
