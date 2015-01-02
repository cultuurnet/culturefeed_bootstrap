<div class="followers-block user-list">

  <div class="text-right top right"><span class="badge"><?php print $num_followers ?></span></div>

  <?php if (!empty($followers)): ?>

    <ul class="list-unstyled list-inline">
    <?php foreach ($followers as $follower): ?>
      <li>
        <?php if ($follower['picture']): ?>
          <a href="<?php print $follower['url'] ?>" title="<?php print $follower['name'] ?>">
            <?php print theme('image', array('path' => $follower['picture'] . '?width=40&height=40&crop=auto', 'alt' => $follower['name'], 'attributes' => array('class' => '' , 'width' => '40', 'height' => '40'))) ?>
          </a>
        <?php else: ?>
          <a href="<?php print $follower['url'] ?>" title="<?php print $follower['name'] ?>">
            <img src="http://media.uitid.be/fis/rest/download/ce126667652776f0e9e55160f12f5478/uiv/default.png?maxwidth=40&maxheight=40&crop=auto" alt="<?php print t('Default user image'); ?>" />    
          </a>
        <?php endif; ?>
      </li>
    <?php endforeach; ?>
    </ul>

  <?php else: ?>
    <p class="text-muted"><small><?php print t('This page has no followers yet.'); ?></small></p>
  <?php endif; ?>

  <?php
  /**
   * .follow-PAGEID is used to refresh that part of the html. You can use it
   * freely as you want. E.g. wrap the text above in it or not.
   */
   ?>
  <div class="follow-<?php print $page->getId() ?>">
    <span class="set-btn default xs"><?php print $follow_link ?></span>
  </div>

</div>
