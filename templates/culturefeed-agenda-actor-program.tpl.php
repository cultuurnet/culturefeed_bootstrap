<?php
/**
 * @file 
 * Actor program file.
 */
?>

<?php if (!empty($items)): ?>
  <a href="<?php print $search_url ?>" class="btn btn-link pull-right hidden-xs"><?php print t('Full calendar'); ?> →</a>
  <p class="block-title"><?php print t('Calendar'); ?></p>
  <ul class="list-unstyled">
    <?php foreach ($items as $item): ?>
      <li><?php print $item ?></li>
    <?php endforeach;?>
  </ul>

  <p>
    <a href="<?php print $search_url ?>" class="btn btn-default"><?php print t('Show full calendar of') . ' ' . $title; ?> →</a>
  </p>
<?php else: ?>
  <h3><i class="fa fa-calendar-o 2-x fa-fw"></i> <?php print t('Calendar'); ?></h3>
  <p class="text-muted"><?php print t('There are currently no activities available.'); ?></p>
<?php endif; ?> 

<br />
