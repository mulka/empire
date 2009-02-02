<?php

require_once "includes/func.getLocationById.php";
require_once "includes/func.getLocationsByName.php";
require_once "includes/func.getAllLocationsWithBoundsOnMap.php";
require_once "includes/func.getLocationBoundsOnMap.php";
require_once "includes/func.pullLocIds.php";

$locIds = pullLocIds($_GET);

if($locIds == 'all'){
	$locations = getAllLocationsWithBoundsOnMap();
}else{
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
}


require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign('locations', $locations);

switch($_GET['output']){
	case 'debug':
		$smarty->display("index.tpl.html");
		break;
	case 'kml':
                header("Content-Type: application/vnd.google-earth.kml+xml");
		header('Content-Disposition: attachment; filename="export.kml"');
                $smarty->display('export-kml.tpl.kml');
		break;
	case 'georss':
	default:

		header("Content-Type: application/rss+xml");
		header('Content-Disposition: attachment; filename="export-rss.xml"');
		$smarty->display('export-georss.tpl.xml');
		break;
}


