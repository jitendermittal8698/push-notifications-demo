<?php

namespace Drupal\push_notification_demo\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Notification subscriber entity entities.
 */
class NotificationSubscriberEntityViewsData extends EntityViewsData {

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
