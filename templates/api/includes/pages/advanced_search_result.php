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
        'page' => 'advanced_search_result',
        'timestamp' => date('c'),
    ],
    'status' => 'success',
    'success' => true,
    'meta' => [
        'api_version' => Versions::get('Phoenix'),
        'documentation' => 'https://phoenixcart.org/development/api',
    ],
];

require 'includes/system/segments/sortable_product_listing.php';

header('Content-Type: application/json');
http_response_code(200);
echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
