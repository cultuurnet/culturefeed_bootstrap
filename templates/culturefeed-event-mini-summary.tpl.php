<?php
/**
 * @file
 * Template for the mini summary of a production.
 */
?>

<div class="row">
  <div class="col-md-10">
  
    <div class="media">
    
      <a class="pull-left" href="#">
        <?php if (!empty($thumbnail)): ?>
        <img class="media-object img-thumbnail" src="<?php print $thumbnail; ?>?width=50&height=50&crop=auto" />
        <?php endif; ?>
      </a>
    
      <div class="media-body">
        <h4 class="media-heading"><a href="<?php print $url ?>"><?php print $title; ?></a></h4>
        <p>
          <?php if (!empty($themes)): ?>
          <span class="text-muted"><?php print $themes[0] ?></span>
          <?php endif; ?>
          <br />
          <?php if (isset($location['city'])): ?>
          <?php print $location['city']; ?>
          <?php endif;?>
          <?php if (isset($when)): ?>
          , <?php print $when; ?>
          <?php endif;?>
        </p>
    
      </div>
    </div>    
  </div>
  
  <div class="col-md-2">

    <?php if ($comment_count > 0): ?>
      <div class="btn-group btn-group-xs">
      <?php print format_plural($comment_count, '<span class="btn btn-success"><strong>' . '@count' . '</strong></span><span class="btn btn-default">' .  culturefeed_search_detail_l('event', $cdbid, $title, t('review')) . '</span>' , '<span class="btn btn-success">' . '@count' . '</span><span class="btn btn-default">' .  culturefeed_search_detail_l('event', $cdbid, $title, t('reviews')) . '</span>'); ?>
      </div>
    <?php else: ?>
      <div class="btn-group btn-group-xs"><span class="btn btn-default"><?php print culturefeed_search_detail_l('event', $cdbid, '0'); ?></span><span class="btn btn-default"><?php print culturefeed_search_detail_l('event', $cdbid, $title, t('reviews')); ?></span>
      </div>
    <?php endif; ?>

  </div>

</div>

<hr />
