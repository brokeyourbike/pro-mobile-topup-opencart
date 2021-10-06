<?php
/*
 *  location: catalog/model
 */
class ModelExtensionTotalProMobileTopup extends Model
{
    const ORDERS_TABLE = 'pro_topup_orders';

    private $codename = 'pro_mobile_topup';
    private $route = 'extension/total/pro_mobile_topup';

    private $setting = array();

    function __construct($registry)
    {
        parent::__construct($registry);

        $this->load->language($this->route);
    }

    public function getTotal($total)
    {
        $price = 0;

        foreach ($this->cart->getProducts() as $cart) {
            $topup_data = $this->getTopupData($cart['cart_id']);

            if (isset($topup_data['amount']) && isset($topup_data['fee'])) {
                $price += (float) $this->getTopupFeeValue($topup_data['amount'], $topup_data['fee']);
            }
        }

        $total['totals'][] = array(
            'code'       => $this->codename,
            'title'      => $this->language->get("text_{$this->codename}"),
            'value'      => (float) $price,
            'sort_order' => $this->config->get("total_{$this->codename}_sort_order")
        );

        $total['total'] += $price;
    }

    private function getTopupData($cart_id)
    {
        $query = $this->db->query("SELECT * FROM `". DB_PREFIX . $this->db->escape(\pro_mobile_topup\constant::ORDERS_TABLE) ."`
            WHERE `cart_id` = '". (int) $cart_id ."'
            AND `session_id` = '". $this->db->escape($this->session->getId()) ."'");

        return $query->row;
    }

    private function getTopupFeeValue($amount, $fee)
    {
        if ((float) $amount <= 0 || (float) $fee <= 0) {
            return 0;
        }

        return (float) $amount * ((float) $fee / 100);
    }
}
