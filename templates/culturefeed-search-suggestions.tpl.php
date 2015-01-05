<?php
/**
 * @vars
 *   - $suggestions (key = search string, value = search url)
 */
?>

<hr />

<h3 class="block-title"><?php print t('Did you mean'); ?>:</h3>
  <?php foreach ($suggestions as $suggestion_words => $suggestion_url): ?>
    <span class="suggestion"><a href="<?php print $suggestion_url; ?>"><?php print $suggestion_words ?></a></span>
  <?php endforeach;?>
</p>
