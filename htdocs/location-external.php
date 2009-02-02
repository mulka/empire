<?php

require_once "includes/func.getLocationById.php";
require_once "includes/func.getExternalKeys.php";
require_once "includes/func.getExternalLocIds.php";
require_once "includes/func.listLocationsUniquely.php";
require_once "includes/func.getExternalLinkByKey.php";
require_once "includes/func.listLocationsUniquely.php";
require_once "includes/func.listExternalKeys.php";
require_once "includes/func.getLocationsByName.php";
require_once "includes/func.getLocationTreeById.php";
require_once "includes/func.getExternalSources.php";
require_once "includes/func.getExternalSource.php";

$source = $_GET['source'];
$key = $_GET['key'];
$locId = $_GET['locId'];

if(isset($source) && !isset($key) && !isset($locId)){
	$page = 'source';
}else if(isset($source) && !isset($locId)){
	$page = 'external-location';
}else if(isset($source) && !isset($key)){
	$page = 'location-external';
}else if(!isset($source) && isset($locId)){
	$page = 'locId';
}

require_once "includes/Smarty_Empire.class.php";
$smarty =& new Smarty_Empire();

$sourceInfo = getExternalSource($source);

if($page == 'external-location'){
	function convertWikiTitleToName($title){
        	$name = str_replace("_", " ", $title);
        	return $name;
	}

	$name = convertWikiTitleToName($key);

	$external = getExternalLinkByKey($source, $key);


	$locIds = getExternalLocIds($source, $key);
	$externalLocations = array();
	foreach($locIds as $locId){
	        array_push($externalLocations, getLocationById($locId));
	}
	$externalLocationList = listLocationsUniquely($externalLocations);

//this was taking too long to both load from the database and to transfer to the client
/*
	if($external['locId']){
		$possibleList = getLocationTreeById($external['locId']);

		foreach($possibleList as $i => $value){
			$possibleList[$i] = $value[count($value) - 1];
		}
	
		$possibleList = listLocationsUniquely($possibleList);
	}else{
		$possibleList = listLocationsUniquely();
	}
*/

	$suggestionLocations = getLocationsByName($name);
	
	$suggestions = array();
	foreach($suggestionLocations as $suggestion){
		if(!in_array($suggestion['locId'], $locIds)){
			array_push($suggestions, $suggestion);
		}
	}	

	$suggestions = listLocationsUniquely($suggestions);

	$smarty->assign('source', $sourceInfo);
	$smarty->assign('key', $key);
	$smarty->assign('name', $name);
	$smarty->assign('external', $external);
	$smarty->assign('externalLocationList', $externalLocationList);
	$smarty->assign('possibleList', $possibleList);
	$smarty->assign('suggestions',  $suggestions);
	$smarty->display('external-location.tpl.html');
}else if($page == 'location-external'){
	$externalKeyList = array(getExternalKeys($source, $locId));

	$smarty->assign('source', $sourceInfo);
	$smarty->assign('location', getLocationById($locId));
	$smarty->assign('externalKeyList', $externalKeyList);
	$smarty->display('location-external.tpl.html');
}else if($page == 'source'){

	$smarty->assign('source', $source);
	$smarty->assign('locations', listExternalKeys($source));
	$smarty->assign('possibleList', listLocationsUniquely());
	$smarty->display('external.tpl.html');
}else if($page == 'locId'){
	$smarty->assign('location', getLocationById($locId));
	$smarty->assign('externalSources', getExternalSources());
	$smarty->display('external-location-sourceselect.tpl.html');
}
