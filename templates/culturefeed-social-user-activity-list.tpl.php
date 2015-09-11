<br />
<div class="culturefeed-social culturefeed-activity-list">
  <div class="activity-list-wrapper">
    <ul class="media-list">
      <?php foreach ($items as $item): ?>
        <li class="media"><?php print $item;?></li>
      <?php endforeach; ?>
    </ul>
    <?php if (!empty($read_more_url)): ?>
      <a href="<?php print $read_more_url ?>" class="pager-link" rel="no-follow"><?php print $read_more_text; ?></a>
    <?php endif; ?>
  </div>
</div>