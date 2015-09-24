<?php if ($content): ?>
  <div class="region region-sidebar-first" id="facet-wrapper">

    <?php if ($pagetype == 'agenda-search' || $pagetype == 'agenda-pages') : ?>
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="row visible-xs toggle-facet">
            <div class="col-xs-12">              
              <a data-toggle="collapse" data-target="#facet-container" data-parent="#facet-wrapper" class="btn btn-link btn-block collapsed read-more-link">
                <span class="lead text-center">
                  <i class="fa fa-filter"> </i> Verfijn of wijzig resultaten
                </span>
              </a>
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
