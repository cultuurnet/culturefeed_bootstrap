<?php
/**
 * @file
 * Template for the calendar page.
 */
?>
<?php if ($shared) : ?>

  <p><?php print t('You can share this link with your friends'); ?></p>

  <div class="form-group">
    <div class="input-group">

      <input class="form-control" type="text" value="<?php print $calendar_share_url; ?>" id="share-url"/>

      <span class="input-group-btn">
        <button class="btn share-clipboard js-copy-to-clipboard" data-clipboard-target="#share-url">
          <i class="fa fa-clipboard"></i>
          <?php print t('Copy'); ?>
        </button>
      </span>

    </div>
  </div>

  <p class="status text-muted" style="display: none"><?php print t('Copied'); ?></p>

  <hr/>

  <p class="text-muted"><?php print t('Share on'); ?>
    <a type="button" class="facebook-share" href="<?php print $facebook_url; ?>">
      <i class="fa fa-facebook"></i>
      Facebook
    </a> <?php print t('or'); ?>

    <?php if (!empty($mail_url)) : ?>
      <a type="button" href="<?php print $mail_url; ?>">
      <i class="fa fa-inbox"></i>
      <?php print t('mail'); ?>
    </a>
    <?php endif; ?>
    .
  </p>

<?php else : ?>

  <p><?php print t('You have chosen earlier to not share your calendar.'); ?></p>
  <p>
    <?php print l(t('Edit settings'), 'culturefeed/calendar/settings'); ?>
  </p>

<?php endif; ?>
