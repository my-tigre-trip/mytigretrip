<?php

namespace App\Models\ZohoHelpers;
use App\Models\ZohoHelpers\ZohoHandler;

/**
 * Handle the zoho data for Events 
 */
class CalendarHandler {
  public static function getInstance() {
    return new self();
  }

  /**
   * fecth the zoho Events. Previously auth is required
   * @return Array events array
   * @todo retrieve only future events 
   */
  public function fetchEvents() {
    $zh = ZohoHandler::getInstance();
    // $zh->auth();
    $zcrmModuleIns = $zh->getModuleInstance('Events');
    $bulkAPIResponse = $zcrmModuleIns->getRecords();
    $recordsArray = $bulkAPIResponse->getData();
    return $recordsArray; 
  }
}