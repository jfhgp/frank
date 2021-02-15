<?php

class FrankGetOrderShippingCostController
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

    public function getShippingCost($id_carrier, $delivery_service)
    {
        $shipping_cost = false;
        if ($id_carrier == Configuration::get('FRANK_FLEX') && isset($delivery_service['Flex']))
            $shipping_cost = (int)$delivery_service['Flex'];
        if ($id_carrier == Configuration::get('FRANK_GREEN') && isset($delivery_service['Green']))
            $shipping_cost = (int)$delivery_service['Green'];
        if ($id_carrier == Configuration::get('FRANK_CLASSIC') && isset($delivery_service['Classic']))
            $shipping_cost = (int)$delivery_service['Classic'];
        return $shipping_cost;
    }

    public function run($params)
    {
        $res = null;

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
//        print_r($result); die();
        $res = $this->frank_api->doCurlRequest('orders/rates', $result, 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJfaWQiOiI1ZjRjYzZhZjcwMTJiMjAwMTdjNjUzZmEiLCJlbWFpbCI6Inpha2lyQGV4YW1wbGUuY29tIiwicGFzc3dvcmQiOiJkNDFkOGNkOThmMDBiMjA0ZTk4MDA5OThlY2Y4NDI3ZSIsIm1vYmlsZSI6IjMwMDM1MDIzNDUiLCJpYXQiOjE1OTg4NjcxMTl9.-31neeE2CaCPXZYrXvvUF_vwnLvCRqIS90vp-dYQ6lE');
        $res = json_decode($res, true);
//        print_r($res); die();
        return $res['data']['rates']['price'];

    }

    public function getCarrier($carrierId){
        $result = Db::getInstance()->executeS(
            'SELECT ' .DB_PREFIX .'carrier.`name` 
            FROM ' .DB_PREFIX .'carrier
            WHERE ' .DB_PREFIX .'carrier.`id_carrier` ='. $carrierId);
        return $result;
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
}