<?php

require_once "includes/func.getDefaultMap.php";

$locId = $_GET['locId'];

$map = getDefaultMap($locId);

header("Content-Type: text/xml; charset=utf-8");

require_once "XML/Serializer.php";
$xml = new XML_Serializer(array('defaultTagName' => 'map', 'rootName' => 'map', 'addDecl' => true));
$xml->serialize($map);
print $xml->getSerializedData();

