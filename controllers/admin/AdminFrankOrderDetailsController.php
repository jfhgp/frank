<?php

class AdminFrankOrderDetailsController extends ModuleAdminController
{
    private $frank_api = null;

    public function __construct()
    {
        include_once _PS_MODULE_DIR_ . 'frank/api/FrankApi.php';

        $this->name = 'Frank';
        $this->display = 'view';
        $this->meta_title = 'Order Detail';
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
        $baseUrl = 'https://p-post.herokuapp.com/api/v1/orders/get/';
        $orderId = Configuration::get('pencil_id');

        $returns = $this->get_ahref('AdminFrankReturns');
        $shipping = $this->get_ahref('AdminFrankShipping');

        $get_order_by_id = json_decode($this->frank_api->getRequests($baseUrl . $orderId, Configuration::get('FRANK_TOKEN')), true);

//        echo '<pre>'; print_r($get_order_by_id['data']); die();

        parent::initContent();
        $this->context->smarty->assign(
            array(
                'get_order_by_id' => $get_order_by_id['data'],
                'returns' => $returns,
                'shipping' => $shipping
            )
        );


        $this->setTemplate('orderDetails.tpl');

    }

    public function setMedia($isNewTheme = false)
    {
        $this->addJquery();
        $this->addCSS(_PS_MODULE_DIR_ . '/frank/views/css/admin/orderDetails.css');
        $this->addJS(_PS_MODULE_DIR_ . '/frank/views/js/admin/orderDetails.js');
        parent::setMedia();
    }

    private function get_ahref($controller){
        $stat = _PS_ADMIN_DIR_;
        $admin_folder = substr(strrchr($stat, "admin "), 0);
        $token = Tools::getAdminTokenLite($controller);
        return _PS_BASE_URL_.__PS_BASE_URI__.$admin_folder.'/index.php?controller='.$controller.'&token='.$token;
    }
}