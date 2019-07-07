<?php

namespace App\Utils;

class QueryHelper {
  public static function parseDuration($req) {
    $d = null;
    if (isset($req['duration'])) {
      $d = new \stdClass();
      $_duration = explode('_', $req['duration']);
    
      $d->duration = $_duration[0];
      $d->schedule = $_duration[1];
    } 
    
    return $d;
  }
}