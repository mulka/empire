<?php

require_once "includes/func.getLocationById.php";
require_once "includes/func.getSiblingLocations.php";
require_once "includes/func.listLocationsUniquely.php";

$locId = $_GET['locId'];

if(!is_numeric($locId)){
	die("locId needs to be numeric");
}

$siblings = getSiblingLocations($locId);
$possibleList = listLocationsUniquely($siblings);

require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign('location', getLocationById($locId));
$smarty->assign('possibleList', $possibleList);
$smarty->display('location-duplicate.tpl.html');
