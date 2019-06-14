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
   * @todo retrieve events between two dates
   */
  public function fetchEvents() {
    $zh = ZohoHandler::getInstance();
    // $zh->auth();
    $zcrmModuleIns = $zh->getModuleInstance('Events');
    $bulkAPIResponse = $zcrmModuleIns->getRecords();
    //$bulkAPIResponse = $zcrmModuleIns->searchRecordsByCriteria("($previous:equals:$following)");
    $recordsArray = $bulkAPIResponse->getData();
    return $recordsArray; 
  }

  /**
   * fecth the zoho Events. Previously auth is required
   * @return Array events array
   * @todo retrieve events between two dates
   */
  public function fetchEvent($date) {
    $zh = ZohoHandler::getInstance();
    // $zh->auth();
    $zcrmModuleIns = $zh->getModuleInstance('Events');
    //$bulkAPIResponse = $zcrmModuleIns->getRecords();
    $bulkAPIResponse = $zcrmModuleIns->searchRecordsByCriteria("(Start_DateTime:starts_with:$date)");
    $recordsArray = $bulkAPIResponse->getData();
    return $recordsArray; 
  }
}