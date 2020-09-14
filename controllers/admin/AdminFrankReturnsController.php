<?php

class AdminFrankReturnsController extends ModuleAdminController
{
    private $frank_api = null;

    public function __construct()
    {
        include_once _PS_MODULE_DIR_ . 'frank/api/FrankApi.php';

        $this->name = 'Frank';
        $this->display = 'view';
        $this->meta_title = 'Returns';
        $this->bootstrap = true;

        parent::__construct();
        $this->frank_api = new FrankApi();

        if (!$this->module->active)
            Tools::redirectAdmin($this->context->link->getAdminLink('AdminHome'));
    }

    public function init()
    {
        parent::init();
    }

    public function initContent()
    {
        $baseUrl = 'https://p-post.herokuapp.com/api/v1/orders/store/';
        $storeId = Configuration::get('FRANK_ID');
        $endPoint = '/all';
        $api_franks = json_decode($this->frank_api->getRequests($baseUrl . $storeId . $endPoint, Configuration::get('FRANK_TOKEN')), true);

        $shipping = $this->get_ahref('AdminFrankShipping');
        $returns = $this->get_ahref('AdminFrankReturns');

        parent::initContent();
        $this->context->smarty->assign(['api_franks' => $api_franks['data'], 'shipping' => $shipping, 'returns' => $returns]);
        $this->setTemplate('returns.tpl');
    }

    public function initToolBarTitle()
    {
        $this->toolbar_title[] = $this->l('Returns');
        $this->toolbar_title[] = $this->l('');
    }

    public function setMedia($isNewTheme = false)
    {
        $this->addJquery();
        $this->addCSS(_PS_MODULE_DIR_ . '/frank/views/css/admin/returns.css');
        $this->addJS(_PS_MODULE_DIR_ . '/frank/views/js/admin/returns.js');
        parent::setMedia();
    }

    private function get_ahref($controller){
        $stat = _PS_ADMIN_DIR_;
        $admin_folder = substr(strrchr($stat, "admin "), 0);
        $token = Tools::getAdminTokenLite($controller);
        return _PS_BASE_URL_.__PS_BASE_URI__.$admin_folder.'/index.php?controller='.$controller.'&token='.$token;
    }
}