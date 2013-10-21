<?php

/**
 * Implements hook_js_alter().
 */
function culturefeed_bootstrap_js_alter(&$js) {

  $path = drupal_get_path('theme', 'culturefeed_bootstrap');
  $files = array(
    $path . '/js/lib/jquery-1.9.1.min.js' => -101,
    $path . '/js/jquery-switch.js' => -99,
  );

  // Place them on top of all js files.
  foreach ($files as $file => $weight) {
    $js[$file] = drupal_js_defaults();
    $js[$file]['data'] = $file;
    $js[$file]['group'] = -50;
    $js[$file]['weight'] = $weight;
  }
}

?>