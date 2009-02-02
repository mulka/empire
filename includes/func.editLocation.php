<?php

require_once "includes/func.addName.php";
require_once "includes/db.php";

function editLocation($locId, $name){
	global $db;
	
	$result = $db->getOne("SELECT name FROM locations WHERE locId = ?", array($locId));       
        if (PEAR::isError($result)) {
            die($result->getMessage());
        }
	
	addName($locId, $result);

	$result =& $db->query("UPDATE locations SET name = ? WHERE locId = ?", array($name, $locId));
	
	if (PEAR::isError($result)) {
	    die($result->getMessage());
	}

}
