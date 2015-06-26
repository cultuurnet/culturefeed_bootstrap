<?php

/**
 * @file
 * Contains culturefeed-ui-profile-edit-form.tpl.php.
 */

?>
<div class="row">
  <div class="col-sm-6"><?php print $givenName; ?></div>
  <div class="col-sm-6"><?php print $familyName; ?></div>
</div>
<div class="row">
  <div class="col-sm-6"><?php print $dob; ?></div>
  <div class="col-sm-6"><?php print $gender; ?></div>
</div>
<div class="row">
  <?php print $picture; ?>
</div>
<hr />
<div class="row">
  <div class="col-xs-12"><?php print $street; ?></div>
</div>
<div class="row">
  <div class="col-sm-3"><?php print $zip; ?></div>
  <div class="col-sm-9"><?php print $city; ?></div>
</div>
<div class="row">
  <div class="col-xs-6"><?php print $country; ?></div>
</div>
<hr />
<div class="row">
  <div class="col-xs-12"><?php print $bio; ?></div>
</div>
<div class="row">
  <div class="col-xs-12"><?php print $main_form; ?></div>
</div>
