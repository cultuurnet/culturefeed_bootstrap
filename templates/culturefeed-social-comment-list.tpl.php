<?php
/**
 * @vars
 *   $activities
 *   $url 
 *   $list
 */
?>
<div class="row">
  <?php if (!empty($list) && count($list) >= 1): ?>
  <p><a href="#comment" class="btn btn-default"><i class="fa fa-comment"></i> <?php print t('Post a comment'); ?></a></p>
  <?php endif; ?>
  
  <?php if (!empty($list)): ?>
    <a id="lees" class="anchor"></a>
      <?php foreach ($list as $list_item): ?>
      <?php print $list_item ?>
      <?php endforeach;?>
  <?php endif; ?>
</div>
<a id="comment" class="anchor"></a>

