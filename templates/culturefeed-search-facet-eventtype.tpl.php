<?php
/**
 * @file
 * * Template file for one culturefeed search facet of an event type.
 */
/**
 * @var string $items
 */
?>

<ul class="facet-search facet-level-1 list-unstyled">
  <?php foreach ($event_types as $facet_item): ?>
    <li><?php print $facet_item; ?></li>
  <?php endforeach; ?>
</ul>
