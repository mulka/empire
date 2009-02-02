<?php

require_once "includes/func.getFirstParentLocation.php";
require_once "includes/func.getChildrenLocations.php";
require_once "includes/func.listOrphanLocations.php";

function getSiblingLocations($locId){
	$parent = getFirstParentLocation($locId);
	if($parent){
		$children = getChildrenLocations($parent['locId']);
	}else{
		$children = listOrphanLocations();
	}
	$result = array();
	foreach($children as $key => $row){
		if($row['locId'] != $locId){
			array_push($result, $row);
		}
	}
	return $result;
}
