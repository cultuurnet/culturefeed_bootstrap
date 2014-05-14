<?php //dsm($variables); ?>
<div>
  <?php foreach ($tabs as $tabId => $tab): ?>
  <div class="panel panel-default">
    <div class="panel-heading"><?php print $tab['name']; ?></div>
    <div class="panel-body">
      <?php foreach ($tab['children'] as $content): ?>
      <div class="<?print $tab['class']; ?>">
        <dl class="dl-horizontal">
          <dt><?php print $content['city']; ?></dt>
          <dd>
            <a href=""><strong><?php print $content['venue']; ?></strong></a>
            <br />
            <?php print $content['calendar']; ?>
            <br />
            <a href="<?php print $content['url'] ?>"><?php print t('More details'); ?></a>            
            <?php if (isset($content['all_url'])): ?>
            | <a href="<?print $content['all_url']; ?>"><?php print t('Show full program at') . ' ' . $content['venue']; ?></a>
            <?php endif; ?>
            
          </dd>
        </dl>
      </div>
      <hr class="small" />
      <?php endforeach; ?>
    </div>
  </div>
  <?php endforeach; ?>
</div>
