<div class="colleague-block user-list">

  <?php if (!empty($colleagues)): ?>
  <ul class="list-unstyled list-inline">
  <?php foreach ($colleagues as $colleague): ?>
    <li>
      <?php if ($colleague['picture']): ?>
        <a href="<?php print $colleague['url'] ?>" title="<?php print $colleague['name'] ?>">
          <?php print theme('image', array('path' => $colleague['picture'] . '?width=40&height=40&crop=auto', 'alt' => $colleague['name'], 'attributes' => array('class' => '' , 'width' => '40', 'height' => '40'))) ?>
        </a>
      <?php else: ?>
        <a href="<?php print $colleague['url'] ?>" title="<?php print $colleague['name'] ?>">
          <img src="http://media.uitid.be/fis/rest/download/ce126667652776f0e9e55160f12f5478/uiv/default.png?maxwidth=40&maxheight=40&crop=auto" />    
        </a>
      <?php endif; ?>
    </li>
  <?php endforeach; ?>
  </ul>

  <?php else: ?>
    <p class="text-muted"><small><?php print $nick; ?> <?php print t('is at the moment the only member of the page') . ' ' . $title ?>.</small></p>
  <?php endif; ?>

  <?php if ($is_member): ?>
  <p><small><?php print t('You are a member of') . ' ' . $title ?></small></p>
  <?php else: ?>
  <p><small><?php print t('Are you a colleague of') . ' ' . $nick . ' ' . t('at') . ' ' . $title ?>? <strong><a href="<?php print $become_member_url; ?>"><?php print t('Become a member'); ?></a></strong></small></p>
  <?php endif; ?>

</div>
