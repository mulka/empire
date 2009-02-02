<?php

require_once "includes/db.php";
require_once "includes/func.getLocationTreeById.php";

function listPossibleParentLocations($locId = 0){
	global $db;
	
	$result =& $db->getAll("SELECT * FROM locations WHERE locId NOT IN (SELECT fromLocId FROM redirect) ORDER BY name");
	
	if (PEAR::isError($result)) {
	    die($result->getMessage());
	}

	//TODO: eek... this is really inefficient. I should probably just modify the getLocationTree function to prune the tree when it encounters the locId
	if($locId){
		$locIds = array();
		$locationTree = getLocationTreeById($locId);
		foreach($locationTree as $locationBranch){
			array_push($locIds, $locationBranch[count($locationBranch) - 1]['locId']);
		}
		$possibleParents = array();
		foreach($result as $key => $row){
			if(!in_array($row['locId'], $locIds)){
				array_push($possibleParents, $row);
			}
		}
		return $possibleParents;
	}else{
		return $result;
	}
}
