<section id="<?php print $block_html_id; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <?php print render($title_prefix); ?>
  <?php if ($title): ?>
    <p<?php print $title_attributes; ?>><?php print $title; ?></p>
  <?php endif;?>
  <?php print render($title_suffix); ?>

  <?php print $content ?>

</section> <!-- /.block -->
