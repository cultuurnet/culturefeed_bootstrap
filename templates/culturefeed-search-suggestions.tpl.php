<?php
/**
 * @vars
 *   - $suggestions (key = search string, value = search url)
 */
?>

<hr />

<p class="block-title"><?php print t('Did you mean'); ?>:</p>
  <?php foreach ($suggestions as $suggestion_words => $suggestion_url): ?>
    <span class="suggestion"><a href="<?php print $suggestion_url; ?>"><?php print $suggestion_words ?></a></span>
  <?php endforeach;?>
</p>
