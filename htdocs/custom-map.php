<?php

//TODO: take out unnessesary includes
require_once "includes/func.getLocationById.php";
require_once "includes/func.getLocationRedirect.php";
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


$locIds = $_GET['locIds'];
$boundsLocId = $_GET['boundsLocId'];

$locIds = explode(',', $locIds);

$children = array();
$locations = array();
foreach($locIds as $locId){
	if(!is_numeric($locId)) next;
	$location = getLocationById($locId);
	array_push($children, $location);
	$bounds = getLocationBoundsOnMap($locId);
	if($bounds){
		array_push($locations, array_merge($location, $bounds));
	}
}
if($boundsLocId){
	$bounds = getLocationBoundsOnMap($boundsLocId);
}
	$showBounds = true;
	$mapType = 'gps';
	
require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign('children', $children);
if(!$hideMap){
	$smarty->assign('map', array('type' => $mapType, 'info' => $mapInfo, 'locations' => $locations, 'bounds' => $bounds, 'showBounds' => $showBounds)); //for location-view-map
}
$smarty->display('locations-view.tpl.html');
