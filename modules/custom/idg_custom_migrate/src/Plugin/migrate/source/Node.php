<?php
/**
 * @file
 * Contains \Drupal\idg_custom_migrate\Plugin\migrate\source\Node.
 */

namespace Drupal\idg_custom_migrate\Plugin\migrate\source;

use Drupal\migrate\Row;
use Drupal\node\Plugin\migrate\source\d6\Node as D6Node;

/**
 * Custom node source including url aliases.
 *
 * @MigrateSource(
 *   id = "idg_custom_migrate_node"
 * )
 */
class Node extends D6Node {

  /**
   * {@inheritdoc}
   */
  public function fields() {
    return ['alias' => $this->t('Path alias')] + parent::fields();
  }

  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {
    // Include path alias.
    print $nid = $row->getSourceProperty('nid');
    $query = $this->select('url_alias', 'ua')
      ->fields('ua', ['dst']);
    $query->condition('ua.src', 'node/' . $nid);
    $alias = $query->execute()->fetchField();
    if (!empty($alias)) {
      $row->setSourceProperty('alias', '/' . $alias);
    }
    return parent::prepareRow($row);
  }

}
