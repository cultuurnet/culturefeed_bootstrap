<a href="<?php print $url; ?>" class="message message-<?php print $status; ?> list-group-item">
  <?php $status == 'NEW' ? print '<div class="pull-right"><i class="fa fa-envelope"></i></div>' : '' ?>
  <strong><?php print $sender; ?></strong><br />
  <?php isset($recipient_page) ? print '<small>' . t('To') . ':' . ' ' . $recipient_page . '</small><br />' : '' ; ?>
  <small class="text-muted"><?php print $date; ?></small>
</a>
