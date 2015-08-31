<br />
<ul class="media-list scroll">
  <?php foreach ($items as $item): ?>
    <li class="media"><?php print $item;?></li>
  <?php endforeach; ?>
</ul>
<?php if (!empty($read_more_url)): ?>
  <a href="<?php print $read_more_url ?>" rel="no-follow"><?php print $read_more_text; ?></a>
<?php endif; ?>
