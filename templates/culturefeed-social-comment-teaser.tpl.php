<?php
/**
 * @file
 * Template file for comment teasers when shown in streams.
 */
?>

<div class="media col-xs-11 well" id="activity-<?php print $activity_id ?>">

  <div class="media-body">

    <blockquote>
      <p><?php print $content_teaser ?></p>

      <?php if (strlen($content_teaser) != strlen($content)): ?>
        <?php print l(t('Read more') . ' <span class="caret"></span>', '', array('attributes' => array('data-toggle' => 'collapse'), 'fragment' => 'comment-full-' . $activity_id, 'html' => TRUE)) ?>
        <div id="comment-full-<?php print $activity_id ?>" class="collapse collapse-in"><?php print $content; ?></div>
      <?php endif; ?>
    </blockquote>
  </div>

  <?php if ($delete_link || $comment_link || $abuse_link): ?>
  <ul class="list-inline">
    <?php if ($delete_link): ?>
    <li>
      <i class="fa fa-trash-o fa-fw"></i> <small><?php print $delete_link ?></small>
      <hr class="small" />
    </li>
    <?php endif; ?>

    <?php if ($comment_link): ?>
    <li>
      <i class="fa fa-comments fa-fw"></i> <small><?php print $comment_link ?></small>
      <hr class="small" />
    </li>
    <?php endif; ?>

    <?php if ($abuse_link): ?>
    <li>
      <i class="fa fa-flag fa-fw"></i> <small><?php print $abuse_link ?></small>
      <hr class="small" />
    </li>
    <?php endif; ?>
  <?php endif; ?>
  </ul>

</div>