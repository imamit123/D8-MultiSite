<?php

   namespace Drupal\idg_import\Controller;

     //------------------------------------------------------------------//
   use Symfony\Component\HttpFoundation\Request;
   use Symfony\Component\HttpFoundation\JsonResponse;
   use Drupal\node\Entity\Node;
   use Drupal\node\NodeInterface;
   use Drupal\Core\Database\Database;
   use Drupal\Component\Serialization\Json;
   

  //-------------------------------------------------------------------//

   class UrlImport {
     public function create( Request $request ) {
     if ( 0 === strpos( $request->headers->get( 'Content-Type' ), 'application/json' ) ) {
       $data = json_decode( $request->getContent(), TRUE );
       $request->request->replace( is_array( $data ) ? $data : [] );
      }
      if (count($data)) {
        try {
          if (isset($data['nid']) && isset($data['guid']) && isset($data['url_alias'])) {
              $url_alias = $data['url_alias'];
              $field_name = $data['field_name'];
              $node = Node::load($data['nid']);

              if ($node->get($field_name)->isEmpty() && $node->hasField($field_name)) {
                $node->set($field_name, $url_alias);
                $node->save();
              }
              else {
                $old_alias = $node->get($field_name);
                if ($old_alias != $url_alias && $node->hasField($field_name)) {  
                  $node->set($field_name, $url_alias);
                  $node->save();
                }
              }

            // if($node->hasField($field_name)){
              $response['response'] = TRUE;
            // }
          }
        } catch(\Exception $e) {
          $respose['response'] = FALSE;
        }
      }
      return new JsonResponse( $response );
    }
  }
 


