<?php
/**
 * @file
 * Contains \Drupal\cse\Plugin\Block\CseBlockA.
 */

namespace Drupal\cse\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'CSE' Block.
 * @Block(
 *   id = "cse_search_block",
 *   admin_label = @Translation("CSE custom search block for search bar"),
 * )
 */
class CseBlockA extends BlockBase {

  /**
   * {@inheritdoc}s
   */
  public function build() {
return array(
	'#markup' =>$this->t('<form class="form-search" method="get" action="/g_search"><input type="text" name="q" value="" placeholder="Google search" class="google_search_text" /> <input class="search" type="submit" value="ok" /> </form><div class="search-icon"></div>'),
	);
   }
}
