<?php
/**
 * @file
 * Template file for the culturefeed social user activity event details in the summary item.
 */

/**
 * @var string $image
 * @var string $title
 * @var string $body
 * @var string $link
 */
?>

<div class="media col-xs-11 well">
  
  <?php if(isset($image)): ?>
    <img src="<?php print $image ?>?width=150&height=150&crop=auto" alt="<?php print $title ?>" class="media-object pull-left visible-desktop thumbnail img-responsive" width="150" />
  <?php endif; ?>

  <div class="media-body">
    <p class="lead"><strong><?php print $link ?></strong></p>
  
    <?php if($body): ?>
      <p><?php print $body ?></p>
    <?php endif; ?>
  </div>
</div>
