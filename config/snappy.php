<?php

return [
    'pdf' => [
        'enabled' => true,
        'binary' => env('WKHTMLTOPDF_BINARY', '/usr/bin/wkhtmltopdf'),
        'timeout' => false,
        'options' => [],
        'env' => [],
    ],

    'image' => [
        'enabled' => true,
        'binary' => env('WKHTMLTOIMAGE_BINARY', '/usr/bin/wkhtmltoimage'),
        'timeout' => false,
        'options' => [],
        'env' => [],
    ],
];
