<?php

namespace Drupal\push_notification_demo;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Notification subscriber entity entity.
 *
 * @see \Drupal\push_notification_demo\Entity\NotificationSubscriberEntity.
 */
class NotificationSubscriberEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\push_notification_demo\Entity\NotificationSubscriberEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished notification subscriber entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published notification subscriber entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit notification subscriber entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete notification subscriber entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add notification subscriber entity entities');
  }

}
