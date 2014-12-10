<?php

/**
 * @file
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->wrapper_prefix: A complete wrapper containing the inline_html to use.
 *   - $field->wrapper_suffix: The closing tag for the wrapper.
 *   - $field->separator: an optional separator that may appear before a field.
 *   - $field->label: The wrap label text to use.
 *   - $field->label_html: The full HTML of the label to use including
 *     configured element type.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */
?>
<?php 
  foreach ($fields as $key => $value) {
    //echo '<pre>';print_r($key);echo '</pre>';
  }
?>

<div class="row cf-search-summary">
  <div class="col-xs-3 col-lg-2">
    <?php print $fields['picture']->content; ?>
  </div>
  <div class="col-xs-9 col-lg-10">
    <div class="row">
      <h2 class="media-heading"><?php print $fields['title']->content; ?></h2>
      <span class="cf-short-description hidden-xs hidden-sm"><?php print $fields['description']->content; ?></span>
    </div>
    <div class="row">
      <div class="row">
        <div class="col-xs-2 hidden-xs hidden-sm"><strong><?php print t('Where'); ?></strong></div>
        <div class="col-xs-1 hidden-md hidden-lg text-center"><i class="fa fa-map-marker fa-fw"></i></div>
        <div class="col-xs-10"><?php print $fields['location']->content; ?></div>
      </div>
      <div class="row">
        <div class="col-xs-2 hidden-xs hidden-sm"><strong><?php print t('When'); ?></strong></div>
        <div class="col-xs-1 hidden-md hidden-lg text-center"><i class="fa fa-calendar fa-fw"></i></div>
        <div class="col-xs-10"><?php print $fields['when']->content; ?></div>
      </div>
      <div class="row">
        <div class="col-xs-2 hidden-xs hidden-sm"><strong><?php print t('Last updated'); ?></strong></div>
        <div class="col-xs-1 hidden-md hidden-lg text-center"><i class="fa fa-calendar fa-fw"></i></div>
        <div class="col-xs-10"><?php print $fields['lastupdated']->content; ?></div>
      </div>
      <div class="row operations">
        <?php print $fields['operations']->content; ?>
      </div>
      <!--
      <p></p>
      <p class="hidden-xs"><a href="/agenda/e/hyoseung-ye/c5399e60-1609-4810-89c8-5b05e72ad99d" class="btn btn-default" id="cf-readmore_c5399e60-1609-4810-89c8-5b05e72ad99d"><i class="fa fa-ticket"></i> Meer info</a></p> 
      --> 
    </div>
  </div>
</div>
<hr class="small">