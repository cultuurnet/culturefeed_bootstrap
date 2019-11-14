<?php
/**
 * @file
 * Template for the calendar 'liked' activities.
 */
?>

<div class="calendar-activities-liked-wrapper row">
<div class="col-xs-12">
  <h4 class="calendar-activities-label"><?php print t('Events you\'re interested in'); ?></h4>
  <table class="table table-condensed">
    <tbody>
      <?php foreach ($activities as $activity): ?>
        <?php print theme('culturefeed_calendar_activity_mini', array('activity' => $activity)); ?>
      <?php endforeach ?>
    </tbody>
  </table>
</div>
</div>
