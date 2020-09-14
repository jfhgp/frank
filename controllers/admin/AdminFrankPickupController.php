<?php

class AdminFrankPickupController extends ModuleAdminController
{
    public $path = 'modules/frank/views/';
    public $identifier = 'Frank';
    private $frank_api = null;

    public function __construct()
    {
        include_once _PS_MODULE_DIR_ . 'frank/api/FrankApi.php';

        $this->name = 'Pickup';
        $this->display = 'view';
        $this->meta_title = 'Pickup';
        $this->bootstrap = true;

        parent::__construct();
        $this->frank_api = new FrankApi();

        if (!$this->module->active) {
            Tools::redirectAdmin($this->context->link->getAdminLink('AdminHome'));
        }
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
        usort($api_franks['data'], function($firstItem, $secondItem) {
            $timeStamp1 = strtotime($firstItem['createdAt']);
            $timeStamp2 = strtotime($secondItem['createdAt']);
            return $timeStamp2 - $timeStamp1;
        });

        parent::initContent();
        $this->context->smarty->assign(['api_franks' => $api_franks['data']]);
        $this->setTemplate('pickup.tpl');
    }

    public function initToolBarTitle()
    {
        $this->toolbar_title[] = $this->l('Shipping');
        $this->toolbar_title[] = $this->l('Pickup');
    }

    public function setMedia($isNewTheme = false)
    {
        $this->addJquery();
        $this->addCSS(_PS_MODULE_DIR_ . '/frank/views/css/admin/pickup.css');
        $this->addJS(_PS_MODULE_DIR_ . '/frank/views/js/admin/pickup.js');
        parent::setMedia();
    }
}