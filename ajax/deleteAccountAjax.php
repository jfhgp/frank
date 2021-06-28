<?php

require_once('../../config/config.inc.php');
require_once('../../init.php');
require_once('frank.php');
require_once('api/FrankApi.php');


$frank_api = new FrankApi();
if ($_POST['_id']) {
    $res = $this->frank_api->doCurlDeleteRequest('https://p-post.herokuapp.com/api/v1/stores/deleteAccount', Configuration::get('FRANK_TOKEN'));
    echo $res;
}


