<div class="promotions_highlight clearfix">

  <div class="row">

    <?php foreach ($items as $item): ?>
      <div class="col-sm-3 col-xs-6">
        <section class="promotions-highlight-list-item">
          <?php print $item['thumbnail']; ?>
          <a class="hyperspan" href="/<?php print $item['url']; ?>"></a>
          <div class="promotions-highlight-details">
            <h2 class="promotions-highlight-title"><?php print $item['title']; ?></h2>
            <p><span class="label label-primary promotions-highlight-points"><?php print $item['points']; ?></span></p>
          </div>
        </section>
      </div>
    <?php endforeach; ?>

  </div>

  <div class="row">
    <div class="col-xs-12">
      <p class="text-center"><a class="btn btn-default" href="/promotions"><?php print t('All promotions'); ?></a></p>
    </div>
  </div>

</div>
