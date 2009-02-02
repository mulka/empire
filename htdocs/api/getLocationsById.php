<?php

require_once "includes/func.getLocationById.php";

$locIds = explode(",", $_GET['locIds']);

$locations = array();
foreach($locIds as $locId){
	if(is_numeric($locId)){
		array_push($locations, getLocationById($locId));
	}
}

header("Content-Type: text/xml");

require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign('locations', $locations);
$smarty->display('api/locations.tpl.html');
