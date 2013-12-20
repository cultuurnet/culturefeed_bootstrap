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

<hr />

<div class="panel-group profile uitpas" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#uitpas">
          <i class="fa fa-caret-down"></i> <?php print $uitpas_title; ?>  
        </a>
      </h3>
    </div>
    <div id="uitpas" class="panel-collapse collapse in">
      <div class="panel-body">
          <div class="uitpas_numbers"><?php print $uitpas_numbers; ?></div>
      </div>
    </div>
  </div>
  
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#personalData">
          <i class="fa fa-caret-down"></i> <?php print(t('My personal data')) ?>  
        </a>
      </h3>
    </div>  
    <div id="personalData" class="panel-collapse collapse">
      <div class="panel-body">  
      
          <?php if ($intro): ?>
          <p><?php print $intro; ?></p>
          <?php endif; ?>
        
          <ul class="data">
            <li><?php print $first_name; ?></li>
            <li><?php print $last_name; ?></li>
            <li><?php print $dob; ?></li>
            <li><?php print $pob; ?></li>
            <li><?php print $gender; ?></li>
            <li><?php print $nationality; ?></li>
            <li><?php print $street; ?></li>
            <li><?php print $zip; ?></li>
            <li><?php print $city; ?></li>
            <li><?php print $tel; ?></li>
            <li><?php print $mobile; ?></li>
            <li><?php print $email; ?></li>
          </ul>

          <?php if ($outro): ?>
          <p><?php print $outro; ?></p>
          <?php endif; ?>

      </div>
    </div>
  </div>
  
  <?php if ($kansen_statuut && $kansen_statuut_valid_end_date): ?>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#opportunitiesTariff">
          <i class="fa fa-caret-down"></i> <?php print(t('My opportunities tariff')) ?>  
        </a>
      </h3>
    </div>  
    <div id="#opportunitiesTariff" class="panel-collapse collapse">
      <div class="panel-body">    
          <div class="status">
            <h3><?php print $status_title; ?></h3>
            <p><?php print $status_valid_till; ?></p>
            <?php if ($memberships): ?>
            <p><?php print $memberships; ?></p>
            <?php endif; ?>
          </div>
      </div>
    </div>
  </div>
  <?php endif; ?>

</div>

