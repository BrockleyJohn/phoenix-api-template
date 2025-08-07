<?php
/*
  $Id$

  Phoenix Cart API Template
  https://phoenixcart.org

  Copyright (c) 2025 Phoenix Cart
  Released under the GNU General Public License
*/

// TODO:  this probably shouldn't extend default_template
  class api_template extends default_template {

    protected $format = 'json';

    public static function _get_template_mapping_for($file, $type) {
      switch ($type) {
        case 'page':
          return DIR_FS_CATALOG . 'templates/api/includes/pages/' . basename($file);
        case 'component':
          return DIR_FS_CATALOG . 'templates/api/includes/components/' . basename($file);
        case 'module':
          $file = static::extract_relative_path($file);
          $file = dirname($file) . '/tpl_' . basename($file);

          return DIR_FS_CATALOG . "templates/api/$file";
        case 'ext':
          $file = static::extract_relative_path($file);
          return DIR_FS_CATALOG . "templates/api/includes/$file";
        case 'translation':
        case 'literal':
        default:
          $file = static::extract_relative_path($file);
          return DIR_FS_CATALOG . "templates/api/$file";
      }
    }

    public function output($data) {
      http_response_code($this->status_code);

      header('Content-Type: application/json');
      echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

}
