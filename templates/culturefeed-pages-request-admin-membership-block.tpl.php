<?php
/**
 * Block template to request admin membership.
 * @vars
 *   - $url: use this if you want to customize the link (no ajax)
 *   - $link : ajax link
 */
?>
<div class="alert alert-info">
  <p><strong><?php print t('Just noticed a mistake?'); ?></strong> <?php print t('This page currently has no administrator. As an administrator, you can update page details, layout and manage members.'); ?> <a href="<?php print $url ?>" class="alert-link"><?php print t('Send a request to become administrator'); ?></a></p>
</div>
