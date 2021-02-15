<?php

require_once ('../../../config/config.inc.php');
require_once ('../../../init.php');
require_once ('../frank.php');
require_once ('../api/FrankApi.php');


$frank_api = new FrankApi();

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    echo json_encode(array('error' => 'Invalid email format'));
    exit;
}

if (empty($_POST['email']) || empty($_POST['password'])) {
    echo json_encode(array('error' => 'Credentials are missing'));
    exit;
}

$data = array('email' => $_POST['email'], 'password' => $_POST['password']);

    $res = $frank_api->doCurlRequest("stores/login", $data);

    $res = json_decode($res, true);
    if ($res['status'] === 200) {
        Configuration::updateValue('FRANK_TOKEN', $res['data']['token']);
        Configuration::updateValue('FRANK_ID', $res['data']['_id']);
        Configuration::updateValue('FRANK_FIRSTNAME', $res['data']['firstName']);
        Configuration::updateValue('FRANK_LASTNAME', $res['data']['lastName']);
        Configuration::updateValue('FRANK_EMAIL', $res['data']['email']);
        Configuration::updateValue('FRANK_ADDRESS_1', $res['data']['address1']);
        Configuration::updateValue('FRANK_ADDRESS_2', $res['data']['address2']);
        Configuration::updateValue('FRANK_ADDRESS_3', $res['data']['address3']);
        Configuration::updateValue('FRANK_CITY', $res['data']['city']);
        Configuration::updateValue('FRANK_ZIPCODE', $res['data']['zipCode']);
        Configuration::updateValue('FRANK_COUNTRY', $res['data']['country']);
        Configuration::updateValue('FRANK_CODE', $res['data']['countryCode']);
        Configuration::updateValue('FRANK_MOBILE', $res['data']['mobile']);
        Configuration::updateValue('FRANK_BUSINESS', $res['data']['totalStores']);
        Configuration::updateValue('FRANK_RETURN', $res['data']['acceptsReturn']);
        Configuration::updateValue('UNIQUE_ID', $res['data']['uniqueID']);
        echo json_encode(array('status' => 200, 'success' => 'You are successfully logged in'));
        exit;
    } else {
        echo json_encode(array('error' => 'Wrong password or email'));
        exit;
    }