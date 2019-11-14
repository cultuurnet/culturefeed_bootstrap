<?php
/**
 * @file
 * Template for the calendar 'going' activities.
 */
?>

<div class="calendar-activities-going-wrapper">

  <?php $m = 0; ?>
  <?php $months_helpers = _culturefeed_calendar_get_nav_months(); ?>

  <?php foreach($months as $month_name => $activities): ?>
    <div class="calendar-activities-month-wrapper row">
      <div class="calendar-activity-wrapper col-xs-12">
        <h4 id="<?php print drupal_strtolower($month_name); ?>" class="calendar-activities-label"><?php print $month_name ?></h4>
        <?php if (!empty($activities)): ?>
        <div class="row">
          <?php $a = 1; ?>
          <?php foreach ($activities as $key=>$activity): ?>
            <?php print theme('culturefeed_calendar_activity_summary', array('activity' => $activity, 'my_calendar' => $my_calendar)) ?>
            <?php if($a%3 == 0): ?>
              <div class="divider--3"></div>
            <?php else: ?>
              <?php if($a%2 == 0): ?>
                <div class="divider--2"></div>
              <?php endif; ?>
            <?php endif; ?>
            <?php $a++; ?>
          <?php endforeach; ?>
        </div>
        <?php else: ?>
          <p class="small text-muted text-center">
            <?php print t('No events scheduled.'); ?><br>
            <?php echo l(t('Discover events in ') . ' ' . $month_name,'agenda/search', array('query' => array('date_range' => $months_helpers[$m]['first_day'] . " - " . $months_helpers[$m]['last_day'] ))); ?>
          </p>
        <?php endif; ?>
      </div>
    </div>
    <hr />
    <?php $m++; ?>
  <?php endforeach; ?>
</div>
