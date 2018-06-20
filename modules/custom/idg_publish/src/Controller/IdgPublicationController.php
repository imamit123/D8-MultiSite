<?php
  namespace Drupal\idg_publish\Controller;
  use Drupal\node\Entity\Node;
  use Drupal\Core\Database\Database;
  use Drupal\block\Entity\Block;
  use Drupal\Core\Database\DatabaseDatabase;

class IdgPublicationController {
  public function idg_publish_path() {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    echo "<pre>";
    $host = \Drupal::request()->getHost();
    $host = 'http://'.$host;
    $connection = Database::getConnection();
    $query = $connection->select('node', 'n');//ORDER BY
    $query->fields('n',array('nid','type'));
   // $query->fields('g',array('entity_id', 'field_guid_value'));
    $query->fields('nfd',array('title'));
    $query->addJoin('inner','node_field_data','nfd','nfd.nid = n.nid');
    $query->addJoin('left','node__field_first_publish_date','nfpd','nfpd.entity_id = n.nid');
   // $query->addJoin('inner','node__field_guid','g','g.entity_id = n.nid');
    $query->condition('n.type','common_content');
   // $query->condition('g.bundle','common_content');
    $query->condition('nfpd.entity_id',NULL, 'IS NULL');
   // $query->range(0, 10);
    $data = $query->execute()->fetchAll();
   if (count($data)) {
      foreach ($data as $value) {
        $d8_nids[$value->nid] = $value->nid;
       // $title = explode(',', $value->title);
        $d8_title[$value->nid] = $title[0];
      }
    }
    //print_r($d8_title);die();
   // echo count($d8_title); die();
      \Drupal\Core\Database\Database::setActiveConnection('legacy');

if (count($data)) {
      foreach ($data as $key => $value) {
        $d8_nids[$value->nid] = $value->nid;
        $d8_title[$value->nid] = $value->title;
        $title = explode(',', $value->title);
         $connection = \Drupal\Core\Database\Database::getConnection();
   // Get a connection going
    $query_d6 = $connection->select('node', 'n');//ORDER BY
    $query_d6->fields('n',array('nid','type','created','title'));
   // $query_d6->condition('n.type','common_content');
   // $query_d6->condition('n.type','common_content_type');
    $query_d6->condition('n.nid', $value->nid);
    $query_d6->condition('n.title', '%'.$title[0] .'%', 'LIKE');
  //  $query_d6->range(0, 10);
    $data_d6[$key] = $query_d6->execute()->fetchAll();
    }
  }

 $d6_value_string = '';
 foreach ($data_d6 as $key => $value) {
        if (array_key_exists('0', $value)) {
       $d6_value[] = array('nid' => $value[0]->nid,'created'=> $value[0]->created);
       $d6_value_string .= 'nid-'.$value[0]->nid . ' created-'.$value[0]->created. ',';
    }
  }
echo $d6_value_string;
$final_arr = [];
$d6_value_string_explode = explode(',', $d6_value_string);
foreach ($d6_value_string_explode as $key => $value) {
  $value_explode = explode(' ',$value);
  $value_explode_nid = explode('-', $value_explode[0])[1];
  $value_explode_created = explode('-', $value_explode[1])[1];
  $final_arr[$key]['nid'] = $value_explode_nid;
  $final_arr[$key]['created'] = $value_explode_created;
}

//$array = array('nid' => '58069','created'=>'1442179788');

echo '<pre>';print_r($final_arr);


die();

 \Drupal\Core\Database\Database::setActiveConnection('default');
print_r($d6_value);


// die();

foreach ($d6_value as $key => $value) {
    $nid = $value['nid'];
    $created = $value['created'];
    $node = \Drupal\node\Entity\Node::load($nid);
    $node->set('field_first_publish_date', $created);
    $node->set('field_set_publish', 1);
    $node->save();
}

die();


    //Data come form d6 site.
  //  \Drupal\Core\Database\Database::setActiveConnection('legacy');
  //  // Get a connection going
  //   $connection = \Drupal\Core\Database\Database::getConnection();
  //   $query_d6 = $connection->select('node', 'n');//ORDER BY
  //   $query_d6->fields('n',array('nid','type','created'));
  //  // $query_d6->condition('n.type','common_content');
  //  // $query_d6->condition('n.type','common_content_type');
  //   $query_d6->condition('n.nid', $d8_nids , 'IN');
  //   $query_d6->condition('n.nid', $d8_title , 'LIKE');
  // //  $query_d6->range(0, 10);
  //   $data_d6 = $query_d6->execute()->fetchAll();
   // print_r($d8_nids);
    // if (count($data_d6)) {
    //   foreach ($data_d6 as $value) {
    //     $d6_nids[$value->nid] = $value->nid;
    //   }
    // }

    //Genrate CSV FILE.
    $filename = "sites/default/files/data.csv";
    $fp = fopen("sites/default/files/data.csv","wb");
    fputcsv($fp, array(t('Node Id'),t('Title'), t('Type'),t('Created Date')));
   // if (!empty($data_d6)) {
      foreach ($data_d6 as $key => $value) {
        if (array_key_exists('0', $value)) {
     // $source_d8 = $value->nid;
      //$alias_d8 = $value->alias;
      //$src_d6 = $host.$value->src;
      //$dst_d6 = '/'.$value->dst;
      //if($alias_d8 != $dst_d6){
        //$array = $host.$alias_d8.' # '. $host.$dst_d6;
       fputcsv($fp, array($value[0]->nid,$value[0]->title, $value[0]->type, $value[0]->created));
      //}
    }
  }
  fclose($fp);
  if(file_exists($filename)){
  //Get file type and set it as Content Type
  $finfo = finfo_open(FILEINFO_MIME_TYPE);
  header('Content-Type: ' . finfo_file($finfo, $filename));
  finfo_close($finfo);

  //Use Content-Disposition: attachment to specify the filename
  header('Content-Disposition: attachment; filename='.basename($filename));

  //No cache
  header('Expires: 0');
  header('Cache-Control: must-revalidate');
  header('Pragma: public');

  //Define file size
  header('Content-Length: ' . filesize($filename));

  ob_clean();
  flush();
  readfile($filename);
  exit;
  }
     return array(
      '#title' => 'A',
      '#markup' => 'CSV Ready for download',
    );
  }//close function create_news()
}//close class();
// onClick=”_gaq.push([‘_trackEvent’, ‘whitepaper’, ‘download’, ‘SEO is great’, 5, true]);”

