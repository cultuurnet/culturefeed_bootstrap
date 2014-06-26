<?php if ($tooltip_text): ?>
  <div><?php print $tooltip_text; ?></div>
<?php endif; ?>


<?php foreach ($items as $item): ?>
  <div class="media">
        <?php if ($item['image']): ?>
          <img src="<?php print $item['image'] ?>?width=75&height=75&crop=auto" class="img-responsive pull-left" />
        <?php else: ?>
          <img src="<?php print base_path() . drupal_get_path('theme', 'culturefeed_bootstrap'); ?>/img/no-thumbnail.gif" width="75" heigth="75" class="img-responsive pull-left" />      
        <?php endif; ?>    
    <div class="media-body">
      <?php print $item['link']; ?><br />
      <small class="text-muted"><?php print $item['location']; ?></small>
    </div>
  </div>
  <hr class="small" />
<?php endforeach; ?>


<?php if ($show_more): ?>
  <p class="text-right"><a href="<?php print $more_url ?>"><?php print $more_text; ?></a></p>
<?php endif; ?>