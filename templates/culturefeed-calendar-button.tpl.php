<?php
/**
 * @file
 * Template for the calendar add or view buttons.
 * Leave the wrapper div class + data-eventid, as it is used for javascript.
 */
$classes = implode(' ', $button['options']['attributes']['class']);
?>

<div class="calendar-button" data-eventid="<?php print $event_id; ?>">

<?php if ($button['action'] == 'view') : ?>
  <?php if ($button['location'] == 'content') : ?>
    <div class="<?php print $classes; ?>">
      <span><?php print t('This event is added to your calendar.'); ?></span>
      <a href="<?php print url($button['path']); ?>"><?php print $button['text']; ?></a>
    </div>
  <?php elseif ($button['location'] == 'footer') : ?>
    <div class="<?php print $classes; ?>">
      <span>
        <?php print t('This event has been saved'); ?>
      </span>
      <a href="<?php print url($button['path']); ?>"><?php print $button['text']; ?></a>
      <?php if (!$authenticated) : ?>
        <span>
          <?php print t("Don't forget to login to save your events to your calendar"); ?>
        </span>
      <?php endif; ?>
    </div>
  <?php endif; ?>
<?php elseif ($button['action'] == 'add') : ?>
  <div class="<?php print $classes . ' ' . $classes . '-' . $button['location']; ?>">
    <a href="<?php print url($button['path'], $button['options']); ?>" class="use-ajax"><?php print $button['text']; ?></a>
  </div>
<?php endif; ?>

</div>