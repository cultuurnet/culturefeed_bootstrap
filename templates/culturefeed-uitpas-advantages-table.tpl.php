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
              <td colspan="2" class="no-border-top">
                <p class="muted">Er zijn momenteel geen welkomstvoordelen beschikbaar.</p>
              </td>
            </tr>
      <?php endif; ?>
      </table>

    </div>






