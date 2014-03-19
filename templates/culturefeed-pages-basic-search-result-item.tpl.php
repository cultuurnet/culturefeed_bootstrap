<hr />

<div class="clearfix"></div>

<?php if (!empty($image)): ?>
    <a class="pull-right" href="<?php print $url; ?>"><img class="media-object img-thumbnail" src="<?php print $image; ?>?width=75&height=75&crop=auto" /></a>
<?php endif; ?>

<div class="media-body">
  <h4 class="media-heading">
    <a href="<?php print $url; ?>"><?php print $title; ?></a>
    <?php if (!empty($address['city'])): ?>
      <span class="text-muted"> | <?php print $address['city']; ?></span>
    <?php endif; ?>
  </h4>
  
  <?php if ($logged_in): ?>
  <p>
    <?php if (!empty($become_member_url)): ?>
    <i class="fa fa-group"></i> <a href="<?php print $become_member_url; ?>"><?php print t('Become a member') ?></a>
  <?php else: ?>
  <?php print t('You are already a member'); ?>
  <?php endif; ?>
  -
   <?php if (!$following): ?>
      <i class="fa fa-rss"></i> <a href="<?php print $follow_url; ?>"><?php print $follow_text; ?></a>
  <?php else: ?>
    <?php print t('You follow this page'); ?>
  <?php endif; ?>
  </p>
  <?php else: ?>
  
    <?php print $member_text; ?>
    - 
    <?php print $follow_text; ?>
  
  <?php endif; ?>
  
  <?php if (!empty($description)): ?>
  <p><?php print $description ?></p>
  <?php endif; ?>

</div>
