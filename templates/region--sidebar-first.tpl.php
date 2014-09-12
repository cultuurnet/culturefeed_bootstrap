<?php if ($content): ?>
  <div class="region region-sidebar-first">

    <?php if ($pagetype == 'agenda-search') : ?>
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="row visible-xs toggle-facet">
            <div class="col-xs-12">              
              <button data-toggle="collapse" data-target=".facet-container" class="btn btn-link btn-block">
                <p class="lead text-left">
                  <i class="pull-right fa fa-caret-down fa-lg"></i> Verfijn resultaten
                </p>
              </button>
            </div>
          </div>
          <div class="facet-container">
          <hr class="visible-xs small" />
            <?php print $content; ?>    
          </div>
        </div>
      </div>
    <?php else : ?>

      <?php print $content; ?>  

    <?php endif; ?>

  </div>
<?php endif; ?>
