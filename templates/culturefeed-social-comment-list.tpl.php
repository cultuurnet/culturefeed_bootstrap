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
  <div class="col-xs-12">
    <p><a href="#comment-form" id="comment-list" class="btn btn-default"><i class="fa fa-comment"></i> <?php print t('Post a comment'); ?></a></p>
  </div>
  <?php endif; ?>
  
  <?php if (!empty($list)): ?>
    <p><a id="comment-list" class="anchor"></a></p>
      <?php foreach ($list as $list_item): ?>
      <?php print $list_item ?>
      <?php endforeach;?>
  <?php endif; ?>
</div>
<a id="comment-form" class="anchor"></a>

