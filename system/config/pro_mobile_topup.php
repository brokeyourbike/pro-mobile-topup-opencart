<?php

$_['pro_mobile_topup'] = array(
    'status'            => false,
    'debug'             => true,
    'product_id'        => 0,
    'fee'               => 0,
    'name'              => 'Mobile Topup',
    'eventAddToCart'    => '',

    'api' => [
        'glocurrency' => [
            'url' => 'https://topup.glocurrency.com/api/',
            'token' => '',
            'currency_code' => 'GBP',
        ],
        'reloadly' => [
            'url' => 'https://topups-sandbox.reloadly.com/',
            'auth_url' => 'https://auth.reloadly.com/oauth/token',
            'token' => '',
            'secret' => '',
            'currency_code' => 'GBP',
        ],
        'numverify' => [
            'url' => 'http://apilayer.net/api/',
            'token' => '',
            'lifetime_seconds' => 86400,
        ],
    ]
);
