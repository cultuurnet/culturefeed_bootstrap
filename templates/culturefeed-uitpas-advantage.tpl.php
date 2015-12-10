<?php
/**
 * @file
 * Default theme implementation to display culturefeed uitpas advantage details.
 *
 * Available variables:
 * - $image.
 * - $period: The period.
 * - $location: The location.
 * - $provider: The provider.
 * - $available: The availability.
 * - $description1.
 * - $description2.
 */
?>
<div class="detail advantage-detail row">
  <div class="col-xs-8 col-md-9" role="main">
    <?php if ($provider_raw): ?>
      <div class="provider-label">
        <p class="text-muted <?php print drupal_html_class($provider_raw); ?>"><?php print $provider_raw; ?></p>
      </div>
    <?php endif; ?>
    <?php if ($period): ?>
    <div class="period"><?php print $period; ?></div>
    <?php endif; ?>
    <?php if ($available): ?>
    <div class="available"><?php print $available; ?></div>
    <?php endif; ?>
    <?php if ($description1): ?>
    <p class="description1"><?php print $description1; ?></p>
    <?php endif; ?>
      <div class="how-to-exchange">
        <button class="show-exchange-info btn btn-primary" onclick="Drupal.CultureFeed.UiTPASToggleExchangeInfo()"><?php print t('How to exchange'); ?></button>
        <div class="exchange-info">
          <div class="locations">
            <?php print t('At') . ' ' . implode(', ', $location_links); ?>
          </div>
          <?php if ($description2): ?>
          <p class="description2"><?php print $description2; ?></p>
          <?php endif; ?>
        </div>
      </div>
  </div>
  <div class="col-xs-4 col-md-3">
    <div class="media">
      <?php if ($images_list): ?>
        <?php print $images_list; ?>
      <?php endif; ?>
    </div>
  </div>
</div>
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-use-bootstrap-modal="false">
    <!-- The container for the modal slides -->
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
    <!-- The modal dialog, which will be used to wrap the lightbox content -->
    <div class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" aria-hidden="true">&times;</button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body next"></div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left prev">
              <i class="fa fa-arrow-left"></i>
              <?php print t('Previous'); ?>
            </button>
            <button type="button" class="btn btn-primary next">
              <?php print t('Next'); ?>
              <i class="fa fa-arrow-right"></i>
            </button>
            </div>
          </div>
        </div>
      </div>
    </div>
