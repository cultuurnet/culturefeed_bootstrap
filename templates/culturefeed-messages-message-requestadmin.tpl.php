<div class="row">
  <div class="col-sm-2">
    <?php if ($picture): ?>
      <div class="hidden-xs">
        <?php print $picture; ?>
      </div>
    <?php else: ?>
      <img src="http://media.uitid.be/fis/rest/download/ce126667652776f0e9e55160f12f5478/uiv/default.png?maxwidth=70&maxheight=70&crop=auto" class="hidden-xs" />
    <?php endif; ?>
  </div>
  <div class="col-sm-10">
    <blockquote>
      <p><strong><?php print $sender; ?></strong> <small class="pull-right text-muted"><?php print $date; ?></small></p>
      <hr>
      <p><?php print $sender; ?> <?php print t('requested administrator rights for'); ?> <strong><?php isset($recipient_page) ? print $recipient_page : '' ; ?></strong>.</p>
      <p><?php print $body; ?></p>
    </blockquote>
  </div>
</div>

