<?php

require_once "includes/db.php";
require_once "includes/func.getDefaultMap.php";
require_once "includes/func.getMapById.php";
require_once "includes/func.getLocationsOnMap.php";
require_once "includes/func.getLocationBoundsOnMap.php";
require_once "includes/func.convertToGmapsIfNeeded.php";

$locId = $_GET['locId'] ? $_GET['locId'] : 84;

//see if there is a default custom map for this location
//this function will choose the first map it can find if there is no default set
$mapId = getDefaultMap($locId);

if(!$mapId){ 
	header("Location: gps.php?locId=$locId");
	exit();
}

$mapInfo = getMapById($mapId);
$locations = getLocationsOnMap($mapId);
$bounds = getLocationBoundsOnMap($locId, $mapId);

//TODO: I might be able to be write this function in javascript and push it to the browser
convertToGmapsIfNeeded($mapInfo, $locations, $bounds);

if(!isset($bounds)){
	$bounds = array('miny' => -82, 'minx' => -175, 'maxy' => 82, 'maxx' => 175);
}

require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign('mapInfo', $mapInfo);
$smarty->assign('bounds', $bounds);
$smarty->assign('locations', $locations);
$smarty->display('map.tpl.html');

