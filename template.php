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
    '#markup' => '<p class="lead"><i class="fa fa-search"></i>  ' . t('Search') . '</p>',
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

/**
 * Implements hook_preprocess_culturefeed_agenda_detail().
 */
function _culturefeed_bootstrap_preprocess_culturefeed_agenda_detail(&$variables) {
  // Ticket links.
  if (isset($variables['ticket_links'])) {
    $ticket_links = $variables['ticket_links'];
    $variables['tickets'] = array();
    foreach ($ticket_links as $link) {
      $variables['tickets'][] = l(t('Buy tickets'), $link->getHLink(), array('attributes' => array('class' => 'btn btn-warning btn-xs', 'rel' => 'nofollow'), 'html' => TRUE));
    }
  }
}

/**
 * Implements hook_preprocess_culturefeed_event().
 */
function culturefeed_bootstrap_preprocess_culturefeed_event(&$variables) {
  _culturefeed_bootstrap_preprocess_culturefeed_agenda_detail($variables);
}

/**
 * Implements hook_preprocess_culturefeed_production().
 */
function culturefeed_bootstrap_preprocess_culturefeed_production(&$variables) {
  _culturefeed_bootstrap_preprocess_culturefeed_agenda_detail($variables);
}


/**
 * Implements hook_form_{culturefeed_ui_page_profile_edit_form}_alter().
 */
