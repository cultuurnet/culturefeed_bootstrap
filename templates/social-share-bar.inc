<?php
  if (!empty($personal_calendar_buttons)) {
    $col_width = 2;
  }
  else $col_width = 3;
?>

<div class="text-right">
  <i class="fa fa-envelope-o"></i> <?php print $mail_link; ?>
  <i class="fa fa-print"></i> <?php print $print_link; ?>
</div>

<hr />

<div class="row">

  <?php if (!empty($recommend_link)) : ?>
    <div class="col-xs-6 col-sm-<?php print $col_width; ?>">
      <span class="fa-stack">
        <i class="fa fa-circle fa-stack-2x"></i>
        <i class="fa fa-thumbs-up fa-stack-1x fa-inverse"></i>
      </span>
      <?php print $recommend_link; ?>
    </div>
  <?php endif; ?>

  <?php if (!empty($attend_link)) : ?>
    <div class="col-xs-6 col-sm-<?php print $col_width; ?>">
      <span class="fa-stack">
        <i class="fa fa-circle fa-stack-2x"></i>
        <i class="fa fa-check fa-stack-1x fa-inverse"></i>
      </span>
      <?php print $attend_link; ?>
    </div>
  <?php endif; ?>

  <div class="col-xs-6 col-sm-<?php print $col_width; ?>">
    <span class="fa-stack">
      <i class="fa fa-circle fa-stack-2x"></i>
      <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
    </span>
    <?php print $facebook_link; ?>
  </div>

  <div class="col-xs-6 col-sm-<?php print $col_width; ?>">
    <span class="fa-stack">
      <i class="fa fa-circle fa-stack-2x"></i>
      <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
    </span>
    <?php print $twitter_link; ?>
  </div>

  <?php if (!empty($personal_calendar_buttons)): ?>
    <div class="col-xs-12 col-sm-3 col-sm-offset-1">
      <?php foreach ($personal_calendar_buttons['footer'] as $button) : ?>
        <?php print $button; ?>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

</div>
