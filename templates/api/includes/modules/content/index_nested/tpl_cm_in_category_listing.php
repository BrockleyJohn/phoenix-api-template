<?php
/*
  $Id$

  Phoenix Cart API - Category Listing Module
  https://phoenixcart.org

  Copyright (c) 2025 Phoenix Cart
  Released under the GNU General Public License
*/

// Format categories for API response
foreach ($categories as $category) {
    $GLOBALS['response']['data']['categories'][] = [
        'id' => (int)$category['id'],
        'name' => $category['title'],
        'image' => $category['image'],
        'url' => empty($category['children'])
               ? $GLOBALS['Linker']->build('advanced_search_result.php', ['categories_id' => $category['id']])
               : $GLOBALS['Linker']->build('index.php', ['cPath' => $category['id']]),
        'has_children' => !empty($category['children']),
        'parent_id' => (int)$GLOBALS['category_tree']->get_parent_id($category['id']),
    ];
}

// Add to API response
$GLOBALS['response']['data']['current_category'] = [
    'id' => (int)$GLOBALS['current_category_id'],
    'count' => count($GLOBALS['response']['data']['categories']),
];

if (0 < $GLOBALS['current_category_id']) {
    $GLOBALS['response']['data']['current_category']['name']
        = $GLOBALS['category_tree']->get($GLOBALS['current_category_id'], 'name');
}
