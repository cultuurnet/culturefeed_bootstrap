<div id="page-agenda-ajax-wrapper-<?php print $page->getId(); ?>">

  <ul class="nav nav-tabs">
    <li class="active"><a href="#"><h4><i class="fa fa-calendar fa-fw fa-lg"></i> <?php print t('Activities'); ?></h4></a></li>
    <li><a href="#block-culturefeed-pages-page-timeline" class="text-muted"><h4><i class="fa fa-th-list fa-fw fa-lg"></i> <?php print t('Timeline'); ?></h4></a></li>
  </ul>
  
  <br />
  
  <div class="scroll">
    <?php if ($items): ?>
      <?php foreach ($items as $item) :?>
        <?php print $item; ?>
    <?php endforeach; ?>
    
    <?php if (!empty($read_more)): ?>
      <?php print $read_more; ?>
    <?php endif; ?>
    
    <?php elseif ($is_admin) :?>
      <h5><?php print t('Your page has currently no published activities.'); ?></h5>
      <p><?php print t('Add a new activity via <a href="http://www.uitdatabank.be">www.uitdatabank.be</a>.'); ?></p>
    <?php endif; ?>
  </div>
  
  <br />

</div>
