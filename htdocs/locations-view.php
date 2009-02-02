<?php

require_once "includes/func.getLocationById.php";
require_once "includes/func.getLocationRedirect.php";
require_once "includes/func.getNames.php";
require_once "includes/func.getFirstParentLocation.php";
require_once "includes/func.getChildrenLocations.php";
require_once "includes/func.getBreadcrumbs.php";
require_once "includes/func.getExternalLinks.php";
require_once "includes/func.getExternalUrls.php";
require_once "includes/func.getDefaultMap.php";
require_once "includes/func.getMapById.php";
require_once "includes/func.getLocationsOnMap.php";
require_once "includes/func.getLocationBoundsOnMap.php";
require_once "includes/func.getChildrenLocationBounds.php";
require_once "includes/func.convertToGmapsIfNeeded.php";
require_once "includes/func.getFirstBoundsOfParents.php";

//the following are displayed:
//name
//connector
//parent location name with link to location-view.php of parent

//lists direct children location names with links to location-view.php

//link to location-edit.php with id of location

//link to location-create.php to create a child of this location

$locId = $_GET['locId'];
$map = $_GET['map'];

if(!is_numeric($locId)){
	die("locId needs to be numeric");
}


if(is_numeric($map)){
	if(getLocationBoundsOnMap($locId, $map)){
		$mapId = $map;
	}else{
		$mapIdIgnored = true; //might want to show a warning to the user about this, or maybe not
	}
}else if($map == "gps"){
	$forceGps = true;
}else if($map == "none"){
	$hideMap = true;
}else if(isset($map)){
	die("valid map options: <mapId>, gps, none");
}

if($redirectLocId = getLocationRedirect($locId)){
	header("Location: location-view.php?locId=$redirectLocId");
	exit();
}

/*
the following is for location-view-map, and might be better off somewhere else besides here
*/

$showBounds = true;

//see if there is a default custom map for this location
//this function will choose the first map it can find if there is no default set
if(!$mapId && !$forceGps){
	$mapId = getDefaultMap($locId);
}

//if custom map exists for this location
if($mapId){
	$mapInfo = getMapById($mapId);
	$locations = getLocationsOnMap($mapId);
	$bounds = getLocationBoundsOnMap($locId, $mapId);
	
	//TODO: I might be able to be write this function in javascript and push it to the browser
	convertToGmapsIfNeeded($mapInfo, $locations, $bounds);
	
	if(!isset($bounds)){
		$bounds = array('miny' => -85, 'minx' => -175, 'maxy' => 85, 'maxx' => 175);
		$showBounds = false;
	}
	$mapType = 'custom';

//this location doesn't exist on a custom map, so show gps map
}else{
	
	//GPS STUFF
	$locations = getChildrenLocationBounds($locId);
	$bounds = getLocationBoundsOnMap($locId);
	
	$mapType = 'gps';
	
	//try to get parent GPS bounds
	if(!isset($bounds)){
		$bounds = getFirstBoundsOfParents($locId);
		
		$showBounds = false;
		if($bounds){
			$mapType = 'parent';
		}
	}
	
}

require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign('location', getLocationById($locId));
$smarty->assign('aka', getNames($locId));
$smarty->assign('children', getChildrenLocations($locId));
$smarty->assign('breadcrumbs', getBreadcrumbs($locId));
$smarty->assign('externalLinks', getExternalLinks($locId));
$smarty->assign('externalUrls', getExternalUrls($locId));
if(!$hideMap){
	$smarty->assign('map', array('type' => $mapType, 'info' => $mapInfo, 'locations' => $locations, 'bounds' => $bounds, 'showBounds' => $showBounds)); //for location-view-map
}
$smarty->display('locations-view.tpl.html');
