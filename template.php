<?php

/**
 * Load FontAwesome 4.4.0 through CDN
 */

$element = array(
  '#tag' => 'link',
  '#attributes' => array(
    'href' => '//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css',
    'rel' => 'stylesheet',
    'type' => 'text/css',
  ),
);

drupal_add_html_head($element, 'font-awesome');

/**
 * Implements hook_{culturefeed_agenda_search_block_form}_alter().
 */
function culturefeed_bootstrap_form_culturefeed_agenda_search_block_form_alter(&$form, &$form_state) {

  // Calculate width for input elements.
  $space_free = 10;
  if (isset($form['when'])) {

    $when_width = 2;
    $space_free -= 2;
    if (isset($form['category'])) {
      $category_width = 2;
      $space_free -= 2;
    }

  }
  elseif (isset($form['category'])) {
    $category_width = 3;
    $space_free -= 3;
  }

  if (isset($form['location']) && isset($form['search'])) {
    $where_width = $search_width = $space_free / 2;
    // If width was a double, correct it.
    if ($space_free % 2) {
      $where_width -= 0.5;
      $search_width += 0.5;
    }
  }
  elseif (isset($form['location'])) {
    $where_width = $space_free;
  }
  elseif (isset($form['search'])) {
    $search_width = $space_free;
  }

  $form['title'] = array(
    '#prefix' => '<div class="row">',
    '#type' => 'item',
    '#markup' => '',
    '#suffix' => '',
    '#weight' => -200,
  );

  if (isset($form['when'])) {
    $form['when']['#prefix'] = '<div class="col-sm-' . $when_width . '">';
    $form['when']['#suffix'] = '</div>';
  }

  if (isset($form['category'])) {
    $form['category']['#prefix'] = '<div class="col-sm-' . $category_width .'">';
    $form['category']['#suffix'] = '</div>';
  }

  if (isset($form['search'])) {
    $form['search']['#prefix'] = '<div class="col-sm-' . $search_width .'">';
    $form['search']['#suffix'] = '</div>';
  }

  if (isset($form['location'])) {
    $form['location']['#prefix'] = '<div class="col-sm-' . $where_width .'">';
    $form['location']['#suffix'] = '</div>';
    $form['location']['nearby']['#prefix'] = '<div class="clearfix">';
    $form['location']['nearby']['#suffix'] = '</div>';
  }

  // Style button.
  $form['submit']['#attributes']['class'][] = 'btn-primary btn-block';
  $form['submit']['#prefix'] = '<div class="col-sm-2">';
  $form['submit']['#suffix'] = '</div>';

}

/**
 * Implements hook_{culturefeed_search_ui_search_block_form}_alter().
 */
function culturefeed_bootstrap_form_culturefeed_search_ui_search_block_form_alter(&$form, &$form_state) {
  $form['#prefix'] = '<div class="row">';
  $form['title'] = array(
    '#prefix' => '<div class="col-sm-2 hidden-xs">',
    '#type' => 'item',
    '#markup' => '<p class="lead"><i class="fa fa-search"></i>  ' . t('Search') . '</p>',
    '#suffix' => '</div>',
  );
  $form['type']['#prefix'] = '<div class="col-sm-3 hidden-xs">';
  $form['type']['#weight'] = '1';
  $form['type']['#title'] = '';
  $form['type']['#suffix'] = '</div>';
  $form['search']['#prefix'] = '<div class="col-sm-5 col-xs-8">';
  $form['search']['#weight'] = '2';
  $form['search']['#title'] = '';
  $form['search']['#autocomplete_path'] = '';
  $form['search']['#suffix'] = '</div>';
  $form['submit']['#prefix'] = '<div class="col-sm-2 col-xs-4">';
  $form['submit']['#attributes']['class'][] = 'btn-block';
  $form['submit']['#weight'] = '3';
  $form['submit']['#suffix'] = '</div>';
  $form['#suffix'] = '</div>';
}

/**
 * Implements hook_{culturefeed_search_ui_search_sortorder_form}_alter().
 */
function culturefeed_bootstrap_form_culturefeed_search_ui_search_sortorder_form_alter(&$form, &$form_state) {
  $form['#prefix'] = '<div class="pull-right text-right hidden-xs">';
  $form['title'] = array(
    '#type' => 'item',
    '#markup' => '<a data-toggle="collapse" href="#sort-results">' . t('Sort') . ' <span class="caret"></span></a>',
  );
  $form['sort']['#prefix'] = '<div id="sort-results" class="collapse collapse-in">';
  $form['sort']['#weight'] = '2';
  $form['sort']['#title'] = '';
  $form['sort']['#suffix'] = '</div>';
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
    $calsum = str_replace('om', '<span class="text-muted">|</span>', $calsum);
    $calsum = str_replace(',', '', $calsum);
    // Remove first break
    if (strpos($calsum, '<br />') == 0) {
      $calsum = substr($calsum, 6);;
    }
  }
  return $calsum;

}

/**
 * Helper preprocess function for the general agenda item variables.
 */
