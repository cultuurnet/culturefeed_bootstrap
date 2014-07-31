<?php

/**
 * @file
 * Template for detailpage of a news item activity.
 */
$col = empty($image) ? '12' : '8';
?>

<?php if (!empty($page_cover)): ?>
  <div class="row">
    <div class="col-sm-12 hidden-xs">
      <img src="<?php print $page_cover ?>?width=1000&height=200&crop=auto" class="img-responsive" />
    </div>
  </div>
<?php endif; ?>

<div class="row">

  <div class="col-sm-<?php print $col; ?>">

    <?php if (!empty($page_baseline)): ?>
      <p class="text-muted"><?php print $page_baseline ?></p>
    <?php endif; ?>

    <div class="text-muted hidden-xs hidden-sm">
      <?php print $date ?>
    </div>

    <div>
      <?php print $body; ?>
    </div>

    <?php if (!empty($page_admin)): ?>
      <a href="<?php print url('pages/' . $page_id . '/news/delete/' . $activity_id); ?>"><?php print t('Delete news item') ?></a>
    <?php endif; ?>

  </div>

  <?php if (!empty($image)): ?>
  <div class="col-sm-4">
    <img class="img-thumbnail hidden-xs" src="<?php print $image ?>" alt="<?php print $title; ?>" />
  </div>
  <?php endif; ?>

</div>