function culturefeed_bootstrap_form_culturefeed_ui_page_profile_edit_form_alter(&$form, &$form_state) {

  try {
    $cf_account = DrupalCultureFeed::getLoggedInUser();
  }
  catch (Exception $e) {
    watchdog_exception('culturefeed_ui', $e);
    drupal_set_message(t('Error occurred'), 'error');
    return;
  }
   
  unset($form['view-profile']);

  // About me
  
  // Firstname.
  $form['givenName'] = array(
    '#prefix' => '<div class="panel panel-default"><div class="panel-heading"><h4 class="panel-title pull-left">' . ' ' . t('About me') . '</h4><span class="pull-right"><i class="fa fa-eye"></i> <a href="/user/'. culturefeed_get_uid_for_cf_uid($cf_account->id, $cf_account->nick) . '" class="profile-edit-link">'. t('View') . '</a></span><div class="clearfix"></div></div><div class="panel-body"><div class="row"><div class="col-xs-6">', 
    '#suffix' => '</div>',   
    '#attributes' => array('placeholder' => array(t('First name'))),
    '#type' => 'textfield',
    '#title' => t('First name'),
    '#default_value' => $cf_account->givenName,
    '#weight' => '-299',
  );

  // Name.
  $form['familyName'] = array(
    '#prefix' => '<div class="col-xs-6">',   
    '#suffix' => '</div></div>',   
    '#attributes' => array('placeholder' => array(t('Family name'))),
    '#type' => 'textfield',
    '#title' => t('Family name'),
    '#default_value' => $cf_account->familyName,
    '#weight' => '-289',
  );

  // Bio
  $form['bio'] = array(
    '#type' => 'textarea',
    '#title' => t('Biography'),
    '#default_value' => $cf_account->bio,
    '#description' => t('Maximum 250 characters'),
    '#weight' => '-279',
  );

  // Picture.
  $form['#attributes']['enctype'] = 'multipart/form-data';

  $form['current_picture'] = array(
    '#prefix' => '<div class="row"><div class="col-md-6"><div class="row"><div class="col-md-4">',
    '#theme' => 'image',
    '#path' => $cf_account->depiction . '?maxwidth=100&maxheight=100&crop=auto',
    '#attributes' => array('class' => array('img-thumbnail')),
    '#suffix' => '</div>',
    '#weight' => '-269',

  );

  $form['picture'] = array(
    '#prefix' => '<div class="col-md-8">',
    '#suffix' => '</div></div></div></div><hr />',
    '#type' => 'file',
    '#size' => 26,
    '#title' => t('Choose picture'),
    '#weight' => '-259',
  );
  
  // Date of birth.
  $form['dob'] = array(
    '#title' => t('Date of birth'),
    '#type' => 'textfield',
    '#default_value' => $cf_account->dob ? date('d/m/Y', $cf_account->dob) : '',
    '#attributes' => array('placeholder' => array('01/01/1970')),
    '#size' => 10,
    '#weight' => '-249',
  );
    
    // Gender.
  $form['gender'] = array(
    '#suffix' => '</div></div>',
    '#type' => 'radios',
    '#title' => 'Geslacht',
    '#options' => array('male' => t('Male'), 'female' => t('Female')),
    '#default_value' => $cf_account->gender,
    '#weight' => '-239',
  );
  
  // Contact
  
    // Address
  $form['street'] = array(
    '#prefix' => '<div class="panel-group" id="accordion"><div class="panel panel-default"><div class="panel-heading"><h4 class="panel-title"><span class="caret"></span><a data-toggle="collapse" data-parent="#accordion" href="#contact">' . ' ' . t('Contact') . '</a></h4></div><div id="contact" class="panel-collapse collapse"><div class="panel-body">',
    '#suffix' => '</li>',
    '#type' => 'textfield',
    '#title' => t('Street and number'),
    '#default_value' => $cf_account->street,
    '#weight' => '-199',
  );
  $form['zip'] = array(
    '#prefix' => '<div class="row"><div class="col-xs-2">',
    '#suffix' => '</div>',
    '#type' => 'textfield',
    '#title' => t('Zipcode'),
    '#default_value' => $cf_account->zip,
    '#weight' => '-189',
  );
  $form['city'] = array(
    '#prefix' => '<div class="col-xs-10">',
    '#suffix' => '</div></div>',
    '#type' => 'textfield',
    '#title' => t('City'),
    '#default_value' => $cf_account->city,
    '#weight' => '-179',
  );
  $form['country'] = array(
    '#suffix' => '</div></div></div>',
    '#type' => 'select',
    '#options' => country_get_list(),
    '#title' => t('Country'),
    '#default_value' => !empty($cf_account->country) ? $cf_account->country : 'BE',
    '#weight' => '-169',
  );
  
  // Privacy settings
  
  $form['givenNamePrivacy'] = array(
    '#prefix' => '<div class="panel panel-default"><div class="panel-heading"><h4 class="panel-title"><span class="caret"></span><a data-toggle="collapse" data-parent="#accordion" href="#privacy">' . ' ' . t('Privacy settings') . '</a></h4></div><div id="privacy" class="panel-collapse collapse"><ul class="list-group"> <li class="list-group-item">',
    '#suffix' => '</li>',
    '#type' => 'checkbox',
    '#field_prefix' => '<div class="make-switch" data-on="success" data-off="danger" data-on-label="'. t('ON') .'" data-off-label="'. t('OFF') . '">',
    '#field_suffix' => '</div>' . ' ' .  t('Hide \'first name\' in public profile'),
    //'#title' => t('Hide \'first name\' in public profile'),
    '#default_value' => $cf_account->privacyConfig->givenName == CultureFeed_UserPrivacyConfig::PRIVACY_PRIVATE,
    '#weight' => '-99',
  );
  
  $form['familyNamePrivacy'] = array(
    '#prefix' => '<li class="list-group-item">',
    '#suffix' => '</li>',
    '#type' => 'checkbox',
    '#field_prefix' => '<div class="make-switch" data-on="success" data-off="danger" data-on-label="'. t('ON') .'" data-off-label="'. t('OFF') . '">',
    '#field_suffix' => '</div>' . ' ' .  t('Hide \'family name\' in public profile'),
    //'#title' => t('Hide \'family name\' in public profile'),
    '#default_value' => $cf_account->privacyConfig->familyName == CultureFeed_UserPrivacyConfig::PRIVACY_PRIVATE,
    '#weight' => '-89',
  );
  
  $form['genderPrivacy'] = array(
    '#prefix' => '<li class="list-group-item">',
    '#suffix' => '</li>',
    '#type' => 'checkbox',
    '#field_prefix' => '<div class="make-switch" data-on="success" data-off="danger" data-on-label="'. t('ON') .'" data-off-label="'. t('OFF') . '">',
    '#field_suffix' => '</div>' . ' ' .  t('Hide \'gender\' in public profile'),
     //'#title' => t('Hide \'gender\' in public profile'),
    '#default_value' => $cf_account->privacyConfig->gender == CultureFeed_UserPrivacyConfig::PRIVACY_PRIVATE,
    '#weight' => '-79',

  );
  
  $form['homeAddressPrivacy'] = array(
    '#prefix' => '<li class="list-group-item">',
    '#suffix' => '</li>',
    '#type' => 'checkbox',
    '#field_prefix' => '<div class="make-switch" data-on="success" data-off="danger" data-on-label="'. t('ON') .'" data-off-label="'. t('OFF') . '">',
    '#field_suffix' => '</div>' . ' ' .  t('Hide \'address\' in public profile'),
     //'#title' => t('Hide \'address\' in public profile'),
    '#default_value' => $cf_account->privacyConfig->homeAddress == CultureFeed_UserPrivacyConfig::PRIVACY_PRIVATE,
    '#weight' => '-69',
  );
  
  $form['dobPrivacy'] = array(
    '#prefix' => '<li class="list-group-item">',
    '#suffix' => '</li>',
    '#type' => 'checkbox',
    '#field_prefix' => '<div class="make-switch" data-on="success" data-off="danger" data-on-label="'. t('ON') .'" data-off-label="'. t('OFF') . '">',
    '#field_suffix' => '</div>' . ' ' .  t('Hide \'date of birth\' in public profile'),
     //'#title' => t('Hide \'date of birth\' in public profile'),
    '#default_value' => $cf_account->privacyConfig->dob == CultureFeed_UserPrivacyConfig::PRIVACY_PRIVATE,
    '#weight' => '-59',
  );
  
  $form['bioPrivacy'] = array(
    '#prefix' => '<li class="list-group-item">',
    '#suffix' => '</li></ul></div></div>',
    '#type' => 'checkbox',
    '#field_prefix' => '<div class="make-switch" data-on="success" data-off="danger" data-on-label="'. t('ON') .'" data-off-label="'. t('OFF') . '">',
    '#field_suffix' => '</div>' . ' ' .  t('Hide \'biography\' in public profile'),
    //'#title' => t('Hide \'biography\' in public profile'),
    '#default_value' => $cf_account->privacyConfig->bio == CultureFeed_UserPrivacyConfig::PRIVACY_PRIVATE,
    '#weight' => '-49',
  );
  
   // Language settings - Default language
  
  $form['preferredLanguage'] = array(
    '#prefix' => '<div class="panel panel-default"><div class="panel-heading"><h4 class="panel-title"><span class="caret"></span><a data-toggle="collapse" data-parent="#accordion" href="#language">' . ' ' . t('Language settings') . '</a></h4></div><div id="language" class="panel-collapse collapse"><ul class="list-group"> <li class="list-group-item">',
    '#type' => 'select',
    '#default_value' => !empty($cf_account->preferredLanguage) ? $cf_account->preferredLanguage : '',
    '#title' => t('Preferred language'),
    '#options' => array(
      'nl' => t('Dutch'),
      'fr' => t('French'),
      'en' => t('English'),
      'de' => t('German'),
    ),
    '#weight' => '-9',
    '#suffix' => '</div></div>',
  );  
 
  $form['submit'] = array(
    '#prefix' => '<hr />',
    '#type' => 'submit',
    '#value' => t('Save'),
  );

  return $form;
}

