<?php

return [


    'bundle' => env('APPSTORE_BUNDLE'),
    'issuer_id' => env('APPSTORE_ISSUER_ID'),
    'key_id' => env('APPSTORE_KEY_ID'),
    'env' => env('APPSTORE_ENV', 'production'), // set this "sandbox" for testing
    'private_key_path' => env('APPSTORE_PRIVATE_KEY_PATH'),

];