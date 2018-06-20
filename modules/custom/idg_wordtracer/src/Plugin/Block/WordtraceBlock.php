<?php

/**
 * @file
 * Contains Drupal\age_calculator\Plugin\Block\AgeBlock.
 */

namespace Drupal\idg_wordtracer\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Block\BlockBase;

/**
 * Provides a  block.
 *
 * @Block(
 *   id = "word_tracer_block",
 *   admin_label = @Translation("WordTracer Block"),
 * )
 */
class WordtraceBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  protected function blockAccess(AccountInterface $account) {
    return AccessResult::allowedIfHasPermission($account, 'access content');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $form = \Drupal::formBuilder()->getForm('Drupal\idg_wordtracer\Form\WordTracerConfigureForm');

    return array(
      'add_this_page' => $form,
    );
  }

}
