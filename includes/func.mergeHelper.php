<?php

require_once "includes/db.php";

function mergeHelper($locId1, $locId2, $table){
	global $db;
	$result = $db->query("UPDATE IGNORE `$table` SET locId = ? WHERE locId = ?", array($locId2, $locId1));
	if(PEAR::isError($result)){
		var_dump($result);
		die($result->getMessage());
	}
        $result = $db->query("DELETE FROM `$table` WHERE locId = ?", array($locId1));
        if(PEAR::isError($result)){
		var_dump($result);
                die($result->getMessage());
        }
}
