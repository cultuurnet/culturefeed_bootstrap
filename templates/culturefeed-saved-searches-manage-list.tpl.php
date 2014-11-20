<?php
/**
 * @file
 * Template for showing the manage list of saved searches.
 */
?>

<div id="saved-searches-messages"></div>

<?php foreach ($items as $item): ?>

  <div class="row">
    <div class="col-xs-10">
      <a href="<?php print $item['search_url']; ?>"><?php print $item['title']; ?></a>
    </div>
    <div class="col-xs-2">
      <a href="<?php print $item['delete_url']; ?>"><?php print t('Delete'); ?></a>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-6">
      <?php print t('frequency e-mail alerts') ?>:
    </div>
    <div class="col-xs-6">
      <?php print drupal_render($item['form']); ?>
    </div>
  </div>

<hr />
<?php endforeach; ?>


