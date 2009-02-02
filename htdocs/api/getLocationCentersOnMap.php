<?php

require_once "includes/func.getLocationById.php";
require_once "includes/func.getLocationCentersOnMap.php";
require_once "includes/func.pullLocIds.php";

$locIds = pullLocIds($_GET);

$locations = array();
foreach($locIds as $locId){
	if(is_numeric($locId)){
		$location = getLocationById($locId);
		$location['center'] = getLocationCentersOnMap($locId);
		array_push($locations, $location);
	}
}

header("Content-Type: text/xml");

require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign('locations', $locations);
$smarty->display('api/locations-center.tpl.html');
