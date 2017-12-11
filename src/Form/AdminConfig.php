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
    $available_entities_keys = array_keys($available_entities);

    $form['entities_to_sync'] = [
      '#title' => $this->t('Entities to Sync'),
      '#type' => 'checkboxes',
      '#options' => $available_entities_keys,
      '#default_value' => isset($sync_entities) ? $sync_entities : [],
    ];

    return parent::buildForm($form, $form_state);
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    /*
    $connection = $form_state->get('connection');

    $this->config('neo4j.connection')->set('connection', $connection)->save();

    parent::submitForm($form, $form_state);
    */
  }
}
