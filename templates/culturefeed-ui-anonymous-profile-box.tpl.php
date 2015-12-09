<?php
/**
 * @file
 * Template file for the culturefeed ui login box.
 */

/**
 * @var string $link_login
 * @var string $link_register
 * @var string $link_login_facebook
 */
?>
<ul class="menu nav navbar-nav navbar-right">
  <li class="first last leaf"><?php print $link_login ?></li>
  <?php foreach ($main_items as $item): ?>
    <li<?php if (isset($item['class'])): print ' class="' . $item['class'] . '"' ?> <?php endif;?>><?php print $item['data']; ?></li>
  <?php endforeach; ?>
</ul>

