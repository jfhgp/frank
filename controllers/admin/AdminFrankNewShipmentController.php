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
        $api_warehouses = json_decode($this->frank_api->getRequests('stores/warehouse', Configuration::get('FRANK_TOKEN')), true);
        $shipping = $this->get_ahref('AdminFrankShipping');
        $returns = $this->get_ahref('AdminFrankReturns');
        $new_shipment = $this->get_ahref('AdminFrankNewShipment');
        $settings = $this->get_ahref('AdminFrankSettings');

        parent::initContent();
        $this->context->smarty->assign(
            array(
                'api_warehouses' => $api_warehouses['data'],
                'shipping' => $shipping,
                'returns' => $returns,
                'settings' => $settings,
            )
        );

//        if (Tools::isSubmit('create_new_shipping')) {
//            $this->createNewShipment();
//        }


        $this->setTemplate('newShipment.tpl');

    }

    public function setMedia($isNewTheme = false)
    {
        $this->addJquery();
        $this->addCSS(_PS_MODULE_DIR_ . '/frank/views/css/admin/bootstrap.css');
        $this->addCSS(_PS_MODULE_DIR_ . '/frank/views/css/admin/all.css');
        $this->addCSS(_PS_MODULE_DIR_ . '/frank/views/css/admin/newShipment.css');
        $this->addJS(_PS_MODULE_DIR_ . '/frank/views/js/admin/all.js');
        $this->addJS(_PS_MODULE_DIR_ . '/frank/views/js/admin/newShipment.js');
        parent::setMedia();
    }

    private function get_ahref($controller){
        $stat = _PS_ADMIN_DIR_;
//        $admin_folder = substr(strrchr($stat, "admin "), 0);
        $admin_folder = substr($stat, strpos($stat, "admin"));
        $token = Tools::getAdminTokenLite($controller);
        return _PS_BASE_URL_.__PS_BASE_URI__.$admin_folder.'/index.php?controller='.$controller.'&token='.$token;
    }

    private function createNewShipment()
    {
        $twelve_digit = '';
        for($i = 0; $i < 12; $i++) { $twelve_digit .= mt_rand(0, 9); }

        $params = array(
            'type' => 'delivery',
            'pickup' => array(
                'address' => Tools::getValue('pickup_address'),
                'location' => array(
                    (float)Configuration::get('FRANK_LONGITUDE'),
                    (float)Configuration::get('FRANK_LATITUDE')
                ),
                'shortAddress' => Tools::getValue('pickup_address'),
                'city' => Configuration::get('FRANK_STORE_CITY'),
                'country' => Configuration::get('FRANK_STORE_COUNTRY')
            ),
            'dropoff' => array(
                'address' => Tools::getValue('dropoff_address'),
                'location' => array(
                    (float)Tools::getValue('new-shipment-lng'),
                    (float)Tools::getValue('new-shipment-lat')
                ),
                'shortAddress' => Tools::getValue('dropoff_address'),
                'city' => Tools::getValue('new-shipment-city'),
                'country' => Tools::getValue('new-shipment-country'),
            ),

            'returnAddress' => array(
                'address' => Tools::getValue('return_address'),
                'location' => array(
                    (float)Configuration::get('FRANK_LONGITUDE'),
                    (float)Configuration::get('FRANK_LATITUDE')
                ),
                'shortAddress' => Tools::getValue('return_address'),
                'city' => Configuration::get('FRANK_STORE_CITY'),
                'country' => Configuration::get('FRANK_STORE_COUNTRY')
            ),

            'commodities' => array(
                array(
                    'name' => Tools::getValue('item_name'),
                    'quantity' => Tools::getValue('quantity'),
                    'canReturn' => Tools::getValue('active')  ? true : false,
                    'maxReturnDays' => (int)Tools::getValue('can_return_input'),
                    'weight' => (int)Tools::getValue('weight'),
                    'length' => (int)Tools::getValue('depth'),
                    'width' => (int)Tools::getValue('width'),
                    'height' => (int)Tools::getValue('height')
                )
            ),
            'pickupDate' => date("m/d/Y", strtotime(Tools::getValue('pickup_date'))),
            'contact' => array(
                'name' => Tools::getValue('full_name'),
                'number' => Tools::getValue('phone_number'),
                'countryCode' => '92',
                'email' => Tools::getValue('email_address')
            ),
            'deliveryType' => Tools::getValue('delivery_type'),
            'totalWeight' => (int)Tools::getValue('weight'),
            'totalWidth' => (int)Tools::getValue('width'),
            'totalHeight' => (int)Tools::getValue('height'),
            'totalLength' => (int)Tools::getValue('depth'),
            'priceImpact' => 20,
            'orderNumber' => $twelve_digit,
            'store' => Configuration::get('FRANK_ID'),
            'storeOrderID' => Tools::getValue('orderNumber')
        );
//        echo '<pre>'; print_r($params); die();
        $res = $this->frank_api->doCurlRequest('orders/createShipment', $params, Configuration::get('FRANK_TOKEN'));

//        echo '<pre>'; print_r($res); die();
    }
}