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
        'page' => 'shopping_cart',
        'timestamp' => date('c'),
        'products' => $_SESSION['cart']->get_products(),
        'checkout_link' => $GLOBALS['Linker']->build('checkout_shipping.php'),
    ],
    'status' => 'success',
    'meta' => [
        'api_version' => Versions::get('Phoenix'),
        'documentation' => 'https://phoenixcart.org/development/api',
    ],
];

// Add messages if any
if ($messageStack->size('product_action') > 0) {
    $response['messages'] = [];
    while ($message = $messageStack->next('product_action')) {
        $response['messages'][] = [
            'type' => $message['type'],
            'text' => $message['text'],
        ];
    }
}

// TODO:  fix link to edit quantity
foreach ($response['data']['products'] as $product) {
    $product['quantity_link'] = $GLOBALS['Linker']->build('product_info.php', ['products_id' => $product['id']]);
}

header('Content-Type: application/json');
http_response_code(200);
echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
