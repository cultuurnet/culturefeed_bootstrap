<?php
/**
 * @file
 * Template for the detail of an actor.
 */
?>

<div class="row">

  <div class="col-sm-8">
  
    <p>
      <?php print $shortdescription; ?>
    </p>
    
    <table class="table table-condended table-striped">
      <tbody>
    
      <?php if ($location): ?>
      <tr><td><strong class="hidden-xs hidden-sm"><?php print t('Where'); ?></strong><i class="fa fa-map-marker hidden-md hidden-lg"></i></td>
      <td>
        <!--<?php if (!empty($coordinates)): ?>
        <?php print l(t('Show map') . ' <span class="caret"></span>', '', array('attributes' => array('data-toggle' => 'collapse', 'class' => array('pull-right')), 'fragment' => 'cf-map', 'html' => TRUE)) ?>
        <?php endif; ?>-->
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
        <!--<?php if (!empty($coordinates)): ?>
        <div id="cf-map" class="collapse collapse-in"><img src="http://placehold.it/440x300" class="img-rectangle img-responsive" /><small class="text-muted">TODO: implement Google Map (coordinates = <?php print $coordinates['lat'] ?> - <?php print $coordinates['lng'] ?>)</small></div>
        <?php endif; ?>-->
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
