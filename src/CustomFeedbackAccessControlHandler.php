<?php

namespace Drupal\den_feedback;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Custom feedback entity.
 *
 * @see \Drupal\den_feedback\Entity\CustomFeedback.
 */
class CustomFeedbackAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\den_feedback\Entity\CustomFeedbackInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished custom feedback entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published custom feedback entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit custom feedback entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete custom feedback entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add custom feedback entities');
  }

}
