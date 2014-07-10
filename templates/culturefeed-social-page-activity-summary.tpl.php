<?php
/**
 * @file
 * Template file for a list of activities for a <activity_type> and a <content_type>.
 *
 * All variables are available (as convention) in the format of:
 *   - $event_14 (Comments for events), $event_15, $book_14, ... etc.
 *
 * To make it easier, some variables are already prepared to use in this file.
 * Those variables are listed beneath. Ofcourse we can always count the counts together
 * for all other custom calculations.
 *
 * @var
 * Variables for content types in general (all content types).
 * - total_14
 * - total_15
 *
 * Variables specific for an activity type
 * - books_total_<activity_type_number>
 * - pages_total_<activity_type_number>
 * - activities_total_<activity_type_number>
 *
 * E.g.:
 * - total_14
 * - activities_total_14
 * - books_total_14
 * - pages_total_14
 */
?>

<h4><?php print $subject; ?></h4>

<ul class="list-unstyled">

  <li>
    <span class="pull-right">
      <i class="fa fa-fw fa-lg fa-user"></i> <?php print $activities_total_18 ?>
    </span>
    <?php print t('followers'); ?>
    <hr class="small">
  </li>

  <li>
    <span class="pull-right">
      <i class="fa fa-fw fa-lg fa-users"></i> <?php print $activities_total_16 ?>
    </span>
    <?php print t('members'); ?>
    <hr class="small">
  </li>

  <li>
    <span class="pull-right">
      <i class="fa fa-fw fa-lg fa-thumbs-up"></i> <?php print $activities_total_15 ?>
    </span>
    <?php print t('recommends'); ?>
    <hr class="small">
  </li>

  <li>
    <span class="pull-right">
      <i class="fa fa-fw fa-lg fa-comments"></i> <?php print $activities_total_14 ?>
    </span>
    <?php print t('comments'); ?>
    <hr class="small">
  </li>

</ul>