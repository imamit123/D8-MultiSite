<?php
/**
 * @file
 * Contains \Drupal\idg_media_release\Form\ResumeForm.
 */
namespace Drupal\idg_media_release\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\node\Entity\Node;
use Drupal\Core\Form;
use Drupal\taxonomy\Entity\Term;
/**
 * Configure idg_media_release settings.
 */

class IdgMediareleaseForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
    return 'idg_media_release';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);
    $config = $this->config('idg_media_release.settings');
    $form['idg_media_release'] = array(
      '#type' => 'fieldset',
      '#title' => $this->t('IDG Media Release Settings'),
      '#collapsible' => TRUE,
      '#collapsed' =>TRUE,
      '#tree' => FALSE,
      );
    
    $form['idg_media_release']['idg_mail_box'] =array(
      '#type' => 'textfield',
      '#title' => $this->t('Mailbox'),
      '#description' => $this->t('IDG Mailbox'),
      '#required' => TRUE,
      '#default_value' => $config->get('idg_media_release.idg_mail_box'),
      );

    $form['idg_media_release']['idg_username'] =array(
      '#type' => 'textfield',
      '#title' => $this->t('Username'),
      '#description' => $this->t('IDG News Username'),
      '#required' => TRUE,
      '#default_value' => $config->get('idg_media_release.idg_username'),
      );

    $form['idg_media_release']['idg_password'] =array(
      '#type' => 'textfield',
      '#title' => $this->t('Password'),
      '#description' => $this->t('IDG News Password'),
      '#required' => TRUE,
      '#default_value' => $config->get('idg_media_release.idg_password'),
      );
    return $form;
  }

  /**
 
   * {@inheritdoc}
 
   */
 
  public function submitForm(array &$form, FormStateInterface $form_state) {
 
    $config = $this->config('idg_media_release.settings');
    $config->set('idg_media_release.idg_mail_box', $form_state->getValue('idg_mail_box'));
    $config->set('idg_media_release.idg_username', $form_state->getValue('idg_username'));
    $config->set('idg_media_release.idg_password', $form_state->getValue('idg_password'));
    $config->save();
 
    return parent::submitForm($form, $form_state);
 
  }

  /**
 
   * {@inheritdoc}
 
   */
 
  protected function getEditableConfigNames() {
 
    return [
 
      'idg_media_release.settings',
 
    ];
 
  }
}