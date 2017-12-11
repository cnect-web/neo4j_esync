<?php

namespace Drupal\neo4j_esync\Controller;

use Drupal\Core\Controller\ControllerBase;

class Settings extends ControllerBase {

  public function adminSettings() {
    return $this->formBuilder()->getForm('Drupal\neo4j_esync\Form\AdminConfig');
  }

}
