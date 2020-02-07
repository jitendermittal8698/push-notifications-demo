<?php

namespace Drupal\push_notification_demo\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines a form that configures forms module settings.
 */
class NotificationAuthDetailsConfigurationForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'noti_auth_details_setting';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'push_notification_demo.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('push_notification_demo.settings');
    $form['subject'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Enter Site Url'),
      '#default_value' => $config->get('subject'),
    ];
    $form['publickey'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Enter Public Key'),
      '#default_value' => $config->get('publickey'),
    ];
    $form['privatekey'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Enter Private Key'),
      '#default_value' => $config->get('privatekey'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('push_notification_demo.settings')
      ->set('subject', $form_state->getValue("subject"))
      ->set('publickey', $form_state->getValue("publickey"))
      ->set('privatekey', $form_state->getValue("privatekey"))
      ->save();
    parent::submitForm($form, $form_state);
  }

}
