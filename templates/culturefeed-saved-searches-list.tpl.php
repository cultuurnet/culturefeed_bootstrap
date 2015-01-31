<?php
/**
 * @file
 * Template for a list of saved searches.
 */
?>

<div class="panel-group" role="tablist">
  <div class="panel panel-default">

    <div class="panel-heading" role="tab" id="savedSearchesHeading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseSavedSearches" aria-expanded="true" aria-controls="collapseSavedSearches">
          <?php print t('@count saved searches', array('@count' => count($items))); ?>
        </a>
      </h4>
    </div>


    <div id="collapseSavedSearches" class="panel-collapse collapse" role="tabpanel" aria-labelledby="savedSearchesHeading">
      <ul class="list-group">
        <?php foreach ($items as $item): ?>
        <li class="list-group-item">
          <a href="<?php print $item['search_url']; ?>"><?php print $item['title']; ?></a>
          <a href="<?php print url('culturefeed/searches'); ?>" title="<?php print t('Edit'); ?>"><i class="fa fa-pencil-square-o"></i></a>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>

</div>