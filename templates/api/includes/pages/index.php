<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2025 Phoenix Cart

  Released under the GNU General Public License
*/

// Set the response content type to JSON
header('Content-Type: application/json');

// Initialize the response array
$response = [
    'status' => 'success',
    'data' => [
        'page' => 'index',
        'timestamp' => date('c'),
        'categories' => [],
    ],
    'meta' => [
        'api_version' => Versions::get('Phoenix'),
        'documentation' => 'https://phoenixcart.org/development/api',
    ],
];

Guarantor::ensure_global('category_tree');

try {
    $response['data']['view'] = 'nested_category';
    $response['data']['category_id'] = $current_category_id ?? 0;
    $category_lister = new cm_in_category_listing();
    $category_lister->execute();

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

    http_response_code(200);
} catch (Exception $e) {
    error_log(sprintf('%s: %s (%i: %s)',
      get_class($e),
      $e->getMessage(),
      $e->getFile(),
      $e->getLine()));
    http_response_code(500);
    $response['status'] = 'error';
}

// Output the JSON response
echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
