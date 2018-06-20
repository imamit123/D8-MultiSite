<?php

/**
 * @file
 * Contains \Drupal\migrate_d6_metatag_custom\Plugin\migrate\process\Nodewords.
 */

namespace Drupal\custom_migration\Plugin\migrate\process;

use Drupal\migrate\ProcessPluginBase;
use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\Row;
use Drupal\Component\Utility\Unicode;


/**
 * This plugin converts D6 Nodewords to D8 Metatags.
 *
 * @MigrateProcessPlugin(
 *   id = "d6_nodewords"
 * )
 */
class Nodewords extends ProcessPluginBase {

  /**
   * {@inheritdoc}
   */
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {

print_r($value);
print "lomas";
print_r($row);

}
 public function prepareRow(Row $row) {


}


}
