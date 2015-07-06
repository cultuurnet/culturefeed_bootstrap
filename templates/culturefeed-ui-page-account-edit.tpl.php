<?php

/**
 * @file
 * Template to render the page account edit page.
 */
?>
<div class="user user-account">
  <!--intro-->
  <?php if ($intro): ?>
      <?php print $intro; ?>
  <?php endif; ?>
  <!--tabs-->
  <?php print $profile_shortcuts; ?>
  <!--form-->
  <?php print $form ?>
  <hr />
  <!--links-->
  <div class="block block-links">
    <h4><?php print t('Connected accounts'); ?></h4>
    <?php print $online_accounts ?>
  </div>
  <hr />
  <div class="block block-links">
    <h4><?php print t('Connected applications'); ?> <small><?php print l(t('User history'), 'culturefeed/activities'); ?></small></h4>
    <?php print $connected_applications; ?>
  </div>
</div>
