<div class="tooltip-login hover">
  <p><?php print t('You have temporarily added events to your calendar. Log in and save the events to you personal calendar.') ?></p>
  <hr class="small" />
  <div class="row">
    <div class="col-lg-6">
      <?php print l(t('Log in'), $url, $options) ?>
    </div>
    <div class="col-lg-6">
      <?php print l(t('View calendar'), 'culturefeed/calendar', array('attributes' => array('class' => array('', 'btn-link btn-block text-center')))) ?>
    </div>
  </div>
</div>
