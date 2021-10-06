<?php
namespace pro_mobile_topup;

use pro_mobile_topup\api;

class glocurrency
{
    private $setting;
    private $api;

    function __construct($setting)
    {
        $this->setting = $setting;
        $this->api = new api($this->setting);
    }

    public function getBalance()
    {
        return $this->api->get('user/get_balance', []);
    }

    public function getNetworks($phone_number)
    {
        return $this->api->get('topup/get_networks', [
            'phone_number' => $phone_number
        ]);
    }

    public function getProducts($data)
    {
        return $this->api->get('topup/get_products', [
            'phone_number' => $data['phone_number'],
            'topup_type' => $data['topup_type'],
            'network_id' => $data['network_id'],
        ]);
    }

    public function calculateCurrency($data)
    {
        return $this->api->get('currency/calculate_currency', [
            'from_currency_code' => $data['from_currency_code'],
            'to_currency_code' => $data['to_currency_code'],
            'amount' => $data['amount'],
        ]);
    }

    public function makeTopup($data)
    {
        return $this->api->post('topup/create_topup', [
            'phone_number' => $data['phone_number'],
            'topup_type' => $data['topup_type'],
            'product_code' => $data['product_code'],
            'amount' => $data['amount'],
            'currency' => $data['currency'],
        ]);
    }
}
