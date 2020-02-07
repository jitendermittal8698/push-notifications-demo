var applicationServerPublicKey = 'BGfj4o6tFHeEQMPdidBAcMIVIPshKDs6WFH6ozjkww52u1btpvIYD7-wnSlarA3-wRTLoljISgXQzfUrGK_VKVY';
var swReg = null;

(function ($, Drupal) {

    'use strict';

    Drupal.behaviors.pushnotification = {

        attach: function (context, settings) {

            if ('serviceWorker' in navigator && 'PushManager' in window) {
                console.log(drupalSettings.sw_register.path);
                navigator.serviceWorker.register(drupalSettings.sw_register.path).then(function (swRegistration) {
                    swReg = swRegistration
                    swRegistration.pushManager.getSubscription().then(function (subscription) {
                        if (subscription) {
                            console.log(JSON.stringify(subscription));
                        }
                        else {
                            subscribeUser()
                        }
                    });
                }).catch(function (error) {
                    console.error('Service Worker Error', error);
                });
            }
            else {
                console.warn('Push messaging is not supported');
            }
        }
    }

})(jQuery, Drupal);

function urlB64ToUint8Array(base64String) {
    var padding = '='.repeat((4 - base64String.length % 4) % 4);
    var base64 = (base64String + padding).replace(/\-/g, '+').replace(/_/g, '/');
    var rawData = window.atob(base64);
    var outputArray = new Uint8Array(rawData.length);
    for (var i = 0; i < rawData.length; ++i) {
        outputArray[i] = rawData.charCodeAt(i);
    }
    return outputArray;
}

function subscribeUser() {
    swReg.pushManager.subscribe({
        userVisibleOnly: true,
        applicationServerKey: urlB64ToUint8Array(applicationServerPublicKey)
    }).catch(function (err) {
        console.log('Failed to subscribe the user: ', err);
    });
}
function unsubscribeUser() {
    swReg.pushManager.getSubscription().then(function (subscription) {
        if (subscription) {
            return subscription.unsubscribe();
        }
    }).catch(function (error) {
        console.log('Error unsubscribing', error);
    })
}
