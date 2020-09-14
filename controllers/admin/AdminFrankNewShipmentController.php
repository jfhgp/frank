<?php

class AdminFrankNewShipmentController extends ModuleAdminController
{
    private $frank_api = null;

    public function __construct()
    {
        include_once _PS_MODULE_DIR_ . 'frank/api/FrankApi.php';

        $this->name = 'Frank';
        $this->display = 'view';
        $this->meta_title = 'New shipment';
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

        parent::initContent();
        $this->context->smarty->assign(array());


        $this->setTemplate('newShipment.tpl');

    }

    public function setMedia($isNewTheme = false)
    {
        $this->addJquery();
//        $this->addCSS(_PS_MODULE_DIR_ . '/frank/views/css/admin/bootstrap.css');
        $this->addCSS(_PS_MODULE_DIR_ . '/frank/views/css/admin/newShipment.css');
        $this->addJS(_PS_MODULE_DIR_ . '/frank/views/js/admin/newShipment.js');
        parent::setMedia();
    }

    private function get_ahref($controller){
        $stat = _PS_ADMIN_DIR_;
        $admin_folder = substr(strrchr($stat, "admin "), 0);
        $token = Tools::getAdminTokenLite($controller);
        return _PS_BASE_URL_.__PS_BASE_URI__.$admin_folder.'/index.php?controller='.$controller.'&token='.$token;
    }
}