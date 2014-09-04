<?php

/**
 * @file
 * Template for the block that contains page suggestions.
 */
?>

<a class="text-muted all-pages-link" href="<?php print url('agenda/pages') ?>"><?php print t('Show all pages') ?> &rarr;</a>

<?php print drupal_render($filter_form); ?>

<div id="page-suggestions">
  <p class="text-muted"><i class="fa fa-refresh fa-spin"></i> Loading</p>
</div>
