<?php

/**
* @file
 * Template for the timeline block.
 */
?>

<?php if ($page_admin): ?>
<p>
    <a href="<?php print url('pages/' . $page_id . '/news/add'); ?>" class="btn btn-default"><?php print t('Add a news item') ?> &rarr;</a>
</p>
<?php endif; ?>

<?php print $activities; ?>
