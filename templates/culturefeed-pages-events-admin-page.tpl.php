<h3><?php print t('Activities'); ?></h3>
 
<?php if (empty($items)): ?>
  <p><?php print t('The list below shows all the <strong>activities</strong> that are <strong>currently published on') . ' ' .  $page_link . ' ' . '</strong>' . t('Past or unpublished activities can be consulted via <a href="http://www.uitdatabank.be" target="_blank" class="alert-link"> UiTdatabank.be</a>.'); ?>
  </p>

  <?php print $items; ?>

  <?php print theme('pager') ?>

<?php else: ?>
  <p>
    <?php print t('There are <strong>currently no published activities available for')  . ' ' .  $page_link . ' ' . '</strong>.' . ' ' . t('Past or unpublished activities can be consulted via <a href="http://www.uitdatabank.be" target="_blank" class="alert-link"> UiTdatabank.be </a>.') ?>
  </p>
<?php endif; ?>

<p><a class="btn btn-default" href="http://www.uitdatabank.be" target="_blank"><?php print t('Add a new activity via UiTdatabank'); ?> <i class="fa fa-external-link"></i> </a> <span class="text-muted"><?php print t('You can sign in with your current username and password.'); ?></span></p>
