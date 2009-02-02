<?php

require_once "includes/func.getLocationTreeById2.php";

$locId = $_GET['locId'];

if(!is_numeric($locId)){
	$locId = NULL;
}

header("Content-Type: text/xml; charset=utf-8");

$locations = getLocationTreeById2($locId);

require_once "XML/Serializer.php";
$xml = new XML_Serializer(array('defaultTagName' => 'location', 'rootName' => 'locations', 'addDecl' => true));
$xml->serialize($locations);
print $xml->getSerializedData();

