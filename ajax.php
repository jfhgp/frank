<?php

require_once ('../../config/config.inc.php');
require_once ('../../init.php');
require_once ('frank.php');
require_once ('api/FrankApi.php');

$frank_api = null;

$readyForPickup = array(
    '_id' => $_POST['_id'],
    'pickupDate' => date("m/d/Y", strtotime($_POST['pickupDate']))
);

print_r($readyForPickup);

$frank_api = new FrankApi();

//if (isset($_POST['update-contact-detail'])) {
//    $params = array(
//            'contactDetail' => array(
//                'name' => $_POST['contact_person'],
//                'mobile' => $_POST['phone'],
//                'language' => $_POST['language']
//            ));
//
//    $res = $frank_api->doCurlRequest('https://p-post.herokuapp.com/api/v1/stores/updateContactDetails', $params, Configuration::get('FRANK_TOKEN'));
//    echo json_encode(['status' => 'success', 'message' => 'Record inserted']);
//}
//$params = array(
//    'contactDetail' => array(
//        'name' => $_POST['contact_person'],
//        'mobile' => $_POST['phone'],
//        'language' => $_POST['language']
//    ));
//
//$res = $frank_api->doCurlRequest('https://p-post.herokuapp.com/api/v1/stores/updateContactDetails', $params, Configuration::get('FRANK_TOKEN'));
//echo json_encode($res);
//
//$frank_api->doCurlRequest('https://p-post.herokuapp.com/api/v1/orders/readyForPickup', $readyForPickup, Configuration::get('FRANK_TOKEN'));
//
//echo json_encode(['status' => 'success', 'message' => 'Record inserted']);