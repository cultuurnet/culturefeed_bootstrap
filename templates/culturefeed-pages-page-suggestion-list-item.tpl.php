<?php
/**
 * @file
 * Template for the summary of a page.
 */
?>

<hr />
<div class="media">

  <div class="row">

    <div class="col-md-2 hidden-xs hidden-sm">
      <a href="<?php print $url ?>" title="<?php print $title ?>">
        <?php if (!empty($thumbnail)): ?>
          <img class="media-object thumbnail" src="<?php print $thumbnail; ?>?width=100" title="<?php print $title ?>" alt="<?php print $title ?>" />
        <?php else: ?>
          <img class="media-object thumbnail" src="<?php print base_path() . drupal_get_path('theme', 'culturefeed_bootstrap'); ?>/img/no-thumbnail.gif" title="<?php print $title ?>" alt="<?php print $title ?>" />
        <?php endif; ?>
      </a>
    </div>

    <div class="col-md-6 col-sm-8">
      <h3 class="media-heading">
        <a href="<?php print $url ?>"><?php print $title; ?>
          <?php if (!empty($address)): ?>
            <span class="text-muted">- <?php print $address['city']; ?></span>
          <?php endif; ?>
        </a>
      </h3>

      <p>
        <?php print $description ?>
        <a href="<?php print $url; ?>" class="nowrap"><?php print $more_text; ?>  &rarr;</a>
      </p>
    </div>

    <div class="col-md-4 col-sm-4">
      
      <div class="row">

        <div class="col-sm-6 hidden-xs text-right">

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
        
        </div>

        <div class="col-sm-6">
  
        <?php if ($logged_in): ?>
  
          <?php if (!$following): ?>
            <a href="<?php print $follow_url; ?>" class="btn btn-warning btn-xs"><span><?php print $follow_text; ?></span></a>
          <?php else: ?>
            <p class="text-muted"><small><?php print t('You follow this page'); ?></small></p>
          <?php endif; ?>
  
        <?php else: ?>
          <div class="follow-button"><?php print $follow_text; ?></div>
        <?php endif; ?>
        
        </div>

      </div>

    </div>

  </div>
</div>