<?php

/**
 * @file
 * Contains Drupal\idg_publish\Plugin\Block\AgeBlock.
 */

namespace Drupal\idg_publish\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormInterface;

/**
 * Provides a  block.
 *
 * @Block(
 *   id = "idg_publish_block",
 *   admin_label = @Translation("idg_publish Block"),
 * )
 */
class IdgPublishBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    $form = \Drupal::formBuilder()->getForm('Drupal\idg_publish\Form\IdgPublishForm');
    return $form;
   }
}

