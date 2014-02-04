<?php

/**
* Implements hook_page_alter().
*/
function culturefeed_bootstrap_page_alter(&$page) {
  // Add Google Tag Manager
  $container_id = 'GTM-WPZSG2';

  $snippet = '<!-- Google Tag Manager -->';
  $snippet .= '<noscript><iframe src="//www.googletagmanager.com/ns.html?id=' . $container_id . '"';
  $snippet .= 'height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>';
  $snippet .= '<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({\'gtm.start\':';
  $snippet .= 'new Date().getTime(),event:\'gtm.js\'});var f=d.getElementsByTagName(s)[0],';
  $snippet .= 'j=d.createElement(s),dl=l!=\'dataLayer\'?\'&l=\'+l:\'\';j.async=true;j.src=';
  $snippet .= '\'//www.googletagmanager.com/gtm.js?id=\'+i+dl;f.parentNode.insertBefore(j,f);';
  $snippet .= '})(window,document,\'script\',\'dataLayer\',\'' . $container_id . '\');</script>';
  $snippet .= '<!-- End Google Tag Manager -->';

  $page['page_top']['google_tag_manager'] = array(
    '#markup' => $snippet,
  );
}

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
  $form['#prefix'] = '<div class="container"><div class="row well">';
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
  $form['search']['#suffix'] = '</div>';
  $form['submit']['#prefix'] = '<div class="col-sm-2">';
  $form['submit']['#attributes']['class'][] = 'btn-block';
  $form['submit']['#weight'] = '3';
  $form['submit']['#suffix'] = '</div>';
  $form['nearby']['#weight'] = '3';
  $form['nearby']['#prefix'] = '<div class="visible-xs visible-sm"><div class="col-sm-10 col-sm-offset-2">';
  $form['nearby']['#suffix'] = '</div></div>';
  $form['search']['#autocomplete_path'] = '';
  $form['#suffix'] = '</div></div>';
}

/**
 * Implements hook_{culturefeed_search_ui_search_sortorder_form}_alter().
 */
function culturefeed_bootstrap_form_culturefeed_search_ui_search_sortorder_form_alter(&$form, &$form_state) {
  $form['#prefix'] = '<div class="pull-right">';
  $form['#suffix'] = '</div>';
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
 * Implements hook_preprocess_culturefeed_agenda_detail().
 */
function _culturefeed_bootstrap_preprocess_culturefeed_agenda_detail(&$variables) {

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
  if (isset($variables['tickets'])) {
    $variables['tickets'] = implode(', ', $variables['tickets']);
  }

  // Ticket buttons.
  if (isset($variables['ticket_buttons'])) {
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