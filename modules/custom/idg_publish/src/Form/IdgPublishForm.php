<?php
/**
 * @file
 * Contains \Drupal\idg_publish\Form\ResumeForm.
 */
namespace Drupal\idg_publish\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\node\Entity\Node;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\ChangedCommand;
use Drupal\Core\Ajax\CssCommand;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Ajax\InvokeCommand;
use Drupal\Core\Form;
use Drupal\taxonomy\Entity\Term;
/**
 * Configure idg_publish settings.
 */
class IdgPublishForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'idg_publish';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $vid = 'content_category'; //name of your vocabulary
    $terms =\Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadTree($vid);
    foreach ($terms as $term1) {
      $term_data[$term1->tid] = $term1->name;
    }


    //Load node which needs to be pushed to micro sites
    $nid = $_GET['nid'];
    $entity_type = 'node';
    $view_builder = \Drupal::entityTypeManager()->getViewBuilder($entity_type);
    $storage = \Drupal::entityTypeManager()->getStorage($entity_type);
    $node = $storage->load($nid);

    if($node){
      //get sites taxonomy tree
      $vid = 'idg_sites';
      $sites = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadTree($vid);

      $form['#prefix'] = '<div class="publish-filters">';
      $form['publish_filter'] = array(
          '#type' => 'markup',
          '#prefix' => '<div class="wrap-publish-filter">' ,
        //'#suffix' => '</div>',
        );
      //Create publish button for each site
      foreach ($sites as $site) {
        $site_term =  Term::load($site->tid);
        $site_name = $site_term->Label();
        $site_cat_field = $site_term->get('field_site_content_category_fiel')->value;

        //Get button image path
        $site_pub_logo_id = $site_term->get('field_publish_button_image')->target_id;

        //Get exclusion list for the site
        $site_category_arr = array();
        if ($site_term->hasField('field_exclude_category')){
          $site_category = $site_term->get('field_exclude_category');
          foreach ($site_category as $key => $value) {
            $site_category_arr[$value->target_id] = $value->target_id;
          }
        }
        $site_category_list = array_diff_key($term_data, $site_category_arr);
        $file = \Drupal\file\Entity\File::load($site_pub_logo_id);
        $path = file_url_transform_relative(file_create_url($file->getFileUri()));

        //Get existing category for content category field
       $site_category_tid = $node->get($site_cat_field)->target_id;
       $send_content = $node->get('field_send_content')->getValue();
      if(isset($site_category_tid)){
          $disabled_state = TRUE;
        } else {
          $disabled_state = FALSE;
        }
      //Content pushed to any site or not.
      if(count($send_content) == 0){
          $disabled_content_state = TRUE;
          $variable = 'hide';
        } else {
          $disabled_content_state = FALSE;
          $variable = 'show';
        }
        //Create form fields
        $form[$site_name] = array(
          '#type' => 'markup',
          '#prefix' => '<div class="publish-drop-wrap"><div class="publish-main-drop publish-content-click no-opacity '.$site_name. '">
              <span>
                <img src="'.$path.'" width="114px" height="24px">
                <img src="/themes/idgnews/images/drop-down.png">
              </span>
            </div>',
        //'#suffix' => '</div>',
        );
        $form[$site_cat_field] = [
          // '#title' => $this->t('Environment Name'),
          '#type' => 'radios',
          '#options' => $site_category_list,
          '#default_value' => $site_category_tid,
          '#disabled' => $disabled_state,
          '#prefix' => '<div class="list-hideshow '. $site_name.'-list">',
          '#suffix' => '</div></div>',
        ];
      }
      $form['publish_filter_close'] = array(
        '#type' => 'markup',
        '#suffix' => '</div>',
      );
      $form['idg_publish'] = array(
        '#type' => 'button',
        '#title' => 'idg_publish',
        '#value' => $this->t('Publish'),
        '#description' => 'idg publish to all site',
        '#prefix' => '<div id="idg_publish"><div id="publish-msg"></div>',
        '#suffix' => '</div>',
        '#ajax' => array(
           'callback' => '::checkIdgPublishValidation',
           'effect' => 'fade',
            'progress' => array(
               'type' => 'throbber',
               'message' => NULL,
            ),
        ),
      );
      $form['idg_update'] = array(
        '#type' => 'button',
        '#title' => 'idg_update',
        '#value' => $this->t('Update'),
        '#disabled' => $disabled_content_state,
        '#description' => 'idg update to all site',
        '#prefix' => '<div id="idg_update" class="'.$variable.'"><div id="publish-msg"></div>',
        '#suffix' => '</div>',
        '#ajax' => array(
           'callback' => '::checkIdgUpdateValidation',
           'effect' => 'fade',
            'progress' => array(
               'type' => 'throbber',
               'message' => NULL,
            ),
        ),
      );
      // Mesasage section markup.
      $form['message'] = array(
        '#type' => 'markup',
        '#weight' => 4,
        '#prefix' => '<div id="message">',
        '#suffix' => '</div>',
      );
      $form['#suffix'] = '</div>';
      return $form;
    }
    else{
      return FALSE;
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {


}



  public function checkIdgPublishValidation(array $form, FormStateInterface $form_state) {
    $vid = 'idg_sites'; //name of your vocabulary
    $sites =\Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadTree($vid);

    //Load node which needs to be updated
    $nid = $_GET['nid'];
    $node = \Drupal\node\Entity\Node::load($nid);

    //Update category for each site and publish content fields
    foreach ($sites as $site) {
      $site_tid = Term::load($site->tid);
      $site_category = $site_tid->get('field_site_content_category_fiel')->value;
      $site_send_val = $site_tid->get('field_sites_to_publish_value')->value;
      //check if category is available in the form_state
      if ($form_state->getValue($site_category)){
        $node->set($site_category, $form_state->getValue($site_category));
        $send_content_arr[] = $site_send_val;
        $mic_url_list[$site_send_val] = array('site name'=>$site_tid->Label(), 'site url'=>$site_tid->get('field_site_url')->value);
      }
    }
  //New Development for Update Message.
  $send_content = $node->get('field_send_content')->getValue();
  foreach ($send_content as $key => $value) {
    $curr_val[] = $value['value'];
  }
  $_SESSION['old_send_content_arr'] = $curr_val;
  $node->set('field_send_content', $send_content_arr);
    $node->save();
  if ($_SESSION['old_send_content_arr']) {
    $diff = array_values(array_diff($send_content_arr, $_SESSION['old_send_content_arr']));
    foreach ($diff as $key => $value) {
      $CurrentSelect[$value] = $value;
    }
  }else{
    foreach ($send_content_arr as $key => $value) {
      $CurrentSelect[$value] = $value;
    }
  }
  $mic_url_list = array_intersect_key($mic_url_list, $CurrentSelect);
  foreach ($mic_url_list as $key => $value) {
    $mic_url_list_new[] = $value;
  }
  //New Development End

    //Call all sites which need to get the new/updated content
    foreach ($mic_url_list_new as $mic_site) {
      $mic_url = $mic_site['site url'].'get-microsite-content';
      $headers = get_headers($mic_url);
      $headerstest = substr($headers[0], 9, 3);
      if ($headerstest == '200') {
        try {
          $response = \Drupal::httpClient()->get($mic_url, array('headers' => array('Accept' => 'text/plain')));
          $data = (string) $response->getBody();
          if (empty($data)) {
            return FALSE;
          }
        }
        catch (RequestException $e) {
          return FALSE;
        }
      }
      $push_status = json_decode($data)->status;
      if($push_status == 'Success'){
        if ($mic_site == $mic_url_list_new[0]){
          $message .= 'Content pushed to: '. $mic_site['site name'];
        } elseif ($mic_site == end($mic_url_list_new)){
          $message .= ' and '. $mic_site['site name'];
        } else{
          $message .= ', ' . $mic_site['site name'];
        }
      }
    }
    unset($_SESSION['old_send_content_arr']);
    //Send response message
    $ajax_response = new AjaxResponse();
    $output = '<div class="content-msg">'.$message.'</div>';
    $ajax_response->addCommand(new HtmlCommand('#message', $output));
    return $ajax_response;
  }
//Update Node from IDG
  public function checkIdgUpdateValidation(array $form, FormStateInterface $form_state) {
    $vid = 'idg_sites'; //name of your vocabulary
    $sites =\Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadTree($vid);

    //Load node which needs to be updated
    $nid = $_GET['nid'];
    $node = \Drupal\node\Entity\Node::load($nid);
    $send_content = $node->get('field_send_content')->getValue();
    //Update category for each site and publish content fields
    foreach ($sites as $site) {
      $site_tid = Term::load($site->tid);
      $site_category = $site_tid->get('field_site_content_category_fiel')->value;
      $site_send_val = $site_tid->get('field_sites_to_publish_value')->value;
      //check if category is available in the form_state
      if ($form_state->getValue($site_category)){
        $node->set($site_category, $form_state->getValue($site_category));
        $send_content_arr[] = $site_send_val;
        $mic_url_list[$site_send_val] = array('site name'=>$site_tid->Label(), 'site url'=>$site_tid->get('field_site_url')->value,'sites_to_publish_value' => $site_send_val);
      }
    }
    foreach ($send_content as $key => $value) {
    $updated_node[$value['value']]  = $value['value'];
  }
  $mic_url_list = array_intersect_key($mic_url_list, $updated_node);
  foreach ($mic_url_list as $key => $value) {
    $mic_url_list1[] = $value;
  }
   // $node->set('field_send_content', $send_content_arr);
   // $node->save();
    //Call all sites which need to get the new/updated content
    foreach ($mic_url_list1 as $mic_site) {
      $mic_url = $mic_site['site url'].'get-microsite-content-update';
      $headers = get_headers($mic_url);
      $headerstest = substr($headers[0], 9, 3);
      if ($headerstest == '200') {
        try {
          $response = \Drupal::httpClient()->get($mic_url, array('headers' => array('Accept' => 'text/plain')));
          $data = (string) $response->getBody();
          if (empty($data)) {
            return FALSE;
          }
        }
        catch (RequestException $e) {
          return FALSE;
        }
      }
      $push_status = json_decode($data)->status;
      if($push_status == 'Success'){
        if ($mic_site == $mic_url_list1[0]){
          $message .= 'Content updated to: '. $mic_site['site name'];
        } elseif ($mic_site == end($mic_url_list1)){
          $message .= ' and '. $mic_site['site name'];
        } else{
          $message .= ', ' . $mic_site['site name'];
        }
      }
    }
    //Send response message
    $ajax_response = new AjaxResponse();
    $output = '<div class="update-msg">'.$message.'</div>';
    $ajax_response->addCommand(new HtmlCommand('#message', $output));
    return $ajax_response;
  }
}
