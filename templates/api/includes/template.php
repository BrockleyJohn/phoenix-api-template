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

    public function output($data) {
      http_response_code($this->status_code);

      header('Content-Type: application/json');
      echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

}
