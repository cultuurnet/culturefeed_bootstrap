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
 * Implements hook_{culturefeed_agenda_search_block_form}_alter().
 */
function culturefeed_bootstrap_form_culturefeed_agenda_search_block_form_alter(&$form, &$form_state) {
  $form['#prefix'] = '<div class="well"><div class="row">';
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
  $form['search']['#prefix'] = '<div class="col-sm-5">';
  $form['search']['#weight'] = '2';
  $form['search']['#title'] = '';
  $form['search']['#autocomplete_path'] = '';
  $form['search']['#suffix'] = '</div>';
  $form['submit']['#prefix'] = '<div class="col-sm-2">';
  $form['submit']['#attributes']['class'][] = 'btn-block';
  $form['submit']['#weight'] = '3';
  $form['submit']['#suffix'] = '</div>';
  $form['nearby']['#weight'] = '3';
  $form['nearby']['#prefix'] = '<div class="visible-xs visible-sm"><div class="col-sm-10 col-sm-offset-2">';
  $form['nearby']['#suffix'] = '</div></div>';
  $form['#suffix'] = '</div></div>';
}

/**
 * Implements hook_{culturefeed_search_ui_search_block_form}_alter().
 */
function culturefeed_bootstrap_form_culturefeed_search_ui_search_block_form_alter(&$form, &$form_state) {
  $form['#prefix'] = '<div class="well"><div class="row">';
  $form['title'] = array(
    '#prefix' => '<div class="col-sm-2">',
    '#type' => 'item',
    '#markup' => '<p class="lead"><i class="fa fa-search"></i>  ' . t('Search') . '</p>',
    '#suffix' => '</div>',
  );
  $form['type']['#prefix'] = '<div class="col-sm-3">';
  $form['type']['#weight'] = '1';
  $form['type']['#title'] = '';
  $form['type']['#suffix'] = '</div>';
  $form['search']['#prefix'] = '<div class="col-sm-5">';
  $form['search']['#weight'] = '2';
  $form['search']['#title'] = '';
  $form['search']['#autocomplete_path'] = '';
  $form['search']['#suffix'] = '</div>';
  $form['submit']['#prefix'] = '<div class="col-sm-2">';
  $form['submit']['#attributes']['class'][] = 'btn-block';
  $form['submit']['#weight'] = '3';
  $form['submit']['#suffix'] = '</div>';
  $form['#suffix'] = '</div></div>';
}

/**
 * Implements hook_{culturefeed_search_ui_search_sortorder_form}_alter().
 */
function culturefeed_bootstrap_form_culturefeed_search_ui_search_sortorder_form_alter(&$form, &$form_state) {
  $form['#prefix'] = '<div class="pull-right"><div class="row">';
  $form['title'] = array(
    '#prefix' => '<div class="col-sm-6">',
    '#type' => 'item',
    '#markup' => '<p class="text-right"><strong>' . t('Sort') . '</strong>',
    '#suffix' => '</div>',
  );
  $form['sort']['#prefix'] = '<div class="col-sm-6">';
  $form['sort']['#weight'] = '2';
  $form['sort']['#attributes']['class'][] = 'input-sm';
  $form['sort']['#title'] = '';
  $form['sort']['#suffix'] = '</div>';
  $form['#suffix'] = '</div></div>';
}

/**
 * Helper function to make long (dutch) calendar summary more readable for events and productions.
 */
function culturefeed_bootstrap_cleanup_calsum($calsum, $minlength, $classname) {

  if (strlen($calsum) > $minlength) {
    // Search for weekdays to set break
    $search = array('ma', 'di', 'woe', 'do', 'vrij', 'za', 'zo');
    $replace = array('<br /><span class="' . $classname . '">ma</span>', '<br /><span class="' . $classname . '">di</span>', '<br /><span class="' . $classname . '">wo</span>', '<br /><span class="' . $classname . '">do</span>', '<br /><span class="' . $classname . '">vr</span>', '<br /><span class="' . $classname . '">za</span>', '<br /><span class="' . $classname . '">zo</span>', );
    $calsum = str_replace($search, $replace, $calsum);
    // Remove first break
    if (strpos($calsum, '<br />') == 0) {
      $calsum = substr($calsum, 6);;
    }
  }
  return $calsum;

}

/**
 * Show a share link to facebook.
 */
function culturefeed_bootstrap_share_link($item) {

  if (method_exists($item, 'getId')) {
    global $language;
    $activity_content_type = culturefeed_get_content_type($item->getType());
    $id = $item->getId();
    $path = culturefeed_search_detail_path($item->getType(), $item->getId(), $item->getTitle($language->language));
  }
  else {

    $activity_content_type = culturefeed_get_content_type(get_class($item));
    $id = $item->id;
    $path = $_GET['q'];

  }

  $share_url = url($path, array('absolute' => TRUE));

  $options = array(
    'attributes' => array(
      'target' => '_blank',
      'class' => 'link-icon facebook-share-link',
    ),
    'title' => t('Share on Facebook'),
    'query' => array('u' => $share_url),
    'html' => TRUE,
  );

  if (culturefeed_is_culturefeed_user()) {
    $options['attributes']['rel'] = url('culturefeed/do/' . CultureFeed_Activity::TYPE_FACEBOOK .'/' . $activity_content_type . '/' . urlencode($id) . '/ajax');
  }

  return l(t('Share on Facebook'), 'http://nl-nl.facebook.com/share.php', $options);

}

/**
 * Helper preprocess function for the general agenda item variables.
 */
function _culturefeed_bootstrap_preprocess_culturefeed_agenda(&$variables) {

  $item = $variables['item'];
  $entity = $item->getEntity();

  if (!culturefeed_is_culturefeed_user()) {
    $variables['recommend_link'] = theme('culturefeed_social_login_required_message', array(
      'activity_type' => CultureFeed_Activity::TYPE_RECOMMEND,
      'item' => $item,
      'url' => 'culturefeed/do/15/' . $item->getType() . '/' . $item->getId() . '/redirect',
    ));
    
    $variables['attend_link'] = theme('culturefeed_social_login_required_message', array(
      'activity_type' => CultureFeed_Activity::TYPE_IK_GA,
      'item' => $item,
      'url' => 'culturefeed/do/8/' . $item->getType() . '/' . $item->getId() . '/redirect',
    ));
  }

  $variables['share_link'] = culturefeed_bootstrap_share_link($item);

  $variables['print_link'] = l(t('Print'), '', array('attributes' => array('onclick' => 'javascript: window.print(); return false;'), 'external' => TRUE));

}

/**
 * Implements hook_preprocess_culturefeed_agenda_detail().
 */
