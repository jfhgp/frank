<?php


class AdminFrankShippingController extends ModuleAdminController
{
    private $frank_api = null;

    public function __construct()
    {
        include_once _PS_MODULE_DIR_ . 'frank/api/FrankApi.php';

        $this->name = 'Frank';
        $this->display = 'view';
        $this->meta_title = 'Shipping';
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
//        $storeId = '5f2b809a172457001794f42c';
        $endPoint = '/all';
        $api_franks = json_decode($this->frank_api->getRequests($baseUrl . $storeId . $endPoint, Configuration::get('FRANK_TOKEN')), true);
        $api_warehouses = json_decode($this->frank_api->getRequests('https://p-post.herokuapp.com/api/v1/stores/warehouse', Configuration::get('FRANK_TOKEN')), true);
        $api_email_addresses = json_decode($this->frank_api->getRequests('https://p-post.herokuapp.com/api/v1/stores/myprofile/' . Configuration::get('FRANK_ID'), Configuration::get('FRANK_TOKEN')), true);


        $returns = $this->get_ahref('AdminFrankReturns');
        $shipping = $this->get_ahref('AdminFrankShipping');
        $orderDetails = $this->get_ahref('AdminFrankOrderDetails');
        $frank_order_address = Configuration::get('FRANK_ADDRESS_1');
//        print_r($frank_order_address); die();
        parent::initContent();
        $this->context->smarty->assign(
            array(
                'api_franks' => $api_franks['data'],
                'returns' => $returns,
                'shipping' => $shipping,
                'frank_order_address' => $frank_order_address,
                'api_warehouses' => $api_warehouses['data'],
                'api_email_addresses' => $api_email_addresses['data']['emailAddresses'],
                'pencil_id' => Configuration::get('pencil_id'),
                'orderDetails' => $orderDetails,
            )
        );
        if (Tools::isSubmit('btn_contact_save')) {
            $this->contactInformation();
        }

        if (Tools::isSubmit('update_email_address')) {
            $this->updateEmail();
        }

        if (Tools::isSubmit('create_new_shipping')) {
            $this->createNewShipment();
        }

        if (Tools::isSubmit('add_new_warehouse_btn')) {
            $this->addNewWarehouse();
        }

        if (Tools::isSubmit('import_csv_btn')) {
            $this->uploadFile();
        }

        if (Tools::isSubmit('btn_resend_verification')) {
            $this->verification();
        }

        if (Tools::isSubmit('change_password')) {
            $this->changePassword();
        }

        if (Tools::isSubmit('btn_delete_account')) {
            $this->deleteAccount();
        }

        $this->setTemplate('shipping.tpl');

    }

    public function initToolBarTitle()
    {
        $this->toolbar_title[] = $this->l('Shipping');
        $this->toolbar_title[] = $this->l('');
    }

    public function setMedia($isNewTheme = false)
    {
        $this->addJquery();
        $this->addCSS(_PS_MODULE_DIR_ . '/frank/views/css/admin/shipping.css');
        $this->addJS(_PS_MODULE_DIR_ . '/frank/views/js/admin/shipping.js');
        parent::setMedia();
    }

    private function get_ahref($controller){
        $stat = _PS_ADMIN_DIR_;
        $admin_folder = substr(strrchr($stat, "admin "), 0);
        $token = Tools::getAdminTokenLite($controller);
        return _PS_BASE_URL_.__PS_BASE_URI__.$admin_folder.'/index.php?controller='.$controller.'&token='.$token;
    }

    private function contactInformation()
    {
        if (!empty(Tools::getValue('contact_person')) && !empty(Tools::getValue('phone')) && !empty(Tools::getValue('contact_person'))) {
            $params = array(
                'contactDetail' => array(
                    'name' => Tools::getValue('contact_person'),
                    'mobile' => Tools::getValue('phone'),
                    'language' => Tools::getValue('language')
                ));
            $res = $this->frank_api->doCurlRequest('https://p-post.herokuapp.com/api/v1/stores/updateContactDetails', $params, Configuration::get('FRANK_TOKEN'));
//           echo '<pre>'; print_r(json_decode($res, true)); die();
        }
    }

