<?php
/**
 * @file
 * Template for showing the manage list of saved searches.
 */
?>

<?php if (!empty($items)): ?>

  <div id="saved-searches-messages"></div>

  <?php foreach ($items as $item): ?>

    <div class="row">
      <div class="col-sm-10">
        <div class="row">
          <div class="col-sm-6">
            <h5><a href="<?php print $item['search_url']; ?>"><?php print $item['title']; ?></a></h5>
          </div>
          <div class="col-sm-6">
            <strong><?php print t('frequency e-mail alerts') ?>:</strong>
            <?php print drupal_render($item['form']); ?>
          </div>
        </div>
      </div>
      <div class="col-sm-2">
        <a href="<?php print $item['delete_url']; ?>"><?php print t('Delete'); ?></a>
      </div>
    </div>

  <hr />
  <?php endforeach; ?>


<?php else: ?>

  <div class="alert alert-info"><?php print t('There are no saved searches yet') ?></div>

<?php endif; ?>

