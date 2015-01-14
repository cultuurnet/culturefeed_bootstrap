<?php
/**
 * @file
 * Template for the calendar page.
 */
?>


  <row>
    <?php if (!empty($save_cookie_button)) : ?>
    <section  class="col-md-12">
      <?php print $save_cookie_button ?>
    </section>
    <?php endif; ?>
    <?php if (!empty($share_calendar_button)) : ?>
    <section  class="col-md-12">
      <?php print $share_calendar_button ?>
    </section>
    <?php endif; ?>
  </row>



<row>
  <section  class="col-md-12">
    <?php if (!empty($nav_months)) : ?>
      <?php print $nav_months ?>
    <?php endif; ?>
  </section>
</row>

<row>
  <aside class="col-md-3" role="complementary">
    <div class="region region-sidebar-first">
      <div class="panel panel-default">
        <div class="panel-body">
          SIDEBAR
          <?php print $sidebar; ?>
        </div>
      </div>
    </div>
  </aside>
  <section class="col-md-9">
    <?php if (!empty($planned) || !empty($not_yet_planned)): ?>
      <?php print $not_yet_planned ?>
      <?php print $planned ?>
    <?php else: ?>
      <p class="alert alert-info"><?php print t('No events added to your calendar yet.') ?></p>
    <?php endif; ?>
  </section>
</row>
