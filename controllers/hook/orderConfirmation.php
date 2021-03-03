<?php

class FrankOrderConfirmationController
{
    private $frank_api = null;

    public function __construct($module, $file, $path)
    {
        include_once _PS_MODULE_DIR_ . 'frank/api/FrankApi.php';
        $this->file = $file;
        $this->module = $module;
        $this->context = Context::getContext();
        $this->_path = $path;

        $this->frank_api = new FrankApi();
    }

    public function run($params)
    {
            $order = $params['order'];
            $deliveryAddress = new Address((int)$this->context->cart->id_address_delivery);
            $addressArray = (array) $deliveryAddress;

            $carrierName = $this->getCarrierName($order->id);
            $id_customer=$order->id_customer;
            $customer= new Customer((int)$id_customer);


            $orderDetail = $this->getOrderDetail($order->id);
//            echo '<pre>'; print_r($orderDetail); die();
            $twelve_digit = '';
            for($i = 0; $i < 12; $i++) { $twelve_digit .= mt_rand(1, 9); }

    //        echo $twelve_digit; die();


            $addArr = explode(',', $addressArray['address2']);

            $prodDetail = [];
            $totalWeight = 0;
            $totalLength = 0;
            $totalWidth = 0;
            $totalHeight = 0;

            for ($i=0; $i < count($orderDetail); $i++) {

                $totalWeight += $orderDetail[$i]['weight'];
                $totalLength += $orderDetail[$i]['length'];
                $totalWidth += $orderDetail[$i]['width'];
                $totalHeight += $orderDetail[$i]['height'];

                $prodDetail[$i]['item'] = $orderDetail[$i]['name'];
                $prodDetail[$i]['quantity'] = (int)$orderDetail[$i]['quantity'];
                $prodDetail[$i]['size'] = [
                    (float)$orderDetail[$i]['width'], (float)$orderDetail[$i]['length'], (float)$orderDetail[$i]['height'], (float)$orderDetail[$i]['weight']
                ];
                $prodDetail[$i]['service'] = strtolower($carrierName[0]['carrier_name']);
                $prodDetail[$i]['store'] = Configuration::get('FRANK_ID');

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
                    'items' => $prodDetail,

                    'pickupDate' => $order->date_add,
                    'contact' =>
                        [
                            'name' => $addressArray['firstname'] . ' ' . $addressArray['lastname'],
                            'firstName' => $addressArray['firstname'],
                            'lastName' => $addressArray['lastname'],
                            
                            'number' => !empty($addressArray['phone']) ? $addressArray['phone'] : '',
                            'email' => $customer->email,
                            'countryCode' => $this->countryCode(pSQL($addressArray['country'])),
                        ],

                    'deliveryType' => strtolower($carrierName[0]['carrier_name']),
                    'totalWeight' => sprintf("%.2f",$totalWeight),
                    'totalWidth' => sprintf("%.2f",$totalWidth),
                    'totalHeight' => sprintf("%.2f",$totalHeight),
                    'totalLength' => sprintf("%.2f",$totalLength),
                    'priceImpact' => 20,
                    'orderNumber' => $twelve_digit,
                    'storeOrderID' => $order->reference,
                    'store' => Configuration::get('FRANK_ID')
                ];
//            echo '<pre>'; print_r($result); die();
            $res = $this->frank_api->doCurlRequest('orders/addEcommerceOrder', $result, Configuration::get('FRANK_TOKEN'));
//            echo '<pre>'; print_r($res); die();
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

    public function array_push_assoc($array, $key, $value){
        $array[$key] = $value;
        return $array;
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