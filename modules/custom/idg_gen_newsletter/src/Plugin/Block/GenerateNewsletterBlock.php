<?php

/**
 * @file
 * Contains Drupal\idg_gen_newsletter\Plugin\Block\GenerateNewsletterBlock.
 */

namespace Drupal\idg_gen_newsletter\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Block\BlockBase;

/**
 * Provides a  block.
 *
 * @Block(
 *   id = "generate_newsletter",
 *   admin_label = @Translation("Newsletter Block"),
 * )
 */
class GenerateNewsletterBlock extends BlockBase {

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
    $form = \Drupal::formBuilder()->getForm('Drupal\idg_gen_newsletter\Form\GenerateNewsletterForm');
    return array(
      'add_this_page' => $form,
    );
  }
}
