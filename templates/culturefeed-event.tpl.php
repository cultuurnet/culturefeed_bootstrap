<?php
/**
 * @file
 * Template for the detail of an event.
 */
?>

<div class="row">

  <div class="col-sm-8">
  
    <?php if (!empty($agefrom)): ?>
      <p class="lead pull-right"><span class="label label-success"> <?php print $agefrom; ?> +</span></p>
    <?php endif; ?>

    <?php if (!empty($themes)): ?>
      <p class="text-muted"><i class="fa fa-tags"></i> <?php print implode(', ' , $themes); ?></p>
    <?php endif; ?>
    
    <p>
      <?php print $shortdescription; ?>
      <?php if (!empty($longdescription)): ?>
        <?php print l(t('Read more'), '', array('attributes' => array('data-toggle' => 'collapse'), 'fragment' => 'cf-longdescription')) ?>
        <div id="cf-longdescription" class="collapse collapse-in"><?php print $longdescription; ?></div>
      <?php endif; ?>
    </p>
    
    <table class="table table-condended table-striped">
      <tbody>

      <?php if (!empty($performers)): ?>     
      <tr><td><strong class="hidden-xs hidden-sm"><?php print t('With'); ?></strong><i class="fa fa-users hidden-md hidden-lg"></i></td>
      <td><?php print $performers; ?></td></tr>
      <?php endif; ?>

      <?php if ($location): ?>
      <tr><td><strong class="hidden-xs hidden-sm"><?php print t('Where'); ?></strong><i class="fa fa-map-marker hidden-md hidden-lg"></i></td>
      <td>
        <?php if (!empty($map)): ?>
        <?php print l(t('Show map') . ' <span class="caret"></span>', '', array('attributes' => array('data-toggle' => 'collapse', 'class' => array('pull-right map-toggle')), 'fragment' => 'cf-map', 'html' => TRUE)) ?>
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
    
      <?php if (!empty($when)): ?>
      <tr><td><strong class="hidden-xs hidden-sm"><?php print t('When'); ?></strong><i class="fa fa-calendar hidden-md hidden-lg"></i></td>
      <td><?php print $when; ?></td></tr>
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
    
      <?php if (!empty($reservation) || !empty($tickets)): ?>
      <tr><td><strong class="hidden-xs hidden-sm"><?php print t('Reservations'); ?></strong><i class="fa fa-ticket hidden-md hidden-lg"></i></td>
      <td>
        <?php if (!empty($tickets)): ?>
          <?php foreach ($tickets as $ticket): ?>
            <?php print l($ticket['text'], $ticket['link'], array('attributes' => array('class' => 'reservation-link btn btn-warning btn-xs'))) . '<br />'; ?>
          <?php endforeach; ?>
        <?php endif; ?>
        <?php if (!empty($reservation['mail'])): ?>
          <?php print $reservation['mail']; ?><br />
        <?php endif; ?>
        <?php if (!empty($reservation['phone'])): ?>
          <?php print $reservation['phone']; ?><br />
        <?php endif; ?>
        <?php if (!empty($reservation['url'])): ?>
          <?php print $reservation['url']; ?>
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
          <?php print $contact['phone'] ?><br />
        <?php endif; ?>
        <?php if (!empty($contact['fax'])): ?>
          <?php print $contact['fax'] . '(fax)' ?>
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
    
      </tbody>

    </table>

  </div>

  <div class="col-sm-4 hidden-xs">

    <?php if (!empty($main_picture)): ?>
    <img src="<?php print $main_picture; ?>?width=260&crop=auto" class="img-thumbnail" />
    
    <?php foreach ($pictures as $picture): ?>
      <img src="<?php print $picture; ?>?width=60&height=60&crop=auto" />
    <?php endforeach; ?>
    
    <?php endif; ?>
    
    <?php if (!empty($videos)): ?>
    <?php foreach ($videos as $video): ?>
      <?php print $video; ?>
    <?php endforeach; ?>
    <?php endif; ?>

  </div>

</div>

<hr />

<div class="row">
  
  <div class="col-sm-12">

    <div class="col-xs-4">
      <div class="row">
        <div class="col-sm-3">
          <span class="fa-stack fa-lg">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-thumbs-up fa-stack-1x fa-inverse"></i>
          </span>
        </div>
        <div class="col-sm-9">
          <?php print $recommend_link; ?>       
        </div>
      </div>
    </div>

    <div class="col-xs-4">
      <div class="row">
        <div class="col-sm-3">
          <span class="fa-stack fa-lg">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-check fa-stack-1x fa-inverse"></i>
          </span>
        </div>
        <div class="col-sm-9">
          <?php print $attend_link; ?>       
        </div>
      </div>
    </div>

    <div class="col-xs-4">
      <div class="row">
        <div class="col-sm-3">
          <span class="fa-stack fa-lg">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
          </span>
        </div>
        <div class="col-sm-9 text-muted">
          TODO: integrate share options
          <?php //print $share_link; ?>       
        </div>
      </div>
    </div>

  </div>

</div>

<hr />