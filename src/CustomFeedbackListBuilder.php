<?php

namespace Drupal\den_feedback;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;

/**
 * Defines a class to build a listing of Custom feedback entities.
 *
 * @ingroup den_feedback
 */
class CustomFeedbackListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Custom feedback ID');
    $header['first_name'] = $this->t('First Name');
    $header['last_name'] = $this->t('Last Name');
    $header['email'] = $this->t('Email');
    $header['category'] = $this->t('Category');
    $header['message'] = $this->t('message');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var \Drupal\den_feedback\Entity\CustomFeedback $entity */
    $row['id'] = $entity->id();
    $row['first_name'] = $entity->get('first_name')->value;
    $row['last_name'] = $entity->get('last_name')->value;
    $row['email'] = $entity->get('email')->value;
    $row['category'] = $entity->get('category')->value;
    $row['message'] = $entity->get('message')->value;
    return $row + parent::buildRow($entity);
  }

}
