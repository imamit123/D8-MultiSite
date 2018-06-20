<?php

namespace Drupal\idg_gen_newsletter\Controller;
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

  class CreateNewsletterController extends ControllerBase {

    public function get_newsl_content() {
      $connection = Database::getConnection();
      //Get NID from node field value
      $node_string = str_replace(array('"', "'"), '', $_REQUEST['node']);
      $nid = substr(end(explode('(', $node_string)),0,-1);
      //$nid = substr($_REQUEST['node'],strrpos ( $_REQUEST['node'],'(',  1)+1,-1);
      // $nid = $_REQUEST['node'];
      if($nid){
        $content_node = Node::load($nid);
      }
      $newsletter_type = $_REQUEST['type'];
      if($newsletter_type != '_none'){
        $tax = \Drupal\taxonomy\Entity\Term::load($newsletter_type);
        $sites_array = $tax->get('field_content_sites');
        foreach ($sites_array as $site) {
          $site_tax = \Drupal\taxonomy\Entity\Term::load($site->target_id);
          $site_name = $site_tax->Label();
          $url_field = $site_tax->get('field_site_url_field')->value;
          if($content_node->hasField($url_field)){
            $site_url = $content_node->get($url_field)->value;
            if(!empty($site_url)){
              $sites[$site_url] = $site_name;
            }
          }
        }
      }

      if($content_node->get('field_nwsl_title')->value){
        $newsletter_title = $content_node->get('field_nwsl_title')->value;
      }else{
        $newsletter_title = $content_node->Label();
      }

      if($content_node->get('field_nwsl_teaser')->value){
        $newsletter_teaser = $content_node->get('field_nwsl_teaser')->value;
      }else{
        $newsletter_teaser = $content_node->get('field_teaser')->value;
      }
      $news_strap_line = $content_node->get('field_news_strap_line')->value;
      $guid = $content_node->get('field_new_guid')->value;
      //create return response
      $response = new Response();
      $response->setContent(json_encode(array('title' => $newsletter_title, 'teaser' => strip_tags($newsletter_teaser), 'urls' => $sites, 'GUID' => $guid, 'strap_text'=> $news_strap_line, )));
      $response->headers->set('Content-Type', 'application/json');
      return $response;
    }
  }//close class();