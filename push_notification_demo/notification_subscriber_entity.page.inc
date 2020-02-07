<?php

/**
 * @file
 * Contains notification_subscriber_entity.page.inc.
 *
 * Page callback for Notification subscriber entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Notification subscriber entity templates.
 *
 * Default template: notification_subscriber_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_notification_subscriber_entity(array &$variables) {
  // Fetch NotificationSubscriberEntity Entity Object.
  $notification_subscriber_entity = $variables['elements']['#notification_subscriber_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