/**
 * Implements hook_form_{culturefeed_ui_page_account_edit_form}_alter().
 */
function culturefeed_bootstrap_form_culturefeed_ui_page_account_edit_form_alter(&$form, &$form_state) {

  try {
    $cf_account = DrupalCultureFeed::getLoggedInUser();
  }
  catch (Exception $e) {
    watchdog_exception('culturefeed_ui', $e);
    drupal_set_message(t('An error occurred while loading your account, please try again later.'));
    return;
  }

  $destination = url('culturefeed/account/edit', array('absolute' => TRUE, 'query' => array('closepopup' => 'true')));

  $url = DrupalCultureFeed::getUrlChangePassword($cf_account->id, $destination);

  $options = array('attributes' => array('class' => array('culturefeedconnect')), 'query' => drupal_get_destination());

  unset($form['view-profile']);
  unset($form['remove_account']);


  $form['nick'] = array(
    '#prefix' => '<div class="panel panel-default"><div class="panel-heading"><h4 class="panel-title pull-left">' . ' ' . t('My UiTiD') . '</h4><span class="pull-right"><i class="fa fa-eye"></i> <a href="/user/'. culturefeed_get_uid_for_cf_uid($cf_account->id, $cf_account->nick) . '" class="profile-edit-link">'. t('View') . '</a> | <i class="fa fa-trash-o"></i> <a href="/culturefeed/removeaccount" class="profile-edit-link">'. t('Delete account') . '</a></span><div class="clearfix"></div></div><div class="panel-body">', 
    '#type' => 'textfield',
    '#title' => t('Username'),
    '#disabled' => TRUE,
    '#value' => $cf_account->nick,
    '#weight' => '-999',
  );

  $form['mbox'] = array(
    '#type' => 'textfield',
    '#title' => t('Email address'),
    '#default_value' => $cf_account->mbox,
    '#required' => TRUE,
    '#weight' => '-989',
  );

  $form['submit'] = array(
    '#prefix' => '<div class="row"><div class="col-sm-6">',
    '#type' => 'submit',
    '#value' => t('Edit e-mail'),
    '#attributes' => array('class' => array('btn-primary')),
    '#weight' => '-979',
  );
  
    $form['change_password'] = array(
    '#suffix' => '</div></div>',
    '#markup' => l(t('Change password'), $url, $options),
    '#weight' => '-969',
  );

  return $form;
}

?>
