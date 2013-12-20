<div class="panel panel-default">
  <?php if ($profile_edit_link) : ?>
  <div class="panel-heading">
    <h3 class="panel-title">
    
    <?php print(t('My UiTiD')) ?>               
    
    <?php if ($profile_edit_link) : ?>
    <span class="pull-right">
       <i class="fa fa-pencil-square-o fa-lg"></i> 
       <?php print $profile_edit_link ?>
    </span>
    <?php endif; ?>
    
    </h3>
  </div>
  <?php endif; ?>

  <div class="panel-body">
  

       
    <div class="media">
      <?php if ($picture) : ?>
      <div class="pull-left">
        <?php print $picture ?>
      </div>
      <?php endif; ?>
      
      <div class="media-body">
      

  
      
        <?php if ($name): ?>
          <h4 class="media-heading">
            <?php print $name;?>
          </h4>
        <?php endif; ?>
        <?php if (isset($heading_info) && $heading_info ): ?>
          <p class="text-muted">
            <?php print $heading_info; ?>
          </p>
        <?php endif; ?>
        <?php if ($bio): ?>
          <p>
            <?php print $bio;?>
          </p>
        <?php endif; ?>
        <?php if (isset($has_profile) && $has_profile) : ?>
            <?php if (!empty($memberships)): ?>
            <dl class="dl-horizontal">
              <dt>Lid van</dt>
              <dd>
                <ul class="list-inline">
                <?php foreach ($memberships as $membership): ?>
                  <li>
                  <?php print culturefeed_search_detail_l('page', $membership->page->getId(), $membership->page->getName()); ?>
                  <?php if (!empty($membership->relation)): ?>
                    <span class="member-role muted"><small>(<?php print $membership->relation; ?>)</small></span>
                   <?php endif; ?>
                   </li>
                <?php endforeach; ?>
                </ul>
              </dd>
            </dl>
          
            <?php if ($city) : ?>
            <dl class="dl-horizontal">
              <dt>Woonplaats</dt>
              <dd><?php print $city ?></dd>
            </dl>
            <?php endif; ?>
          
          <?php endif; ?>
  

        <?php endif; ?>
      </div>
      
    </div>
    


    </div>
    
</div>
