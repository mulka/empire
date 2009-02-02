<?php

require_once "includes/func.getLocationById.php";
require_once "includes/func.getFirstParentLocation.php";
require_once "includes/func.listPossibleParentLocations.php";
require_once "includes/func.listLocationsUniquely.php";

$locId = $_GET['locId'];

if(!is_numeric($locId)){
	die("locId needs to be numeric");
}
$possibleParentLocations = listPossibleParentLocations($locId);

$possibleParentLocationList = listLocationsUniquely($possibleParentLocations);

require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign('location', getLocationById($locId));
$smarty->assign('current', getFirstParentLocation($locId));
$smarty->assign('possibleList', $possibleParentLocationList);
$smarty->display('parent-edit.tpl.html');
