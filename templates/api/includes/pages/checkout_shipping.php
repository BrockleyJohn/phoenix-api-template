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
        'page' => 'checkout_shipping',
        'timestamp' => date('c'),
        'shipping_methods' => null,
        'selected_shipping_method' => null,
    ],
    'status' => 'success',
    'meta' => [
        'api_version' => Versions::get('Phoenix'),
        'documentation' => 'https://phoenixcart.org/api-docs',
    ],
];

if ($module_count > 0) {
    if ($free_shipping) {
        $response['data']['shipping_methods'] = [[
            'id' => 'free_free',
            'module' => FREE_SHIPPING_TITLE,
            'methods' => [
                [
                    'title' => FREE_SHIPPING_TITLE,
                    'description' => sprintf(FREE_SHIPPING_DESCRIPTION, $currencies->format(MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER)),
                ],
            ],
        ]];
        $response['data']['selected_shipping_method'] = 'free_free';
    } else {
        $response['data']['shipping_methods'] = $quotes;
    }
}

header('Content-Type: application/json');
http_response_code(200);
echo json_encode($response);
