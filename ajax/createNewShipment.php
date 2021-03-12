<?php

require_once ('../../../config/config.inc.php');
require_once ('../../../init.php');
require_once ('../frank.php');
require_once ('../api/FrankApi.php');


$frank_api = new FrankApi();

//if (
//    empty($_POST['item_name']) ||
//    empty($_POST['quantity']) ||
//    empty($_POST['width']) ||
//    empty($_POST['height']) ||
//    empty($_POST['length']) ||
//    empty($_POST['weight']) ||
//    empty($_POST['full_name']) ||
//    empty($_POST['phone_number']) ||
//    empty($_POST['email_address']) ||
//    empty($_POST['pickup_date']) ||
//    empty($_POST['delivery_type']) ||
//    empty($_POST['dropoff_address'])
//) {
//    echo json_encode(array('error' => 'Parameters are missing'));
//    exit;
//}

if (empty($_POST['item_name'])) {
    echo json_encode(array('error' => 'Item name is missing'));
    exit;
}

if (empty($_POST['quantity'])) {
    echo json_encode(array('error' => 'Item quantity is missing'));
    exit;
}

if (empty($_POST['width'])) {
    echo json_encode(array('error' => 'Item width is missing'));
    exit;
}

if (empty($_POST['height'])) {
    echo json_encode(array('error' => 'Item height is missing'));
    exit;
}

if (empty($_POST['length'])) {
    echo json_encode(array('error' => 'Item length is missing'));
    exit;
}

if (empty($_POST['weight'])) {
    echo json_encode(array('error' => 'Item weight is missing'));
    exit;
}

if (empty($_POST['full_name'])) {
    echo json_encode(array('error' => 'Full name is missing'));
    exit;
}

if (empty($_POST['phone_number'])) {
    echo json_encode(array('error' => 'Phone is missing'));
    exit;
}

if (empty($_POST['email_address'])) {
    echo json_encode(array('error' => 'Email address is missing'));
    exit;
}

if (empty($_POST['pickup_date'])) {
    echo json_encode(array('error' => 'Pickup date is missing'));
    exit;
}

if (empty($_POST['delivery_type'])) {
    echo json_encode(array('error' => 'Delivery service is missing'));
    exit;
}

if (empty($_POST['dropoff_address'])) {
    echo json_encode(array('error' => 'Drop off address is missing'));
    exit;
}



$twelve_digit = '';
for($i = 0; $i < 12; $i++) { $twelve_digit .= mt_rand(0, 9); }

$params = array(
    'type' => 'delivery',
        'pickup' => array(
            'address' => $_POST['pickup_address'],
            'location' => array(
                (float)Configuration::get('FRANK_LONGITUDE'),
                (float)Configuration::get('FRANK_LATITUDE')
            ),
            'shortAddress' => $_POST['pickup_address'],
            'city' => Configuration::get('FRANK_STORE_CITY'),
            'country' => Configuration::get('FRANK_STORE_COUNTRY')
        ),
        'dropoff' => array(
            'address' => $_POST['dropoff_address'],
            'location' => array(
                (float)$_POST['new-shipment-lng'],
                (float)$_POST['new-shipment-lat']
            ),
            'shortAddress' => $_POST['dropoff_address'],
            'city' => $_POST['new-shipment-city'],
            'country' => $_POST['new-shipment-country'],
        ),

        'returnAddress' => array(
            'address' => $_POST['return_address'],
            'location' => array(
                (float)Configuration::get('FRANK_LONGITUDE'),
                (float)Configuration::get('FRANK_LATITUDE')
            ),
            'shortAddress' => $_POST['return_address'],
            'city' => Configuration::get('FRANK_STORE_CITY'),
            'country' => Configuration::get('FRANK_STORE_COUNTRY')
        ),

        'commodities' => array(
            array(
                'name' => $_POST['item_name'],
                'quantity' => $_POST['quantity'],
                'canReturn' => $_POST['active']  ? true : false,
                'maxReturnDays' => (int)$_POST['can_return_input'],
                'weight' => (int)$_POST['weight'],
                'length' => (int)$_POST['length'],
                'width' => (int)$_POST['width'],
                'height' => (int)$_POST['height']
            )
        ),
        'items' => array(
            array(
                'item' => '',
                'size' => [(int)$_POST['width'], (int)$_POST['length'], (int)$_POST['height'], (int)$_POST['weight']],
                'service' => strtolower($_POST['delivery_type']),
                'store' => Configuration::get('FRANK_ID'),
                'quantity' => $_POST['quantity'],
            )
        ),
        'pickupDate' => date("m/d/Y", strtotime($_POST['pickup_date'])),
        'contact' => array(
            'name' => $_POST['full_name'],
            'number' => $_POST['phone_number'],
            'countryCode' => '92',
            'email' => $_POST['email_address']
        ),
        'deliveryType' => $_POST['delivery_type'],
        'totalWeight' => (int)$_POST['weight'],
        'totalWidth' => (int)$_POST['width'],
        'totalHeight' => (int)$_POST['height'],
        'totalLength' => (int)$_POST['length'],
        'priceImpact' => 20,
        'orderNumber' => $twelve_digit,
        'store' => Configuration::get('FRANK_ID'),
        'storeOrderID' => $_POST['orderNumber']
    );
$res = $frank_api->doCurlRequest('orders/createShipment', $params, Configuration::get('FRANK_TOKEN'));
$res = json_decode($res, true);
if ($res['status'] === 200) {
    echo json_encode(array('status' => 200, 'success' => 'New Shipment added successfully!'));
    exit;
}