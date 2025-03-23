<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    'log' => [
        'chanel'  => 'baokim-payment',
        'request' => true,
        'webhook' => true,
        'error'   => true,
    ],

    'jwt' => [
        'host'   => 'https://dev-api.baokim.vn/payment/api/v5/',

        'key'    => '123doc',

        // MOMO OFFICIAL
        'momo'   => [
            'uri_api'          => 'order/send',
            'webhook'          => 'https://1lib.vn/api/payment/baokim/webhook',
            'bpm_id'           => 311,
            'transaction_type' => 'money_momo',
            'secret_key'       => [
                '123doc_momo' => [
                    'key'         => 'a18ff78e7a9e44f38de372e093d87ca1',
                    'secret'      => '9623ac03057e433f95d86cf4f3bef5cc',
                    'merchant_id' => 40002,
                    'weight'      => 1,
                ],
            ],
        ],

        // ATM & QR
        'atm'    => [
            'uri_bank_list'    => 'bpm/list',
            'uri_api'          => 'order/send',
            'webhook'          => 'http://example/api/payment/baokim/webhook',
            'bpm_id'           => 297,
            'transaction_type' => 'money_atm',
            'secret_key'       => [
                'noidungso12_key' => [
                    'key'         => '40f1efdbb177417578d12bb6c8668',
                    'secret'      => '749e1762d976b0dad9bfc5d39',
                    'merchant_id' => 178,
                    'weight'      => 1,
                ],
            ],
        ],

        // MOBILE CARD
        'mobile' => [
            'uri_api'          => 'kingcard/api/v1/strike-card',
            'webhook'          => 'http://example/api/payment/baokim/webhook',
            'transaction_type' => 'money_mobile',
            'secret_key'       => [
                'key1' => [
                    'key'         => 'a18ff78e7a9e44f32e093d87ca1',
                    'secret'      => '9623ac030595d86cf4f3bef5cc',
                    'merchant_id' => '',
                    'weight'      => 1,
                ]
            ],
        ],
    ],

    'virtual_account' => [
        'environment' => env('BAO_KIM_VA_ENV', 'development'),

        'signature_structure' => env('BAO_KIM_VA_SIGNATURE_STRUCTURE', 'RequestId|RequestTime|PartnerCode|AccNo|ClientIdNo|TransId|TransAmount|TransTime|BefTransDebt|AffTransDebt|AccountType|OrderId'),

        /*
        |--------------------------------------------------------------------------
        | Config for development environment
        |--------------------------------------------------------------------------
        */

        'development' => [
            'url'          => "https://devtest.baokim.vn/Sandbox/Collection/V2",
            'public_key'   => '-----BEGIN PUBLIC KEY-----
MIGeMA0GCSqGSIb3DQEBAQUAA4GMADCBiAKBgEpBYWli7Ace0khQ1V22+hbBveAO
KMMB6HWZmXxS05qgiMWiugwyaSB9HdaJ6D49jf5o1CCksI6MwYeldjfISAprahX7
870UZkg9zBTMTr8qgRc2U5BJiC4PnpODkXVfmvLcgKh2psMr1IAHJ2KypmySm2CZ
Dy0HjjvUyy90oBVzAgMBAAE=
-----END PUBLIC KEY-----',
            'private_key'  => '-----BEGIN RSA PRIVATE KEY-----
MIICXAIBAAKBgQCtZF+zdT5jSC7zJTzuW1CdADTXcsRdcTmAgkXCh49dwZz8KpdN
A0htirgWxKGlNbZRzQFcSI+y4bbFjlst/ZjacF+YNacnM/tpWqFQkAaf57aN7pT1
xYIB4BPb1m9b9qfnYM99oLdP7ph1Ypqlu018j8vi0LW97Gjdgrb4J0bbCwIDAQAB
AoGAb6Fsn6v/A4pId8/kn4x4pOuqGX9Q/tvTanH0mZ4O5gytlgeRq0pOyf+CL15e
t2+SNq3mj1RD96WrtxrEhyJ60i2bpXxkwW9F4oXwMMPJ/ST/lR6xZBdAShrRlwga
D8uwfuYkt07XeuJ9+DMCxeQfwqUeYWKTHdlmn4xSUaRH3OECQQDyAvgA6NDHM6hM
yk/iFzVI85NVovdkyg6OJZ4ANCvg0XDd+13fZvQQZFUgmSWZ8k14Q40QxzzdHhOw
WWZxSV/7AkEAt2oL1aqjT2/FyaT9wU3AjV5BBQOSdbvLhgn4ZEkhmRQ4D9rCTWRr
UM4Dpn5ceqhctQEs6qxTLNyQIKjUMw20MQJAIQruuZEQEGKpM/LbfU8V42P+Vc7u
YECGRDo2nGiDJSrzchuD8aCo6iQIy26dh6thkG4IsKXDVZ1pqsZKCmWuSQJATbwk
R+qKTKCSs2O6KLNLaJ8J75YT/NIa8DRJkjdshfSLzixpLWPiF904rtffWh0BLbXR
06Q1nE3ex/jF9t1YAQJBAJyBSxBcZ7QBDd8pE4+ad2knyqDLanfVxYvMr/bZlhLe
Qhh/UpDMR3miiN3NKuNjsi+aKDhVAxFvWaLDncPdENw=
-----END RSA PRIVATE KEY-----',
            'partner_code' => '123DOC',
        ],

        /*
        |--------------------------------------------------------------------------
        | Config for production environment
        |--------------------------------------------------------------------------
        */

        'production' => [
            'url'          => "https://devtest.baokim.vn/Sandbox/Collection/V2",
            'public_key'   => '',
            'private_key'  => '',
            'partner_code' => '',
        ],
    ],

    'disbursement' => [
        'environment' => env('BAO_KIM_VA_ENV', 'development'),

        /*
        |--------------------------------------------------------------------------
        | Config for development environment
        |--------------------------------------------------------------------------
        */

        'development' => [
            "url"           => "https://devtest.baokim.vn/Sandbox/FirmBanking",
            "bk_public_key" => "",
            "public_key"    => "",
            "private_key"   => "",
            "partner_code"  => ""
        ],

        /*
        |--------------------------------------------------------------------------
        | Config for production environment
        |--------------------------------------------------------------------------
        */

        'production' => [
            "url"          => "",
            "public_key"   => "",
            "private_key"  => "",
            "partner_code" => ""
        ],
    ],
];