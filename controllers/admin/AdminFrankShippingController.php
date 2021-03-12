<?php


class AdminFrankShippingController extends ModuleAdminController
{
    private $frank_api;

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
        $baseUrl = 'orders/store/';
        $storeId = Configuration::get('FRANK_ID');
        $endPoint = '/all/all';
        $api_franks = json_decode($this->frank_api->getRequests($baseUrl . $storeId . $endPoint, Configuration::get('FRANK_TOKEN')), true);

        $shipping = $this->get_ahref('AdminFrankShipping');
        $returns = $this->get_ahref('AdminFrankReturns');
        $new_shipment = $this->get_ahref('AdminFrankNewShipment');
        $settings = $this->get_ahref('AdminFrankSettings');
        $statics = $this->get_ahref('AdminFrankStatics');
        $orderDetails = $this->get_ahref('AdminFrankOrderDetails');
//        print_r($orderDetails); die();

        parent::initContent();
        if ($this->activate()) {
            $this->context->smarty->assign(
                array(
                    'api_franks' => $api_franks['data'],
                    'shipping' => $shipping,
                    'statics' => $statics,
                    'returns' => $returns,
                    'new_shipment' => $new_shipment,
                    'settings' => $settings,
                    'pencil_id' => Configuration::get('pencil_id'),
                    'orderDetails' => $orderDetails
                )
            );

            if (Tools::isSubmit('import_csv_btn')) {
                $this->uploadFile();
            }
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
        $this->addCSS(_PS_MODULE_DIR_ . '/frank/views/css/admin/bootstrap.css');
        $this->addCSS(_PS_MODULE_DIR_ . '/frank/views/css/admin/all.css');
        $this->addCSS(_PS_MODULE_DIR_ . '/frank/views/css/admin/shipping.css');
        $this->addCSS(_PS_MODULE_DIR_ . '/frank/views/css/admin/bootstrap.js');
        $this->addJS(_PS_MODULE_DIR_ . '/frank/views/js/admin/all.js');
        $this->addJS(_PS_MODULE_DIR_ . '/frank/views/js/admin/shipping.js');
        parent::setMedia();
    }

    private function get_ahref($controller){
        $stat = _PS_ADMIN_DIR_;
//        $admin_folder = substr(strrchr($stat, "admin"), 0);
        $admin_folder = substr($stat, strpos($stat, "admin"));
        $token = Tools::getAdminTokenLite($controller);
        return _PS_BASE_URL_.__PS_BASE_URI__.$admin_folder.'/index.php?controller='.$controller.'&token='.$token;
    }

    private function uploadFile()
    {
        if ($_FILES['file']['name']) {
            $filename= explode('.', $_FILES['file']['name']);
//            if ($filename[1] == 'csv' || $filename[1] == 'xlsx' || $filename[1] == 'xls') {
            if ($filename[1] == 'csv') {
                $readFile = file_get_contents($_FILES['file']['tmp_name']);
                $params = array(
                    'csv' => $readFile
                );
                $res = $this->frank_api->doCurlRequest('orders/createBulkShipment', $params, Configuration::get('FRANK_TOKEN'));
            }
        }
    }

    public function activate()
    {
//        return true;
        $active = $this->frank_api->getRequests('stores/isActive/' . Configuration::get('FRANK_ID'), Configuration::get('FRANK_TOKEN'));
        $active = json_decode($active, true);
        if ($active['status'] === 200) {
            return true;
        }
        return false;
    }

}