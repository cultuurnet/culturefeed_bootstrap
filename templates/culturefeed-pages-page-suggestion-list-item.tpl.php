<?php
/**
 * @file
 * Template for the summary of a page.
 */
?>

<hr />
<div class="media">

  <div class="row">

    <div class="col-md-8 media">
        <a class="pull-left" href="<?php print $url ?>">
          <?php if (!empty($thumbnail)): ?>
            <img class="media-object thumbnail hidden-xs" src="<?php print $thumbnail; ?>?width=100" title="<?php print $title ?>" alt="<?php print $title ?>" />
          <?php else: ?>
            <img style="width: 58px" class="media-object thumbnail hidden-xs" src="<?php print base_path() . drupal_get_path('theme', 'culturefeed_bootstrap'); ?>/img/no-thumbnail.gif" title="<?php print $title ?>" alt="<?php print $title ?>" />
          <?php endif; ?>
        </a>
      <h3 class="media-heading">
        <a href="<?php print $url ?>"><?php print $title; ?>
          <?php if (!empty($address)): ?>
            <span class="text-muted">- <?php print $address['city']; ?></span>
          <?php endif; ?>
        </a>
      </h3>

      <p>
        <?php print $description ?>
        <a href="<?php print $url; ?>"><?php print $more_text; ?>  &rarr;</a>
      </p>
    </div>

    <div class="col-md-4 text-right hidden-sm hidden-xs">

      <?php if ($follower_count > 0): ?>
        <div class="btn-group btn-group-xs">
          <span class="btn btn-success">
            <?php print format_plural($follower_count, '@count', '@count'); ?>
          </span>
          <span class="btn btn-default">
            <?php print format_plural($follower_count, t('follower'), t('followers')); ?>
          </span>
        </div>
      <?php endif; ?>

      <?php /*if ($member_count > 0): ?>
        <div class="btn-group btn-group-xs">
          <span class="btn btn-success">
            <?php print format_plural($member_count, '@count', '@count'); ?>
          </span>
          <span class="btn btn-default">
            <?php print format_plural($member_count, t('member'), t('members')); ?>
          </span>
        </div>
      <?php endif;*/ ?>

      <?php if ($logged_in): ?>

      <?php if (!$following): ?>
        <a class="btn btn-warning btn-xs" href="<?php print $follow_url; ?>"><span><?php print $follow_text; ?></span></a>
      <?php else: ?>
        <p class="text-muted"><small><?php print t('You follow this page'); ?></small></p>
      <?php endif; ?>

      <?php else: ?>
        <p><small><?php print $follow_text; ?></small></p>
      <?php endif; ?>

    </div>

  </div>
</div>