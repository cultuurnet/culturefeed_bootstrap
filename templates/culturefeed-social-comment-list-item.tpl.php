<?php
/**
 * @vars
 *   $activity
 *   $content
 *   $picture
 *   $date
 *   $author
 *   $activity_id
 *   $level (0 of 1)
 */
?>

<div class="col-xs-12 clearfix">

  <?php if ($level == 1): ?>
  <hr />
  <?php endif; ?>

<div class="row" id="activity-<?php print $activity_id ?>">

  <div class="col-xs-2 text-center">
    <?php print $picture ?>
    <br />
    <p class="text-muted "><small><?php print $author ?> <br /> <?php print $date ?></small></p>
  </div>


  <div class="col-xs-10">
   
    <div class="row">
    
      <div class="col-xs-9">
         <p><?php print $content ?></p>
      </div>
      
      <div class="col-xs-3">
  
        <ul class="list-unstyled">
        
          <?php if ($delete_link): ?>
          <li>
            <i class="fa fa-trash-o fa-fw"></i> <small><?php print $delete_link ?></small>
            <hr class="small" />
          </li>
          <?php endif; ?>
          
          <?php if ($level == 0): ?>
          <li>
            <i class="fa fa-comments fa-fw"></i> <small><?php print $comment_link ?></small>
            <hr class="small" />
          </li>
          <?php endif; ?>
          
          <li>     
            <i class="fa fa-flag fa-fw"></i> <small><?php print $abuse_link ?></small> 
            <hr class="small" />
          </li>
          
        </ul>
  
      </div>
      

  
      <!-- Nested media object -->
      <?php if (!empty($list)): ?>
        <?php foreach ($list as $list_item): ?>
          <?php print $list_item ?>
        <?php endforeach;?>
      <?php endif; ?>   
       
      </div>
    
  </div>

</div>

  <?php if ($level == 0): ?>
  <hr />
  <?php endif; ?>

</div>
