<?php

/**
 * @file
 * Default theme implementation to display culturefeed uitpas advantages
 * promotions.
 *
 * Available variables:
 * - $promotions_table: The list of promotions.
 * - $advantages_table: The list of advantages.
 * - $info: Info text.
 */
?>  
    <div class="table-responsive">
   
      <table class="table table-hover">
      <?php if (!empty($promotions)): ?>
        <?php foreach ($promotions as $promotion): ?>
        <?php if ($promotion->maxAvailableUnits != NULL && $promotion->unitsTaken >= $promotion->maxAvailableUnits): ?>
        <tr>
          <td class="hidden-xs hidden-sm">
            <?php if (!empty($promotion->pictures[0])): ?>
              <?php print '<img src="' . $promotion->pictures[0] . '?maxwidth=100&maxheight=100" class="img-responsive"/>' ?>
            <?php else: ?>
              <img src="<?php print base_path() . drupal_get_path('theme', 'culturefeed_bootstrap'); ?>/img/no-thumbnail-2.gif" width="110" class="img-responsive" />
            <?php endif; ?>
          </td>
          <td class="hidden-md hidden-lg">
            <p class="nowrap">
              <span class="fa-stack fa-lg">
              <i class="fa fa-circle fa-stack-2x" style="color: #999999;"></i>
              <i class="fa fa-exchange fa-stack-1x fa-inverse"></i>
              </span>
              
              <span class="lead text-muted"><?php print $promotion->points ?></span>
            </p>
          </td>
          <td class="ws-normal">
            <h4 class="text-muted pull-left"><?php print $promotion->title ?></h4><small class="text-muted">(<?php print $promotion->owningCardSystem->name ?>)</small>
            <p></p>
            <p class="text-muted clearfix">
              <?php
                if(count($promotion->counters) > 3) {
                  for($i=0;$i < 3;$i++) {
                    print $promotion->counters[$i]->name;
                    if($i < 2) {
                      print ', ';
                    }
                  }
                }
                else {
                  $numpromotions = count($promotion->counters);
                  foreach($promotion->counters as $key => $counter) {
                    print $counter->name;
                    if($key < $numpromotions - 1) {
                      print ', ';
                    }
                  }
                }
              ?>
            </p>
            <p class="text-muted">Voorraad uitgeput</p>
          </td>
          <td class="hidden-xs hidden-sm">
            <p class="nowrap">
              <span class="fa-stack fa-lg">
              <i class="fa fa-circle fa-stack-2x" style="color: #999999;"></i>
              <i class="fa fa-exchange fa-stack-1x fa-inverse"></i>
              </span>
              
              <span class="lead text-muted"><?php print $promotion->points ?></span>
            </p>
          </td>
        </tr>
        <?php else: ?>
        <tr>
          <td class="hidden-xs hidden-sm">
            <?php if (!empty($promotion->pictures[0])): ?>
              <?php print '<img src="' . $promotion->pictures[0] . '?maxwidth=100&maxheight=100" class="img-responsive"/>' ?>
            <?php else: ?>
              <img src="<?php print base_path() . drupal_get_path('theme', 'culturefeed_bootstrap'); ?>/img/no-thumbnail-2.gif" width="110" class="img-responsive" />
            <?php endif; ?>
          </td>
          <td class="hidden-md hidden-lg">
            <p class="nowrap">
              <span class="fa-stack fa-lg">
              <i class="fa fa-circle fa-stack-2x"></i>
              <i class="fa fa-exchange fa-stack-1x fa-inverse"></i>
              </span>
              
              <span class="text-highlight lead"><?php print $promotion->points ?></span>
            </p>
          </td>
          <td class="ws-normal">
            <h4 class="media-heading pull-left" style="padding-right:10px;"><?php print l($promotion->title, 'promotion/' . culturefeed_search_slug($promotion->title) . '/' . $promotion->id) ; ?></h4><small class="text-muted">(<?php print $promotion->owningCardSystem->name ?>)</small>
            <p></p>
            <p class="clearfix">
              <?php
                if(count($promotion->counters) > 3) {
                  for($i=0;$i < 3;$i++) {
                    print $promotion->counters[$i]->name;
                    if($i < 2) {
                      print ', ';
                    }
                  }
                }
                else {
                  $numpromotions = count($promotion->counters);
                  foreach($promotion->counters as $key => $counter) {
                    print $counter->name;
                    if($key < $numpromotions - 1) {
                      print ', ';
                    }
                  }
                }
              ?>
            </p>
            <p class="text-muted">
            <?php if (!empty($promotion->cashingPeriodEnd)): ?>
              <i class="fa fa-calendar"></i> Geldig tot: <?php print format_date($promotion->cashingPeriodEnd, $type = 'short', 'm/d/Y'); ?>
            <?php else: ?>
             Zolang de voorraad strekt
            <?php endif; ?>
            </p>
          </td>
          <td class="hidden-xs hidden-sm">
            <p class="nowrap">
              <span class="fa-stack fa-lg">
              <i class="fa fa-circle fa-stack-2x"></i>
              <i class="fa fa-exchange fa-stack-1x fa-inverse"></i>
              </span>
              
              <span class="text-highlight lead"><?php print $promotion->points ?></span>
            </p>
          </td>
        </tr> 
        <?php endif; ?>
        <?php endforeach;?>
            <?php else: ?>
            <tr>
              <td colspan="3">
                <p class="muted">Er zijn momenteel geen voordelen beschikbaar.</p>
              </td>
            </tr> 
      <?php endif; ?>
      </table>
      
    </div>