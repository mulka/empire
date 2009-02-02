<?php

require_once "includes/func.getChildrenLocations.php";

function getLocationTree($location, $arrayOfParents, &$tree){
	//may want to implement this in PHP instead of completely in SQL for efficiency... not sure
	$children = getChildrenLocations($location['locId']);
	
	array_push($arrayOfParents, $location);
	array_push($tree, $arrayOfParents);
	
	foreach($children as $child){
		//may want to limit number of levels to go down 
		//(this is what getChildrenLocations does for one level down
		getLocationTree($child, $arrayOfParents, $tree);
	}
}

