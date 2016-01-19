<?php
/**
 * @file 
 * Template file for a search list.
 * @var
 *   $noitems 
 *     Boolean to indicate no items were found.
 *   $items Array 
 *     items ready to display.
 *   $nowrapper (default=false). 
 *     For ajax request, you should hide the wrapper.
 */
?>

<?php if ($noitems): ?>
  <div class="alert alert-warning">
    <p><strong><?php print t('There are no more search results.'); ?></strong></p>
    <p>
      <?php print t('Refine your search results or'); ?>
      <?php print l(t('perform a new search.'), str_replace("/ajax", "", $_GET['q'])); ?>
    </p>
  </div>
<?php else: ?>
<?php 
  foreach ($items as $item) {
    print $item;
  }
?>
<?php endif; ?>
