<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2025 Phoenix Cart

  Released under the GNU General Public License
*/

// Set content type to JSON
header('Content-Type: application/json');

$response = [
    'success' => false,
    'errors' => [],
];

// Only handle POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($customer_details)) {
        $response['message'] = 'Could not validate submission';
        http_response_code(400);
    } elseif (Form::is_valid()) {
        // failed to create account for an unknown reason
        // we should have redirected on success
        $response['message'] = 'An error occurred while creating your account';
        http_response_code(500);
    } else {
        // Handle validation errors
        $response['message'] = 'Validation failed';
        $response['errors'] = [];

        // Process error messages into a structured format
        foreach ($GLOBALS['messageStack']->messages as $message) {
            $response['errors'][] = $message['text'];
        }
        $GLOBALS['messageStack']->reset();

        http_response_code(400); // Bad Request
    }
} else {
    // Method not allowed
    header('Allow: POST', true, 405);
    $response['message'] = 'Method not allowed';
    $response['errors'] = ['Only POST method is supported'];
}

echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
