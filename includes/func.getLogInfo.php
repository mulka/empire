<?php

require_once "includes/db.php";
require_once "includes/func.getLogTable.php";
require_once "includes/func.getLocationById.php";

function getLogInfo($action, $logId){
        global $db;
	$table = getLogTable($action);
	if($table){
        	$result =& $db->getRow("SELECT * FROM $table WHERE logId = ?", array($logId));
        	if (PEAR::isError($result)) {
        	    die($result->getMessage());
        	}
	}

	if($result['locId']){
		$result['location'] = getLocationById($result['locId']);
	}

	switch($action){
	case 'editparent':
		$result['before'] = getLocationById($result['before']);
		$result['after'] = getLocationById($result['after']);
		break;
	}
	return $result;
}
