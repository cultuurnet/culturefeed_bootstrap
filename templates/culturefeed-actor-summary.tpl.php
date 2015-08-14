<?php
/**
 * @file
 * Template for the summary of an actor.
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

    <h2 class="media-heading">
      <a href="<?php print $url ?>" id="cf-title_<?php print $cdbid ?>">
        <?php print $title; ?>
      </a>
    </h2>

    <?php if (!empty($shortdescription)): ?>
      <p class="hidden-xs">
        <span class="cf-short-description hidden-xs hidden-sm"><?php print $shortdescription; ?></span>
      </p>
    <?php endif; ?>

    <p>
      <?php if ($location): ?>
      <div class="row">
        <div class="col-xs-2 hidden-xs hidden-sm"><strong><?php print t('Where'); ?></strong></div>
        <div class="col-xs-1 hidden-md hidden-lg text-center"><i class="fa fa-map-marker fa-fw"></i></div>
        <div class="col-xs-10">
          <?php if (!empty($location['zip'])): ?>
            <?php print $location['zip']; ?>
          <?php endif; ?>
          <?php if (!empty($location['city'])): ?>
            <?php print $location['city']; ?>
          <?php endif; ?>
          <?php if (!empty($location['street'])): ?>
            <?php if ($location['street'] !== ' '): ?>
              <?php print '- ' . $location['street'] ; ?>
            <?php endif; ?>
          <?php endif; ?>
        </div>
      </div>
      <?php endif; ?>
    </p>

    <p class="hidden-xs"><?php print $moreinfo_link; ?></p>

  </div>

  <p class="visible-xs">
    <?php print culturefeed_search_detail_l('actor', $cdbid, $title, '<span class="hyperspan"></span>', array('html' => TRUE, 'attributes' => array('id' => 'cf-readmore_' . $cdbid))); ?>
  </p>

</div>

<hr />
