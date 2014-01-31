jQuery(function($) {

  // TOOLTIP
  $("a[data-toggle=tooltip]").tooltip();
  $("span[data-toggle=tooltip]").tooltip();
  
  // Init the map if this toggles a map.
  $(".map-toggle").click(function() {
    Drupal.CultureFeed.Agenda.initializeMap();
  });

});