function _culturefeed_bootstrap_preprocess_culturefeed_agenda_detail(&$variables) {
  _culturefeed_bootstrap_preprocess_culturefeed_agenda($variables);

  $item = $variables['item'];
  $cdb_item = $item->getEntity();

  $variables['delijn_link'] = '';
  $variables['map_link'] = '';
  $variables['route_link'] = '';

  global $language;
  // Add de lijn and route information links.
  if (isset($variables['location'])) {
    $variables['delijn_link'] = l('Routeplanner De Lijn', 'delijn/' . culturefeed_search_detail_path($item->getType(), $item->getId(), $item->getTitle($language->language)));
  }

  if (isset($variables['coordinates'])) {
    $variables['map_link'] = l('Stratenplan', 'map/' . culturefeed_search_detail_path($item->getType(), $item->getId(), $item->getTitle($language->language)));
    $variables['route_link'] = l('Routebeschrijving', 'map/' . culturefeed_search_detail_path($item->getType(), $item->getId(), $item->getTitle($language->language)), array(''));
    $map = culturefeed_agenda_get_map_render_array($item);
    unset($map['#attached']['js'][3]); // Remove the init on load.
    //$map['#attached']['js'][] = drupal_get_path('theme', 'culturefeed_bootstrap') . '/js/map-toggle.js';
    $variables['map'] = render($map);
  }

  // Calendar Summary.
  if (isset($variables['when'])) {
    $variables['when'] = culturefeed_bootstrap_cleanup_calsum($variables['when'], 150, 'calsum-day text-muted');
  }

  // Remove duplicate contact and reservation data
  if (isset($variables['contact']['mail']) && isset($variables['reservation']['mail'])) {
    if ($variables['contact']['mail'] == $variables['reservation']['mail']) {
      unset($variables['contact']['mail']);
    }
  }
  if (isset($variables['contact']['phone']) && isset($variables['reservation']['phone'])) {
    if ($variables['contact']['phone'] == $variables['reservation']['phone']) {
      unset($variables['contact']['phone']);
    }
  }

  // Ticket links.
  if (isset($variables['tickets']) && !empty($variables['tickets'])) {
    $variables['tickets'] = implode(', ', $variables['tickets']);
  }

  // Ticket buttons.
  if (isset($variables['ticket_buttons']) && !empty($variables['ticket_buttons'])) {
    $buttons = $variables['ticket_buttons'];
    foreach ($buttons as $button) {
      $ticket_button[] = l($button['text'], $button['link'], array('attributes' => array('class' => 'btn btn-warning btn-xs reservation-link'), 'html' => TRUE));
    }
    $variables['ticket_buttons'] = implode(' ', $ticket_button);
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
    '#title' => t('Gender'),
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
    '#suffix' => '</div></div></div>',
    '#markup' => l(t('Change password'), $url, $options),
    '#weight' => '-969',
  );

  return $form;
}

/**
 * Implements hook_links__locale_block().
 */
function culturefeed_bootstrap_links__locale_block(&$variables) {
  // the global $language variable tells you what the current language is
  global $language;
  // an array of list items
  $items = array();
  foreach($variables['links'] as $lang => $info) {
    $abbr = $info['language']->language;
    $name = $info['language']->native;
    $href = isset($info['href']) ? $info['href'] : '';
      $li_classes   = array();
      // if the global language is that of this item's language, add the active class
      if($lang === $language->language){
            $li_classes[] = 'active';
      }
      $link_classes = array();
      $options = array('attributes' => array('class'    => $link_classes),
                                             'language' => $info['language'],
                                             'html'     => true
                                             );
      $link = l($abbr, $href, $options);
      // display only translated links
      if ($href) $items[] = array('data' => $link, 'class' => $li_classes);
    }
  // output
  $attributes = array('class' => array('nav nav-pills'));
  $output = theme_item_list(array('items' => $items,
                                  'title' => '',
                                  'type'  => 'ul',
                                  'attributes' => $attributes
                                  ));
  return $output;
}


/**
 * Overriding preprocess variables for culturefeed-ui-connect.tpl.php.
 *
 * @see culturefeed-ui-connect.tpl.php
 */

function culturefeed_bootstrap_preprocess_culturefeed_ui_connect_hover(&$variables) {

  $query['destination'] = isset($variables['url']) ? $variables['url'] : $_GET['q'];
  $query['via'] = 'facebook';
  $facebook = '<div class="btn-group">';
  $facebook .= l('<i class="fa fa-facebook fa-lg"></i>', 'culturefeed/oauth/connect', array('html' => TRUE, 'attributes' => array('class' => array('culturefeedconnect connect-facebook btn btn-primary'), 'rel' => 'nofollow'), 'query' => $query));
  $facebook .= l(t('Login with Facebook'), 'culturefeed/oauth/connect', array('html' => TRUE, 'attributes' => array('class' => array('culturefeedconnect connect-facebook btn btn-primary'), 'rel' => 'nofollow'), 'query' => $query));
  $facebook .= '</div>';
  $variables['link_facebook'] = $facebook;
  $login_links = t('Or with') . ' ' . $variables['link_twitter'] . ', ' . $variables['link_google'] . ' ' . t('or') . ' ' . $variables['link_email'] . '.';

  $variables['login_message'] = $login_links;

}

/**
 * Theme the login required message when an anonymous user sees a social action.
 */
function culturefeed_bootstrap_culturefeed_social_login_required_message($variables) {

  $config = culturefeed_social_activity_get_config($variables['activity_type']);

  if ($variables['activity_type']) {

    if (!empty($variables['item'])) {

      $item = $variables['item'];
      if (!($item instanceof CultureFeed_Activity)) {
        $activity_name = CultureFeed_Activity::getNameById($variables['activity_type']);
        $title = (0 == $item->getActivityCount($activity_name)) ? $config->titleDoFirst : $config->titleDo;
        $url = empty($variables['url']) ? 'culturefeed/do/' . $config->type . '/' . $item->getType() . '/' . urlencode($item->getId()) : $variables['url'];
      }
      else {
        $title = $config->label;
        $url = empty($variables['url']) ? 'culturefeed/do/' . $config->type . '/activity/' . $item->nodeId : $variables['url'];
      }

    }
    else {
      $title = $config->titleDo;
      $url = $variables['url'];
    }

    $hover = theme('culturefeed_ui_connect_hover', array('url' => $url));
    $popover_options = array(
      'class' => '',
      'data-toggle' => 'popover',
      'data-content' => $hover,
      'data-placement' => 'top',
      'data-title' => '<strong>' . t('Connect with UiTiD') . '</strong>',
      'data-html' => 'true'
    );

    return l($title, $url, array('attributes' => $popover_options, 'html' => TRUE));

  }

  $hover = theme('culturefeed_ui_connect_hover', array('url' => $_GET['q']));

  return '<div class="login-required">' . $hover. '</div>';

}

