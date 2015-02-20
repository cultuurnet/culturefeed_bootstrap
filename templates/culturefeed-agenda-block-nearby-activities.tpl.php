<?php

/**
 * @file
 * Template for the block that contains page suggestions.
 */
?>

<div class="container">

  <div class="row">
    <p class="block-title pull-left">In jouw buurt <span id="nearby-activities-title-location" class="text-muted"></span></p>

    <span class="pull-left">
      <?php if (!empty($change_location_link)): ?>
        <?php print $change_location_link; ?>
      <?php endif; ?>
    </span>

    <span class="pull-right">
      <?php if (!empty($all_activities_for_location_link)): ?>
        <?php print $all_activities_for_location_link; ?>
      <?php endif; ?>
    </span>

    <div id="nearby-activities-filter-form-wrapper">
      <?php print drupal_render($filter_form); ?>
    </div>
  </div>

  <div id="nearby-activities" class="row">
    <p class="text-muted"><i class="fa fa-refresh fa-spin"></i>Loading</p>
  </div>

</div>