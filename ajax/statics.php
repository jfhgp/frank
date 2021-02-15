<?php

require_once ('../../../config/config.inc.php');
require_once ('../../../init.php');
require_once ('../frank.php');
require_once ('../api/FrankApi.php');


$frank_api = new FrankApi();

$statics = json_decode($frank_api->getRequests('stores/store-statics/' . Configuration::get('FRANK_ID'), Configuration::get('FRANK_TOKEN')), true);
//$statics = array('status' => 200);
if ($statics['status'] === 200) {
    echo json_encode($statics);
    exit;
} else {
    echo json_encode(array('message' => 'Something went wrong'));
    exit;
}