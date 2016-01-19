<?php
/**
 * @file
 * Template for the calendar 'going' activities.
 */
?>

<div class="calendar-activities-going-wrapper">
  <?php foreach($months as $month_name => $activities): ?>
    <hr />
    <div class="calendar-activities-month-wrapper row">
      <div class="calendar-activity-wrapper col-xs-12">
        <h4 id="<?php print drupal_strtolower($month_name); ?>" class="calendar-activities-label"><?php print $month_name ?></h4>
        <?php if (!empty($activities)): ?>
        <div class="row">
          <?php foreach ($activities as $activity): ?>
            <?php print theme('culturefeed_calendar_activity_summary', array('activity' => $activity, 'my_calendar' => $my_calendar)) ?>
          <?php endforeach; ?>
        </div>
        <?php else: ?>
          <p class="small text-muted"><?php print t('No events scheduled in this month'); ?></p>
        <?php endif; ?>
      </div>
    </div>
  <?php endforeach; ?>
</div>