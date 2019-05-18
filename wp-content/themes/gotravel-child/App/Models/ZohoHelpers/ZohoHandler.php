<?php

namespace App\Models\ZohoHelpers;
use ZCRMRestClient;
use ZohoOAuth;
use ZCRMModule;
use ZCRMRecord;
/**
 * 
 */
class ZohoHandler {
  public static function getInstance() {
    return new self();
  }
  /**
   * performs authentication
   * @todo check why sometime throw an exception
   */
  public function auth() {
    try {
      ZCRMRestClient::initialize();
      $oAuthClient = ZohoOAuth::getClientInstance();
      $refreshToken = ZOHO_REFRESH_TOKEN;
      $userIdentifier = ZOHO_EMAIL;
      $oAuthTokens = $oAuthClient->generateAccessTokenFromRefreshToken($refreshToken, $userIdentifier); 
    } catch (ZohoOAuthException $e) {
      echo $e->getCode();
      echo $e->getMessage();
      echo $e->getExceptionCode();
    }
  }

  /**
   * returns a zoho crm module object for fetching
   * @author jose jmc.lemonpie@gmail.com
   * @param String $module  module name
   * @return CRMModule
   */
  public function getModuleInstance($module, $auth = false) {
    if ($auth) {
      self::auth();
    }
    
    $zcrmModuleIns = ZCRMModule::getInstance($module);
    return $zcrmModuleIns;  
  }

  /**
   * returns a zoho crm record object
   * @author jose jmc.lemonpie@gmail.com
   * @return CRMRecord
   */
  public function getRecordInstance($module, $auth = true) {
    if ($auth) {
      self::auth();
    }
        
    $record = ZCRMRecord::getInstance($module, null);
    return $record;
  }  
}