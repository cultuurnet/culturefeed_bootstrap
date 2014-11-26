<?php
/**
 * @file
 * Template for a list of saved searches.
 */
?>

<div class="accordion" id="accordion-saved-searches">
  <div class="accordion-group">
    <div class="accordion-heading block-title">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-saved-searches" href="#saved-searches">
        <?php print t('@count saved searches', array('@count' => count($items))); ?>
      </a>
    </div>
   <div id="saved-searches" class="accordion-body collapse in">
     <div class="accordion-inner">

       <ul class="list-unstyled">
        <?php foreach ($items as $item): ?>
        <li>
          <a href="<?php print $item['search_url']; ?>"><?php print $item['title']; ?></a>
          <span class="edit"><?php print l(t('Manage'), 'culturefeed/searches'); ?></span>
        </li>
        <?php endforeach; ?>
       </ul>

      </div>
   </div>
  </div>
</div>
