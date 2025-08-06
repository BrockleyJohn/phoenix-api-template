<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2025 Phoenix Cart

  Released under the GNU General Public License
*/

$response = [
    'data' => [
        'page' => 'checkout_shipping_address',
        'timestamp' => date('c'),
        'shipping_address' => $_SESSION['sendto'],
        'addresses' => $customer->get_all_addresses_query()->fetch_all(),
    ],
    'status' => 'success',
    'meta' => [
        'api_version' => Versions::get('Phoenix'),
        'documentation' => 'https://phoenixcart.org/api-docs',
    ],
];

header('Content-Type: application/json');
http_response_code(200);
echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
