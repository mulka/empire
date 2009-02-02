<?php

require_once "includes/db.php";
require_once "includes/func.listOrphanLocations.php";
require_once "includes/func.getChildrenLocations.php";
require_once "includes/func.getLocationById.php";
require_once "includes/func.getFirstParentLocation.php";

function refreshAncestorsTable($locId = NULL){
global $db;


//if locId is set:
//create temporary table
//copy current parent's ancestry to this location's ancestry
//add parent as an ancestor
//set appropriate level
//run algorithm

//if locId is NOT set:
//get all orphans
//run algorithm with orphans to fill temp table


//for both at the end:
//truncate ancestor table
//copy temp table to ancestors


$result = $db->query("CREATE TEMPORARY TABLE temp LIKE ancestors");
if (PEAR::isError($result)) {
        die($result->getMessage());
}

if(is_numeric($locId)){
	$parent = getFirstParentLocation($locId);

	$result = $db->query("INSERT INTO temp SELECT ? as locId, level, ancestorLocId FROM ancestors WHERE ancestors.locId = ?", array($locId, $parent['locId']));
	if (PEAR::isError($result)) {
	        die($result->getMessage());
	}
	$result = $db->getOne("SELECT MAX(level) FROM temp");
        if (PEAR::isError($result)) {
                die($result->getMessage());
        }
	$level = $result + 1;

        $result = $db->query("INSERT INTO temp (locId, level, ancestorLocId) VALUES (?, ?, ?)", array($locId, $level, $parent['locId']));
        if (PEAR::isError($result)) {
                die($result->getMessage());
        }

	$locations = array(getLocationById($locId));
	$level++;
}else{
	$locations = listOrphanLocations();
	$level = 0;
}

do{
foreach($locations as $location){
	$children = getChildrenLocations($location['locId']);
	foreach($children as $child){
		//may have to encorporate temp in select statement here
		$result = $db->query("INSERT INTO temp (locId, level, ancestorLocId) SELECT ? AS locId, level, ancestorLocId FROM temp AS temp2 WHERE temp2.locId = ?", array($child['locId'], $location['locId']));
		if (PEAR::isError($result)) {
			print "<pre>"; var_dump($result);
			die($result->getMessage());
		}
		$result = $db->query("INSERT INTO temp (locId, level, ancestorLocId) VALUES (?, ?, ?)", array($child['locId'], $level, $location['locId']));
		if (PEAR::isError($result)) {
			print "<pre>"; var_dump($result);
			die($result->getMessage());
		}
	}
}

$locations = $db->getAll("SELECT locId FROM temp WHERE level = ?", array($level));
if (PEAR::isError($locations)) {
	die($locations->getMessage());
}
$level++;
}while(count($locations));
$result = $db->query("TRUNCATE TABLE ancestors");
if (PEAR::isError($result)) {
        die($result->getMessage());
}

$result = $db->query("INSERT INTO ancestors SELECT * FROM temp");
if (PEAR::isError($result)) {
        die($result->getMessage());
}

}
