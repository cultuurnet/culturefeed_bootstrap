<div class="tooltip-login hover">
  <p class="small text-muted"><?php print t('You have temporarily added events to your calendar. Log in and save the events to your personal calendar.') ?></p>
  <?php print l(t('Log in'), $url, $options) ?>
  <?php print l(t('View calendar'), 'culturefeed/calendar', array('attributes' => array('class' => array('btn', 'btn-link', 'btn-block', 'text-center')))) ?>
</div>
