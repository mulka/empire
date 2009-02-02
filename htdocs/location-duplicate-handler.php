<?php

require_once "includes/func.deleteLocationBoundsOnMap.php";
require_once "includes/func.getLocationBoundsOnMap.php";
require_once "includes/func.moveLocationBoundsOnMap.php";
require_once "includes/func.mergeNames.php";
require_once "includes/func.mergeExternalKeys.php";
require_once "includes/func.mergeExternalUrls.php";
require_once "includes/func.deleteParentLocation.php";
require_once "includes/func.moveChildrenLocations.php";
require_once "includes/func.setLocationRedirect.php";
require_once "includes/func.empireLog.php";

$locId = $_POST['locId'];
$dupLocId = $_POST['dupLocId'];//this is the locId we want to set everything to
$boundsLocId = $_POST['boundsLocId'];

empireLog('duplicate', array('locId' => $locId, 'dupLocId' => $dupLocId));

//TODO: put in validation for the three locIds

if($boundsLocId == $locId){
	deleteLocationBoundsOnMap($dupLocId);
}else if($boundsLocId == $dupLocId){
	deleteLocationBoundsOnMap($locId);
}

//TODO: deal with custom map bounds here

$bounds = getLocationBoundsOnMap($locId);
$dupBounds = getLocationBoundsOnMap($dupLocId);

if($bounds && $dupBounds){
	header("Location: location-duplicate-boundsselect.php?locId=$locId&dupLocId=$dupLocId");
	exit();
}

if($bounds){
	moveLocationBoundsOnMap($locId, $dupLocId);
}

mergeNames($locId, $dupLocId);
mergeExternalKeys($locId, $dupLocId);
mergeExternalUrls($locId, $dupLocId);

deleteParentLocation($locId);
moveChildrenLocations($locId, $dupLocId);

setLocationRedirect($locId, $dupLocId);

header("Location: location-view.php?locId=$dupLocId");

