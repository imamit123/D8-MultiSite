<?php
 
/**
 
 * @file
 
 * Contains \Drupal\simple\Form\IdgGeneralConfigForm.
 
 */
 
namespace Drupal\idg_custom\Form;
 
use Drupal\Core\Form\ConfigFormBase;
 
use Drupal\Core\Form\FormStateInterface;
 
class IdgGeneralConfigForm extends ConfigFormBase {
 
  /**
 
   * {@inheritdoc}
 
   */
 
  public function getFormId() {
 
    return 'idg_general_config_form';
 
  }
 
  /**
 
   * {@inheritdoc}
 
   */
 
  public function buildForm(array $form, FormStateInterface $form_state) {
 
    $form = parent::buildForm($form, $form_state);
 
    $config = $this->config('idg_custom.settings');
 
    $form['guid_format'] = array(
 
      '#type' => 'textfield',
 
      '#title' => $this->t('GUID Format'),
      '#description' => $this->t('Enter the String to append with New GUID for this site'),
 
      '#default_value' => $config->get('idg_custom.guid_format'),
 
      '#required' => TRUE,
 
    );

    $form['idg_news'] = array(
      '#type' => 'fieldset',
      '#title' => $this->t('IDG News Settings'),
      '#collapsible' => TRUE,
      '#collapsed' =>TRUE,
      '#tree' => FALSE,
      );

    $form['idg_news']['idg_username'] =array(
      '#type' => 'textfield',
      '#title' => $this->t('Username'),
      '#description' => $this->t('IDG News Username'),
      '#required' => TRUE,
      '#default_value' => $config->get('idg_custom.idg_username'),
      );

    $form['idg_news']['idg_password'] =array(
      '#type' => 'textfield',
      '#title' => $this->t('Password'),
      '#description' => $this->t('IDG News Password'),
      '#required' => TRUE,
      '#default_value' => $config->get('idg_custom.idg_password'),
      );
 
     $form['idg_news']['idg_url'] =array(
      '#type' => 'url',
      '#title' => $this->t('IDG Site URL'),
      '#description' => $this->t('IDG News URL'),
      '#required' => TRUE,
      '#default_value' => $config->get('idg_custom.idg_url'),
      );

 
     $form['microsites_urls'] = array(
      '#type' => 'fieldset',
      '#title' => $this->t('Microsite URLs'),
      '#collapsible' => TRUE,
      '#collapsed' =>TRUE,
      '#tree' => FALSE,
      );
    $all_microsites = array(
      'cio' => 'CIO',
      'channelworld' => 'Channel World',
      'computerworld' => 'Computer World',
      'cso' => 'CSO',
      'readybusiness' => 'Readybusiness',
      'fintech' => 'fintech',
    );
    foreach ($all_microsites as $key => $value) {
      $form['microsites_urls'][$key] =array(
        '#type' => 'url',
        '#title' => $this->t(''. $value .' Site URL'),
        '#description' => $this->t('Enter '. $value .' URL'),
        '#required' => TRUE,
        '#default_value' => $config->get('idg_custom.'. $key .''),
      );
    }
      
    return $form;
 
  }
 
  /**
 
   * {@inheritdoc}
 
   */
 
  public function submitForm(array &$form, FormStateInterface $form_state) {
 
    $config = $this->config('idg_custom.settings');
    $config->set('idg_custom.guid_format', $form_state->getValue('guid_format'));
    $config->set('idg_custom.idg_username', $form_state->getValue('idg_username'));
    $config->set('idg_custom.idg_password', $form_state->getValue('idg_password'));
    $config->set('idg_custom.idg_url', $form_state->getValue('idg_url'));
    $config->set('idg_custom.cio', $form_state->getValue('cio'));
    $config->set('idg_custom.channelworld', $form_state->getValue('channelworld'));
    $config->set('idg_custom.computerworld', $form_state->getValue('computerworld'));
    $config->set('idg_custom.cso', $form_state->getValue('cso'));
    $config->set('idg_custom.readybusiness', $form_state->getValue('readybusiness'));
    $config->set('idg_custom.fintech', $form_state->getValue('fintech'));
    $config->save();
 
    return parent::submitForm($form, $form_state);
 
  }
 
  /**
 
   * {@inheritdoc}
 
   */
 
  protected function getEditableConfigNames() {
 
    return [
 
      'idg_custom.settings',
 
    ];
 
  }
 
}