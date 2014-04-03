<hr />

<div class="clearfix"></div>

<div class="row">

  <div class="col-sm-8">
    <h4 class="media-heading">
      <a href="<?php print $url; ?>"><?php print $title; ?></a>
    </h4>
    <?php if (!empty($address['street'])): ?>
      <span class="text-muted"><?php print $address['street']; ?></span><br />
    <?php endif; ?>
    <?php if (!empty($address['city'])): ?>
      <strong><?php print $address['zip']; ?> <?php print $address['city']; ?></strong>
    <?php endif; ?>
  </div>

  <div class="col-sm-4">
    <div class="row">
      <div class="col-md-6">
    
        <?php if ($logged_in): ?>
          <?php if (!empty($become_member_url)): ?>
            <a href="<?php print $become_member_url; ?>" class="btn btn-block btn-sm btn-warning"><i class="fa fa-group"></i> <?php print t('Become a member') ?></a>
          <?php else: ?>
            <small class="text-muted"><?php print t('You are already a member'); ?></small>
          <?php endif; ?>
    
        <?php else: ?>  
          <?php print $member_text; ?>
        <?php endif; ?>
    
      </div>
    
      <div class="col-md-6">
    
        <?php if ($logged_in): ?>
          <?php if (!$following): ?>
            <a href="<?php print $follow_url; ?>" class="btn btn-block btn-sm btn-default"><i class="fa fa-rss"></i> <?php print $follow_text; ?></a>
          <?php else: ?>
            <small class="text-muted"><?php print t('You follow this page'); ?></small>
          <?php endif; ?>
    
        <?php else: ?>
          <?php print $follow_text; ?>
        <?php endif; ?>
    
      </div>
    </div>
  </div>
</div>
