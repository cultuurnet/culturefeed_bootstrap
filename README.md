## Important note
In november 2019, publiq vzw (formerly known as CultuurNet) starts the End of Support phase of the Culturefeed Drupal 7 module suite. This means that you can continue to use Culturefeed, but publiq vzw will not invest anymore in this Drupal 7 module suite.

As an exception, critical security updates will still be provided if needed.

The End of Life (EOL) date of the module suite is set to the same date as the EOL of Drupal 7 core, ie. November 2021 (https://www.drupal.org/psa-2019-02-25).

We built this final 4.0 release, which contains a major security update, and some incompatible changes compared to the latest 3.10.2 release. Some less used modules are moved to a separate repository. If you update to this version please check & should you use one of these modules, reinstall them from a separate repository. After that all things should work as usual.
- https://github.com/cultuurnet/culturefeed_pages [DEPRECATED]

- https://github.com/cultuurnet/culturefeed_roles [DEPRECATED]

- https://github.com/cultuurnet/culturefeed_messages [DEPRECATED]

- https://github.com/cultuurnet/culturefeed_calendar [DEPRECATED]

- https://github.com/cultuurnet/culturefeed_uitpas

- https://github.com/cultuurnet/culturefeed_social

- https://github.com/cultuurnet/culturefeed_userpoints_ui [DEPRECATED]

- https://github.com/cultuurnet/culturefeed_entry_ui [DEPRECATED]

### Alternatives

As an alternative for the Culturefeed Drupal 7 module suite, publiq vzw focused on:

- A new, easy to use API in a developer-friendly Json format: https://projectaanvraag.uitdatabank.be/#!/integrations#api

- An even easier to use widget platform: https://projectaanvraag.uitdatabank.be/#!/integrations#widgets

We also have a Drupal 8 version on https://github.com/cultuurnet/culturefeed_d8 with the most commonly used modules culturefeed_agenda, culturefeed_content, culturefeed_search, culturefeed_search_api and culturefeed_user.

However, these modules will not contain the full functionality as was provided in the Drupal 7 edition, and it will not be heavily extended by publiq the same way we did this for the Drupal 7 edition. We are still happy to review and accept pull requests from external developers or partners, though.

# How to use this theme?

### culturefeed_bootstrap:

- is the **recommended basetheme** to use with the culturefeed module suite
- is a subtheme of **Bootstrap v3.0**
- will need **jQuery 1.7** or higher 
 - so please enable the jquery_update module
- uses **LESS** to compile stylesheets
 - SASS will be supported when upgrading to Bootstrap v3.1
- provides some LESS vars as **theme settings**
 - so you or your client can easily customize brand colors, fonts & border-radius from the admin interface
 - go to /admin/appearance/settings/culturefeed_bootstrap
- uses the **Font Awesome** Icon toolkit (v4.2.0)
 - Font Awesome provides much more possibilities than Glyphicons
- prefers to use the Bootstrap Source Files for the **javascript plugins**
 - but of course you can switch to use the CDN method
- has it's own subtheme called **culturefeed_bootstrap_virgin**
 - this is the way to built your own theme if you want to keep on track with updates of the culturefeed_bootstrap theme
- adds the [Bootstrap Image Gallery](https://blueimp.github.io/Bootstrap-Image-Gallery/)

If you want to integrate the Bootstrap Gallery please add following html:


```
    <!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
    <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-use-bootstrap-modal="false">
    <!-- The container for the modal slides -->
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
    <!-- The modal dialog, which will be used to wrap the lightbox content -->
    <div class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" aria-hidden="true">&times;</button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body next"></div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left prev">
              <i class="fa fa-arrow-left"></i>
              <?php print t('Previous'); ?>
            </button>
            <button type="button" class="btn btn-primary next">
              <?php print t('Next'); ?>
              <i class="fa fa-arrow-right"></i>
            </button>
            </div>
          </div>
        </div>
      </div>
    </div>

```

And add the __data-gallery__ attribute:

```
<a href="<?php print file_create_url($image); ?>" data-gallery>
  <?php  print theme('image_style',array('style_name' => 'thumbnail', 'path' => $image)); ?>
</a>
```






