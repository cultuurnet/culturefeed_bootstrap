<?php
/**
 * @file
 * Template for the calendar page.
 */
?>
<?php if ($shared) : ?>

  <?php print l(t('Back to my calendar'), $back_to_calendar_path); ?>

  <h3><?php print t('Share your calendar with your friends'); ?></h3>
  <p><?php print t('You can share this link with your friends'); ?></p>
  <p class="well"><?php print $calendar_share_url; ?></p>
  <p>
    <a type="button" class="btn btn-default facebook-share" href="<?php print $facebook_url; ?>">
      <i class="fa fa-facebook"></i>
      Facebook
    </a>
    <a type="button" class="btn btn-default" href="<?php print $googleplus_url; ?>">
      <i class="fa fa-google-plus"></i>
      Google+
    </a>
  </p>
  <p>
    <a type="button" class="btn btn-default" href="<?php print $twitter_url; ?>">
      <i class="fa fa-twitter"></i>
      Twitter
    </a>
    <?php if (!empty($mail_url)) : ?>
      <a type="button" class="btn btn-default" href="<?php print $mail_url; ?>">
      <i class="fa fa-inbox"></i>
      Mail
    </a>
    <?php endif; ?>
  </p>

<?php else : ?>

  <p><?php print t('You have chosen earlier to not share your calendar. You can change this in your settings.'); ?></p>
  <p>
    <?php print l(t('Edit settings'), 'culturefeed/calendar/settings'); ?>
  </p>

<?php endif; ?>





