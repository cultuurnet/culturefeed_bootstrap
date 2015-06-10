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






