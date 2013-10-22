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

?>
