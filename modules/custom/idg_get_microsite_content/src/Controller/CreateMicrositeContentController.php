<?php

namespace Drupal\idg_get_microsite_content\Controller;
use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Drupal\Core\Database\Database;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\ChangedCommand;
use Drupal\Core\Ajax\CssCommand;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Ajax\InsertCommand;
use Drupal\Core\Entity\Entity;
use Symfony\Component\HttpFoundation\Response;
use \Drupal\file\Entity\File;
use Drupal\paragraphs\Entity\Paragraph;


  class CreateMicrositeContentController extends ControllerBase {

    public function get_microsite_content() {
      $fields = $this->getFieldMap('field_mapping_for_common_content');
      $parent_site= $this->getParentSiteUrl();
      $parent_site_url = $parent_site['url'];
      $site_to_pub = $parent_site['site to pub'];
      $content_url = urldecode($parent_site_url .'/microsite-content/'. $site_to_pub);
      $idg_news_json = $this->getParentContent($content_url);
      foreach ($idg_news_json as $content_index => $entity_content) {
        $update_node = $this->validateNodeforUpdate($entity_content);
        // Insert node if not available and update if there are any updates
          // if($update_node['action'] == 'update'){
          //   $node = Node::load($update_node['nid']);
          //   $this->updateEntity($node, $entity_content, $fields, Null, $parent_site_url);
          //   $node->status = 0;
          //   $node->save();
          //   $Node_id[$entity_content->nid]=array('status'=>'updated', 'nid'=>$node->id());

          // }
          // else
        if ($update_node['action']=='insert') {
            $node_fields = $this->createEntityArray($entity_content, $fields, 'common_content', $parent_site_url);
            $node_fields['status'] = 0;
            $uname = $entity_content->uid;
            $uid = $this->getUserName($uname);
            $node_fields['uid'] = $uid;
            $node = Node::create($node_fields);
            $node->save();
            $Node_id[$entity_content->nid]=array('status'=>'inserted', 'nid'=>$node->id());
          }
          else{
            $Node_id[$entity_content->nid]=array('status'=>'skipped', 'nid'=>$update_node['nid']);
          }
      }
      $response = new Response();
      $response->setContent(json_encode(array('nid'=> $Node_id, 'status' => "Success")));
      $response->headers->set('Content-Type', 'application/json');
      return $response;
    }
  //Update content.
    public function get_microsite_content_update() {

      $fields = $this->getFieldMap('field_mapping_for_common_content');
      $parent_site= $this->getParentSiteUrl();
      $parent_site_url = $parent_site['url'];
      $site_to_pub = $parent_site['site to pub'];
      $content_url = urldecode($parent_site_url .'/microsite-content/'. $site_to_pub);
      $idg_news_json = $this->getParentContent($content_url);
      foreach ($idg_news_json as $content_index => $entity_content) {
        $update_node = $this->validateNodeforUpdate($entity_content);
        // Insert node if not available and update if there are any updates
          if($update_node['action'] == 'update'){
            $node = Node::load($update_node['nid']);
            $this->updateEntity($node, $entity_content, $fields, Null, $parent_site_url);
           // $node->status = 0;
            $node->save();
            $Node_id[$entity_content->nid]=array('status'=>'updated', 'nid'=>$node->id());

          }else{
            $Node_id[$entity_content->nid]=array('status'=>'skipped', 'nid'=>$update_node['nid']);
          }
      }
      $response = new Response();
      $response->setContent(json_encode(array('nid'=> $Node_id, 'status' => "Success")));
      $response->headers->set('Content-Type', 'application/json');
      return $response;
    }

    public function getParentSiteUrl(){
      $connection = Database::getConnection();
      //Get field mappings from taxonomy term
      $query = $connection->select('taxonomy_term_field_data', 'ttfd');
      $query->addjoin('left','taxonomy_term__field_site_url', 'ttffsl','ttffsl.entity_id=ttfd.tid');
      $query->addjoin('left','taxonomy_term__field_site_type', 'ttfst','ttfst.entity_id=ttfd.tid');
      $query->addjoin('left','taxonomy_term__field_idg_news_sites_to_publish', 'ttfinsp','ttfinsp.entity_id=ttfd.tid');
      $query->condition('vid', 'idg_sites');
      $query->condition('field_site_type_value', 'Parent');
      $query->fields('ttfd', array('tid'));
      $query->fields('ttfd', array('name'));
      $query->fields('ttffsl', array('field_site_url_value'));
      $query->fields('ttfinsp', array('field_idg_news_sites_to_publish_value'));
      // $query->fields('ttfst', array('field_site_type_value'));
      $site_list = $query->execute()->fetchAll(\PDO::FETCH_OBJ);

      if(sizeof($site_list)>0){
        return array('name'=> $site_list[0]->name , 'url' => $site_list[0]->field_site_url_value, 'site to pub'=>$site_list[0]->field_idg_news_sites_to_publish_value);
      }
      else{
        return FALSE;
      }
    }

    //Validate node to flag for update
    public function validateNodeforUpdate($node_content){
      //Get Node if exists
      $parent_nid = $node_content->nid;
      $idgns_guid = $node_content->field_guid;
      $guid_version = $node_content->field_guid_version;
      // $idgns_guid_version = reset(explode('|', $idgns_guid_version));
      $new_guid = $node_content->field_new_guid;
      $new_guid_version = $node_content->field_new_guid_version;
      $connection = Database::getConnection();
      $query = $connection->select('node', 'n');
      $query -> addjoin('LEFT', 'node__field_guid', 'nfg', 'nfg.entity_id=n.nid');
      $query -> addjoin('LEFT', 'node__field_new_guid', 'nfng', 'nfng.entity_id=n.nid');
      $query -> addjoin('LEFT', 'node__field_guid_version', 'nfgv', 'nfgv.entity_id=n.nid');
      $query -> addjoin('LEFT', 'node__field_new_guid_version', 'nfngv', 'nfngv.entity_id=n.nid');
      $query -> condition('nfng.field_new_guid_value', $new_guid);
      $query -> fields('n', array('nid'));
      $query -> fields('nfng', array('field_new_guid_value'));
      $query -> fields('nfgv', array('field_guid_version_value'));
      $query -> fields('nfngv', array('field_new_guid_version_value'));
      $node_data = $query->execute()->fetchAll(\PDO::FETCH_OBJ);
      if ($node_data[0]->nid){
        if (trim($guid_version) == trim($node_data[0]->field_guid_version_value) && trim($new_guid_version) == trim($node_data[0]->field_new_guid_version_value)){
          return array('nid'=> $node_data[0]->nid , 'action' => 'skip');
        } else{
          return array('nid'=> $node_data[0]->nid , 'action' => 'update');
        }
      }
      else{
        return array('action' => 'insert');;
      }
    }


    //Get field map array from taxonomy
    public function getFieldMap($vid){
      $connection = Database::getConnection();
      //Get field mappings from taxonomy term
      $query = $connection->select('taxonomy_term_field_data', 'ttfd');
      $query->condition('vid', $vid);
      $query->addjoin('left','taxonomy_term__field_machine_name', 'ttfmn','ttfmn.entity_id=ttfd.tid');
      $query->addjoin('left','taxonomy_term__field_type_of_field', 'ttftf','ttftf.entity_id=ttfd.tid');
      $query->addjoin('left','taxonomy_term__field_entity_bu', 'ttfeb','ttfeb.entity_id=ttfd.tid');
      $query->addjoin('left','taxonomy_term_hierarchy', 'tth', 'tth.tid=ttfd.tid');
      $query->fields('ttfd', array('tid'));
      $query->fields('ttfd', array('name'));
      $query->fields('ttfmn', array('field_machine_name_value'));
      $query->fields('ttftf', array('field_type_of_field_value'));
      $query->fields('ttfeb', array('field_entity_bu_value'));
      $query->fields('tth', array('parent'));
      $field_map = $query->execute()->fetchAll(\PDO::FETCH_OBJ);

      //create array with field name as key
      foreach ($field_map as $value) {
        $fields[$value->name]= (array) $value;
        $key_map[$value->tid]= $value->name;
      }
      foreach ($fields as $value) {
        $value = (array) $value;
        if($value['parent'] != 0){
          $key = $key_map[$value['parent']];
          $fields[$key]['children'][$value['name']] =  $value;
        }
      }
      return $fields;
    }

    //Function to get content from parent site URL
    public function getParentContent($parent_url){
      //Get list of nodes to be published on site
      try {
        $uri = $parent_url;
        $response = \Drupal::httpClient()->get($uri, array('headers' => array('Accept' => 'text/plain','verify' => false)));
        $data = (string) $response->getBody();
        if (empty($data)) {
          return FALSE;
        }
      }
      catch (RequestException $e) {
        return FALSE;
      }
      $parent_field_data = json_decode($data);
      return $parent_field_data;
    }

    //Create Node with defined nodes
    public function updateEntity(&$node,$json, $field_array, $ent_bundle = null, $ent_site_url = null){
      foreach ($json as $field => $value) {
        if(array_key_exists($field, $field_array)){
        //  if(!empty(trim($value))){
            $field_type = $field_array[$field]['field_type_of_field_value'];
            $field_name = $field_array[$field]['field_machine_name_value'];
            $field_value = $value;
            switch ($field_type) {
              case 'Text':
                $node->$field_name->value = htmlspecialchars_decode(str_replace("&#039;", "'",$field_value));
                break;
              case 'Boolean':
                $node->$field_name->value = $this->getBooleanFieldVal($field_value);
                break;
              case 'GUID':
                //Do not update GUID for any content
                break;
              case 'Taxonomy':
                $node->$field_name = $this->getTermName(explode(',', $field_value), $field_array[$field]['field_entity_bu_value']);
                break;
              case 'Paragraph':
                $node->$field_name = $this->addParagraph(explode(',', $field_value), $field_array[$field]['field_entity_bu_value'], $field_array[$field]['children'], $ent_site_url);
                break;
              case 'Long Text':
                //$node->$field_name->value = htmlspecialchars_decode($field_value);
                $node->$field_name->value = $field_value;
                $node->$field_name->format = 'full_html';
                break;
              case 'Image':
                $node->$field_name = $this->addImagefromUrl($field_value);
                break;
              case 'File':
                // if (substr($ent_site_url, -1) == '/'){
                //   $file_url = rtrim($ent_site_url,'/') . $field_value;
                // } else {
                //   $file_url = $ent_site_url . $field_value;
                // }
                $node->$field_name = $this->addFilefromUrl($field_value);
                break;
              case 'Node':
                $node->$field_name = $this->getNodeIdforTitle(explode(',', $field_value), $field_array[$field]['field_entity_bu_value']);
                break;
              default:
                $node->$field_name->value = $field_value;
                break;
            }
          //}
        }
      }
      unset($field_array);
    }



    //Create Node with defined nodes
    public function createEntityArray($json, $field_array, $ent_bundle = null, $ent_site_url = null){
      $entity_fields = "";
      foreach ($json as $field => $value) {
        if(array_key_exists($field, $field_array)){
          if(!empty(trim($value))){
            $field_type = $field_array[$field]['field_type_of_field_value'];
            $field_name = $field_array[$field]['field_machine_name_value'];
            $field_value = $value;
            switch ($field_type) {
              case 'Text':
                $entity_fields[$field_name] = htmlspecialchars_decode(str_replace("&#039;", "'",$field_value));
                break;
              case 'Boolean':
                $entity_fields[$field_name] = $this->getBooleanFieldVal($field_value);
                break;
              case 'GUID':
                $entity_fields[$field_name] = $field_value;
                break;
              case 'Taxonomy':
                $entity_fields[$field_name] = $this->getTermName(explode(',', $field_value), $field_array[$field]['field_entity_bu_value']);
                break;
              case 'Paragraph':
                $entity_fields[$field_name] = $this->addParagraph(explode(',', $field_value), $field_array[$field]['field_entity_bu_value'], $field_array[$field]['children'], $ent_site_url);
                break;
              case 'Long Text':
                $entity_fields[$field_name]['value'] = $field_value;
                $entity_fields[$field_name]['format'] = 'full_html';
                break;
              case 'Image':
                if (substr($ent_site_url, -1) == '/'){
                  $file_url = rtrim($ent_site_url,'/') . $field_value;
                } else {
                  $file_url = $ent_site_url . $field_value;
                }
                //$entity_fields[$field_name] = $this->addImagefromUrl($file_url);
                //Field value is complete URL for the parent site. File_url not required.
                $entity_fields[$field_name] = $this->addImagefromUrl($field_value);
                break;
              case 'File':
                // if (substr($ent_site_url, -1) == '/'){
                //   $file_url = rtrim($ent_site_url,'/') . $field_value;
                // } else {
                //   $file_url = $ent_site_url . $field_value;
                // }
                $entity_fields[$field_name] = $this->addFilefromUrl($field_value);
                break;
              case 'Node':
                $entity_fields[$field_name] = $this->getNodeIdforTitle(explode(',', $field_value), $field_array[$field]['field_entity_bu_value']);
                break;
              default:
                $entity_fields[$field_name] = $field_value;
                break;
            }
          }
        }
      }
      unset($field_array);
      if(sizeof($entity_fields)!=0){
        if(!empty($ent_bundle)){
          $entity_fields['type']=$ent_bundle;
        }
        return $entity_fields;
      }
      else{
        return FALSE;
      }
    }

    //Function to get Node Id for title
    public function getNodeIdforTitle($nodeTitle, $nodeType){
      //Get node titles in an array
      if (sizeof($nodeTitle) > 0){
        foreach ($nodeTitle as $title) {
          $title_list[] =  trim(htmlspecialchars_decode(str_replace("&#039;", "'", $title)));
        }
      }
      //Get node ids for all matching titles
      $query = \Drupal::entityQuery('node');
      $query->condition('title', $title_list, 'IN');

      if ($nodeType){
        $query->condition('type', $nodeType);
      }
      $entity_ids = $query->execute();
      return array_values($entity_ids);
    }

    //Function to get boolean field value
    public function getBooleanFieldVal($fieldVal){
      if (trim(strtolower($fieldVal)) == 'on' || trim(strtolower($fieldVal)) == 'yes' || $fieldVal == 1 ){
        return 1;
      } else {
        return 0;
      }
    }

    //Function to add image from URL and get fid
    public function addImagefromUrl($image_url){
      $parent_site= $this->getParentSiteUrl();
      $parent_site_url = $parent_site['url'];
      if($image_url){
        if (substr($parent_site_url, -1) == '/'){
          $file_url = rtrim($parent_site_url,'/') . trim($image_url);
        } else {
          $file_url = $parent_site_url . trim($image_url);
        }
      $file_path_array = explode('/', $file_url);
      $file_name = end($file_path_array);
      $spl_chrs = array(" ","@",":","/","&");
      $file_name = urldecode($file_name);
      $file_name = str_replace($spl_chrs, '_', $file_name);
      }
      $headers = get_headers($file_url);
      $headerstest = substr($headers[0], 9, 3);
      if ($headerstest == '200') {
       $data = file_get_contents($file_url);
      }
      if ($data){
        $file = file_save_data($data, 'public://'.$file_name , FILE_EXISTS_RENAME);
      }
      if($file){
        $file_arr = Array(
          'target_id' => $file->id(),
          'alt' => $file_name,
          'title' => $file_name,
          );
        return $file_arr;
      }
      else{
        return FALSE;
      }
    }

    //Function to add image from URL and get fid
    public function addFilefromUrl($file_url){
      $parent_site= $this->getParentSiteUrl();
      $parent_site_url = $parent_site['url'];
      $file_list_array = explode(',', $file_url);
      if (sizeof($file_list_array) != 0){
        foreach ($file_list_array as $value) {
          if(!empty($value)){
            if (substr($parent_site_url, -1) == '/') {
              $file_url1 = rtrim($parent_site_url,'/') . trim($value);
            } else {
              $file_url1 = $parent_site_url . trim($value);
            }
        $file_path_array = explode('/', $file_url1);
        $file_name = end($file_path_array);
        $headers = get_headers($file_url1);
        $headerstest = substr($headers[0], 9, 3);
        if ($headerstest == '200') {
          $data = file_get_contents($file_url1);
        }
        if ($data){
          $file = file_save_data($data, 'public://'. $file_name, FILE_EXISTS_RENAME);
        }
        if ($file){
          $file_arr[] = array('target_id' => $file->id());
        }
        }//if
      }//foreach
       return $file_arr;
    }//if
    else{
        return FALSE;
      }
  }//function


    //Function to Create Paragraphs
    public function addParagraph($paragraph_ids, $paragraph_type, $paragraph_fields, $pg_site_url){
      if (sizeof($paragraph_ids) != 0){
        foreach ($paragraph_ids as $value) {
          if(!empty($value)){
            $value = trim($value);
            $paragraph_url = urldecode($pg_site_url .'/paragraph-content/'.$value);
            $parent_paragraph_content = $this->getParentContent($paragraph_url);
            $paragraph_field_array = $this->createEntityArray($parent_paragraph_content[0], $paragraph_fields,$paragraph_type,$pg_site_url);
            //Create new paragraph
            $paragraph = Paragraph::create($paragraph_field_array);
            $paragraph->isNew();
            $paragraph->save();
            $paragraphs[] = array('target_id'=> $paragraph->id(), 'target_revision_id'=>$paragraph->id());
          }
        }
        return $paragraphs;
      }
      else{
        return FALSE;
      }
    }

    //Function to get TIDs for taxonomy term names
    public function getTermName($term_name, $vocab = Null){
      $term_name =array_map('trim', $term_name);
      $query = \Drupal::entityQuery('taxonomy_term');

      $grpCondition = $query->orConditionGroup()->condition('name', $term_name, 'IN')->condition('field_parent_site_field_value', $term_name, 'IN');

      if ($vocab){
        $query->condition('vid', $vocab);
      }
      $entity_ids = $query->condition($grpCondition)->execute();

      foreach ($entity_ids as $key => $value) {
        $tid[]=$key;
      }
      return $tid;
    }

    //Function to get UID from user name
    public function getUserName($user_name){
      $connection = Database::getConnection();
      $query = $connection->select('users_field_data', 'user');
      $query->condition('user.name', $user_name);
      $query->fields('user', ['uid']);
      $output = $query->execute()->fetchAll();
      if($output) {
        return $output[0]->uid;
       }
    }

  }//close class();
