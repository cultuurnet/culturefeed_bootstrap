<?php

/**
* @file
 * Template for the timeline block.
 */
?>

<?php if ($page_admin): ?>
  <a href="<?php print url('pages/' . $page_id . '/news/add'); ?>" class="btn btn-warning btn-default pull-left"><?php print t('Add a news item') ?> &rarr;</a>
<?php endif; ?>

<?php print render($filter_form); ?>

<div id="timeline">
  <?php print $activities; ?>
</div>
