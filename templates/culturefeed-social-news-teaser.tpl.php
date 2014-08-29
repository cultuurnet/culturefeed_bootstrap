<?php
/**
 * @file
 * Template file for news teasers when shown in streams.
 */
?>

<div class="media col-xs-11 well">

  <?php if(isset($image)): ?>
  <a href="<?php print $url; ?>" class="pull-left">
    <img src="<?php print $image ?>" alt="<?php print $title ?>" class="media-object visible-desktop thumbnail img-responsive" width="150" />
  </a>
  <?php endif; ?>

  <div class="media-body">
    <h3 class="media-heading"><a href="<?php print $url; ?>"><?php print $title; ?></a></h3>

    <?php if (!empty($summary)): ?>
    <p><?php print $summary ?></p>

      <?php if (strlen($summary) != strlen($body)): ?>
      <a href="<?php print $url; ?>"><?php print t('Read more'); ?></a>
      <?php endif; ?>
    <?php endif; ?>
  </div>
</div>
