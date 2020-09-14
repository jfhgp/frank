<?php

require_once ('../../config/config.inc.php');
require_once ('../../init.php');
require_once ('frank.php');
require_once ('api/FrankApi.php');

$frank_api = null;

//$emailVerification = array(
//    'email' => $_POST['verification_email'],
//    'role' => $_POST['verification_role'],
//);
//
//print_r($emailVerification);

//echo $emailVerification;

//$frank_api = new FrankApi();
//
//
//$frank_api->doCurlRequest('https://p-post.herokuapp.com/api/v1/orders/readyForPickup', $readyForPickup, Configuration::get('FRANK_TOKEN'));
//
//echo json_encode(['status' => 'success', 'message' => 'Record inserted']);