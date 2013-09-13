<?php if ($profile_edit_link) : ?>
  <p class="pull-right">
    <?php print $profile_edit_link ?>
  </p>
<?php endif; ?>

<div class="clearfix"></div>

<ul class="media-list">
  <li class="media">
    <?php if ($picture) : ?>
    <div class="profile-picture pull-left">
      <?php print $picture ?>
    </div>
    <?php endif; ?>
    <div class="media-body">
      <?php if ($name): ?>
        <p class="profile-name">
          <?php print $name;?>
        </p>
      <?php endif; ?>
      <?php if (isset($heading_info) && $heading_info ): ?>
        <p class="muted">
          <?php print $heading_info; ?>
        </p>
      <?php endif; ?>
      <?php if ($bio): ?>
        <p class="profile-bio">
          <?php print $bio;?>
        </p>
      <?php endif; ?>
      <?php if (isset($has_profile) && $has_profile) : ?>
        <?php if (!empty($memberships)): ?>
        <dl class="dl-horizontal">
          <dt class="profile-label">Lid van</dt>
          <dd class="profile-field memberships">
            <ul class="no-bullets">
            <?php foreach ($memberships as $membership): ?>
              <li>
              <?php print culturefeed_search_detail_l('page', $membership->page->getId(), $membership->page->getName()); ?>
              <?php if (!empty($membership->relation)): ?>
                <span class="member-role muted"><small>(<?php print $membership->relation; ?>)</small></span>
               <?php endif; ?>
               </li>
            <?php endforeach; ?>
            </ul>
          </dd>
        </dl>
        <?php if ($city) : ?>
        <dl class="dl-horizontal">
          <dt class="profile-label">Woonplaats</dt>
          <dd class="profile-field city"><?php print $city ?></dd>
        </dl>
        <?php endif; ?>
        <?php endif; ?>

        <?php else : ?>
        <div class="no-profile"></div>
      <?php endif; ?>
    </div>
  </li>
</ul>

<div class="clearfix"></div>
