<?php
/**
 * @file
 * Template for the calendar page.
 */
?>

<div class="page-header">
  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-7 col-lg-8">
      <h1><?php print t('Calendar') ?>
        <small class="cf-calender-name">
          <?php if (!empty($user_name)) : ?>
            <?php print ' ' . t('of') . ' ' . $user_name ?>
          <?php endif; ?>
        </small>
      </h1>
    </div>
    <div class="col-sm-6 col-md-5 col-lg-4">
        <ul class="nav nav-pills calendar-subnav">
          <?php if (!empty($calendar_settings_path)) : ?>
            <li>
              <a class="text-center" href="<?php print url($calendar_settings_path); ?>">
                <i class="fa fa fa-cog hidden-xs"></i>
                <span><?php print t('Settings') ?></span>
              </a>
            </li>
          <?php endif; ?>
          <?php if (!empty($share_calendar_path)) : ?>
            <li>
              <a class="text-center" href="<?php print url($share_calendar_path); ?>"
                  data-toggle="popover"
                  data-placement="bottom"
                  data-html="true"
                  data-content='<?php print $data_content ?>'
                >
                <i class="fa fa-share-square-o hidden-xs"></i>
                <span><?php print t('Share your calendar') ?></span>
              </a>
            </li>
          <?php endif; ?>
        </ul>
    </div>
  </div>
  <div class="row">
    <?php if (!empty($login_url)) : ?>
      <div class="col-xs-12">
        <div class="lead">
        <a href="<?php print $login_url ?>" class="btn btn-default"><?php print t('Login') ?></a>
        </div>
      </div>
    <?php endif; ?>
    </div>
  </div>
</div>

<?php if ($deny_access) : ?>
  <h3><?php print t('This calendar has not been shared yet.') ?></h3>
<?php else : ?>
  <div class="row">
    <section  class="col-md-12">
      <?php if (!empty($nav_months)) : ?>
        <?php print $nav_months ?>
      <?php endif; ?>
    </section>
  </div>

  <div class="row">
    <section class="col-md-9">
      <?php if (!empty($planned)): ?>
        <?php print $planned ?>
      <?php else: ?>
        <p class="h1 text-center lead text-muted">
            <i class="fa fa-calendar-o"></i>
        </p>
        <p class="text-center lead"><?php print t('No activities added to your calendar yet.') ?></p>
      <?php endif; ?>
    </section>
    <aside class="col-md-3" role="complementary">
      <div class="region region-sidebar-first">
        <?php if (!empty($not_yet_planned)): ?>
        <div class="panel panel-default">
          <div class="panel-body">
              <?php print $not_yet_planned ?>
          </div>
        </div>
        <?php endif; ?>
      </div>
    </aside>
  </div>
<?php endif; ?>
