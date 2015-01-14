<?php
/**
 * @file
 * Template for the calendar add or view buttons.
 */
?>

<?php if ($button['action'] == 'view') : ?>
  <?php if ($button['location'] == 'content') : ?>
    <div class="<?php print $button['class']; ?>">
      <span><?php print t('This activity is added to your calendar.'); ?></span>
      <a href="<?php print url($button['path']); ?>"><?php print $button['text']; ?></a>
    </div>
  <?php elseif ($button['location'] == 'footer') : ?>
    <div class="<?php print $button['class']; ?>">
      <span>
        <?php print t('This activity has been saved'); ?>
      </span>
      <a href="<?php print url($button['path']); ?>"><?php print $button['text']; ?></a>
      <span>
        <?php print t("Don't forget to login to save your activities to your calendar"); ?>
      </span>
    </div>
  <?php endif; ?>
<?php elseif ($button['action'] == 'add') : ?>
  <div class="<?php print $button['class'] . ' ' . $button['class'] . '-' . $button['location']; ?>">
    <a href="<?php print url($button['path']); ?>" class="use-ajax"><?php print $button['text']; ?></a>
  </div>
<?php endif; ?>
