<?php
/**
 * @file
 * Template for the summary of a nearby activity.
 */
?>

<div class="media">
  <div class="media-left pull-left">
    <a href="<?php print $url ?>">
      <?php if (!empty($thumbnail)): ?>
        <img src="<?php print $thumbnail; ?>?width=80&height=80&crop=auto" class="img-responsive media-object">
      <?php else: ?>
        <img src="http://placehold.it/80x80" class="img-responsive media-object">
      <?php endif; ?>
    </a>
  </div>

  <div class="media-object">
    <h4 class="media-heading"><a href="<?php print $url ?>"><?php print $title; ?></a></h4>

    <?php if (isset($location['city'])): ?>
    <div class="text-muted"><?php print $location['city']; ?></div>
    <?php endif;?>

    <?php if (isset($when_md)): ?>
      <div><?php print $when_md; ?></div>
    <?php endif;?>
  </div>
</div>
<br />
