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
        'page' => 'checkout_payment',
        'timestamp' => date('c'),
        'payment_methods' => $payment_modules->selection(),
        'selected_payment_method' => $_SESSION['payment'] ?? null,
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