<?php

/**
 * @file
 * Contains \Drupal\custom_migrate\Plugin\migrate\process\NodeParagraphTextarea.
 */

namespace Drupal\custom_migrate\Plugin\migrate\process;

use Drupal\migrate\ProcessPluginBase;
use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\Row;
use Drupal\node\Entity\Node;
use Drupal\paragraphs\Entity\Paragraph;
use Drupal\file\Entity\File;


/**
 * It saves D6 Page Body field to D8 Page Paragraph (Textarea) field.
 *
 * @MigrateProcessPlugin(
 *   id = "node_paragraph_textarea"
 * )
 */
class NodeParagraphTextarea extends ProcessPluginBase {

  /**
   * {@inheritdoc}
   */
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {
    $is_new = 1;
    $paragraphs = array();
    $paragraphs1 = array(0=>1,1=>1);
print_r($paragraphs1);
    $body = $value;
   // drush_print_r($body);

    $nid = $row->getSourceIdValues()['nid'];
    $node = Node::load($nid);
    ///drush_print_r($node);
    $field_type_paragraphs = array();
    if (!empty($node->field_page_paragraph)) {
      print "yes";
      $field_type_paragraphs = $node->field_page_paragraph->getValue();
    }

    // Loop through all the paragraphs types associated with Node.
    foreach ($field_type_paragraphs as $paragraph_source) {
      $target_id = $paragraph_source['target_id'];
      $target_revision_id = $paragraph_source['target_revision_id'];

      $paragraph_data = Paragraph::load($target_id);

      if ($paragraph_data->bundle() == 'text') {
        print "yes2";
        $paragraph_data->set('field_text_area', $body);
        $paragraph_data->save();

        $is_new = 0;
      }
      // All the existing paragraphs types will be captured.
      // This is done to avoid removal of existing paragraphs types.
      $paragraphs[] = array('target_id' => $target_id, 'target_revision_id' => $target_revision_id);
    }
    // If no paragraphs_type_text is assigned to node.
    if ($is_new) {

     $file = File::load(16);
    ///  print "no";
      $ppt_values = array(
        'id' => NULL,
        'type' => 'text',
        'field_text_area' => $body,
        'field_test_with' => $body,
        'field_slide_show' => $file,

      );

      foreach ($paragraphs1 as $key => $value) {

        $ppt_paragraph = Paragraph::create($ppt_values);
        $ppt_paragraph->save();

        $target_id_dest = $ppt_paragraph->Id();
        $target_revision_id_dest = $ppt_paragraph->getRevisionId();

       $paragraphs[] = array('target_id' => $target_id_dest, 'target_revision_id' => $target_revision_id_dest);
      }

    }

    return $paragraphs;
  }

}
