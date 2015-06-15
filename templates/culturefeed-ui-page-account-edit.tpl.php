<?php

/**
 * @file
 * Template to render the page account edit page.
 */
?>

<?php if ($intro): ?>
  <div id="account-edit-intro">
    <?php print $intro; ?>
  </div>
<?php endif; ?>

<?php print $profile_menu; ?>

<div id="account-edit-form">
  <?php print $form ?>
</div>
<hr />

<h4><?php print t('Connected accounts'); ?></h4>
<div id="online_accounts">
  <?php print $online_accounts ?>
</div>
<hr />

<h4><?php print t('Connected applications'); ?></h4>
<div id="manage-consumers">
  <p><?php print $connected_applications; ?></p>
</div>
