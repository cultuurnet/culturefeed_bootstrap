<?php
/**
 * @file 
 * Actor program file.
 */
?>


<?php if (!empty($items)): ?>
  <h2><i class="fa fa-calendar 2-x"></i> <?php print t('Calendar'); ?></h2>
  <ul class="bullets">
  <?php foreach ($items as $item): ?>
  <li><?php print $item ?></li>
  <?php endforeach;?>
  </ul>
  <p><a href="<?php print $search_url ?>" class="btn btn-default"><?php print t('More activities'); ?> →</a></p>
<?php else: ?>
  <h3><i class="fa fa-calendar-o 2-x"></i> <?php print t('Calendar'); ?></h3>
  <p class="muted"><?php print t('There are currently no activities available.'); ?></p>
<?php endif; ?> 
