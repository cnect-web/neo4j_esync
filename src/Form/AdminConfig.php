<?php

namespace Drupal\neo4j_esync\Form;

use Behat\Mink\Exception\Exception;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class AdminConfig extends ConfigFormBase {

  protected function getEditableConfigNames() {
    return ['neo4j_esync.settings'];
  }

  public function getFormId() {
    return 'neo4j_esync_admin_config_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $sync_entities = $this->config('neo4j_esync.settings')->get('entities_to_sync');

    $available_entities = \Drupal::entityTypeManager()->getDefinitions();
    $options = [];

    foreach ($available_entities as $key => $entity_type) {
      $options[$key] = $entity_type->getLabel();
    }

    $form['entities_to_sync'] = [
      '#title' => $this->t('Entities to Sync'),
      '#type' => 'checkboxes',
      '#options' => $options,
      '#default_value' => !empty($sync_entities) ? $sync_entities : ['node', 'user'],
    ];

    return parent::buildForm($form, $form_state);
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $entities_to_sync = array_filter($form_state->getValue('entities_to_sync'));
    $this->config('neo4j_esync.settings')->set('entities_to_sync', $entities_to_sync)->save();
    parent::submitForm($form, $form_state);
  }
}