/**
 * Show the form to add a new message.
 * @param $object
 *   Object to send this message to. Can be a page or a message.
 */
 
function culturefeed_bootstrap_form_culturefeed_messages_new_message_form_alter(&$form, &$form_state, &$variables) {


  $form['submit'] = array(
    '#type' => 'submit',
    '#attributes' => array('class' => array(t('btn btn-primary'))),
    '#value' => t('Send message'),
  );

  $form['#theme'] = 'culturefeed_messages_new_message_form';

  return $form;

}

/**
 * Theme the notifications profile box item.
 */
function culturefeed_bootstrap_culturefeed_social_profile_box_item_notifications($variables) {

  $icon = '<i class="fa fa-lg fa-bell-o"></i>';
  $icon_new = '<i class="fa fa-lg fa-bell"></i>';
  $total = $variables['total'];
  $url = 'culturefeed/notifications';

  if ($total > 0) {
    return l($icon_new . ' ' . '<small class="notification-count"><span class="new-notifications label label-danger">' . $total . '</span></small>', $url, array('html' => TRUE));
  }
  else {
    return l($icon, $url, array('html' => TRUE));
  }

}

/**
 * Theme the total messages profile box item.
 */
function culturefeed_bootstrap_culturefeed_messages_total_messages_profile_box_item($variables) {

  $icon = '<i class="fa fa-lg fa-envelope-o"></i>';
  $icon_new = '<i class="fa fa-lg fa-envelope"></i>';
  $total = $variables['total'];
  $url = 'culturefeed/messages';

  if ($total > 0) {
    return l($icon_new . ' ' . '<small class="notification-count"><span class="new-messages label label-danger">' . $total . '</span></small>', $url, array('html' => TRUE));
  }
  else {
    return l($icon, $url, array('html' => TRUE));
  }

}

/**
 * Form callback for the basic search form.
 */

function culturefeed_bootstrap_form_culturefeed_pages_basic_search_form_alter(&$form, &$form_state) {

  $form['page'] = array(
    '#prefix' => '<div class="row"><div class="col-xs-10">',
    '#suffix' => '</div>',
    '#type' => 'textfield',
    '#attributes' => array('placeholder' => array(t('Keyword'))),
    '#autocomplete_path' => 'ajax/culturefeed/pages/page-suggestion',
    '#default_value' => isset($_GET['search']) ? $_GET['search'] : '',
  );

  $form['submit'] = array(
    '#prefix' => '<div class="col-xs-2 form-group">',
    '#suffix' => '</div></div>',
    '#attributes' => array('class' => array('btn btn-primary')),
    '#type' => 'submit',
    '#value' => t('Search Page'),
  );

  return $form;

}

/**
 * Preprocess the culturefeed pages basic search page.
 * @see culturefeed-pages-basic-search-page.tpl.php
 */
function culturefeed_bootstrap_preprocess_culturefeed_pages_basic_search_page(&$variables) {

  if (!empty($variables['results'])) {

    $variables['items'] = array();
    foreach ($variables['results'] as $item) {
      $variables['items'][] = theme('culturefeed_pages_basic_search_result_item', array('item' => $item));
    }

  }

  if ($variables['total_results'] > 0) {
    $variables['total_results_message'] = '<hr /><div class="row"><div class="col-xs-12"><p class="text-muted">' . t("<strong>@total pages</strong> found for '@search'", array('@total' => $variables['total_results'], '@search' => $variables['search'], 'html' => TRUE)) . '</p></div></div>';
  }
  else {
    $variables['total_results_message'] =  '<hr /><div class="row"><div class="col-xs-12"><p class="text-muted">' .t("<strong>0 pages</strong> found for '@search'", array('@search' => $variables['search'], 'html' => TRUE)) . '</p></div></div>';
  }

  $query = drupal_get_query_parameters();

  $cf_user = DrupalCultureFeed::getLoggedInUser();
  
  
    $variables['create_message'] = '<hr /><div class="row"><div class="col-xs-12">' . l('<i class="fa fa-plus"></i>' . ' ' . t('Create your own page'), 'pages/add', array('query' => $query, 'html' => TRUE, 'attributes' => array('class' => array('btn btn-default')))) . '</div></div>';

}


/**
 * Theme the pager summary for a search result.
 */
function culturefeed_bootstrap_culturefeed_search_pager_summary($variables) {

  $result = $variables['result'];

  $end = $variables['start'] + $result->getCurrentCount();
  $args = array(
    '@range' => ($variables['start'] + 1) . '-' . $end,
  );

  $pager_summary = format_plural($result->getTotalCount(), '@range from @count result', '@range from @count results', $args);

  return '<hr /><p class="pagination text-muted pull-left">' . $pager_summary . '</p>';

}

/**
 * Overrides theme_pager().
 */
