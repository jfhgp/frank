<?php

require_once('../../../config/config.inc.php');
require_once('../../../init.php');
require_once('../frank.php');
require_once('../api/FrankApi.php');

$frank_api = new FrankApi();

$cancelOrder = array(
    '_id' => $_POST['_id'],
    'cancellationReason' => 'Cancelled by store',
    'status' => 'cancelledbystore'
);

$res = $frank_api->doCurlRequest('orders/cancel', $cancelOrder, Configuration::get('FRANK_TOKEN'));
//$res = array('status' => 200);
print_r($res);
exit;