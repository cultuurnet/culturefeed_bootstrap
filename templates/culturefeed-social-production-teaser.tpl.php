<?php
/**
 * @file
 * Template file for the culturefeed social user activity production details in the summary item.
 */

/**
 * @var string $image
 * @var string $title
 * @var string $body
 * @var string $link
 */
?>

<div class="media col-xs-11 well">

  <?php if (!empty($image)): ?>
    <img src="<?php print $image; ?>?width=150&height=150&crop=auto" alt="<?php print $title; ?>" class="media-object pull-left visible-desktop thumbnail img-responsive" width="150" />
  <?php else: ?>
    <img src="<?php print base_path() . drupal_get_path('theme', 'culturefeed_bootstrap'); ?>/img/no-thumbnail.gif" alt="<?php print $title; ?>" class="media-object pull-left visible-desktop thumbnail img-responsive" width="150" />
  <?php endif; ?>

  <div class="media-body">
    <h3 class="media-heading"><a href="<?php print $url; ?>"><?php print $title; ?></a></h3>

    <?php if($body): ?>
      <p><?php print $body ?></p>
    <?php endif; ?>

    <a href="<?php print $url; ?>"><?php print t('More information') ?></a>
  </div>
</div>
