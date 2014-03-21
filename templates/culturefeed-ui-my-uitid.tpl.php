<div class="btn-group profile-menu pull-right">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-cog"></i> <span class="caret"></span>
  </button>
  <ul class="dropdown-menu list-unstyled" role="menu" aria-labelledby="dLabel">
    <?php foreach ($contextual_links_array as $link) :?>
      <li><?php print $link; ?></li>
    <?php endforeach; ?>
  </ul>
</div>

<?php if ($picture || $name || $gender || $dob || $bio || $city): ?>
<div class="row">
  <?php if ($picture): ?>
    <div class="profile-picture col-xs-3">
      <?php print $picture; ?>
    </div>
  <?php endif; ?>

  <div class="profile-fields col-xs-9">
      <?php if ($name) : ?>
        <div class="profile-field name"><?php print $name; ?></div>
      <?php elseif ($nick) : ?>
        <div class="profile-field nick"><?php print $nick; ?></div>
      <?php endif; ?>

      <?php if ($age): ?>
        <div class="profile-field dob"><?php print $age; ?></div>
      <?php endif; ?>

      <?php if ($city): ?>
        <div class="profile-field city"><?php print $city; ?></div>
      <?php endif; ?>
  </div>
</div>
<?php else : ?>
<div class="no-profile"></div>
<?php endif; ?>
<div class="clearfix"></div>
<hr />

<?php if (!empty($memberships)): ?>
  <div class="page-memberships">
    <h4><?php print t('My pages:'); ?></h4>
    <ul class="list-unstyled">
    <?php foreach ($memberships as $membership) :?>
      <li><i class="fa fa-angle-right"></i> <?php print $membership; ?></li>
    <?php endforeach; ?>
    </ul>
  </div>

  <hr />
<?php endif; ?>

<div class="following">
  <h4><?php print t('Pages I follow:'); ?></h4>
  <?php if (!empty($following)): ?>
    <ul class="list-unstyled">
    <?php foreach ($following as $following_page) :?>
      <li><i class="fa fa-angle-right"></i> <?php print $following_page; ?></li>
    <?php endforeach; ?>
    </ul>
  <?php else: ?>
    <p><small class="text-muted"><?php print t('You don\'t follow any pages yet.'); ?></small></p>
    <strong><?php print l(t('Find pages to follow'), 'pages/search'); ?></strong>
  <?php endif; ?>
</div>

<div class="clearfix"></div>
