<?php

require_once ('../../../config/config.inc.php');
require_once ('../../../init.php');
require_once ('../frank.php');
require_once ('../api/FrankApi.php');


$frank_api = new FrankApi();

if (
    empty($_POST['first_name']) ||
    empty($_POST['last_name']) ||
    empty($_POST['email']) ||
    empty($_POST['password']) ||
    empty($_POST['confirm_password']) ||
    empty($_POST['address_1']) ||
    empty($_POST['latitude']) ||
    empty($_POST['longitude']) ||
    empty($_POST['city']) ||
    empty($_POST['postal_code']) ||
    empty($_POST['country']) ||
    empty($_POST['country_code']) ||
    empty($_POST['mobile_number'])

) {
    echo json_encode(array('error' => 'Credentials are missing'));
    exit;
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    echo json_encode(array('error' => 'Invalid email format'));
    exit;
}

if ($_POST['number_of_stores'] < 1) {
    echo json_encode(array('error' => 'Number of stores must be more than 0'));
    exit;
}

if ($_POST['password'] !== $_POST['confirm_password']) {
    echo json_encode(array('error' => 'Passwords are not matching'));
    exit;
}

if (strlen($_POST['password']) < 8) {
    echo json_encode(array('error' => 'Passwords must be 8 characters'));
    exit;
}

if (strlen($_POST['mobile_number']) < 6) {
    echo json_encode(array('error' => 'Phone Number must be 6 characters'));
    exit;
}

$data = array(
    'name' => Configuration::get('PS_SHOP_NAME'),
    'storeURL' => Configuration::get('PS_SHOP_DOMAIN'),
    'endPoint' => str_replace('/', '', __PS_BASE_URI__),
    'platform' => 'Prestashop',
    'location1' => ['latitude' => $_POST['latitude'], 'longitude' => $_POST['longitude'] ],
    'location2' => ['latitude' => 0 , 'longitude' => 0, ],
    'location3' => [ 'latitude' => 0, 'longitude' => 0, ],
    'firstName' => $_POST['first_name'],
    'lastName' => $_POST['last_name'],
    'email' => $_POST['email'],
    'password' => $_POST['password'],
    'address1' => $_POST['address_1'],
    'address2' => $_POST['address_2'],
    'address3' => $_POST['address_3'],
    'city' => $_POST['city'],
    'country' => $_POST['country'],
    'countryCode' => $_POST['country_code'],
    'zipCode' => $_POST['postal_code'],
    'mobile' => $_POST['mobile_number'],
    'totalStores' => (int)$_POST['number_of_stores'],

    'facebook' => $_POST['facebook'],
    'instagram' => $_POST['instagram'],
    'acceptsReturn' => $_POST['acceptsReturn'] = 'Yes' ? true : false,

    'uniqueID' => md5(Configuration::get('PS_SHOP_DOMAIN') . Configuration::get('PS_SHOP_NAME') . Tools::getValue('email')),
);


if (!empty(Configuration::get('FRANK_TOKEN'))) {
    echo json_encode(array('status' => 200, 'success' => 'You are already applied'));
    exit;
} else {
    $res = $frank_api->doCurlRequest("stores/signup", $data);

    $res = json_decode($res, true);
    if ($res['status'] === 200) {
        if (empty(Configuration::get('FRANK_TOKEN'))) Configuration::updateValue('FRANK_TOKEN', $res['data']['token']);

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
        if (empty(Configuration::get('FRANK_LATITUDE'))) Configuration::updateValue('FRANK_LATITUDE', $res['data']['location1']['coordinates'][1]);
        if (empty(Configuration::get('FRANK_LONGITUDE'))) Configuration::updateValue('FRANK_LONGITUDE', $res['data']['location1']['coordinates'][0]);

        Configuration::updateValue('UNIQUE_ID', $res['data']['uniqueID']);
        echo json_encode(array('status' => 200, 'success' => 'You are successfully applied'));
        exit;
    } else {
        echo json_encode(array('error' => 'Something went wrong'));
        exit;
    }
}