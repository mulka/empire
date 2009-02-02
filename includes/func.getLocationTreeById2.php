<?php

require_once "includes/func.listOrphanLocations.php";
require_once "includes/func.getLocationTree.php";
require_once "includes/func.getLocationById.php";

function getLocationTree2($location){	
	$children = getChildrenLocations($location['locId']);
	$childrenTree = array();
	foreach($children as $child){
		array_push($childrenTree, getLocationTree2($child));
	}

	return array('name' => $location['name'], 'locId' => $location['locId'], 'children' => $childrenTree);
}

function getLocationTreeById2($locId = NULL){
	//TODO: put this if block inside getChildrenLocations?
	if(is_null($locId)){
		$children = listOrphanLocations();
	}else{
		$children = getChildrenLocations($locId);
	}

	$tree = array();
	foreach($children as $child){
		array_push($tree, getLocationTree2($child));
	}

	if(!is_null($locId)){
		$location = getLocationById($locId);
		$location['children'] = $tree;
		unset($location['connector']);
		$tree = array($location);
	}
	return $tree;
}

