<?php
 
// This gets passed from the run-tests.sh.
$group = getenv('PHPUNIT_CURRENT_GROUP');
 
// Load the core config that applies to all configs.
$doc1 = new DOMDocument();
$doc1->load(realpath(dirname(__FILE__)) . '/core.xml');
 
// Load the specific group that is currently being run.
$doc2 = new DOMDocument();
$doc2->load(realpath(dirname(__FILE__)) . '/' . $group . '.xml');
 
// Merge all children nodes under exclude node.
$exclude1 = $doc1->getElementsByTagName('exclude')->item(0);
$exclude2 = $doc2->getElementsByTagName('exclude')->item(0);
for ($i = 0; $i < $exclude2->childNodes->length; $i++) {
  $item2 = $exclude2->childNodes->item($i);
  $item1 = $doc1->importNode($item2, true);
  $exclude1->appendChild($item1);
}
 
// Reload and save generated file.
$generated = $doc1->saveXML();
$doc3 = new DOMDocument();
$doc3->loadXML($generated);
$doc3->save(realpath(dirname(__FILE__)) . 'generated.xml');