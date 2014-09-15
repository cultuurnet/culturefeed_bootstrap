<?php if ($content): ?>
  <div class="region region-sidebar-first" id="facet-wrapper">

    <?php if ($pagetype == 'agenda-search') : ?>
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="row visible-xs toggle-facet">
            <div class="col-xs-12">              
              <button data-toggle="collapse" data-target="#facet-container" data-parent="#facet-wrapper" class="btn btn-link btn-block collapsed">
                <p class="lead text-left">
                  <i class="pull-right fa"></i> Verfijn of wijzig resultaten
                </p>
              </button>
            </div>
          </div>
          <div id="facet-container">
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
