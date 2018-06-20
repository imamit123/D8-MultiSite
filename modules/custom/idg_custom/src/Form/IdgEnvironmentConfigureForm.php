<?php

namespace Drupal\idg_custom\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;

/**
 * Configure idg_custom settings.
 */
class IdgEnvironmentConfigureForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'idg_environment_configure_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['idg_custom.configure'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
     $idg_custom = $this->config('idg_custom.configure');
    $form['environment'] = [
      '#title' => $this->t('Environment Name'),
      '#type' => 'radios',
      '#options' => [
        '1' => $this->t('Local'),
        '2' => $this->t('Dev'),
        '3' => $this->t('Stage'),
        '4' => $this->t('Prod'),
      ],
      '#default_value' => $idg_custom->get('environment'),
    ];
    $form['idgnews'] = [
      '#title' => $this->t('Idgnews.'),
      '#description' => $this->t('Idgnews.'),
      '#type' => 'textfield',
      '#default_value' => $idg_custom->get('idgnews'),
    ];
     $form['cio'] = [
      '#title' => $this->t('cio.'),
      '#description' => $this->t('cio.'),
      '#type' => 'textfield',
      '#default_value' => $idg_custom->get('cio'),
    ];
     $form['channelworld'] = [
      '#title' => $this->t('channelworld.'),
      '#description' => $this->t('channelworld.'),
      '#type' => 'textfield',
      '#default_value' => $idg_custom->get('channelworld'),
    ];
     $form['computerworld'] = [
      '#title' => $this->t('computerworld.'),
      '#description' => $this->t('computerworld.'),
      '#type' => 'textfield',
      '#default_value' => $idg_custom->get('computerworld'),
    ];
     $form['csoonline'] = [
      '#title' => $this->t('csoonline.'),
      '#description' => $this->t('csoonline.'),
      '#type' => 'textfield',
      '#default_value' => $idg_custom->get('csoonline'),
    ];
     $form['fintech'] = [
      '#title' => $this->t('fintech.'),
      '#description' => $this->t('fintech.'),
      '#type' => 'textfield',
      '#default_value' => $idg_custom->get('fintech'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('idg_custom.configure')
      ->set('environment', $form_state->getValue('environment'))
      ->set('idgnews', $form_state->getValue('idgnews'))
      ->set('cio', $form_state->getValue('cio'))
      ->set('channelworld', $form_state->getValue('channelworld'))
      ->set('computerworld', $form_state->getValue('computerworld'))
      ->set('csoonline', $form_state->getValue('csoonline'))
      ->set('fintech', $form_state->getValue('fintech'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}
