<?php
/**
 * @file
 * Template for the summary of a production.
 */
?>

<div class="row">

  <div class="col-sm-3 col-lg-2 hidden-xs">

    <a href="<?php print $url ?>">
      <?php if (!empty($thumbnail)): ?>
        <img class="media-object thumbnail hidden-xs" src="<?php print $thumbnail; ?>?width=152&scale=both" title="<?php print $title ?>" alt="<?php print $title ?>" />
      <?php else: ?>
        <img class="media-object thumbnail hidden-xs" src="<?php print base_path() . drupal_get_path('theme', 'culturefeed_bootstrap'); ?>/img/no-thumbnail.gif" title="<?php print $title ?>" alt="<?php print $title ?>" />
      <?php endif; ?>
    </a>

  </div>

  <div class="col-sm-9 col-lg-10 col-xs-12">

    <h2 class="media-heading">
      <?php if (!empty($agefrom)): ?>
        <small><span class="label label-success pull-right"> <?php print $agefrom; ?> +</span></small>
      <?php endif; ?>
      <a href="<?php print $url ?>">      
        <?php print $title; ?>
      </a>
    </h2>
  
    <?php if (!empty($types)): ?>
    <div class="text-muted hidden-xs hidden-sm"><i class="fa fa-tags"></i> <?php print implode(', ' , $types); ?></div>
    <?php endif; ?>

    <?php if (!empty($shortdescription)): ?>
    <p class="hidden-xs hidden-sm"><?php print $shortdescription; ?></p>
    <?php endif; ?>

    <p>
      <?php if (!empty($performers)): ?>
      <div class="row">
        <div class="col-xs-2 hidden-xs hidden-sm"><strong><?php print t('By'); ?></strong></div>
        <div class="col-xs-1 hidden-md hidden-lg text-center"><i class="fa fa-users text-center"></i></div>
        <div class="col-xs-10"><?php print $performers; ?></div>
      </div>
      <?php endif; ?>
    
      <?php if ($location): ?>
      <div class="row">
        <div class="col-xs-2 hidden-xs hidden-sm"><strong><?php print t('Where'); ?></strong></div>
        <div class="col-xs-1 hidden-md hidden-lg text-center"><i class="fa fa-map-marker text-center"></i></div>
        <div class="col-xs-10">
          <?php if (!empty($location['city'])): ?>
            <?php print $location['city'] . ', '; ?>
          <?php endif; ?>
          <?php if (!empty($location['title'])): ?>
            <?php print $location['title']; ?>
          <?php endif; ?>
        </div>
      </div>
      <?php endif; ?>
    
      <?php if (!empty($when)): ?>
      <div class="row">
        <div class="col-xs-2 hidden-xs hidden-sm"><strong><?php print t('When'); ?></strong></div>
        <div class="col-xs-1 hidden-md hidden-lg text-center"><i class="fa fa-calendar text-center"></i></div>
        <div class="col-xs-10"><?php print $when; ?></div>
      </div>
      <?php endif; ?>
    </p>

    <?php if (!empty($tickets)): ?>
      <p class="hidden-xs"><?php print culturefeed_search_detail_l('production', $cdbid, $title, '<i class="fa fa-ticket"></i> ' . t('Info & tickets') . ' &rarr;', array('html' => TRUE, 'attributes' => array('class' => array('btn', 'btn-warning')))); ?></p>
    <?php else: ?>
      <p class="hidden-xs"><?php print culturefeed_search_detail_l('production', $cdbid, $title, t('More info') . ' &rarr;', array('html' => TRUE, 'attributes' => array('class' => array('btn', 'btn-default')))); ?></p>
    <?php endif; ?>

  </div>

</div>

<hr />