<?php

require_once ('../../../config/config.inc.php');
require_once ('../../../init.php');
require_once ('../frank.php');
require_once ('../api/FrankApi.php');


$frank_api = new FrankApi();

$contactDetails = json_decode($frank_api->getRequests('stores/myprofile/' . Configuration::get('FRANK_ID'), Configuration::get('FRANK_TOKEN')), true);
if ($contactDetails['status'] === 200) {
    echo json_encode($contactDetails['data']['emailAddresses']);
    exit;
//    $html = '';
//
//    foreach ($contactDetails['data']['emailAddresses'] as $contactDetail) {
//        $html .='<form method="post" class="resend-verification-form">';
//        $html .='<div class="row">';
//        $html .='<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">';
//        $html .='<label for="">Email</label>';
//        $html .="<input type='text' name='verification_email' value='{$contactDetail['email']}' class='form-control' disabled style='border: unset; background-color: white;'>";
//        $html .='</div>';
//        $html .='<div class="col-xs-12 col-sm-12 col-md-3 col-lg-2">';
//        $html .='<label for="">Role</label>';
//        $html .="<input type='text' name='verification_role' value='{$contactDetail['role']}' class='form-control' disabled style='border: unset; background-color: white;'>";
//        $html .='</div>';
//        $html .='<div class="col-xs-12 col-sm-12 col-md-3 col-lg-2">';
//        $html .='<label for="">Company</label>';
//        $html .='<input type="text" name="verification_role" value="" disabled style="border: unset; background-color: white;">';
//        $html .='</div>';
//        $html .='<div class="col-xs-12 col-sm-12 col-md-3 col-lg-2">';
//        $html .='<label for="">Status</label>';
//        $html .='<input type="text" name="verification_role" value="" disabled style="border: unset; background-color: white;">';
//        $html .='</div>';
//        $html .='<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">';
//        $html .='<label for="" class="text-white">Status</label>';
//        $html .='<button type="submit" name="btn_resend_verification" class="btn form-control email-address-resend-verification">Resend verification</button>';
//        $html .='</div>';
//        $html .='</div>';
//        $html .='</form>';
//    }
//
//    echo json_encode(['status' => 'success', 'html' => $html]);
//    exit;
}