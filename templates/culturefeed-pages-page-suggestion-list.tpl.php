<?php

/**
 * @file
 * Theme the list of suggestions.
 */
?>

<?php if (!empty($suggestions)): ?>

  <?php foreach ($suggestions as $suggestion): ?>
      <?php print theme('culturefeed_pages_page_suggestion_list_item', array('item' => $suggestion)); ?>
  <?php endforeach; ?>

<?php else: ?>
  <p><?php print t('No suggestions found'); ?></p>
<?php endif; ?>