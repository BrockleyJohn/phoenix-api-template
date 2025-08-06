<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2025 Phoenix Cart

  Released under the GNU General Public License
*/

$response = [
    'success' => true,
    'status' => 'success',
    'data' => [
        'page' => 'account_history_info',
        'timestamp' => date('c'),
        'order_id' => $_GET['order_id'],
        'order' => $order,
    ],
    'meta' => [
        'api_version' => Versions::get('Phoenix'),
        'documentation' => 'https://phoenixcart.org/development/api',
    ],
];

header('Content-Type: application/json');
http_response_code(200);

echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
