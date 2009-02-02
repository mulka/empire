<?php

require_once "includes/db.php";

function getDuplicateLogById($logId){
        global $db;

        $result =& $db->getRow("SELECT * FROM logduplicate WHERE logId = ?", array($logId));

        if (PEAR::isError($result)) {
            die($result->getMessage());
        }
	
	return $result;
}
