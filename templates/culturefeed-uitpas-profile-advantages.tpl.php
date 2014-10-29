<?php

/**
 * @file
 * Default theme implementation to display culturefeed uitpas profile 
 * advantages.
 *
 * Available variables:
 * - $advantages_table: The list of advantages.
 */
?>

<div id="profile_advantages_link">
  <ul class="nav nav-tabs">
    <li class="lead"><a href="/culturefeed/profile/uitpas/promotions"><?php print t('My Promotions') ?></a></li>
    <li class="active lead"><a href="/culturefeed/profile/uitpas/advantages"><?php print t('Welcome Advantages') ?></a></li>
  </ul>
</div>

<div class="table-responsive">
  <?php print $profile_advantages_table; ?>
</div>
