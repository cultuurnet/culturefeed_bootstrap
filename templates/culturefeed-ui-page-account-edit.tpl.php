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
</div><hr />

<div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <span class="caret"></span>
        <a data-toggle="collapse" data-parent="#accordion" href="#online_accounts">
          <?php print t('Connected accounts'); ?>
        </a>
      </h4>
    </div>
    <div id="online_accounts" class="panel-collapse collapse">
      <div class="panel-body">
        <?php print $online_accounts ?>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <span class="caret"></span>
        <a data-toggle="collapse" data-parent="#accordion" href="#manage-consumers">
          <?php print t('Connected applications'); ?>
        </a>
      </h4>
    </div>
    <div id="manage-consumers" class="panel-collapse collapse">
      <div class="panel-body">
        <p><?php print $connected_applications; ?></p>
      </div>
    </div>
  </div>
</div>
