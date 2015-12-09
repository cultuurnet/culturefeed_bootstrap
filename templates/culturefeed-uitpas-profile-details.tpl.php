<?php

/**
 * @file
 * Default theme implementation to display culturefeed uitpas profile details.
 *
 * Available variables:
 * - $uitpas_title.
 * - $uitpas_numbers.
 * - $intro.
 * - $intro.
 * - $first_name.
 * - $last_name.
 * - $dob.
 * - $pob.
 * - $gender.
 * - $nationality.
 * - $street.
 * - $zip.
 * - $city.
 * - $tel.
 * - $mobile.
 * - $email.
 * - $kansenStatuut.
 * - $kansenStatuutValidEndDate.
 * - $status_title.
 * - $status_valid_till.
 * - $memberships.
 * - $outro.
 */
?>

<?php if ($intro): ?>
  <p class="intro"><?php print $intro; ?></p>
<?php endif; ?>

<h2><?php print $uitpas_title; ?> </h2>
<div class="uitpas_numbers panel panel-default"><?php print $uitpas_numbers; ?></div>

<h3><?php print $form_title; ?></h3>
<div id="personalData panel panel-default">

  <?php if ($form_intro): ?>
  <div class="form-intro"><?php print $form_intro; ?></div>
  <?php endif; ?>

  <?php print $form; ?>

  <?php if ($outro): ?>
  <p><?php print $outro; ?></p>
  <?php endif; ?>

</div>

<?php if ($kansen_statuut && $kansen_statuut_valid_end_date): ?>
<h3><?php print(t('My opportunities tariff')) ?></h3>
<div id="#opportunitiesTariff">
  <div class="status">
    <h4><?php print $status_title; ?></h4>
    <p><?php print $status_valid_till; ?></p>
    <?php if ($memberships): ?>
    <p><?php print $memberships; ?></p>
    <?php endif; ?>
  </div>
</div>
<?php endif; ?>

