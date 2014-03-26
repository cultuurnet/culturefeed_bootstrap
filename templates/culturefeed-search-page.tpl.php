<?php
/**
 * @file
 * Template for the main section of a search page.
 *
 * @var $content
 */
?>

<hr />

<p class="text-muted">
  <?php print format_plural($results_found, '<strong>@count</strong> result found', '<strong>@count</strong> results found'); ?>
</p>

<hr />

<?php print $content; ?>
