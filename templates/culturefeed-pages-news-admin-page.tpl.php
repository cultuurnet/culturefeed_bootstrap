<h3><?php print t('News'); ?></h3>

<p>
  <?php print l(t('Add a news item') . ' ' . t('for') . ' ' . $page->getName() . ' ' .  '&rarr;', 'pages/' . $page->getId() . '/news/add', array('attributes' => array('class' => 'btn btn-default'), 'html' => TRUE)); ?>
  <span class="pull-right"><i class="fa fa-eye"></i> <?php print $view_page_link; ?></span>
</p>

<br />

<?php if (!empty($items)): ?>
<div class="table-responsive">
    <table class="table table-hover">
      <tbody>
        <?php foreach ($items as $item): ?>
        <tr>
          <td><a href="<?php print $item['url'] ?>"><?php print $item['title']; ?></a></td>
          <td class="text-muted"><?php print $item['date']; ?></td>
          <td><a href="<?php print $item['delete_url'] ?>"><?php print t('Delete') ?></a><td>
        </tr>
        <?php endforeach; ?>
      </tbody>
  </table>
</div>

  <?php print theme('pager') ?>
<?php else: ?>
    <p class="text-muted"><?php print t('There are currently no news items') ?></p>
<?php endif; ?>
