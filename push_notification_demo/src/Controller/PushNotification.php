<?php

namespace Drupal\push_notification_demo\Controller;

use Drupal\Core\Controller\ControllerBase;
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;
use Drupal\Core\Config\ConfigFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class PushNotification.
 *
 * @package Drupal\push_notification_demo\Controller\PushNotification
 */
class PushNotification extends ControllerBase {

  /**
   * {@inheritdoc}
   */
  public function __construct(ConfigFactoryInterface $config_factory) {
    $this->configFactory = $config_factory;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory')
    );
  }

  /**
   * Function to send notification.
   */
  public function sendNotification() {
    $config = $this->configFactory->get('push_notification_demo.settings');
    $auth = [
      'VAPID' => [
        'subject' => $config->get('subject'),
        'publicKey' => $config->get('publickey'),
        'privateKey' => $config->get('privatekey'),
      ],
    ];

    $webPush = new WebPush($auth);

    $subscriptionToken = [
      'endpoint' => 'https://fcm.googleapis.com/fcm/send/fppQcXobjPI:APA91bEBNe1xrP88iKTgtrPSvGHwTe1bHspxJuNQFp-Tx-o-jKSy_HEcfwSnCm0ntOq9agz58kwPBLJogxBGzX59EYhPtNn02j75NrX66KmUZSGW4WsFfVD40i2g4y9DduqfbD0skMIJ',
      'publicKey' => 'BEi3lsu7SAhMI9Ca6UezIBvQ65oCa0KGAEt6pggCMRrJHyqL6CWS9eZnwqOvYEYQ5BNSp8zxU_yWIoF2ANt35wQ',
      'authToken' => 'PKDwSrXRID-AswiAQu5HQg',
    ];
    $notification = [
      'subscription' => Subscription::create($subscriptionToken),
      'payload' => 'hello !',
    ];
    $webPush->sendNotification(
        $notification['subscription'],
        $notification['payload']
    );

    foreach ($webPush->flush() as $report) {
      $endpoint = $report->getRequest()->getUri()->__toString();
      if ($report->isSuccess()) {
        echo "[v] Message sent successfully for subscription {$endpoint}.";
      }
      else {
        echo "[x] Message failed to sent for subscription {$endpoint}: {$report->getReason()}";
      }
    }

    return ['ok'];
  }

}
