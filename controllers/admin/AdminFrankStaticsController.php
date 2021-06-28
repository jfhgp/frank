<?php

class AdminFrankSettingsController extends ModuleAdminController
{
    private $frank_api = null;

    public function __construct()
    {
        include_once _PS_MODULE_DIR_ . 'frank/api/FrankApi.php';

        $this->name = 'Frank';
        $this->display = 'view';
        $this->meta_title = 'Settings';
        $this->bootstrap = true;

        parent::__construct();
        $this->frank_api = new FrankApi();

        if (!$this->module->active)
            Tools::redirectAdmin($this->context->link->getAdminLink('AdminFrankShipping'));
    }

    public function init()
    {
        parent::init();
    }

    public function initContent()
    {
//        if (Tools::isSubmit('btn_upload_image')) {
//
//            $filename = $_FILES['upload_image'];
//
//            echo '<pre>'; print_r($filename); die();
//
//            $curl = curl_init();
//
//            curl_setopt_array($curl, array(
//                CURLOPT_URL => "users/upload",
//                CURLOPT_RETURNTRANSFER => true,
//                CURLOPT_ENCODING => "",
//                CURLOPT_MAXREDIRS => 10,
//                CURLOPT_TIMEOUT => 0,
//                CURLOPT_FOLLOWLOCATION => true,
//                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                CURLOPT_CUSTOMREQUEST => "POST",
//                CURLOPT_POSTFIELDS => array('file'=> new CURLFILE($data)),
//                CURLOPT_HTTPHEADER => array(
//                    "Content-Type: application/x-www-form-urlencoded",
//                    "Authorization: Bearer " . Configuration::get('FRANK_TOKEN')
//                ),
//            ));
//
//            $response = curl_exec($curl);
//
//            curl_close($curl);
//            echo '<pre>' . $response; die();
//        }
        $api_email_addresses = json_decode($this->frank_api->getRequests('stores/myprofile/' . Configuration::get('FRANK_ID'), Configuration::get('FRANK_TOKEN')), true);
        $shipping = $this->get_ahref('AdminFrankShipping');
        $returns = $this->get_ahref('AdminFrankReturns');
//        $new_shipment = $this->get_ahref('AdminFrankNewShipment');
        $settings = $this->get_ahref('AdminFrankSettings');
        parent::initContent();
        $this->context->smarty->assign(
            array(
                'api_email_addresses' => $api_email_addresses['data']['emailAddresses'],
                'shipping' => $shipping,
                'returns' => $returns,
                'settings' => $settings
            )
        );

        $this->setTemplate('settings.tpl');

    }

    public function setMedia($isNewTheme = false)
    {
        $this->addJquery();
        $this->addCSS(_PS_MODULE_DIR_ . '/frank/views/css/admin/bootstrap.css');
        $this->addCSS(_PS_MODULE_DIR_ . '/frank/views/css/admin/all.css');
        $this->addCSS(_PS_MODULE_DIR_ . '/frank/views/css/admin/settings.css');
        $this->addJS(_PS_MODULE_DIR_ . '/frank/views/js/admin/all.js');
        $this->addJS(_PS_MODULE_DIR_ . '/frank/views/js/admin/settings.js');
        parent::setMedia();
    }

    private function get_ahref($controller){
        $stat = _PS_ADMIN_DIR_;
//        $admin_folder = substr(strrchr($stat, "admin "), 0);
        $admin_folder = substr($stat, strpos($stat, "admin"));
        $token = Tools::getAdminTokenLite($controller);
        return _PS_BASE_URL_.__PS_BASE_URI__.$admin_folder.'/index.php?controller='.$controller.'&token='.$token;
    }

    public function getCurlValue($filename, $contentType, $postname)
    {
        if (function_exists('curl_file_create')) {
            return curl_file_create($filename, $contentType, $postname);
        }

        $value = "@{$this->filename};filename=" . $postname;
        if ($contentType) {
            $value .= ';type=' . $contentType;
        }

        return $value;
    }
}