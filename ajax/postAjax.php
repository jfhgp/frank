<?php

require_once ('../../../config/config.inc.php');
require_once ('../../../init.php');
require_once ('../frank.php');
require_once ('../api/FrankApi.php');


$frank_api = new FrankApi();

if (!empty($_POST['contact_person']) && !empty($_POST['phone']) && !empty($_POST['language'])) {
    $params = array(
        'contactDetail' => array(
            'name' => $_POST['contact_person'],
            'mobile' => $_POST['phone'],
            'language' => $_POST['language']
        ));
    $res = $frank_api->doCurlRequest('stores/updateContactDetails', $params, Configuration::get('FRANK_TOKEN'));
    echo $res;
    exit;
//    echo json_encode(['status' => 200]);
}

if (!empty($_POST['add_new_email_address']) && !empty($_POST['add_new_role'])) {
    $params = array(
        'email' => $_POST['add_new_email_address'],
        'role' => $_POST['add_new_role']
    );
    $res = $frank_api->doCurlRequest('stores/addEmail', $params, Configuration::get('FRANK_TOKEN'));
    echo $res;
    exit;
}

if (!empty($_POST['verification_email']) ) {
    $params = array(
        'email' => $_POST['verification_email'],
        'role' => $_POST['verification_role']
    );
    $res = $frank_api->doCurlRequest('stores/resendVerification', $params, Configuration::get('FRANK_TOKEN'));
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
        $res = $frank_api->doCurlRequest('stores/changepassword', $params, Configuration::get('FRANK_TOKEN'));
        echo $res;
        exit;
    }
}