<?php

require_once "includes/func.listOrphanLocations.php";
require_once "includes/func.getLocationById.php";
require_once "includes/func.getChildrenLocations.php";
require_once "includes/func.getNames.php";


function dumpSub($location){	
	$children = getChildrenLocations($location['locId']);
	$childrenTree = array();
	foreach($children as $child){
		array_push($childrenTree, dumpSub($child));
	}
	$alternateNames = getNames($location['locId']);

	$rv = array();
	$rv['name'] = $location['name'];
	$rv['locId'] = $location['locId'];
	if(count($alternateNames))
		$rv['alternateNames'] = $alternateNames;
	if(count($childrenTree))
		$rv['children'] = $childrenTree;
	return $rv; 
}

function dump($locId = NULL){
	//TODO: put this if block inside getChildrenLocations?
	if(is_null($locId)){
		$children = listOrphanLocations();
	}else{
		$children = getChildrenLocations($locId);
	}

	$tree = array();
	foreach($children as $child){
		array_push($tree, dumpSub($child));
	}

	if(!is_null($locId)){
		$location = getLocationById($locId);
		$location['children'] = $tree;
		unset($location['connector']);
		$tree = array($location);
	}
	return $tree;
}

