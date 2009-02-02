<?php

if($_SERVER['SCRIPT_NAME'] == "/location-view.php" && count($_GET) == 1){
	header("Location: /loc/{$_GET['locId']}");
	exit();
}

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
require_once "includes/func.getChildrenLocationBoundsOnMap.php";
require_once "includes/func.convertToGmapsIfNeeded.php";
require_once "includes/func.getFirstBoundsOfParents.php";
require_once "includes/func.empireViewLog.php";
require_once "includes/func.getLocationType.php";
require_once "includes/func.getFirstParentLocationBoundsOnMap.php";

$locId = $_GET['locId'];
$map = $_GET['map']; //what type of map to display
$edit = $_COOKIE['edit']; //edit mode

//TODO: this is a hack... need to support more than one custom map per location and a ranking for all maps including google map
if($locId == 389 && !isset($map)){
	header("Location: /location-view.php?locId=389&map=gps");
	exit();
}

if(!is_numeric($locId)){
	die("locId needs to be numeric");
}

$location = getLocationById($locId);

$location['type'] = getLocationType($locId);

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
}else if($map == "custom"){
}else if(isset($map)){
	die("valid map options: *mapId*, custom, gps, none");
}

if($redirectLocId = getLocationRedirect($locId)){
	header("Location: /loc/$redirectLocId");
	exit();
}

/*
the following is for location-view-map, and might be better off somewhere else besides here
*/

$showBounds = true;

//see if there is a default custom map for this location
//this function will choose the first map it can find if there is no default set
if(!$mapId){
	$temp = getDefaultMap($locId);
	if(!$forceGps) $mapInfo = $temp;

	if($temp){
		$hasCustomMap = true;
	}else{
		$hasCustomMap = false;
	}
	
}else{
	$mapInfo = getMapById($mapId);
}

//if custom map exists for this location and we're not forcing the GPS map
if($mapInfo && !$forceGps){
	$locations = getChildrenLocationBoundsOnMap($locId, $mapInfo['mapId']);
	$bounds = getLocationBoundsOnMap($locId, $mapInfo['mapId']);

	$mapType = 'custom';

        if($mapInfo['location'] && !$bounds){
                $mapType = 'parent';
		$bounds = getFirstParentLocationBoundsOnMap($locId, $mapInfo['mapId']);
        }
	
	//TODO: I might be able to be write this function in javascript and push it to the browser
	convertToGmapsIfNeeded($mapInfo, $locations, $bounds);
	if(!isset($bounds)){
		$bounds = array('miny' => -85, 'minx' => -175, 'maxy' => 85, 'maxx' => 175);
		$showBounds = true;
	}

	if($mapType == 'parent')
                $bounds['name'] = $mapInfo['location']['name'];

//this location doesn't exist on a custom map, so show gps map
}else{
	
	//GPS STUFF
	$locations = getChildrenLocationBoundsOnMap($locId);
	$bounds = getLocationBoundsOnMap($locId);
	
	$mapType = 'gps';
	
	//try to get parent GPS bounds
	if(!isset($bounds)){
		$bounds = getFirstBoundsOfParents($locId);
		
		//$showBounds = false; //TODO: usability test this
		if($bounds){
			$mapType = 'parent';
		}
	}else{
		$bounds['name'] = $location['name'];
	}
	
}

$breadcrumbs = getBreadcrumbs($locId);

foreach($breadcrumbs as $key => $breadcrumb){
	$breadcrumbs[$key]['indent'] = "";
	for($i = 0; $i < $key; $i++){
		$breadcrumbs[$key]['indent'] .= "--";
	}
}

empireViewLog($locId);

require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign('editMode', $edit);
$smarty->assign('location', $location);
$smarty->assign('aka', getNames($locId));
$smarty->assign('children', getChildrenLocations($locId));
$smarty->assign('breadcrumbs', $breadcrumbs);
$smarty->assign('externalLinks', getExternalLinks($locId));
$smarty->assign('externalUrls', getExternalUrls($locId));
if(!$hideMap){
	$smarty->assign('map', array('type' => $mapType, 'info' => $mapInfo, 'locations' => $locations, 'bounds' => $bounds, 'showBounds' => $showBounds)); //for location-view-map
}
$smarty->assign('hasCustomMap', $hasCustomMap);
$smarty->display('location-view2.tpl.html');
