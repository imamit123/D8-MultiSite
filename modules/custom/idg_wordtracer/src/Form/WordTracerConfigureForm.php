<?php

namespace Drupal\idg_wordtracer\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Database\Database;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\node\Entity\Node;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\ChangedCommand;
use Drupal\Core\Ajax\CssCommand;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Ajax\InvokeCommand;
use Drupal\Core\Form;

/**
 * Configure idg_wordtracer settings.
 */
class WordTracerConfigureForm extends ConfigFormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'idg_wordtracer_configure_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['idg_wordtracer.configure'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Submit button definition.
    $form['CountKeywords'] = array(
      '#type' => 'button',
      '#value' => $this->t('Find Matching Keywords'),
      '#weight' => 3,
      '#ajax' => array(
        // Function to call when event on form element triggered.
        'callback' => '::CountKeywords',
        'event' => 'click',
        'progress' => array(
            'type' => 'throbber',
            'message' => 'Count Keywords..',
         ),
       ),
      'or' => array(
          '#markup' => $this->t('<span>OR</span>'),
        ),
      'Search Keyword' => array(
          '#type' => 'button',
          '#value' => $this->t('Search Keywords'),
          '#weight' => 3, 
          '#ajax' => array(
        // Function to call when event on form element triggered.
              'callback' => '::CountKeywords',
              'event' => 'click',
              'progress' => array(
                    'type' => 'throbber',
                    'message' => 'Count Keywords..',
             ),
          ),
       ),
      'search_keyword_output' => array(
              '#type' => 'textarea',
              // '#title' => $this->t('Enter keywords seperated by comma:'),
              '#placeholder'=>$this->t('Enter keywords seperated by comma:'),
     ),
      'frequency_limit' => array(
              '#type' => 'textarea',
              '#placeholder' => $this->t('Frequency Limit:'),
     ),
  );
    // Results section markup.
    $form['counted_keywords'] = array(
        '#type' => 'markup',
        '#weight' => 4,
        '#prefix' => '<div id="counted_keywords">',
        '#suffix' => '</div>',
    );
     return $form;
  }
   
    
  public function CountKeywords(array &$form, FormStateInterface $form_state) {
    $key = $form_state->getValue('search_keyword_output');
    $frequency = $form_state->getValue('frequency_limit');
    if (empty($frequency)){
      $frequency =0;
    }
    if($key){
      $key1 = explode(",",$key);
      $content_category_name = array_map('strtolower', $key1);
    }else{
      // $content_category_name = $form_state->getValue('search_keyword_output');
      $connection = Database::getConnection();
      $query = $connection->select('taxonomy_term_field_data', 'ttfd');
      $query->fields('ttfd',array('name'));
      $query->condition('ttfd.vid', 'idg_new_taxonomy');
      //$query->condition('ttfd.name', $subject_type);
      $data = $query->execute();
      $results = $data->fetchAll(\PDO::FETCH_OBJ);
      foreach ($results as $row) {
        $content_category_name[] = $row->name;
      }
      $content_category_name = array_map('strtolower', $content_category_name);
    }
    $node = \Drupal::routeMatch()->getParameter('node');
    
    //get field values
    $node_title = $node->get('title')->value;
    $node_teaser  = $node->get('field_teaser')->value;
    $node_body = $node->get('body')->value;
    
    $output = '<div class="keyword-wrap"><div id="kw-title"><label>Title</label>';
    $output .= $this->get_keyword_count($node_title,$content_category_name, $frequency) ."</div>";
    $output .= '<div id="kw-teaser"><label>Teaser</label>';
    $output .= $this->get_keyword_count($node_teaser,$content_category_name, $frequency) ."</div>";
    $output .= '<div id="kw-body"><label>Body</label>';
    $output .= $this->get_keyword_count($node_body,$content_category_name, $frequency) ."</div></div>";    
    
    //Create ajax response
    $response = new AjaxResponse();
    $response->addCommand(new HtmlCommand('#counted_keywords', $output));
    return $response;
  }

  //function to count keyword occurences
  public function get_keyword_count($field_value, $keywords, $frequency){
    //strip all html tags
    $field_value = strip_tags($field_value);
    //convert string to lower case
    $field_value = strtolower($field_value);
    //Clean up string for spaces
    $field_value = preg_replace("/(?:\s|&nbsp;)+/", " ", $field_value);
    if (sizeof($keywords>1) && strlen($field_value)>1){
      $output = "";
      foreach ($keywords as $value) {
        $key_count = substr_count($field_value, $value);
        if ($key_count != 0 && $key_count >= $frequency ) {
          // $output.=  $value . ": ". $key_count ."<br>";
          $output_array[$value] = $key_count;
          $match_found = TRUE;
        }
      }
      //sort in descending order of count
      if (sizeof($output_array)>=1){
        arsort($output_array);
        $output.= "<ul>";
        foreach ($output_array as $key => $value) {
          $output.=  "<li>".$key. ": ". $value ."</li>";
        }
        $output.= "</ul>";
      }

      if(!$match_found){
        $output = "<div class='warning'>No keywords match</div>";
      }

      return $output;
    }
    else {
      return "<div class='warning'>Field or keyword is empty</div>";   
    }
  }

}
