<?php

require_once('../../config/config.inc.php');
require_once('../../init.php');
require_once('frank.php');
require_once('api/FrankApi.php');

//$frank_api = null;

$frank_api = new FrankApi();

if (
    !empty($_POST['first_name']) &&
    !empty($_POST['last_name']) &&
    !empty($_POST['address_1']) &&
    !empty($_POST['city']) &&
    !empty($_POST['postal_code']) &&
    !empty($_POST['country']) &&
    !empty($_POST['mobile_number']) &&
    !empty($_POST['number_of_stores']) &&
    !empty($_POST['latitude']) &&
    !empty($_POST['longitude']) &&
    !empty($_POST['country_code'])
) {
    $form_values = array(
        'FRANK_STORE_FIRSTNAME' => $_POST['first_name'],
        'FRANK_STORE_LASTNAME' => $_POST['last_name'],
        'FRANK_ADDRESS_1' => $_POST['address_1'],
        'FRANK_ADDRESS_2' => $_POST['address_2'],
        'FRANK_ADDRESS_3' => $_POST['address_3'],
        'FRANK_STORE_CITY' => $_POST['city'],
        'FRANK_STORE_ZIPCODE' => $_POST['postal_code'],
        'FRANK_STORE_COUNTRY' => $_POST['country'],
        'FRANK_COUNTRY_CODE' => $_POST['country_code'],
        'FRANK_MOBILE' => $_POST['mobile_number'],
        'FRANK_STORE_BUSINESS' => $_POST['number_of_stores'],
        'FRANK_LATITUDE' => $_POST['latitude'],
        'FRANK_LONGITUDE' => $_POST['longitude'],
        'uniqueID' => md5(Configuration::get('PS_SHOP_DOMAIN') . Configuration::get('PS_SHOP_NAME'))
    );

    if (!empty(Configuration::get('FRANK_ID'))){
        $data = array(
            '_id' => Configuration::get('FRANK_ID'),
            'name' => Configuration::get('PS_SHOP_NAME'),
            'platform' => 'Prestashop',
            'email' => Configuration::get('PS_SHOP_EMAIL'),
            'location1' => ['longitude' => $form_values['FRANK_LONGITUDE'], 'latitude' => $form_values['FRANK_LATITUDE']],
        );
        $res = $frank_api->doCurlRequest("https://p-post.herokuapp.com/api/v1/stores/update", $data, Configuration::get('FRANK_TOKEN'));
        $res = json_decode($res, true);
        if ($res['status'] === 200) {
            echo '{"status": 300}';
            exit;
        }
    } else {
        $data = array(
            'name' => Configuration::get('PS_SHOP_NAME'),
            'storeURL' => Configuration::get('PS_SHOP_DOMAIN'),
            'email' => Configuration::get('PS_SHOP_EMAIL'),
            'platform' => 'Prestashop',
            'location1' => ['longitude' => $form_values['FRANK_LONGITUDE'], 'latitude' => $form_values['FRANK_LATITUDE'] ],
            'firstName' => $form_values['FRANK_STORE_FIRSTNAME'],
            'lastName' => $form_values['FRANK_STORE_LASTNAME'],
            'address1' => $form_values['FRANK_ADDRESS_1'],
            'address2' => $form_values['FRANK_ADDRESS_2'],
            'address3' => $form_values['FRANK_ADDRESS_3'],
            'city' => $form_values['FRANK_STORE_CITY'],
            'country' => $form_values['FRANK_STORE_ZIPCODE'],
            'countryCode' => $form_values['FRANK_STORE_COUNTRY'],
            'zipCode' => $form_values['FRANK_COUNTRY_CODE'],
            'mobile' => $form_values['FRANK_MOBILE'],
            'totalStores' => (int)$form_values['FRANK_STORE_BUSINESS'],
            'uniqueID' => $form_values['uniqueID']
        );

        $res = $frank_api->doCurlRequest("https://p-post.herokuapp.com/api/v1/stores/signup", $data);
        echo $res;
        exit;
//
//        $res = json_decode($res, true);
//        Configuration::updateValue('FRANK_TOKEN', $res['data']['token']);
//        Configuration::updateValue('FRANK_ID', $res['data']['_id']);
    }
}

if (isset($_POST['countryName']) && $_POST['countryName']) {
    $countryName = $_POST['countryName'];
    $countryCode = new Frank();
    $countryCodeName = $countryCode->countryCode($countryName);
    echo $countryCodeName;
    exit;
}

//print_r($form_values);
