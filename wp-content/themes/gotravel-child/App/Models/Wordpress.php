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

  public function redirectCheckout() {
    wp_redirect( 'my-trip?'.$_SERVER['QUERY_STRING']);
  }

  /**
   * Stores the url query use for trip. Should be here or in MyTrip?
   */
  public function saveTrip($query) {
    global $wpdb;
    $res = $wpdb->insert('mtt_trips', ['trip' => json_encode($query)]);
    return $res;
  }
}