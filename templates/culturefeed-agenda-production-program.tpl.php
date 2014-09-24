<div class="panel-group production-program" id="accordion">
  <?php foreach ($tabs as $tabId => $tab): ?>
  <div class="panel">
    <?php if (count($tabs) > 1): ?>
      <div class="">
        <a data-toggle="collapse" data-parent="#accordion" href="#<?php print str_replace(' ', '',$tab['name']); ?>">
          <i class="fa pull-right"></i>
          <?php print $tab['name']; ?>
        </a>
      </div>
      <hr class="small" />
    <?php endif; ?>
    <div id="<?php print str_replace(' ', '',$tab['name']); ?>" class="panel-collapse collapse">
      <div class="">
        <?php foreach ($tab['children'] as $content): ?>
        <div class="<?print $tab['class']; ?>">
          <div class="row">
            <div class="col-sm-3 col-md-4"><strong><?php print $content['city']; ?></strong></div>
            <div class="col-sm-9 col-md-8">            
              <?php if (isset($content['all_url'])): ?>
                <a href="<?print $content['all_url']; ?>"><strong><?php print $content['venue']; ?></strong></a>
              <?php else: ?>
                <strong><?php print $content['venue']; ?></strong>
              <?php endif; ?>
              <br />          
              <?php print culturefeed_bootstrap_cleanup_calsum($content['calendar'], 10, 'calsum-day text-muted'); //$content['calendar']; ?>
              <br />
              <a href="<?php print $content['url'] ?>"><?php print t('More details'); ?></a>          
            </div>
          </div>
        </div>
        <hr class="small" />
        <?php endforeach; ?>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div>
