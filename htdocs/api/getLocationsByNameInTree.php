<?php

require_once "includes/func.getLocationsByNameInTree.php";

$name = $_GET['name'];

$result = getLocationsByNameInTree($name);

header("Content-Type: text/xml; charset=utf-8");

require_once "XML/Serializer.php";
$xml = new XML_Serializer(array('defaultTagName' => 'location', 'rootName' => 'locations', 'addDecl' => true));
$xml->serialize($result);
print $xml->getSerializedData();

/*
require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign('locations', $locations);
$smarty->display('api/locations.tpl.html');
*/
