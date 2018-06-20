<?php
/**
 * @file
 * Contains \Drupal\cse\Plugin\Block\CseBlock.
 */

namespace Drupal\cse\Plugin\Block;

use Drupal\Core\Block\BlockBase;
/**
 * Provides a 'CSE' Block.
 * @Block(
 *   id = "cse_blocka",
 *   admin_label = @Translation("CSE custom block for search"),
 *   category = @Translation("Custom block")
 * )
 */
class CseBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {

      return array(
      '#theme' => 'cse_theme',
      '#value' => $this->t('<gcse:searchresults-only>'),
      '#attached' => array(
        'library' => array(
          'cse/cse-scr'
        ),
      ),
    );
   }
}




