<?php
/**
 * @file
 * Template for the summary of a page.
 */
?>

<div class="media">

  <?php if (!empty($image)): ?>
  <a class="pull-right" href="<?php print $url ?>">
    <img class="media-object img-thumbnail" src="<?php print $image; ?>?width=150&scale=both" alt="<?php print $title; ?>">
  </a>
  <?php endif; ?>
  
  <div class="media-body">
    <div class="row">
      <div class="col-md-9">
        <h3 class="media-heading"><a href="<?php print $url ?>"><?php print $title; ?> <?php if (!empty($address)): ?><span class="text-muted">- <?php print $address['city']; ?><?php endif; ?></span></a></h3>
      </div>
      <div class="col-md-3 text-right hidden-sm hidden-xs">
        <?php if ($follower_count > 0): ?>
        <div class="btn-group btn-group-xs">
        <?php print format_plural($follower_count, '<span class="btn btn-success"><strong>' . '@count' . '</strong></span><span class="btn btn-default">' .   t('follower') . '</span>' , '<span class="btn btn-success">' . '@count' . '</span><span class="btn btn-default">' .   t('followers') . '</span>'); ?>
        </div>
        <?php endif; ?>
      </div>
    </div>
  
    <p><?php print $description ?></p>

    <p><a class="btn btn-default btn-sm" href="<?php print $url; ?>"><?php print $more_text; ?> &rarr;</a></p>
  
  </div>

</div>

<hr />
