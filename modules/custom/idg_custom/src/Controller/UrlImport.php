<?php

   namespace Drupal\idg_custom\Controller;

     //------------------------------------------------------------------//
   use Symfony\Component\HttpFoundation\Request;
   use Symfony\Component\HttpFoundation\JsonResponse;
   use Drupal\node\Entity\Node;
   use Drupal\node\NodeInterface;
  //-------------------------------------------------------------------//

   class UrlImport {

      public  function create() {
          return $arr = array('#markup' => 'hello',);
      }
 }

 

