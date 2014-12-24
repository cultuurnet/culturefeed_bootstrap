<?php

/**
 * @file
 * Template to render the page account edit page.
 */
?>

<?php print $account ?>

<div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <span class="caret"></span>
        <a href="#online_accounts" data-toggle="collapse" data-parent="#accordion">
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
        <a href="#manage-consumers" data-toggle="collapse" data-parent="#accordion">
          <?php print t('Connected applications'); ?>
        </a>
      </h4>
    </div>
    <div id="manage-consumers" class="panel-collapse collapse">
      <div class="panel-body">
        <p><?php print l(t('Manage websites and applications'), 'culturefeed/serviceconsumers'); ?> <?php print t('who uses your UiTiD profile.'); ?></p>
      </div>
    </div>
  </div>
</div>
