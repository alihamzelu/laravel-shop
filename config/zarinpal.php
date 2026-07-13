<?php

return [
    'merchant_id' => env('ZARINPAL_MERCHANT_ID', '9eb640dd-3f26-48f1-8e19-18b0cf66fe87'),
    'sandbox' => env('ZARINPAL_SANDBOX', true),
    'callback_url' => env('ZARINPAL_CALLBACK_URL', '/payment/callback'),
];