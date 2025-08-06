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
        'page' => 'account_history',
        'timestamp' => date('c'),
    ],
    'status' => 'success',
    'success' => true,
    'meta' => [
        'api_version' => Versions::get('Phoenix'),
        'documentation' => 'https://phoenixcart.org/development/api',
    ],
];

if ($customer->count_orders() > 0) {
    $history_sql = sprintf(<<<'EOSQL'
SELECT o.*, ot.text AS order_total, s.orders_status_name
 FROM orders o INNER JOIN orders_total ot ON o.orders_id = ot.orders_id INNER JOIN orders_status s ON o.orders_status = s.orders_status_id
 WHERE ot.class = 'ot_total' AND s.public_flag = 1 AND s.language_id = %d AND o.customers_id = %d
 ORDER BY orders_id DESC
EOSQL
      , (int)$_SESSION['languages_id'], (int)$_SESSION['customer_id']);
    $history_split = new splitPageResults($history_sql, MAX_DISPLAY_ORDER_HISTORY);
    $history_query = $db->query($history_split->sql_query);

    $order_link = $Linker->build('account_history_info.php')->retain_query_except();
    $response['data']['orders'] = [];
    while ($history = $history_query->fetch_assoc()) {
        $history['link'] = (string)$order_link->set_parameter('order_id', $history['orders_id']);
        $response['data']['orders'][] = $history;
    }
}

header('Content-Type: application/json');
http_response_code(200);
echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
