<?php
/**
 * @file
 * Template file for a single culturefeed search facet item.
 */

/**
 * @var string $label
 * @var integer $count
 * @var string $url
 * @var boolean $active
 * @var boolean $active_subitem
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
      <div class="col-md-8 col-sm-12 col-xs-9"><a href="<?php print $url; ?>" <?php $active_subitem ? print 'rel="nofollow"' : ''; ?>><?php print check_plain($label); ?></a></div>
      <div class="col-md-4 hidden-sm col-xs-3 text-right text-muted"><small class="facet-count">(<?php print number_format($count, 0, ',', '.'); ?>)</small></div>
    </div>
  </div>
<?php endif; ?>
