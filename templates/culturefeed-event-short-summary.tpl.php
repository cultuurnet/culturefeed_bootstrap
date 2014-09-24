<?php
/**
 * @file
 * Template for the short summary of an event.
 */
?>

<div class="thumbnail cf-search-summary">

  <!-- @ start THUMBNAIL -->
  <?php if (!empty($thumbnail)): ?>
    <a href="<?php print $url ?>"><img src="<?php print $thumbnail; ?>?width=253&amp;height=123&amp;crop=auto&amp;scale=both" alt="<?php print $title; ?>" class="img-responsive" /></a>
  <?php else: ?>
    <a href="<?php print $url ?>"><img src="<?php print base_path() . drupal_get_path('theme', 'culturefeed_bootstrap'); ?>/img/no-thumbnail-related.gif" alt="<?php print $title; ?>" class="img-responsive" /></a>
  <?php endif; ?>

  <!-- @ end THUMBNAIL -->

  <!-- @ start CONTENT -->
  <div class="caption">

    <h4 class="media-heading">
      <?php if (!empty($agefrom)): ?>
        <span class="label label-success pull-right"><?php print $agefrom; ?> +</span>
      <?php endif; ?>
      <a href="<?php print $url ?>"><?php print $title; ?></a>
    </h4>

    <p>      
      <?php if (isset($location['city'])): ?>
        <strong><?php print $location['city']; ?></strong>
        <br />
        <span><?php print $location['title'] ?></span>
      <?php endif; ?>    
    </p>

    <p class="hidden-xs hidden-sm"><span class="more-info"> <?php print culturefeed_search_detail_l('event', $cdbid, $title, 'Meer informatie &rarr;', array('attributes' => array('class' => 'btn btn-default'), 'html' => TRUE)); ?> </span></p>

  <!-- @ end CONTENT -->
  </div>

  <p class="visible-xs">
    <?php print culturefeed_search_detail_l('event', $cdbid, $title, '<span class="hyperspan"></span>', array('html' => TRUE, 'attributes' => array('id' => 'cf-readmore_' . $cdbid))); ?>
  </p>

</div>

