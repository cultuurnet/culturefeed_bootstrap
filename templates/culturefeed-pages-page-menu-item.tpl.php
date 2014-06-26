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
    print '<i class="fa fa-calendar fa-fw fa-lg"></i> <strong>' . $title . '</strong>';
    }
    
  elseif (strstr($link,'news')) {
    print '<i class="fa fa-rss fa-fw fa-lg"></i> <strong>' . $title . '</strong>';
    }   
  ?>
  <br />
  <small><?php print $description ?></small>
</a>
<hr class="small" />
