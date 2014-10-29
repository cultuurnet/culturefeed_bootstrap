<?php

/**
 * @file
 * Default theme implementation to display culturefeed uitpas advantages
 * promotions.
 *
 * Available variables:
 * - $promotions_table: The list of promotions.
 * - $advantages_table: The list of advantages.
 * - $info: Info text.
 */
?>

<div id="advantages_link">
  <ul class="nav nav-tabs">
    <li class="lead"><a href="/promotions"><?php print t('Promotions') ?></a></li>
    <li class="active lead"><a href="/advantages"><?php print t('Welcome Advantages') ?></a></li>
  </ul>
</div>

<div class="well">
  <p>Als je een <a href="/register_where">UiTPAS koopt</a>, krijg je bij verschillende UiTPASaanbieders een <span class="text-highlight">welkomstvoordeel</span>. Vraag ernaar bij de balie van de aanbieder.</p>
</div>

<div class="table-responsive">
  <?php print $advantages_table; ?>
</div>






