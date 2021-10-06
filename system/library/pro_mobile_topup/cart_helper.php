<?php

namespace pro_mobile_topup;

use pro_mobile_topup\constant;

class cart_helper
{
    function __construct($registry)
    {
        $this->db = $registry->get('db');
        $this->session = $registry->get('session');
    }

    public function isTopupProduct($cart_id)
    {
        $query = $this->db->query("SELECT * FROM `". DB_PREFIX . constant::ORDERS_TABLE ."`
            WHERE `cart_id` = '". (int) $cart_id ."'
            AND `session_id` = '". $this->db->escape($this->session->getId()) ."'");

        if ($query->row) { return true; }

        return false;
    }

    public function updateProductsData($products_data)
    {
        if (is_array($products_data)) {
            foreach ($products_data as $k => $v) {

                $topup_data = $this->getTopupData($v['cart_id']);

                if (is_array($topup_data)) {
                    $products_data[$k]['price'] = (float) $topup_data['price'];
                    $products_data[$k]['option'] = $topup_data['option_data'];
                    $products_data[$k]['total'] = (float) $topup_data['price'] * (int) $v['quantity'];
                }
            }
        }

        return $products_data;
    }

    private function getTopupData($cart_id)
    {
        $query = $this->db->query("SELECT * FROM `". DB_PREFIX . constant::ORDERS_TABLE ."`
            WHERE `cart_id` = '". (int) $cart_id ."'
            AND `session_id` = '". $this->db->escape($this->session->getId()) ."'");

        if ($query->row) {

            $option_data = array();
            $option_data[] = array(
                'product_option_id'       => '',
                'product_option_value_id' => '',
                'option_id'               => '',
                'option_value_id'         => '',
                'name'                    => 'Phone number:',
                'value'                   => $query->row['phone_number'],
                'type'                    => constant::TYPE_TOPUP,
                'quantity'                => '',
                'subtract'                => '',
                'price'                   => '',
                'price_prefix'            => '',
                'points'                  => '',
                'points_prefix'           => '',
                'weight'                  => '',
                'weight_prefix'           => '',
            );

            $option_data[] = array(
                'product_option_id'       => '',
                'product_option_value_id' => '',
                'option_id'               => '',
                'option_value_id'         => '',
                'name'                    => 'Calculated amount:',
                'value'                   => $query->row['calculated_amount'],
                'type'                    => constant::TYPE_TOPUP,
                'quantity'                => '',
                'subtract'                => '',
                'price'                   => '',
                'price_prefix'            => '',
                'points'                  => '',
                'points_prefix'           => '',
                'weight'                  => '',
                'weight_prefix'           => '',
            );

            return array(
                'price'         => (float) $query->row['amount'],
                'option_data'   => $option_data,
            );
        }

        return null;
    }
}
