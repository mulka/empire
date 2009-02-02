<?php

require_once "includes/func.getLocationById.php";
require_once "includes/func.listLocationsUniquely.php";
require_once "includes/func.getFirstParentLocation.php";
require_once "includes/func.getChildrenLocations.php";

$locId = $_GET['locId'];

if(!is_numeric($locId)){
	die("locId needs to be numeric");
}

$parent = getFirstParentLocation($locId);
$children = getChildrenLocations($parent['locId']);

$possibles = array();
foreach($children as $key => $location){
	if($location['locId'] != $locId){
		array_push($possibles, $location);
	}
}

require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign('location', getLocationById($locId));
$smarty->assign('possibles', $possibles);
$smarty->display('children-edit-pushdown.tpl.html');

