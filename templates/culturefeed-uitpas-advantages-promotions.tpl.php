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

<ul class="nav nav-tabs">
  <li class="active lead"><a href="#promotions" data-toggle="tab">Voordelen</a></li>
  <li class="lead"><a href="#advantages" data-toggle="tab">Welkomstvoordelen</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  
  <div class="tab-pane active" id="promotions">
  
      <div class="well">
        <p>De UiTPAS is een kaart voor iedereen die deelneemt aan <span class="text-highlight">vrijetijdsactiviteiten</span>. Met de UiTPAS kan je <span class="text-highlight">punten sparen</span> en ze omruilen voor een <span class="text-highlight">korting</span> , <span class="text-highlight">cadeau</span> of ander <span class="text-highlight">voordeel</span></p>
      </div> 
  
    <div class="table-responsive">
   
      <table class="table table-hover">
      <?php if (!empty($promotions)): ?>
        <?php foreach ($promotions as $promotion): ?>
        <?php if ($promotion->maxAvailableUnits != NULL && $promotion->unitsTaken >= $promotion->maxAvailableUnits): ?>
        <tr>
          <td class="hidden-xs hidden-sm">
            <?php if (!empty($promotion->pictures[0])): ?>
              <?php print '<img src="' . $promotion->pictures[0] . '?maxwidth=100&maxheight=100" class="img-responsive" alt="' . $promotion->title . '" />' ?>
            <?php else: ?>
              <img src="<?php print base_path() . drupal_get_path('theme', 'culturefeed_bootstrap'); ?>/img/no-thumbnail-2.gif" width="110" class="img-responsive" alt="<?php print 'Uit in vlaanderen'; ?>" />
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
              <?php print '<img src="' . $promotion->pictures[0] . '?maxwidth=100&maxheight=100" class="img-responsive"alt="' . $promotion->title . '" />' ?>
            <?php else: ?>
              <img src="<?php print base_path() . drupal_get_path('theme', 'culturefeed_bootstrap'); ?>/img/no-thumbnail-2.gif" width="110" class="img-responsive" alt="<?php print 'Uit in vlaanderen'; ?>" />
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
    
    <!--<ul class="pagination">
          <?php !empty($_GET["page"]) ? $page = $_GET["page"] : $page = 1 ?>
          <li><a href="<?php print 'advantages_promotions?page=' . $page-- ?>">&laquo;</a></li>
          <?php for ($i = 1;$i <= ceil($promotions_total/count($promotions));$i++ ): ?>
            <li><a href="<?php print 'advantages_promotions' ?>"><?php print $i ?></a></li>
          <?php endfor; ?>
          <li><a href="<?php print 'advantages_promotions?page=' . $page++ ?>">&raquo;</a></li>
      </ul>-->
  </div>
  
    <div class="tab-pane" id="advantages">
      
      <div class="well">
        <p>Als je een <a href="/register_where">UiTPAS koopt</a>, krijg je bij verschillende UiTPASaanbieders een <span class="text-highlight">welkomstvoordeel</span>. Vraag ernaar bij de balie van de aanbieder.</p>
      </div> 
      
      <div class="table-responsive">
    
        <table class="table table-hover">
      <?php if (!empty($advantages)): ?>
        <?php foreach ($advantages as $advantage): ?>
        <tr>
          <td>
            <h4 class="media-heading"><?php print l($advantage->title, 'advantage/' . culturefeed_search_slug($advantage->title) . '/' . $advantage->id) ; ?></h4>
            <p class="text-muted">
            <?php if (!empty($advantage->cashingPeriodEnd)): ?>
              <i class="fa fa-calendar"></i> Geldig tot: <?php print format_date($advantage->cashingPeriodEnd, $type = 'short', 'm/d/Y'); ?>
            <?php else: ?>
             Zolang de voorraad strekt
            <?php endif; ?>
            </p>
          </td>
        </tr> 
        <?php endforeach;?>
            <?php else: ?>
            <tr>
              <td colspan="2">
                <p class="muted">Er zijn momenteel geen welkomstvoordelen beschikbaar.</p>
              </td>
            </tr> 
      <?php endif; ?>
      </table>
      
    </div>
  
  </div>
  
</div>






