<?php

namespace Drupal\push_notification_demo\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Notification subscriber entity entity.
 *
 * @ingroup push_notification_demo
 *
 * @ContentEntityType(
 *   id = "notification_subscriber_entity",
 *   label = @Translation("Notification subscriber entity"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\push_notification_demo\NotificationSubscriberEntityListBuilder",
 *     "views_data" = "Drupal\push_notification_demo\Entity\NotificationSubscriberEntityViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\push_notification_demo\Form\NotificationSubscriberEntityForm",
 *       "add" = "Drupal\push_notification_demo\Form\NotificationSubscriberEntityForm",
 *       "edit" = "Drupal\push_notification_demo\Form\NotificationSubscriberEntityForm",
 *       "delete" = "Drupal\push_notification_demo\Form\NotificationSubscriberEntityDeleteForm",
 *     },
 *     "access" = "Drupal\push_notification_demo\NotificationSubscriberEntityAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\push_notification_demo\NotificationSubscriberEntityHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "notification_subscriber_entity",
 *   admin_permission = "administer notification subscriber entity entities",
 *   entity_keys = {
 *     "id" = "user_id",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/notification_subscriber_entity/{notification_subscriber_entity}",
 *     "add-form" = "/admin/structure/notification_subscriber_entity/add",
 *     "edit-form" = "/admin/structure/notification_subscriber_entity/{notification_subscriber_entity}/edit",
 *     "delete-form" = "/admin/structure/notification_subscriber_entity/{notification_subscriber_entity}/delete",
 *     "collection" = "/admin/structure/notification_subscriber_entity",
 *   },
 *   field_ui_base_route = "notification_subscriber_entity.settings"
 * )
 */
class NotificationSubscriberEntity extends ContentEntityBase implements NotificationSubscriberEntityInterface {

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    $values += [
      'user_id' => \Drupal::currentUser()->id(),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->get('name')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setName($name) {
    $this->set('name', $name);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwner() {
    return $this->get('user_id')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwnerId() {
    return $this->get('user_id')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwnerId($uid) {
    $this->set('user_id', $uid);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwner(UserInterface $account) {
    $this->set('user_id', $account->id());
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function isPublished() {
    return (bool) $this->getEntityKey('status');
  }

  /**
   * {@inheritdoc}
   */
  public function setPublished($published) {
    $this->set('status', $published ? TRUE : FALSE);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['user_id'] = BaseFieldDefinition::create('string')
      ->setLabel(t('User ID'))
      ->setDescription(t('Unique ID of User.'))
      ->setSettings([
        'max_length' => 255,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(FALSE);

    $fields['endpoint'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Endpoint'))
      ->setDescription(t('Endpoint for user'))
      ->setSettings([
        'max_length' => 255,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(FALSE);

    $fields['publickey'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Source'))
      ->setDescription(t('Source.'))
      ->setSettings([
        'max_length' => 255,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(FALSE);

    $fields['authtoken'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Authorization Token'))
      ->setDescription(t('Auth Token'))
      ->setSettings([
        'max_length' => 100,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(FALSE);

    $fields['subscriber'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Is Subscriber'))
      ->setDescription(t('Whether the user is subscribed'))
      ->setDisplayOptions('form', [
        'type' => 'boolean_checkbox',
        'settings' => [
          'display_label' => TRUE,
        ],
      ])
      ->setDisplayConfigurable('form', TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

}
