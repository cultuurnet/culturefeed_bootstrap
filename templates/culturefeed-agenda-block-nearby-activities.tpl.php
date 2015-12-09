<?php

/**
 * @file
 * Template for the block that contains page suggestions.
 */
?>

<div class="panel panel-default">

  <div class="panel-heading">
    <span class="pull-right">
      <?php if (!empty($all_activities_for_location_link)): ?>
        <?php print $all_activities_for_location_link; ?>
      <?php endif; ?>
    </span>

    <h3 class="panel-title">
      <?php print (t('Events nearby')); ?>
      <span id="nearby-activities-title-location" class="text-muted"></span>

      <small>
        <?php if (!empty($change_location_link)): ?>
          <?php print $change_location_link; ?>
        <?php endif; ?>
      </small>
    </h3>

    <div id="nearby-activities-filter-form-wrapper">
      <?php print drupal_render($filter_form); ?>
    </div>
  </div>

  <div class="panel-body">
    <div id="nearby-activities" class="">
      <p class="text-muted"><i class="fa fa-refresh fa-spin"></i> Loading</p>
    </div>
  </div>

</div>