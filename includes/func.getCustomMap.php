<?php

require_once "includes/db.php";

function getCustomMap($locId){
	global $db;

        $result = $db->getRow("SELECT maps.* FROM `loc-map` NATURAL JOIN maps WHERE locId = ?", array($locId));
        if(DB::isError($result))
                die($result->getMessage ());

	return $result;
}
