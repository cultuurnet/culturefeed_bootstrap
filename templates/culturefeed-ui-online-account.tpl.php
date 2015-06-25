  <div class="col-xs-12">
    <?php if ($type == 'facebook') : ?>
      <i class="fa fa-facebook-square"></i> 
      <?php elseif ($type == 'twitter'): ?>
      <i class="fa fa-twitter-square"></i> 
      <?php elseif ($type == 'google'): ?>
      <i class="fa fa-google-plus-square"></i> 
    <?php endif; ?>
    <?php if ($connect_link && !$delete_link) : ?>
    <?php print $connect_link ?>
    <?php endif; ?>
    <?php if ($delete_link) : ?>
    <?php print $delete_link ?>
    <?php endif; ?>
  </div>
  <?php if ($picture || $name || $nick || $publish_link) : ?>
  <div class="inside clearfix">
    <div class="col-sm-4 user-accounts--profile">
      <?php if ($picture) : ?>
        <?php print $picture ?>
      <?php endif; ?>
      <?php if ($name) : ?>
        <span class="hidden"><?php print $name ?></span>
      <?php endif; ?>
      <?php if ($nick) : ?>
        <?php print $nick ?>
      <?php endif; ?>
    </div>
    <div class="col-sm-8 user-accounts--privacy">
      <?php if ($publish_link) : ?>
        <?php print $publish_link ?>
      <?php endif; ?>
    </div>  
  </div>
  <?php endif; ?>
  
