<?php

require_once "includes/func.dump.php";

header("Content-Type: text/xml; charset=utf-8");

$locations = dump();

require_once "XML/Serializer.php";
$xml = new XML_Serializer(array('defaultTagName' => 'location', 'rootName' => 'locations', 'addDecl' => true));
$xml->serialize($locations);
print $xml->getSerializedData();

