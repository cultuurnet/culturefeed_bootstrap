<?php if ($content): ?>
  <div class="region region-sidebar-first">

    <?php if ($pagetype == 'agenda-search') : ?>
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="row visible-xs toggle-facet">
            <div class="col-xs-12" data-toggle="collapse" data-target=".facet-container">
              <p class="lead"><i class="fa fa-filter fa-lg"></i> Verfijn resultaten</p>
            </div>
          </div>
          <div class="facet-container">
          <hr class="visible-xs" />
            <?php print $content; ?>    
          </div>
        </div>
      </div>
    <?php else : ?>

      <?php print $content; ?>  

    <?php endif; ?>

  </div>
<?php endif; ?>
