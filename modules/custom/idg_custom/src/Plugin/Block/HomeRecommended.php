<?php
/**
 * @file
 * Contains \Drupal\idg_custom\Plugin\Block\HomeRecommended.
 */

namespace Drupal\idg_custom\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use \Drupal\Core\Entity\EntityInterface;
use Drupal\node\Entity\Node;
use Drupal\taxonomy\Entity\Term;
use Drupal\Core\Database\Database;
/**
 * Provides a 'ads' Block.
 * @Block(
 *   id = "home_recommended",
 *   admin_label = @Translation("Home Recommended"),
 * )
 */
class HomeRecommended extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    global $base_url;
    if (preg_match("/cio/", $base_url)){
      $taxonomy = "['CIO.in','news','features','opinions','ceo interviews','case studies','slideshows','strategy guides','videos','opinions','articles','cio interviews']";
      $url = 'CIO.in';
    }elseif (preg_match("/channelworld/", $base_url)) {
      $taxonomy = "['channelworld.in','news','features','opinions','interviews','case studies','slideshows','howto','videos']";
      $url = 'ChannelWorld.in';
    }elseif (preg_match("/computerworld/", $base_url)) {
     $taxonomy = "['computerworld.in','news','features','opinions','interviews','case studies','slideshows','howto','videos']";
      $url = 'ComputerWorld.in';
    }elseif (preg_match("/csoonline/", $base_url)) {
      $taxonomy = "['CSOonline.in','security','news','articles','interviews','opinions','slideshows','videos']";
      $url = 'CSOonline.in';
    }
    $is_front_page = \Drupal::service('path.matcher')->isFrontPage();
    $node = \Drupal::routeMatch()->getParameter('node');
    $current_path = \Drupal::request()->getRequestUri();
    $explode = explode('/', $current_path);
     
    if (isset($explode[1]) && !isset($explode[2])) {
        $string = trim($explode[1]) . '_door';
      }

    if (isset($explode[1]) && isset($explode[2])) {
        $string = trim($explode[2]) . '_door';
      }   

    if (isset($node)){
          $node_type = $node->gettype();
          if($node_type == 'home_page') {
                   $string = 'home_door';
                   }  
          if($node_type == 'computerworld_homepage_content') {
                   $string = 'home_door';
                   }              
          if (isset($explode[1]) && isset($explode[2])) {

             if(isset($node->get('field_google_ads_tagname')->value) && !empty($node->get('field_google_ads_tagname')->value)) {
                  $string = $node->get('field_google_ads_tagname')->value;
                  } else { 
                    $string = trim($explode[1]) . '_section';
                          }
                  
            }
      } 
    $path = $url;
    $variable = $string;
    //  //Add code for taxonomy in ads
    $current_path = \Drupal::service('path.current')->getPath();
    $explode = explode('/', $current_path);
    if (isset($explode[1]) && isset($explode[2]  )) {
      if($explode[1] == 'node'){
        $node_original_url = \Drupal::service('path.alias_manager')->getPathByAlias($current_path);
        $nid = explode('/', rtrim(ltrim($node_original_url, '/'), '/'));
        $nid = $nid[1];
        $node = Node::load($nid);

        $query = db_select('node', 'm')  //Db query to check nid exist.
                ->condition('nid', $nid);
        $query->fields('m', array('nid'));
        $result_nid = $query->execute()->fetchAll();
        if ($result_nid) {
          if ($node->hasField('field_new_idg_taxonomy') && $node->hasField('field_common_category')) {
            $node_field_taxonomy =  $node->get('field_new_idg_taxonomy')->getValue();
            $common_category =  $node->get('field_common_category')->getValue();
            $common_tid = $common_category[0]['target_id'];
            $common_tname = Term::load($common_tid);
            $name = $common_tname->getName();
            foreach ($node_field_taxonomy as $value) {
              $tid = $value['target_id'];
              $term = Term::load($tid);
              $tid_name .= "'" .$term->getName(). "'".',';
              $tid_list = rtrim($tid_name, ',');
             // $tid_list = '\'' .$tid_list. '\'';
             // $a = ['\'' . $b . '\''];
            }
            $string1 = '['.$tid_list.']';//Dynamic Taxonomies.
          }
          else{
            $string1 = $taxonomy;
          }
        }
          else{
            $string1 = $taxonomy;
          }
      }else{
            $string1 = $taxonomy;
          }
    }
      else if (isset($explode[1]) && !isset($explode[2])) {
        $string1 = $taxonomy;//Static Taxonomies.
      }
      $var1 = $string1;
    return [
      '#cache' => array('max-age' => 0),
      '#theme' => 'home_recommended',
      '#variable' => $variable,
      '#path' => $path,
      '#var1' => $var1,
    ];
  }
}




