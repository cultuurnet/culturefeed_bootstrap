<?php
/**
 * @file
 * Template file for news teasers when shown in streams.
 */
?>

<div class="media col-xs-11 well">

  <?php if(isset($image)): ?>
    <img src="<?php print $image ?>" alt="<?php print $title ?>" class="media-object pull-left visible-desktop thumbnail img-responsive" width="150" />
  <?php endif; ?>

  <div class="media-body">
    <h3 class="media-heading"><?php print $link; ?></h3>

    <?php if (!empty($summary)): ?>
    <p><?php print $summary ?></p>

    <?php if (strlen($summary) != strlen($body)): ?>
      <?php print l(t('Read more') . ' <span class="caret"></span>', '', array('attributes' => array('data-toggle' => 'collapse'), 'fragment' => 'news-full-' . $activity_id, 'html' => TRUE)) ?>
      <div id="news-full-<?php print $activity_id ?>" class="collapse collapse-in"><?php print $body; ?></div>
    <?php endif; ?>
    <?php endif; ?>
  </div>
</div>
