<?php

class FrankRelayPoint extends ObjectModel
{
    public $id_frank_carrier_cart;
    public $id_cart;
    public $relay_point;
    public $date_add;

    /**
     * @see ObjectModel::$definition
     */
    public static $definition = array(
        'table' => 'frank_carrier_cart', 'primary' => 'id_frank_carrier_cart', 'multilang' => false,
        'fields' => array(
            'id_cart' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true),
            'relay_point' => array('type' => self::TYPE_STRING),
            'date_add' => array('type' => self::TYPE_DATE, 'validate' => 'isDate', 'copy_post' => false),
        ),
    );

    public static function getRelayPointByCartId($id_cart)
    {
        $id_frank_carrier_cart = Db::getInstance()->getValue('
		SELECT `id_frank_carrier_cart`
		FROM `'._DB_PREFIX_.'frank_carrier_cart`
		WHERE `id_cart` = '.(int)$id_cart);

        return new FrankRelayPoint((int)$id_frank_carrier_cart);
    }
}
