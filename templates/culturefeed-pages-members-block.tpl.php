<div class="members-block user-list">

  <div class="count-number pull-right"><span class="badge"><?php print $num_members ?></span></div>

  <?php if (!empty($members)): ?>

    <ul class="list-unstyled list-inline">
    <?php foreach ($members as $member): ?>
      <li>
        <?php if ($member['picture']): ?>
          <a href="<?php print $member['url'] ?>" title="<?php print $member['name'] ?>">
            <?php print theme('image', array('path' => $member['picture'] . '?width=40&height=40&crop=auto', 'alt' => $member['name'], 'attributes' => array('class' => '' , 'width' => '40', 'height' => '40'))) ?>
          </a>
        <?php else: ?>
          <a href="<?php print $member['url'] ?>" title="<?php print $member['name'] ?>">
            <img src="http://media.uitid.be/fis/rest/download/ce126667652776f0e9e55160f12f5478/uiv/default.png?maxwidth=40&maxheight=40&crop=auto" />    
          </a>
        <?php endif; ?>
      </li>
    <?php endforeach; ?>
    </ul>

  <?php else: ?>
    <p class="text-muted"><small><?php print t('This page has no members yet.'); ?></small></p>
  <?php endif; ?>

  <?php
  /**
   * .member-PAGEID is used to refresh that part of the html. You can use it
   * freely as you want. E.g. wrap the text above in it or not.
   */
   ?>
  <div class="member-<?php print $page->getId() ?>">
    <?php print $member_link ?>
  </div>

</div>
