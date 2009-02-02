<?php

require_once "includes/func.getLocationsByNameInTree.php";
require_once "includes/func.getLocationsByAlternateName.php";
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

$locations = getLocationsByNameInTree($query);

$akaLocations = getLocationsByAlternateName($query);

require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();
$smarty->assign('query', $query);
$smarty->assign('locationList', $locations);
$smarty->assign('akaList', $akaLocations);
$smarty->display('location-search-tree.tpl.html');
