<?php

require_once "includes/func.getLocationById.php";
require_once "includes/func.getLocationsByName.php";
require_once "includes/func.getLocationBoundsOnMap.php";
require_once "includes/func.pullLocIds.php";

$locIds = pullLocIds($_GET);

$locations = array();
foreach($locIds as $locId){
	$location = getLocationById($locId);
	if($location){
		$location['bounds'] = getLocationBoundsOnMap($locId);
		if($location['bounds']){
			array_push($locations, $location);
		}
	}
}

if(!$locations || count($locations) == 0) die("No empire location associated with this article or, none with a map anyway");

//$byName = getLocationsByName("Ann Arbor");
$bounds = getLocationBoundsOnMap(108);

require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign('locations', $locations);
$smarty->assign('mapBounds', $bounds);
$smarty->display('iframe.tpl.html');



