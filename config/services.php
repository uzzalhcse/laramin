<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'mac_address' => '1.1.1.1',


    'payment_gateway' => [
        'marchantID' => 'judiciary_test',
        'marchantKey' => 'juD@test1621',
//        'marchantID' => 'dae_pesticide',
//        'marchantKey' => 'DaEPesCid@eP23',
        'url' => [
            'marchant_url' => 'https://sandbox.ekpay.gov.bd/ekpaypg/v1/merchant-api',
            'token_url' => 'https://sandbox.ekpay.gov.bd/ekpaypg/v1'

//            'marchant_url' => 'https://pg.ekpay.gov.bd/ekpaypg/v1/merchant-api',
//            'token_url' => 'https://pg.ekpay.gov.bd/ekpaypg/v1'
        ]
    ],

    'challan_geteway' => [
        'credit_account_fee' => '1-4331-0000-2043',
        'credit_account_vat' => '1-1133-0035-0311',
        'username' => 'daeplm_challan_test',
        'key' => 'daeplm_challan_test_pass',
        'challan_api' => [
            'create' => [
                'url' => 'https://sandbox.ekpay.gov.bd/echallan/api/challan/create',
                'type' => 'POST'
            ],
            'authenticate' => [
                'url' => 'https://sandbox.ekpay.gov.bd/echallan/api/authenticate',
                'type' => 'POST'
            ]

        ]
    ],

];
