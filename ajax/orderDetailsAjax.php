<?php

require_once('../../config/config.inc.php');
require_once('../../init.php');
require_once('frank.php');

if (isset($_POST['_id']) && $_POST['_id']) {
    $id = $_POST['_id'];
    Configuration::updateValue('pencil_id', $id);
    echo $id;
}