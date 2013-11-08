<?php

/**
 * Implements hook_js_alter().
*/

function culturefeed_bootstrap_js_alter(&$javascript) {
  // Replace with current version.
  $jQuery_version = '1.8.3';
  $javascript['misc/jquery.js']['data'] = drupal_get_path('theme', 'culturefeed_bootstrap').'/js/lib/jquery.1.8.3.min.js';
  $javascript['misc/jquery.js']['version'] = $jQuery_version;
}

/**
 * Implements hook_{culturefeed_search_ui_search_block_form}_alter().
 */
function culturefeed_bootstrap_form_culturefeed_agenda_search_block_form_alter(&$form, &$form_state) {
  $form['#prefix'] = '<div class="row">';
  $form['title'] = array(
    '#prefix' => '<div class="col-sm-2">',
    '#type' => 'item',
    '#markup' => '<p class="lead"><span class="glyphicon glyphicon-search text-small"></span> Zoek</p>',
    '#suffix' => '</div>',
  );
  $form['category']['#prefix'] = '<div class="col-sm-3">';
  $form['category']['#weight'] = '1';
  $form['category']['#title'] = '';
  $form['category']['#suffix'] = '</div>';
  $form['search']['#prefix'] = '<div class="col-sm-4">';
  $form['search']['#weight'] = '2';
  $form['search']['#title'] = '';
  $form['search']['#suffix'] = '</div>';
  $form['submit']['#prefix'] = '<div class="col-sm-3">';
  $form['submit']['#weight'] = '3';
  $form['submit']['#suffix'] = '</div>';
  $form['nearby']['#weight'] = '3';
  $form['nearby']['#prefix'] = '<div class="visible-xs visible-sm"><div class="col-sm-10 col-sm-offset-2">';
  $form['nearby']['#suffix'] = '</div></div>';
  $form['search']['#autocomplete_path'] = '';
  $form['#suffix'] = '</div>';
}


?>
