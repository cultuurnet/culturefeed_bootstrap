<?php
/**
 * @file
 * Default theme implementation to display culturefeed uitpas promotion.
 *
 * Available variables:
 * - $points: The number of points.
 * - $image
 * - $period: The period.
 * - $location: The location.
 * - $provider: The provider.
 * - $available: The availability.
 * - $description1.
 * - $description2.
 */
?>
<div class="detail promotion-detail row">
  <div class="col-xs-12 col-sm-8 col-md-9" role="main">
    <?php if ($provider_raw): ?>
    <div class="provider-label">
      <span class="<?php print drupal_html_class($provider_raw); ?>"><?php print $provider_raw; ?></span>
    </div>
    <?php endif; ?>
    <div class="points"><span class="points-value points-value__brand"><?php print $points; ?></span></div>
    <?php if ($period): ?>
    <div class="period"><?php print $period; ?></div>
    <?php endif; ?>
    <?php if ($available): ?>
    <div class="available"><?php print $available; ?></div>
    <?php endif; ?>
    <?php if ($description1): ?>
    <p class="description1"><?php print $description1; ?></p>
    <?php endif; ?>
    <?php if ($description2): ?>
    <div class="how-to-exchange">
      <button class="show-exchange-info btn btn-primary" onclick="Drupal.CultureFeed.UiTPASToggleExchangeInfo()"><?php print t('How to exchange'); ?></button>
      <div class="exchange-info">
        <div class="locations">
          <?php print t('At') . ' ' . implode(', ', $location_links); ?>
        </div>
        <p class="description2"><?php print $description2; ?></p>
      </div>
    </div>
    <?php endif; ?>
  </div>
  <div class="col-xs-12 col-sm-4 col-md-3" role="aside">
    <div class="media">
      <?php if ($images_list): ?>
        <?php print $images_list; ?>
      <?php endif; ?>
    </div>
  </div>
</div>
