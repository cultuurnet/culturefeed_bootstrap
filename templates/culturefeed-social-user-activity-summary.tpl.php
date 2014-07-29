<div class="media-object pull-left visible-desktop thumbnail">
  <?php if($picture): ?>
    <?php print $picture ?>
  <?php endif; ?>
</div>
<div class="media-body">
  <?php print $nick ?>
  <?php if($prefix): ?>
    <?php print $prefix . ' '; ?>
  <?php endif; ?>
  <?php print $link; ?>
  <?php if($suffix): ?>
    <?php print ' ' . $suffix . '.' ; ?>
  <?php endif; ?>
  <small class="text-muted"><?php print $date ?></small>

  <?php if(isset($teaser)): ?>
    <div class="event-activity-teaser">
    <?php print $teaser; ?>
    </div>
  <?php endif; ?>

  <?php if (isset($summary)): ?>

  <?php endif; ?>

</div>
