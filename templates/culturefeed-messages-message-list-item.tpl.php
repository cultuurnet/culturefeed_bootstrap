<a href="<?php print $url; ?>" class="message message-<?php print $status; ?> <?php print $class_name ?> list-group-item">
  <?php $status == 'NEW' ? print '<i class="fa fa-fw fa-envelope"></i> <strong>' . $subject . '</strong>' : print '<i class="fa fa-fw fa-envelope-o"></i> ' . $subject ?> <small class="text-muted">-     <?php print $date; ?></small>
  <small class="text-muted">
    <br />
    <?php isset($sender) ? print t('From') . ':' . ' ' . $sender  : '' ; ?>
    <br />
    <?php isset($recipient_page) ? print t('To') . ':' . ' ' . $recipient_page : '' ; ?>
  </small>
  
</a>
