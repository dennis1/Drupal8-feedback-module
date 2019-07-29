<?php

namespace Drupal\den_feedback\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Custom feedback entities.
 */
class CustomFeedbackViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.
    return $data;
  }

}
