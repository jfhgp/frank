<?php

require_once('../../config/config.inc.php');
require_once('../../init.php');
require_once('frank.php');
require_once('api/FrankApi.php');


$frank_api = new FrankApi();

if (!empty($_POST['contact_person']) && !empty($_POST['phone']) && !empty($_POST['language'])) {
    $params = array(
        'contactDetail' => array(
            'name' => $_POST['contact_person'],
            'mobile' => $_POST['phone'],
            'language' => $_POST['language']
        ));
    $res = $frank_api->doCurlRequest('https://p-post.herokuapp.com/api/v1/stores/updateContactDetails', $params, Configuration::get('FRANK_TOKEN'));
    echo $res;
    exit;
//    echo json_encode(['status' => 200]);
}

if (!empty($_POST['add_new_email_address']) && !empty($_POST['add_new_role'])) {
    $params = array(
        'email' => $_POST['add_new_email_address'],
        'role' => $_POST['add_new_role']
    );
    $res = $frank_api->doCurlRequest('https://p-post.herokuapp.com/api/v1/stores/addEmail', $params, Configuration::get('FRANK_TOKEN'));
    echo $res;
    exit;
}

if (!empty($_POST['verification_email']) ) {
    $params = array(
        'email' => $_POST['verification_email'],
        'role' => $_POST['verification_role']
    );
    $res = $frank_api->doCurlRequest('https://p-post.herokuapp.com/api/v1/stores/resendVerification', $params, Configuration::get('FRANK_TOKEN'));
//    echo json_encode(['status' => 200]);
    echo $res;
    exit;
}

if (!empty($_POST['new_password']) && !empty($_POST['confirm_password']) && !empty($_POST['current_password'])) {
    if ($_POST['new_password'] === $_POST['confirm_password']) {
        $params = array(
            'oldPassword' => $_POST['current_password'],
            'newPassword' => $_POST['new_password'],
        );
        $res = $frank_api->doCurlRequest('https://p-post.herokuapp.com/api/v1/stores/changepassword', $params, Configuration::get('FRANK_TOKEN'));
        echo $res;
        exit;
    }
}

if (!empty($_POST['warehouse_name']) && $_POST['warehouse_address']) {
    $params = array(
        'name' => $_POST['warehouse_name'],
        'address' => $_POST['warehouse_address'],
        'city' => $_POST['warehouse_city'],
        'country' => $_POST['warehouse_country'],
        'location' => array(
            'latitude' => (float)$_POST['warehouse_lat'],
            'longitude' => (float)$_POST['warehouse_lng']
        )
    );
    $res = $frank_api->doCurlRequest('https://p-post.herokuapp.com/api/v1/stores/addWarehouse', $params, Configuration::get('FRANK_TOKEN'));
    echo $res;
    exit;
}

if (!empty($_POST['orderNumber']) && !empty($_POST['item_name']) && !empty($_POST['quantity'])) {

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
                'length' => (int)$_POST['depth'],
                'width' => (int)$_POST['width'],
                'height' => (int)$_POST['height']
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
        'totalLength' => (int)$_POST['depth'],
        'priceImpact' => 20,
        'orderNumber' => $twelve_digit,
        'store' => Configuration::get('FRANK_ID'),
        'storeOrderID' => $_POST['orderNumber']
    );
//        echo '<pre>'; print_r($params); die();
    $res = $frank_api->doCurlRequest('https://p-post.herokuapp.com/api/v1/orders/createShipment', $params, Configuration::get('FRANK_TOKEN'));
    echo $res;
//    exit;
}