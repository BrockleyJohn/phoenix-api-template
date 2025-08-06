<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2025 Phoenix Cart

  Released under the GNU General Public License
*/

// Ensure all product data is loaded
foreach (array_keys($product->get_capabilities()) as $capability) {
    $product->get($capability);
}

$response = [
    'data' => [
        'page' => 'product_info',
        'timestamp' => date('c'),
        'product' => $product,
    ],
    'status' => 'success',
    'meta' => [
        'api_version' => Versions::get('Phoenix'),
        'documentation' => 'https://phoenixcart.org/development/api',
    ],
];

header('Content-Type: application/json');
echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

http_response_code(200);
