<?php

namespace Drupal\dropsolid_dependency_injection;

use Drupal\Core\Language\LanguageManager;

/**
 * Decorator of the LanguageManager.
 *
 * We can extend the existing definition here.
 */
class DropsolidLanguageManager extends LanguageManager {

  /**
   * {@inheritdoc}
   */
  public function getDefaultLanguage() {
    // Example: set the default language if get() function will return NULL.
    return $this->defaultLanguage->get() ?? 'en';
  }

}
