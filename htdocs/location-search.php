<?php

require_once "includes/func.getLocationsByName.php";
require_once "includes/func.listLocationsUniquely.php";
require_once "includes/func.searchLog.php";

$query = $_GET['query'];

searchLog($query);

$array = explode(" ", $query);

$newArray = array();
foreach($array as $key => $value){
	if($value != ""){
		array_push($newArray, trim($value));
	}
}


$query = implode(" ", $newArray);

$locations = getLocationsByName($query);

if(count($locations) == 1){ 
	header("Location: location-view.php?locId={$locations[0]['locId']}");
	exit();
}

function arrayify($value){
	return array($value);
}
$locationList = array_map('arrayify', $locations);

/*
var_dump($locations);
$locationList = listLocationsUniquely($locations);
var_dump($locationList);
*/

require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign('query', $query);
$smarty->assign('locationList', $locationList);
$smarty->display('location-search.tpl.html');
