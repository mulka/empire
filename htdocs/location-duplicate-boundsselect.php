<?php

require_once "includes/func.getLocationById.php";
require_once "includes/func.getLocationBoundsOnMap.php";

$locId = $_GET['locId'];
$dupLocId = $_GET['dupLocId'];

if(!is_numeric($locId)){
	die("locId needs to be numeric");
}

if(!is_numeric($dupLocId)){
        die("dupLocId needs to be numeric");
}

require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign('location', getLocationById($locId));
$smarty->assign('dupLocation', getLocationById($dupLocId));
$smarty->assign('bounds', getLocationBoundsOnMap($locId));
$smarty->assign('dupBounds', getLocationBoundsOnMap($dupLocId));
$smarty->display('location-duplicate-boundsselect.tpl.html');


