<a href="<?php print $url; ?>" class="message message-<?php print $status; ?> <?php print $class_name ?> list-group-item">
  <?php if ($status == 'NEW') : ?>
    <i class="fa fa-fw fa-envelope text-danger pull-right"></i>
    <small class="text-muted"><?php print $date; ?></small>
    <h5 class="list-group-item-heading"><strong><?php print $subject; ?></strong></h5>
  <?php else : ?>
    <i class="fa fa-fw fa-envelope-o text-muted pull-right"></i>
    <small class="text-muted"><?php print $date; ?></small>
    <h5 class="list-group-item-heading"><?php print $subject; ?></h5>
  <?php endif; ?>
  <p class="list-group-item-text">
    <small class="text-muted">
      <?php isset($sender) ? print $sender  : '' ; ?>
      <i class="fa fa-long-arrow-right"></i>
      <?php isset($recipient_page) ? print $recipient_page : '' ; ?>
    </small>
  </p>
</a>
