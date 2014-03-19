<div class="row">

  <div class="col-sm-8">

    <?php if ($description): ?>
    <p>
      <?php print $description ?>
    </p>
    <?php endif; ?>
   
    <?php if (!empty($address)): ?>
    <div class="row">
      <div class="col-xs-1">
        <i title="<?php print t('Address'); ?>" class="fa fa-map-marker fa-2x fa-fw"></i>
      </div>
      <div class="col-xs-11">
          <address>
          <?php print $address['street']?>, <br />
          <?php print $address['zip']?> <?php print $address['city']?>
          </address>
      </div>   
    </div>
    <hr />
    <?php endif; ?>      
    
    <?php if (!empty($contact)): ?>
    <div class="row">
      <div class="col-xs-1">
        <i title="<?php print t('Contact'); ?>" class="fa fa-info fa-2x fa-fw"></i>
      </div> 
      <div class="col-xs-11">
          <?php print implode(' ' . t('or') . ' ', $contact)?>
      </div>   
    </div>   
    <?php endif; ?>      

    <hr />
    
    <div class="row">
    
      <div class="col-xs-1">
        <i title="<?php print t('Members'); ?>" class="fa fa-group fa-2x fa-fw"></i>
      </div> 
      
      <div class="col-xs-11">
        <p>
          <?php print t('Members'); ?> <?php print t('of'); ?> <?php print $title ?>
          <span class="pull-right">
            <?php if (!empty($become_member_link)): ?>
            <?php print $become_member_link ?>
            <?php endif; ?>
          </span>
        </p>
        
        <br />
        
        <?php if ($members): ?>
          <table class="table table-hover">
          <?php foreach ($members as $member): ?>
            <tr>
              <td>
                <a href="<?php print $member['url']; ?>"><?php print $member['name']?></a>
              </td>
              <td class="text-muted">
                <?php if (!empty($member['relation'])): ?><?php print $member['relation'] ?><?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
          </table>
          <?php endif; ?>
     </div>   
  </div>        
    <?php 
    print culturefeed_pages_block_request_admin_membership($item);
     ?>
     
  </div>
  
  <div class="col-sm-4">
  
    <?php if (!empty($image)): ?>
    <img class="img-thumbnail" src="<?php print $image; ?>?max-width=300" alt="Logo <?php print $title ?>" />
    <?php endif; ?>
    
    <hr />
    
    <?php if ($links): ?>
    
    
      <?php foreach ($links as $class => $link): ?>
      
        <?php if ($class == 'linkFacebook') : ?>
        <p class="text-muted">
          <i title="<?php print $title ?> <?php print t('on'); ?> Facebook" class="fa fa-facebook fa-lg fa-fw"></i>
          <a class="text-muted" href="<?php print $link; ?>">
            <?php print $link; ?>
          </a> 
        </p>   
        <?php elseif ($class == 'linkGooglePlus'): ?>
        <p class="text-muted">
          <i title="<?php print $title ?> <?php print t('on'); ?> Google+" class="fa fa-google-plus fa-lg fa-fw"></i>
          <a class="text-muted" href="<?php print $link; ?>">
            <?php print $link; ?>
          </a> 
        </p>      
        <?php elseif ($class == 'linkTwitter'): ?>
        <p class="text-muted">
          <i title="<?php print $title ?> <?php print t('on'); ?> Twitter" class="fa fa-twitter fa-lg fa-fw"></i>
          <a class="text-muted" href="<?php print $link; ?>">
            <?php print $link; ?>
          </a> 
        </p>  
        <?php elseif ($class == 'linkWebsite'): ?>
        <p class="text-muted">
          <i title="<?php print $title ?> <?php print t('on'); ?> Internet" class="fa fa-globe fa-lg fa-fw"></i>
          <a class="text-muted"   href="<?php print $link; ?>">
            <?php print $link; ?>
          </a> 
        </p>       
        <?php elseif ($class == 'linkBlog'): ?>
        <p class="text-muted">
          <i title="<?php print $title ?> Blog" class="fa fa-stack-exchange fa-lg fa-fw"></i>
          <a class="text-muted"   href="<?php print $link; ?>">
            <?php print $link; ?>
          </a> 
        </p>       
        <?php elseif ($class == 'linkTicketing'): ?>
        <p class="text-muted">
          <i title="<?php print $title ?> <?php print t('Buy'); ?> tickets" class="fa fa-ticket fa-lg fa-fw"></i>
          <a class="text-muted"   href="<?php print $link; ?>">
            <?php print $link; ?>
          </a> 
        </p>       
        <?php elseif ($class == 'linkYouTube'): ?>
        <p class="text-muted">
          <i title="<?php print $title ?> <?php print t('on'); ?> Youtube" class="fa fa-youtube fa-lg fa-fw"></i>
          <a class="text-muted"   href="<?php print $link; ?>">
            <?php print $link; ?>
          </a> 
        </p>       
        <?php endif; ?>        
      
      <?php endforeach; ?>
  
    <?php endif;?>  
  
  </div>

</div>
