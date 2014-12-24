<?php
/**
 * @file
 * Template file for the administrative options for a page.
 *
 * @vars
 * - $account The DrupalCultureFeed loggedin user
 * - $page The Page object
 * - $is_page_admin is Page Admin,
 * - $logged_in_as_page_admin Logged In As Page Admin
 *
 */
?>

<?php if ($logged_in_as_page_admin): ?>

  <div class="alert alert-info">

    <div>
      <div class="btn-group pull-right">
        <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cogs fa-fw fa-lg"></i> <?php print t('Manage page'); ?> <span class="caret"></span></button>
        <?php print $admin_menu; ?>
      </div>
    </div>

    <div class="clearfix"></div>
    <br />

    <?php if (!empty($notifications)): ?>
      <p><strong><?php print t('Latest notifications'); ?></strong></p>
      <div>
        <?php print $notifications; ?>
      </div>
    <?php endif; ?>

    <?php if (!$has_activities): ?>
      <hr />
      <div class="alert alert-warning">
        <small>
          <?php print t('Your page currently has no published activities.'); ?>
          <br />
          <a href="http://www.uitdatabank.be" class="alert-link">
            <?php print t('Add an activity via UiTdatabank.be'); ?>
          </a>
        </small>
      </div>
    <?php endif; ?>
  </div>

<?php else: ?>

  <div class="alert alert-info">
    <h4><?php print t('Switch page'); ?></h4>
    <p><small><?php print t('You have <strong>administrator privileges</strong> for this page. In order to make any changes, please <strong>change your active page</strong>:'); ?></small></p>
    <hr class="small" />
    <p><?php print $switch_link; ?></p>
  </div>
  
<?php endif; ?>
