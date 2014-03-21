<div id="page-agenda-ajax-wrapper-<?php print $page->getId(); ?>">
<ul class="nav nav-tabs nav-justified">
  <li class="active"><a href="#"><strong><?php print t('Activities'); ?></strong></a></li>
  <li><a href="#block-culturefeed-pages-page-timeline"><?php print t('Timeline'); ?></a></li>
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

</div>





