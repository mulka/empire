<?php

require_once "includes/func.listOrphanLocations.php";
require_once "includes/func.getLocationTreeUrlsById.php";
require_once "includes/func.getLocationsByExactName.php";

$path_info = explode("/", $_SERVER['PATH_INFO']);

$names = array();
foreach($path_info as $key => $value){
	if($value != ''){
		array_push($names, $value);
	}
}

function convertWikiTitleToName($title){
	$name = str_replace("_", " ", $title);
	return $name;
}

function convertNameToWikiTitle($name){
	$title = str_replace(" ", "_", $name);
	return $title;
}

$locations = getLocationsByExactName($names[0]);
if(count($locations) == 1){
	$urls = getLocationTreeUrlsById($locations[0]['locId']);
}else{
	$orphans = listOrphanLocations();
	$urls = getLocationTreeUrlsById($orphans[0]['locId']);
}

//print "<pre>";

foreach($names as $name){
	//print $name."\n";
	$urls = $urls[convertWikiTitleToName($name)];
	//var_dump($urls['locIds']);	
}

$locIds = $urls['locIds'];

if(count($locIds) == 1){
	$script_name = $_SERVER['SCRIPT_NAME'];
	$parts = explode("/", $script_name);
	array_pop($parts);
	$url = implode("/", $parts);
	header("Location: ".$url."/location-view.php?locId=".$locIds[0]);
}else if(count($locIds) == 0){
	if(preg_match('/\/$/', $_SERVER['PATH_INFO'])){
		header("Location: ../");
	}else{
		header("Location: ./");
	}
}else{
	print "<pre>";
	print "multiple matches:\n";
	foreach($locIds as $locId){
		print "<a href=\"location-view.php?locId=$locId\">$locId</a><br>";
	}
}
