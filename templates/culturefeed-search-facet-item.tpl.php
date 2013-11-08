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
 */
?>

<?php if ($active): ?>
  <div class="facet-label active"><span class="active-label"><?php print check_plain($label); ?></span> <a href="<?php print $url; ?>" class="facet-remove pull-right text-muted" title="<?php print t('Remove filter'); ?>">&times;</a></div>
<?php else: ?>
  <div class="facet-label"><a href="<?php print $url; ?>"><?php print check_plain($label); ?></a> <span class="facet-count text-muted pull-right">(<?php print $count; ?>)</span></div>
<?php endif; ?>
