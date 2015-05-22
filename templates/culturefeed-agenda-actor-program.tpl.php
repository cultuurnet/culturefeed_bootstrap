<?php
/**
 * @file 
 * Actor program file.
 */
?>

<?php if (!empty($items)): ?>
  <p class="block-title">
    <?php print t('Calendar'); ?>
    <span class="pull-right hidden-xs">
      <a href="<?php print $search_url ?>" class=""><?php print t('Full calendar'); ?> →</a>
    </span>
  </p>
  
  <ul class="list-unstyled">
    <?php foreach ($items as $item): ?>
      <li><?php print $item ?></li>
    <?php endforeach;?>
  </ul>

  <p class="text-center">
    <a href="<?php print $search_url ?>"><?php print t('Show full calendar of') . ' ' . $title; ?></a>
  </p>
<?php else: ?>
  <h3><i class="fa fa-calendar-o 2-x fa-fw"></i> <?php print t('Calendar'); ?></h3>
  <p class="text-muted"><?php print t('There are currently no activities available.'); ?></p>
<?php endif; ?> 

<hr />
