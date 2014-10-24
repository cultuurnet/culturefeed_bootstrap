<?php

/**
 * @file
 * Default theme implementation to display culturefeed uitpas promotions
 * promotions.
 *
 * Available variables:
 * - $page_elements: feedback position of the pager.
 * - $promotions_table: The list of promotions.
 * - $info: Info text.
 */
?>
<div class="promotions">
  <div class="page_elements pull-right"><?php print $page_elements; ?></div>
  <div class="promotions_table"><?php print $promotions_table; ?></div>

  <div class="info"><?php print $info; ?></div>
</div>
