<?php

require_once('../../../config/config.inc.php');
require_once('../../../init.php');
require_once('../frank.php');
require_once('../api/FrankApi.php');

$frank_api = new FrankApi();

$readyForPickup = array(
    '_id' => $_POST['_id'],
    'pickupDate' => date("m/d/Y", strtotime($_POST['pickupDate']))
);

$res = $frank_api->doCurlRequest('orders/readyForPickup', $readyForPickup, Configuration::get('FRANK_TOKEN'));
print_r($res);