    private function updateEmail()
    {
        if (!empty(Tools::getValue('add_new_email_address')) && !empty(Tools::getValue('add_new_role'))) {
            $params = array(
                'email' => Tools::getValue('add_new_email_address'),
                'role' => Tools::getValue('add_new_role')
            );
//        echo '<pre>'; print_r($params); die();
            $res = $this->frank_api->doCurlRequest('https://p-post.herokuapp.com/api/v1/stores/addEmail', $params, Configuration::get('FRANK_TOKEN'));
//           echo '<pre>'; print_r($res); die();
        }
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
                    'canReturn' => Tools::getValue('Active')  ? true : false,
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
        $res = $this->frank_api->doCurlRequest('https://p-post.herokuapp.com/api/v1/orders/createShipment', $params, Configuration::get('FRANK_TOKEN'));

//        echo '<pre>'; print_r($res); die();
    }

    private function addNewWarehouse()
    {
        $params = array(
            'name' => Tools::getValue('warehouse_name'),
            'address' => Tools::getValue('warehouse_address'),
            'city' => Tools::getValue('warehouse_city'),
            'country' => Tools::getValue('warehouse_country'),
            'location' => array(
                'latitude' => (float)Tools::getValue('warehouse_lat'),
                'longitude' => (float)Tools::getValue('warehouse_lng')
            )
        );
//        echo '<pre>'; print_r($params); die();
        $res = $this->frank_api->doCurlRequest('https://p-post.herokuapp.com/api/v1/stores/addWarehouse', $params, Configuration::get('FRANK_TOKEN'));
//           echo '<pre>'; print_r(json_decode($res, true)); die();

    }

    private function uploadFile()
    {
        if ($_FILES['file']['name']) {
            $filename= explode('.', $_FILES['file']['name']);
            if ($filename[1] == 'csv' || $filename[1] == 'xlsx' || $filename[1] == 'xls') {
                $readFile = file_get_contents($_FILES['file']['tmp_name']);
//                print_r($readFile); die();
                $params = array(
                    'csv' => $readFile
                );
                $res = $this->frank_api->doCurlRequest('https://p-post.herokuapp.com/api/v1/orders/createBulkShipment', $params, Configuration::get('FRANK_TOKEN'));
            }
        }
    }

    private function verification()
    {
        if (!empty(Tools::getValue('verification_email')) && !empty(Tools::getValue('verification_role'))) {
            $params = array(
                'email' => Tools::getValue('verification_email'),
                'role' => Tools::getValue('verification_role')
            );
            $res = $this->frank_api->doCurlRequest('https://p-post.herokuapp.com/api/v1/stores/resendVerification', $params, Configuration::get('FRANK_TOKEN'));
//            echo '<pre>'; print_r($res); die();
        }
    }

    private function changePassword()
    {
        if (!empty(ools::getValue('new_password')) && !empty(Tools::getValue('confirm_password')) && !empty(Tools::getValue('current_password'))) {
            if (Tools::getValue('new_password') === Tools::getValue('confirm_password')) {
                $params = array(
                    'oldPassword' => Tools::getValue('current_password'),
                    'newPassword' => Tools::getValue('new_password'),
                );
                $res = $this->frank_api->doCurlRequest('https://p-post.herokuapp.com/api/v1/stores/changepassword', $params, Configuration::get('FRANK_TOKEN'));
//            echo '<pre>'; print_r($res); die();
            }
        }
    }

    private function deleteAccount()
    {
        $res = $this->frank_api->doCurlDeleteRequest('https://p-post.herokuapp.com/api/v1/stores/deleteAccount', Configuration::get('FRANK_TOKEN'));
//        echo '<pre>'; print_r($res); die();
    }
}