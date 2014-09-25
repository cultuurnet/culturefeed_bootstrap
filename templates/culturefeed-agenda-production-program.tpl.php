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
    <div id="<?php print str_replace(' ', '',$tab['name']); ?>" class="panel-collapse collapse <?php print (count($tabs) > 1) ? '' : 'in' ; ?>">
      <div class="">
        <?php foreach ($tab['children'] as $content): ?>
        <div class="<?php print $tab['class']; ?>">
          <div class="row">
            <div class="col-sm-3 col-md-4"><strong><?php print $content['city']; ?></strong></div>
            <div class="col-sm-9 col-md-8">            
              <?php if (isset($content['all_url'])): ?>
                <a href="<?print $content['all_url']; ?>"><strong><?php print $content['venue']; ?></strong></a>
              <?php else: ?>
                <strong><?php print $content['venue']; ?></strong>
              <?php endif; ?>
              <br />          
              <?php if ($content['calendar']['type'] == 'timestamps'): ?>
                <?php if (count($content['calendar']['timestamps']) > 0): ?>
                  <?php foreach ($content['calendar']['timestamps'] as $timestamp): ?>
                    <?php if (!is_array($timestamp['begintime'])): ?>
                      <div><small><?php print '<span class="cf-day">' . substr($timestamp['day'], 0, -1) . '</span><strong>' . $timestamp['date'] . '</strong><small class="text-muted"> | </small>' . $timestamp['begintime']; ?></small></div>
                    <?php else: ?>
                      <?php $i=0; ?>
                      <div><small><?php print '<span class="cf-day">' . substr($timestamp['day'], 0, -1) . '</span><strong>' . $timestamp['date'] . '</strong><small class="text-muted"> | </small>'; ?>
                        <?php foreach ($timestamp['begintime'] as $begintime): ?>
                          <?php print $begintime; ?>
                          <?php if (++$i !== count($timestamp['begintime'])): ?>
                            <?php print '<small class="text-muted"> | </small>'; ?>
                          <?php endif; ?>
                        <?php endforeach; ?>
                      </small></div>
                    <?php endif; ?>

                  <?php endforeach; ?>
                <?php else: ?>
                  <p class="alert alert-warning"><?php print t('This event is finished.'); ?></p>
                <?php endif; ?>
              <?php else: ?>
                <?php print $when; ?>
              <?php endif; ?>
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
