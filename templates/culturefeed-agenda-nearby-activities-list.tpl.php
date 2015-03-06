<?php

/**
 * @file
 * Theme the list of suggestions.
 */
?>

<div class="row">
  <?php if (!empty($activities)): ?>
    <?php foreach ($activities as $activity): ?>
      <div class="col-md-4 col-sm-6">
        <?php print theme('culturefeed_agenda_nearby_activities_list_item', array('item' => $activity)); ?>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p><?php print t('No nearby activities found'); ?></p>
  <?php endif; ?>
</div>
