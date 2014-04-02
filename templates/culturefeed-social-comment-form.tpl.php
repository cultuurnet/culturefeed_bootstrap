<?php

/**
 * @file
 * Default theme implementation to provide a comment form
 */

$button_printed = render($form['submit']);
?>

<div class="panel panel-default collapse in" id="comment-form">
  <div class="panel-body">
    <?php print render($form['message'])?>
    <small class="text-muted"><?php print render($form['update_optin'])?></small>
    <?php print drupal_render_children($form); ?>
  </div>
  <div class="panel-footer">
    <?php
    // Render the button as last one.
    print $button_printed ?>
  </div>
</div>
