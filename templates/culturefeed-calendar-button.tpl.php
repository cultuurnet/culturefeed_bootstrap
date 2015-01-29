<?php
/**
 * @file
 * Template for the calendar add or view buttons.
 * Leave the wrapper div class + print classes + data-eventid, as it is used for javascript.
 */
?>

<div class="<?php print $classes; ?>" data-eventid="<?php print $event_id; ?>">

<?php if ($button['action'] == 'view') : ?>
  <?php if ($button['location'] == 'content') : ?>
  <span><?php print t('This event is added to your calendar.'); ?></span>
  <a href="<?php print url($button['path']); ?>"><?php print $button['text']; ?></a>
  <?php elseif ($button['location'] == 'footer') : ?>
  <span>
    <?php print t('This event has been saved'); ?>
  </span>
  <a href="<?php print url($button['path']); ?>"><?php print $button['text']; ?></a>
  <?php if (!$authenticated) : ?>
    <span>
      <?php print t("Don't forget to login to save your events to your calendar"); ?>
    </span>
  <?php endif; ?>
  <?php endif; ?>
<?php elseif ($button['action'] == 'add') : ?>
  <a href="<?php print url($button['path'], $button['options']); ?>" class="use-ajax"><?php print $button['text']; ?></a>
<?php endif; ?>

</div>