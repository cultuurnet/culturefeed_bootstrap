<?php
/**
 * @file
 * Template for the calendar add or view buttons.
 */
?>

<?php if ($button['action'] == 'view') : ?>
  <?php if ($button['location'] == 'content') : ?>
    <div class="col <?php print $button['class']; ?>">
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
            <a href="<?php print url($button['path']); ?>"><?php print $button['text']; ?></a>
          </div>
        </div>
      </div>
    </div>
  <?php elseif ($button['location'] == 'footer') : ?>
    <div class="col-xs-3 <?php print $button['class']; ?>">
      <div>
        <?php print t('This activity has been saved'); ?>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <span class="fa-stack fa-lg">
            <i class="fa fa-calendar fa-stack-1x"></i>
          </span>
        </div>
        <div class="col-sm-9">
          <a href="<?php print url($button['path']); ?>"><?php print $button['text']; ?></a>
        </div>
      </div>
      <div>
        <?php print t("Don't forget to login to save your activities to your calendar"); ?>
      </div>
    </div>
  <?php endif; ?>
<?php elseif ($button['action'] == 'add') : ?>
  <?php if ($button['location'] == 'content') : ?>
    <div class="col <?php print $button['class']; ?>">
      <div class="row">
        <div class="col-sm-1">
          <span class="fa-stack fa-lg">
            <i class="fa fa-calendar-o fa-stack-1x"></i>
          </span>
        </div>
        <div class="col-sm-9">
          <div>
            <a href="<?php print url($button['path']); ?>" class="use-ajax"><?php print $button['text']; ?></a>
          </div>
        </div>
      </div>
    </div>
  <?php elseif ($button['location'] == 'footer') : ?>
    <div class="col-xs-3 <?php print $button['class']; ?>">
      <div class="row">
        <div class="col-sm-3">
          <span class="fa-stack fa-lg">
            <i class="fa fa-calendar-o fa-stack-1x"></i>
          </span>
        </div>
        <div class="col-sm-9">
          <a href="<?php print url($button['path']); ?>" class="use-ajax"><?php print $button['text']; ?></a>
        </div>
      </div>
    </div>
  <?php endif; ?>
<?php endif; ?>