function _culturefeed_bootstrap_preprocess_culturefeed_agenda(&$variables) {

  $item = $variables['item'];
  $entity = $item->getEntity();

  if (culturefeed_agenda_social_links_preprocessing_enabled() && module_exists('culturefeed_social') && !culturefeed_is_culturefeed_user()) {
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

  $rel = url('culturefeed/do/' . CultureFeed_Activity::TYPE_PRINT . '/' . $item->getType() . '/' . $item->getId() . '/ajax');
  $variables['print_link'] = l(t('Print'), '', array('attributes' => array('rel' => $rel, 'class' => array('share-link', 'print-link')), 'external' => TRUE));

}

/**
 * Implements hook_preprocess_culturefeed_agenda_detail().
 */
function _culturefeed_bootstrap_preprocess_culturefeed_agenda_detail(&$variables) {
  _culturefeed_bootstrap_preprocess_culturefeed_agenda($variables);

  $item = $variables['item'];

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
      $ticket_button[] = l($button['text'], $button['link'], array('attributes' => array('class' => 'btn btn-primary reservation-link', 'id' => 'cf-ticket'), 'html' => TRUE));
    }
    $variables['ticket_buttons'] = implode(' ', $ticket_button);
  }

  $variables['readmore_options'] = array();
  $variables['readmore_options']['attributes']['fragment'] = 'cf-longdescription';
  $variables['readmore_options']['attributes']['external'] = TRUE;

  // Add options for the readmore link to send an activity to the profile.
  if (culturefeed_is_culturefeed_user()) {
    $content_type = culturefeed_get_content_type($item->getType());
    $id = $item->getId();
    $variables['readmore_options']['attributes']['rel'] = url('culturefeed/do/' . CultureFeed_Activity::TYPE_MORE_INFO .'/' . $content_type . '/' . urlencode($id) . '/ajax');
    $variables['readmore_options']['attributes']['class'] = array('moreinfo-link');
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
 * Implements hook_preprocess_culturefeed_actor().
 */
function culturefeed_bootstrap_preprocess_culturefeed_actor(&$variables) {
  _culturefeed_bootstrap_preprocess_culturefeed_agenda_detail($variables);
}

/**
 * Implements hook_form_culturefeed_ui_privacy_settings_form_alter().
 *
 * @param array $form
 *   The form.
 * @param array $form_state
 *   The form state.
 */
function culturefeed_bootstrap_form_culturefeed_ui_privacy_settings_form_alter(&$form, &$form_state) {

  if (isset($form['#attached']['js'][0])) {
    $form['#attached']['js'][0] = drupal_get_path('theme', 'culturefeed_bootstrap') . '/js/privacy_tooltip.js';
  }
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
 * Theme the profile box item for calendar..
 */
function culturefeed_bootstrap_culturefeed_calendar_profile_box_item($variables) {

  $icon = '<i class="fa fa-lg fa-calendar"></i>';
  $icon_new = '<i class="fa fa-lg fa-calendar-o"></i>';
  $url = 'culturefeed/calendar';
  $authenticated = DrupalCultureFeed::isCultureFeedUser();

  if ($authenticated) {
    return l($icon, $url, array('html' => TRUE));
  }
  // Show default with 0 for anonymous. JS sets the correct value.
  else {
    $hover = theme('culturefeed_calendar_button_hover');
    $popover_options = array(
      'class' => '',
      'data-toggle' => 'popover',
      'data-content' => $hover,
      'data-placement' => 'bottom',
      'data-html' => 'true'
    );
    return l($icon_new . ' ' . '<small class="activity-count"><span class="unread-activities label label-danger">0</span></small>', $url, array('attributes' => $popover_options, 'html' => TRUE));
  }
}

/**
 * Form callback for the basic search form.
 */

function culturefeed_bootstrap_form_culturefeed_pages_basic_search_form_alter(&$form, &$form_state) {

  $form['zipcode'] = array(
    '#prefix' => '<div class="row"><div class="col-sm-2">',
    '#suffix' => '</div>',
    '#type' => 'textfield',
    '#default_value' => isset($_GET['zipcode']) ? $_GET['zipcode'] : '',
  );

  $form['page'] = array(
    '#prefix' => '<div class="col-sm-7">',
    '#suffix' => '</div>',
    '#type' => 'textfield',
    '#attributes' => array('placeholder' => array(t('Keyword'))),
    '#autocomplete_path' => 'ajax/culturefeed/pages/page-suggestion',
    '#default_value' => isset($_GET['search']) ? $_GET['search'] : '',
  );

  $form['submit'] = array(
    '#prefix' => '<div class="col-sm-3 form-group">',
    '#suffix' => '</div></div>',
    '#attributes' => array('class' => array('btn-block')),
    '#type' => 'submit',
    '#value' => t('Search'),
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
    $variables['total_results_message'] = '<div class="row"><div class="col-xs-12"><p class="text-muted">' . t("<strong>@total pages</strong> found for <em>@zipcode @search @keyword</em>", array('@total' => $variables['total_results'], '@zipcode' => $variables['zipcode'], '@search' => $variables['search'], '@keyword' => $variables['keyword'], 'html' => TRUE)) . '</p></div></div>';
  }
  else {
    $variables['total_results_message'] =  '<div class="row"><div class="col-xs-12"><p class="text-muted">' .t("<strong>0 pages</strong> found for <em>@zipcode @search @keyword</em>", array('@zipcode' => $variables['zipcode'], '@search' => $variables['search'], '@keyword' => $variables['keyword'], 'html' => TRUE)) . '</p></div></div>';
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

  return '<div class="cf-result-count result-count-bottom text-muted pull-left">' . $pager_summary . '</div>';

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
  $li_first = theme('pager_first', array(
   'text' => (isset($tags[0]) ? $tags[0] : t('first')),
   'element' => $element,
   'parameters' => $parameters,
  ));
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
  $li_last = theme('pager_last', array(
   'text' => (isset($tags[4]) ? $tags[4] : t('last')),
   'element' => $element,
   'parameters' => $parameters,
  ));
  if ($pager_total[$element] > 1) {
    // @todo add theme setting for this.
    if ($li_first) {
      $items[] = array(
        'class' => array('pager-first'),
        'data' => $li_first,
      );
    }
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
          'data' => '<span>…</span>',
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
          'data' => '<span>…</span>',
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
    if ($li_last) {
      $items[] = array(
        'class' => array('pager-last'),
        'data' => $li_last,
      );
    }
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
  if (!culturefeed_pages_is_user_member_of_page($page->getId()) && $page->getPermissions()->allowMembers) {
    $query = array('destination' => culturefeed_search_detail_path('page', $page->getId(), $page->getName()), '/');
    if ($logged_in) {
      $variables['become_member_link'] = l(t('Become a member'), 'culturefeed/pages/join/nojs/' . $page->getId(), array('query' => $query, 'attributes' => array( 'class' => 'btn btn-default btn-xs')));
    }
    else {
      $variables['become_member_link'] = l(t('Become a member'), 'authenticated', array('query' => $query, 'attributes' => array( 'class' => 'btn btn-default btn-xs')));
    }
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
    '#title' => '<h3 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#edit-contact" class="bootstrap-collapse-processed"><i class="fa fa-caret-down"></i>' . ' ' . t('Contact') . '</a></h3>',
    '#default_value' => '',
    '#weight' => 13,
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
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
    '#suffix' => '</div></div>',
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
    '#description' => t('Allowed extensions: jpg, jpeg, gif or png') . ' (max. ' . format_size(CULTUREFEED_IMAGES_MAX_SIZE) . ')',
    '#size' => 26,
    '#default_value' => '',
    '#weight' => 21,
    '#process' => array('file_managed_file_process', 'culturefeed_image_file_process'),
    '#upload_validators' => array(
      'file_validate_extensions' => array('jpg jpeg png gif'),
      'file_validate_size' => array(CULTUREFEED_IMAGES_MAX_SIZE),
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
    '#description' => t('Allowed extensions: jpg, jpeg, gif or png') . ' (max. ' . format_size(CULTUREFEED_IMAGES_MAX_SIZE) . ')',
    '#size' => 26,
    '#default_value' => '',
    '#weight' => 23,
    '#process' => array('file_managed_file_process', 'culturefeed_image_file_process'),
    '#upload_validators' => array(
      'file_validate_extensions' => array('jpg jpeg png gif'),
      'file_validate_size' => array(CULTUREFEED_IMAGES_MAX_SIZE),
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

  if (!empty($address)) {
    if ($address->getStreet()) {
      $street = $address->getStreet();
    }
    else {
      $street = '';
    }

    if ($address->getZip()) {
      $zip = $address->getZip();
    }
    else {
      $zip = '';
    }

    if ($address->getCity()) {
      $city = $address->getCity();
    }
    else {
      $city = '';
    }
  } else {
    $street = '';
    $zip = '';
    $city = '';
  }

  $links = $page->getLinks();

  $form['contact'] = array(
    '#type' => 'fieldset',
    '#title' => '<h3 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#edit-contact" class="bootstrap-collapse-processed"><i class="fa fa-caret-down"></i>' . ' ' . t('Contact') . '</a></h3>',
    '#default_value' => '',
    '#weight' => 10,
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );

  // Address.

  $form['contact']['street'] = array(
    '#prefix' => '<div class="row"><div class="col-xs-12">',
    '#suffix' => '</div>',
    '#type' => 'textfield',
    '#title' => t('Street and number'),
    '#default_value' => $street,
    '#weight' => 11,
  );

  $form['contact']['zip'] = array(
    '#prefix' => '<div class="col-xs-3">',
    '#suffix' => '</div>',
    '#type' => 'textfield',
    '#title' => t('Zipcode'),
    '#default_value' => $zip,
    '#weight' => 12,
  );

  $form['contact']['city'] = array(
    '#prefix' => '<div class="col-xs-9">',
    '#suffix' => '</div></div>',
    '#type' => 'textfield',
    '#title' => t('City'),
    '#default_value' => $city,
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
    '#description' => t('Allowed extensions: jpg, jpeg, gif or png') . ' (max. ' . format_size(CULTUREFEED_IMAGES_MAX_SIZE) . ')',
    '#size' => 26,
    '#weight' => 21,
    '#process' => array('file_managed_file_process', 'culturefeed_image_file_process'),
    '#upload_validators' => array(
      'file_validate_extensions' => array('jpg jpeg png gif'),
      'file_validate_size' => array(CULTUREFEED_IMAGES_MAX_SIZE),
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
    '#description' => t('Allowed extensions: jpg, jpeg, gif or png') . ' (max. ' . format_size(CULTUREFEED_IMAGES_MAX_SIZE) . ')',
    '#size' => 26,
    '#weight' => 23,
    '#process' => array('file_managed_file_process', 'culturefeed_image_file_process'),
    '#upload_validators' => array(
      'file_validate_extensions' => array('jpg jpeg png gif'),
      'file_validate_size' => array(CULTUREFEED_IMAGES_MAX_SIZE),
    ),
    '#upload_location' => 'public://pages',
  );

  if (!empty($cover)) {

    // Creat temp file to preview the external cover.
    $file_cover = culturefeed_create_temporary_image($cover, file_default_scheme() . '://pages');
    if ($file_cover) {
      $form_state['#old_cover'] = $file_cover->fid;
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
    '#markup' => '<h2>' . t('Allow users to') . '</h2>',
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
    '#title' => t('follow my page'),
    '#description' => '<span class="text-muted">' . t('Followers receive a notification when your page is updated, so that they stay informed of new activities, threads, ...') . '</span>',
    '#default_value' => !empty($permissions->allowFollowers),
  );

  $form['allow_members'] = array(
    '#type' => 'checkbox',
    '#title' => t('become member of my page'),
    '#description' => '<span class="text-muted">' . t('Members can, depending on the roles or rights, collaborate to maintain and update your page. Furthermore, page memberships are added to user profiles and can be used as an alias to add comments.') . '</span>',
    '#default_value' => !empty($permissions->allowMembers),
  );

  $form['allow_comments'] = array(
    '#type' => 'checkbox',
    '#title' => t('add comments to my activities'),
    '#description' => '<span class="text-muted">' . t('Only available for organisations who added their activities via <a href="http://www.uitdatabank.be" target="_blank">www.uitdatabank.be</a>.') . '</span>',
    '#default_value' => !empty($permissions->allowComments),
  );

  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Update'),
  );

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
      $data['subject'] = '<div class="btn-group pull-right"><button class="btn btn-default dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cogs fa-fw fa-lg"></i>' . ' ' . t('Manage page') . ' ' . '<span class="caret"></span></button>'.  $data['content'] . '</div><div class="clearfix"></div><hr />';
      break;
    case 'page-agenda':
      unset($data['subject']);
      break;
    case 'page-timeline':
      $data['subject'] = '<ul class="nav nav-tabs"><li class="tab-agenda"><a href="#block-culturefeed-pages-page-agenda" class="text-muted"><h4><i class="fa fa-calendar fa-fw fa-lg"></i>' . t('Activities') . '</h4></a></li><li class="active"><a href="#"><h4><i class="fa fa-th-list fa-fw fa-lg"></i>' . t('Timeline') .'</h4></a></li></ul>';
      break;
    case 'profile_menu':
      $items = $data['content']['#items'];

      if ($items) {
        foreach ($items as $key => $item) {
          $items[$key]['class'][] = 'list-group-item';
        }

        $data['content'] = array(
          '#theme' => 'item_list',
          '#items' => $items,
          '#attributes' => array('class' => 'list-group'),
        );
      }

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
 * Helper function to render prefix markup for modals
 */

function culturefeed_bootstrap_modal_prefix($modal_title) {

  $output = '<div class="modal-dialog">';
  $output .= '<div class="modal-content">';
  $output .= '<div class="modal-header">';
  $output .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
  $output .= '<span aria-hidden="true">&times;</span>';
  $output .= '</button>';
  $output .= '<h4 class="modal-title">' . $modal_title . '</h4>';
  $output .= '</div>';
  $output .= '<div class="modal-body">';

  return $output;

}

/**
 * Helper function to render suffix markup for modals
 */

function culturefeed_bootstrap_modal_suffix() {

  $output = '</div></div></div>';

  return $output;

}

/**
 * Form confirmation callback to show a form to confirm the removal of member of a page.
 */
function culturefeed_bootstrap_form_culturefeed_pages_delete_member_form_alter(&$form, &$form_state, &$request_type) {

  if ($request_type != 'ajax') {
    $modal_title = t('Remove member');
    $form['#prefix'] = culturefeed_bootstrap_modal_prefix($modal_title);
    $form['#suffix'] = culturefeed_bootstrap_modal_suffix();
  }

  $form['decline']['#attributes']['class'] = array('button-decline', 'btn', 'btn-default');
  $form['decline']['#attributes']['data-dismiss'] = 'modal';
  $form['decline']['#href'] = '';

  return $form;

}

/**
 * Form confirmation callback to show a form to confirm the removal of a page.
 */
function culturefeed_bootstrap_form_culturefeed_pages_remove_page_confirm_form_alter(&$form, &$form_state, &$request_type) {

  if ($request_type != 'ajax') {
    $modal_title = t('Remove page');
    $form['#prefix'] = culturefeed_bootstrap_modal_prefix($modal_title);
    $form['#suffix'] = culturefeed_bootstrap_modal_suffix();
  }

  return $form;

}

/**
 * Form callback to delete one activity.
 */
function culturefeed_bootstrap_form_culturefeed_social_page_activity_delete_confirm_form_alter(&$form, &$form_state, $id, &$request_type) {

  if ($request_type != 'ajax') {
    $modal_title = t('Remove activity');
    $form['#prefix'] = culturefeed_bootstrap_modal_prefix($modal_title);
    $form['#suffix'] = culturefeed_bootstrap_modal_suffix();
  }

  return $form;

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

/**
 * Preprocess the culturefeed authenticated page.
 * @see culturefeed-authenticated-page.tpl.php
 */
function culturefeed_bootstrap_preprocess_culturefeed_authenticated_page(&$variables) {

  unset($title);
  $message = '<p class="lead">' . t('You should be logged in to proceed.') . '</p>';

  $variables['login_message'] = $message;

  $cf_query = drupal_get_query_parameters($_GET, array('q'));
  $cf_query['via'] = 'facebook';

  $facebook = '<div class="btn-toolbar"><div class="btn-group text-white">';
  $facebook .= l('<i class="fa fa-facebook text-white"></i>', 'culturefeed/oauth/connect', array('html' => TRUE, 'attributes' => array('class' => array('culturefeedconnect connect-facebook btn btn-primary btn-large'), 'rel' => 'nofollow'), 'query' => $cf_query));
  $facebook .= l(t('Login with Facebook'), 'culturefeed/oauth/connect', array('html' => TRUE, 'attributes' => array('class' => array('culturefeedconnect connect-facebook btn btn-primary btn-large'), 'rel' => 'nofollow'), 'query' => $cf_query));
  $facebook .= '</div></div>';
  $variables['login_facebook'] = $facebook;

  $cf_query['via'] = 'twitter';
  $variables['login_twitter'] = l('Twitter', 'culturefeed/oauth/connect', array('attributes' => array('class' => array('culturefeedconnect connect-twitter'), 'rel' => 'nofollow'), 'query' => $cf_query));

  $cf_query['via'] = 'google';
  $variables['login_google'] = l('Google', 'culturefeed/oauth/connect', array('attributes' => array('class' => array('culturefeedconnect connect-google'), 'rel' => 'nofollow'), 'query' => $cf_query));

  unset($cf_query['via']);
  $variables['login_email'] = l(t('e-mail'), 'culturefeed/oauth/connect', array('attributes' => array('class' => array('culturefeedconnect connect-email'), 'rel' => 'nofollow'), 'query' => $cf_query));
  $variables['register'] = l(t('new account'), 'culturefeed/oauth/connect/register', array('attributes' => array('class' => array('culturefeedconnect'), 'rel' => 'nofollow'), 'query' => $cf_query));

}

/**
 * Theme the overview of pages that a user follows in a block.
 */
function culturefeed_bootstrap_culturefeed_pages_following_pages_block($variables) {

  $items = array();
  foreach ($variables['following'] as $following) {
    $items[] = culturefeed_search_detail_l('page', $following->page->getId(), $following->page->getName()) . '<hr class="small" />';
  }

  return theme('item_list', array('items' => $items, 'attributes' => array('class' => array('list-unstyled'))));

}


/**
 * Preprocess the variables for the page administration options.
 * @see culturefeed-pages-block-admin-options.tpl.php
 */
function culturefeed_bootstrap_preprocess_culturefeed_pages_block_admin_options(&$variables) {

  $page = $variables['page'];
  $variables['switch_link'] = l(t('Login as') . '<br /><strong>' . $page->getName() . '</strong>', 'pages/switch/' . $page->getId(), array('attributes' => array('class' => array('btn btn-block btn-primary')), 'html' => TRUE));

}

/**
 * Theme the culturefeed_search_ui_city_only_facet_form
 */
function culturefeed_bootstrap_form_culturefeed_search_ui_city_only_facet_form_alter(&$form, &$form_state) {

  $form['#attributes']['class'][] = '';

  // TODO: add auto-submit behavior and remove submit button
  $form['submit']['#attributes'] = array('class' => array('btn-block'));
  $form['submit']['#value'] = t('Confirm choice');

}

/**
 * Theme the culturefeed_search_ui_proximity_distance_form
 */
function culturefeed_bootstrap_form_culturefeed_search_ui_proximity_distance_form_alter(&$form, &$form_state) {

  $form['distance']['#prefix'] = '<div class="row"><div class="col-lg-6">';
  $form['distance']['#title'] = '';
  $form['distance']['#suffix'] = '</div>';

  $form['submit']['#prefix'] = '<div class="col-lg-6">';
  $form['submit']['#attributes'] = array('class' => array('btn-link'));
  $form['submit']['#suffix'] = '</div></div><hr class="small" />';

  $form['new_search']['#markup'] = '<a data-toggle="collapse" href="#culturefeed-search-ui-city-facet-form" class="collapsed">' . t('Choose another location') . ' <i class="fa"></i></a>';

}

/**
 * Theme the culturefeed_search_ui_date_facet_form
 */
function culturefeed_bootstrap_form_culturefeed_search_ui_date_facet_form_alter(&$form, &$form_state) {

  $form['#attributes']['class'][] = '';

  $form['date_range_link'] = array(
    '#markup' => l('<span>' . t('Specific dates') . '</span>', 'javascript:', array(
      'html' => TRUE,
      'external' => TRUE,
      'attributes' => array('id' => 'specific-dates-range'),
    )),
    '#prefix' => '<div class="facet-label"><div class="row"><div class="col-xs-12"><div class="input-group specific-date">',
    '#suffix' => '</div></div></div></div>',
  );

  // Remove standard datepicker library.
  $library = array('culturefeed_search_ui', 'ui.daterangepicker');
  $library_index = array_search($library, $form['#attached']['library']);
  if ($library_index !== FALSE) {
    unset($form['#attached']['library'][$library_index]);
  }

  // Attach the bootstrap datepicker library.
  $path = drupal_get_path('theme', 'culturefeed_bootstrap');
  $form['#attached']['js'][] = $path . '/js/moment.js';
  $form['#attached']['js'][] = $path . '/js/daterangepicker.js';
  $form['#attached']['js'][] = $path . '/js/daterangepicker-bind.js';

  $form['#attached']['css'][$path . '/css/daterangepicker-bs3.css'] = array(
    'weight' => 100,
    'group' => CSS_THEME,
  );
}

/**
 * Theme the culturefeed_search_ui_city_facet_form
 */
function culturefeed_bootstrap_form_culturefeed_search_ui_city_facet_form_alter(&$form, &$form_state) {

  $form['#attributes']['class'][] = '';

  $form['location']['#prefix'] = '<div class="input-group">';
  $form['location']['#title'] = '';

  $form['submit']['#prefix'] = '<span class="input-group-btn">';
  $form['submit']['#suffix'] = '</span></div>';

}

/**
 * Theme the culturefeed_search_ui_city_actor_facet_form
 */
function culturefeed_bootstrap_form_culturefeed_search_ui_block_city_actor_facet_form_alter(&$form, &$form_state) {

  $form['#attributes']['class'][] = '';

  $form['city_actor']['#prefix'] = '<div class="input-group">';
  $form['city_actor']['#title'] = '';

  $form['submit']['#prefix'] = '<span class="input-group-btn">';
  $form['submit']['#suffix'] = '</span></div>';

}


/**
 * Theme the culturefeed_pages_page_suggestions_filter_form
 */
function culturefeed_bootstrap_form_culturefeed_pages_page_suggestions_filter_form_alter(&$form, &$form_state) {

  $title = $form['city']['#title'];

  $form['#prefix'] = '<div class="row">';
  $form['#suffix'] = '</div>';

  $form['city']['#title'] = '';
  $form['city']['#prefix'] = '';
  $form['city']['#prefix'] .= '<div class="col-sm-3"><div class="form-group"><label for="edit-city">';
  $form['city']['#prefix'] .= $title;
  $form['city']['#prefix'] .= '</label></div></div>';
  $form['city']['#prefix'] .= '<div class="col-xs-9 col-sm-7 ">';
  $form['city']['#suffix'] = '</div>';

  $form['submit']['#prefix'] = '<div class="col-xs-3 col-sm-2"><div class="form-group">';
  $form['submit']['#suffix'] = '</div></div>';

  $form['submit']['#attributes']['class'][] = 'btn';
  $form['submit']['#attributes']['class'][] = 'btn-primary';
  $form['submit']['#attributes']['class'][] = 'btn-block';
  $form['submit']['#value'] = t('Search');

}

/**
 * Preprocess function for the comment list item.
 * @see culturefeed-social-comment-list-item.tpl.php
 */
function culturefeed_bootstrap_preprocess_culturefeed_social_comment_list_item(&$variables) {

  $object = $variables['object'];
  $activity = $variables['activity'];
  $accounts = $variables['accounts'];
  $destination = drupal_get_destination();
  $cf_user = NULL;

  if (culturefeed_is_culturefeed_user()) {
    try {
      $cf_user = DrupalCultureFeed::getLoggedInUser();
    }
    catch (Exception $e) {
      watchdog_exception('culturefeed_social', $e);
    }
  }

  // Variables for one list item.
  $picture = theme('image', array('path' => $activity->depiction . '?width=120&height=120&crop=auto&scale=both', 'attributes' => array('class' => 'img-responsive')));
  $author_url = 'user/' . $variables['uid'];

  $variables['picture'] = l($picture, $author_url, array('html' => TRUE));
  $variables['date'] = format_date($activity->creationDate, 'small');

  $variables['author'] = l($activity->nick, $author_url);
  if (!empty($activity->onBehalfOf) && !empty($activity->onBehalfOfName) && module_exists('culturefeed_pages')) {
    $variables['author'] .= ' ' . t('from') . ' ' . culturefeed_search_detail_l('page', $activity->onBehalfOf, $activity->onBehalfOfName);
  }

  $variables['content'] = check_plain(strip_tags($activity->value)); // CultuurNet doesn't want to see html tags converted to plain.
  $variables['content'] = str_replace("\n", "<br />", $variables['content']);
  $variables['activity_id'] = $activity->id;

  // The list of child activities if available.
  $variables['list'] = array();
  if (!empty($variables['child_activities'])) {
    // The subitems.
    $list = array();
    foreach ($variables['child_activities'] as $child_activity) {
     $list[] = theme('culturefeed_social_comment_list_item', array(
       'activity' => $child_activity,
       'object' => $object,
       'uid' => $accounts[$child_activity->userId],
       'child_activities' => array(),
       'accounts' => array(),
       'level' => 1,
     ));
    }
    $variables['list'] = $list;
  }

  $variables['comment_link'] = '';
  $variables['comment_url'] = '';
  $variables['delete_link'] = '';
  $variables['abuse_link'] = '';

  if ($cf_user) {

    $remove_path = 'culturefeed/activity/delete/' . $activity->id;
    $attributes = array(
      'class' => array('remove-link'),
      'role' => 'button',
      'data-toggle' => 'modal',
      'data-target' => '#delete-wrapper-' . $activity->id,
      'data-remote' => url($remove_path . "/ajax", array('query' => $destination)),
    );

    if ($variables['level'] == 0) {

      if ($cf_user->id == $activity->userId || culturefeed_pages_is_user_admin_of_page($object->getId())) {
        $variables['delete_link'] = l(t('Delete'), $remove_path . '/nojs', array(
          'attributes' => $attributes,
          'query' => $destination,
        ));
      }

      $comment_url = 'culturefeed/activity/comment/' . $activity->id;
      $attributes = array(
        'class' => array('comment-link link-icon'),
        'role' => 'button',
        'data-toggle' => 'modal',
        'data-target' => '#comment-wrapper-' . $activity->id,
        'data-remote' => url($comment_url . "/ajax", array('query' => $destination)),
      );

      $variables['comment_link'] = l(t('Reply'), $comment_url . '/nojs', array(
        'attributes' => $attributes,
        'query' => $destination,
      ));

     $variables['comment_url'] = url($comment_url . '/nojs', array('attributes' => $attributes, 'query' => $destination));

    }
    else {

      if ($cf_user->id == $activity->userId || culturefeed_pages_is_user_admin_of_page($object->getId())) {
        $variables['delete_link'] = l(t('Delete'), $remove_path . '/nojs', array(
          'attributes' => $attributes,
          'query' => $destination,
          'html' => TRUE,
        ));
      }

    }
  }

  else {

    $comment_url = 'culturefeed/activity/comment/' . $activity->id;
    $hover = theme('culturefeed_ui_connect_hover', array('url' => $_GET['q']));
    $popover_options = array(
      'class' => '',
      'data-toggle' => 'popover',
      'data-content' => $hover,
      'data-placement' => 'top',
      'data-title' => '<strong>' . t('Connect with UiTiD') . '</strong>',
      'data-html' => 'true'
    );

    $variables['comment_link'] = l(t('Post a comment'), $comment_url, array('attributes' => $popover_options, 'html' => TRUE));

  }

  if (module_exists('culturefeed_messages')) {

    $abuse_url = 'culturefeed/activity/report-abuse/' . $activity->id;
    $attributes = array(
      'class' => array('comment-abuse-link'),
      'role' => 'button',
      'data-toggle' => 'modal',
      'data-target' => '#abuse-wrapper-' . $activity->id,
      'href' => url($abuse_url . "/ajax", array('query' => $destination)),
    );

    $variables['abuse_link'] = l(t('Report as inappropriate'), $abuse_url . '/nojs', array(
      'attributes' => $attributes,
      'query' => $destination,
    ));

  }
}

/**
 * Overrides theme_file_managed_file().
 */
function culturefeed_bootstrap_file_managed_file($variables) {

  $element = $variables['element'];

  $attributes = array();
  if (isset($element['#id'])) {
    $attributes['id'] = $element['#id'];
  }
  if (!empty($element['#attributes']['class'])) {
    $attributes['class'] = (array) $element['#attributes']['class'];
  }

  if (!empty($element['filename']) && !empty($element['#file']->uri)) {
    $element['filename']['#markup'] = '<div class="col-md-4">';
    $element['filename']['#markup'] .= theme('image_style', array('style_name' => 'thumbnail', 'path' => $element['#file']->uri, 'attributes' => array('class' => array('img-thumbnail'))));
    $element['filename']['#markup'] .= '</div>';
    $element['remove_button']['#prefix'] = '<div class="col-md-8"><span class="input-group-btn">';
    $element['remove_button']['#suffix'] = '</span></div>';
    $element['remove']['#prefix'] = '<div class="col-md-8">';
    $element['remove']['#suffix'] = '</div>';
  }
  else {
    $element['filename']['#markup'] = '';
    $element['upload_button']['#prefix'] = '<div class="col-md-8"><span class="input-group-btn">';
    $element['upload_button']['#suffix'] = '</span></div>';
    $element['upload']['#prefix'] = '<div class="col-md-8">';
    $element['upload']['#suffix'] = '</div>';
  }

  $hidden_elements = array();
  foreach (element_children($element) as $child) {
    if (isset($element[$child]['#type']) && $element[$child]['#type'] === 'hidden') {
      $hidden_elements[$child] = $element[$child];
      unset($element[$child]);
    }
  }

  // This wrapper is required to apply JS behaviors and CSS styling.
  $attributes['class'] = array('form-managed-file');

  $output = '<div class="row">';
  $output .= '<div' . drupal_attributes($attributes) . '>';
  $output .= drupal_render_children($element);
  $output .= '</div>';
  $output .= render($hidden_elements);
  $output .= '</div>';

  return $output;
}

/**
 * Implements hook_preprocess_region().
 */
function culturefeed_bootstrap_preprocess_region(&$variables) {
  $variables['pagetype'] = '';
  if (arg(0) == 'agenda') {
    if (arg(1) == 'search') {
      $variables['pagetype'] = 'agenda-search';
    }
    elseif (arg(1) == 'pages') {
      $variables['pagetype'] = 'agenda-pages';
    }
  }
}

/**
 * Implements hook_preprocess_culturefeed_search_page().
 */
function culturefeed_bootstrap_preprocess_culturefeed_search_page(&$variables) {
  $variables['sort_links'] = '';
  if (arg(0) == 'agenda') {
    if (arg(1) == 'search') {
      $variables['sort_links'] = theme('culturefeed_search_sort_links', array('type' => 'activiteiten'));
    }
    elseif (arg(1) == 'pages') {
      $variables['sort_links'] = theme('culturefeed_search_sort_links', array('type' => 'pages'));
    }
  }
}

/**
 * Implements template_preprocess_page().
 */
function culturefeed_bootstrap_preprocess_page(&$variables) {
  if (module_exists('culturefeed_ui')) {
    if (variable_get('culturefeed_ui_cookie_bool')) {
      drupal_add_js(drupal_get_path('module', 'culturefeed_ui') . '/js/jquery.cookie.js');
      drupal_add_js(drupal_get_path('theme', 'culturefeed_bootstrap') . '/js/cookie_message.js');
      drupal_add_js(array('culturefeed_ui' => array('path' => variable_get('culturefeed_ui_cookie_path'))), 'setting');
    }
  }

  // Add information about the number of sidebars.
  if (!empty($variables['page']['sidebar_first']) && !empty($variables['page']['sidebar_second'])) {
    $variables['content_column_class'] = ' class="col-sm-4 col-md-6"';
  }
  elseif (!empty($variables['page']['sidebar_first']) || !empty($variables['page']['sidebar_second'])) {
    $variables['content_column_class'] = ' class="col-sm-8 col-md-9"';
  }
  else {
    $variables['content_column_class'] = ' class="col-sm-12"';
  }
}

/**
 * Preprocess the culturefeed ui account edit form.
 *
 * @param array $vars
 *   The variables.
 */
function culturefeed_bootstrap_preprocess_culturefeed_ui_account_edit_form(&$vars) {

  $form = $vars['form'];

  $vars['nick'] = drupal_render($form['nick']);
  $vars['mbox'] = drupal_render($form['mbox']);
  $vars['change_password'] = drupal_render($form['change_password']);
  $vars['submit'] = drupal_render($form['submit']);
  $vars['main_form'] = drupal_render_children($form);

}

/**
 * Preprocess the culturefeed ui profile edit form.
 *
 * @param array $vars
 *   The variables.
 */
function culturefeed_bootstrap_preprocess_culturefeed_ui_profile_edit_form(&$vars) {

  $form = $vars['form'];

  $vars['givenName'] = drupal_render($form['givenName']);
  $vars['familyName'] = drupal_render($form['familyName']);
  $vars['dob'] = drupal_render($form['dob']);
  $vars['gender'] = drupal_render($form['gender']);
  $vars['picture'] = drupal_render($form['picture']);
  $vars['street'] = drupal_render($form['street']);
  $vars['zip'] = drupal_render($form['zip']);
  $vars['city'] = drupal_render($form['city']);
  $vars['country'] = drupal_render($form['country']);
  $vars['bio'] = drupal_render($form['bio']);
  if (variable_get('culturefeed_ui_profile_show_language_settings', FALSE)) {
    $vars['preferredLanguage'] = $form['preferredLanguage'];
  }
  $vars['main_form'] = drupal_render_children($form);

}

/**
 * Overrides theme_culturefeed_search_sort_links().
 */
function culturefeed_bootstrap_culturefeed_search_sort_links(&$variables) {

  if (empty($variables['links'])) {
    return '';
  }

  $output = '<div class="btn-group pull-right">';
  $output .= '<button class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">';
  foreach ($variables['links'] as $link) {
    if (isset($link['options']['attributes']['class'][0])) {
      $output .= $link['text'] . ' ';
    }
  }
  $output .= ' <span class="caret"></span></button>';
  $output .= '<ul class="cf-sort-links dropdown-menu text-left">';
  foreach ($variables['links'] as $link) {
    $output .= '<li>' . theme('link', $link) . '</li>';
  }
  $output .= '</ul>';
  $output .= '</div>';

  return $output;

}

/*
 * Implements hook_js_alter().
 */
function culturefeed_bootstrap_js_alter(&$javascript) {

  $vertical_tabs_file = drupal_get_path('theme', 'bootstrap') . '/js/misc/_vertical-tabs.js';

  // Add our own verstion of tabs.
  if (isset($javascript[$vertical_tabs_file])) {
    $file = drupal_get_path('theme', 'culturefeed_bootstrap') . '/js/_vertical-tabs.js';
    $javascript[$file] = $javascript[$vertical_tabs_file];
    $javascript[$file]['weight']++;
    $javascript[$file]['data'] = $file;
  }

  // Add our own verstion of fieldgroup.
  $field_group_file = drupal_get_path('module', 'field_group') . '/field_group.js';
  if (isset($javascript[$field_group_file])) {
    $file = drupal_get_path('theme', 'culturefeed_bootstrap') . '/js/_field_group.js';
    $javascript[$file] = $javascript[$field_group_file];
    $javascript[$file]['weight']++;
    $javascript[$file]['data'] = $file;
  }

  // Adding our own version of autocomplete for entry_ui because bootstrap
  // is messing up default autocomplete.
  $match_cp = false;
  if (current_path() == 'agenda/e/add') {
    $match_cp = true;
  }
  elseif (drupal_match_path(current_path(), 'agenda/e/*/*/edit')) {
    $match_cp = true;
  }

  if (module_exists('culturefeed_entry_ui') && $match_cp) {
    $file = drupal_get_path('theme', 'culturefeed_bootstrap') . '/js/bootstrap_autocomplete_override.js';
    drupal_add_js($file);
  }

  // Add a different version of the culturefeed ui synchronization link.
  $synchronization_file = drupal_get_path('module', 'culturefeed_ui') . '/js/synchronization.js';
  if (isset($javascript[$synchronization_file])) {
    $javascript[$synchronization_file]['data'] = drupal_get_path('theme', 'culturefeed_bootstrap') . '/js/synchronization.js';
  }

  // Add a different version of the culturefeed ui account edit tooltip.
  $account_edit_tooltip_file = drupal_get_path('module', 'culturefeed_ui') . '/js/account_edit_tooltip.js';
  if (isset($javascript[$account_edit_tooltip_file])) {
    $javascript[$account_edit_tooltip_file]['data'] = drupal_get_path('theme', 'culturefeed_bootstrap') . '/js/account_edit_tooltip.js';
  }

}

function culturefeed_bootstrap_form_culturefeed_uitpas_advantages_filter_sort_alter(&$form, &$form_state) {

  // Advantages.
  $form['advantages_link']['#attributes']['class'][] = 'nav nav-tabs';
  $promotions = $form['advantages_link']['#links']['promotions'];
  $form['advantages_link']['#links']['promotions lead'] = $promotions;
  unset($form['advantages_link']['#links']['promotions']);
  $advantages = $form['advantages_link']['#links']['advantages'];
  $form['advantages_link']['#links']['advantages lead'] = $advantages;
  unset($form['advantages_link']['#links']['advantages']);

  return $form;
}

function culturefeed_bootstrap_form_culturefeed_uitpas_promotions_filter_sort_alter(&$form, &$form_state) {

  // Promotions.
  $form['promotions_link']['#attributes']['class'][] = 'nav nav-tabs';
  $promotions = $form['promotions_link']['#links']['promotions'];
  $form['promotions_link']['#links']['promotions lead'] = $promotions;
  unset($form['promotions_link']['#links']['promotions']);
  $advantages = $form['promotions_link']['#links']['advantages'];
  $form['promotions_link']['#links']['advantages lead'] = $advantages;
  unset($form['promotions_link']['#links']['advantages']);

  return $form;
}

function culturefeed_bootstrap_form_culturefeed_uitpas_profile_advantages_filter_sort_alter(&$form, &$form_state) {

  // Profile advantages.
  $form['profile_advantages_link']['#attributes']['class'][] = 'nav nav-tabs';
  $promotions = $form['profile_advantages_link']['#links']['promotions'];
  $form['profile_advantages_link']['#links']['promotions lead'] = $promotions;
  unset($form['profile_advantages_link']['#links']['promotions']);
  $advantages = $form['profile_advantages_link']['#links']['advantages'];
  $form['profile_advantages_link']['#links']['advantages lead'] = $advantages;
  unset($form['profile_advantages_link']['#links']['advantages']);

  return $form;
}

function culturefeed_bootstrap_form_culturefeed_uitpas_profile_promotions_filter_sort_alter(&$form, &$form_state) {

  // Profile promotions.
  $form['profile_promotions_link']['#attributes']['class'][] = 'nav nav-tabs';
  $promotions = $form['profile_promotions_link']['#links']['promotions'];
  $form['profile_promotions_link']['#links']['promotions lead'] = $promotions;
  unset($form['profile_promotions_link']['#links']['promotions']);
  $advantages = $form['profile_promotions_link']['#links']['advantages'];
  $form['profile_promotions_link']['#links']['advantages lead'] = $advantages;
  unset($form['profile_promotions_link']['#links']['advantages']);

  return $form;
}

function culturefeed_bootstrap_menu_breadcrumb_alter(&$active_trail, $item) {
  if ($item['page_callback'] == 'culturefeed_uitpas_promotion_details_get') {
    $promotion_placeholder[] = array(
      'title' => t('Promotions'),
      'href' => $GLOBALS['base_url'] . '/promotions',
      'link_path' => '',
      'localized_options' => array(),
      'type' => 0,
    );
    array_splice($active_trail, 1, 0, $promotion_placeholder);
  }

  if ($item['page_callback'] == 'culturefeed_uitpas_advantage_details_get') {
    $advantage_placeholder[] = array(
      'title' => t('Welcome advantages'),
      'href' => $GLOBALS['base_url'] . '/advantages',
      'link_path' => '',
      'localized_options' => array(),
      'type' => 0,
    );
    array_splice($active_trail, 1, 0, $advantage_placeholder);
  }

}

/**
 * Overrides theme_textfield().
 */
function culturefeed_bootstrap_textfield(&$variables) {

  $element = $variables['element'];
  $element['#attributes']['type'] = 'text';
  element_set_attributes($element, array(
    'id',
    'name',
    'value',
    'size',
    'maxlength',
  ));
  _form_set_class($element, array('form-text'));

  $output = '<input' . drupal_attributes($element['#attributes']) . ' />';
  $extra = '';

  // If this is a jquery ui autocomplete, also change to group-addon.
  if (isset($element['#attributes']['class']) && in_array('jquery-ui-autocomplete', $element['#attributes']['class'])) {
    $output = '<div class="input-group">' . $output . '<span class="input-group-addon">' . _bootstrap_icon('refresh') . '</span></div>';
  }
  // Normal autocomplete
  elseif ($element['#autocomplete_path'] && drupal_valid_path($element['#autocomplete_path'])) {
    drupal_add_library('system', 'drupal.autocomplete');
    $element['#attributes']['class'][] = 'form-autocomplete';

    $attributes = array();
    $attributes['type'] = 'hidden';
    $attributes['id'] = $element['#attributes']['id'] . '-autocomplete';
    $attributes['value'] = url($element['#autocomplete_path'], array('absolute' => TRUE));
    $attributes['disabled'] = 'disabled';
    $attributes['class'][] = 'autocomplete';
    $output = '<div class="input-group">' . $output . '<span class="input-group-addon">' . _bootstrap_icon('refresh') . '</span></div>';
    $extra = '<input' . drupal_attributes($attributes) . ' />';
  }

  return $output . $extra;

}

/**
 * Overrides theme_form_element().
 */
function culturefeed_bootstrap_form_element(&$variables) {
  $element = &$variables['element'];
  $is_checkbox = FALSE;
  $is_radio = FALSE;

  // This function is invoked as theme wrapper, but the rendered form element
  // may not necessarily have been processed by form_builder().
  $element += array(
    '#title_display' => 'before',
  );

  // Add element #id for #type 'item'.
  if (isset($element['#markup']) && !empty($element['#id'])) {
    $attributes['id'] = $element['#id'];
  }

  // Check for errors and set correct error class.
  if (isset($element['#parents']) && form_get_error($element)) {
    $attributes['class'][] = 'error';
  }

  if (!empty($element['#type'])) {
    $attributes['class'][] = 'form-type-' . strtr($element['#type'], '_', '-');
  }
  if (!empty($element['#name'])) {
    $attributes['class'][] = 'form-item-' . strtr($element['#name'], array(
        ' ' => '-',
        '_' => '-',
        '[' => '-',
        ']' => '',
      ));
  }
  // Add a class for disabled elements to facilitate cross-browser styling.
  if (!empty($element['#attributes']['disabled'])) {
    $attributes['class'][] = 'form-disabled';
  }
  if (!empty($element['#autocomplete_path']) && drupal_valid_path($element['#autocomplete_path'])) {
    $attributes['class'][] = 'form-autocomplete';
  }
  elseif (isset($element['#attributes']['class']) && in_array('jquery-ui-autocomplete', $element['#attributes']['class'])) {
    $attributes['class'][] = 'form-autocomplete';
  }
  $attributes['class'][] = 'form-item';

  // See http://getbootstrap.com/css/#forms-controls.
  if (isset($element['#type'])) {
    if ($element['#type'] == "radio") {
      $attributes['class'][] = 'radio';
      $is_radio = TRUE;
    }
    elseif ($element['#type'] == "checkbox") {
      $attributes['class'][] = 'checkbox';
      $is_checkbox = TRUE;
    }
    else {
      $attributes['class'][] = 'form-group';
    }
  }

  $description = FALSE;
  $tooltip = FALSE;
  // Convert some descriptions to tooltips.
  // @see bootstrap_tooltip_descriptions setting in _bootstrap_settings_form()
  if (!empty($element['#description'])) {
    $description = $element['#description'];
    if (theme_get_setting('bootstrap_tooltip_enabled') && theme_get_setting('bootstrap_tooltip_descriptions') && $description === strip_tags($description) && strlen($description) <= 200) {
      $tooltip = TRUE;
      $attributes['data-toggle'] = 'tooltip';
      $attributes['title'] = $description;
    }
  }

  $output = '<div' . drupal_attributes($attributes) . '>' . "\n";

  // If #title is not set, we don't display any label or required marker.
  if (!isset($element['#title'])) {
    $element['#title_display'] = 'none';
  }

  $prefix = '';
  $suffix = '';
  if (isset($element['#field_prefix']) || isset($element['#field_suffix'])) {
    // Determine if "#input_group" was specified.
    if (!empty($element['#input_group'])) {
      $prefix .= '<div class="input-group">';
      $prefix .= isset($element['#field_prefix']) ? '<span class="input-group-addon">' . $element['#field_prefix'] . '</span>' : '';
      $suffix .= isset($element['#field_suffix']) ? '<span class="input-group-addon">' . $element['#field_suffix'] . '</span>' : '';
      $suffix .= '</div>';
    }
    else {
      $prefix .= isset($element['#field_prefix']) ? $element['#field_prefix'] : '';
      $suffix .= isset($element['#field_suffix']) ? $element['#field_suffix'] : '';
    }
  }

  switch ($element['#title_display']) {
    case 'before':
    case 'invisible':
      $output .= ' ' . theme('form_element_label', $variables);
      $output .= ' ' . $prefix . $element['#children'] . $suffix . "\n";
      break;

    case 'after':
      if ($is_radio || $is_checkbox) {
        $output .= ' ' . $prefix . $element['#children'] . $suffix;
      }
      else {
        $variables['#children'] = ' ' . $prefix . $element['#children'] . $suffix;
      }
      $output .= ' ' . theme('form_element_label', $variables) . "\n";
      break;

    case 'none':
    case 'attribute':
      // Output no label and no required marker, only the children.
      $output .= ' ' . $prefix . $element['#children'] . $suffix . "\n";
      break;
  }

  if ($description && !$tooltip) {
    $output .= '<p class="help-block">' . $element['#description'] . "</p>\n";
  }

  $output .= "</div>\n";

  return $output;
}

/**
 * Implements hook_form_{culturefeed_calendar_form}_alter().
 */
function culturefeed_bootstrap_form_culturefeed_calendar_form_alter(&$form, $form_state) {

  if (arg(4) != 'ajax') {
    return;
  }

  if (!isset($form['#prefix'])) {
    $form['#prefix'] = '';
  }

  // Add header, don't loose existing prefix.
  $form['#prefix'] .= '<div class="modal-header"><h4 class="modal-title">' . drupal_get_title() . '</h4></div><div class="modal-body">';

  $form['actions']['#prefix'] = '</div></div><div class="modal-footer">';
  $form['actions']['#suffix'] = '</div>';

  unset($form['actions']['cancel']['#ajax']);
  $form['actions']['cancel']['#attributes']['data-dismiss'] = 'modal';
  $form['actions']['cancel']['#attributes']['class'][] = 'btn-link';
  $form['actions']['submit']['#attributes']['class'][] = 'btn-default';

}

/**
 * Implements hook_form_{culturefeed_calendar_delete_form}_alter().
 */
function culturefeed_bootstrap_form_culturefeed_calendar_delete_form_alter(&$form, $form_state) {

  if (arg(4) != 'ajax') {
    return;
  }

  if (!isset($form['#prefix'])) {
    $form['#prefix'] = '';
  }

  // Add header, don't loose existing prefix.
  $form['#prefix'] .= '<div class="modal-header"><h4 class="modal-title">' . drupal_get_title() . '</h4></div>';

  $form['info']['#prefix'] = '<div class="modal-body">';
  $form['date']['#suffix'] = '</div>';

  $form['actions']['#prefix'] = '<div class="modal-footer">';
  $form['actions']['#suffix'] = '</div>';

  $form['actions']['cancel']['#attributes']['data-dismiss'] = 'modal';

}

/**
 * Theme the saved searches CTA.
 */
function culturefeed_bootstrap_culturefeed_saved_searches_cta($vars) {
  return '<div class="text-center"><p>' . check_plain($vars['text']) . '</p>'. l(t('Save this search'), $vars['path'], array('query' => $vars['query'], 'html' => TRUE, 'attributes' => array('class' => 'btn-primary btn btn-save-search'))) . '</div>';
}

/**
 * Theme add to calendar button tooltip.
 *
 */
function culturefeed_bootstrap_preprocess_culturefeed_calendar_button_hover(&$variables) {

  $variables['options']['attributes'] = array(
    'class' => array('btn', 'btn-primary', 'btn-block'),
  );
}

/**
 * Override image output advantage for gallery
 *
 */
function culturefeed_bootstrap_preprocess_culturefeed_uitpas_advantage(&$vars) {

  $advantage = $vars['advantage'];

  // Image.
  $vars['image'] = '';
  $vars['images_list'] = '';
  $images = array();
  if (isset($advantage->pictures[0])) {
    $vars['image'] = theme_image(array('path' => $advantage->pictures[0], 'alt' => $advantage->title, 'title' => $advantage->title, 'attributes' => array()));
    foreach ($advantage->pictures as $key => $picture) {
      $images[] = l(
        theme('image', array('path' => $advantage->pictures[$key] . '?maxwidth=300&max-height=300', 'alt' => $advantage->title, 'title' => $advantage->title, 'attributes' => array())),
        $advantage->pictures[$key],
        array('html' => TRUE, 'attributes' => array('data-gallery' => 'data-gallery'))
      );
    }
    $vars['images_list'] = theme('item_list', array('items' => $images));
  }

}

/**
 * Add bootstrap classes to register_where table
 *
 */
function culturefeed_bootstrap_preprocess_culturefeed_uitpas_register_where(&$vars) {

  $table = array(
    'header' => array(),
    'rows' => array(),
    'attributes' => array(
      'class' => 'table',
    ),
    'caption' => '',
    'colgroups' => array(),
    'sticky' => '',
    'empty' => '',
  );

  if (count($vars['pos'])) {

    foreach ($vars['pos'] as $pos) {

      // Address.
      $address = array();

      if (isset($vars['actors'][$pos->id])) {

        // @codingStandardsIgnoreStart
        /** @var CultureFeed_Cdb_Item_Actor $actor */
        // @codingStandardsIgnoreEnd
        $actor = $vars['actors'][$pos->id]->getEntity();
        $contact_info = $actor->getContactInfo();
        // @codingStandardsIgnoreStart
        /** @var CultureFeed_Cdb_Data_Address[] $addresses */
        // @codingStandardsIgnoreEnd
        $addresses = $contact_info->getAddresses();
        if ($addresses[0]) {

          if ($addresses[0]->getPhysicalAddress()->getZip()) {
            $address[] = $addresses[0]->getPhysicalAddress()->getZip();
          }
          if ($addresses[0]->getPhysicalAddress()->getCity()) {
            $address[] = $addresses[0]->getPhysicalAddress()->getCity();
          }
        }
      }

      elseif ($pos->city && !count($address)) {
        if ($pos->postalCode) {
          $address[] = $pos->postalCode;
        }
        if ($pos->city) {
          $address[] = $pos->city;
        }
      }

      // Card systems.
      $card_systems = array();
      if (!empty($pos->cardSystems)) {
        foreach ($pos->cardSystems as $card_system) {
          /* @var CultureFeed_Uitpas_CardSystem $card_system */
          $card_systems[] = $card_system->name;
        }
      }

      $table['rows'][] = array(
        l($pos->name, 'agenda/a/' . culturefeed_search_slug($pos->name) . '/' . $pos->id),
        (count($card_systems)) ? theme('item_list', array('items' => $card_systems, 'type' => 'ul', 'attributes' => array('class' => 'list-unstyled'))) : '',
        implode(' ', $address),
      );

    }
  }
  else {
    $table['rows'][] = array(array('data' => t('No results found.'), 'colspan' => 2));
  }

  $pager = array(
    'element' => $vars['pos_pager_element'],
    'quantity' => $vars['pos_total'],
  );

  $vars['intro'] = t('You can get an UiTPAS at one of these registration counters. An UiTPAS costs € 5. Younger than 18 years? Then you\'ll pay € 2. For people with an opportunities tarrif UiTPAS is free. You\'ll need your eID to register your UiTPAS.');
  $vars['pos_table'] = theme_table($table) . '<div class="pager clearfix">' . theme('pager', $pager) . '</div>';
  $vars['outro'] = t('Important: you\'ll need your eID to register your UiTPAS. <a href="@read-more">Read more</a> about the UiTPAS project.', array('@read-more' => 'http://www.cultuurnet.be/project/uitpas'));

}

/**
 * Override image output promotion for gallery
 */
function culturefeed_bootstrap_preprocess_culturefeed_uitpas_promotion(&$vars) {
  $promotion = $vars['promotion'];

  // Image.
  $vars['image'] = '';
  $vars['images_list'] = '';
  $images = array();
  if (isset($promotion->pictures[0])) {
    $vars['image'] = theme('image', array('path' => $promotion->pictures[0] . '?maxwidth=300&max-height=300', 'alt' => $promotion->title, 'title' => $promotion->title, 'attributes' => array()));
    foreach ($promotion->pictures as $key => $picture) {
      $images[] = l(
        theme('image', array('path' => $promotion->pictures[$key] . '?maxwidth=300&max-height=300', 'alt' => $promotion->title, 'title' => $promotion->title, 'attributes' => array())),
        $promotion->pictures[$key],
        array('html' => TRUE, 'attributes' => array('data-gallery' => 'data-gallery'))
      );
    }
    $vars['images_list'] = theme('item_list', array('items' => $images));
  }

}

/**
 * Add bootstrap class to user register button
 *
 */
function culturefeed_bootstrap_form_culturefeed_uitpas_user_register_form_alter(&$form, &$form_state) {

  $prefix = '<p class="intro">' . t('Register here, so you can follow your UiTPAS advantages and points balance online.') . '</p>';

  $form['prefix']['#markup'] = $prefix;

  // Fields
  $form['username']['#prefix'] = '<div class="row"><div class="col-sm-6">';
  $form['username']['#suffix'] = '</div></div>';
  $form['uitpasnumber']['#prefix'] = '<div class="row"><div class="col-sm-6">';
  $form['uitpasnumber']['#suffix'] = '</div></div>';
  $form['dob']['#prefix'] = '<div class="row"><div class="col-sm-6">';
  $form['dob']['#suffix'] = '</div></div>';

  // Button
  $form['actions']['submit']['#attributes']['class'][] = 'btn-primary';

}

/**
 * Preprocess variables for culturefeed_ui_profile_menu to bootstrap styles
 */
function culturefeed_bootstrap_culturefeed_ui_profile_shortcuts() {

  $build = array(
    '#attributes' => array(
      'class' => array('culturefeed-profile-shortcuts nav nav-tabs'),
    ),
    '#theme' => 'links',
  );

  $build['#links'] = array(
    'personal_data' => array(
      'title' => t('Personal data'),
      'href' => 'culturefeed/profile/edit',
    ),
    'login_data' => array(
      'title' => t('Login data'),
      'href' => 'culturefeed/account/edit',
    ),
    'privacy_settings' => array(
      'title' => t('Privacy settings'),
      'href' => 'culturefeed/profile/privacy',
    ),
  );

  return drupal_render($build);

}

/**
 * Implements hook_preprocess_preprocess_culturefeed_uitpas_profile_details().
 */
function culturefeed_bootstrap_preprocess_culturefeed_uitpas_profile_details(&$vars) {

  $uitpas_user = $vars['uitpas_user'];
  // @codingStandardsIgnoreStart
  /** @var CultureFeed_Uitpas_Passholder $passholder */
  // @codingStandardsIgnoreEnd
  $passholder = $uitpas_user->passholder;
  // @codingStandardsIgnoreStart
  /** @var CultureFeed_Uitpas_Passholder_CardSystemSpecific $card_system */
  // @codingStandardsIgnoreEnd
  $card_system = $uitpas_user->card_system;

  // Card numbers.
  $uitpas_numbers = array(
    'items' => array(),
    'type' => 'ul',
    'attributes' => array(),
    'title' => '',
  ); 
  
  foreach ($passholder->cardSystemSpecific as $card_system_specific) {

    $cardsystemnumber = isset($card_system_specific->currentCard->uitpasNumber) ? $card_system_specific->currentCard->uitpasNumber : '';
    $output = $cardsystemnumber . ' <span class="text-muted">(' . $card_system_specific->cardSystem->name . ')</span>';
    if ($card_system_specific->kansenStatuut && time() < $card_system_specific->kansenStatuutEndDate) {
      $status_end_date = t('valid till !date', array('!date' => date('j/m/Y', $card_system_specific->kansenStatuutEndDate)));
      $output .= '<br /><label>' . t('Opportunity status') . ':</label> ' . $status_end_date;
    }
    $uitpas_numbers['items'][] = array(
      'class' => array(drupal_html_class($card_system_specific->cardSystem->name)),
      'data' => $output,
    );
  }
  $uitpas_numbers_output = '<div class="panel-heading"><h3 class="panel-title">' . $vars['uitpas_numbers_title'] . ':</h3></div><div class="panel-body">';
  $uitpas_numbers_output .= theme('item_list', $uitpas_numbers);
  $uitpas_numbers_output .= '</div><div class="panel-footer">';
  $uitpas_numbers_output .= '</div>';
  $vars['uitpas_numbers'] = $uitpas_numbers_output;

  $form = drupal_get_form('culturefeed_uitpas_profile_details_form');
  $vars['form'] = drupal_render($form);

  if (count($passholder->memberships)) {

    $memberships = array();
    foreach ($passholder->memberships as $membership) {

      if (isset($membership->association->association)) {

        $endate = t('valid till !date', array('!date' => date('j/m/Y', $membership->endDate)));
        $memberships[] = '<label>' . $membership->association . ':</label> ' . $endate;

      }

    }
    $vars['memberships'] = implode('<br />', $memberships);

  }
  else {
    $vars['memberships'] = '';
  }
 
}


/**
 * Implements hook_preprocess_culturefeed_uitpas_profile_section_register().
 */
function culturefeed_bootstrap_preprocess_culturefeed_uitpas_profile_section_register(&$vars) {

  if(culturefeed_uitpas_not_yet_registered()) {
    $vars['intro_title'] = t('You did not register your UiTPAS yet.');
    $vars['intro_text'] = t('Register here, so you can follow your UiTPAS advantages and points balance online.');
    $vars['cta_link'] = l(t('Register your UiTPAS'), 'register_uitpas', array('attributes' => array('class' => array('btn', 'btn-primary', 'btn-block'))));
  }

  else {
    $vars['intro_title'] = t('No UiTPAS yet?');
    $vars['intro_text'] = t('Holders of an UiTPAS can earn points by participating in leisure activities and exchange them for') . ' ' . l(t('nice benefits'), 'promotions') . '.';
    $vars['cta_link'] = l(t('Get an UiTPAS'), 'register_where', array('attributes' => array('class' => array('btn', 'btn-primary', 'btn-block'))));
  }
}
