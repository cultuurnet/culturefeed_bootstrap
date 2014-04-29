<?php
/**
 * @file
 * Template file for an event or production item on the actor program page.
 */

?>

<div class="media">
  <div class="media-body">
    <h3 class="media-heading">
     <a href="<?php print $url ?>"><?php print $title; ?></a>
    </h3>
      
    <div class="text-muted hidden-xs hidden-sm">
      <i class="fa fa-tags"></i> 
      <?php foreach ($themes as $theme): ?>
        <?php print $theme; ?>
        <?php endforeach; ?>
    </div>


    <div class="row">
      <div class="col-xs-2 hidden-xs hidden-sm">
        <strong><?php print t('When'); ?></strong>
      </div>
      <div class="col-xs-1 hidden-md hidden-lg text-center">
        <i class="fa fa-calendar text-center"></i>
      </div>
      <div class="col-xs-10">    
        <?php if (!empty($when)): ?>
          <?php print $when; ?>
          <?php endif; ?>
      </div>
    </div>
    
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
  </div>
</div>

<hr />
