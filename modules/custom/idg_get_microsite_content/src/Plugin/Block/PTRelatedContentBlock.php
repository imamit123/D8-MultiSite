<?php
/**
 * @file
 * Contains \Drupal\idg_get_microsite_content\Plugin\Block\GoogleAdsEighth.
 */
namespace Drupal\idg_get_microsite_content\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use \Drupal\Core\Entity\EntityInterface;
use Drupal\node\Entity\Node;
use Drupal\taxonomy\Entity\Term;
use Drupal\Core\Database\Database;
use Drupal\image\Entity\ImageStyle;
use Drupal\Core\Url;
/**
 * Provides a 'PTRelatedContent' Block.
 * @Block(
 *   id = "partner_tab_related_content_block",
 *   admin_label = @Translation("partner tab Related Content block"),
 * )
 */

class PTRelatedContentBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $node = \Drupal::routeMatch()->getParameter('node');
    $nid = $node->id();
    if(isset($nid)){
      $node = Node::load($nid);
      if ($node->getType() == 'common_content') {
        $ptr =  $node->field_partner_tab_reference->target_id;
        $query = db_select('node__field_partner_tab_reference', 'ptr')
          ->condition('ptr.field_partner_tab_reference_target_id', $ptr)
          ->condition('ptr.bundle', 'common_content')
          ->condition('ptr.entity_id', $nid,'!=');
        $query->fields('ptr', array('entity_id'));
        $result_nid = $query->execute()->fetchAll();
        foreach ($result_nid as $key => $value) {
          $node_id = $value->entity_id;
          $refNode = Node::load($node_id);
          $title = $refNode->getTitle();
          $title1 = \Drupal::l($title, Url::fromUri('internal:/node/'.$nid));
          $image = $refNode->field_home_page_image->target_id;
          if (!empty($refNode->field_home_page_image->entity)) {
            $styled_image_url = ImageStyle::load('partner_content_homepage')->buildUrl($refNode->field_home_page_image->entity->getFileUri());
          }
        $alias = \Drupal::service('path.alias_manager')->getAliasByPath('/node/'.$node_id);
        $vars[$node_id] = ['title' =>['#markup' => $title,],'image' => ['#markup' => $styled_image_url,],'alias' => ['#markup' => $alias,]];
        }
      }
    }
  return [
      '#cache' => array('max-age' => 0),
      '#theme' => 'pt_related_content',
      '#variable' => $vars,
    ];
  }
}




