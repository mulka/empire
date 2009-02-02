<?php

require_once "includes/func.getLocationTreeById.php";

$locId = $_GET['locId'];

if(!is_numeric($locId)){
	die("locId needs to be numeric");
}

$locations = getLocationTreeById($locId);


header("Content-Type: text/xml; charset=utf-8");
require_once "XML/Serializer.php";
$xml = new XMl_Serializer();
$xml->serialize($locations);
print $xml->getSerializedData();

/*
require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign('locations', $locations);
$smarty->display('api/locations.tpl.html');
*/
