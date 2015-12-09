<?php
/**
 * @file
 * Nearby actor search file.
 */
?>

<?php if (!empty($links)): ?>
  <ul class="list-unstyled">
    <?php foreach ($links as $link): ?>
      <li><?php print $link ?></li>
    <?php endforeach; ?>
  </ul>   
<?php endif; ?>
