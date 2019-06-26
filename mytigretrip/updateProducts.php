<?php

require '../wp-load.php';
use App\Models\ZohoHelpers\ZohoHandler;
# check the wordpress login
if(!is_user_logged_in() || !current_user_can('administrator')) {
  header("HTTP/1.1 401 Unauthorized");
  exit;
}

# zoho login and get records
ZohoHandler::auth();
$zcrmModuleIns = ZohoHandler::getModuleInstance('Products');
$bulkAPIResponse = $zcrmModuleIns->getRecords();
$recordsArray = $bulkAPIResponse->getData();

$records = [];
foreach($recordsArray as $r) {
  $records[] = $r->getData();  
}

$fileContent = '<?php $zohoProductsArray = ' . var_export($records, true) . ';';

try {
  $status = file_put_contents(dirname(__DIR__, 1).'/wp-content/themes/gotravel-child/zoho-products/'.date('Y-m-d-h-I-s').'-example.php', $fileContent);
  if ($status) {
    echo count($records).' products were imported sucessfully';
  } else {
    echo 'An error ocurred and products could not be imported';
  }
} catch(Exception $e) {
  echo 'ERROR: Exception not handled';
}


