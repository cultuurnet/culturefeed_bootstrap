<?php
/**
 * @file
 * Template for the calendar summary of an activity.
 */
?>
<div class="col-lg-4 col-sm-6 calender-activity-summary">
  <div class="panel panel-default">

    <div class="panel-heading">

      <?php if (!empty($main_picture)): ?>
      <div class="thumbnail">
        <a href="<?php print $url; ?>" class="hyperspan"></a>
        <img src="<?php print $main_picture; ?>?width=420&height=280&crop=auto&scale=both"/>
      </div>
      <?php endif; ?>

      <div class="calender-item-header">
        <?php if (!empty($date)): ?>
          <p class="calendar-item-summary"><?php print $date; ?></p>
        <?php endif; ?>
        <a href="<?php print $url; ?>">
          <h4 class="calendar-item-title"><?php print $title; ?></h4>
        </a>
      </div>

    </div>
    <ul class="list-group">
      <?php if ($location): ?>
        <li class="list-group-item">
          <?php if (!empty($location['link'])): ?>
            <?php print $location['link']; ?><br />
          <?php else: ?>
            <?php print $location['title'];?><br />
          <?php endif; ?>
          <?php if (!empty($location['street'])): ?>
            <?php print $location['street'] ?><br />
          <?php endif; ?>
          <?php if (!empty($location['zip'])): ?>
            <?php print $location['zip']; ?>
          <?php endif; ?>
          <?php if (!empty($location['city'])): ?>
            <?php print $location['city']; ?>
          <?php endif; ?>
        </li>
      <?php endif; ?>
    </ul>

    <div class="panel-footer">
      <small class="calendar-item-actions">
      <?php if ($my_calendar): ?>
        <span class="calendar-delete-event">
          <a class="use-ajax calendar-item-delete" href="<?php print $delete_link['url'] ?>"><?php print $delete_link['text']; ?></a>
        </span>
        <?php if ($edit_link['show']): ?>
        <span class="calendar-move-event">
          <a class="use-ajax calendar-item-move" href="<?php print $edit_link['url'] ?>"><?php print $edit_link['text']; ?></a>
        </span>
        <?php endif; ?>
      <?php endif; ?>
      </small>
    </div>

  </div>
</div>
