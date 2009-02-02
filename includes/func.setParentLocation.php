<?php

require_once "includes/func.getFirstParentLocation.php";
require_once "includes/func.updateAncestorsTable.php";
require_once "includes/func.refreshAncestorsTable.php";
require_once "includes/func.verifyAncestorsTable.php";
require_once "includes/db.php";

function setParentLocationHelper($locId, $parentLocId){
	global $db;
	$before = getFirstParentLocation($locId);
	$before = $before['locId'];
	$result =& $db->query("INSERT INTO `in` (locA, locB) VALUES (?, ?) ON DUPLICATE KEY UPDATE locB = ?", array($locId, $parentLocId, $parentLocId));
	
	if (PEAR::isError($result)) {
	    die($result->getMessage());
	}
//	updateAncestorsTable($locId, $before, $parentLocId);

	empireLog('editparent', array('locId' => $locId, 'before' => $before, 'after' => $parentLocId));
}

function setParentLocation($locIds, $parentLocId){
	if(!is_array($locIds)){
		$locIds = array($locIds);
	}
	foreach($locIds as $locId){
		setParentLocationHelper($locId, $parentLocId);
	}

//	verifyAncestorsTable();
//	refreshAncestorsTable();
}
