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
        <span class="<?php print drupal_html_class($provider_raw); ?>"><?php print $provider_raw; ?></span>
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
        <button class="show-exchange-info" onclick="Drupal.CultureFeed.UiTPASToggleExchangeInfo()"><?php print t('How to exchange'); ?></button>
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
