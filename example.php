<?php
require_once __DIR__.'/vendor/autoload.php';

use DialogBoxStudio\KdClient\Client;

$client = new Client('access_token', new \GuzzleHttp\Client());

/**
$authorization = $client->authorization('+79780054211');
if ($authorization->isError() === false) {
    echo $authorization->getResult();
    echo $authorization->getStatus();
    if ($authorization->getStatus() !== 'user is not found') {
        echo $authorization->getCode();
    }
} else {
    echo $authorization->getError()->getMessage();
}
 */

/**
$marketing = $client->marketing('Вичуга');
if ($marketing->isError() === false) {
    echo $marketing->getResult();
    echo $marketing->getStatus();
    if ($marketing->getStatus() !== 'city not found') {
        //var_dump($marketing->getName());
        //var_dump($marketing->getDescription());
        //var_dump($marketing->getList());
        echo $marketing->getLink();
    }
} else {
    echo $marketing->getError()->getMessage();
}
 */


/**
$orderStatus = $client->orderStatus(24214);
if ($orderStatus->isError() === false) {
    echo $orderStatus->getResult();
    if ($orderStatus->getStatus() == 'ok') {
        echo $orderStatus->getOrderStatus();
    } else {
        echo $orderStatus->getStatus();
    }
} else {
    echo $orderStatus->getError()->getMessage();
}
 */

/**
$seasonalStorageStatus = $client->seasonalStorageStatus('К306СН777');
if ($seasonalStorageStatus->isError() === false) {
    echo $seasonalStorageStatus->getResult();
    if ($seasonalStorageStatus->getStatus() == 'ok') {
        echo $seasonalStorageStatus->getSeasonalStorageStatus();
    } else {
        echo $seasonalStorageStatus->getStatus();
    }
} else {
    echo $seasonalStorageStatus->getError()->getMessage();
}
*/

/**
$services = $client->services('Иваново');
if ($services->isError() === false) {
    if ($services->getStatus() !== 'city not found') {
        //var_dump($services->getName());
        //var_dump($services->getDescription());
        //var_dump($services->getList());
        echo $services->getLink();
    }
} else {
    echo $services->getError()->getMessage();
}
 */

/**
$working = $client->working('Иваново');
if ($working->isError() === false) {
    echo $working->getResult();
    echo $working->getStatus();
    if ($working->getStatus() !== 'city not found') {
        var_dump($working->getPlace());
    }
} else {
    echo $working->getError()->getMessage();
}
*/
