<?php
/**
 * @file
 * Template for the calendar add or view buttons.
 */
?>

<div class="calendar-button">
  <?php if (isset($button['description'])) : ?>
    <?php print $button['description']; ?>
  <?php endif; ?>

  <a href="<?php print url($button['path']); ?>" data-toggle="modal" data-target="#modal-calendar" data-remote="<?php print url($button['path']); ?>/ajax"><?php print $button['text']; ?></a>
</div>

<div id="modal-calendar" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-body outer"></div>
</div>
