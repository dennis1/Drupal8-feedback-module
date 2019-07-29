<?php

namespace Drupal\den_feedback\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityPublishedInterface;

/**
 * Provides an interface for defining Custom feedback entities.
 *
 * @ingroup den_feedback
 */
interface CustomFeedbackInterface extends ContentEntityInterface, EntityChangedInterface, EntityPublishedInterface {

  /**
   * Add get/set methods for your configuration properties here.
   */

  /**
   * Gets the Custom feedback name.
   *
   * @return string
   *   Name of the Custom feedback.
   */
  public function getName();

  /**
   * Sets the Custom feedback name.
   *
   * @param string $name
   *   The Custom feedback name.
   *
   * @return \Drupal\den_feedback\Entity\CustomFeedbackInterface
   *   The called Custom feedback entity.
   */
  public function setName($name);

  /**
   * Gets the Custom feedback creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Custom feedback.
   */
  public function getCreatedTime();

  /**
   * Sets the Custom feedback creation timestamp.
   *
   * @param int $timestamp
   *   The Custom feedback creation timestamp.
   *
   * @return \Drupal\den_feedback\Entity\CustomFeedbackInterface
   *   The called Custom feedback entity.
   */
  public function setCreatedTime($timestamp);

}
