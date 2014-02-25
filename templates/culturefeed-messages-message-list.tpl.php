<?php if (!empty($add_new_url)): ?>
<h2><?php print t('Inbox'); ?>
  <a href="<?php print $add_new_url; ?>" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> <?php print t('New message'); ?></a>
</h2>
<?php endif; ?>
  
<div class="messages list-group">

  <?php foreach ($items as $item): ?>
    <?php print $item['data'] ?>
  <?php endforeach; ?>
  
</div>
