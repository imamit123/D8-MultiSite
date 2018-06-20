<?php

/**
 * @file
 * Contains \Drupal\migrate_d6_metatag_custom\Plugin\migrate\process\Authorname.
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
 *   id = "d6_author_name"
 * )
 */
class Authorname extends ProcessPluginBase {

  /**
   * {@inheritdoc}
   */
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {


// print "lomasrishi";
 $author = $row->getSourceProperty('field_author_profile_name');
// print_r($author);

// foreach ($author as $key => $value) {

//   print_r($value['nid']);
//   $row->setSourceProperty('field_author_profile_name', $value['nid']);
// }
  return $author;
}


}
