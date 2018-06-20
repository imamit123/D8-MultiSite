<?php

namespace Drupal\idg_gen_newsletter\Form;
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
 * Configure newsletter_generate settings.
 */
class GenerateNewsletterForm extends ConfigFormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'idg_generate_newsletter_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['idg_generate_newsletter.configure'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Submit button definition.
    $form['generate_newsletter'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Generate Newsletter'),
      '#weight' => 3,
    );
    return $form;
  }
  
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $news_node = \Drupal::routeMatch()->getParameter('node');
    $nid = $news_node->id();
    // print_r($node->id());die();
    // $news_node = Node::load($node->id());
    $output = $news_node->get('field_newsletter_html')->value;
    // print_r('asfsaasfas');die();
    // $entity_type = 'node';
    // $view_mode = 'full';
    // $view_builder = \Drupal::entityTypeManager()->getViewBuilder($entity_type);
    // $storage = \Drupal::entityTypeManager()->getStorage($entity_type);
    // $node = $storage->load($nid);
    // $build = $view_builder->view($node, $view_mode);
    // $output = render($build);
    $filename = "sites/default/files/index.html";
    $fp = fopen("sites/default/files/index.html","wb");
    fwrite($fp, $output);
    fclose($fp);
    if(file_exists($filename)){
    //Get file type and set it as Content Type
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    header('Content-Type: ' . finfo_file($finfo, $filename));
    finfo_close($finfo);

    //Use Content-Disposition: attachment to specify the filename
    header('Content-Disposition: attachment; filename='.basename($filename));

    //No cache
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');

    //Define file size
    header('Content-Length: ' . filesize($filename));

    ob_clean();
    flush();
    readfile($filename);
    exit;
  }
    return array(
      '#markup' => 'Newsletter has been saved.',
    );
    
  }
}
