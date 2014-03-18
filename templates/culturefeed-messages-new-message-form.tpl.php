<?php

/**
 * @file
 * Default theme implementation to provide a new message form
 */

$button_printed = render($form['submit']);
?>


<div class="panel panel-default">

  <div class="panel-heading">

    <h3 class="panel-title">
      <?php print render($form['title']); ?>
    </h3>

  </div>

  <div id="reply">

    <div class="panel-body">

      <div class="new-message-primary">
      <?php print render($form['subject'])?>
      <?php print render($form['message'])?>
      </div>

      <div class="new-message-secondary">
        <?php print drupal_render_children($form); ?>
      </div>

    </div>

    <div class="panel-footer">

       <?php
        // Render the button as last one.
        print $button_printed ?>

    </div>

  </div>

</div>
