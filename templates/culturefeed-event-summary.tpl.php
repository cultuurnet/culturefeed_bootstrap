<?php
/**
 * @file
 * Template for the summary of an event.
 * Please don't remove the cf- prefixed id's. This is used by GTM for user behavior tracking.
 * Some day your client will benefit from our aggregated insights & benchmarks too.
 * See https://github.com/cultuurnet/culturefeed/wiki/Culturefeed-tracking
 * Thanks!
 */
?>

<div class="row cf-search-summary">

  <div class="col-xs-3 col-lg-2">

    <a href="<?php print $url ?>" id="cf-image_<?php print $cdbid ?>">
      <?php if (!empty($thumbnail)): ?>
        <img class="img-responsive" src="<?php print $thumbnail; ?>?width=152&height=152&crop=auto&scale=both" title="<?php print $title ?>" alt="<?php print $title ?>" />
      <?php else: ?>
        <img class="img-responsive" src="<?php print base_path() . drupal_get_path('theme', 'culturefeed_bootstrap'); ?>/img/no-thumbnail.gif" title="<?php print $title ?>" alt="<?php print $title ?>" />
      <?php endif; ?>
    </a>

  </div>

  <div class="col-xs-9 col-lg-10">

    <?php if (isset($forkids)): ?>
      <span class="forkids pull-right"></span>
      <?php if (isset($agefrom) && is_numeric($agefrom)): ?>
        <?php if ($agefrom > 0): ?>
          <small class="agefrom h4"><span class="label label-success pull-right"> <?php print $agefrom; ?> +</span></small>
        <?php endif; ?>
      <?php endif; ?>
    <?php endif; ?>

    <h2 class="media-heading">
      <a href="<?php print $url ?>" id="cf-title_<?php print $cdbid ?>">
        <?php print $title; ?>
      </a>
    </h2>

    <?php if (isset($types) && !empty($types)): ?>
      <p class="hidden-xs">
        <span class="label label-default"><i class="fa fa-tags"></i> <?php print implode(', ' , $types); ?></span>
      <?php endif; ?>

      <?php if (!empty($shortdescription)): ?>
        <span class="cf-short-description hidden-xs hidden-sm"><?php print $shortdescription; ?></span>
      </p>
    <?php endif; ?>

    <p>
      <?php if (!empty($performers)): ?>
      <div class="row hidden-xs">
        <div class="col-xs-2 hidden-xs hidden-sm"><strong><?php print t('With'); ?></strong></div>
        <div class="col-xs-1 hidden-md hidden-lg text-center"><i class="fa fa-users fa-fw"></i></div>
        <div class="col-xs-10"><?php print $performers; ?></div>
      </div>
      <?php endif; ?>

      <?php if ($location): ?>
      <div class="row">
        <div class="col-xs-2 hidden-xs hidden-sm"><strong><?php print t('Where'); ?></strong></div>
        <div class="col-xs-1 hidden-md hidden-lg text-center"><i class="fa fa-map-marker fa-fw"></i></div>
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
        <div class="col-xs-1 hidden-md hidden-lg text-center"><i class="fa fa-calendar fa-fw"></i></div>
        <div class="col-xs-10">
          <?php if (strlen($when) < 75) : ?>
            <?php print $when; ?>
          <?php else : ?>
            <?php print substr($when, 0, 75) . '... '; ?>
          <?php endif; ?>
        </div>
      </div>
      <?php endif; ?>
    </p>

    <?php if (!empty($tickets)): ?>
      <p class="hidden-xs"><?php print culturefeed_search_detail_l('event', $cdbid, $title, '<i class="fa fa-ticket"></i> ' . t('Info & tickets') . ' &rarr;', array('html' => TRUE, 'attributes' => array('class' => array('btn', 'btn-default'), 'id' => 'cf-readmore_' . $cdbid))); ?></p>
    <?php else: ?>
      <p class="hidden-xs"><?php print culturefeed_search_detail_l('event', $cdbid, $title, t('More info') . ' &rarr;', array('html' => TRUE, 'attributes' => array('class' => array('btn', 'btn-default'), 'id' => 'cf-readmore_' . $cdbid))); ?></p>
    <?php endif; ?>

  </div>

  <p class="visible-xs">
    <?php print culturefeed_search_detail_l('event', $cdbid, $title, '<span class="hyperspan"></span>', array('html' => TRUE, 'attributes' => array('id' => 'cf-readmore_' . $cdbid))); ?>
  </p>

</div>

<hr />