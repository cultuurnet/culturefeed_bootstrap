<div class="thumbnail">
  <div class="row">
    <div class="col-md-4 col-sm-6">
      <div class="container">
        <h2>Congrats!</h2>
        <p class="lead visible-lg">So far, so good! But this is just the beginning. It's only getting better :-)</p>
        <p class="visible-md">So far, so good! But this is just the beginning. It's only getting better :-)</p>
        <p>
          <?php print l('Log in to Culturefeed &rarr;', $base_url . 'culturefeed/oauth/connect', array('attributes' => array('class' => 'btn btn-warning btn-block'), 'html' => TRUE)); ?>
        </p>
        <small class="text-muted hidden-xs hidden-sm">Logging in as a Culturefeed user will demonstrate some additional features.</small>
      </div>
    </div>
    <div class="col-md-8 col-sm-6">
      <img src="<?php print base_path() . drupal_get_path('theme', 'culturefeed_bootstrap'); ?>/img/teaser-home.jpg" class="img-responsive hidden-xs" />
    </div>
  </div>
</div>
<hr>
<div class="row">
  <div class="col-sm-4">
    <div class="thumbnail text-center">
      <span class="fa-stack fa-5x">
        <i class="fa fa-circle fa-stack-2x text-muted"></i>
        <i class="fa fa-calendar fa-stack-1x fa-inverse"></i>
      </span>
      <div class="caption">
        <h3>Events</h3>
        <p class="text-left">What you want to search & browse the Culturefeed Events library, this is what you need:</p>
        <table class="table table-condensed text-left">
          <tbody id="cf-events">
            <tr>
              <td>
              <a data-toggle="collapse" data-parent="#cf-events" href="#cf-events-one"><strong><i class="fa fa-arrow-right"></i> API Key/Secret</strong></a>
              <p class="text-muted collapse" id="cf-events-one"><small>This installation comes with a development key & secret. When going live you should <?php print l('apply for a dedicated key', 'http://tools.uitdatabank.be'); ?> for your project. Login and submit your project and you'll receive a personal key that is configured to show only the events that are relevant for your project. Fill out this credentials on the <?php print l('Culturefeed Search', $base_url . 'admin/config/culturefeed/search'); ?> settings page.</small></p>
              </td>
            </tr>
            <tr>
              <td>
              <a data-toggle="collapse" data-parent="#cf-events" href="#cf-events-two"><strong><i class="fa fa-arrow-right"></i> Modules & Blocks</strong></a>
              <p class="text-muted collapse" id="cf-events-two"><small>The <?php print l('Culturefeed Search UI', $base_url . 'admin/config/culturefeed/search_ui'); ?> and <?php print l('Culturefeed Agenda', $base_url . 'admin/config/culturefeed/agenda'); ?> submodules are by default enabled in this installation together with the most common blocks. Explore some more blocks for this submodules on the <?php print l('blocks configuration', $base_url . 'admin/structure/block'); ?> page.</small></p>
              </td>
            </tr>
            <tr>
              <td>
              <a data-toggle="collapse" data-parent="#cf-events" href="#cf-events-three"><strong><i class="fa fa-arrow-right"></i> Documentation</strong></a>
              <p class="text-muted collapse" id="cf-events-three"><small>The Culturefeed Events Search API is build on Solr. The possibilities for building search and filterqueries are numerous. <?php print l('Here\'s an overview', 'http://tools.uitdatabank.be/content/uitdatabank-search-api-v2-solr'); ?> of all features.</small></p>
              </td>
            </tr>
          </tbody>
        </table>
        <p><?php print l('Browse Events &rarr;', $base_url . 'agenda/search', array('attributes' => array('class' => 'btn btn-primary btn-block', 'role' => 'button'), 'html' => TRUE)); ?></p>
      </div>
    </div>  
  </div>
  <div class="col-sm-4">
    <div class="thumbnail text-center">
      <span class="fa-stack fa-5x">
        <i class="fa fa-circle fa-stack-2x text-muted"></i>
        <i class="fa fa-user fa-stack-1x fa-inverse"></i>
      </span>
      <div class="caption">
        <h3>Users</h3>
        <p class="text-left">Extending your agenda with some nice login and social features is just a piece of cake:</p>
        <table class="table table-condensed text-left">
          <tbody id="cf-users">
            <tr>
              <td>
              <a data-toggle="collapse" data-parent="#cf-users" href="#cf-users-one"><strong><i class="fa fa-arrow-right"></i> Users API</strong></a>
              <p class="text-muted collapse" id="cf-users-one"><small>When you already have a key/secret for the Events API, you can use the same for the Users API. It's easy as that. Otherwise you should <?php print l('apply for a key', 'http://tools.uitdatabank.be'); ?> and update your credentials on the <?php print l('Culturefeed API', $base_url . 'admin/config/culturefeed/api-settings'); ?> settings page.<br /><br />Good to know: our user authentication platform is also known as "UiTiD"</small></p>
              </td>
            </tr>
            <tr>
              <td>
              <a data-toggle="collapse" data-parent="#cf-users" href="#cf-users-two"><strong><i class="fa fa-arrow-right"></i> Modules & Blocks</strong></a>
              <p class="text-muted collapse" id="cf-users-two"><small>The <?php print l('Culturefeed UI', $base_url . 'admin/config/culturefeed/culturefeed_ui'); ?> and <?php print l('Culturefeed Social', $base_url . 'admin/config/culturefeed/social'); ?> submodules are by default enabled in this installation together with the most common blocks. Discover all available <?php print l('blocks', $base_url . 'admin/structure/block'); ?> and <?php print l('settings', $base_url . 'admin/config/culturefeed'); ?> for this submodules.</small></p>
              </td>
            </tr>
            <tr>
              <td>
              <a data-toggle="collapse" data-parent="#cf-users" href="#cf-users-three"><strong><i class="fa fa-arrow-right"></i> Going full option</strong></a>
              <p class="text-muted collapse" id="cf-users-three"><small>Go completely out of control and the enable Culturefeed Pages, Culturefeed Messages or Culturefeed Notifications modules. Attention: these features are still in alpha release and currently not supported in the Culturefeed Bootstrap theme. <br /><br />If you want to extend some functionalities or build your own modules, you will need the <?php print l('UiTiD API documentation', 'http://tools.uitdatabank.be/docs/functionaliteiten'); ?> (only in dutch).</small></p>
              </td>
            </tr>
          </tbody>
        </table>
        <p><?php print l('Edit your profile &rarr;', $base_url . 'authenticated', array('attributes' => array('class' => 'btn btn-primary btn-block', 'role' => 'button'), 'html' => TRUE, 'query' => array('destination' => 'culturefeed/profile/edit'))); ?></p>
      </div>
    </div>  
  </div>
  <div class="col-sm-4">
    <div class="thumbnail text-center">
      <span class="fa-stack fa-5x">
        <i class="fa fa-circle fa-stack-2x text-muted"></i>
        <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
      </span>
      <div class="caption">
        <h3>Theme</h3>
        <p class="text-left">Culturefeed Bootstrap is a responsive, mobile first subtheme of the Bootstrap Framework.</p>
        <table class="table table-condensed text-left">
          <tbody id="cf-events">
            <tr>
              <td>
              <a data-toggle="collapse" data-parent="#cf-theme" href="#cf-theme-one"><strong><i class="fa fa-arrow-right"></i> Customize it</strong></a>
              <p class="text-muted collapse" id="cf-theme-one"><small>Culturefeed Bootstrap has some <?php print l('basic theme settings', $base_url . 'admin/appearance/settings/culturefeed_bootstrap'); ?> where you can customize branding colors, font-family, border-radius, navbars, etc. to your own needs. If you are a Drupal themer you can - of course - change all possible less variables and bootstrap overrides or kick everything out and build your own theme :-)</small></p>
              </td>
            </tr>
            <tr>
              <td>
              <a data-toggle="collapse" data-parent="#cf-theme" href="#cf-theme-two"><strong><i class="fa fa-arrow-right"></i> Bootstrap 3.0.2</strong></a>
              <p class="text-muted collapse" id="cf-theme-two"><small>If you like the Culturefeed Bootstrap theme or plan to build your own <?php print l('Bootstrap subtheme', 'http://www.drupal.org/project/bootstrap'); ?> some knowledge about the <?php print l('Bootstrap Framework', 'http://getbootstrap.com/'); ?> (version 3.0.2) will come in handy. Good to know: Culturefeed Bootstrap uses <?php print l('Less', 'http://www.drupal.org/project/less'); ?> to compile the CSS.</small></p>
              </td>
            </tr>
            <tr>
              <td>
              <a data-toggle="collapse" data-parent="#cf-theme" href="#cf-theme-three"><strong><i class="fa fa-arrow-right"></i> Font Awesome 4.0.3</strong></a>
              <p class="text-muted collapse" id="cf-theme-three"><small>We chose to make use of the Font Awesome Icon library (version 4.0.3) instead of the Glyphicons that are built in with Bootstrap. <?php print l('Here\'s an overview', 'http://fortawesome.github.io/Font-Awesome/'); ?> of all icons and examples.</small></p>
              </td>
            </tr>
          </tbody>
        </table>
        <p><?php print l('Customize theme &rarr;', $base_url . 'admin/appearance/settings/culturefeed_bootstrap', array('attributes' => array('class' => 'btn btn-primary btn-block', 'role' => 'button'), 'html' => TRUE)); ?></p>
      </div>
    </div>  
  </div>
</div>
<hr>
<div class="well well-sm">
  <div class="container">
    <h3>Working as Culturefeed user with administrator permissions</h3>
    <p class="text-danger"><i class="fa fa-info-circle"></i> Maybe you've already noticed: when you login to Culturefeed, you are logged out as the admin user.</p>
    <p class="lead">How to solve this?</p>
    <ol>
      <li><?php print l('Log out', $base_url . 'user/logout'); ?> with your Culturefeed account</li>
      <li>Go to the <?php print l('People section', $base_url . 'admin/people'); ?> an find the user that Drupal created for you in step 1</li>
      <li>Give yourself administrator permissions (create a role when necessary).</li>
      <li><?php print l('Log out', $base_url . 'user/logout'); ?> as admin user</li>
      <li><?php print l('Log in', $base_url . 'culturefeed/oauth/connect'); ?> again with your Culturefeed account and smile!</li>
    </ol>
  </div>
</div>
