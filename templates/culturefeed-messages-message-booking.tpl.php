<div class="row">
  <div class="col-sm-2">
    <?php if ($picture): ?>
      <div class="hidden-xs">
        <?php print $picture; ?>
      </div>
    <?php else: ?>
      <img src="http://media.uitid.be/fis/rest/download/ce126667652776f0e9e55160f12f5478/uiv/default.png?maxwidth=70&maxheight=70&crop=auto" class="hidden-xs" alt="<?php print t('Default user image'); ?>" />
    <?php endif; ?>
  </div>
  <div class="col-sm-10">
    <blockquote>
      <p><small class="pull-right text-muted"><?php print $date; ?></small> <?php print $sender; ?> <?php print t('sent a booking request for'); ?> <strong><?php print $subject ?></strong> <?php print t('with the following information'); ?>: </p>
      <hr>
      <p><strong><?php print t('Level'); ?></strong>: <?php print $levels ?></p>
      <p><strong><?php print t('Number of participants'); ?></strong>: <?php print $persons ?></p>
      <p><strong><?php print t('Additional information'); ?></strong>: <?php print $body; ?></p>
    </blockquote>
  </div>
</div>
