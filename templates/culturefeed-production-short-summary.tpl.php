<?php
/**
 * @file
 * Template for the short summary of a production.
 */
?>

<div class="thumbnail">

  <!-- @ start THUMBNAIL -->
  <?php if (!empty($thumbnail)): ?>
    <img src="<?php print $thumbnail; ?>?width=370&amp;height=180&amp;crop=auto&amp;scale=both" alt="" />
  <?php else: ?>
    <img src="<?php print base_path() . drupal_get_path('theme', 'culturefeed_bootstrap'); ?>/img/no-thumbnail-related.gif" alt="" />
  <?php endif; ?>

  <!-- @ end THUMBNAIL -->

  <!-- @ start CONTENT -->
  <div class="caption">

    <h3 class="media-heading">
      <a href="<?php print $url ?>"><?php print $title; ?></a>
    </h3>

    <p>  
      
      <?php if ($location): ?>
        <strong>
          <?php if (isset($location['city'])): ?>
            <?php print $location['city']; ?>
          <?php endif; ?>
        </strong><br />
        <span><?php print $location['title'] ?></span>
      <?php endif; ?>    
    </p>


    <p class="hidden-xs hidden-sm"><span class="more-info"> <?php print culturefeed_search_detail_l('event', $cdbid, $title, 'Meer informatie &rarr;', array('attributes' => array('class' => 'btn btn-default'), 'html' => TRUE)); ?> </span></p>

  <!-- @ end CONTENT -->
  </div>
</div>
