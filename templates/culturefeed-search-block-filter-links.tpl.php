<?php
/**
 * @file
 * Template file for culturefeed search links as facet.
 */

/**
 * @var array $items
 */
?>

<ul class="facet-search facet-level-1 list-unstyled">
<?php foreach ($items as $item): ?>
  <li>
    <?php print $item['data'] ?>
  </li>
<?php endforeach; ?>
</ul>