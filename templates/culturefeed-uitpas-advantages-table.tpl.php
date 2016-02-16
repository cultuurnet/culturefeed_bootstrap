<section class="overview overview-advantages clearfix">
  <?php foreach($items as $item): ?>
  <article class="<?php print implode(' ', $item['classes']); ?> clearfix">
    <div class="row">
      <?php print $item['overlay_link']; ?>
      <div class="main col-md-8 col-lg-9" role="main">
        <div class="row">
          <figure class="col-xs-3 col-lg-2">
            <?php print $item['image']; ?>
          </figure>
          <div class="content col-xs-9 col-lg-10">
            <span class="provider-label"><p class="text-muted <?php print $item['cardsystem']['class']; ?>"><?php print $item['cardsystem']['name']; ?></p></span>
            <h2 class="title"><?php print $item['title']; ?></h2>
            <ul class="locations list-unstyled">
              <?php foreach($item['counters'] as $counter): ?>
              <li class="<?php print $counter['class']; ?>"><?php print $counter['name']; ?></li>
              <?php endforeach; ?>
            </ul>
            <?php if($item['availability'] !== t('Until end of stock')): ?>
              <span class="availability"><i class="fa fa-exclamation-circle"></i></a><?php print $item['availability']; ?></span>
            <?php endif; ?>            
          </div>
        </div>
      </div> <!--/ end .main -->
      <aside class="col-md-4 col-lg-3 text-right <?php print $item['points']['classes']; ?>">
        <span class="label label-primary"><?php print $item['points']['value']; ?></span>
        <?php if ($item['points']['remark']): ?>
          <em class="small clearfix"><?php print $item['points']['remark']; ?></em>
        <?php endif; ?>
      </aside> <!--/ end aside -->
    </div>
  </article> <!--/ end article -->
  <?php endforeach; ?>
</section>
<div class="pager clearfix">
<?php print $pager; ?>
</div>
