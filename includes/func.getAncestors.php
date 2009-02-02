<?php

require_once "includes/func.getFirstParentLocation.php";
require_once "includes/db.php";

function getAncestors($locId){

	global $db;
/*
	$result = $db->getAll("SELECT locations.* FROM ancestors JOIN locations ON ancestorLocId = locations.locId WHERE ancestors.locId = ? ORDER BY level", array($locId));
        if (PEAR::isError($result)) {
            die($result->getMessage());
        }
	$rv = $result;
*/	

	$rv = array();
	$parent = getFirstParentLocation($locId);

	if(isset($parent['locId'])){
		$crumbs = getAncestors($parent['locId']);
		foreach($crumbs as $crumb){
			array_push($rv, $crumb);
		}
		array_push($rv, $parent);
	}
	
	return $rv;
}
