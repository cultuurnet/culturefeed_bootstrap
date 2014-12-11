<?php
/**
 * @file
 * Template for the calendar summary of an activity.
 */
?>
<div class="col-sm-6">
  <ul class="list-group">
    <li class="list-group-item">
      <div class="activity-header">
        <div class="pull-right">
          <span class="calendar-delete-event">
            <i class="fa fa-trash"></i>
            <a class="use-ajax" href="<?php print $delete_link['url'] ?>"><?php print $delete_link['text']; ?></a>
          </span>
          <?php if ($edit_link['show']): ?>
            <br />
            <span class="calendar-move-event">
              <i class="fa fa-arrows-alt"></i>
              <a class="use-ajax" href="<?php print $edit_link['url'] ?>"><?php print $edit_link['text']; ?></a>
            </span>
          <?php endif; ?>
        </div>
        <?php if (!empty($date)): ?>
          <strong><?php print $date; ?></strong>
        <?php endif; ?>
        <h4 class="media-heading"><?php print $title; ?></h4>
      </div>
    </li>
    <?php if ($location): ?>
      <li class="list-group-item">
        <div class="row">
          <div class="col-sm-2">
            <strong><?php print t('Where'); ?></strong>
          </div>
          <div class="col-sm-10">
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
          </div>
        </div>
      </li>
    <?php endif; ?>
    <?php if (!empty($reservation) || !empty($tickets)) : ?>
      <li class="list-group-item">
        <div class="row">
          <div class="col-sm-2">
            <strong><?php print t('Price'); ?></strong>
          </div>
          <div class="col-sm-10">
            <?php if (!empty($tickets)) : ?>
              <?php print implode(', ', $tickets) ?><br />
            <?php endif; ?>
            <?php if (!empty($reservation['mail'])) : ?>
              <?php print $reservation['mail'] ?><br />
            <?php endif; ?>
            <?php if (!empty($reservation['url'])) : ?>
              <?php print $reservation['url'] ?><br />
            <?php endif; ?>
            <?php if (!empty($reservation['phone'])) : ?>
              <?php print t('Phone'); ?>: <?php print $reservation['phone'] ?><br />
            <?php endif; ?>
          </div>
        </div>
      </li>
    <?php endif; ?>
    <li class="list-group-item">
      <span class="calendar-view-event">
        <a href="<?php print $url; ?>"><?php print t('More info'); ?></a>
      </span>
    </li>
  </ul>
</div>
