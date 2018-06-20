<?php
  namespace Drupal\idg_xml\Controller;
  use Drupal\node\Entity\Node;
  use Drupal\Core\Database\Database;

class CreateNewsController {
  public function create_news() {
  $connection = Database::getConnection();
  $options = array();
   $xml_tags = 'authour:byline,teaser:abstract,taxonomy:taxonomy.path,date:publicationtime';
  $uri = 'https://www.idgns.com/feeds/partner/idgns';
  try {
    $response = \Drupal::httpClient()->get($uri, array('headers' => array('Accept' => 'text/plain')));
    $data = (string) $response->getBody();
    if (empty($data)) {
      return FALSE;
    }
  }
  catch (RequestException $e) {
    return FALSE;
  }
  $xml_str = simplexml_load_string($data);
  $xml_arr =  objectsIntoArray1($xml_str);
  $link_count = count($xml_arr["channel"]["item"]);

  // Extract all IDGNS guids from XML data.
  $all_guids_raw = array_column($xml_arr["channel"]["item"], 'guid');
  foreach ($all_guids_raw as $value) {
    $guid = explode(":", $value)[4];
    $all_guids_arr[$guid] = $guid;
    $all_guids_arr = array_values($all_guids_arr);
  }
  // Existing IDGNS Guids for existing nodes.
    $query = $connection->select('node__field_guid', 'guid');
    $query->fields('guid',array('entity_id','field_guid_value'));
    $query->addJoin('inner','node','n','n.nid=guid.entity_id');
    $query->condition('guid.bundle','common_content');
    $query->condition('n.type','common_content');
    $query->condition('guid.field_guid_value',$all_guids_arr, 'IN');
    $data = $query->execute();
    $results = $data->fetchAll(\PDO::FETCH_OBJ);
    if (count($results)) {
      foreach ($results as $value) {
        $existing_guids[$value->field_guid_value] = $value->field_guid_value;
        $existing_guid_nids[$value->entity_id] = $value->field_guid_value;
        $existing_guids = array_unique(array_values($existing_guids));
      }
    }
    if (count($all_guids_arr) != count($existing_guids)) {
       $guids_diff = array_diff($all_guids_arr, $existing_guids);
       $guids_intersect = array_intersect($all_guids_arr, $existing_guids);
    }



  $arr_taxonomy = array();
  //-------------taxonomy array---------
  $xml_tag = explode(",",$xml_tags);
  $tag_val = array();
  $tag_val_arr = array();
  foreach( $xml_tag as $xml_tag_key ){
    $tag_val = explode(":", $xml_tag_key);
    $tag_val_arr[$tag_val[0]] = $tag_val;
  }
  foreach ($xml_str->channel->item as $entry) {
    $part_guid = $entry->guid;
    $guid = explode(':',$part_guid[0])[4];


      $teaser = "";
      //fetch Title, Desc, Auth, Link
      $title = trim($entry->title);
      $desc = $entry->description;
      $author = $entry->author;
      $creator_xml_obj = $entry->children('http://www.idgns.com/rss');
      $creator_arry = objectsIntoArray1($creator_xml_obj);
      $creator = $creator_arry['creator'];
      $image_xml_obj = $entry->children('http://search.yahoo.com/mrss/')->content->attributes();;
      $image_arry = objectsIntoArray1($image_xml_obj);
      $image = $image_arry['@attributes']['url'];
      $link = strip_tags($entry->link);
      //$link = 'https://www.idgns.com/feeds/partner/idgns/article.do?id=2439495';
      $headers = get_headers($link);
      $headerstest = substr($headers[0], 9, 3);
      if ($headerstest == '200') {
        try {
          $response = \Drupal::httpClient()->get($link, array('headers' => array('Accept' => 'text/plain')));
          $data = (string) $response->getBody();
          if (empty($data)) {
            return TRUE;
          }
        }
        catch (RequestException $e) {
          watchdog_exception('idg_xml', $e->getMessage());
        }
      }

      $idg_url = $data;
      $node_xml = simplexml_load_string($idg_url,'SimpleXMLElement',LIBXML_NOCDATA);
      $start_index = strpos($idg_url,'<section class="page">')+22;
      $end_index = strlen($idg_url) - strrpos($idg_url,"</section>");
      $node_body_complete_1 = substr($idg_url,$start_index,-1*$end_index);

      $node_body_complete_2 = str_replace('</section>','',$node_body_complete_1); // removed if more than one sections tag are coming
      $node_body_complete = str_replace('<section class="page">','',$node_body_complete_2); // removed if more than one sections tag are coming
      $xml_node_arr =  objectsIntoArray1($node_xml);
      $xml_data_taxo_arr = array();
      $xml_node_cat = array();
      $xml_data_taxo_str ="";
      $xml_data_taxo = $xml_node_arr["contentitem"]["contentmetadata"]["classification"]["taxonomy"][0][$tag_val_arr["taxonomy"][1]];
      $xml_data_taxo = ( $xml_data_taxo ) ? $xml_data_taxo : $xml_node_arr["contentitem"]["contentmetadata"]["classification"]["taxonomy"][$tag_val_arr["taxonomy"][1]];
      $resource = $xml_node_arr["contentitem"]["contentmetadata"]["creator"]["orgref"]['@attributes']['resource'];
      $data = explode(":",$resource);
      $subject_type = $xml_node_arr["contentitem"]["contentmetadata"]["subject"]["subjecttype"];
      $creator = $data[2];
      $image_url = "";
      if(isset($image)) {
        $image_url = $image;
      }
      $keyword = $xml_node_arr["contentitem"]["contentmetadata"]["classification"]["keyword"];
      $keyword =  implode(" , ",$keyword);
      //subjecttype start
      $contentType = $xml_node_arr["contentitem"]["contentmetadata"]["subject"]["subjecttype"];
      $contentType = strtolower($contentType);
      if ( preg_match('/\s/',$contentType) ){
        $contentType = str_replace(' ', '_', $contentType);
      }
      if (strpos($contentType,'-') !== false) {
        $contentType = str_replace('-', '_', $contentType);
      }
      //subjecttype end
      if( is_array( $xml_data_taxo ) )
        foreach( $xml_data_taxo as $xml_data_taxo_key )
          $xml_data_taxo_str .= trim( $xml_data_taxo_key )."@";
      else
        $xml_data_taxo_str = $xml_data_taxo;
        $str_pos = strripos($xml_data_taxo_str,"@");
        if( $str_pos > 0 ){
          $xml_data_taxo_str = substr_replace( $xml_data_taxo_str , "" , strripos($xml_data_taxo_str,"@") );
          $xml_data_taxo_arr = explode( "@", $xml_data_taxo_str );
          $xml_data_taxo_arr = array_unique( $xml_data_taxo_arr );
        }else{
          $xml_data_taxo_arr = explode("@",$xml_data_taxo_str);
        }
        $taxo_arr = array();
        $arr_taxonomy = array();
        foreach( $xml_data_taxo_arr as $cat_arr_val ){
          $taxo_arr = explode( '/' , $cat_arr_val );
          foreach ( $taxo_arr as $tax ){
            $arr_taxonomy[] = $tax;
          }
        }
        foreach ($arr_taxonomy as $key => $value) {
        $arr_taxonomy = array_unique($arr_taxonomy);
        $query = $connection->select('taxonomy_term_field_data', 'ttfd');
        $query->fields('ttfd',array('tid'));
        $query->condition('ttfd.vid', 'idg_new_taxonomy');
        $query->condition('ttfd.name', $value);
        $data = $query->execute();
        $results = $data->fetchAll(\PDO::FETCH_OBJ);
        foreach ($results as $row) {
          $xml_node_cat[] = $row->tid;
        }
      }
        // $arr_taxonomy = array_unique($arr_taxonomy);
        // $query = $connection->select('taxonomy_term_field_data', 'ttfd');
        // $query->fields('ttfd',array('tid'));
        // $query->condition('ttfd.vid', 'idg_new_taxonomy');
        // $query->condition('ttfd.name', $cat_arr_val);
        // $data = $query->execute();
        // $results = $data->fetchAll(\PDO::FETCH_OBJ);
        // foreach ($results as $row) {
        //   $xml_node_cat[] = $row->tid;
        // }

        // Original URL
        $org_url = $xml_node_arr["contentitem"]["altguid"]['@attributes']['guid'];
        $guid_versions = explode(":",$xml_node_arr["contentitem"]['@attributes']['guid']);
        $guid_version = '';
        $guid_version = $guid_versions[5];
        $idgns_guid_version = $guid_versions[5];
        if(!empty($image_url)) {
          $image_url = $image_url;
        }
        $query2 = $connection->select('node__field_new_guid', 'fng');
        $query2->fields('fng',array('field_new_guid_value'));
        $data1 = $query->execute();
        $results2 = $data1->fetchAll(\PDO::FETCH_OBJ);
        foreach ($results as $row) {
          $new_guid = $row->tid;
        }
        switch ($subject_type) {
          case 'Reviews':
            $subject_type = 'Product Review';
          break;
          case 'Research':
          case 'Best Practice':
            $subject_type = 'Feature';
          break;
          case 'Tip':
            $subject_type = 'How-to';
          break;
          case 'News Analysis':
            $subject_type = 'Analysis';
          break;
          default:
          $subject_type = $subject_type;
        }

        // $query1 = $connection->select('taxonomy_term_field_data', 'ttfd')
        // ->fields('ttfd',array('tid'));
        // $query1->condition('ttfd.vid', 'content_category');
        // $query1->condition('ttfd.name', $subject_type);
        // $data2 = $query1->execute();
        // $results2 = $data2->fetchAll(\PDO::FETCH_OBJ);
        // if ($results2[0]->tid) {
        //   $tid = $results2[0]->tid;
        // }

       $tid = getTidByName($subject_type,'content_category');

        //---------------teaser
        if (isset($xml_node_arr['contentitem']['head']['hl2']) && !empty($xml_node_arr['contentitem']['head']['hl2'])) {
          $teaser = $xml_node_arr['contentitem']['head']['hl2'];
        } else {
          $teaser = $xml_node_arr['contentitem']['head']['abstract'];
        }
      $date = REQUEST_TIME;
      if (in_array($guid, $guids_diff)) {
        $values = array(
          'nid' => NULL,
          'type' => 'common_content',
          'status' => TRUE,
          'uid' => 56,
          'title' => $title,
          'field_author_name' => trim($xml_node_arr['contentitem']['head'][$tag_val_arr["authour"][1]]),
          'field_guid' => $guid,
          'field_guid_version' => $idgns_guid_version,
          'field_teaser' => $desc,
          'body' => ['value' => $node_body_complete, 'format' => 'full_html'],//$body_str;
          'field_idgns_image_url' => $image_url,
          'idg_new_taxonomy' => (!empty($xml_node_cat)) ? $xml_node_cat : 500,
          'content_category' => $tid,
          'field_metatags' => serialize(['keywords' => $keyword]),
          'field_org_ref' => $creator, //Original reference
          'field_org_type' => $contentType, //Original Type
          'field_org_url' => $org_url, //Original URL
          // 'field_new_guid' => $new_guid_value,
          'field_select_agency' => 1620,
          'field_select_company' => 1624,
          'field_hidden_agency_name' => 'IDG',
          'field_hidden_company_name' => 'IDG NS',
          'field_first_publish_date' => $date,
        );
        $no = '';
       $node = entity_create('node', $values);
       $node->save();
        if($node){
          drupal_set_message(t('Import from IDGNS completed'));
           $output .= "Added &nbsp;".$title ."<br/>";
        }

        $fetch_news_count++;
        unset($node);
        unset($xml_node_cat);
      }
      else {
        if (in_array($guid, $guids_intersect)) {
          $nid = array_search($guid, $existing_guid_nids);
          $node = \Drupal\node\Entity\Node::load($nid);
          $idgns_guid_existing_version = 0;
          $idgns_guid_existing_version = $node->get('field_guid_version')->value;
          if ($idgns_guid_existing_version && (+$idgns_guid_version != $idgns_guid_existing_version)) {
            $node->set("title", $title);
            $node->set("field_author_name", trim($xml_node_arr['contentitem']['head'][$tag_val_arr["authour"][1]]));
            $node->set("field_guid", $guid);
            $node->set("field_guid_version", $idgns_guid_version);
            $node->set("field_teaser", $desc);
            $node->set("field_idgns_image_url", $image_url);
            $node->set("body", array('value' => $node_body_complete, 'format' => 'full_html'));
            $node->set("idg_new_taxonomy", $xml_node_cat);
            $node->set("content_category", $tid);
            $node->set("field_metatags", serialize(['keywords' => $keyword]));
            $node->set("field_org_ref", $creator);
            $node->set("field_org_type", $contentType);
            $node->set("field_org_url", $org_url);
            $node->set("field_select_agency", 1620);
            $node->set("field_select_company", 1624);
            $node->set("field_hidden_agency_name", 'IDG');
            $node->set("field_hidden_company_name", 'IDG NS');
            $node->save();
            $output .= "Updated &nbsp;" . $title  ."<br/>";
          }
        }
       //  else {
       //    $output .= "Already imported &nbsp; " . $title . "<br/>";
       // }

    }
      $no++;
    }
    $output .= "Content from IDGNS feed has been imported successfully";
    // $import_end_time = time();
    // $fetch_log_content   = $import_start_time."\t".$import_end_time."\t".$fetch_news_count."\n";
    // $fetch_news_log_file = fopen("fetch-news-log.txt","a");
    // fwrite ( $fetch_news_log_file , $fetch_log_content );
    // fclose ( $fetch_news_log_file );
      //return $output;
    return array(
      '#title' => 'Import IDGNS XML',
      '#markup' => $output,
    );
  }//close function create_news()
}//close class();
