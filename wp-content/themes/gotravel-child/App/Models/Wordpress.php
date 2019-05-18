<?php

namespace App\Models;

class Wordpress {
  public static function getInstance() {
    return new self();   
  }

  public function getHomeUrl() {
    return home_url();
  }

  public function redirectHome() {
    wp_redirect(home_url());
  }
}