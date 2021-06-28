<?php

require_once('../../config/config.inc.php');
require_once('../../init.php');
require_once('frank.php');
require_once('api/FrankApi.php');


$frank_api = new FrankApi();

$api_warehouses = json_decode($frank_api->getRequests('https://p-post.herokuapp.com/api/v1/stores/warehouse', Configuration::get('FRANK_TOKEN')), true);
$html = '';

$html .= '<tbody>';
foreach ($api_warehouses['data'] as $api_warehouse) {
    $html .= '<tr>';
    $html .= '<td scope="col" style="width: 165px;">' . $api_warehouse['name'] . '</td>';
    $html .= '<td scope="col" style="padding-left: 60px; width: 250px; ">' . $api_warehouse['address'] . '</td>';
    $html .= '<td scope="col" style="padding-left: 100px;"><a style="text-decoration: none" href="#" id="update-warehouse"><i class="material-icons" style="font-size: 15px; color: grey;">create</i></a></td>';
    $html .= '<td scope="col" style="padding-left: 20px;"><a href="#" class="delete-warehouse" data-id_warehouse='. $api_warehouse['_id'] .'><i class="material-icons" style="font-size: 15px; color: grey;">delete</i></a></td>';
    $html .= '</tr>';
}
$html .= '</tbody>';
echo json_encode(['status' => 'success', 'html' => $html]);