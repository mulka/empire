<?php

require_once "includes/db.php";

function deleteAkaLocation($locId, $name){
	global $db;
	$result = $db->query("DELETE FROM `aka` WHERE locId = ? AND `name` = ?", array($locId, $name));
	if(PEAR::isError($result)){
		die($result->getMessage());
	}
}