// <a href=”/downloads/whitepapers/seo-is-great.pdf” onClick=”_gaq.push([‘_trackEvent’, ‘whitepaper’, ‘download’, ‘SEO is great’, 5, true]);” target=”_blank”>SEO Is Great Whitepaper</a>

// <a href=”#banner1″ onClick=”_gaq.push([‘_trackEvent’, ‘banner’, ‘internal link’, ‘banner 1’]);”>1</a>

// <a href=”/downloads/whitepapers/seo-is-great.pdf” onClick=”_gaq.push([‘_trackEvent’, ‘whitepaper’, ‘download’, ‘SEO is great’, 5, true]);” target=”_blank”>SEO Is Great Whitepaper</a>


// <a href=”https://twitter.com/koozai_anna” onClick=”_gaq.push([‘_trackEvent’, ‘social media’, ‘twitter’, ‘Koozai_Anna’]);” target=”_blank”>Koozai_Anna on Twitter</a>


// <a href=”https://en-gb.facebook.com/koozai” onClick=”_gaq.push([‘_trackEvent’, ‘social media’, ‘facebook’, ‘Koozai on Facebook’]);” target=”_blank”>Koozai on Facebook</a>

// <a href=”/downloads/whitepapers/seo-is-great.pdf” onClick=”_gaq.push([‘_trackEvent’, ‘whitepaper’, ‘download’, ‘SEO is great’, 5, true]);” target=”_blank”>SEO Is Great Whitepaper</a>
