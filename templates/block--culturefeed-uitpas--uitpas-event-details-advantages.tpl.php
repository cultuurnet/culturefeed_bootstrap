<section id="<?php print $block_html_id; ?>" class="well col-sm-4 <?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <?php print render($title_prefix); ?>
  <?php if ($title): ?>
    <h3 class="block-title">
    	<img src="/sites/all/themes/uitpas_bootstrap/img/logo/uitpas.png" alt="<?php print t('Uitpas'); ?>"> 
    	- voordelen
    </h3>
  <?php endif;?>
  <?php print render($title_suffix); ?>

  <?php print $content ?>

</section> <!-- /.block -->
