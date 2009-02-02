<?php

require_once "includes/func.getFirstParentLocation.php";
require_once "includes/func.getCustomMap.php";

function getFirstMapOfParents($locId){
	$location = getFirstParentLocation($locId);
	if(!$location) return false;
	$map = getCustomMap($location['locId']);

	if($map){
		$map['location'] = $location;
		 return $map;
	}
	
	return getFirstMapOfParents($location['locId']);
}
