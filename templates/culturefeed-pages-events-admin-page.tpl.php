<h3><?php print t('My events'); ?></h3>
 
<?php if (!empty($items)): ?>
  <p><?php print t('The list below shows all the <strong>events</strong> that are <strong>currently published on') . ' ' .  $page_link . ' ' . '</strong>' . t('Past or unpublished events can be consulted via <a href="http://www.uitdatabank.be" target="_blank" class="alert-link">UiTdatabank.be</a>.'); ?>
  </p>

  <?php print $items; ?>

  <?php print theme('pager') ?>

<?php else: ?>
  <p class="alert alert-warning">
    <?php print t('There are currently <strong>no published events</strong> for')  . ' ' .  $page_link . '.' . ' ' . t('Past or unpublished events can be consulted via <a href="http://www.uitdatabank.be" target="_blank">UiTdatabank.be</a>.') ?>
  </p>
<?php endif; ?>

<p>
  <a class="btn btn-default" href="http://www.uitdatabank.be" target="_blank"><i class="fa fa-plus-circle"></i> <?php print t('Add new event'); ?></a> 
</p>

<p>
  <small class="text-muted"><?php print t('You can sign in with your current username and password.'); ?></small>
</p>
