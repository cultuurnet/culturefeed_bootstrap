<?php
/**
 * @file
 * Template file for one culturefeed search filter block.
 */

/**
 * @var array $items
 */
?>

<?php if ($active): ?>
  <div class="facet-label active">
    <div class="row">
      <div class="col-xs-9"><span class="active-label"><?php print check_plain($label); ?></span></div>
      <div class="col-xs-3 text-right text-muted"><a href="<?php print $url; ?>" class="" title="<?php print t('Remove filter'); ?>">&times;</a></div>
    </div>
  </div>
<?php else: ?>
  <div class="facet-label">
    <div class="row">
      <div class="col-md-8 col-sm-12 col-xs-9"><a href="<?php print $url; ?>"><?php print check_plain($label); ?></a></div>
      <div class="col-md-4 hidden-sm col-xs-3 text-right text-muted"></div>
    </div>
  </div>
<?php endif; ?>
