<?php

require_once "includes/func.getLocationTree.php";
require_once "includes/func.getLocationById.php";

function getLocationTree2($location){	
	$children = getChildrenLocations($location['locId']);
	print '<location>';
	print '<name>';
	print $location['name'];
	print '</name>';
	print '<locId>';
	print $location['locId'];
	print '</locId>';
	if(count($children)){
	print '<children>';
	$childrenTree = array();
	foreach($children as $child){
		array_push($childrenTree, getLocationTree2($child));
	}
	
	print '</children>';
	}
	print '</location>';

	return array('name' => $location['name'], 'locId' => $location['locId'], 'children' => $childrenTree);
}

function getLocationTreeById2($locId){
	print '<locations>';
	getLocationTree2(getLocationById($locId));
	print '</locations>';
exit();
	//$tree = array(array(name => 'North America', 'locId' => 42), array('name' => 'South America', 'locId' => 2, 'children' => array(array('name' => 'Chile', 'locId' => 30), array('name' => 'Brazil'))));
//	return $tree;
}

