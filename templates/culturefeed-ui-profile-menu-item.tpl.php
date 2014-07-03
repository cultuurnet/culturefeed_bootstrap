<a href="/<?php print $url ?>">
  <?php
  if (strstr($link,'user')) {
    print '<i class="fa fa-eye fa-fw fa-lg"></i> <strong>' . $title . '</strong>';
  } 
  elseif (strstr($link,'profile')) {
    print '<i class="fa fa-user fa-fw fa-lg"></i> <strong>' . $title . '</strong>';
    } 
  elseif (strstr($link,'edit')) {
    print '<i class="fa fa-pencil-square-o fa-fw fa-lg"></i> <strong>' . $title . '</strong>';
    }
  elseif (strstr($link,'members')) {
    print '<i class="fa fa-group fa-fw fa-lg"></i> <strong>' . $title . '</strong>';
    }
  elseif (strstr($link,'pages')) {
    print '<i class="fa fa-building-o fa-fw fa-lg"></i> <strong>' . $title . '</strong>';
    }
  elseif (strstr($link,'activities')) {
    print '<i class="fa fa-thumbs-up fa-fw fa-lg"></i> <strong>' . $title . '</strong>';
    } 
  else {
    print '<i class="fa fa-gear fa-fw fa-lg"></i> <strong>' . $title . '</strong>';
    }
  ?>
  <br />
  <small><?php print $description ?></small>
</a>
<hr class="small" />
