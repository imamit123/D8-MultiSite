<?php
  namespace Drupal\tid_content\Controller;
  use Drupal\node\Entity\Node;
  use Drupal\Core\Database\Database;

 class WebformGen {   
     public function generate_tid() {     
       $con =\Drupal\Core\Database\Database::getConnection();

        //Query for tid. 
       $query = db_select('node__field_common_category', 'n')
                ->condition('field_common_category_target_id', 4219); 
       $query->fields('n', array('field_common_category_target_id', 'entity_id')); 
       $result_tid = $query->execute()->fetchAll();
       $val_arr_tid = json_decode(json_encode($result_tid), true);

        //Query for webform.
       $query = db_select('node_field_data', 'm')
                ->condition('type', 'webform')
                ->condition('title', 'DOWNLOAD WHITE PAPER / CASE STUDY');
       $query->fields('m', array('nid', 'title')); 
       $result_nid = $query->execute()->fetchAll();
       $val_arr_nid = json_decode(json_encode($result_nid), true);      
       $webform_title = $val_arr_nid[0]['title'];
       $webform_nid = $val_arr_nid[0]['nid'];

       //Fetched nodes with webform type whitepapers.
       foreach ($val_arr_tid as $value) {
         $tid = $value['field_common_category_target_id'];
         $nid = $value['entity_id'];
         $node = Node::load($nid);
         if( !$node->get('field_webformid')->isEmpty() || $node->hasField('field_webformid') ){
           $node->set('field_webformid', $webform_nid);
           $node->save();
          }
        } 
        return $success = array('#markup' => 'Done!!');
      }
  }
