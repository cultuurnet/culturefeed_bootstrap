<?php if ($content): ?>
  <div class="region region-sidebar-first" id="facet-wrapper">

    <?php if ($pagetype == 'agenda-search') : ?>
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="row visible-xs visible-sm toggle-facet">
            <div class="col-xs-12">              
              <a data-toggle="collapse" data-target="#facet-container" data-parent="#facet-wrapper" class="btn btn-link btn-block collapsed">
                <p class="text-left">
                  <i class="pull-right fa"></i> Verfijn of wijzig resultaten
                </p>
              </a>
            </div>
          </div>
          <div id="facet-container">
          <hr class="visible-xs visible-sm small" />
            <?php print $content; ?>    
          </div>
        </div>
      </div>
    <?php else : ?>

      <?php print $content; ?>  

    <?php endif; ?>

  </div>
<?php endif; ?>
