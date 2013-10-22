<ul class="menu nav navbar-nav navbar-right">
  <?php if ($dropdown_items): ?>
  <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php print $picture ?> <?php print $nick ?> <b class="caret"></b></a>
    <ul class="dropdown-menu">
      <?php foreach ($dropdown_items as $dropdown_item): ?>
      <li class="<?php if (isset($dropdown_item['class'])): print $dropdown_item['class']?><?php endif;?> <?php if (isset($dropdown_item['children'])): print 'dropdown-header' ?><?php endif;?>">
        <?php print $dropdown_item['data']; ?>
      </li>
      <?php // Show children on same level but close with divider. ?>
      <?php if (isset($dropdown_item['children'])): ?>
        <?php foreach ($dropdown_item['children'] as $dropdown_sub_item): ?>
        <li class="<?php if (isset($dropdown_item['class'])): print $dropdown_item['class']?><?php endif;?>">
          <?php print $dropdown_sub_item['data']; ?>
        </li>
        <?php endforeach; ?>
        <li class="divider"></li>
      <?php endif; ?>
      <?php endforeach;?>
    </ul>
  </li>
  <?php endif; ?>

  <?php // Render main items ?>
  <?php foreach ($main_items as $item): ?>
  <li class="divider-vertical"></li>
  <li<?php if (isset($item['class'])): print ' class="' . $item['class'] . '"' ?> <?php endif;?>><?php print $item['data']; ?></li>
  <?php endforeach; ?>
  <li class="divider-vertical"></li>
</ul>
