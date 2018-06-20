<?php
/**
 * @file
 * Contains \Drupal\idg_custom\Plugin\Block\GoogleAdsKaiads.
 */

namespace Drupal\idg_custom\Plugin\Block;
use \Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Block\BlockBase;
use Drupal\node\Entity\Node;
use Drupal\taxonomy\Entity\Term;
use Drupal\Core\Database\Database;
/**
 * Provides a 'CSE' Block.
 * @Block(
 *   id = "google_ads_kaiads",
 *   admin_label = @Translation("kai ads."),
 * )
 */
class GoogleAdsKaiads extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $con =\Drupal\Core\Database\Database::getConnection();
    global $base_url;
    if (preg_match("/cio/", $base_url)){
      $url = 'CIO.in';
      $taxonomy = '[CIO.in,news,features,opinions,ceo interviews,case studies,slideshows,strategy guides,videos,opinions,articles,cio interviews]';
      $bkid = 'bk_doJSTag(19313, 4)';
    }
    elseif (preg_match("/channelworld/", $base_url)) {
      $url = 'channelworld.in';
      $taxonomy = '[channelworld.in,news,features,opinions,interviews,case studies,slideshows,howto,videos]';
      $bkid = 'bk_doJSTag(19319, 4)';
    }
    elseif (preg_match("/computerworld/", $base_url)) {
      $url = 'computerworld.in';
      $taxonomy = '[computerworld.in,news,features,opinions,interviews,case studies,slideshows,howto,videos]';
       $bkid = 'bk_doJSTag(19317, 4)';
    }
    elseif (preg_match("/csoonline/", $base_url)) {
      $url = 'CSOonline.in';
      $taxonomy = '[CSOonline.in,security,news,articles,interviews,opinions,slideshows,videos]';
      $bkid = 'BKTAG.doTag(35434, 1)';
    }
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
              $tid_name .= $term->getName().',';
              $tid_list = rtrim($tid_name, ','); 
            }
            $string = '['.$name.','.$tid_list.']';//Dynamic Taxonomies.
          }
          else{
            $string = $taxonomy;
          }
        }
          else{
            $string = $taxonomy;
          }
      }else{
            $string = $taxonomy;
          }
    }
      else if (isset($explode[1]) && !isset($explode[2])) {
        $string = $taxonomy;//Static Taxonomies.
      }
      $variable = $string;
      return [
      '#cache' => array('max-age' => 0),
      '#theme' => 'google_ads_kaiads',
      '#variable' => $variable,
      '#bkid' => $bkid,
      ];
  }
}




