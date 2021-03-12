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

    public function getDeliveryService()
    {
        $data = array(
            'items' => array(
                array(
                    'item' => 'Showpiece',
                    'size' => [12, 11, 10, 20],
                    'category' => 'Furniture Items',
                    'quantity' => 2
                )
            )
        );
        $res = $this->frank_api->doCurlRequest('prices/get-price-ecommerce/' . Configuration::get('FRANK_ID'), $data, Configuration::get('FRANK_TOKEN'));
        $res = json_decode($res, true);
        $result = $res['price'];
        return $result;
    }

    public function getShippingCost($id_carrier, $delivery_service)
    {
        $shipping_cost = false;
        if ($id_carrier == Configuration::get('FRANK_CLASSIC') && isset($delivery_service['Classic']))
            $shipping_cost = (float)$delivery_service['Classic'];
        if ($id_carrier == Configuration::get('FRANK_FLEX') && isset($delivery_service['Flex']))
            $shipping_cost = (float)$delivery_service['Flex'];
        if ($id_carrier == Configuration::get('FRANK_GREEN') && isset($delivery_service['Green']))
            $shipping_cost = (float)$delivery_service['Green'];
        return $shipping_cost;
    }

    public function loadCity($cart)
    {
        $address = new Address($cart->id_address_delivery);
        $this->city = $address->city;
    }

    public function run($cart, $shipping_fees)
    {
        $this->loadCity($cart);
//        echo '<pre>'; print_r($cart); die();
        $id_address_delivery = Context::getContext()->cart->id_address_delivery;

        $address = new Address($id_address_delivery);
        $addressArray = (array) $address;



        $prodArr = $cart->getProducts();

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

            $prodDetail[$i]['item'] = $prodArr[$i]['name'];
            $prodDetail[$i]['quantity'] = $prodArr[$i]['cart_quantity'];
            $prodDetail[$i]['size'] = [
                (float)$prodArr[$i]['width'], (float)$prodArr[$i]['height'], (float)$prodArr[$i]['length'], (float)$prodArr[$i]['weight']
            ];
        }

        $data = array(
            'items' => $prodDetail
        );
        $res = $this->frank_api->doCurlRequest('prices/get-price-ecommerce/' . Configuration::get('FRANK_ID'), $data, Configuration::get('FRANK_TOKEN'));
        $res = json_decode($res, true);
        $result = $res['price'];
        $shipping_cost = $this->getShippingCost($this->module->id_carrier, $result);

        if ($shipping_cost === false)
            return false;
        return $shipping_cost + $shipping_fees;
    }
}