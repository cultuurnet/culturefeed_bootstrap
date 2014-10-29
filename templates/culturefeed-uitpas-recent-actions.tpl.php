<?php

/**
 * @file
 * Default theme implementation to display culturefeed uitpas recent actions.
 *
 * Available variables:
 * - $actions_form: Form to set publishing of actions.
 * - $actions_list: The list of actions.
 */
?>
<?php if ($activity_preferences_form): ?>
<div class="activity-preferences-form">
  <?php print $activity_preferences_form; ?>
</div>
<?php endif; ?>
<?php if (!empty($actions)): ?>
<ul class="bullets">
  <?php foreach ($actions as $action): ?>
  <li class="media">
    <div class="media-object pull-left visible-desktop thumbnail">
    <?php if($action->depiction): ?>
      <img src="<?php print $action->depiction ?>?maxwidth=50&amp;maxheight=50&amp;crop=auto" />
    <?php endif; ?>
    </div>
    <div class="media-body">
      <p>
        <span class="text-highlight"><?php print $action->nick ?></span>
        spaarde
        <?php if ($action->points == '1'): ?>
          <?php print $action->points ?> punt
        <?php else: ?>
          <?php print $action->points ?> punten
        <?php endif; ?>
        bij
        <?php if ($action->contentType == 'event'): ?>
          <a href="/agenda/e//<?php print $action->nodeId ?>"><?php print $action->nodeTitle ?></a>
        <?php elseif ($action->contentType == 'production'):  ?>
          <a href="/agenda/p//<?php print $action->nodeId ?>"><?php print $action->nodeTitle ?></a>
        <?php endif; ?>
        - <small class="text-muted"><?php print format_date($action->creationDate, $type = 'short') ?></small>
      </p>
    </div>

  </li>
  <?php endforeach;?>
</ul>

  <?php else: ?>
   <p class="text-muted">Er zijn momenteel geen UiTPAS acties beschikbaar.</p>

<?php endif; ?>
