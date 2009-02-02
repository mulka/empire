<?php

require_once "includes/db.php";
require_once "includes/func.listOrphanLocations.php";
require_once "includes/func.getChildrenLocations.php";

function refreshAncestorsTable($tableName = 'ancestors'){
	global $db;
	$result = $db->query("TRUNCATE TABLE $tableName");
	if (PEAR::isError($result)) {
		die($result->getMessage());
	}
	
	$locations = listOrphanLocations();
	$level = 0;
	do{
		$continue = false;
		foreach($locations as $location){
			$children = getChildrenLocations($location['locId']);
			if(count($children)){
				$continue = true;
			}
			foreach($children as $child){
				$result = $db->query("INSERT INTO $tableName (locId, level, ancestorLocId) SELECT ? AS locId, level, ancestorLocId FROM $tableName WHERE locId = ?", array($child['locId'], $location['locId']));
				if (PEAR::isError($result)) {
					die($result->getMessage());
				}
				$result = $db->query("INSERT INTO $tableName (locId, level, ancestorLocId) VALUES (?, ?, ?)", array($child['locId'], $level, $location['locId']));
				if (PEAR::isError($result)) {
					die($result->getMessage());
				}
		
			}
		}

		$locations = $db->getAll("SELECT locId FROM $tableName WHERE level = ?", array($level));
		if (PEAR::isError($locations)) {
			die($locations->getMessage());
		}
		$level++;
	}while($continue);
}