function culturefeed_bootstrap_pager($variables) {
  $output = "";
  $items = array();
  $tags = $variables['tags'];
  $element = $variables['element'];
  $parameters = $variables['parameters'];
  $quantity = $variables['quantity'];

  global $pager_page_array, $pager_total;

  // Calculate various markers within this pager piece:
  // Middle is used to "center" pages around the current page.
  $pager_middle = ceil($quantity / 2);
  // Current is the page we are currently paged to.
  $pager_current = $pager_page_array[$element] + 1;
  // First is the first page listed by this pager piece (re quantity).
  $pager_first = $pager_current - $pager_middle + 1;
  // Last is the last page listed by this pager piece (re quantity).
  $pager_last = $pager_current + $quantity - $pager_middle;
  // Max is the maximum page number.
  $pager_max = $pager_total[$element];

  // Prepare for generation loop.
  $i = $pager_first;
  if ($pager_last > $pager_max) {
    // Adjust "center" if at end of query.
    $i = $i + ($pager_max - $pager_last);
    $pager_last = $pager_max;
  }
  if ($i <= 0) {
    // Adjust "center" if at start of query.
    $pager_last = $pager_last + (1 - $i);
    $i = 1;
  }

  // End of generation loop preparation.
  // @todo add theme setting for this.
  // $li_first = theme('pager_first', array(
  // 'text' => (isset($tags[0]) ? $tags[0] : t('first')),
  // 'element' => $element,
  // 'parameters' => $parameters,
  // ));
  $li_previous = theme('pager_previous', array(
    'text' => (isset($tags[1]) ? $tags[1] : t('previous')),
    'element' => $element,
    'interval' => 1,
    'parameters' => $parameters,
  ));
  $li_next = theme('pager_next', array(
    'text' => (isset($tags[3]) ? $tags[3] : t('next')),
    'element' => $element,
    'interval' => 1,
    'parameters' => $parameters,
  ));
  // @todo add theme setting for this.
  // $li_last = theme('pager_last', array(
  // 'text' => (isset($tags[4]) ? $tags[4] : t('last')),
  // 'element' => $element,
  // 'parameters' => $parameters,
  // ));
  if ($pager_total[$element] > 1) {
    // @todo add theme setting for this.
    // if ($li_first) {
    // $items[] = array(
    // 'class' => array('pager-first'),
    // 'data' => $li_first,
    // );
    // }
    if ($li_previous) {
      $items[] = array(
        'class' => array('prev'),
        'data' => $li_previous,
      );
    }
    // When there is more than one page, create the pager list.
    if ($i != $pager_max) {
      if ($i > 1) {
        $items[] = array(
          'class' => array('pager-ellipsis', 'disabled'),
          'data' => '<span>?</span>',
        );
      }
      // Now generate the actual pager piece.
      for (; $i <= $pager_last && $i <= $pager_max; $i++) {
        if ($i < $pager_current) {
          $items[] = array(
            // 'class' => array('pager-item'),
            'data' => theme('pager_previous', array(
              'text' => $i,
              'element' => $element,
              'interval' => ($pager_current - $i),
              'parameters' => $parameters,
            )),
          );
        }
        if ($i == $pager_current) {
          $items[] = array(
            // Add the active class.
            'class' => array('active'),
            'data' => l($i, '#', array('fragment' => '', 'external' => TRUE)),
          );
        }
        if ($i > $pager_current) {
          $items[] = array(
            'data' => theme('pager_next', array(
              'text' => $i,
              'element' => $element,
              'interval' => ($i - $pager_current),
              'parameters' => $parameters,
            )),
          );
        }
      }
      if ($i < $pager_max) {
        $items[] = array(
          'class' => array('pager-ellipsis', 'disabled'),
          'data' => '<span>?</span>',
        );
      }
    }
    // End generation.
    if ($li_next) {
      $items[] = array(
        'class' => array('next'),
        'data' => $li_next,
      );
    }
    // @todo add theme setting for this.
    // if ($li_last) {
    // $items[] = array(
    // 'class' => array('pager-last'),
    // 'data' => $li_last,
    // );
    // }
    return theme('item_list', array(
      'items' => $items,
      'attributes' => array('class' => array('pagination pull-right')),
    ));
  }
  return $output;
}

/**
 * Preprocess the general variables for a culturefeed page.
 */
 
function culturefeed_bootstrap_preprocess_culturefeed_page(&$variables) {

  $item = $variables['item'];
  if ($item instanceof CultureFeed_Cdb_Item_Page) {
    $page = $item;
  }
  else {
    $page = $item->getEntity();
  }


  $variables['title'] = check_plain($page->getName());
  $variables['id'] = $page->getId();
  $variables['description'] = check_markup($page->getDescription(), 'filtered_html');
  $variables['links'] = $page->getLinks();
  $variables['image'] = $page->getImage();

  $logged_in = $variables['logged_in'];

  // Add join link if user is logged in and not a member yet.
  if (!culturefeed_pages_is_user_member_of_page($page->getId()) && $page->getPermissions()->allowMembers && $logged_in) {
    $query = array('destination' => culturefeed_search_detail_path('page', $page->getId(), $page->getName()), '/');
    $variables['become_member_link'] = l(t('Become a member'), 'culturefeed/pages/join/nojs/' . $page->getId(), array('query' => $query, 'attributes' => array( 'class' => 'btn btn-primary btn-xs')));
  }

  // Address information
  $address = $page->getAddress();
  if (!empty($address)) {

    $variables['address'] = array();

    $variables['address']['street'] = '';
    if ($address->getStreet()) {
      $variables['address']['street'] = check_plain($address->getStreet() . ' ' . $address->getHouseNumber());
    }

    $variables['address']['city'] = check_plain($address->getCity());
    $variables['address']['zip'] = check_plain($address->getZip());

    $coordinates = $address->getGeoInformation();
    if ($coordinates) {
      $variables['coordinates'] = array(
        'lat' => $coordinates->getYCoordinate(),
        'lng' => $coordinates->getXCoordinate(),
      );
    }

  }

  // Contact information.
  $variables['contact'] = array();
  if ($page->getTelephone()) {
    $variables['contact']['tel'] = check_plain($page->getTelephone());
  }
  if ($page->getEmail()) {
    $variables['contact']['mail'] = check_plain($page->getEmail());
  }

}

/**
 * Creates form elements to add a page.
 */
