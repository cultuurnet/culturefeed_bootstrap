<?php if ($cover): ?>
  <style>
  .page-cover {
    height: 160px;
    width: 100%;
    position: absolute;
    z-index: -1;
    top: 0;
    margin-bottom: 20px;
  }
  h1.page-header {
    color: #FFF;
    margin-bottom: 5px;
    margin-top: 75px;
    text-shadow: black 2px 2px 1px;
  }
  .breadcrumb {
    margin-bottom: 10px;
    display: none;
  }
  .text-white {
    color: #EDEDED;
    text-shadow: black 1px 1px 1px;
  }
  .col-sm-4 .img-thumbnail {
    margin-top: -30px;
  }
  .page-cover a {
    position: absolute;
    right: 20px;
    top: 80px;
    box-shadow: black 0px 2px 0px;
  }
  </style>
  <div class="row page-cover" style="background: url('<?php print $cover . '?width=960&height=160&crop=auto' ?>');">
    <a class="btn btn-warning" href="#">Pagina Volgen</a>
  </div>
<?php endif; ?>

  <?php if ($baseline): ?>
  <div class="row">
    <div class="col-sm-12 text-white"><?php print $baseline ?></div>
  </div>
  <br />
  <?php endif; ?>
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
          <i title="<?php print t('Address'); ?>" class="fa fa-map-marker fa-lg fa-fw"></i>
        </div>
        <div class="col-xs-11">
            <address>
            <?php print $address['street']?><br />
            <?php print $address['zip']?> <?php print $address['city']?>
            </address>
        </div>   
      </div>
      <hr class="small" />
      <?php endif; ?>      
      
      <?php if (!empty($contact)): ?>
      <div class="row">
        <div class="col-xs-1">
          <i title="<?php print t('Contact'); ?>" class="fa fa-info fa-lg fa-fw"></i>
        </div> 
        <div class="col-xs-11">
            <?php print implode(' ' . t('or') . ' ', $contact)?>
        </div>   
      </div>   
      <?php endif; ?>      
  
      <hr class="small" />
      
      <div class="row">
      
        <div class="col-xs-1">
          <i title="<?php print t('Members'); ?>" class="fa fa-group fa-lg fa-fw"></i>
        </div> 
        
        <div class="col-xs-11">
                  
          <?php if ($canononlyadmin): ?>
            <p class="text-muted"><small>Deze pagina heeft nog geen medewerkers</small></p>
          <?php endif; ?>    
        
          <p>
            <span class="badge"><?php print count($members) ?></span> <?php print t('Members'); ?> <?php print t('of'); ?> <?php print $title ?> <a href="#" class="btn btn-link" data-toggle="collapse" data-target="#members" title="<?php print t('Show Members'); ?>"><span class="caret"></span><span class="sr-only"><?php print t('Show Members'); ?></span></a>
            <span class="pull-right">
              <?php if (!empty($become_member_link)): ?>
              <?php print $become_member_link ?>
              <?php endif; ?>
            </span>
          </p>
      
          
          <?php if ($members): ?>
          <div class="table-responsive collapse" id="members">         
            <table class="table">
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
          </div>
          <?php endif; ?>
            
       </div>   
    </div>        
      <?php 
      print culturefeed_pages_block_request_admin_membership($item);
       ?>
       
    </div>
    
    <div class="col-sm-4">
    
      <?php if (!empty($image)): ?>
      <img class="img-thumbnail hidden-xs" src="<?php print $image; ?>" alt="Logo <?php print $title; ?>" />
      <br />
      <?php endif; ?>
      
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

        <hr />
    
      <?php endif;?>  
    
    </div>
  
  </div>
