<div class="row"> 
  <div class="col-xs-12">
    <h5>
    <?php if ($type == 'facebook') : ?>
      <i class="fa fa-facebook-square"></i> <?php print t('Facebook') ?>
      <?php elseif ($type == 'twitter'): ?>
      <i class="fa fa-twitter-square"></i> <?php print t('Twitter') ?>
      <?php elseif ($type == 'google'): ?>
      <i class="fa fa-google-plus-square"></i> <?php print t('Google') ?>
    <?php endif; ?>
    <?php if ($connect_link && !$delete_link) : ?>
    : <?php print $connect_link ?>
    <?php endif; ?>
    <?php if ($delete_link) : ?>
    : <?php print $delete_link ?>
    <?php endif; ?>
    </h5> 
  </div>
</div>
  <?php if ($picture || $name || $nick) : ?>
  <div class="inside clearfix">
    <?php if ($name) : ?>
        <span class="hidden"><?php print $name ?></span>
      <?php endif; ?>
      <?php if ($nick) : ?>
      <div class="col-md-12 user-accounts-profile"> 
        <div class="profile-nick"><?php print $nick ?></div>
      </div>
      <?php endif; ?>
    <div class="col-md-1 user-accounts-profile">      
      <?php if ($picture) : ?>
        <div class="profile-pic"><?php print $picture ?></div>
      <?php endif; ?>
    </div>
    <div class="col-md-11 user-accounts--privacy">
      <?php if (!empty($publish_form)) : ?>
        <?php print $publish_form ?>
      <?php endif; ?>
    </div>
  </div>
  <?php endif; ?>
  