function culturefeed_bootstrap_form_culturefeed_pages_add_form_alter(&$form, &$form_state) {


  unset($form['image']);
  unset($form['cover']);
  unset($form['tagline']);
  unset($form['street']);
  unset($form['zip']);
  unset($form['city']);
  unset($form['contactInfoTel']);
  unset($form['contactInfoEmail']);
  unset($form['linkWebsite']);
  unset($form['otherWebsites']);

  $query = drupal_get_query_parameters();
  $page_name = !empty($query['search']) ? $query['search'] : '';

  $form['categoryId'] = array(
    '#type' => 'select',
    '#title' => t('Type'),
    '#options' => culturefeed_search_get_actortype_categories(),
    '#default_value' => CULTUREFEED_ACTORTYPE_ORGANISATION,
    '#weight' => -5,
  );
   
  $form['name'] = array(
    '#type' => 'textfield',
    '#title' => t('Name'),
    '#default_value' => $page_name,
    '#weight' => -4,
  );

  $form['description'] = array(
    '#type' => 'textarea',
    '#title' => t('Description'),
    '#description' => '<p class="text-muted text-right" id="charlimitinfo">' . t('Maximum 400 characters') . '</p>',
    '#default_value' => '',
    '#maxlength' => 400,
    '#weight' => -3,
    '#attributes' => array('id' => array('limit-400')),
  );

  // Form alters can use weight -2 -> 0 here.

  $form['contact'] = array(
    '#type' => 'fieldset',
    '#title' => '<h3 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#edit-contact" class="bootstrap-collapse-processed"><i class="fa fa-caret-down"></i>' . ' ' . t('Contact') . '</a> <small class="text-muted">(' .  t('Optional') . ')</small></h3>',
    '#default_value' => '',
    '#weight' => 13,
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );

  $form['contact']['street'] = array(
    '#prefix' => '<div class="row"><div class="col-xs-12">',
    '#suffix' => '</div>',
    '#type' => 'textfield',
    '#title' => t('Street and number'),
    '#default_value' => '',
    '#weight' => 1,
  );

  $form['contact']['zip'] = array(
    '#prefix' => '<div class="col-xs-3">',
    '#suffix' => '</div>',
    '#type' => 'textfield',
    '#title' => t('Zipcode'),
    '#default_value' => '',
    '#weight' => 2,
  );

  $form['contact']['city'] = array(
    '#prefix' => '<div class="col-xs-9">',
    '#suffix' => '</div></div><hr />',
    '#type' => 'textfield',
    '#title' => t('City'),
    '#default_value' => '',
    '#weight' => 3,
  );

  // Form alters can use weight 5 -> 9 here.

  $form['contact']['contactInfoTel'] = array(
    '#type' => 'textfield',
    '#title' => '<span class="hidden">' . t('Phone number') . '</span>',
    '#default_value' => '',
    '#weight' => 10,
    '#field_prefix' => '<div class="input-group"> <span class="input-group-addon"><i title="' . t('Phone number') . '" class="fa fa-phone fa-fw"></i> </span>',
    '#field_suffix' => '</div>',
    '#attributes' => array('placeholder' => '+32473589641'),
  );

  $form['contact']['contactInfoEmail'] = array(
    '#type' => 'textfield',
    '#title' => '<span class="hidden">' . t('Email address') . '</span>',
    '#default_value' => '',
    '#weight' => 11,
    '#field_prefix' => '<div class="input-group"> <span class="input-group-addon"><i title="' . t('Email address') . '" class="fa fa-envelope fa-fw"></i> </span>',
    '#field_suffix' => '</div>',
    '#attributes' => array('placeholder' => 'jane.doe@outlook.com'),  
  );

  $form['contact']['linkWebsite'] = array(
    '#type' => 'textfield',
    '#title' => '<span class="hidden">' . t('Website') . '</span>',
    '#default_value' => '',
    '#weight' => 12,
    '#field_prefix' => '<div class="input-group"> <span class="input-group-addon"><i title="' . t('Website') . '" class="fa fa-globe fa-fw"></i> </span>',
    '#field_suffix' => '</div>',
    '#attributes' => array('placeholder' => 'www.mywebsite.com'),   
  );
    
  $form['contact']['linkTicketing'] = array(
    '#prefix' => '<button type="button" class="btn btn-default btn-small" data-toggle="collapse" data-target="#otherwebsites">' . t('Other websites') . '</button><div id="otherwebsites" class="collapse">',
    '#type' => 'textfield',
    '#title' => '<span class="hidden">' . t('Ticketing') . '</span>',
    '#default_value' => '',
    '#field_prefix' => '<div class="input-group"> <span class="input-group-addon"><i title="' . t('Ticketing') . '" class="fa fa-ticket fa-fw"></i> </span>',
    '#field_suffix' => '</div>',
    '#attributes' => array('placeholder' => 'www.sherpa.be'),
    '#weight' => 13,
  );

  $form['contact']['linkFacebook'] = array(
    '#type' => 'textfield',
    '#title' => '<span class="hidden">' . t('Facebook') . '</span>',
    '#default_value' => '',
    '#field_prefix' => '<div class="input-group"> <span class="input-group-addon"><i title="' . t('Facebook') . '" class="fa fa-facebook fa-fw"></i> </span>',
    '#field_suffix' => '</div>',
    '#attributes' => array('placeholder' => 'www.facebook.com/mypage'),
    '#weight' => 14,
    );

  $form['contact']['linkTwitter'] = array(
    '#type' => 'textfield',
    '#title' => '<span class="hidden">' . t('Twitter') . '</span>',
    '#default_value' => '',
    '#field_prefix' => '<div class="input-group"> <span class="input-group-addon"><i title="' . t('Twitter') . '" class="fa fa-twitter fa-fw"></i> </span>',
    '#field_suffix' => '</div>',
    '#attributes' => array('placeholder' => 'www.twitter.com/myfeed'),
    '#weight' => 15,
    );
    
  $form['contact']['linkGooglePlus'] = array(
    '#type' => 'textfield',
    '#title' => '<span class="hidden">' . t('Google+') . '</span>',
    '#default_value' => '',
    '#field_prefix' => '<div class="input-group"> <span class="input-group-addon"><i title="' . t('Google+') . '" class="fa fa-google-plus fa-fw"></i> </span>',
    '#field_suffix' => '</div>',
    '#attributes' => array('placeholder' => 'www.google.com/mypage'),
    '#weight' => 16,
    );
  
  $form['contact']['linkYouTube'] = array(
    '#type' => 'textfield',
    '#title' => '<span class="hidden">' . t('Youtube') . '</span>',
    '#default_value' => '',
    '#field_prefix' => '<div class="input-group"> <span class="input-group-addon"><i title="' . t('Youtube') . '" class="fa fa-youtube fa-fw"></i> </span>',
    '#field_suffix' => '</div>',
    '#attributes' => array('placeholder' => 'www.youtube.com/mychannel'),
    '#weight' => 17,
    );

  $form['contact']['linkBlog'] = array(
    '#suffix' => '</div>',
    '#type' => 'textfield',
    '#title' => '<span class="hidden">' . t('Blog') . '</span>',
    '#default_value' => '',
    '#field_prefix' => '<div class="input-group"> <span class="input-group-addon"><i title="' . t('Blog') . '" class="fa fa-stack-exchange fa-fw"></i> </span>',
    '#field_suffix' => '</div>',
    '#attributes' => array('placeholder' => 'www.blogger.com/myblog'),
    '#weight' => 18,
    );

  $form['customizeLayout'] = array(
    '#type' => 'fieldset',
    '#title' => '<h3 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#edit-customizelayout" class="bootstrap-collapse-processed"><i class="fa fa-caret-down"></i>' . ' ' . t('Page layout') . '</a> <small class="text-muted">(' .  t('Optional') . ')</small></h3>',
    '#default_value' => '',
    '#weight' => 20,
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );

  $form['customizeLayout']['image'] = array(
    '#type' => 'managed_file',
    '#title' => t('Image or Logo'),
    '#description' => t('Allowed extensions: jpg, jpeg, gif or png'),
    '#size' => 26,
    '#default_value' => '',
    '#weight' => 21,
    '#process' => array('file_managed_file_process', 'culturefeed_image_file_process'),
    '#upload_validators' => array(
      'file_validate_extensions' => array('jpg jpeg png gif'),
    ),
    '#upload_location' => 'public://pages',
  );
  
  $form['customizeLayout']['tagline'] = array(
    '#type' => 'textfield',
    '#title' => t('Baseline'),
    '#default_value' => '',
    '#weight' => 22,
  );
  
  $form['customizeLayout']['cover'] = array(
    '#type' => 'managed_file',
    '#title' => t('Cover Photo'),
    '#description' => t('Allowed extensions: jpg, jpeg, gif or png'),
    '#size' => 26,
    '#default_value' => '',
    '#weight' => 23,
    '#process' => array('file_managed_file_process', 'culturefeed_image_file_process'),
    '#upload_validators' => array(
      'file_validate_extensions' => array('jpg jpeg png gif'),
    ),
    '#upload_location' => 'public://pages',
  );
  
  $form['visible'] = array(
    '#type' => 'hidden',
    '#value' => "true",
  );

  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Save Page'),
    '#weight' => 999,
  );

  $form['#validate'] = array(
    'culturefeed_pages_add_arguments_prepare',
    'culturefeed_pages_add_request_send'
  );

  $form['#submit'] = array(
    'culturefeed_pages_add_form_submit'
  );

  return $form;

}

