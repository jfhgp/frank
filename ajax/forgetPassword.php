<?php

require_once ('../../../config/config.inc.php');
require_once ('../../../init.php');
require_once ('../frank.php');
require_once ('../api/FrankApi.php');


$frank_api = new FrankApi();

if (empty($_POST['email'])) {
    echo json_encode(array('error' => 'Please provide the email address'));
    exit;
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    echo json_encode(array('error' => 'Invalid email format'));
    exit;
}

$data = array('email' => $_POST['email']);
//echo json_encode(array('status' => 200, 'success' => 'Verification code sent on you mobile number'));
//exit;

$res = $frank_api->doCurlRequest("stores/forgotpassword", $data);
$res = json_decode($res, true);

if ($res['status'] === 200) {
    echo json_encode(array('status' => 200, 'success' => 'Verification code sent on you mobile number'));
    exit;
} else {
    echo json_encode(array('error' => 'No store found on this email'));
    exit;
}

