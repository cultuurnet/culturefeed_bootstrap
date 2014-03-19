<div class="well well-mini">
  <div class="pull-right">
    <small><span class="muted"><?php print format_plural($message_count, '@count message', '@count messages') ?> | </span><?php print $delete_link; ?></small>
  </div>
  <div class="lead"><?php $subject ? print $subject : print '<span class="text-muted">' . t('No subject') . '</span>' ; ?></div>
<div>
  <strong>Van:</strong> <?php print $sender; ?><br />
  <strong>Aan:</strong> <?php print $recipient; ?><br /></div>
</div>

<?php foreach ($messages as $message): ?>
  <?php print $message; ?>
  <hr />
<?php endforeach; ?>

<div id="thread-delete-confirm" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-body"></div>
</div>
