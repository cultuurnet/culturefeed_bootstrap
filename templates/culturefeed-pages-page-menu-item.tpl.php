<a href="/<?php print $url ?>">
  <?php
  if (strstr($link,'configuration')) {
    print '<i class="fa fa-cog fa-fw fa-lg"></i> <strong>' . $title . '</strong>';
  } 
  elseif (strstr($link,'edit')) {
    print '<i class="fa fa-pencil-square-o fa-fw fa-lg"></i> <strong>' . $title . '</strong>';
    }
  elseif (strstr($link,'members')) {
    print '<i class="fa fa-group fa-fw fa-lg"></i> <strong>' . $title . '</strong>';
    }
  elseif (strstr($link,'events')) {
    print '<i class="fa fa-calendar fa-lg"></i> <strong>' . $title . '</strong>';
    }
  ?>
  <br />
  <small><?php print $description ?></small>
</a>
<li class="divider"></li>
