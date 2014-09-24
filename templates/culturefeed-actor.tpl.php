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
    
    <table class="table table-condended">
      <tbody>
    
      <?php if ($location): ?>
      <tr><td><strong class="hidden-xs hidden-sm"><?php print t('Where'); ?></strong><i class="fa fa-map-marker hidden-md hidden-lg"></i></td>
      <td>
        <?php if (!empty($coordinates)): ?>
          <?php
            $iPod = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
            $iPhone = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
            $iPad = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
            $Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
          ?>
          <?php if ($iPod || $iPhone || $iPad): ?>
            <a href="http://maps.apple.com/?q=<?php print $location['title'] . (!empty($location['zip']) ? '+' . $location['zip'] : '') . (!empty($location['city']) ? '+' . $location['city'] : '') . (!empty($location['street']) ? '+' . $location['street'] : ''); ?>" class="btn btn-default btn-sm pull-right"><?php print t('Open map'); ?></a>
          <?php elseif ($Android): ?>
            <a href="geo:<?php print (!empty($coordinates['lat']) ? $coordinates['lat'] : '0') . ',' . (!empty($coordinates['lng']) ? $coordinates['lng'] : '0'); ?>?q=<?php print $location['title'] . (!empty($location['zip']) ? '+' . $location['zip'] : '') . (!empty($location['city']) ? '+' . $location['city'] : '') . (!empty($location['street']) ? '+' . $location['street'] : '') ?>&zoom=14" class="btn btn-default btn-sm pull-right"><?php print t('Open map'); ?></a>
          <?php else: ?>
            <?php print l(t('Show map') . ' <span class="caret"></span>', '', array('attributes' => array('data-toggle' => 'collapse', 'class' => array('pull-right')), 'fragment' => 'cf-map', 'html' => TRUE)) ?>
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
      <img src="<?php print $main_picture; ?>?width=260&crop=auto" class="img-responsive" />
      <?php foreach ($pictures as $picture): ?>
        <img src="<?php print $picture; ?>?width=60&height=60&crop=auto" />
      <?php endforeach; ?> 
      <hr class="small" />
    </div>  
    <?php endif; ?>

  </div>

</div>
