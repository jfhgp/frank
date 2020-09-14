<?php
/**
 * 2007-2020 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 *  @author    PrestaShop SA <contact@prestashop.com>
 *  @copyright 2007-2020 PrestaShop SA
 *  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

class Frank extends CarrierModule
{
    private $frank_api = null;
    protected $config_form = false;

    public function __construct()
    {
        $this->name = 'frank';
        $this->tab = 'shipping_logistics';
        $this->version = '1.0.0';
        $this->author = 'HiTech';
        $this->need_instance = 0;
        $this->error_count = 0;
        /**
         * Set $this->bootstrap to true if your module is compliant with bootstrap (PrestaShop 1.6)
         */
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Frank');
        $this->description = $this->l('Here is the Frank module for Prestashop');

        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);

        include_once _PS_MODULE_DIR_ . 'frank/api/FrankApi.php';

//        $this->callApi();
        $this->frank_api = new FrankApi();
    }

    /**
     * Don't forget to create update methods if needed:
     * http://doc.prestashop.com/display/PS16/Enabling+the+Auto-Update
     */
    public function install()
    {
        if (extension_loaded('curl') == false)
        {
            $this->_errors[] = $this->l('You have to enable the cURL extension on your server to install this module');
            return false;
        }

        $carrier = $this->addCarrier('FRANK FLEX');
        $this->addZones($carrier);
        $this->addGroups($carrier);
        $this->addRanges($carrier);

        $carrier = $this->addCarrier('FRANK GREEN');
        $this->addZones($carrier);
        $this->addGroups($carrier);
        $this->addRanges($carrier);

        $carrier = $this->addCarrier('FRANK CLASSIC');
        $this->addZones($carrier);
        $this->addGroups($carrier);
        $this->addRanges($carrier);

        Configuration::updateValue('FRANK_LIVE_MODE', false);

        return parent::install() &&
            $this->registerHook('header') &&
            $this->registerHook('actionValidateCustomerAddressForm') &&
            $this->registerHook('backOfficeHeader') &&
            $this->registerHook('displayOrderConfirmation') &&
            $this->registerHook('updateCarrier') &&
            $this->registerHook('actionFrontControllerSetMedia') &&
            $this->registerHook('displayBeforeBodyClosingTag') &&
            $this->installModuleTab('AdminFrankShipping', 'Shipping', Tab::getIdFromClassName('AdminParentShipping')) &&
            $this->installModuleTab('AdminFrankReturns', 'Returns', Tab::getIdFromClassName('AdminParentShipping')) &&
            $this->installModuleTab('AdminFrankPickup', 'Pickup', Tab::getIdFromClassName('AdminParentShipping')) &&
            $this->installModuleTab('AdminFrankOrderDetails', 'OrderDetails', 0) &&
            $this->installModuleTab('AdminFrankNewShipment', 'NewShipment', 0) &&
            $this->installModuleTab('AdminFrankSettings', 'Settings', 0)
            ;
    }

    public function uninstall()
    {
        Configuration::deleteByName('FRANK_LIVE_MODE');

        return parent::uninstall()
            && $this->uninstallModuleTab('AdminFrank')
            && $this->uninstallModuleTab('AdminFrankShipping')
            && $this->uninstallModuleTab('AdminFrankReturns')
            && $this->uninstallModuleTab('AdminFrankPickup')
            && $this->uninstallModuleTab('AdminFrankSettings')
            && $this->uninstallModuleTab('AdminFrankOrderDetails')
            && $this->uninstallModuleTab('AdminFrankSettings')
            && $this->uninstallModuleTab('AdminFrankNewShipment');
    }


    // Tabs
    private function installModuleTab($tab_class, $tab_name, $id_tab_parent)
    {
        $tab = new Tab();

        $languages = Language::getLanguages(false);
        foreach ($languages as $language) {
            $tab->name[$language['id_lang']] = $tab_name;
        }
        $tab->class_name = $tab_class;
        $tab->module = $this->name;
        $tab->id_parent = $id_tab_parent;

        if (!$tab->save()) {
            return false;
        }
        return true;
    }

    private function uninstallModuleTab($tab_class)
    {
        $id_tab = Tab::getIdFromClassName($tab_class);
        if ($id_tab != 0) {
            $tab = new Tab($id_tab);
            $tab->delete();
            return true;
        }
        return false;
    }

    /**
     * Load the configuration form
     */
    public function getContent()
    {
        if (Tools::isSubmit('submitConfirmation')) {
            $params = array(
                'mobile' => Tools::getValue('mobile'),
                'smsCode' => Tools::getValue('smsCode'),
            );
//            $res = json_decode($params, true);
            $res = $this->frank_api->doCurlRequest('https://p-post.herokuapp.com/api/v1/stores/verifylogin', $params);
            $res = json_decode($res, true);
//            echo '<pre>'; print_r($res); die();
            if ($res['status'] === 200) {
                Configuration::updateValue('FRANK_STORE_FIRSTNAME', Tools::getValue('con_first_name'));
                Configuration::updateValue('FRANK_STORE_LASTNAME', Tools::getValue('con_last_name'));
                Configuration::updateValue('FRANK_ADDRESS_1', Tools::getValue('con_address_1'));
                Configuration::updateValue('FRANK_ADDRESS_2', Tools::getValue('con_address_2'));
                Configuration::updateValue('FRANK_ADDRESS_3', Tools::getValue('con_address_3'));
                Configuration::updateValue('FRANK_STORE_CITY', Tools::getValue('con_city'));
                Configuration::updateValue('FRANK_STORE_ZIPCODE', Tools::getValue('con_zip_code'));
                Configuration::updateValue('FRANK_STORE_COUNTRY', Tools::getValue('con_country'));
                Configuration::updateValue('FRANK_COUNTRY_CODE', Tools::getValue('con_country_code'));
                Configuration::updateValue('FRANK_MOBILE', Tools::getValue('con_mobile'));
                Configuration::updateValue('FRANK_STORE_BUSINESS', Tools::getValue('con_stores'));
                Configuration::updateValue('FRANK_LATITUDE', Tools::getValue('con_latitude'));
                Configuration::updateValue('FRANK_LONGITUDE', Tools::getValue('con_longitude'));
                Configuration::updateValue('FRANK_UNIQUE_ID', md5(Configuration::get('PS_SHOP_DOMAIN') . Configuration::get('PS_SHOP_NAME')));

                Configuration::updateValue('FRANK_TOKEN', $res['data']['token']);
                Configuration::updateValue('FRANK_ID', $res['data']['_id']);

//                echo '<pre>'; print_r($res); die();
            }
            $this->context->smarty->assign(array());

//            echo '<pre>'; print_r($params); die();
        }
        return $this->display(__FILE__, 'views/templates/admin/configuration.tpl');
    }

    public function processConfiguration()
    {
        $form_values = array(
            'FRANK_STORE_FIRSTNAME' => Tools::getValue('first_name'),
            'FRANK_STORE_LASTNAME' => Tools::getValue('last_name'),
            'FRANK_ADDRESS_1' => Tools::getValue('address_1'),
            'FRANK_ADDRESS_2' => Tools::getValue('address_2'),
            'FRANK_ADDRESS_3' => Tools::getValue('address_3'),
            'FRANK_STORE_CITY' => Tools::getValue('city'),
            'FRANK_STORE_ZIPCODE' => Tools::getValue('postal_code'),
            'FRANK_STORE_COUNTRY' => Tools::getValue('country'),
            'FRANK_COUNTRY_CODE' => Tools::getValue('country_code'),
            'FRANK_MOBILE' => Tools::getValue('mobile_number'),
            'FRANK_STORE_BUSINESS' => Tools::getValue('number_of_stores'),
            'FRANK_LATITUDE' => Tools::getValue('latitude'),
            'FRANK_LONGITUDE' => Tools::getValue('longitude'),
            'FRANK_UNIQUE_ID' => md5(Configuration::get('PS_SHOP_DOMAIN') . Configuration::get('PS_SHOP_NAME'))
        );

        foreach($form_values as $key => $value) {
            Configuration::updateValue($key, $value);
        }

//        Configuration::updateValue('FRANK_TOKEN', $res['data']['token']);
//        Configuration::updateValue('FRANK_ID', $res['data']['_id']);

//        if (!empty(Configuration::get('FRANK_ID'))){
//            $data = array(
//                '_id' => Configuration::get('FRANK_ID'),
//                'name' => Configuration::get('PS_SHOP_NAME'),
//                'platform' => 'Prestashop',
//                'email' => Configuration::get('PS_SHOP_EMAIL'),
//                'location1' => ['longitude' => $form_values['FRANK_LONGITUDE'], 'latitude' => $form_values['FRANK_LATITUDE']],
////                'location2' => ['longitude' => $form_values['FRANK_LONGITUDE'], 'latitude' => $form_values['FRANK_LATITUDE']],
////                'location3' => ['longitude' => $form_values['FRANK_LONGITUDE'], 'latitude' => $form_values['FRANK_LATITUDE']],
//            );
////            echo '<pre>'; print_r($data); die();
////
////            $res = $this->frank_api->doCurlRequest("https://p-post.herokuapp.com/api/v1/stores/update", $data, Configuration::get('FRANK_TOKEN'));
////            $res = json_decode($res, true);
//        } else {
//            $data = array(
//                'name' => Configuration::get('PS_SHOP_NAME'),
//                'storeURL' => Configuration::get('PS_SHOP_DOMAIN'),
//                'email' => Configuration::get('PS_SHOP_EMAIL'),
//                'platform' => 'Prestashop',
//                'location1' => ['longitude' => $form_values['FRANK_LONGITUDE'], 'latitude' => $form_values['FRANK_LATITUDE'] ],
////                'location2' => ['longitude' => $form_values['FRANK_LONGITUDE'], 'latitude' => $form_values['FRANK_LATITUDE']],
////                'location3' => ['longitude' => $form_values['FRANK_LONGITUDE'], 'latitude' => $form_values['FRANK_LATITUDE']],
//                'firstName' => $form_values['FRANK_STORE_FIRSTNAME'],
//                'lastName' => $form_values['FRANK_STORE_LASTNAME'],
//                'address1' => $form_values['FRANK_ADDRESS_1'],
//                'address2' => $form_values['FRANK_ADDRESS_2'],
//                'address3' => $form_values['FRANK_ADDRESS_3'],
//                'city' => $form_values['FRANK_STORE_CITY'],
//                'country' => $form_values['FRANK_STORE_ZIPCODE'],
//                'countryCode' => $form_values['FRANK_STORE_COUNTRY'],
//                'zipCode' => $form_values['FRANK_COUNTRY_CODE'],
//                'mobile' => $form_values['FRANK_MOBILE'],
//                'totalStores' => (int)$form_values['FRANK_STORE_BUSINESS'],
//                'uniqueID' => $form_values['uniqueID']
//            );
////            echo '<pre>'; print_r($data); die();
////
////            $res = $this->frank_api->doCurlRequest("https://p-post.herokuapp.com/api/v1/stores/signup", $data);
////            $res = json_decode($res, true);
////
////            Configuration::updateValue('FRANK_TOKEN', $res['data']['token']);
////            Configuration::updateValue('FRANK_ID', $res['data']['_id']);
//        }

//        return $data;
    }


    public function getOrderShippingCost($params, $shipping_cost)
    {
        if (Context::getContext()->customer->logged == true && !empty($params->id_carrier))
        {
            $id_address_delivery = Context::getContext()->cart->id_address_delivery;
            $address = new Address($id_address_delivery);
            $addressArray = (array) $address;
            
            $carrierName = $this->getCarrier($params->id_carrier);
            $carrierName = $carrierName[0]['name'];

            $prodArr = $params->getProducts();

            $prodDetail = [];
            $totalWeight = 0;
            $totalLength = 0;
            $totalWidth = 0;
            $totalHeight = 0;

            for ($i=0; $i < count($prodArr); $i++) { 
                
                $totalWeight += $prodArr[$i]['weight'];
                $totalLength += $prodArr[$i]['depth'];
                $totalWidth += $prodArr[$i]['width'];
                $totalHeight += $prodArr[$i]['height'];


                $prodDetail[$i]['product_name'] = $prodArr[$i]['name'];
                $prodDetail[$i]['id_product'] = $prodArr[$i]['id_product'];
                $prodDetail[$i]['product_quantity'] = $prodArr[$i]['cart_quantity'];
                $prodDetail[$i]['width'] = $prodArr[$i]['width'];
                $prodDetail[$i]['height'] = $prodArr[$i]['height'];
                $prodDetail[$i]['length'] = $prodArr[$i]['depth'];
                $prodDetail[$i]['weight'] = $prodArr[$i]['weight'];

            }
            
            /**
             * Send the details through the API
             * Return the price sent by the API
             */

            $addArr = explode(',', $addressArray['address2']);

            $result =
                [
                    'type' => 'delivery',
                    'pickup' =>
                        [
                            'address' => Configuration::get('FRANK_ADDRESS_1'),
                            'location' =>
                                [
                                    (float)Configuration::get('FRANK_LONGITUDE'),
                                    (float)Configuration::get('FRANK_LATITUDE')
                                ],
                            'shortAddress' => Configuration::get('FRANK_ADDRESS_1'),
                            'city' => Configuration::get('FRANK_STORE_CITY'),
                            'country' => Configuration::get('FRANK_STORE_COUNTRY')
                        ],
                    'dropoff' =>
                        [
                            'address' => pSQL($addressArray['address1']),
                            'location' =>
                               [
                                    (float) $addArr[1],
                                    (float) $addArr[0]
                               ],
                            'shortAddress' => pSQL($addressArray['address1']),
                            'city' => pSQL($addressArray['city']),
                            'country' => pSQL($addressArray['country'])
                        ],
                    'commodities' => $prodDetail,

                    'contact' =>
                        [
                            'name' => $addressArray['firstname'] . ' ' . $addressArray['lastname'],
                            'number' => !empty($addressArray['phone']) ? $addressArray['phone'] : '',
                            'email' => $addressArray['email'],
                            'countryCode' => '92'
                        ],

                'deliveryType' => $carrierName,
                'totalWeight' => sprintf("%.2f",$totalWeight),
                'totalWidth' => sprintf("%.2f",$totalWidth),
                'totalHeight' => sprintf("%.2f",$totalHeight),
                'totalLength' => sprintf("%.2f",$totalLength),
                'priceImpact' => 20,
                'orderNumber' => 420586190927,
                'store' => Configuration::get('FRANK_ID')
            ];

            $res = $this->frank_api->doCurlRequest('https://p-post.herokuapp.com/api/v1/orders/rates', $result, Configuration::get('FRANK_TOKEN'));
            $res = json_decode($res, true);
 
            return $res['data']['rates']['price'];
        }

        return $shipping_cost;
    }

    public function getOrderShippingCostExternal($params)
    {

        return true;
    }

    protected function addCarrier($carrierName)
    {
        $carrier = new Carrier();

        $carrier->name = $this->l($carrierName);
        $carrier->is_module = true;
        $carrier->active = 1;
        $carrier->range_behavior = 1;
        $carrier->need_range = 1;
        $carrier->shipping_external = true;
        $carrier->range_behavior = 0;
        $carrier->external_module_name = $this->name;
        $carrier->shipping_method = 2;

        foreach (Language::getLanguages() as $lang)
            $carrier->delay[$lang['id_lang']] = $this->l('Super fast delivery');

        if ($carrier->add() == true)
        {
            @copy(dirname(__FILE__).'/views/img/carrier_image.jpg', _PS_SHIP_IMG_DIR_.'/'.(int)$carrier->id.'.jpg');
            Configuration::updateValue('MYSHIPPINGMODULE_CARRIER_ID', (int)$carrier->id);
            return $carrier;
        }

        return false;
    }

    protected function addGroups($carrier)
    {
        $groups_ids = array();
        $groups = Group::getGroups(Context::getContext()->language->id);
        foreach ($groups as $group)
            $groups_ids[] = $group['id_group'];

        $carrier->setGroups($groups_ids);
    }

    protected function addRanges($carrier)
    {
        $range_price = new RangePrice();
        $range_price->id_carrier = $carrier->id;
        $range_price->delimiter1 = '0';
        $range_price->delimiter2 = '10000';
        $range_price->add();

        $range_weight = new RangeWeight();
        $range_weight->id_carrier = $carrier->id;
        $range_weight->delimiter1 = '0';
        $range_weight->delimiter2 = '10000';
        $range_weight->add();
    }

    protected function addZones($carrier)
    {
        $zones = Zone::getZones();

        foreach ($zones as $zone)
            $carrier->addZone($zone['id_zone']);
    }

    public function hookDisplayOrderConfirmation($params)
    {
        $order = $params['order'];
        $deliveryAddress = new Address((int)$this->context->cart->id_address_delivery);
        $addressArray = (array) $deliveryAddress;


        $orderDetail = $this->getOrderDetail($order->id);

        $twelve_digit = '';
        for($i = 0; $i < 12; $i++) { $twelve_digit .= mt_rand(0, 9); }


        $addArr = explode(',', $addressArray['address2']);

        $totalWeight = 0;
        $totalLength = 0;
        $totalWidth = 0;
        $totalHeight = 0;

        for ($i=0; $i < count($orderDetail); $i++) {

            $totalWeight += $orderDetail[$i]['weight'];
            $totalLength += $orderDetail[$i]['length'];
            $totalWidth += $orderDetail[$i]['width'];
            $totalHeight += $orderDetail[$i]['height'];

//            $image = Product::getCover((int)$orderDetail[$i]['id_product']);
//            $image = new Image($image['id_image']);
//            $product_photo = _PS_BASE_URL_._THEME_PROD_DIR_.$image->getExistingImgPath().".". $image->image_format;
//            $orderDetail[$i]['image'] = $product_photo;

        }

        $commodities = array();

        for ($i = 0; $i < count($orderDetail); $i++) {
            $image = Product::getCover((int)$orderDetail[$i]['id_product']);
            $image = new Image($image['id_image']);
            $product_photo = _PS_BASE_URL_._THEME_PROD_DIR_.$image->getExistingImgPath().".jpg";
            $product_photo_array[] = $product_photo;
            $commodities[] = $this->array_push_assoc($orderDetail[$i], 'images', $product_photo_array[$i]);
        }

        $result =
            [
                'type' => 'delivery',
                'pickup' =>
                    [
                        'address' => Configuration::get('FRANK_ADDRESS_1'),
                        'location' =>
                            [
                                (float)Configuration::get('FRANK_LONGITUDE'),
                                (float)Configuration::get('FRANK_LATITUDE')
                            ],
                        'shortAddress' => Configuration::get('FRANK_ADDRESS_1'),
                        'city' => Configuration::get('FRANK_STORE_CITY'),
                        'country' => Configuration::get('FRANK_STORE_COUNTRY')
                    ],
                'dropoff' =>
                    [
                        'address' => pSQL($addressArray['address1']),
                        'location' =>
                            [
                                (float) $addArr[1],
                                (float) $addArr[0]
                            ],
                        'shortAddress' => pSQL($addressArray['address1']),
                        'city' => pSQL($addressArray['city']),
                        'country' => pSQL($addressArray['country'])
                    ],
                'commodities' => $commodities,

                'pickupDate' => $order->date_add,
                'contact' =>
                    [
                        'name' => $addressArray['firstname'] . ' ' . $addressArray['lastname'],
                        'number' => !empty($addressArray['phone']) ? $addressArray['phone'] : '',
                        'email' => $addressArray['email'],
                        'countryCode' => '92'
                    ],

                'deliveryType' => 'Frank',
                'totalWeight' => sprintf("%.2f",$totalWeight),
                'totalWidth' => sprintf("%.2f",$totalWidth),
                'totalHeight' => sprintf("%.2f",$totalHeight),
                'totalLength' => sprintf("%.2f",$totalLength),
                'priceImpact' => 20,
                'orderNumber' => $twelve_digit,
                'storeOrderID' => $order->reference,
                'store' => Configuration::get('FRANK_ID')
            ];
//        echo '<pre>'; print_r($result); die();
        $res = $this->frank_api->doCurlRequest('https://p-post.herokuapp.com/api/v1/orders/addEcommerceOrder', $result, Configuration::get('FRANK_TOKEN'));

    }


    /**
     * Add the CSS & JavaScript files you want to be loaded in the BO.
     */
    public function hookBackOfficeHeader()
    {
        if (Tools::getValue('frank') == $this->name) {
            $this->context->controller->addJS($this->_path.'views/js/back.js');
            $this->context->controller->addCSS($this->_path.'views/css/back.css');
        }
    }

    /**
     * Add the CSS & JavaScript files you want to be added on the FO.
     */
    public function hookHeader()
    {
        $this->context->controller->addJS($this->_path.'/views/js/front.js');
        $this->context->controller->addCSS($this->_path.'/views/css/front.css');
    }
    public function hookActionFrontControllerSetMedia($params)
    {
      $this->context->controller->addCSS($this->_path.'/views/css/front.css');

    }

    public function hookUpdateCarrier($params)
    {
        /**
         * Not needed since 1.5
         * You can identify the carrier by the id_reference
         */
    }

    public function getOrderDetail($orderId){
        // Build query
        $result = Db::getInstance()->executeS(
            'SELECT ' ._DB_PREFIX_ .'order_detail.`product_name` "name", 
                    ' ._DB_PREFIX_ .'order_detail.`product_quantity` "quantity",
                    ' ._DB_PREFIX_ .'product.`id_product`,
                    ' ._DB_PREFIX_ .'product.`weight`,
                    ' ._DB_PREFIX_ .'product.`depth` "length",
                    ' ._DB_PREFIX_ .'product.`width`,
                    ' ._DB_PREFIX_ .'product.`height` 
            FROM ' ._DB_PREFIX_ .'order_detail
            LEFT JOIN ' ._DB_PREFIX_ .'product
            ON ' ._DB_PREFIX_ .'product.`id_product` = ' ._DB_PREFIX_ .'order_detail.`product_id`
            WHERE ' ._DB_PREFIX_ .'order_detail.`id_order` ='. $orderId);
        return $result;
    }

    public function getCarrier($carrierId){
        $result = Db::getInstance()->executeS(
            'SELECT ' .DB_PREFIX .'carrier.`name` 
            FROM ' .DB_PREFIX .'carrier
            WHERE ' .DB_PREFIX .'carrier.`id_carrier` ='. $carrierId);
        return $result;
    }

    public function array_push_assoc($array, $key, $value){
        $array[$key] = $value;
        return $array;
    }
}
