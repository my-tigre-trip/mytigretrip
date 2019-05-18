<?php

namespace App\Models;
/**
 * the main objetive for this class is to make easier stub the session for testing purpose 
 */
class Session{
  public static function getInstance() {
    return new self();
  }

  public function setMyTrip($myTrip) {
    session_start();
    $_SESSION['myTrip'] = serialize($myTrip);
  }
  
  public function getMyTrip() {
    session_start();
    return unserialize($_SESSION['myTrip']);
  }

  public function clear() {
    session_start();
    if( session_id() !== null ){
	    session_regenerate_id(); 
	    session_destroy();
    }
  }

  public function id() {
    session_start();
    return session_id();
  }
}