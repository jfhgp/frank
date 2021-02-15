<?php

require_once ('../../../config/config.inc.php');
require_once ('../../../init.php');
require_once ('../frank.php');
require_once ('../api/FrankApi.php');


$frank_api = new FrankApi();

$id = $_POST['warehouse_id'];
if (empty($id)) {
    if (
        !empty($_POST['warehouse_name']) &&
        !empty($_POST['warehouse_address']) &&
        !empty($_POST['warehouse_city']) &&
        !empty($_POST['warehouse_country']) &&
        !empty($_POST['warehouse_lat']) &&
        !empty($_POST['warehouse_lng'])
    ) {
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
    }
    $res = $frank_api->doCurlRequest('stores/addWarehouse', $params, Configuration::get('FRANK_TOKEN'));
    echo $res;
}
 else {
     if (
         !empty($_POST['warehouse_name']) &&
         !empty($_POST['warehouse_address']) &&
         !empty($_POST['warehouse_city']) &&
         !empty($_POST['warehouse_country']) &&
         !empty($_POST['warehouse_lat']) &&
         !empty($_POST['warehouse_lng'])
     ) {
         $params = array(
             'name' => $_POST['warehouse_name'],
             'address' => $_POST['warehouse_address'],
             'city' => $_POST['warehouse_city'],
             'country' => $_POST['warehouse_country'],
             'location' => array(
                 'coordinates' => [(float)$_POST['warehouse_lng'], (float)$_POST['warehouse_lat']]
//                 'latitude' => (float)$_POST['warehouse_lat'],
//                 'longitude' => (float)$_POST['warehouse_lng']
             )
         );
     }
     $res = $frank_api->doCurlRequest('stores/warehouse/' . $id, $params, Configuration::get('FRANK_TOKEN'));
//        echo json_encode($params);
     echo $res;
 }