<?php
/**
 * @file
 * Template for the calendar page.
 */
?>

<row>
  <div class="page-header">
    <h1>
      <?php print t('OuTcalendar') ?>
      <small>
        <?php print ' ' . t('of') . ' ' . $user_name ?>
      </small>
  </h1>
  </div>
  <ul class="nav nav-pills">
    <?php if (!empty($share_calendar_url)) : ?>
      <li>
        <a class="text-center"
           href="<?php print $share_calendar_url ?>"
          <?php if (!$shared) :?>
            data-toggle="popover"
            data-trigger="focus"
            data-placement="bottom"
            data-html="true"
            data-content='<?php print $data_content ?>'
          <?php endif; ?>
          >
          <i class="fa fa-share-square-o"></i>
          <div><?php print t('Share') ?></div>
        </a>
      </li>
    <?php endif; ?>
  </ul>
  <?php if (!empty($save_cookie_button)) : ?>
    <div class='pull-right'>
      <?php print $save_cookie_button ?>
    </div>
  <?php endif; ?>
</row>


<?php if ($deny_access) : ?>
  <h3><?php print t("This calendar has not been shared yet.") ?></h3>
<?php else : ?>
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
        <h3><?php print t('No activities added to your calendar yet.') ?></h3>
      <?php endif; ?>
    </section>
  </row>
<?php endif; ?>
