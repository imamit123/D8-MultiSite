<?php

  namespace Drupal\block_syndication\Controller;
  use Drupal\node\Entity\Node;
  use Drupal\Core\Database\Database;
  use Drupal\taxonomy\Entity\Term;

class BlockContentSyndication {
  public function block_syndication() {
    $serverreff = $_SERVER['HTTP_REFERER'];
    $serverreff  = explode("/",$serverreff);
    if ($serverreff[3] == 'node' && $serverreff[4] == 'add' && $serverreff[5] == 'editors_pick') {
      //Fetch Latest node form editors pick content Type
      $query = \Drupal::entityQuery('node')
        ->condition('status', 1)
        ->condition('type', 'editors_pick');
        $nids = $query->execute();
        $nid = max($nids);
      }elseif ($serverreff[3] == 'node' && ($serverreff[5] == 'edit' || $serverreff[5] == 'edit?destination=')) {
        $nid = $serverreff[4];
      }
    $serverName = 'http://'.$_SERVER['SERVER_NAME'];
    $entity_type = 'node';
    $view_mode = 'teaser';
    //Load node
    $view_builder = \Drupal::entityTypeManager()->getViewBuilder($entity_type);
    $storage = \Drupal::entityTypeManager()->getStorage($entity_type);
    $node = $storage->load($nid);
    $build = $view_builder->view($node, $view_mode);
    $output = render($build);
    $title = $node->get('title')->value;
    //Get Rest Block response form fields
    $block_response = $node->get('field_block_response')->value;
    if ($block_response) {
      $arr_block_response = explode(",", $block_response);
    }
    $output = str_replace(['<h2 class="block-title">','<a href="', "/sites"], ['<h2 class="block-title" style="display:none;">','<a href="'.$serverName, $serverName."/sites"], $output);

    //Get Current Site Url.
    $current_site = 'http://'.$_SERVER['HTTP_HOST'];
    //Get all term value from idg_sites term
    $vid = 'idg_sites'; //name of your vocabulary
    $terms =\Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadTree($vid);
      foreach ($terms as $term1) {
        $term = Term::load($term1->tid);
        $url = $term->get('field_site_url')->getValue()[0]['value'];
        $username = $term->get('field_user_name')->getValue()[0]['value'];
        $pass = $term->get('field_user_password')->getValue()[0]['value'];
        $site_type = $term->get('field_site_type')->getValue()[0]['value'];
        if ($site_type != 'Parent') {
          $term_data[$url] = array(
              "id" => $term1->tid,
              "name" => $term1->name,
              "url" => $url,
              "username" => $username,
              "password" => $pass,
              "type" => $site_type,
        );

        }
      }
  //Unset current site url and null values
  unset($term_data[$current_site]);
  unset($term_data[null]);

//Block syndication when node create
  if (!empty($term_data)) {
    foreach ($term_data as $key => $value) {
      $url = $value['url'];
      $uname = $value['username'];
      $pass = $value['password'];
      if ($node->get('field_publish_site')->value == 1 && !isset($arr_block_response)) {
        //Json encode value title and body from node when editer pick node create
        $json_encode = json_encode([
          'info' => [['value' => $title]],
          'body' => [['value' => $output,'format' => 'full_html']],
          '_links' => ['type' => [
          'href' => $url . '/rest/type/block_content/basic'
          ]]
        ]);

        //Node create when rest api get json responce.
        $response1 = \Drupal::httpClient()
        ->post($url.'/entity/block_content?_format=hal_json', [
          'auth' => [$uname, $pass],
          'body' => $json_encode,
          'headers' => [
          'Content-Type' => 'application/hal+json'
          ],
        ]);
        //After create node responce store.
        if (isset($response1)) {
          $response_arr[] = $response1;
        }
      }elseif($node->get('field_publish_site')->value == 1 && isset($arr_block_response)) {
        foreach ($arr_block_response as $key => $value) {
           $url_value  = explode("/",$value);
           $full_url_value = 'http://'.$url_value[2];
          //Block update when node update.
          $json_encode = json_encode([
          'info' => [['value' => $title]],
          'body' => [['value' => $output,'format' => 'full_html']],
          '_links' => ['type' => [
          'href' => $full_url_value . '/rest/type/block_content/basic'
          ]]
        ]);

          $response2 = \Drupal::httpClient()
            ->patch($value.'?_format=hal_json', [
              'auth' => [$uname, $pass],
              'body' => $json_encode,
              'headers' => [
              'Content-Type' => 'application/hal+json'
            ],
          ]);
        }//foreach
      }//block responce
    }//foreach
  }//term_data
  if (!empty($response_arr)) {
    foreach ($response_arr as $key => $value) {
      //get rest responce and update node.
      $response_arr_value = (array) $value;
      $response_location_value = array_column($response_arr_value,'Location');
      $response_location_arr[] = $response_location_value[0][0];
    }
      $response_location =  implode(",",$response_location_arr);
      $node1 = \Drupal\node\Entity\Node::load($nid);
      $node1->set("field_block_response",$response_location);
      $node1->save();
    }
  $alias = \Drupal::service('path.alias_manager')->getAliasByPath('/node/'.$nid);
  return new \Symfony\Component\HttpFoundation\RedirectResponse($alias);
  }
}
