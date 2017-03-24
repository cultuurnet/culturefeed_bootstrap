<?php print render($form); ?>

<?php if ($search || $zipcode): ?>
  <?php print $total_results_message; ?>
  <?php if (!empty($items)): ?>
  <ul class="media-list">
    <?php foreach ($items as $item): ?>
    <li class="media">
      <?php print $item; ?>
    </li>
    <?php endforeach; ?>
  </ul>
  <?php endif;?>

<hr />

<?php print $create_message; ?>

<?php endif; ?>
