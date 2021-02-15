<?php

require_once ('../../../config/config.inc.php');
require_once ('../../../init.php');
require_once ('../frank.php');


if (isset($_POST['countryName']) && $_POST['countryName']) {
    $countryName = $_POST['countryName'];
    $countryCode = new Frank();
    $countryCodeName = $countryCode->countryCode($countryName);
    echo $countryCodeName;
    exit;
}