<?php
/**
 * @file
 * Template file for an event or production item on the actor program page.
 */
?>

<div class="row">

  <div class="col-xs-3 col-lg-2">
    <a href="<?php print $url ?>">
      <?php if (!empty($thumbnail)): ?>
        <img class="img-responsive" src="<?php print $thumbnail; ?>?width=150&height=150&crop=auto&scale=both" title="<?php print $title ?>" alt="<?php print $title ?>" />
      <?php else: ?>
        <img class="img-responsive" src="<?php print base_path() . drupal_get_path('theme', 'culturefeed_bootstrap'); ?>/img/no-thumbnail.gif" title="<?php print $title ?>" alt="<?php print $title ?>" />
      <?php endif; ?>
    </a>
  </div>
  
  <div class="col-xs-9 col-lg-10">
    <h2 class="media-heading">
      <?php if (!empty($agefrom)): ?>
        <small><span class="label label-success pull-right"> <?php print $agefrom; ?> +</span></small>
      <?php endif; ?>
     <a href="<?php print $url ?>"><?php print $title; ?></a>
    </h2>

    <?php if (isset($types) && !empty($types)): ?>
      <p class="hidden-xs">
        <span class="label label-default"><i class="fa fa-tags"></i> <?php print implode(', ' , $types); ?></span>
      </p>
    <?php endif; ?>
    
    <?php if (!empty($when)): ?>
      <div class="row">
        <div class="col-xs-2 hidden-xs hidden-sm">
          <strong><?php print t('When'); ?></strong>
        </div>
        <div class="col-xs-1 hidden-md hidden-lg text-center">
          <i class="fa fa-calendar text-center"></i>
        </div>
        <div class="col-xs-10">
          <?php if (strlen($when) < 120) : ?> 
            <?php print $when; ?>
          <?php else : ?> 
            <?php print substr($when, 0, 120) . '... ' . culturefeed_search_detail_l('event', $cdbid, $title, t('more dates'), array('html' => TRUE, 'attributes' => array('class' => array('cf-moredates'), 'id' => 'cf-moredates_' . $cdbid))); ?>
          <?php endif; ?>
        </div>
      </div>
    <?php endif; ?>

    <?php if (!empty($location)): ?>    
      <div class="row">
        <div class="col-xs-2 hidden-xs hidden-sm">
          <strong><?php print t('Where'); ?></strong>
        </div>
        <div class="col-xs-1 hidden-md hidden-lg text-center">
          <i class="fa fa-map-marker text-center"></i>
        </div>
        <div class="col-xs-10">    
          <?php if ($location): ?>
            <?php print $location['title'] ?>
              <?php if (!empty($location['city'])): ?>
                - <?php print $location['city']; ?>
              <?php endif; ?>
            <?php endif; ?>
        </div>
      </div>   
    <?php endif; ?>        
  </div>
</div>

<hr />
