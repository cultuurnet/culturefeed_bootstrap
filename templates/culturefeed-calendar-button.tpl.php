<?php
/**
 * @file
 * Template for the calendar add or view buttons.
 */
?>

<?php if ($button['action'] == 'view') : ?>
  <?php if ($button['location'] == 'content') : ?>
    <div class="col">
      <div class="row">
        <div class="col-sm-1">
          <span class="fa-stack fa-lg">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-check fa-stack-1x fa-inverse"></i>
          </span>
        </div>
        <div class="col-sm-9">
          <div>
            <strong><?php print t('This activity is added to your OuTcalendar.'); ?></strong>
          </div>
          <div>
            <?php print l($button['text'], $button['url']); ?>
          </div>
        </div>
      </div>
    </div>
  <?php elseif ($button['location'] == 'footer') : ?>
    <div>
      <?php print t('This activity has been saved'); ?>
    </div>
    <div class="col-xs-3">
      <div class="row">
        <div class="col-sm-3">
          <span class="fa-stack fa-lg">
            <i class="fa fa-calendar fa-stack-1x"></i>
          </span>
        </div>
        <div class="col-sm-9">
          <?php print l($button['text'], $button['url']); ?>
        </div>
      </div>
      <div>
        <?php print t("Don't forget to login to save your activities to your calendar"); ?>
      </div>
    </div>
  <?php endif; ?>
<?php elseif ($button['action'] == 'add') : ?>
  <?php if ($button['location'] == 'content') : ?>
    <div class="col">
      <div class="row">
        <div class="col-sm-1">
          <span class="fa-stack fa-lg">
            <i class="fa fa-calendar-o fa-stack-1x"></i>
          </span>
        </div>
        <div class="col-sm-9">
          <div>
            <?php print l($button['text'], $button['url']); ?>
          </div>
        </div>
      </div>
    </div>
  <?php elseif ($button['location'] == 'footer') : ?>
    <div class="col-xs-3">
      <div class="row">
        <div class="col-sm-3">
          <span class="fa-stack fa-lg">
            <i class="fa fa-calendar-o fa-stack-1x"></i>
          </span>
        </div>
        <div class="col-sm-9">
          <?php print l($button['text'], $button['url']); ?>
        </div>
      </div>
    </div>
  <?php endif; ?>
<?php endif; ?>

<div class="calendar-button">
  <?php if (isset($button['description'])) : ?>
    <?php print $button['description']; ?>
  <?php endif; ?>

  <a href="<?php print url($button['path']); ?>" data-toggle="modal" data-target="#modal-calendar" data-remote="<?php print url($button['path']); ?>/ajax"><?php print $button['text']; ?></a>
</div>

<div id="modal-calendar" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-body outer"></div>
</div>
