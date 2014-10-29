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
<div class="media">

  <?php if ($image): ?>
  <span class="pull-right hidden-xs hidden-sm"><?php print $image; ?></span>
  <?php endif; ?>

  <div class="media-body">

      <?php if ($description1): ?>
      <p><?php print $description1; ?></p>
      <?php endif; ?>

      <ul class="bullets">
        <?php if ($period): ?>
        <li>
          <span class="fa-stack fa-lg">
          <i class="fa fa-circle fa-stack-2x"></i>
          <i class="fa fa-calendar fa-stack-1x fa-inverse"></i>
          </span> <?php print $period; ?>
          </li>
        <?php endif; ?>
        <?php if ($location): ?>
        <li>
          <span class="fa-stack fa-lg">
          <i class="fa fa-circle fa-stack-2x"></i>
          <i class="fa fa-map-marker fa-stack-1x fa-inverse"></i>
          </span> <?php print $location; ?>
          </li>
        <?php endif; ?>
        <?php if ($provider): ?>
        <li>
          <span class="fa-stack fa-lg">
          <i class="fa fa-circle fa-stack-2x"></i>
          <i class="fa fa-location-arrow fa-stack-1x fa-inverse"></i>
          </span> <?php print $provider; ?>
        </li>
        <?php endif; ?>
        <?php if ($available): ?>
        <li>
          <span class="fa-stack fa-lg">
          <i class="fa fa-circle fa-stack-2x"></i>
          <i class="fa fa-circle-o fa-stack-1x fa-inverse"></i>
          </span>  <?php print $available; ?>
        </li>
        <?php endif; ?>
      </ul>


      <?php if ($description2): ?>
      <p><?php print $description2; ?></p>
      <?php endif; ?>

  </div>
</div>

<p class="hidden-xs hidden-sm"><a href="/advantages" class="btn btn-default">Raadpleeg alle welkomstvoordelen →</a></p>