/**
 * Form to edit a page.
 * @param array $form
 * @param array $form_state
 */
function culturefeed_bootstrap_form_culturefeed_pages_edit_page_form_alter(&$form, &$form_state) {

  $page = $form_state['page'];

  // Hidden page ID.
  $form['pageId'] = array(
    '#type' => 'hidden',
    '#value' => $page->getId(),
    '#weight' => 1,
  );

 // Link to the detail page.
  $form['detail_link'] = array(
    '#type' => 'markup',
    '#prefix' => '<p class="text-right"><small><i class="fa fa-eye"></i> ',
    '#suffix' => '</small></p>',
    '#markup' => culturefeed_search_detail_l("page", $page->getId(), $page->getName(), t('View page'), array('attributes' => array('class' => array('view-link')))),
    '#weight' => -999,
  );  
  
  unset($form['categoryId']);
  unset($form['image']);
  unset($form['cover']);
  unset($form['tagline']);
  unset($form['street']);
  unset($form['zip']);
  unset($form['city']);
  unset($form['contactInfoTel']);
  unset($form['contactInfoEmail']);
  unset($form['linkWebsite']);
  unset($form['otherWebsites']);
  
  $form['name']['#default_value'] = $page->getName();
  $form['name']['#weight'] = 1;
  $form['description']['#default_value'] = $page->getDescription();
  $form['description']['#weight'] = 2;

  $address = $page->getAddress();
  $links = $page->getLinks();
  
  $form['contact'] = array(
    '#type' => 'fieldset',
    '#title' => '<h3 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#edit-contact" class="bootstrap-collapse-processed"><i class="fa fa-caret-down"></i>' . ' ' . t('Contact') . '</a> <small class="text-muted">(' .  t('Optional') . ')</small></h3>',
    '#default_value' => '',
    '#weight' => 10,
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  
  // Address.

  $form['contact']['street'] = array(
    '#prefix' => '<div class="row"><div class="col-xs-12">',
    '#suffix' => '</div>',
    '#type' => 'textfield',
    '#title' => t('Street and number'),
    '#default_value' => $address->getStreet(),
    '#weight' => 11,
  );

  $form['contact']['zip'] = array(
    '#prefix' => '<div class="col-xs-3">',
    '#suffix' => '</div>',
    '#type' => 'textfield',
    '#title' => t('Zipcode'),
    '#default_value' => $address->getZip(),
    '#weight' => 12,
  );

  $form['contact']['city'] = array(
    '#prefix' => '<div class="col-xs-9">',
    '#suffix' => '</div></div><hr />',
    '#type' => 'textfield',
    '#title' => t('City'),
    '#default_value' => $address->getCity(),
    '#weight' => 13,
  );

  // Contact information.
  
  $form['contact']['contactInfoTel'] = array(
    '#type' => 'textfield',
    '#title' => '<span class="hidden">' . t('Phone number') . '</span>',
    '#default_value' => $page->getTelephone(),
    '#weight' => 14,
    '#field_prefix' => '<div class="input-group"> <span class="input-group-addon"><i title="' . t('Phone number') . '" class="fa fa-phone fa-fw"></i> </span>',
    '#field_suffix' => '</div>',
    '#attributes' => array('placeholder' => '+32473589641'),
  );

  $form['contact']['contactInfoEmail'] = array(
    '#type' => 'textfield',
    '#title' => '<span class="hidden">' . t('Email address') . '</span>',
    '#default_value' => $page->getEmail(),
    '#weight' => 15,
    '#field_prefix' => '<div class="input-group"> <span class="input-group-addon"><i title="' . t('Email address') . '" class="fa fa-envelope fa-fw"></i> </span>',
    '#field_suffix' => '</div>',
    '#attributes' => array('placeholder' => 'jane.doe@outlook.com'),  
  );
  
  $form['contact']['linkWebsite'] = array(
    '#type' => 'textfield',
    '#title' => '<span class="hidden">' . t('Website') . '</span>',
    '#default_value' => isset($links['linkWebsite']) ? $links['linkWebsite'] : '',
    '#weight' => 16,
    '#field_prefix' => '<div class="input-group"> <span class="input-group-addon"><i title="' . t('Website') . '" class="fa fa-globe fa-fw"></i> </span>',
    '#field_suffix' => '</div>',
    '#attributes' => array('placeholder' => 'www.mywebsite.com'),   
  );
 
  // Websites list.
 
    $form['contact']['linkTicketing'] = array(
    '#prefix' => '<button type="button" class="btn btn-default btn-small" data-toggle="collapse" data-target="#otherwebsites">' . t('Other websites') . '</button><div id="otherwebsites" class="collapse">',
    '#type' => 'textfield',
    '#title' => '<span class="hidden">' . t('Ticketing') . '</span>',
    '#default_value' => isset($links['linkTicketing']) ? $links['linkTicketing'] : '',
    '#field_prefix' => '<div class="input-group"> <span class="input-group-addon"><i title="' . t('Ticketing') . '" class="fa fa-ticket fa-fw"></i> </span>',
    '#field_suffix' => '</div>',
    '#attributes' => array('placeholder' => 'www.sherpa.be'),
    '#weight' => 17,
  );

  $form['contact']['linkFacebook'] = array(
    '#type' => 'textfield',
    '#title' => '<span class="hidden">' . t('Facebook') . '</span>',
    '#default_value' => isset($links['linkFacebook']) ? $links['linkFacebook'] : '',
    '#field_prefix' => '<div class="input-group"> <span class="input-group-addon"><i title="' . t('Facebook') . '" class="fa fa-facebook fa-fw"></i> </span>',
    '#field_suffix' => '</div>',
    '#attributes' => array('placeholder' => 'www.facebook.com/mypage'),
    '#weight' => 18,
    );

  $form['contact']['linkTwitter'] = array(
    '#type' => 'textfield',
    '#title' => '<span class="hidden">' . t('Twitter') . '</span>',
    '#default_value' => isset($links['linkTwitter']) ? $links['linkTwitter'] : '',
    '#field_prefix' => '<div class="input-group"> <span class="input-group-addon"><i title="' . t('Twitter') . '" class="fa fa-twitter fa-fw"></i> </span>',
    '#field_suffix' => '</div>',
    '#attributes' => array('placeholder' => 'www.twitter.com/myfeed'),
    '#weight' => 19,
    );
    
  $form['contact']['linkGooglePlus'] = array(
    '#type' => 'textfield',
    '#title' => '<span class="hidden">' . t('Google+') . '</span>',
    '#default_value' => isset($links['linkGooglePlus']) ? $links['linkGooglePlus'] : '',
    '#field_prefix' => '<div class="input-group"> <span class="input-group-addon"><i title="' . t('Google+') . '" class="fa fa-google-plus fa-fw"></i> </span>',
    '#field_suffix' => '</div>',
    '#attributes' => array('placeholder' => 'www.google.com/mypage'),
    '#weight' => 20,
    );
  
  $form['contact']['linkYouTube'] = array(
    '#type' => 'textfield',
    '#title' => '<span class="hidden">' . t('Youtube') . '</span>',
    '#default_value' => isset($links['linkYouTube']) ? $links['linkYouTube'] : '',
    '#field_prefix' => '<div class="input-group"> <span class="input-group-addon"><i title="' . t('Youtube') . '" class="fa fa-youtube fa-fw"></i> </span>',
    '#field_suffix' => '</div>',
    '#attributes' => array('placeholder' => 'www.youtube.com/mychannel'),
    '#weight' => 21,
    );

  $form['contact']['linkBlog'] = array(
    '#suffix' => '</div>',
    '#type' => 'textfield',
    '#title' => '<span class="hidden">' . t('Blog') . '</span>',
    '#default_value' => isset($links['linkBlog']) ? $links['linkBlog'] : '',
    '#field_prefix' => '<div class="input-group"> <span class="input-group-addon"><i title="' . t('Blog') . '" class="fa fa-stack-exchange fa-fw"></i> </span>',
    '#field_suffix' => '</div>',
    '#attributes' => array('placeholder' => 'www.blogger.com/myblog'),
    '#weight' => 22,
    );
  
  $form['customizeLayout'] = array(
    '#type' => 'fieldset',
    '#title' => '<h3 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#edit-customizelayout" class="bootstrap-collapse-processed"><i class="fa fa-caret-down"></i>' . ' ' . t('Page layout') . '</a> <small class="text-muted">(' .  t('Optional') . ')</small></h3>',
    '#default_value' => '',
    '#weight' => 20,
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  
  // The image.
  $image = $page->getImage();
  $form_state['#old_image'] = 0;
  
  
  $form['customizeLayout']['image'] = array(
    '#type' => 'managed_file',
    '#title' => t('Image or Logo'),
    '#description' => t('Allowed extensions: jpg, jpeg, gif or png'),
    '#size' => 26,
    '#weight' => 21,
    '#process' => array('file_managed_file_process', 'culturefeed_image_file_process'),
    '#upload_validators' => array(
      'file_validate_extensions' => array('jpg jpeg png gif'),
    ),
    '#upload_location' => 'public://pages',
  );
  
  if (!empty($image)) {

    // Create temp file to preview the external image.
    $file = culturefeed_create_temporary_image($image, file_default_scheme() . '://pages');
    if ($file) {
      $form_state['#old_image'] = $file->fid;
      $form['customizeLayout']['image']['#default_value'] = $file->fid;
    }

    $form['customizeLayout']['image']['#title'] = t('Select another Image or Logo');

  }
    
  // The cover.
  $cover = $page->getCover();
  $form_state['#old_cover'] = 0;
  
  $form['customizeLayout']['cover'] = array(
    '#type' => 'managed_file',
    '#title' => t('Cover Photo'),
    '#description' => t('Allowed extensions: jpg, jpeg, gif or png'),
    '#size' => 26,
    '#weight' => 23,
    '#process' => array('file_managed_file_process', 'culturefeed_image_file_process'),
    '#upload_validators' => array(
      'file_validate_extensions' => array('jpg jpeg png gif'),
    ),
    '#upload_location' => 'public://pages',
  );
  
  if (!empty($cover)) {
    
    // Creat temp file to preview the external cover.
    $file_cover = culturefeed_create_temporary_image($cover, file_default_scheme() . '://pages');
    if ($file_cover) {
      $form_state['customizeLayout']['#old_cover'] = $file_cover->fid;
      $form['customizeLayout']['cover']['#default_value'] = $file_cover->fid;
    }

    $form['customizeLayout']['cover']['#title'] = t('Select another Cover Photo');
  }
  
  // Tagline
  $tagline = $page->getTagline();
  
  $form['customizeLayout']['tagline'] = array(
    '#type' => 'textfield',
    '#title' => t('Baseline'),
    '#default_value' => '',
    '#weight' => 22,
  );
  
  if (!empty($tagline)) {
    $form['customizeLayout']['tagline']['#default_value'] = isset($tagline) ? $tagline : '';
  }

  $form['#validate'] = array(
    'culturefeed_pages_add_arguments_prepare',
    'culturefeed_pages_edit_request_send',
  );

  $form['#submit'] = array(
    'culturefeed_pages_add_form_submit'
  );

  $form['submit']['#value'] = t('Update Page');

}

/**
 * Form callback to render a page to configure a page.
 * E.g. delete a page.
 * @param array $form
 * @param array $form_state
 */
function culturefeed_bootstrap_form_culturefeed_pages_configuration_page_form_alter(&$form, &$form_state){

  $page =  $form_state['page'];

  // Link to the detail page.
  $form['detail_link'] = array(
    '#prefix' => '<p class="text-right"><small><i class="fa fa-eye"></i> ',
    '#suffix' => '</small></p>',
    '#type' => 'markup',
    '#markup' => culturefeed_search_detail_l("page", $page->getId(), $page->getName(), t('View page'), array('attributes' => array('class' => array('view-link')))),
    '#weight' => -25,
  );

  // General information.
  $form['basic'] = array(
    '#type' => 'markup',
    '#markup' => '<h2>' . t('Features') . '</h2>',
    '#weight' => -20,
  );

  // Hidden page ID.
  $form['pageId'] = array(
    '#type' => 'hidden',
    '#value' => $page->getId(),
  );

  $permissions = $page->getPermissions();

  $form['allow_followers'] = array(
    '#type' => 'checkbox',
    '#title' => t('Allow users to follow my page'),
    '#description' => '<span class="text-muted">' . t('Followers receive a notification when your page is updated, so that they stay informed of new activities, threads, ...') . '</span>',
    '#default_value' => !empty($permissions->allowFollowers),
  );

  $form['allow_members'] = array(
    '#type' => 'checkbox',
    '#title' => t('Allow users to request membership'),
    '#description' => '<span class="text-muted">' . t('Members can, depending on the roles or rights, collaborate to maintain and update your page. Furthermore, page memberships are added to user profiles and can be used as an alias to add comments.') . '</span>',
    '#default_value' => !empty($permissions->allowMembers),
  );

  $form['allow_comments'] = array(
    '#type' => 'checkbox',
    '#title' => t('Allow users to add comments to my activities'),
    '#description' => '<span class="text-muted">' . t('Only available for organizations who added their activities via <a href="http://www.uitdatabank.be" target="_blank">www.uitdatabank.be</a>.') . '</span>',
    '#default_value' => !empty($permissions->allowComments),
  );

  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Update'),
  );
  
  unset($form['remove-link']);

  $form['#suffix'] = '
    <div id="page_confirm" class="modal hide fade" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-body outer"></div>
    </div>';

  culturefeed_pages_set_page_breadcrumb($page);

  return $form;

}

/**
 * Show the administration menu for the current page.
 */
 
function culturefeed_bootstrap_block_view_alter(&$data, $block) {

  switch ($block->delta) {
    case 'pages-admin-menu':
      $page = menu_get_object('culturefeed_pages_page', 1);
      $data['subject'] = '<div class="btn-group pull-right"><button class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cogs fa-fw fa-lg"></i>' . ' ' . t('Manage page') . ' ' . '<span class="caret"></span></button>'.  $data['content'] . '</div><div class="clearfix"></div><hr />'; 
      break;
    case 'page-agenda':
      unset($data['subject']);
      break;
    case 'page-timeline':
      $data['subject'] = '<ul class="nav nav-tabs"><li><a href="#block-culturefeed-pages-page-agenda"><h4>' . t('Activities') . '</h4></a></li><li class="active"><a href="#"><h4>' . t('Timeline') .'</h4></a></li></ul>';
      break;
  }
}

/**
 * Show the manage members page for 1 culturefeed page.
 */
function culturefeed_bootstrap_culturefeed_pages_page_manage_members(&$variables) {

  try {

    $cf_pages = DrupalCultureFeed::getLoggedInUserInstance()->pages();
    $user_list = $cf_pages->getUserList($page->getId(),  array(CultureFeed_Pages_Membership::MEMBERSHIP_ROLE_ADMIN, CultureFeed_Pages_Membership::MEMBERSHIP_ROLE_MEMBER));

    $list = culturefeed_pages_manage_members_list($page, $user_list, $cf_user);

  }
  catch (Exception $e) {
    watchdog_exception('culturefeed_pages', $e);
  }

  if ($request_type == 'ajax') {

    $build = array('page' => $list);
    $commands = array(
      ajax_command_html('#manage-members', render($build)),
    );

    ajax_deliver(array('#type' => 'ajax', '#commands' => $commands));
    return;

  }

  // Non-ajax pages should have more data.
  $build['view_page'] = array(
    '#markup' => '<div id="view-page">' . culturefeed_search_detail_l('page', $page->getId(), $page->getName(), t('View page 123')) . '</div>'
  );
  $build['page'] = $list;
  $build['search_form'] = drupal_get_form('culturefeed_pages_search_user_form');

  if (isset($_GET['search'])) {
    if (strlen($_GET['search']) >= 3) {
      $build['search_result'] = culturefeed_pages_user_search_result($_GET['search'], $page, $user_list);
    }
    else {
      drupal_set_message(t('Please enter at least 3 characters'), 'error');
    }
  }

  culturefeed_pages_set_page_breadcrumb($page);

  return $build;

}


/**
 * Preprocess the search results on a user.
 * @see culturefeed-pages-user-search-result.tpl.php
 */
function culturefeed_bootstrap_preprocess_culturefeed_pages_user_search_result(&$variables) {

  $variables['total'] = $variables['result']->total;
  $accounts = culturefeed_get_uids_for_users($variables['result']->objects);

  $members = array();
  foreach ($variables['user_list']->memberships as $membership) {
    $members[] = $membership->user->id;
  }

  $add_options = array(
    'attributes' => array(
      'role' => 'button',
      'data-toggle' => 'modal',
      'data-target' => '#page_confirm',
    ),
    'query' => drupal_get_query_parameters(),
  );

  $variables['results'] = array();
  foreach ($variables['result']->objects as $object) {

    if (!isset($accounts[$object->id])) {
      continue;
    }

    $result = array();
    $result['nick'] = check_plain($object->nick);
    $result['profile_link'] = l(t('View profile'), 'user/' . $accounts[$object->id]);
    $result['profile_url'] =  url('user/' . $accounts[$object->id]); 
    $add_options['attributes']['data-remote'] = url('pages/' . $variables['page']->getId() . '/membership/add/' . $object->id . '/ajax', array('query' => $add_options['query']));
    $result['add_link'] = in_array($object->id, $members) ? '<small class="text-muted">' . t('Member of') . ' ' . $variables['page']->getName() . '</small>' : '<a class="btn btn-default btn-xs" href="' . url('pages/' . $variables['page']->getId() . '/membership/add/' . $object->id . '/nojs', $add_options) . '"><i class="fa fa-user fa-fw"></i>' . ' ' . t('Add as member') . '</a>';
    $variables['results'][] = $result;

  }

}

/**
 * Form callback for the search user form.
 */
function culturefeed_bootstrap_form_culturefeed_pages_search_user_form_alter(&$form, &$form_state) {

  $form['#prefix'] = '<hr /><div class="row"><div class="col-xs-12">';
  $form['#suffix'] = '</div></div>';
  $form['#attributes'] = array('class' => 'well');

  
  $form['title'] = array(
    '#markup' => '<p class="lead"><i class="fa fa-group"></i>  ' . t('Add new members') . '</p>',
    '#weight' => -999,
  );

  $form['search'] = array(
    '#title' => '<span class="sr-only">' . 'Keyword' . '</span>',
    '#type' => 'textfield',
    '#default_value' => isset($_GET['search']) ? $_GET['search'] : '',
    '#attributes' => array('placeholder' => 'Keyword'),
  );

  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Search User'),
  );

}

/**
 * Theme the message shown when a user can not delete his membership.
 */
function culturefeed_bootstrap_culturefeed_pages_membership_delete_not_possible($variables) {

  $output = '<p class="text-muted">';
  $output .= t('Not possible to remove');
  $output .= ' <span href="#" data-toggle="tooltip" data-placement="top" title data-original-title="' . t('You\'re the only administrator of this page. You can not remove yourself as a member') . '">';
  $output .= '<i class="fa fa-info-circle"></i>';
  $output .= '</span></p>';

  return $output;
}

