<?php

require_once ('../../config/config.inc.php');
require_once ('../../init.php');
require_once ('frank.php');
require_once ('api/FrankApi.php');


$frank_api = new FrankApi();
$id = $_POST['_id'];
Configuration::updateValue('pencil_id', $id);
//sleep(1);
echo $id;

//$api_franks = $frank_api->getRequests('https://p-post.herokuapp.com/api/v1/orders/store/' . Configuration::get('FRANK_ID') . '/all', Configuration::get('FRANK_TOKEN'));
//
//echo $api_franks;
