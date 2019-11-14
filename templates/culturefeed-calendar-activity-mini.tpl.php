<?php
/**
 * @file
 * Template for the calendar mini summary of an activity.
 */
?>

<div class="calendar-activity-mini">
<p class="calendar-item-summary"><?php print $when_sm; ?></p>
<a href="<?php print $url; ?>">
<h5 class="calendar-item-title"><?php print $title; ?></h5>
</a>
<p>
<small>
<a class="use-ajax calendar-item-delete" href="<?php print $delete_link['url'] ?>"><?php print $delete_link['text']; ?></a>
<a class="use-ajax calendar-item-plan" href="<?php print $edit_link['url'] ?>"><?php print t('I\'m going'); ?></a>
</small>
</p>
</div>
