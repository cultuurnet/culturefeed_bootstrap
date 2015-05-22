<?php if ($total == 0) : ?>
<p><strong><?php print t('No users found'); ?></strong></p>
<?php else: ?>

<div class="table-responsive">
  <table class="table">
    <?php foreach ($results as $result): ?>
      <tr>
        <td><a href="<?php print $result['profile_url']; ?>"><?php print $result['nick']; ?></a></td>
        <td><?php print $result['add_link']; ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
</div>

<?php endif; ?>
