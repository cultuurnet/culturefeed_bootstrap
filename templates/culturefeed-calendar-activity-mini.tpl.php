<?php
/**
 * @file
 * Template for the calendar mini summary of an activity.
 */
?>

<tr>
  <td class="col-xs-8">
    <h4 class="media-heading"><?php print $title; ?></h4>
    <span class="text-muted"><?php print $when; ?></span>
  </td>
  <td class="col-xs-2">
    <a class="use-ajax btn btn-primary" href="<?php print $edit_link['url'] ?>"><?php print $edit_link['text']; ?></a>
  </td>
  <td class="col-xs-2">
    <i class="fa fa-trash"></i>
    <a class="use-ajax" href="<?php print $delete_link['url'] ?>"><?php print $delete_link['text']; ?></a>
  </td>
</tr>
