<?php
/**
 * @file
 * Template for the calendar add or view buttons.
 */
?>

<?php if ($button['action'] == 'view') : ?>
  <?php if ($button['location'] == 'content') : ?>
    <div class="<?php print $button['class']; ?>">
      <span><?php print t('This event is added to your calendar.'); ?></span>
      <a href="<?php print url($button['path']); ?>"><?php print $button['text']; ?></a>
    </div>
  <?php elseif ($button['location'] == 'footer') : ?>
    <div class="<?php print $button['class']; ?>">
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
  <div class="<?php print $button['options']['attributes']['class'] . ' ' . $button['options']['attributes']['class'] . '-' . $button['location']; ?>">
    <a href="<?php print url($button['path'], $button['options']); ?>" class="use-ajax"><?php print $button['text']; ?></a>
  </div>
<?php endif; ?>
