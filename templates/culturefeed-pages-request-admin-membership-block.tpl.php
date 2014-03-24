<?php
/**
 * Block template to request admin membership.
 * @vars
 *   - $url: use this if you want to customize the link (no ajax)
 *   - $link : ajax link
 */
?>
<div class="well">
  <p><strong><?php print t('Request to become an administrator'); ?></strong></p><p> <?php print t('This page currently has no administrator. As an administrator, you can update page details, layout and manage members.'); ?></p>
<a href="<?php print $url ?>" class="btn btn-warning btn-block"><?php print t('Send request'); ?></a>
</div>
