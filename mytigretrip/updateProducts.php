<?php

require '../wp-load.php';
use App\Models\ZohoHelpers\ZohoHandler;
# check the wordpress login
 
# zoho login and get records
ZohoHandler::auth();
$zcrmModuleIns = ZohoHandler::getModuleInstance('Products');
$bulkAPIResponse = $zcrmModuleIns->getRecords();
$recordsArray = $bulkAPIResponse->getData();

$records = [];
foreach($recordsArray as $r) {
  $records[] = $r->getData();  
}

$fileContent = '<?php $arr = ' . var_export($records[0], true) . ';';

file_put_contents('example.php', $fileContent);

