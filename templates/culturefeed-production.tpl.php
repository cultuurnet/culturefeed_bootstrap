<?php
/**
 * @file
 * Template for the detail of a production.
 */
?>

<div class="row">

  <div class="col-sm-8">

    <?php if (isset($forkids)): ?>
      <span class="forkids pull-right"></span>
    <?php endif; ?>
    <?php if (isset($agefrom) && is_numeric($agefrom)): ?>
      <?php if ($agefrom > 0): ?>
        <span class="agefrom h4"><span class="label label-success pull-right"> <?php print $agefrom; ?> +</span></span>
      <?php endif; ?>
    <?php endif; ?>

    <?php if (!empty($themes_links)): ?>
      <p class="text-muted"><i class="fa fa-tags"></i> <?php print implode(', ' , $themes_links); ?></p>
    <?php endif; ?>

    <p>
      <?php if (!empty($shortdescription)): ?>
        <div class="short-description">
          <?php print $shortdescription; ?>
        </div>
        <?php if (!empty($longdescription)): ?>
          <div class="long-description">
            <div id="cf-longdescription" class="collapse collapse-in"><?php print $longdescription; ?></div>
            <?php print l(t('Read more'), '', $readmore_options) ?>
          </div>
        <?php endif; ?>
      <?php else: ?>
        <?php print $longdescription; ?>
      <?php endif; ?>
    </p>

    <table class="table table-condended detail-table">
      <tbody>

      <?php if (!empty($performers)): ?>
      <tr><td><strong class="hidden-xs hidden-sm"><?php print t('With'); ?></strong><i class="fa fa-users hidden-md hidden-lg"></i></td>
      <td><?php print $performers; ?></td></tr>
      <?php endif; ?>

      <?php if ($location && $relations < 2): ?>
      <tr><td class="col-lg-2 col-md-2 col-sm-1 col-xs-1"><strong class="hidden-xs hidden-sm"><?php print t('Where'); ?></strong><i class="fa fa-map-marker hidden-md hidden-lg"></i></td>
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
        <?php else: ?>
        <?php print $location['title'];?><br/>
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

      <?php if (!empty($when) && $relations < 2): ?>
      <tr><td><strong class="hidden-xs hidden-sm"><?php print t('When'); ?></strong><i class="fa fa-calendar hidden-md hidden-lg"></i></td>
      <td class="cf-when scroll scroll-150"><?php print $when; ?></td></tr>
      <?php endif; ?>

      <?php if ($organiser): ?>
      <tr><td><strong class="hidden-xs hidden-sm"><?php print t('Organization'); ?></strong><i class="fa fa-building-o hidden-md hidden-lg"></i></td>
      <td>
        <?php if (empty($organiser['link'])):?>
        <?php print $organiser['title']; ?>
        <?php else: ?>
        <?php print $organiser['link'] ?>
        <?php endif; ?>
      </td></tr>
      <?php endif; ?>

      <?php if (!empty($price)): ?>
      <tr><td><strong class="hidden-xs hidden-sm"><?php print t('Price'); ?></strong><i class="fa fa-eur hidden-md hidden-lg"></i></td>
      <td>
        <?php print $price; ?>
        <?php if (!empty($price_description)): ?>
          <a data-toggle="tooltip" data-original-title="boe" title="<?php print $price_description; ?>"><i class="fa fa-info-circle text-muted"></i></a>
        <?php endif; ?>
      </td></tr>
      <?php endif; ?>

      <?php if (!empty($reservation)): ?>
      <tr><td><strong class="hidden-xs hidden-sm"><?php print t('Reservations'); ?></strong><i class="fa fa-ticket hidden-md hidden-lg"></i></td>
      <td>
        <?php if (!empty($tickets)): ?>
          <span><?php print implode(' ', $tickets); ?></span>
        <?php endif; ?>
        <?php if (!empty($reservation['phone'])): ?>
          <?php print (!empty($tickets) ? ' ' . t('or call') : ''); ?> <?php print implode(', ', $reservation['phone']); ?>
        <?php endif; ?>
      </td></tr>
      <?php endif; ?>

      <?php if (!empty($contact['mail']) || !empty($contact['phone']) || !empty($contact['fax'])) : ?>
        <tr><td><strong class="hidden-xs hidden-sm"><?php print t('Contact'); ?></strong><i class="fa fa-info-circle hidden-md hidden-lg"></i></td>
        <td>
        <?php if (!empty($contact['mail'])): ?>
          <?php print $contact['mail'] ?><br />
        <?php endif; ?>
        <?php if (!empty($contact['phone'])): ?>
          <?php if (!empty($reservation['phone']) && ($contact['phone'] != implode(', ', $reservation['phone'])) || empty($reservation['phone'])): ?>
            <i class="fa fa-phone"></i> <?php print $contact['phone'] ?><br />
          <?php endif; ?>
        <?php endif; ?>
        </td></tr>
      <?php endif; ?>

      <?php if (!empty($links)): ?>
      <tr><td><strong class="hidden-xs hidden-sm"><?php print t('Links'); ?></strong><i class="fa fa-external-link hidden-md hidden-lg"></i></td>
      <td><?php print implode('<br />', $links); ?></td></tr>
      <?php endif; ?>

      <?php if (!empty($facilities)): ?>
      <tr><td><strong class="hidden-xs hidden-sm"><?php print t('Facilities'); ?></strong><i class="fa fa-wheelchair hidden-md hidden-lg"></i></td>
      <td><?php print implode(', ', $facilities); ?></td>
      </tr>
      <?php endif; ?>

      <?php if (!empty($keywords)): ?>
      <tr class="hidden-xs hidden-sm"><td><strong class="hidden-xs hidden-sm"><?php print t('Keywords'); ?></strong></td>
      <td><?php print $keywords; ?></td></tr>
      <?php endif; ?>

      <?php if ($relations > 1): ?>
      <tr><td><strong class="hidden-xs hidden-sm"><?php print t('Program schedule'); ?></strong><i class="fa fa-calendar hidden-md hidden-lg"></i></td>
      <td class="production-program-cell">
      <?php
      $block = module_invoke('culturefeed_agenda', 'block_view', 'production-program');
      print render($block['content']);
      ?>
      </td></tr>
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

    <?php if (!empty($videos)): ?>
      <?php foreach ($videos as $video): ?>
        <?php print $video; ?>
        <br />
      <?php endforeach; ?>
      <hr class="small" />
    <?php endif; ?>

  </div>

</div>

<div class="cf-social-share-bar">
  <?php include('social-share-bar.inc'); ?>
</div>

<hr />
