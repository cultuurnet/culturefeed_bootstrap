<?php
/**
 * @file
 * Template for the detail of an actor.
 */
?>

<div class="row">

  <div class="col-sm-8">

    <?php if (!empty($shortdescription)) : ?>
      <p>
        <?php print $shortdescription; ?>
      </p>
    <?php endif; ?>

    <table class="table table-condended detail-table">
      <tbody>

      <?php if ($location): ?>
      <tr><td><strong class="hidden-xs hidden-sm"><?php print t('Where'); ?></strong><i class="fa fa-map-marker hidden-md hidden-lg"></i></td>
      <td>
        <?php if (!empty($coordinates)): ?>
          <?php if ($is_ios): ?>
            <a href="http://maps.apple.com/?q=<?php print $location['title'] . (!empty($location['zip']) ? '+' . $location['zip'] : '') . (!empty($location['city']) ? '+' . $location['city'] : '') . (!empty($location['street']) ? '+' . $location['street'] : ''); ?>" class="btn btn-default btn-sm pull-right"><?php print t('Open map'); ?></a>
          <?php elseif ($is_android): ?>
            <a href="geo:<?php print (!empty($coordinates['lat']) ? $coordinates['lat'] : '0') . ',' . (!empty($coordinates['lng']) ? $coordinates['lng'] : '0'); ?>?q=<?php print $location['title'] . (!empty($location['zip']) ? '+' . $location['zip'] : '') . (!empty($location['city']) ? '+' . $location['city'] : '') . (!empty($location['street']) ? '+' . $location['street'] : '') ?>&zoom=14" class="btn btn-default btn-sm pull-right"><?php print t('Open map'); ?></a>
          <?php else: ?>
            <?php print l(t('Show map') . ' <span class="caret"></span>', '', array('attributes' => array('data-toggle' => 'collapse', 'class' => array('pull-right map-toggle')), 'fragment' => 'cf-map', 'html' => TRUE, 'external' => 'TRUE')) ?>
          <?php endif; ?>
        <?php endif; ?>
        <?php if (!empty($location['link'])): ?>
        <?php print $location['link']; ?><br/>
        <?php endif; ?>
        <?php if (!empty($location['street'])): ?>
          <?php print $location['street'] ?><br/>
        <?php endif; ?>
        <?php if (!empty($location['zip'])): ?>
          <?php print $location['zip']; ?>
        <?php endif; ?>
        <?php if (!empty($location['city'])): ?>
          <?php print $location['city']; ?>
        <?php endif; ?>
        <?php if (!empty($map)): ?>
        <div id="cf-map" class="collapse collapse-in"><?php print $map; ?></div>
        <?php endif; ?>
      </td></tr>
      <?php endif; ?>

      <?php if (!empty($when_lg)): ?>
      <tr><td><strong class="hidden-xs hidden-sm"><?php print t('Opening hours'); ?></strong><i class="fa fa-calendar hidden-md hidden-lg"></i></td>
      <td class="cf-when"><?php print $when_lg; ?></td></tr>
      <?php endif; ?>

      <?php if (!empty($contact['mail']) || (!empty($contact['phone']) || !empty($contact['fax']))) : ?>
        <tr><td><strong class="hidden-xs hidden-sm"><?php print t('Contact'); ?></strong><i class="fa fa-info-circle hidden-md hidden-lg"></i></td>
        <td>
        <?php if (!empty($contact['mail'])): ?>
          <?php print $contact['mail'] ?><br />
        <?php endif; ?>
        <?php if (!empty($contact['phone'])): ?>
            <i class="fa fa-phone"></i> <?php print $contact['phone'] ?><br />
        <?php endif; ?>
        <?php if (!empty($contact['fax'])): ?>
          <i class="fa fa-print"></i> <?php print $contact['fax'] ?>
        <?php endif; ?>
        </td></tr>
      <?php endif; ?>

      <?php if (!empty($links)): ?>
      <tr><td><strong class="hidden-xs hidden-sm"><?php print t('Links'); ?></strong><i class="fa fa-external-link hidden-md hidden-lg"></i></td>
      <td><?php print implode('<br />', $links); ?></td></tr>
      <?php endif; ?>

      </tbody>

    </table>

  </div>

  <div class="col-sm-4 hidden-xs">

    <?php if (!empty($main_picture)): ?>
    <div class="hidden-xs">
      <img src="<?php print $main_picture; ?>?width=360&maxheight=400&crop=auto" class="img-responsive" />
      <?php if(!empty($pictures)): ?>
        <br />
        <div class="row">
          <?php foreach ($pictures as $picture): ?>
            <div class="col-xs-6">
              <?php print '<img src="' . $picture . '?width=165&height=165&crop=auto" class="img-responsive"'; ?> />
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
      <br />
    </div>
    <?php endif; ?>

  </div>

</div>

<div class="cf-social-share-bar">
  <?php include('social-share-bar.inc'); ?>
</div>

<hr />
