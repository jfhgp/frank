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
    public $id_carrier;
    private $frank_api;
    public function __construct()
    {
        $this->name = 'frank';
        $this->tab = 'shipping_logistics';
        $this->version = '1.0.0';
        $this->author = 'HiTech';
        $this->need_instance = 0;
        $this->error_count = 0;

        $this->bootstrap = true;

        parent::__construct();
        $this->addPrestashopAPI();
        $this->displayName = $this->l('Frank');
        $this->description = $this->l('Here is the Frank module for Prestashop');

        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);

        include_once _PS_MODULE_DIR_ . 'frank/api/FrankApi.php';

        $this->frank_api = new FrankApi();
        $this->a = 10;
    }

    public function install()
    {
        if (
            !parent::install() ||
            !$this->installCarriers() ||
            !$this->registerHook('actionCarrierUpdate') ||
            !$this->registerHook('header') ||
            !$this->registerHook('actionFrontControllerSetMedia') ||
            !$this->registerHook('displayOrderConfirmation') ||
            !$this->registerHook('displayCarrierList') ||

            !$this->installModuleTab('AdminFrankShipping', 'Shipping', Tab::getIdFromClassName('AdminParentShipping')) ||
            !$this->installModuleTab('AdminFrankReturns', 'Returns', Tab::getIdFromClassName('AdminParentShipping')) ||
            !$this->installModuleTab('AdminFrankPickup', 'Pickup', Tab::getIdFromClassName('AdminParentShipping')) ||
            !$this->installModuleTab('AdminFrankOrderDetails', 'OrderDetails', 0) ||
            !$this->installModuleTab('AdminFrankNewShipment', 'NewShipment', 0) ||
            !$this->installModuleTab('AdminFrankSettings', 'Settings', 0) ||
            !$this->installModuleTab('AdminFrankSettings', 'Statics', 0)
        )
            return false;

        return true;
    }

    public function uninstall()
    {
        parent::uninstall()
            && $this->unregisterHook('header')
            && $this->unregisterHook('displayOrderConfirmation')
            && $this->unregisterHook('displayProductPriceBlock')
            && $this->uninstallModuleTab('AdminFrankShipping')
            && $this->uninstallModuleTab('AdminFrankReturns')
            && $this->uninstallModuleTab('AdminFrankSettings')
            && $this->uninstallModuleTab('AdminFrankOrderDetails')
            && $this->uninstallModuleTab('AdminFrankNewShipment')
            && $this->uninstallModuleTab('AdminFrankPickup');
        return true;
    }

    public function addPrestashopAPI()
    {
        Configuration::updateValue('PS_WEBSERVICE', 1);

        $apiAccess = new WebserviceKey();
        $apiAccess->key = 'AAAAAAAAAAAABDULBARIANSARISHAKIR';
        Configuration::updateValue('APIKEY', $apiAccess->key);
        $apiAccess->save();

        $permissions = [
            'products' => ['GET' => 1, 'POST' => 1, 'PUT' => 1, 'DELETE' => 1, 'HEAD' => 1],
        ];

        WebserviceKey::setPermissionForAccount($apiAccess->id, $permissions);
    }

    public function removePrestashopAPI()
    {
        Configuration::updateValue('PS_WEBSERVICE', 0);
        $apiAccess = new WebserviceKey();
        $apiAccess->delete();
        WebserviceKey::setPermissionForAccount($apiAccess->id);
    }

    // Tabs install
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

    // Tabs uninstall
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

    public function getContent()
    {
        $countries = Country::getCountries($this->context->country);
        $one = 0;
        $token = Configuration::get('FRANK_TOKEN');
        if (empty($token)) {
            $one = 1;
        }
        $this->context->smarty->assign(array(
            'countries' => $countries,
            'one' => $one
        ));
        return $this->display(__FILE__, 'views/templates/admin/signup.tpl');
    }

    public function installCarriers()
    {
        $id_lang_default = Language::getIsoById(Configuration::get('PS_LANG_DEFAULT'));
        $carriers_list = array(
            'FRANK_FLEX' => 'Flex',
            'FRANK_GREEN' => 'Green',
            'FRANK_CLASSIC' => 'Classic',
        );
        foreach ($carriers_list as $carrier_key => $carrier_name)
            if (Configuration::get($carrier_key) < 1)
            {
                // Create new carrier
                $carrier = new Carrier();
                $carrier->name = $carrier_name;
                $carrier->id_tax_rules_group = 0;
                $carrier->active = 1;
                $carrier->deleted = 0;
                foreach (Language::getLanguages(true) as $language)
                    $carrier->delay[(int)$language['id_lang']] = 'Frank '.$carrier_name;
                $carrier->shipping_handling = false;
                $carrier->range_behavior = 0;
                $carrier->is_module = true;
                $carrier->shipping_external = true;
                $carrier->external_module_name = $this->name;
                $carrier->need_range = true;
                if (!$carrier->add())
                    return false;

                // Associate carrier to all groups
                $groups = Group::getGroups(true);
                foreach ($groups as $group)
                    Db::getInstance()->insert('carrier_group', array('id_carrier' => (int)$carrier->id, 'id_group' => (int)$group['id_group']));

                // Create price range
                $rangePrice = new RangePrice();
                $rangePrice->id_carrier = $carrier->id;
                $rangePrice->delimiter1 = '0';
                $rangePrice->delimiter2 = '10000';
                $rangePrice->add();

                // Create weight range
                $rangeWeight = new RangeWeight();
                $rangeWeight->id_carrier = $carrier->id;
                $rangeWeight->delimiter1 = '0';
                $rangeWeight->delimiter2 = '10000';
                $rangeWeight->add();

                // Associate carrier to all zones
                $zones = Zone::getZones(true);
                foreach ($zones as $zone)
                {
                    Db::getInstance()->insert('carrier_zone', array('id_carrier' => (int)$carrier->id, 'id_zone' => (int)$zone['id_zone']));
                    Db::getInstance()->insert('delivery', array('id_carrier' => (int)$carrier->id, 'id_range_price' => (int)$rangePrice->id, 'id_range_weight' => NULL, 'id_zone' => (int)$zone['id_zone'], 'price' => '0'));
                    Db::getInstance()->insert('delivery', array('id_carrier' => (int)$carrier->id, 'id_range_price' => NULL, 'id_range_weight' => (int)$rangeWeight->id, 'id_zone' => (int)$zone['id_zone'], 'price' => '0'));
                }

                // Copy the carrier logo
                copy(dirname(__FILE__).'/views/img/'.$carrier_key.'.jpg', _PS_SHIP_IMG_DIR_.'/'.(int)$carrier->id.'.jpg');

                // Save the carrier ID in the Configuration table
                Configuration::updateValue($carrier_key, $carrier->id);
            }

        return true;
    }

    public function getOrderShippingCost($params, $shipping_cost)
    {
        $controller = $this->getHookController('getOrderShippingCost');
        return $controller->run($params, $shipping_cost);
//        if (!$this->activate()) return false;
//        return 32;
//        echo '<pre>'; print_r($params); die();
        if (Context::getContext()->customer->logged == true && !empty($params->id_carrier)) {
//            if (!$this->activate()) return false;

            $res = null;
            $id_address_delivery = Context::getContext()->cart->id_address_delivery;

            $address = new Address($id_address_delivery);
            $addressArray = (array) $address;

            $carrierName = $this->getCarrier($params->id_carrier);



            $carrierName = strtolower($carrierName[0]['name']);

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


//                $prodDetail[$i]['product_name'] = $prodArr[$i]['name'];
//                $prodDetail[$i]['id_product'] = $prodArr[$i]['id_product'];
//                $prodDetail[$i]['product_quantity'] = $prodArr[$i]['cart_quantity'];
//                $prodDetail[$i]['width'] = $prodArr[$i]['width'];
//                $prodDetail[$i]['height'] = $prodArr[$i]['height'];
//                $prodDetail[$i]['length'] = $prodArr[$i]['depth'];
//                $prodDetail[$i]['weight'] = $prodArr[$i]['weight'];

                $prodDetail[$i]['item'] = $prodArr[$i]['name'];
                $prodDetail[$i]['quantity'] = $prodArr[$i]['cart_quantity'];
                $prodDetail[$i]['size'] = [
                    (float)$prodArr[$i]['width'], (float)$prodArr[$i]['height'], (float)$prodArr[$i]['depth'], (float)$prodArr[$i]['weight']
                ];
                $prodDetail[$i]['service'] = $carrierName;
                $prodDetail[$i]['store'] = Configuration::get('FRANK_ID');
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
                            'countryCode' => $this->countryCode(pSQL($addressArray['country'])),
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
            $data = array(
                'pickup' => array(
                    'address' => Configuration::get('FRANK_ADDRESS_1'),
                    'location' => [
                        (float)Configuration::get('FRANK_LONGITUDE'),
                        (float)Configuration::get('FRANK_LATITUDE')
                    ],
                    'shortAddress' => Configuration::get('FRANK_ADDRESS_1'),
                    'city' => Configuration::get('FRANK_CITY'),
                    'country' => Configuration::get('FRANK_COUNTRY')
                ),
                'dropoff' => array(
                    'address' => pSQL($addressArray['address1']),
                    'location' => [(float) $addArr[1], (float) $addArr[0]],
                    'shortAddress' => pSQL($addressArray['address1']),
                    'city' => pSQL($addressArray['city']),
                    'country' => pSQL($addressArray['country'])
                ),
                'items' => $prodDetail
            );
//            echo '<pre>'; print_r($data); die();
//            $res = $this->frank_api->doCurlRequest('orders/rates', $result, Configuration::get('FRANK_TOKEN'));
            $res = $this->frank_api->doCurlRequest('prices/get-price/' . Configuration::get('FRANK_ID'), $data, Configuration::get('FRANK_TOKEN'));

            $res = json_decode($res, true);
//            echo '<pre>'; print_r($res); die();
            return ($res['data']['grandTotal']) + $shipping_cost;

        }
    }

    public function getOrderShippingCostExternal($params)
    {
        return $this->getOrderShippingCost($params, 0);
//        return true;
    }

    public function hookDisplayOrderConfirmation($params)
    {
        if (!$this->activate()) return false;
        $controller = $this->getHookController('orderConfirmation');
//        echo '<pre>'; print_r($controller); die();
        return $controller->run($params);
    }


    /**
     * Add the CSS & JavaScript files you want to be added on the FO.
     */
    public function hookHeader()
    {
        $this->context->controller->addJS($this->_path.'/views/js/front.js');
        $this->context->controller->addJS($this->_path.'/views/js/mobiscroll.javascript.min.js');
        $this->context->controller->addCSS($this->_path.'/views/css/front.css');
        $this->context->controller->addCSS($this->_path.'/views/css/mobiscroll.javascript.min.css');
    }

    public function hookActionFrontControllerSetMedia($params)
    {
        $this->context->controller->addJS($this->_path.'/views/js/mobiscroll.javascript.min.js');
//        $this->context->controller->addCSS($this->_path.'/views/css/front.css');
    }

    public function getHookController($hook_name)
    {
        require_once(dirname(__FILE__).'/controllers/hook/'. $hook_name.'.php');
        $controller_name = $this->name.$hook_name.'Controller';
        $controller = new $controller_name($this, __FILE__, $this->_path);
        return $controller;
    }

    public function hookActionCarrierUpdate($params)
    {
        $controller = $this->getHookController('actionCarrierUpdate');
        return $controller->run($params);
    }

    public function hookDisplayCarrierList()
    {
        return "Test";
//        $controller = $this->getHookController('displayCarrierList');
//        return $controller->run();
    }

    public function hookDisplayAdminOrder($params)
    {
        $controller = $this->getHookController('displayAdminOrder');
        return $controller->run();
    }

    public function countryCode($countryName)
    {
        $countries = Country::getCountries($this->context->country);
        foreach ($countries as $country) {
            if ($country['name'] === $countryName) {
                return $country['call_prefix'];
            }
        }
    }

    public function getCarrier($carrierId) {
        return Db::getInstance()->executeS(
            'SELECT ' ._DB_PREFIX_ .'carrier.`name` 
            FROM ' ._DB_PREFIX_ .'carrier
            WHERE ' ._DB_PREFIX_ .'carrier.`id_carrier` ='. $carrierId);
    }

    public function activate()
    {
        $active = $this->frank_api->getRequests('stores/isActive/' . Configuration::get('FRANK_ID'), Configuration::get('FRANK_TOKEN'));
        $active = json_decode($active, true);
        if ($active['status'] === 200) {
            return true;
        }
        return false;
    }

    public function hookDisplayProductPriceBlock($params)
    {
        print_r($params);
        die();
    }

    public function getCarrierName($id_order)
    {
        return Db::getInstance()->executeS('
		SELECT
		
		cl.`name` as `carrier_name`
		FROM `'._DB_PREFIX_.'order_carrier` oc
		LEFT JOIN `'._DB_PREFIX_.'carrier` cl
			ON (oc.`id_carrier` = cl.`id_carrier`)
		WHERE oc.`id_order` = '.(int)$id_order);

    }
}