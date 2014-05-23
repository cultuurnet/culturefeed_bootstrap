<?php
/**
 * @file
 * Template file for the culturefeed social user activity summary item (with a teaser).
 */

/**
 * @var string $picture
 * @var string $nick
 * @var string $prefix
 * @var string $link
 * @var string $suffix
 * @var string $date
 *
 * Some have a teaser:
 * @var Boolean $has_teaser
 * @var string $teaser_title
 * @var string $teaser_summary
 * @var string $teaser_body
 * @var string $teaser_image
 */
?>

<div class="media-object pull-left visible-desktop thumbnail">
  <?php print $picture ?>  
</div>
<div class="media-body">
  <?php print $nick ?>
  
  <?php if($prefix): ?>
    <?php print $prefix . ' '; ?>:
  <?php endif; ?>
  
  <?php if($suffix): ?>
    <?php print ' ' . $suffix; ?>
  <?php endif; ?>  
  <small class="text-muted"><?php print $date ?></small>
    
  <?php if($has_teaser): ?>
  
  <div class="media well">
    
    <?php if($teaser_image): ?>
      <img src="<?php print $teaser_image ?>" alt="<?php print $teaser_title ?>" class="media-object pull-left visible-desktop thumbnail img-responsive" width="150" />
    <?php endif; ?>
  
    <div class="media-body">
      <p><strong><?php print $teaser_title ?></strong></p>
    
      <?php if($teaser_body): ?>
        <?php if($teaser_summary): ?>
        <p><?php print $teaser_summary ?></p>
        <?php else: ?>
        <p><?php print $teaser_body ?></p>
      <?php endif; ?>
    </div>
  </div>

  <?php endif; ?>

<?php endif; ?>
    
</div>