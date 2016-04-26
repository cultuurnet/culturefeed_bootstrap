<?php
/**
 * @file
 * Template for the main section of a search page.
 *
 * @var $content
 */
?>

<hr class="hidden-xs hidden-sm small" />

<div class="row">
  <div class="col-sm-6">
    <p class="text-muted cf-result-count">
      <?php print format_plural($results_found, '<strong>@count</strong> result found', '<strong>@count</strong> results found'); ?>
    </p>
  </div>
  <div class="col-sm-6 hidden-xs text-right">
    <?php print '<label class="cf-sort-label">' . t('Sort') . '</label>'; ?>
    <?php print $variables['sort_links']; ?>
  </div>
</div>

<hr class="small" />

<?php print $content; ?>
