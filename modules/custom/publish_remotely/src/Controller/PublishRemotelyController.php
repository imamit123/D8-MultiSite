<?php
  namespace Drupal\publish_remotely\Controller;
  use Drupal\node\Entity\Node;
  use Drupal\Core\Database\Database;

class PublishRemotelyController {
  public function publish_remotely() {
  //return  array('#prefix' => 'hello' );
  $connection = Database::getConnection();
  $uri = 'http://localhost/idg-d8/api/v-1/copy_content/168142';
    $response = \Drupal::httpClient()->get($uri, array('headers' => array('Accept' => 'text/plain')));
    $data = (string) $response->getBody();
    $output = json_decode($data);
    //print_r($output);die();
    //echo '<pre>';print_r($output);die();
  print_r($output[0]->content_category[0]);die();
    /*if (empty($data)) {
      return FALSE;
    }*/
$serialized_entity = json_encode([
  'title' => [['value' => $output[0]->title[0]->value]],
  'type' => [['target_id' => 'common_content']],
  //'field_about_person' => [['value' => $output[0]->field_about_person[0]->value]],--missing field
  //'field_author_profile_name' => [['value' => $output[0]['field_author_profile_name']]],
 //'field_channelworld_url' => [['value' => $output[0]->field_computerworld_url[0]->value]], --missing field
  //'cio_case_study_industry_vertical' => [['target_id' => $output[0]->cio_case_study_industry_vertical[0]->target_id]],
  //'cio_case_study_technology' => [['target_id' => $output[0]->cio_case_study_technology[0]->target_id]],
  //'field_cio_url' => [['value' => $output[0]->field_cio_url[0]->value]],-- missing field
 //'field_company' => [['value' => $output[0]->field_company[0]->value]],--missing field
  //'field_computerworld_url' => [['value' => $output[0]->field_computerworld_url[0]->value]], --missing field
  //'field_cso_url' => [['value' => $output[0]->field_cso_url[0]->value]],--missing field
  //'field_design' => [['value' => $output[0]->field_design[0]->value]],-- missing field
  //'field_detail_video_script' => [['value' => $output[0]->field_detail_video_script[0]->value]],--missing field
  //'field_edited_by' => [['target_id' => $output[0]->field_edited_by[0]->target_id]],
  //'field_guid_version' => [['value' => $output[0]->field_guid_version[0]->value]],--missing field
  //'field_hidden_agency_name' => [['value' => $output[0]->field_hidden_agency_name[0]->value]],
  //'field_hidden_company_name' => [['value' => $output[0]->field_hidden_company_name[0]->value]],
  //'field_home_page_image' => [['value' => $output[0]['field_home_page_image']]],
  'field_video_script' => [['value' => $output[0]->field_video_script[0]->value]],
  'field_local_guid' => [['value' => $output[0]->field_local_guid[0]->value]],
  'idg_new_taxonomy' => [['target_id' => 42]],
  //'field_guid' => [['value' => $output[0]->field_guid[0]->value]],
  'body' => [['value' => $output[0]->body[0]->value]],
  //'field_author_name' => [['value' => $output[0]->field_author_name[0]->value]],
  'content_category' => [['target_id' => 6]],
  //'field_idgns_image_url' => [['value' => $output[0]->field_idgns_image_url[0]->value]],
  'field_image_credit' => [['value' => $output[0]->field_image_credit[0]->value]],
  //'it_road_map' => [['target_id' => $output[0]->it_road_map[0]->target_id]],
  'field_new_guid' => [['value' => $output[0]->field_new_guid[0]->value]],
  //'field_nwsl_teaser' => [['value' => $output[0]->field_nwsl_teaser[0]->value]],
  'field_nwsl_title' => [['value' => $output[0]->field_nwsl_title[0]->value]],
  'field_org_ref' => [['value' => $output[0]->field_org_ref[0]->value]],
  'field_org_type' => [['value' => $output[0]->field_org_ref[0]->value]],
  'field_org_type' => [['value' => $output[0]->field_org_type[0]->value]],
  'field_org_url' => [['value' => $output[0]->field_org_url[0]->value]],
  //'field_person_name' => [['value' => $output[0]->field_person_name[0]->value]],
  //'field_quote' => [['value' => $output[0]->field_quote[0]->value]],
  'field_sponsored' => [['value' => $output[0]->field_sponsored[0]->value]],
  'field_teaser' => [['value' => $output[0]->field_teaser[0]->value]],
  '_links' => ['type' => [
      'href' => 'http://local-cio.gailabs.com/rest/type/node/common_content'
  ]],
]);
//echo '<pre>' ;print_r($serialized_entity);die();
$response1 = \Drupal::httpClient()
  ->post('http://local-cio.gailabs.com/entity/node?_format=hal_json', [
    'auth' => ['admin', 'admin123'],
    'body' => $serialized_entity,
    'headers' => [
      'Content-Type' => 'application/hal+json'
    ],
  ]);
  return array('#prefix' => 'Done');
}
}