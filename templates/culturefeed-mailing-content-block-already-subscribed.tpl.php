<?php
/**
 * @file
 * Template for the subscribed message.
 */
?>

<div class="row">
  <div class="col-sm-12">
    <?php print $message; ?>
    <p>
        <?php print $unsubscribe_link; ?>
        <br>
        <?php print $update_link; ?>
    </p>
  </div>
</div>
