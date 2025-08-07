<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2025 Phoenix Cart

  Released under the GNU General Public License
*/

$listing_split = new splitPageResults($listing_sql, $num_list, 'p.products_id');
$listing_parameters = ['listing_split' => &$listing_split];

if ($GLOBALS['messageStack']->size('product_action') > 0) {
    $response['messages'] = [];
    while ($message = $messageStack->next('product_action')) {
        $response['messages'][] = [
            'type' => $message['type'],
            'text' => $message['text'],
        ];
    }
}

if ($listing_split->number_of_rows > 0) {
    $response['data']['listing'] = [
        'product_count' => $listing_split->number_of_rows,
        'page_count' => $listing_split->number_of_pages,
        'current_page' => $listing_split->current_page_number,
    ];

    $response['data']['products'] = [];
    $listing_query = $GLOBALS['db']->query($listing_split->sql_query);
    while ($listing = $listing_query->fetch_assoc()) {
        $listing['link'] = Product::build_link($listing['products_id'], null);
        $response['data']['products'][] = (new Product($listing))->toAPI();
        $product = new Product($listing);
        error_log(print_r($product, true));
    }
}
    