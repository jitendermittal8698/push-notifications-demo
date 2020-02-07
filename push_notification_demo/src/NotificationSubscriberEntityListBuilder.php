<?php

namespace Drupal\push_notification_demo;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Notification subscriber entity entities.
 *
 * @ingroup push_notification_demo
 */
class NotificationSubscriberEntityListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Notification subscriber entity ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\push_notification_demo\Entity\NotificationSubscriberEntity */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.notification_subscriber_entity.edit_form',
      ['notification_subscriber_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
