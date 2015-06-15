<div class="panel-group production-program" id="accordion">
  <?php foreach ($tabs as $tabId => $tab): ?>
  <div class="panel">
    <?php if (count($tabs) > 1): ?>
      <div class="">
        <a data-toggle="collapse" data-parent="#accordion" href="#<?php print str_replace(' ', '',$tab['name']); ?>" class="btn-link">
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
            <div class="col-sm-3 col-md-4 col-lg-3 hidden-xs"><p class="text-right"><em><?php print $content['city']; ?></em></p></div>
            <div class="col-xs-12 hidden-sm hidden-md hidden-lg"><p><em><?php print $content['city']; ?></em></p></div>
            <div class="col-sm-9 col-md-8 col-lg-9">
              <p>
              <?php if (isset($content['all_url'])): ?>
                <a href="<?php print $content['all_url']; ?>" class="link-primary">
                  <strong><?php print $content['venue']; ?></strong>
                </a>
              <?php else: ?>
                <strong><?php print $content['venue']; ?></strong>
              <?php endif; ?>
              </p>
              <?php if ($content['calendar']['type'] == 'timestamps'): ?>
                <?php if (count($content['calendar']['timestamps']) > 0): ?>
                  <ul class="list-unstyled cf-when">
                  <?php foreach ($content['calendar']['timestamps'] as $timestamp): ?>
                    <?php $day = substr($timestamp['day'], 0, -1); ?>
                    <?php if (!is_array($timestamp['begintime'])): ?>
                      <li><?php print '<span class="cf-weekday cf-meta">' . t($day) . '</span><strong class="cf-date">' . $timestamp['date'] . '</strong> <span class="cf-time">' . $timestamp['begintime'] . '</span>'; ?></li>
                    <?php else: ?>
                      <?php $i=0; ?>
                      <li><?php print '<span class="cf-weekday cf-meta">' . t($day) . '</span><strong class="cf-date">' . $timestamp['date'] . '</strong>'; ?>
                        <?php foreach ($timestamp['begintime'] as $begintime): ?>
                          <?php print '<span class="cf-time">' . $begintime . '</span>'; ?>
                        <?php endforeach; ?>
                      </li>
                    <?php endif; ?>
                  <?php endforeach; ?>
                  </ul>
                <?php else: ?>
                  <p class="alert alert-warning"><?php print t('This event is finished.'); ?></p>
                <?php endif; ?>
              <?php else: ?>
                <?php print $content['when']; ?>
              <?php endif; ?>
              <a href="<?php print $content['url'] ?>"><?php print t('More details'); ?></a>

              <?php if (!empty($content['personal_calendar_buttons'])): ?>
              <?php foreach ($content['personal_calendar_buttons']['content'] as $button) : ?>
                <?php print $button; ?>
               <?php endforeach; ?>
              <?php endif; ?>

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
