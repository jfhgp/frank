<?php

require_once ('../../../config/config.inc.php');
require_once ('../../../init.php');
require_once ('../frank.php');
require_once ('../api/FrankApi.php');

$frank_api = new FrankApi();

//if ($_FILES['upload_image']) {
//    $file = $_FILES['upload_image'];
//    $file_name = $file['tmp_name'] . '/' . $file['name'];
//    $res = $frank_api->uploadImage('users/upload', $file_name, Configuration::get('FRANK_TOKEN'));
//    echo json_encode($file);
//}

if ( isset($_FILES['upload_image']) ) {
//   print_r(json_encode($_FILES['upload_image']['name']));
   print_r($_FILES['upload_image']['name']);
}

