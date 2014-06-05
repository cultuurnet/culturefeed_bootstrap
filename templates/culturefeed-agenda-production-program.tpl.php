<?php //dsm($variables); ?>
<div>
  <?php foreach ($tabs as $tabId => $tab): ?>
  <div class="panel panel-default">
    <?php if (count($tabs) > 1): ?>
      <div class="panel-heading"><?php print $tab['name']; ?></div>
    <?php endif; ?>
    <div class="panel-body">
      <?php foreach ($tab['children'] as $content): ?>
      <div class="<?print $tab['class']; ?>">
        <dl class="dl-horizontal">
          <dt><?php print $content['city']; ?></dt>
          <dd>            
            <?php if (isset($content['all_url'])): ?>
              <a href="<?print $content['all_url']; ?>"><strong><?php print $content['venue']; ?></strong></a>
            <?php else: ?>
              <strong><?php print $content['venue']; ?></strong>
            <?php endif; ?>
            <br />          
            <?php print culturefeed_bootstrap_cleanup_calsum($content['calendar'], 10, 'calsum-day text-muted'); //$content['calendar']; ?>
            <br />
            <a href="<?php print $content['url'] ?>"><?php print t('More details'); ?></a>          
          </dd>
        </dl>
      </div>
      <hr class="small" />
      <?php endforeach; ?>
    </div>
  </div>
  <?php endforeach; ?>
</div>
