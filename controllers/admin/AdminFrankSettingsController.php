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
        $api_email_addresses = json_decode($this->frank_api->getRequests('stores/myprofile/' . Configuration::get('FRANK_ID'), Configuration::get('FRANK_TOKEN')), true);
        $shipping = $this->get_ahref('AdminFrankShipping');
        $returns = $this->get_ahref('AdminFrankReturns');
        $statics = $this->get_ahref('AdminFrankStatics');
        $settings = $this->get_ahref('AdminFrankSettings');
        parent::initContent();
        $this->context->smarty->assign(
            array(
                'api_email_addresses' => $api_email_addresses['data']['emailAddresses'],
                'shipping' => $shipping,
                'returns' => $returns,
                'settings' => $settings,
                'statics' => $statics,
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