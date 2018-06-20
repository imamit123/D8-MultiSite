<?php

   namespace Drupal\idg_custom\Controller;

     //------------------------------------------------------------------//
   use Symfony\Component\HttpFoundation\Request;
   use Symfony\Component\HttpFoundation\JsonResponse;
   use Drupal\node\Entity\Node;
   use Drupal\node\NodeInterface;
  //-------------------------------------------------------------------//

   class WebformSubmission {

      /* fucntion to download file on webform submission */
       
            /* fucntion to download file on webform submission */
       
      public function WebformFileDownload(){
        global $base_url;
        $previousUrl = \Drupal::request()->server->get('HTTP_REFERER');
        $return = array();
        if (!empty($previousUrl)) {
          $previousUrl = urldecode($previousUrl);
          $path_alias = str_replace($base_url, '', $previousUrl);
          $node_original_url = \Drupal::service('path.alias_manager')->getPathByAlias($path_alias);
          $nid = explode('/', rtrim(ltrim($node_original_url, '/'), '/'));
          $nid = $nid[1];
          if (is_numeric($nid)) {
            $node = Node::load($nid);
            if (!$node->field_file_attachments->entity){
              $return = array('#type' => 'markup', '#markup' => "<div class='thank-you'>Thank you for your registration.</div><a class='download-btn' href=$previousUrl> Go Back</a>");
            } 
            else {
              $mimetype = $node->field_file_attachments->entity->getMimeType();
              if ($mimetype == 'application/pdf') {
                $fid = $node->field_file_attachments->getValue()[0]['target_id'];
                if ($fid) {
                  $file_download_url = $base_url . '/file-download/download/public/' . $fid;
                  $return = array('#type' => 'markup', '#markup' => "<div class='thank-you'>Thank you for your registration. Please click below to download.</div><a class='download-btn' href=$file_download_url>Download</a>");
                }
              }
              else{
                $return = array('#type' => 'markup', '#markup' => "<div class='thank-you'>Thank you for your registration.</div><a class='download-btn' href=$previousUrl> Go Back</a>");
              }
            }
          }
        }
        return $return; 
      }
 }
