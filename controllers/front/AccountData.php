<?php

if ( !defined('_PS_VERSION_') ) exit;

class gdprAccountDataModuleFrontController extends ModuleFrontController{
    public function __construct(){
        parent::__construct();
    }

    public function displayVisits(){
        $user_id = Context::getContext()->customer->id;

        return Db::getInstance()->executeS('
		SELECT COUNT(c.id_connections)
		FROM `'._DB_PREFIX_.'guest` g
		LEFT JOIN `'._DB_PREFIX_.'connections` c ON c.id_guest = g.id_guest
		WHERE g.`id_customer` = '.(int)$user_id);
    }

    public function displayOrders(){
        $user_id = Context::getContext()->customer->id;
        $sql = "SELECT COUNT(id_order)
                FROM "._DB_PREFIX_."orders
                WHERE id_customer = ".$user_id;
        return Db::getInstance()->executeS($sql);
    }

    public function displayAbandonedCarts(){
        $user_id = Context::getContext()->customer->id;
        $sql = "SELECT COUNT(id_cart)
		        FROM "._DB_PREFIX_."cart
                WHERE id_customer = ".$user_id." AND NOT EXISTS (SELECT 1 FROM "._DB_PREFIX_."orders WHERE "._DB_PREFIX_."orders.id_cart = "._DB_PREFIX_."cart.id_cart)";
        return Db::getInstance()->executeS($sql);
    }

    public function initContent(){
        $abandonedCarts = $this->displayAbandonedCarts();
        $orders = $this->displayOrders();
        $visits = $this->displayVisits();

        $this->context->smarty->assign([
            'abandonedCarts' => $abandonedCarts[0]["COUNT(id_cart)"],
            'orders' => $orders[0]["COUNT(id_order)"],
            'visits' => $visits[0]["COUNT(c.id_connections)"]
        ]);

        $this->setTemplate('AccountData.tpl');
        parent::initContent();
    }
}
