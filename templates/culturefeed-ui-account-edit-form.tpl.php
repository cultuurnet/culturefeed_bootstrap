<?php

/**
 * @file
 * Contains culturefeed-ui-account-edit-form.tpl.php.
 */

?>

<div class="row">
  <div class="col-sm-6"><?php print $nick; ?></div>
</div>
<div class="row">
  <div class="col-sm-6"><?php print $mbox; ?></div>
</div>
<div class="row actions">
  <div class="col-xs-12">
    <div class="form-group">
      <?php print $submit; ?><?php print $change_password; ?>
    </div>
  </div>
</div>
<?php print $main_form; ?>
