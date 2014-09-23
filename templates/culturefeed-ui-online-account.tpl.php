<p>
  <!-- @start TYPES -->
  <?php if ($type == 'facebook') : ?>
    <span class="lead"><span class="fa-stack"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-facebook fa-stack-1x fa-inverse"></i></span> <?php print $type ?></span> :
    <?php elseif ($type == 'twitter'): ?>
    <span class="lead"><span class="fa-stack"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-twitter fa-stack-1x fa-inverse"></i></span> <?php print $type ?></span> :
    <?php elseif ($type == 'google'): ?>
    <span class="lead"><span class="fa-stack"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-google-plus fa-stack-1x fa-inverse"></i></span> <?php print $type ?></span> :
  <?php endif; ?>
  <!-- @end TYPES -->
  
  <!-- @start TYPE DATA -->
  <?php if ($picture) : ?>
    <?php print $picture ?>
  <?php endif; ?>
  <?php if ($name) : ?>
   <span class="hidden"><?php print $name ?></span>
  <?php endif; ?>
  <?php if ($nick) : ?>
    <?php print $nick ?>
  <?php endif; ?>      
  <!-- @end TYPE DATA -->  
    
  <!-- @start LINK / UNLINK -->
  <?php if ($connect_link && !$delete_link) : ?>
    - <i class="fa fa-link"></i> <?php print $connect_link ?>
  <?php endif; ?>
  <?php if ($delete_link) : ?>
    - <i class="fa fa-unlink"></i> <?php print $delete_link ?>
  <?php endif; ?>
  <!-- @end LINK / UNLINK -->
</p>
 
<!-- @start PUBLISH -->
<?php if ($publish_link) : ?>
<p>
<?php print $publish_link ?>
</p>
<?php endif; ?>
<!-- @end PUBLISH -->  
