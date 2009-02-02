<?php

require_once "includes/func.empireLog.php";
require_once "includes/func.addName.php";
require_once "includes/func.setParentLocation.php";
require_once "includes/db.php";

function createLocationHelper($name, $connector){
	global $db;
        $result =& $db->query("INSERT INTO locations (name, connector) VALUES (?, ?)", array($name, $connector));

        if (PEAR::isError($result)) {
            die($result->getMessage());
        }

        $locId = mysql_insert_id($db->connection);

        empireLog('create', array('locId' => $locId));
	
	addName($locId, $name);
	
	return $locId;
}

function createLocation($names, $connector = '', $parentLocId = null){
	if($connector == null) $connector = '';
	
	$locIds = array();
	if(!is_array($names)){
		$names = array($names);
	}

	foreach($names as $name){
		$locId = createLocationHelper($name, $connector);
		array_push($locIds, $locId);
	}

	if($parentLocId){
		setParentLocation($locIds, $parentLocId);
	}
	
	return $locId;

}
