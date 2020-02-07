<?php

namespace Drupal\push_notification_demo\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Notification subscriber entity entities.
 *
 * @ingroup push_notification_demo
 */
interface NotificationSubscriberEntityInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Notification subscriber entity name.
   *
   * @return string
   *   Name of the Notification subscriber entity.
   */
  public function getName();

  /**
   * Sets the Notification subscriber entity name.
   *
   * @param string $name
   *   The Notification subscriber entity name.
   *
   * @return \Drupal\push_notification_demo\Entity\NotificationSubscriberEntityInterface
   *   The called Notification subscriber entity entity.
   */
  public function setName($name);

  /**
   * Gets the Notification subscriber entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Notification subscriber entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Notification subscriber entity creation timestamp.
   *
   * @param int $timestamp
   *   The Notification subscriber entity creation timestamp.
   *
   * @return \Drupal\push_notification_demo\Entity\NotificationSubscriberEntityInterface
   *   The called Notification subscriber entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Notification subscriber entity published status indicator.
   *
   * Unpublished Notification subscriber entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Notification subscriber entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Notification subscriber entity.
   *
   * @param bool $published
   *   TRUE to set this Notification subscriber entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\push_notification_demo\Entity\NotificationSubscriberEntityInterface
   *   The called Notification subscriber entity entity.
   */
  public function setPublished($published);

}
